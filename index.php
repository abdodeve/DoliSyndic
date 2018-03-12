<?php
/* Copyright (C) 2016-2018 MarocGeek  <contact@marocgeek.com>

 *

 *This Software Created By MarocGeek Team

 * A software for Manage Syndic Activities

 * SiteWeb : www.marocgeek.com

 *

 */
/**
 *   	\file       htdocs/admin/index.php
 *		\brief      Home page of setup area
 */
require '../main.inc.php';

llxHeader('', $title='E-Syndic', 'E-Syndic');
include 'header.php';

?>
<table summary="" class="centpercent notopnoleftnoright" style="margin-bottom: 2px;">
		<tbody>
			<tr>
				<td class="nobordernopadding widthpictotitle" valign="middle">
					<img src="../syndic/img/object_syndic.png" alt="" title="" class="valignmiddle" id="pictotitle">
				</td>
				<td class="nobordernopadding" valign="middle">
					<div class="titre">Gestion Résidence</div>
				</td>
			</tr>
		</tbody>
</table>

<h1>E-Syndic soulution de gestion des locatives</h1>

<div class="fichethirdleft" ng-app="indexApp" ng-controller="indexCtrl" ng-cloak>
	<table class="noborder" width="100%">
		<tr class="liste_titre">
		<th colspan="6">Les 15 derniers paiements</th>
		</tr>
		<tr class="liste_titre">
				<th>Ref. Paiement</th>
				<th>Nom proprietaire</th>
				<th>Nom residence</th>
				<th>Num propriete</th>
		</tr>
		<tr class="oddeven" ng-repeat="x in liste_paiements">
			<td class="nowrap"><a href="paiement/single.php#!?id={{x.rowid_paiement}}" target="_blank">{{x.rowid_paiement}}</a></td>
			<td class="nowrap">{{x.nom_proprietaire}}</td>
			<td class="nowrap">{{x.nom_residence}}</td>
			<td class="nowrap">{{x.num_propriete}}</td>
		</tr>
	</table> 
</div>

<?php
llxFooter();
?>
<script>

	/*
 ***********************************************************************************
 *                                      INTERFACE INDEX
 ***********************************************************************************
 */

var indexApp     = angular.module('indexApp', ['ngSanitize','ngRoute']) ;
var indexCtrl    = indexApp.controller('indexCtrl', ['$scope','$http', func_indexCtrl]);

function func_indexCtrl ($scope,$http,$location) {

    /***************************************************************************
     * Load Latest paiements
     *************************************************************************/
   	      var ajaxUrl = window.location.origin+"/htdocs/syndic/class/rootHandler.class.php" ;
            var req = $http({
                method  :   'POST',
                url     :   ajaxUrl,
                data    :   {action:"latest_paiements"}
            });
            req.then(function mySuccess(response) {
                    console.log('Succes get data');
                    console.log(response);
										$scope.liste_paiements = response.data ;
//                     $scope.id                      = response.data[0].id;
//                     $scope.num_paiement            = response.data[0].num_paiement;
//                     $scope.date_paiement           = response.data[0].date_paiement;
//                     $scope.mode_paiement           = response.data[0].mode_paiement;
//                     $scope.affectation_paiement    = response.data[0].affectation_paiement;
//                     $scope.montant_paiement        = response.data[0].montant_paiement;
// 										$scope.num_propriete       	 = response.data[0].num_propriete;
// 										$scope.date_recu        			 = response.data[0].date_recu;
// 										$scope.charge_recu        	   = response.data[0].charge_recu;
                },
                function myError(response) {
                    console.log('Error get data');
                    console.log(response);
                });
}
</script>
