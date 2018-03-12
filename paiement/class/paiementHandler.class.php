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
 *  \brief      Prepare methodes for request/ajax request
 */

/**
 *  Class to manage Syndic Paiement
 */
//paiementHandler
require '../../../main.inc.php';
require_once 'paiement.class.php';


class paiementHandler extends SyndicPaiement {

    function execute($data) {

        switch($data->action) {

            case "fetch":
                echo $this->fetch();
                break;
            case "create":
                $this->fk_propriete          = $data->fk_propriete;
                $this->num_paiement            = $data->num_paiement;
                $this->date_paiement           = $data->date_paiement;
                $this->mode_paiement           = $data->mode_paiement ;
                $this->affectation_paiement    = $data->affectation_paiement ;
                $this->montant_paiement        = $data->montant_paiement ; 
                $this->date_recu               = $data->date_recu ; 
                $this->charge_recu             = $data->charge_recu ; 
                echo $this->create();
                break;
            case "update":
                $this->fk_propriete          = $data->fk_propriete;
                $this->num_paiement            = $data->num_paiement;
                $this->date_paiement           = $data->date_paiement;
                $this->mode_paiement           = $data->mode_paiement ;
                $this->affectation_paiement    = $data->affectation_paiement ;
                $this->montant_paiement        = $data->montant_paiement ;
                $this->date_recu               = $data->date_recu ; 
                $this->charge_recu             = $data->charge_recu ; 
                echo $this->update($data->id);
                break;
            case "delete":
                echo $this->delete($data->arr_ids);
                break;
           case "search":
                echo $this->fetch($data->s);
                break;
           case "single":
                echo $this->fetch(null,$data->id);
                break;
           case "pagination":
                echo $this->next_previous_id($data->id);
                break;
          case "fetch_combo_propriete":
                echo $this->fetch_combo_propriete();
                break;
           case "method3":
                $this->doMethod1();
                break;

        }
    }

    function doMethod1() {
        echo "Foo::doMethod1";
    }

    function doMethod2() {
        echo "Foo::doMethod2";
    }
}
//Request posts data from ajax call
$posts_data_json    = file_get_contents("php://input");
$posts_data         = json_decode($posts_data_json);

//Instance & execute this class
$paieHandler = new paiementHandler($db);
$paieHandler->execute($posts_data);

