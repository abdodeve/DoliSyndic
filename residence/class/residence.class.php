<?php
/* Copyright (C) 2016-2018 MarocGeek  <contact@marocgeek.com>
 *
 *This Software Created By MarocGeek Team
 * A software for Manage Syndic Activities
 * SiteWeb : www.marocgeek.com
 *
 */

/**
 *  \ingroup    syndic/residence
 *  \brief      Core Methodes here
 */

/**
 *  Class to manage Syndic Residence
 */
//SyndicResidence
class SyndicResidence // extends CommonObject
{
	/**
	* Residence
	*/
    var $num_residence ;
    var $nom ;
	var $adresse ;
	var $cp_res ; 
	var $ville ;
	
	/**
	 *	Constructor
	 *
	 *  @param		DoliDB		$db      Database handler
	 */
	function __construct($db)
	{
		$this->db = $db;
		return 1;
	}


	/**
	 ***********************Create record into database*******************************
	 *
	 *  @param      User	$user       User that create
	 *  @return     int      			<0 if KO, >0 if OK
	 */
	public function create()
	{
		$this->db->begin();   // Debut transaction
      
		$sql = "INSERT INTO ".MAIN_DB_PREFIX."syndic_residence(
						num_residence,
						nom,
						adresse,
						cp_res, 
						ville
						)
						VALUES (
							'".$this->num_residence."',
							'".$this->nom."',
							'".$this->adresse."',
							'".$this->cp_res."', 
							'".$this->ville."'
						)";
    	$resql=$this->db->query($sql);
			if ($resql)
      {
      	if (! $error)
				{
					$this->db->commit();
					return $resql ;
				}
				else
				{
					$this->db->rollback();
					return -1;
				}
      }else{
				return -1;
			}
	}

    /**
     * *********************** Fetch/Search Data From database ***********************
     * @Param :
     *          $s -> ( case : search -> string | case fetch -> null )
     * @Return :
     *          Json array of fetched Data
     *
     **/

  public function fetch($s = null,$id = null){
 
    $where = "" ;
    if(!empty($s)){
        $where = "where 
                        num_residence    like '%".$s."%' or
                        nom              like '%".$s."%' or
                        adresse          like '%".$s."%' or
                        cp_res           like '%".$s."%' or 
                        ville            like '%".$s."%'
                ";
    }elseif(!empty($id)){
        $where = "where rowid = ".$id;
    }

    $sql = "select 
                   rowid,
                   num_residence,
                   nom, 
                   adresse, 
                   cp_res,   
                   ville 
            FROM 
                   ".MAIN_DB_PREFIX."syndic_residence ".$where ;

    $resql=$this->db->query($sql);
    if ($resql)
            {
                        $this->db->commit();
                        $num = $this->db->num_rows($resql);
                        $i = 0;
                        if ($num)
                        {
                                while ($i < $num)
                                {
                                        $obj = $this->db->fetch_object($resql);
                                        if ($obj)
                                        {
                                            $arr[]  = array('id'                  =>$obj->rowid,
                                                            'num_residence'       =>$obj->num_residence,
                                                            'nom'                 =>$obj->nom,
                                                            'adresse'             =>$obj->adresse,
                                                            'cp_res'              =>$obj->cp_res,
                                                            'ville'               =>$obj->ville,
                                                            'sup'                 => true);
                                        }
                                        $i++;
                                }
                            $arrJson = json_encode($arr);
                            return $arrJson ;
                        }else{
                            //Fail
                            return 'Error in this req : \n '.$sql ;
                        }
        }
			else
			{
			                    //Fail
								$this->db->rollback();
								return -1 ;
			}
    }

    /**
     * *********************** Delete Data From database ***********************
     * @Param :
     *          $arr_ids -> array of ids which should delete (*Required)
     * @Return :
     *          -1 on fail
     *
     **/

    public function delete($arr_ids = null){

        // If param empty (Required Param)
        if($arr_ids == null) return -1 ;

		$ids ='' ;
		foreach($arr_ids as $key => $value){
			$ids .= $key == 0 ? '' : ',' ;
			$ids .= $value ;
		}
		$sql = "DELETE 
						FROM ".MAIN_DB_PREFIX."syndic_residence 
						WHERE 
							  rowid in (".$ids.");";
		 	$resql=$this->db->query($sql);
		if ($resql)
		{
			if (!$error)
			{
				$this->db->commit();
				return 'Delete success';//$resql;
			}
			else
			{
				$this->db->rollback();
				return -1;
			}
		}else
			{
				return -1;
			}
	}

    /**
     * *********************** Update Data in database ***********************
     * @Param :
     *          îd -> id of row (*Required)
     * @Return :
     *          -1 on fail
     *
     **/

    public function update($id){

        $this->db->begin();   // Debut transaction

        $sql = "update ".MAIN_DB_PREFIX."syndic_residence
                                                      SET 
                                                            num_residence   = '".$this->num_residence."',
                                                            nom             = '".$this->nom."',
                                                            adresse         = '".$this->adresse."',
                                                            cp_res          = '".$this->cp_res."', 
                                                            ville           = '".$this->ville."'
                                                      WHERE
                                                            rowid           = ".$id."
                                                        ";
        $resql=$this->db->query($sql);
        if ($resql)
        {
            if (! $error)
            {
                $this->db->commit();
                return $resql;
            }
            else
            {
                $this->db->rollback();
                return $sql; //-1;
            }
        }else{
            return $sql; //-1;
        }

    }

    /**
     * *********************** Retrieve Next & Previous Ids From database ***********************
     * @Param :
     *          $id -> Current id (*Required)
     * @Return :
     *          -1 on fail | Json Array of Next & Previous Ids
     *
     **/

    public function next_previous_id($id){

        if (empty($id)) return -1 ;

        //Array of next & previous ids
        $arr_prev_next = [] ;

        //Retrieve next id
        $sql = "SELECT rowid 
                FROM ".MAIN_DB_PREFIX."syndic_residence 
                WHERE rowid > ".$id." 
                ORDER BY rowid LIMIT 1";
        $resql=$this->db->query($sql);
        $this->db->commit();
        $obj = $this->db->fetch_object($resql);
        $arr_prev_next['next_id'] = $obj->rowid ;

        //Retrieve previous id
        $sql = "SELECT rowid 
                FROM ".MAIN_DB_PREFIX."syndic_residence 
                WHERE rowid < ".$id." 
                ORDER BY rowid DESC LIMIT 1";
        $resql=$this->db->query($sql);
        $this->db->commit();
        $obj = $this->db->fetch_object($resql);
        $arr_prev_next['previous_id'] = $obj->rowid ;

        //Convert to json
        $arr_prev_next = json_encode($arr_prev_next) ;
        return $arr_prev_next ;
    }
    
}