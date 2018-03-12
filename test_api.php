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

?>
<table summary="" class="centpercent notopnoleftnoright" style="margin-bottom: 2px;" ng-app="majApp" ng-controller="majCtrl">
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

<?php
llxFooter();
?>
<script>
  
//         //AngularJS
        var majApp     = angular.module('majApp', []) ;
        var majCtrl    = majApp.controller('majCtrl', ['$scope','$http', func_majCtrl]);
        
        function func_majCtrl ($scope,$http) {

// Log in - API REQUEST					
           //var ajaxUrl = localStorage.apiServer+'/htdocs/syndic/framework/public/api/userLogin' ;
//         var req = $http({
//             method: 'POST',
//             url: ajaxUrl,
//             data: {login:"admin",password:"Marocgeek@Marocgeek@mg"}
//         });
//         req.then(function mySuccess(response) {
//                 //console.log(response);
//                 localStorage.token = response.data.success.token ;
//             },
//             function myError(response) {
//                 console.log('Error Credentials can not get token login/password');
//             });
					
// Retrieve Data - API REQUEST			
      var ajaxUrl = localStorage.apiServer+'/htdocs/syndic/framework/public/api/userDetails' ;
      var req = $http({
            method: 'POST',
            url: ajaxUrl,
            data: {login:"admin",password:"Marocgeek@Marocgeek@mg"},
            headers: {
                       'Accept'         : 'application/json',
                       'Authorization'  : 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjY4YjY4NzAyNjJkMWZlZDc2OGRlMTc0NTQ4MTU5YzJiNWQxYjM0MzI0NzBkZGE0ZWJlNDdjYmQ5ODE0YjNjNTE5ZTA5MDk4NjBmZDUxNTc1In0.eyJhdWQiOiIxIiwianRpIjoiNjhiNjg3MDI2MmQxZmVkNzY4ZGUxNzQ1NDgxNTljMmI1ZDFiMzQzMjQ3MGRkYTRlYmU0N2NiZDk4MTRiM2M1MTllMDkwOTg2MGZkNTE1NzUiLCJpYXQiOjE1MjAxODI4NjIsIm5iZiI6MTUyMDE4Mjg2MiwiZXhwIjoxNTUxNzE4ODYyLCJzdWIiOiIyMSIsInNjb3BlcyI6W119.uQX_OAKvOyjzpee4VXFZ94332V2_j_nwE3pB3jCPOPjCUJE84gw4iO_QNcXbRPAXrngqknUO-3GtqyLhEeA2Fp-xjhstfte3W7A4Y5HyRW3b9QrH5wjy2FOzRdfaOEBNopbK9lepPGYWMObrnbDagBmYvU6waCXoAGNz2X1vUr4QxmIVJysjLwZD15UB6cxdtBq7MWSHCbvLabunUW_v94knY1leQJCuFp1HxnlJsva8ewx1QWU9-624flSfT369p6LoxzNA7Y216TxOxO7d3aX5-YKCh9llTbH-oz-d3zjyrMFm1IA5jfLOeU2V906_Or-25GMNXM-3xbdHKiEhYn1cX-EMO_OMRR8dMLUFb8AIzbeCToiru0HHiirxiNOMOD0KSjdgh8FvlSD06pgqVacFTTrMCHTO8oI-RbhpKNyux_dZjB2pikj8sbR1XoFz17pjRU-9pp1z_avGva85strhsspF8mrLqOB-0Pb6SL25-8X_uYAqubCyVzYbZzHuKI6P9ryrdHzxa-e-yEEOfuMktQM6IUPOeLI8ylOJNalaVuuIwHuecrWp5K43f40ALYpih2jR7RLt3MAsa7hQzzqIMHtP7Ft0S8pHWDREsiEsdGms6cY9Ez709dj9__oDaEmO2s99rKLCDDXr57eyKFRwqZKdkI2SclW63Ofgzng'
                     }
        });
        req.then(function mySuccess(response) {
                console.log(response);
                //localStorage.token = response.data.success.token ;
            },
            function myError(response) {
                console.log('Error Credentials can not get token login/password');
            });  

//Log out - API REQUEST
//       var ajaxUrl = localStorage.apiServer+'/htdocs/syndic/framework/public/api/userLogout' ;
// 			var token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjRmYWZjNjAzODY0MGE4YWIzZjk2ZmY1OWM3ZmJjOTMyMDAwODFjZmFhZjgyYjYxZTc4NjBjNmQ4ZTQ0YzNkN2I3NjZjN2Q5ZDdkZWU5ZTA5In0.eyJhdWQiOiIxIiwianRpIjoiNGZhZmM2MDM4NjQwYThhYjNmOTZmZjU5YzdmYmM5MzIwMDA4MWNmYWFmODJiNjFlNzg2MGM2ZDhlNDRjM2Q3Yjc2NmM3ZDlkN2RlZTllMDkiLCJpYXQiOjE1MjAyNzE3MTYsIm5iZiI6MTUyMDI3MTcxNiwiZXhwIjoxNTUxODA3NzE2LCJzdWIiOiIyNyIsInNjb3BlcyI6W119.j1mkDN78_8dcDU-2q8TVWtL8N3-5wmIKkXEVkmUgK6Oc51-k7LgT_YlbSq1Sm_FcgxhANUE_QINj15q4IGpgVcvuRmPcK_-PcT9dgWch2K_OGu03nxoEpj9DWkZgi4YCGzE_VCfwEWq7codfCtXa2kJhM8Wh2cCxB2TlWj_5sIpdEGK_Dp0NkMoP1kSHeJb-zQmzEL2rSwwb7upFzfhdBrYPNh_Uq_KB6s666XH-n2bpWqnao6ZJacKFoZksBFo5Q6onS3dn-C9c2bYwnr87hOlcK4h-UgK3_Q3Yiq6BvmG6pIRl6xdEcceFSHmFHySBP949PtjyEyX4CwX4gG55Fv3yqm-p7FmgVuhz634FQb1CsvNj2aMFdGgWIp1Vu7lcmbcqDOJadm0JbRZ5etad-diEeDenOb9xr_Y1Q2Oosr7g48-RMmPG-2idi9gzvFqVuhy29oKW-ntU5CA0YkOwVSudjdjrYIndNIcrubNQE4A_yoe3MPmmQ4UjKF5hCi5-_kClkYrGDqVNz_UCNIYncW-gp7Wi9zGBTGN3oSNd0VVSj0GBzWrzkM-Uv_UZwmg0RLCEepTzSP8DJGav63wr61J7KjckchM-sDZkFyS4qHjAejCGkVk5fP72NheMuiPn_5IwuRnnTilR94KKGI250gTUXd9BBelQ3RbiGEqtOlE';
					
//       var req = $http({
//             method: 'POST',
//             url: ajaxUrl,
//             data: {login:"admin",password:"Marocgeek@Marocgeek@mg"},
//             headers: {
//                        'Accept'         : 'application/json',
//                        'Authorization'  : 'Bearer '+token
//                      }
//         });
//         req.then(function mySuccess(response) {
//                 console.log(response);
//             },
//             function myError(response) {
//                 console.log('Error Credentials : can not get token login/password');
//             }); 
//   }
  
  
</script>