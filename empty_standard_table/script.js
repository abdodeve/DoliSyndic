/*
 ***********************************************************************************
 *                                      INTERFACE MAJ
 ***********************************************************************************
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
                console.log(response);
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
        window.location = "liste.php" ;
    }}

/*
 ***********************************************************************************
 *                                      INTERFACE UI LISTE
 ***********************************************************************************
 */
/*******************
 * Init Table
 ********************/
$("#table_proprietaire").tabulator({
    pagination:"local", //enable local pagination.
    paginationSize:20, //Number of rows
    layout:"fitColumns", //fit columns to width of table (optional)
    langs:{
        "fr-fr": {
                    "pagination": {
                                    "first": "Premier",
                                    "first_title": "Premier Page",
                                    "last": "Dernier",
                                    "last_title": "Dernier Page",
                                    "prev": "Précédent",
                                    "prev_title": "Précédent Page",
                                    "next": "Prochain",
                                    "next_title": "Prochain Page"
                                    }
        }
    },
    columns:[ //Define Table Columns
        {title:"Nom", field:"nom", headerFilter:true},
        {title:"Prenom", field:"prenom", headerFilter:true},
        {title:"<input id='check-all' type='checkbox' ng-click='select_all_func()' />",
            field:"sup",
            formatter:"tickCross",
            width:35,
            headerSort:false,
            cellClick:function(e, cell){

                cell.setValue(!cell.getValue());
                return false;
            }
        }
    ],
    /****************************
     * On Row Double Click
     ***************************/
    rowDblClick:function(e, row){
        var url = "single.php#!?id="+row.getData().id ;
        window.location = url;
    }
});
//set tabulator to french
$("#table_proprietaire").tabulator("setLocale", "fr-fr");


/****************************
 * liste Ctrl Function
 ***************************/
var listeApp     = angular.module('listeApp', []) ;
var listeCtrl    = listeApp.controller('listeCtrl', ['$scope','$http', func_listeCtrl]);

function func_listeCtrl ($scope,$http) {

    /****************************
     * On load Fill table
     ***************************/
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

    /****************************
     * Search btn
     ***************************/
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

    /****************************
     * Confirm btn delete event
     ***************************/
    $scope.confirm_func = function () {
        //Check if delete selected
        if ($scope.select_action != 'delete') return;

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
                //Loop Remove deleted rows front-end
                angular.forEach(listChecked, function (value, key) {
                    $("#table_proprietaire").tabulator("deleteRow", value);
                });
                $scope.select_action = '0' ;
                $scope.confirm = "Confirmer";
            },
            function myError(response) {
                console.log('Error Delete : ' + response.data);
            });
    }

    /****************************
     * Check/Un-check all
     ***************************/
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

/*
 ***********************************************************************************
 *                                      INTERFACE SINGLE
 ***********************************************************************************
 */

var singleApp     = angular.module('singleApp', ['ngSanitize','ngRoute']) ;
var singleCtrl    = singleApp.controller('singleCtrl', ['$scope','$http', func_singleCtrl]);

function func_singleCtrl ($scope,$http,$location) {

    /***************************************************************************
     * Load/Init : If ID exist in url populae the form else let them empty
     *************************************************************************/
    function init (the_id = null) {

        //if Null Mean Param come from url on reload page
        if(the_id == null){
            $.urlParam = function(name){
                var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
                if(results == null)
                    return null ;
                else
                    return results[1] || 0;
            }
            the_id = $.urlParam('id');
        }

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
                    console.log(response);
                    $scope.id           = response.data[0].id;
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


        /***************************************************************************
         * Pagination
         *************************************************************************/
        var ajaxUrl = window.location.origin+"/htdocs/syndic/proprietaire/class/proprietaireHandler.class.php" ;
        var req = $http({
            method  :   'POST',
            url     :   ajaxUrl,
            data    :   {action:"pagination",id: the_id}
        });
        req.then(function mySuccess(response) {
                console.log('Succes pagination');
                console.log(response);

                //Populate Previous link
                switch (response.data.previous_id) {
                    case null :
                                  $scope.class_previous = "inactive" ;
                                  $scope.url_previous    =  "#";
                                  break ;
                    default :
                                  $scope.class_previous = "" ;
                                  $scope.id_previous     =  response.data.previous_id ;
                                  $scope.url_previous    =  "#!?id="+response.data.previous_id ;
                                  break ;
                }
                //Populate Next link
                switch (response.data.next_id) {
                    case null :
                                 $scope.class_next = "inactive" ;
                                 $scope.url_next        =   "#";
                                 break ;
                    default :
                                $scope.class_next = "" ;
                                $scope.id_next         =  response.data.next_id ;
                                $scope.url_next        =  "#!?id="+response.data.next_id ;
                                 break ;
                }

            },
            function myError(response) {
                console.log('Error pagination');
                console.log(response);
            });
    }
    //Call init function
    init (null);

    //Onclick Previous
    $scope.func_previous = function(){
        id = $scope.id_previous ;
        init(id);
    };

    //Onclick Next
    $scope.func_next = function(){
        id = $scope.id_next ;
        init(id);
    };

    //Delete Row
    $scope.delete = function(){
        id = $scope.id ;

      // Ajax Request for delete this Row
        var ajaxUrl = window.location.origin + "/htdocs/syndic/proprietaire/class/proprietaireHandler.class.php";
        var req = $http({
            method: 'POST',
            url: ajaxUrl,
            data: {action: "delete", arr_ids: [id]}
        });
        req.then(function mySuccess(response) {
                console.log('Succes Delete : ' + response.data);
            },
            function myError(response) {
                console.log('Error Delete : ' + response.data);
            });
        window.location = 'liste.php' ;

    }

}