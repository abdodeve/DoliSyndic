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

 *  \brief      Page Display Single Row

 */



require '../../main.inc.php';

?> <link rel="stylesheet" type="text/css" href="/htdocs/syndic/css/bootstrap.min.css"> <?php

llxHeader('', $title='Residence', 'Residence', '', 0, 0, '', '','', '');
include '../header.php';

?>



    <div ng-app="singleApp" ng-controller="singleCtrl" ng-cloak>



        <div class="tabBar">

            <div class="arearef heightref valignmiddle" width="100%">

                <!-- Start banner content -->

                <div style="vertical-align: middle">

                    <div class="pagination">

                        <ul>

                            <li class="noborder litext"><a href="/htdocs/syndic/residence/liste.php">Retour liste</a></li>

                            <!-- <span class="inactive"></span>-->

                            <li class="pagination">

                                <a ng-href='{{url_previous}}' ng-click="func_previous()" ng-attr-id="{{id_previous}}" ng-class="class_previous">

                                    <i class="fa fa-chevron-left"></i>

                                </a>

                            </li>

                            <li class="pagination">

                                <a ng-href='{{url_next}}' ng-click="func_next()" ng-attr-id="{{id_next}}" ng-class="class_next">

                                    <i class="fa fa-chevron-right"></i>

                                </a>

                            </li>

                        </ul>

                    </div>



                    <div class="inline-block floatleft">



                        <div class="floatleft inline-block valignmiddle divphotoref">

                            <!-- ErrorFetchBarcode -->

                        </div>

                    </div>

                    <div class="inline-block floatleft valignmiddle refid refidpadding" style="text-transform: capitalize;">

                        {{nom}} {{ville}}
                        <input type="hidden" ng-model="id">

                        <div class="refidno">{{adresse}}</div>

                    </div>

                </div>

                <!-- End banner content -->

            </div>

            <div class="underrefbanner clearboth"></div>

            <div class="fichecenter">

                <div class="fichehalfleft">

                    <div class="underbanner clearboth"></div>

                    <table class="border tableforfield" width="100%">

                        <tbody>

                        <tr>

                            <td class="nowrap"><b>Nom residence</b></td>

                            <td>{{nom}}</td>

                        </tr>

                        <tr>

                            <td class="nowrap"><b>Adresse</b></td>

                            <td>{{adresse}}</td>

                        </tr>

                        <tr>

                            <td class="nowrap"><b>Cp residence</b></td>

                            <td>{{cp_res}}</td>

                        </tr>

                        <tr>

                            <td class="nowrap"><b>Ville</b></td>

                            <td>{{ville}}</td>

                        </tr>

                        </tbody>

                    </table>

                </div>



            </div>

            <div style="clear:both"></div>

        </div>



        <div class="tabsAction">

            <div class="inline-block divButAction"><a class="butAction" href="/htdocs/syndic/residence/maj.php?id={{id}}">Modifier</a></div>

            <div class="inline-block divButAction">

                <button class="butAction" data-toggle="modal" data-target="#confirmModal">Supprimer</button>

            </div>

        </div>



        <!-- Modal -->

        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title" id="exampleModalLabel">Suppression d'un residence</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                        </button>

                    </div>

                    <div class="modal-body">

                        Êtes-vous sûr de vouloir supprimer ce residence ?

                    </div>

                    <div class="modal-footer">

                        <button ng-click="delete()" class="btn btn-danger" style="text-decoration: none;">Oui</button>

                        <button type="button" class="btn btn-info" data-dismiss="modal">Non</button>

                    </div>

                </div>

            </div>

        </div>



    </div>





<?php





llxFooter();

?>

    <script src="script.js"></script>

<?php

$db->close();