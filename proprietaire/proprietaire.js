/*******************
* Init Table
********************/
$("#table_proprietaire").tabulator({
    height:205, // set height of table, this enables the Virtual DOM and improves render speed dramatically (can be any valid css height value)
    layout:"fitColumns", //fit columns to width of table (optional)
    columns:[ //Define Table Columns
        {title:"Nom", field:"nom"},
        {title:"Prenom", field:"prenom"},
        {title:"<input id='check-all' type='checkbox' ng-click='select_all_func()' />",
                            field:"sup",
                            formatter:"tickCross",
                            //sorter:"boolean",
                            //editor:true,
                            headerSort:false,
                            cellClick:function(e, cell){

                                      cell.setValue(!cell.getValue());
                                return false;
                                }
        }
    ],
    rowClick:function(e, row){ //trigger an alert message when the row is clicked
        //alert("Row " + row.getData().id + " Clicked!!!!");
    }
});




/*
******************
*Interface MAJ
******************
*/
var majApp     = angular.module('majApp', []) ;
var majCtrl  = majApp.controller('majCtrl', ['$scope','$http', func_majCtrl]);

function func_majCtrl ($scope,$http) {

    //Default
    $scope.titre_page = 'Nouveau proprietaire' ;

    //Check if id exist in url
    //If exist populae form else let them empty
    var the_id ;
    $.urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if(results == null)
            return null ;
        else
            return results[1] || 0;
    }
    the_id = $.urlParam('id');
    alert(the_id);
    if(the_id != null)
    {
        $scope.titre_page = 'Modifier proprietaire' ;
        var ajaxUrl = window.location.origin+"/htdocs/syndic/proprietaire/class/proprietaireHandler.class.php" ;
        var req = $http({
            method  :   'POST',
            url     :   ajaxUrl,
            data    :   {action:"search",s: the_id}
        });
        req.then(function mySuccess(response) {
                console.log('Succes get data');
                console.log(response.data);
                $scope.nom          = response.data[0].nom;
                $scope.prenom       = response.data[0].prenom;
                $scope.titre        = response.data[0].titre;
                $scope.civilite     = response.data[0].civilite;
                $scope.ville        = response.data[0].ville;
            },
            function myError(response) {
                console.log('Error get data');
                console.log(response);
            });
    }

    //Button Valider
    $scope.funcValider = function() {

    // Id populated in url
    // Update/Edition
        if (the_id != null) {
            var ajaxUrl = window.location.origin + "/htdocs/syndic/proprietaire/class/proprietaireHandler.class.php";
            var req = $http({
                method: 'POST',
                url: ajaxUrl,
                data: {
                    action  : "update",
                    id      : the_id,
                    nom     : $scope.nom,
                    prenom  : $scope.prenom,
                    titre   : $scope.titre,
                    civilite: $scope.civilite,
                    ville   : $scope.ville
                }
            });
            req.then(function mySuccess(response) {
                    console.log('Success Valide update data');
                    console.log(response);
                },
                function myError(response) {
                    console.log('Fail Valide update data');
                    console.log(response);
                });
        }
        else{
            //Id empty in url
            //Insert/Creation
            var ajaxUrl = window.location.origin + "/htdocs/syndic/proprietaire/class/proprietaireHandler.class.php";
            var req = $http({
                method: 'POST',
                url: ajaxUrl,
                data: {
                    action: "create",
                    nom: $scope.nom,
                    prenom: $scope.prenom,
                    titre: $scope.titre,
                    civilite: $scope.civilite,
                    ville: $scope.ville
                }
            });
            req.then(function mySuccess(response) {
                    console.log('Success Valide data');
                    console.log(response);
                },
                function myError(response) {
                    console.log('Fail Valide data');
                    console.log(response);
                });
        }
}}

/*
***************************
*Interface UI liste
***************************
*/
var listeApp     = angular.module('listeApp', []) ;
var listeCtrl    = listeApp.controller('listeCtrl', ['$scope','$http', func_listeCtrl]);

function func_listeCtrl ($scope,$http) {
    /*
     * On load Fill table
     */
    function load() {
        var ajaxUrl = window.location.origin + "/htdocs/syndic/proprietaire/class/proprietaireHandler.class.php";
        var req = $http({
            method: 'POST',
            url: ajaxUrl,
            data: {action: "fetch"}
        });
        req.then(function mySuccess(response) {
                var tabledata = response.data;
                //load data into the table
                $("#table_proprietaire").tabulator("setData", tabledata);
            },
            function myError(response) {
                console.log('Fail load data into table');
                console.log(response);
            });
    }

    load();

    /*
     * Search btn
     */
    $scope.search_func = function () {
        var ajaxUrl = window.location.origin + "/htdocs/syndic/proprietaire/class/proprietaireHandler.class.php";
        var req = $http({
            method: 'POST',
            url: ajaxUrl,
            data: {action: "search", s: $scope.s}
        });
        req.then(function mySuccess(response) {
                var tabledata = response.data;
                //load sample data into the table
                $("#table_proprietaire").tabulator("setData", tabledata);
            },
            function myError(response) {
                console.log('Error Search btn');
            });
    }
    /*
     * Confirm btn delete event
     */
    $scope.confirm_func = function () {

        if ($scope.select_action != 'confirm') return;
        $scope.confirm = "Suppression Encours ...";
        var listChecked = [];
        var listAll = $("#table_proprietaire").tabulator("getData");
        angular.forEach(listAll, function (value, key) {
            if (value.sup === false) {
                listChecked.push(value.id);
            }
        });

        var ajaxUrl = window.location.origin + "/htdocs/syndic/proprietaire/class/proprietaireHandler.class.php";
        var req = $http({
            method: 'POST',
            url: ajaxUrl,
            data: {action: "delete", arr_ids: listChecked}
        });
        req.then(function mySuccess(response) {
                console.log('Succes Delete : ' + response.data);
                load();
                $scope.confirm = "Confirmer";
            },
            function myError(response) {
                console.log('Error Delete : ' + response.data);
            });
    }


    /*
     *Check/Un-check all
     */
    $scope.select_all_func = function () {
        var dataUpdate = [];
        var productData = $("#table_proprietaire").tabulator("getData");

        if ($('#check-all').prop("checked")) {
            $.each(productData, function (i, item) {
                var obj = {
                    "id": item.id,
                    "nom": item.nom,
                    "prenom": item.prenom,
                    "sup": false
                };
                dataUpdate.push(obj);
            });
        }
        else {
            $.each(productData, function (i, item) {
                var obj = {
                    "id": item.id,
                    "nom": item.nom,
                    "prenom": item.prenom,
                    "sup": true
                };
                dataUpdate.push(obj);
            });
        }
        $("#table_proprietaire").tabulator("updateData", dataUpdate);
    };
}
// $('document').ready(function(){
  
//   $("#check-all").on("change", function(){
//   alert('test');
//   });
  
// });
