<?php
/* Copyright (C) 2016-2018 MarocGeek  <contact@marocgeek.com>
 *
 *This Software Created By MarocGeek Team
 * A software for Manage Syndic Activities
 * SiteWeb : www.marocgeek.com
 *
 */

/**
 *  \ingroup    syndic/residence
 *  \brief      Page mise a jour des données
 */

require '../../main.inc.php';
?>
    <link rel="stylesheet" type="text/css" href="/htdocs/syndic/css/bootstrap-3.0.2.min.css">

<?php

llxHeader('',$title='Mise à jour residence');
include '../header.php';
?>

<div ng-app="majApp" ng-cloak>
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
			<td>Adresse</td>
            <td><input name="prenom" size="40" value="" ng-model="adresse"></td>
		</tr>
		<tr>
			<td>Cp residence</td>
			<td><input name="titre" size="40" value="" ng-model="cp_res"></td>
		</tr>
		<tr>
			<td>Ville</td>
			<td><input name="ville" size="40" value="" ng-model="ville"></td>
		</tr>
		</table>
	</div>
		<div class="center">
                    <input type="button" class="button" name="valider" ng-click="funcValider()" value="Valider">
                    <a href="liste.php" class="button" name="annuler" value="Annuler">Annuler</a>
		</div>
	</form>
</div>
</div>
<?php
llxFooter();
?>
<script src="script.js"></script>
<?php
$db->close();