var setupApp     = angular.module('setupApp', ['ngSanitize','ngRoute']) ;
var setupCtrl    = setupApp.controller('setupCtrl', ['$scope','$http', func_setupCtrl]);

function func_setupCtrl ($scope,$http,$location) {
	//Set default values
	$scope.is_penalite_static = "1" ;
	alert('hello adev');

	//Retrieve data from server
	 var ajaxUrl = window.location.origin+"/htdocs/syndic/framework/public/api/parametreFetch" ;
     var req = $http({
            method  :   'POST',
            url     :   ajaxUrl,
            headers : 	{
                                'Accept'        :'application/json',
                                'Authorization' :'Bearer '+localStorage.token
                        }
           // data    :   {action:"single",id: the_id}
        });
        req.then(function mySuccess(response) {
                console.log('Succes get data');
                console.log(response);
                $scope.is_penalite_static 			= response.data.is_penalite_static		
                $scope.budget      					= response.data.budget;
                $scope.taux_tantieme        	    = response.data.taux_tantieme;
                $scope.totale_tantieme  			= response.data.totale_tantieme;
                $scope.penalite_static_frais        = response.data.penalite_static_frais;
                $scope.penalite_dynamic_taux        = response.data.penalite_dynamic_taux;

            },
            function myError(response) {
                console.log('Error get data');
                console.log(response);
            });
	
}