<?php
/* 
 * Copyright (C) 2017-2018	Abdelhadi Habchi	<abdelhadi.deve@gmail.com>
 */

require '../../main.inc.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formfile.class.php';

llxHeader();
?>

<div ng-app="majApp">
<div ng-controller="majCtrl">
<table summary="" class="centpercent notopnoleftnoright" style="margin-bottom: 2px;">
		<tbody>
			<tr>
				<td class="nobordernopadding widthpictotitle" valign="middle">
					<img src="../../syndic/img/owner-icon.png" alt="" title="" class="valignmiddle" id="pictotitle">
				</td>
				<td class="nobordernopadding" valign="middle">
					<div class="titre">{{titre_page}}</div>
				</td>
			</tr>
		</tbody>
</table>
<form action="<?php echo $_SERVER["PHP_SELF"] ; ?>" method="post">
	<div class="tabBar tabBarWithBottom">
		<table class="border" width="100%">
		<tr>
			<td class="titlefieldcreate">Nom</td>
			<td><input name="nom" size="40" value="" ng-model="nom"></td>
		</tr>
		<tr>
			<td>Prenom</td>
            <td><input name="prenom" size="40" value="" ng-model="prenom"></td>
		</tr>
		<tr>
			<td>Titre</td>
			<td><input name="titre" size="40" value="" ng-model="titre"></td>
		</tr>
		<tr>
			<td>Civilite</td>
			<td><input name="civilite" size="40" value="" ng-model="civilite"></td>
		</tr>
		<tr>
			<td>Ville</td>
			<td><input name="ville" size="40" value="" ng-model="ville"></td>
		</tr>
		</table>
	</div>
		<div class="center">
                    <input type="button" class="button" name="valider" ng-click="funcValider()" value="Valider">
                    <input type="submit" class="button" name="annuler" value="Annuler">
		</div>
	</form>
</div>
</div>
<?php
llxFooter();
?>
<script src="proprietaire.js"></script>
<?php
$db->close();