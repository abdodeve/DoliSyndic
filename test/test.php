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
 *  \brief      Page Display Single Row
 */

require '../../main.inc.php';
?> <link rel="stylesheet" type="text/css" href="/htdocs/syndic/css/bootstrap.min.css"> <?php
llxHeader('', $title='Proprietaire', 'Proprietaire', '', 0, 0, '', '','', '');
include '../header.php';
?>
    <div ng-app="singleApp" ng-controller="singleCtrl" ng-cloak>
      
   <table summary="" class="centpercent notopnoleftnoright" style="margin-bottom: 2px;">
		<tbody>
		<tr>
				<td class="nobordernopadding widthpictotitle" valign="middle">
					<img src="../img/owner-icon.png" alt="" title="" class="valignmiddle" id="pictotitle">
				</td>
				<td class="nobordernopadding valignmiddle" valign="middle">
						<div class="titre">Configuration Syndic</div>
				</td>
    </tr>
    </tbody>
   </table>
      
      
      <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="#tab1" data-toggle="pill">Paramétres</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#tab2" data-toggle="pill">À propos</a>
      </li>
      </ul>
      

          <div class="tab-content configuration" id="pills-tabContent">
            <!--  Tab 1 / Tab Paramètres -->
            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="pills-home-tab">
                  <table class="noborder" width="100%">
                      <tbody>
                          <tr class="liste_titre">
                              <td>Paramètres</td>
                              <td>Valeur</td>
                              <td width="80" align="right">&nbsp;</td>
                          </tr>
                          <tr class="oddeven">
                              <td>Prise en charge des produits virtuels</td>
                              <td>
                                Prise en charge des produits virtuels
                                  <select class="flat" id="activate_sousproduits" name="activate_sousproduits">
                                      <option value="1">Oui</option>
                                      <option value="0" selected="">Non</option>
                                  </select>
                              </td>
                              <td align="right" class="nohover" rowspan="200">
                                <input type="submit" class="button" value="Modifier">
                              </td>
                          </tr>
                          <tr class="oddeven">
                              <td>Prise en charge des produits virtuels</td>
                              <td>
                                Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs  
                              </td>
                          </tr>
                          <tr class="oddeven">
                              <td>Prise en charge des produits virtuels</td>
                              <td>
                                Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs  
                              </td>
                          </tr>
                          <tr class="oddeven">
                              <td>Prise en charge des produits virtuels</td>
                              <td>
                                Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs  
                              </td>
                          </tr>
                          <tr class="oddeven">
                              <td>Prise en charge des produits virtuels</td>
                              <td>
                                Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs  
                              </td>
                          </tr>
                          <tr class="oddeven">
                              <td>Prise en charge des produits virtuels</td>
                              <td>
                                Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs  
                              </td>
                          </tr>
                          <tr class="oddeven">
                              <td>Prise en charge des produits virtuels</td>
                              <td>
                                Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs  
                              </td>
                          </tr>
                          <tr class="oddeven">
                              <td>Prise en charge des produits virtuels</td>
                              <td>
                                Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs Valeurs  
                              </td>
                          </tr>
                      </tbody>
                  </table>
            </div>
            <!--  Tab 2 / Tab A propos -->
            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="tabBar tabBarWithBottom">
                        <div style="float: left; margin-right: 20px;">
                          <img src="../img/syndic_about.png">
                        </div>
                        <a href="http://www.marocgeek.com/" target="_blank"><b>MG-Syndic</b></a> : Une soulution de gestion des locatives
                        <br>
                        <br>Version : 1.0
                        <br>
                        <br>Développé par <a href="http://www.marocgeek.com/" target="_blank">MarocGeek</a>
                        <br>
                        <br>Pour toute question technique , contactez-nous sur <a href="mailto:contact@marocgeek.com">contact@marocgeek.com</a>
                </div>
             </div>
          </div>
              
    </div>


<script>
var singleApp     = angular.module('singleApp', ['ngSanitize','ngRoute']) ;
var singleCtrl    = singleApp.controller('singleCtrl', ['$scope','$http', func_singleCtrl]);

function func_singleCtrl ($scope,$http,$location) {
   
}
</script>