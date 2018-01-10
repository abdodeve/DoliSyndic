<?php
/* Copyright (C) 2016-2018 MarocGeek  <contact@marocgeek.com>
 *
 *This Software Created By MarocGeek Team
 * A software for Manage Syndic Activities
 * SiteWeb : www.marocgeek.com
 *
 */

/**
 *  \ingroup    syndic/appartement
 *  \brief      Prepare methodes for request/ajax request
 */

/**
 *  Class to manage Syndic Appartement
 */
//appartementHandler
require '../../../main.inc.php';
require_once 'appartement.class.php';



class appartementHandler extends SyndicAppartement {

    function execute($data) {

        switch($data->action) {

            case "fetch":
                echo $this->fetch();
                break;
            case "create":
                $this->fk_residence         = $data->fk_residence ;
                $this->num_appartement      = $data->num_appartement ;
                $this->num_titre            = $data->num_titre ;
                $this->quote_part_terrain   = $data->quote_part_terrain ;
                $this->surface              = $data->surface ;
                $this->pt_indivision        = $data->pt_indivision ;
                echo $this->create();
                break;
            case "update":
                $this->fk_residence         = $data->fk_residence ;
                $this->num_appartement      = $data->num_appartement ;
                $this->num_titre            = $data->num_titre ;
                $this->quote_part_terrain   = $data->quote_part_terrain ;
                $this->surface              = $data->surface ;
                $this->pt_indivision        = $data->pt_indivision ;
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
$apparHandler = new appartementHandler($db);
$apparHandler->execute($posts_data);

