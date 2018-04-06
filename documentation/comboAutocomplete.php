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
 *  \brief      Page mise a jour des données
 */

require '../../main.inc.php';
?>
    <link rel="stylesheet" type="text/css" href="/htdocs/syndic/css/bootstrap-4.min.css">
<?php
llxHeader('',$title='Mise à jour paiement');
include '../header.php';
?>


<div ng-app="majApp" ng-controller="majCtrl" ng-cloak>
	
	<h1>Custom Select Example</h1>
	<h2>Simple objects</h2>
<!-- 	<p>Selected fruit: {{ fruit }}</p> -->
	<button type="button" class="btn" ng-click="setToMango()">Set to mango</button> 
	
<div custom-select="f for f in fruits | filter: $searchTerm" ng-model="fruit" autofocus></div>
	
<div custom-select="t as t.name for t in people | filter: $searchTerm " ng-model="person">
	<div class="pull-left" style="width: 40px">
		<img ng-src="{{ t.picture }}" style="width: 30px" />
	</div>
	<div class="pull-left">
		<strong>{{ t.name }}</strong><br />
		<span>{{ t.phone }}</span>
	</div>
	<div class="clearfix"></div>
</div>
	
</div>

<?php
llxFooter();
?>

<script>
//AngularJS
var majApp     = angular.module('majApp',['AxelSoft']) ;
var majCtrl    = majApp.controller('majCtrl', ['$scope', func_majCtrl]);

function func_majCtrl ($scope) {
	
  $scope.fruits = ['apple', 'orange', 'mango', 'grapefruit', 'banana', 'melon'];
	$scope.setToMango = function () {
																		//$scope.fruit = 'mango';
																		console.log($scope.person);
																	};

	$scope.people = [
	{ name: 'John Doe', phone: '555-123-456', picture: 'http://www.saintsfc.co.uk/images/common/bg_player_profile_default_big.png' },
	{ name: 'Axel Zarate', phone: '888-777-6666', picture: 'https://avatars0.githubusercontent.com/u/4431445?s=60' },
	{ name: 'Walter White', phone: '303-111-2222', picture: 'http://upstreamideas.org/wp-content/uploads/2013/10/ww.jpg' }
];
}
	
</script>

<?php

$db->close();