    <?php
/* Copyright (C) 2016-2018 MarocGeek  <contact@marocgeek.com>
 *
 *This Software Created By MarocGeek Team
 * A software for Manage Syndic Activities
 * SiteWeb : www.marocgeek.com
 *
 */

/**
 *  \ingroup    syndic/appartement
 *  \brief      Page mise a jour des données
 */

require '../../main.inc.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formfile.class.php';

llxHeader();
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
                <td class="titlefieldcreate">Num appartement</td>
                <td><input name="nom" size="40" value="" ng-model="num_appartement"></td>
            </tr>
            <tr>
                <td>Num titre</td>
                <td><input name="prenom" size="40" value="" ng-model="num_titre"></td>
            </tr>
            <tr>
                <td>Quote par terrain</td>
                <td><input name="quote_part_terrain" size="40" value="" ng-model="quote_part_terrain"></td>
            </tr>
            <tr>
                <td>Surface</td>
                <td><input name="surface" size="40" value="" ng-model="surface"></td>
            </tr>
            <tr>
                <td>Pt. indivision</td>
                <td><input name="pt_indivision" size="40" value="" ng-model="pt_indivision"></td>
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