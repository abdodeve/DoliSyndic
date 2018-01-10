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
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formfile.class.php';

?>

<?php

llxHeader();
?>


<div ng-app="searchModule" ng-controller="searchController">
  <h1>Angular Live Search</h1>

  <!-- Search -->
  <input type="text" placeholder="Search" ng-model="query" ng-focus="focus=true">
  <div id="search-results" ng-show="focus">
    <div class="search-result" ng-repeat="item in data | search:query" ng-bind="item" ng-click="setQuery(item)"></div>
  </div>


</div>
   
<?php
llxFooter();
?>

<script>

var app = angular.module('searchModule', []);

// Defines the search controller by bringing the data into the scope.
//
app.controller('searchController', function($scope) {
  
    var data = [
  'AngularJS',
  'C',
  'C++',
  'C#',
  'CoffeeScript',
  'CSS',
  'Go',
  'HTML',
  'Jade',
  'Java',
  'JavaScript',
  'LESS',
  'Node.js',
  'Objective-C',
  'Sass/SCSS',
  'Stylus',
  'Swift'
];
  
  $scope.data = data;

  $scope.setQuery = function(query) {
    $scope.query = query;
    $scope.focus = false;
  };
});

// Returns the search function that will perform the filter on the data.
//
app.filter('search', function() {
  return search;
});

// Returns an array of items where the item text matches the search query. In
// this example, both the query and item are converted to lower case for easier
// matching.
//
function search(arr, query) {
  if (!query) {
    return arr;
  }

  var results = [];
  query = query.toLowerCase();

  angular.forEach(arr, function(item) {
    if (item.toLowerCase().indexOf(query) !== -1) {
      results.push(item);
    }
  });

  return results;
};

</script>
   
<?php
$db->close();