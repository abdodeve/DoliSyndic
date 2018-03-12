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
 *  \brief      Prepare methodes for request/ajax request
 */

/**
 *  Class to manage Syndic Root
 */
//rootHandler
require '../../main.inc.php';
require_once 'root.class.php';


class rootHandler extends SyndicRoot {

    function execute($data) {

        switch($data->action) {

            case "latest_paiements":
                echo $this->latest_paiements();
                break;
            case "demo":
                echo $this->demo();
                break;
        }
    }
}
//Request posts data from ajax call
$posts_data_json    = file_get_contents("php://input");
$posts_data         = json_decode($posts_data_json);

//Instance & execute this class
$paieHandler = new rootHandler($db);
$paieHandler->execute($posts_data);

