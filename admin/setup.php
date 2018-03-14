<?php
/* Copyright (C) 2016-2018 MarocGeek  <contact@marocgeek.com>
 *
 *This Software Created By MarocGeek Team
 * A software for Manage Syndic Activities
 * SiteWeb : www.marocgeek.com
 *
 */

/**
 *  \ingroup    syndic/admin
 *  \brief      Page Display setup Row
 */

require '../../main.inc.php';
?>
<link rel="stylesheet" type="text/css" href="/htdocs/syndic/css/bootstrap-4.min.css"> 
<?php
llxHeader('', $title='Proprietaire', 'Proprietaire', '', 0, 0, '', '','', '');
include '../header.php';
?>
    <div ng-app="setupApp" ng-controller="setupCtrl" ng-cloak>
      
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
                              <td>Penalite</td>
                              <td>
																 <form class="row radio_input">
																	 	<div class="col-md-4">
																			<label for="penalite_static">Penalite statique
																				<div class="input-group">
																							<div class="input-group-prepend">
																								<div class="input-group-text">
																									<input type="radio" id="penalite_static" name="penalite" ng-model="is_penalite_static" value="1">
																								</div>
																							</div>
																					<input type="text" class="form-control" placeholder="Penalite statique" ng-model="penalite_static_frais" ng-disabled="is_penalite_static==1 ? false : true">
																				</div>
																			</label>
																		</div>
																		<div class="col-md-4">
																				<label for="penalite_dynamic">Penalite dynamique
																					<div class="input-group">
																							<div class="input-group-prepend">
																								<div class="input-group-text">
																								<input type="radio" id="penalite_dynamic" name="penalite" ng-model="is_penalite_static" value="0">
																								</div>
																							</div>
																						<input type="text" class="form-control" placeholder="Penalite dynamique" ng-model="penalite_dynamic_taux" ng-disabled="is_penalite_static==0 ? false : true">
																					</div>
																				</label>
																		 </div>
																	</form>
                              </td>
                              <td class="right" align="right" class="nohover" rowspan="200">
                                <input type="submit" class="button" value="Modifier" ng-click="func_update()">
                              </td>
                          </tr>
                          <tr class="oddeven">
                              <td>Charges</td>
                              <td>
                                <form class="row radio_input">
																			<div class="col-md-4">
																				<label for="budget">Budget
																						<input type="text" id="budget" ng-model="budget" class="form-control">
																				</label>
																			</div>
																			<div class="col-md-4">
																				<label for="taux_tantieme">Taux tantieme
																						<input type="text" id="taux_tantieme" ng-model="taux_tantieme" class="form-control">
																				</label>
																			</div>
																			<div class="col-md-4">
																				<label for="totale_tantieme">Totale tantieme
																						<input type="text" id="totale_tantieme" ng-model="totale_tantieme" class="form-control">
																				</label>
																			</div>
																</form>
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
                          <img class="img-responsive" src="../img/syndic_about.png">
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

<!-- Alert -->
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<script src="script.js"></script>