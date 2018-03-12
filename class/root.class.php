<?php
/* Copyright (C) 2016-2018 MarocGeek  <contact@marocgeek.com>
 *
 *This Software Created By MarocGeek Team
 * A software for Manage Syndic Activities
 * SiteWeb : www.marocgeek.com
 *
 */

/**
 *  \ingroup    syndic/class
 *  \brief      Core Methodes here
 */

/**
 *  Class to manage Syndic Root
 */
//SyndicRoot
class SyndicRoot // extends CommonObject
{
	/**
	* Root
	*/
	
	/**
	 *	Constructor
	 *
	 */
	function __construct($db)
	{
		$this->db = $db;
		return 1;
	}

     /**
     * *********************** Fetch/Search Data From database ***********************
     * @Param :
     *          $s -> ( case : search -> string | case fetch -> null )
     * @Return :
     *          Json array of fetched Data
     *
     **/

  public function latest_paiements() {
    
    $sql = "
              SELECT 
                            ".MAIN_DB_PREFIX."syndic_paiement.rowid AS rowid_paiement, 
                            ".MAIN_DB_PREFIX."syndic_propriete.num_propriete AS num_propriete,
                            ".MAIN_DB_PREFIX."syndic_proprietaire.nom AS nom_proprietaire,
                            ".MAIN_DB_PREFIX."syndic_residence.nom AS nom_residence
                    FROM 
                            ".MAIN_DB_PREFIX."syndic_paiement 
                    LEFT JOIN 
                            ".MAIN_DB_PREFIX."syndic_propriete 
                    ON
                            ".MAIN_DB_PREFIX."syndic_paiement.fk_propriete=".MAIN_DB_PREFIX."syndic_propriete.rowid 
                    LEFT JOIN		
                            ".MAIN_DB_PREFIX."syndic_proprietaire
                    ON
                            ".MAIN_DB_PREFIX."syndic_proprietaire.fk_propriete = ".MAIN_DB_PREFIX."syndic_propriete.rowid
                    LEFT JOIN		
                            ".MAIN_DB_PREFIX."syndic_residence
                    ON
                            ".MAIN_DB_PREFIX."syndic_residence.rowid = ".MAIN_DB_PREFIX."syndic_propriete.fk_residence
                    ORDER BY 
                             ".MAIN_DB_PREFIX."syndic_paiement.rowid DESC LIMIT 15

              ";

  $resql=$this->db->query($sql);
	//If error in Sql
	if(!$resql) return 'Erreur innatendue : '.$sql ;
		
	while ($obj = $resql->fetch_object())
		{
										$arr[]  = array('rowid_paiement'      =>$obj->rowid_paiement,
																		'num_propriete'			=>$obj->num_propriete,
																		'nom_proprietaire'    =>$obj->nom_proprietaire,
																		'nom_residence'    		=>$obj->nom_residence);
		}
			$arrJson = json_encode($arr);
			return $arrJson ;
   
 }

	
    
}