<?php
/* Copyright (C) 2016-2018 MarocGeek  <contact@marocgeek.com>
 *
 *This Software Created By MarocGeek Team
 * A software for Manage Syndic Activities
 * SiteWeb : www.marocgeek.com
 *
 */

/**
 *  \ingroup    syndic/propriete
 *  \brief      Core Methodes here
 */

/**
 *  Class to manage Syndic propriete
 */
//Syndicpropriete
class SyndicPropriete // extends CommonObject
{
	/**
	* propriete
	*/

    var $fk_residence ;
    var $num_propriete ;
    var $num_titre ;
    var $quote_part_terrain ;
    var $surface ;
    var $pt_indivision ;
	
	
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
      
		$sql = "INSERT INTO ".MAIN_DB_PREFIX."syndic_propriete(
						fk_residence,
						num_propriete,
						num_titre,
						quote_part_terrain,
						surface,
						pt_indivision
						)
						VALUES (
							'".$this->fk_residence."',
							'".$this->num_propriete."',
							'".$this->num_titre."',
							'".$this->quote_part_terrain."',
							'".$this->surface."',
							'".$this->pt_indivision."'
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
                    return $sql ; //return -1;
				}
      }else{
                return "Error in sql : ".$sql ; //return -1;
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
                        fk_residence            										like '%".$s."%' or
                        num_propriete         										like '%".$s."%' or
                        num_titre               										like '%".$s."%' or
                        quote_part_terrain      										like '%".$s."%' or
												surface                 										like '%".$s."%' or
												pt_indivision           										like '%".$s."%' or
												".MAIN_DB_PREFIX."syndic_residence.nom 			like '%".$s."%'
                ";
    }elseif(!empty($id)){
                        $where = "where ".MAIN_DB_PREFIX."syndic_propriete.rowid = ".$id ;
    }
    $sql = "select 
                   ".MAIN_DB_PREFIX."syndic_propriete.rowid,
                   ".MAIN_DB_PREFIX."syndic_residence.nom as nom_residence,
                   num_propriete, 
                   num_titre, 
                   quote_part_terrain,
									 surface,
									 pt_indivision
            FROM 
                   ".MAIN_DB_PREFIX."syndic_propriete LEFT JOIN ".MAIN_DB_PREFIX."syndic_residence 
						ON 		 ".MAIN_DB_PREFIX."syndic_propriete.fk_residence = ".MAIN_DB_PREFIX."syndic_residence.rowid ".$where ;

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
                                            $arr[]  = array('id'                 =>$obj->rowid,
                                                            'nom_residence'      =>$obj->nom_residence,
                                                            'num_propriete'    =>$obj->num_propriete,
                                                            'num_titre'          =>$obj->num_titre,
                                                            'quote_part_terrain' =>$obj->quote_part_terrain,
                                                            'surface'            =>$obj->surface,
                                                            'pt_indivision'      =>$obj->pt_indivision,
                                                            'sup'                => true);
                                        }
                                        $i++;
                                }
                            $arrJson = json_encode($arr);
                            return $arrJson ;
                        }else{
                            //Fail
                            return 'table est vide' ;
                        }
            }
			else
			{
			                    //Fail
								$this->db->rollback();
                                return 'resql is false : '.$sql ;
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
						FROM ".MAIN_DB_PREFIX."syndic_propriete 
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

        $sql = "update ".MAIN_DB_PREFIX."syndic_propriete
                                                              SET
                                                                    fk_residence            = '".$this->fk_residence."',
                                                                    num_propriete         = '".$this->num_propriete."',
                                                                    num_titre               = '".$this->num_titre."',
                                                                    quote_part_terrain      = '".$this->quote_part_terrain."',
                                                                    surface                 = ".$this->surface.",
                                                                    pt_indivision           = '".$this->pt_indivision."'
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
                FROM ".MAIN_DB_PREFIX."syndic_propriete 
                WHERE rowid > ".$id." 
                ORDER BY rowid LIMIT 1";
        $resql=$this->db->query($sql);
        $this->db->commit();
        $obj = $this->db->fetch_object($resql);
        $arr_prev_next['next_id'] = $obj->rowid ;

        //Retrieve previous id
        $sql = "SELECT rowid 
                FROM ".MAIN_DB_PREFIX."syndic_propriete 
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
	
		    /**
     * *********************** Combo : Retrieve Liste Residence & dependencies ***********************
     *
     **/
	
	public function fetch_combo_residence(){
 
		$sql = "SELECT 
											".MAIN_DB_PREFIX."syndic_residence.rowid,
											".MAIN_DB_PREFIX."syndic_propriete.rowid as id_propriete,
											".MAIN_DB_PREFIX."syndic_residence.nom,
											".MAIN_DB_PREFIX."syndic_residence.num_residence,
											".MAIN_DB_PREFIX."syndic_residence.ville
						FROM
											".MAIN_DB_PREFIX."syndic_residence 
						LEFT JOIN 
											".MAIN_DB_PREFIX."syndic_propriete 
						ON 
											".MAIN_DB_PREFIX."syndic_residence.rowid = ".MAIN_DB_PREFIX."syndic_propriete.fk_residence";
		
    $resql=$this->db->query($sql);
	//If error in Sql
	if(!$resql) return 'Erreur innatendue : '.$sql ;
		
	while ($obj = $resql->fetch_object())
		{
										$arr[]  = array('id'             	  =>$obj->rowid,
																		'id_propriete'		=>$obj->id_propriete,
																		'nom'         		 	=>$obj->nom,
																		'num_residence' 		=>$obj->num_residence,
																		'ville'    					=>$obj->ville);
		}
			$arrJson = json_encode($arr);
			return $arrJson ;
   }
    
}