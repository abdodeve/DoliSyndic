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
 *  \brief      Prepare methodes for request/ajax request
 */

/**
 *  Class to manage Syndic Proprietaire
 */
//proprietaireHandler
require '../../../main.inc.php';
require_once 'proprietaire.class.php';



class proprietaireHandler extends SyndicProprietaire {

    function execute($data) {

        switch($data->action) {

            case "fetch":
                echo $this->fetch();
                break;
            case "create":
                $this->nom              = $data->nom;
                $this->prenom           = $data->prenom ;
                $this->titre            = $data->titre ;
                $this->ville            = $data->ville ;
                $this->civilite         = $data->civilite ;
                $this->adresse_1        = $data->adresse_1 ;
                $this->adresse_2        = $data->adresse_2 ;
                $this->email_1          = $data->email_1 ;
                $this->email_2          = $data->email_2 ;
                $this->tel_1            = $data->tel_1 ;
                $this->tel_2            = $data->tel_2 ;
                $this->fk_propriete   = $data->fk_propriete;
                echo $this->create();
                break;
            case "update":
                $this->nom              = $data->nom;
                $this->prenom           = $data->prenom ;
                $this->titre            = $data->titre ;
                $this->ville            = $data->ville ;
                $this->civilite         = $data->civilite ;
                $this->adresse_1        = $data->adresse_1 ;
                $this->adresse_2        = $data->adresse_2 ;
                $this->email_1          = $data->email_1 ;
                $this->email_2          = $data->email_2 ;
                $this->tel_1            = $data->tel_1 ;
                $this->tel_2            = $data->tel_2 ;
                $this->fk_propriete   = $data->fk_propriete;
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
            default  :
              echo 'test' ;
            break ;

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
$propHandler = new proprietaireHandler($db);
$propHandler->execute($posts_data);

