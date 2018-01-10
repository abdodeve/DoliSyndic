<?php
/* Copyright (C) 2016-2018 MarocGeek  <contact@marocgeek.com>
 *
 *This Software Created By MarocGeek Team
 * A software for Manage Syndic Activities
 * SiteWeb : www.marocgeek.com
 *
 */

/**
 *  \ingroup    syndic/paiement
 *  \brief      Core Methodes here
 */

/**
 *  Class to manage Syndic Paiement
 */
//SyndicPaiement
class SyndicPaiement // extends CommonObject
{
	/**
	* Paiement
	*/
		var $fk_appartement ;
		var $num_paiement ;
    var $date_paiement ;
		var $mode_paiement ;
		var $affectation_paiement ;
		var $montant_paiement; 
	
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
      
		$sql = "INSERT INTO ".MAIN_DB_PREFIX."syndic_paiement(
						fk_appartement,
						num_paiement,
						date_paiement,
						mode_paiement,
						affectation_paiement,
						montant_paiement
						)
						VALUES (
						  '".$this->fk_appartement."',
						  '".$this->num_paiement."',
							'".$this->date_paiement."',
							'".$this->mode_paiement."',
							'".$this->affectation_paiement."',
							'".$this->montant_paiement."'
						)";
    	$resql=$this->db->query($sql);
			if ($resql)
      {
      	if (! $error)
				{
					$this->db->commit();
					return 'Insert success' ;
				}
				else
				{
					$this->db->rollback();
					return $sql ; //return -1;
				}
      }else{
                return $sql ;
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
									   		num_paiement             like '%".$s."%' or
                        date_paiement            like '%".$s."%' or
                        mode_paiement            like '%".$s."%' or
                        affectation_paiement     like '%".$s."%' or
                        montant_paiement         like '%".$s."%' 
                ";
    }elseif(!empty($id)){
        $where = "where rowid = ".$id;
     }
	$sql = "SELECT 
									rowid,
									num_paiement, 
									date_paiement, 
									mode_paiement, 
									affectation_paiement, 
									montant_paiement, 
									date_recu, 
									charge_recu
					FROM 
									".MAIN_DB_PREFIX."syndic_paiement ".$where ;
		
//     $sql = "select 
//                    rowid,
// 								   num_paiement,
//                    date_paiement, 
//                    mode_paiement, 
//                    affectation_paiement, 
//                    montant_paiement 
//             FROM 
//                    ".MAIN_DB_PREFIX."syndic_paiement ".$where ;

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
                                            $arr[]  = array('id'                    =>$obj->rowid,
																														'num_paiement'          =>$obj->num_paiement,
                                                            'date_paiement'         =>$obj->date_paiement,
                                                            'mode_paiement'         =>$obj->mode_paiement,
                                                            'affectation_paiement'  =>$obj->affectation_paiement,
                                                            'montant_paiement'      =>$obj->montant_paiement,
                                                            'sup'                   => true);
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
								return $sql ;//-1 ;
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
						FROM ".MAIN_DB_PREFIX."syndic_paiement 
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

        $sql = "update ".MAIN_DB_PREFIX."syndic_paiement
																													SET 
																																fk_appartement           = '".$this->fk_appartement."',
																																num_paiement             = '".$this->num_paiement."',
																																date_paiement            = '".$this->date_paiement."',
																																mode_paiement            = '".$this->mode_paiement."',
																																affectation_paiement     = '".$this->affectation_paiement."',
																																montant_paiement         = '".$this->montant_paiement."'
																													WHERE
																																rowid                    = ".$id."
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
                FROM ".MAIN_DB_PREFIX."syndic_paiement 
                WHERE rowid > ".$id." 
                ORDER BY rowid LIMIT 1";
        $resql=$this->db->query($sql);
        $this->db->commit();
        $obj = $this->db->fetch_object($resql);
        $arr_prev_next['next_id'] = $obj->rowid ;

        //Retrieve previous id
        $sql = "SELECT rowid 
                FROM ".MAIN_DB_PREFIX."syndic_paiement 
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
     * *********************** Combo : Retrieve Liste Appartement & dependencies ***********************
     *
     **/
	
	public function fetch_combo_appartement(){
 
		//return 'abc' ;
		$sql = "SELECT 
									".MAIN_DB_PREFIX."syndic_appartement.rowid,
									".MAIN_DB_PREFIX."syndic_paiement.rowid as id_paiement,
									".MAIN_DB_PREFIX."syndic_appartement.num_appartement,
									".MAIN_DB_PREFIX."syndic_proprietaire.nom,
									".MAIN_DB_PREFIX."syndic_proprietaire.prenom 
						FROM 
										".MAIN_DB_PREFIX."syndic_appartement 
									LEFT JOIN 
										".MAIN_DB_PREFIX."syndic_proprietaire 
									ON 
										".MAIN_DB_PREFIX."syndic_appartement.rowid = ".MAIN_DB_PREFIX."syndic_proprietaire.fk_appartement
									LEFT JOIN ".MAIN_DB_PREFIX."syndic_paiement 
									ON 
										".MAIN_DB_PREFIX."syndic_paiement.fk_appartement = ".MAIN_DB_PREFIX."syndic_appartement.rowid ";
		
    $resql=$this->db->query($sql);
	//If error in Sql
	if(!$resql) return 'Erreur innatendue : '.$sql ;
		
	while ($obj = $resql->fetch_object())
		{
										$arr[]  = array('id'              =>$obj->rowid,
																		'id_paiement'			=>$obj->id_paiement,
																		'num_appartement' =>$obj->num_appartement,
																		'nom'    					=>$obj->nom,
																		'prenom'          =>$obj->prenom);
		}
			$arrJson = json_encode($arr);
			return $arrJson ;
   }
    
}