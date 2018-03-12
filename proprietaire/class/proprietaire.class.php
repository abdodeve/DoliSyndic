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
		var $fk_propriete ;
		var $nom ;
		var $prenom ;
		var $titre ;
		var $civilite ;
		var $ville ;
    var $adresse_1 ;
    var $adresse_2 ;
    var $email_1 ;
    var $email_2 ;
    var $tel_1 ;
    var $tel_2 ;
	
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
      
		$sql = "INSERT INTO ".MAIN_DB_PREFIX."syndic_proprietaire(
						nom,
						prenom,
						titre,
						civilite,
						ville,
						adresse_1, 
						adresse_2, 
						email_1, 
						email_2, 
						tel_1,
						tel_2,
						fk_propriete
						)
						VALUES (
							'".$this->nom."',
							'".$this->prenom."',
							'".$this->titre."',
							'".$this->civilite."',
							'".$this->ville."',
							'".$this->adresse_1."',
							'".$this->adresse_2."',
							'".$this->email_1."',
							'".$this->email_2."',
							'".$this->tel_1."',
							'".$this->tel_2."',
							'".$this->fk_propriete."'
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
                        nom         		like '%".$s."%' or
                        prenom      		like '%".$s."%' or
                        titre       		like '%".$s."%' or
                        civilite    		like '%".$s."%' or
                        ville       		like '%".$s."%' or
                        adresse_1   		like '%".$s."%' or
                        adresse_2  		  like '%".$s."%' or
                        email_1     		like '%".$s."%' or
                        email_2     		like '%".$s."%' or
                        tel_1       		like '%".$s."%' or
                        tel_2       		like '%".$s."%' or
												num_propriete like '%".$s."%'
                ";

    }elseif (!empty($id)){
        $where = "where ".MAIN_DB_PREFIX."syndic_proprietaire.rowid = {$id}" ;
    }

    $sql = "SELECT        
										".MAIN_DB_PREFIX."syndic_proprietaire.rowid,
										nom, 
										prenom, 
										titre, 
										civilite, 
										ville, 
										adresse_1, 
										adresse_2, 
										email_1, 
										email_2, 
										tel_1, 
										tel_2,
										".MAIN_DB_PREFIX."syndic_propriete.num_propriete
						FROM
										".MAIN_DB_PREFIX."syndic_proprietaire LEFT JOIN ".MAIN_DB_PREFIX."syndic_propriete
						ON
										".MAIN_DB_PREFIX."syndic_proprietaire.fk_propriete = ".MAIN_DB_PREFIX."syndic_propriete.rowid ".$where ;

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
                                            $arr[]  = array('id'        				=>$obj->rowid,
                                                            'nom'      				  =>$obj->nom,
                                                            'prenom'    				=>$obj->prenom,
                                                            'titre'     				=>$obj->titre,
                                                            'civilite'  				=>$obj->civilite,
                                                            'ville'     				=>$obj->ville,
                                                            'adresse_1' 				=>$obj->adresse_1,
                                                            'adresse_2' 				=>$obj->adresse_2,
                                                            'email_1'   				=>$obj->email_1,
                                                            'email_2'   				=>$obj->email_2,
                                                            'tel_1'     				=>$obj->tel_1,
                                                            'tel_2'     				=>$obj->tel_2,
																														'num_propriete'   =>$obj->num_propriete,
                                                            'sup'      				  => true);
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
								return $sql ;//return -1 ;
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
						FROM ".MAIN_DB_PREFIX."syndic_proprietaire 
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

        $sql = "update ".MAIN_DB_PREFIX."syndic_proprietaire
                                                      SET 
                                                            nom         		= '".$this->nom."',
                                                            prenom      		= '".$this->prenom."',
                                                            titre      		  = '".$this->titre."',
                                                            civilite    		= '".$this->civilite."',
                                                            ville       		= '".$this->ville."',
                                                            adresse_1   		= '".$this->adresse_1."',
                                                            adresse_2   		= '".$this->adresse_2."',
                                                            email_1     		= '".$this->email_1."',
                                                            email_2     		= '".$this->email_2."',
                                                            tel_1       		= '".$this->tel_1."',
                                                            tel_2       		= '".$this->tel_2."',
																														fk_propriete	= '".$this->fk_propriete."'
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
                FROM ".MAIN_DB_PREFIX."syndic_proprietaire 
                WHERE rowid > ".$id." 
                ORDER BY rowid LIMIT 1";
        $resql=$this->db->query($sql);
        $this->db->commit();
        $obj = $this->db->fetch_object($resql);
        $arr_prev_next['next_id'] = $obj->rowid ;

        //Retrieve previous id
        $sql = "SELECT rowid 
                FROM ".MAIN_DB_PREFIX."syndic_proprietaire 
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
     * *********************** Combo : Retrieve Liste propriete & dependencies ***********************
     *
     **/
	
	public function fetch_combo_propriete(){
 
		//return 'abc' ;
		$sql = "SELECT 
									".MAIN_DB_PREFIX."syndic_propriete.rowid,
									".MAIN_DB_PREFIX."syndic_propriete.num_propriete,
									".MAIN_DB_PREFIX."syndic_propriete.num_titre,
									".MAIN_DB_PREFIX."syndic_proprietaire.rowid as id_proprietaire
						FROM 
										".MAIN_DB_PREFIX."syndic_propriete 
						LEFT JOIN 
										".MAIN_DB_PREFIX."syndic_proprietaire 
						ON 
										".MAIN_DB_PREFIX."syndic_proprietaire.fk_propriete = ".MAIN_DB_PREFIX."syndic_propriete.rowid";
		
    $resql=$this->db->query($sql);
	//If error in Sql
	if(!$resql) return 'Erreur innatendue : '.$sql ;
		
	while ($obj = $resql->fetch_object())
		{
										$arr[]  = array('id'              =>$obj->rowid,
																		'num_propriete' =>$obj->num_propriete,
																		'num_titre'    		=>$obj->num_titre,
																	 	'id_proprietaire' =>$obj->id_proprietaire);
		}
			$arrJson = json_encode($arr);
			return $arrJson ;
   }
    
}