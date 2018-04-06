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

<div ng-app="app" ng-controller="majCtrl">

<input type="text" ng-model="date" jqdatepicker />
<br/>
{{ date }}

</div>

<?php
llxFooter();
?>

<script>

var majApp = angular.module('app', []);

//Create directive for merge Jquery Ui and AngularJS
majApp.directive('jqdatepicker', function () {
    return {
              restrict: 'A',
              link    : function (scope, element, attrs, ngModelCtrl) {
                          element.datepicker({ });
                        }
           };
});
var majCtrl    = majApp.controller('majCtrl', ['$scope', func_majCtrl]);

function func_majCtrl ($scope) {
	
}

  
</script>

<?php

$db->close();