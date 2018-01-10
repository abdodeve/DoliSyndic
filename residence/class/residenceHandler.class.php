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
 *  \brief      Prepare methodes for request/ajax request
 */

/**
 *  Class to manage Syndic Residence
 */
//residenceHandler
require '../../../main.inc.php';
require_once 'residence.class.php';


class residenceHandler extends SyndicResidence {

    function execute($data) {

        switch($data->action) {

            case "fetch":
                echo $this->fetch();
                break;
            case "create":
                $this->num_residence       = $data->num_residence;
                $this->nom                 = $data->nom;
                $this->adresse             = $data->adresse ;
                $this->cp_res              = $data->cp_res ;
                $this->ville               = $data->ville ;
                echo $this->create();
                break;
            case "update":
                $this->num_residence       = $data->num_residence;
                $this->nom                 = $data->nom;
                $this->adresse             = addslashes($data->adresse) ;
                $this->cp_res              = $data->cp_res ;
                $this->ville               = $data->ville ;
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
$resHandler = new residenceHandler($db);
$resHandler->execute($posts_data);

