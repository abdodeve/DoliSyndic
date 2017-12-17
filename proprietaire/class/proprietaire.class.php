<?php
/* Copyright (C) 2016-2018 Laurent Destailleur  <abdelhadi.deve@gmail.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 */

/**
 *  \file       htdocs/syndic/class/syndic-proprietaire.class.php
 *  \ingroup    syndic
 *  \brief      This file is an example for a class file
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
	 *  Create record into database
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
					return $resql;
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
    $sql = "SELECT 
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
	
	public function delete($arr_ids = null){
		$ids ='' ;
		foreach($arr_ids as $key => $value){
			$ids .= $key == 0 ? '' : ',' ;
			$ids .= $value ;
		}
		$sql = "delete 
						from ".MAIN_DB_PREFIX."proprietaire 
						where 
							  rowid in (".$ids.");";
		 	$resql=$this->db->query($sql);
		if ($resql)
		{
			if (!$error)
			{
				$this->db->commit();
				return $resql;
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
     * Update
     */
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
    function show(){
		return 'abdo' ;
	}
    
}