<?php
/* Copyright (C) 2016-2018 Laurent Destailleur  <abdelhadi.deve@gmail.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 */

/**
 *  \file       htdocs/syndic/class/proprietaireHandler.class.php
 *  \ingroup    syndic
 *  \brief      This file is an example for a class file
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
                $this->nom      = $data->nom;
                $this->prenom   = $data->prenom ;
                $this->titre    = $data->titre ;
                $this->ville    = $data->ville ;
                $this->civilite = $data->civilite ;
                echo $this->create();
                break;
            case "update":
                $this->nom      = $data->nom;
                $this->prenom   = $data->prenom ;
                $this->titre    = $data->titre ;
                $this->ville    = $data->ville ;
                $this->civilite = $data->civilite ;
                echo $this->update($data->id);
                break;
            case "delete":
                echo $this->delete($data->arr_ids);
                break;
           case "search":
                echo $this->fetch($data->id);
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
$propHandler = new proprietaireHandler($db);
$propHandler->execute($posts_data);
