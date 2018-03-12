/*
 ***********************************************************************************
 *                                      INTERFACE MAJ
 ***********************************************************************************
 */
//Init Date Paiement
  $( "#date_paiement" ).datepicker();
	$( "#date_recu" ).datepicker();

// Populate Combo propriete
if(window.location.pathname == '/htdocs/syndic/paiement/maj.php'){
//Get url param
		 var the_id ;
			$.urlParam = function(name){
					var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
					if(results == null)
							return null ;
					else
							return results[1] || 0;
			}
			the_id = $.urlParam('id');

	var ajaxUrl = window.location.origin+"/htdocs/syndic/paiement/class/paiementHandler.class.php" ;
  $.ajax({
					async   		: false,
					method  		: 'POST',
					contentType	: "application/json",
				  dataType		: "json",
					url     		: ajaxUrl,
					data    		: JSON.stringify({action:"fetch_combo_propriete"}),
					success 		: function(data) {
																				console.log('Populate combo propriete');
																				console.log(data);
																				var propriete="",isSelected="" ;
						
																				data.forEach(function(element) {
																					
																					//Selected row in drop downliste
																					if(the_id){
																								isSelected = (element.id_paiement == the_id) ? 'selected' : '' ; //if ID in url identic with Curr Id
																					}
																					
																					propriete += '<li class="filter-item items '+isSelected+'" data-filter="'+element.num_propriete+' - '+element.nom+' - '+element.prenom+'" data-value="'+element.id+'">'+element.num_propriete+'</li>';
																				});
																				$('#ul_propriete').append(propriete);
																			 },
					error				: function(data){
																		console.log('Error : ');
																		console.log(data);
																	}
    });
}
//AngularJS
var majApp     = angular.module('majApp', []) ;
var majCtrl    = majApp.controller('majCtrl', ['$scope','$http', func_majCtrl]);

function func_majCtrl ($scope,$http) {
	
    //Default
    $scope.titre_page = 'Nouveau paiement' ;

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
        $scope.titre_page = 'Modifier paiement' ;
        var ajaxUrl = window.location.origin+"/htdocs/syndic/paiement/class/paiementHandler.class.php" ;
        var req = $http({
            method  :   'POST',
            url     :   ajaxUrl,
            data    :   {action:"single",id: the_id}
        });
        req.then(function mySuccess(response) {
                console.log('Succes get data');
                console.log(response);
					
								//Set Current DatePicker
								$( "#date_paiement" ).datepicker( "setDate", response.data[0].date_paiement );
								$( "#date_recu" ).datepicker( "setDate", response.data[0].date_recu );
                $scope.num_paiement            = response.data[0].num_paiement;
                $scope.mode_paiement           = response.data[0].mode_paiement;
                $scope.affectation_paiement    = response.data[0].affectation_paiement;
                $scope.montant_paiement        = response.data[0].montant_paiement;
								$scope.charge_recu        		 = response.data[0].charge_recu;
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
            var ajaxUrl = window.location.origin + "/htdocs/syndic/paiement/class/paiementHandler.class.php";
            var req = $http({
                method: 'POST',
                url: ajaxUrl,
                data: {
                    action                  : "update",
                    id                      : the_id,
										fk_propriete 				  : $( "#ul_propriete .selected" ).attr( "data-value" ) ,
                    num_paiement            : $scope.num_paiement,
                    date_paiement           : $( "#date_paiement" ).val(),
                    mode_paiement           : $scope.mode_paiement,
                    affectation_paiement    : $scope.affectation_paiement,
                    montant_paiement        : $scope.montant_paiement,
									  date_recu          		  : $( "#date_recu" ).val(),
										charge_recu        			: $scope.charge_recu

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
            var ajaxUrl = window.location.origin + "/htdocs/syndic/paiement/class/paiementHandler.class.php";
            var req = $http({
                method: 'POST',
                url: ajaxUrl,
                data: {
                    action  						 : "create",
										fk_propriete 			 : $( "#ul_propriete .selected" ).attr( "data-value" ) ,
                    num_paiement         : $scope.num_paiement,
                    date_paiement        : $( "#date_paiement" ).val(),
                    mode_paiement        : $scope.mode_paiement,
                    affectation_paiement : $scope.affectation_paiement,
                    montant_paiement     : $scope.montant_paiement,
									 	date_recu          	 : $( "#date_recu" ).val(),
										charge_recu        	 : $scope.charge_recu
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
    }
    
}

/*
 ***********************************************************************************
 *                                      INTERFACE UI LISTE
 ***********************************************************************************
 */
/*******************
 * Init Table
 ********************/
$("#table_paiement").tabulator({
    pagination:"local", //enable local pagination.
    paginationSize:20, //Number of rows
    layout:"fitColumns", //fit columns to width of table (optional)
    langs:{
        "fr-fr": {
                    "pagination": {
                                    "first"         : "Premier",
                                    "first_title"   : "Premier Page",
                                    "last"          : "Dernier",
                                    "last_title"    : "Dernier Page",
                                    "prev"          : "Précédent",
                                    "prev_title"    : "Précédent Page",
                                    "next"          : "Prochain",
                                    "next_title"    : "Prochain Page"
                                    }
        }
    },
    columns:[ //Define Table Columns
        {title:"Num paiement", field:"num_paiement", headerFilter:true},
        {title:"Date paiement", field:"date_paiement", headerFilter:true},
        {title:"Mode paiement", field:"mode_paiement", headerFilter:true},
        {title:"Affectation paiement", field:"affectation_paiement", headerFilter:true},
        {title:"Montant paiement", field:"montant_paiement", headerFilter:true},
				{title:"Num propriete", field:"num_propriete", headerFilter:true},
				{title:"Date reçus", field:"date_recu", headerFilter:true},
				{title:"Charge recus.", field:"charge_recu", headerFilter:true},
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
$("#table_paiement").tabulator("setLocale", "fr-fr");


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
        var ajaxUrl = window.location.origin + "/htdocs/syndic/paiement/class/paiementHandler.class.php";
        var req = $http({
            method: 'POST',
            url: ajaxUrl,
            data: {action: "fetch"}
        });
        req.then(function mySuccess(response) {
                var tabledata = response.data;
                //load data into the table
								console.log('Success load data into table');
							  console.log(response);
                $("#table_paiement").tabulator("setData", tabledata);
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
        var ajaxUrl = window.location.origin + "/htdocs/syndic/paiement/class/paiementHandler.class.php";
        var req = $http({
            method: 'POST',
            url: ajaxUrl,
            data: {action: "search", s: $scope.s}
        });
        req.then(function mySuccess(response) {
                var tabledata = response.data;
                //load sample data into the table
                $("#table_paiement").tabulator("setData", tabledata);
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
        var listAll = $("#table_paiement").tabulator("getData");
        angular.forEach(listAll, function (value, key) {
            if (value.sup === false) {
                listChecked.push(value.id);
            }
        });

        var ajaxUrl = window.location.origin + "/htdocs/syndic/paiement/class/paiementHandler.class.php";
        var req = $http({
            method: 'POST',
            url: ajaxUrl,
            data: {action: "delete", arr_ids: listChecked}
        });
        req.then(function mySuccess(response) {
                console.log('Succes Delete : ' + response.data);
                //Loop Remove deleted rows front-end
                angular.forEach(listChecked, function (value, key) {
                    $("#table_paiement").tabulator("deleteRow", value);
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
        var productData = $("#table_paiement").tabulator("getData");

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
                    "num_paiement": item.num_paiement,
                    "date_paiement": item.date_paiement,
                    "mode_paiement": item.mode_paiement,
                    "affectation_paiement": item.affectation_paiement,
                    "montant_paiement": item.montant_paiement,
                    "sup": true
                };
                dataUpdate.push(obj);
            });
        }
        $("#table_paiement").tabulator("updateData", dataUpdate);
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
            var ajaxUrl = window.location.origin+"/htdocs/syndic/paiement/class/paiementHandler.class.php" ;
            var req = $http({
                method  :   'POST',
                url     :   ajaxUrl,
                data    :   {action:"single",id: the_id}
            });
            req.then(function mySuccess(response) {
                    console.log('Succes get data');
                    console.log(response);
                    $scope.id                      = response.data[0].id;
                    $scope.num_paiement            = response.data[0].num_paiement;
                    $scope.date_paiement           = response.data[0].date_paiement;
                    $scope.mode_paiement           = response.data[0].mode_paiement;
                    $scope.affectation_paiement    = response.data[0].affectation_paiement;
                    $scope.montant_paiement        = response.data[0].montant_paiement;
										$scope.num_propriete       	 = response.data[0].num_propriete;
										$scope.date_recu        			 = response.data[0].date_recu;
										$scope.charge_recu        	   = response.data[0].charge_recu;
                },
                function myError(response) {
                    console.log('Error get data');
                    console.log(response);
                });
        }


        /***************************************************************************
         * Pagination
         *************************************************************************/
        var ajaxUrl = window.location.origin+"/htdocs/syndic/paiement/class/paiementHandler.class.php" ;
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
        var ajaxUrl = window.location.origin + "/htdocs/syndic/paiement/class/paiementHandler.class.php";
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