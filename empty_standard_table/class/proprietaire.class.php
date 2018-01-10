<?php
/* Copyright (C) 2016-2018 MarocGeek  <contact@marocgeek.com>
 *
 *This Software Created By MarocGeek Team
 * A software for Manage Syndic Activities
 * SiteWeb : www.marocgeek.com
 *
 */

/**
 *  \ingroup    syndic/proprietaire
 *  \brief      Core Methodes here
 */

/**
 *  Class to manage Syndic Proprietaire
 */
//SyndicProprietaire
class SyndicProprietaire // extends CommonObject
{
	/**
	* Proprieties
	*/
    var $nom ;
	var $prenom ;
	var $titre ;
	var $civilite ;
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
      
		$sql = "INSERT INTO ".MAIN_DB_PREFIX."proprietaire(
						nom,
						prenom,
						titre,
						civilite,
						ville
						)
						VALUES (
							'".$this->nom."',
							'".$this->prenom."',
							'".$this->titre."',
							'".$this->civilite."',
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

  public function fetch($s = null){
 
    $where = "" ;
    if(!empty($s)){
        $where = "where 
                        nom         like '%".$s."%' or
                        prenom      like '%".$s."%' or
                        titre       like '%".$s."%' or
                        civilite    like '%".$s."%' or
                        ville       like '%".$s."%' or
                        rowid       like '%".$s."%'
                ";
    }
    $sql = "select 
                   rowid,
                   nom, 
                   prenom, 
                   titre, 
                   civilite, 
                   ville 
            FROM 
                   ".MAIN_DB_PREFIX."proprietaire ".$where ;

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
                                            $arr[]  = array('id'        =>$obj->rowid,
                                                            'nom'       =>$obj->nom,
                                                            'prenom'    =>$obj->prenom,
                                                            'titre'     =>$obj->titre,
                                                            'civilite'  =>$obj->civilite,
                                                            'ville'     =>$obj->ville,
                                                            'sup'       => true);
                                        }
                                        $i++;
                                }
                            $arrJson = json_encode($arr);
                            return $arrJson ;
                        }else{
                            //Fail
                            return $sql ;
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
						FROM ".MAIN_DB_PREFIX."proprietaire 
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

        $sql = "update ".MAIN_DB_PREFIX."proprietaire
                                                      SET 
                                                            nom         = '".$this->nom."',
                                                            prenom      = '".$this->prenom."',
                                                            titre       = '".$this->titre."',
                                                            civilite    = '".$this->civilite."',
                                                            ville       = '".$this->ville."'
                                                      WHERE
                                                            rowid       = ".$id."
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
                FROM ".MAIN_DB_PREFIX."proprietaire 
                WHERE rowid > ".$id." 
                ORDER BY rowid LIMIT 1";
        $resql=$this->db->query($sql);
        $this->db->commit();
        $obj = $this->db->fetch_object($resql);
        $arr_prev_next['next_id'] = $obj->rowid ;

        //Retrieve previous id
        $sql = "SELECT rowid 
                FROM ".MAIN_DB_PREFIX."proprietaire 
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