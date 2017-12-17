<?php
/* 
 * Copyright (C) 2017-2018	Abdelhadi Habchi	<abdelhadi.deve@gmail.com>
 */
require '../../main.inc.php';
llxHeader();
?>

<div ng-app="listeApp">
<div ng-controller="listeCtrl">
	<h1>
		{{myWelcome}}
	</h1>
<table summary="" class="centpercent notopnoleftnoright" style="margin-bottom: 2px;">
		<tbody>
		<tr>
				<td class="nobordernopadding widthpictotitle" valign="middle">
					<img src="../img/owner-icon.png" alt="" title="" class="valignmiddle" id="pictotitle">
				</td>
				<td class="nobordernopadding valignmiddle" valign="middle">
						<div class="titre">Liste proprietaires</div>
				</td>
				<td class="nobordernopadding center valignmiddle">
				<div class="centpercent center delete_block">
					<select data-role="none" ng-model="select_action"  ng-init="select_action='0'" class="flat hideobject massaction massactionselect" name="massaction" style="display: inline-block;">
						<option value="0">-- Sélectionner l'action --</option>
						<option value="delete">Supprimer</option>
					</select>
				 <input type="submit" data-role="none" name="confirm" ng-model="confirm" ng-init="confirm='Confirmer'" ng-click="confirm_func()" value="{{confirm}}" class="button massaction massactionconfirmed" ></div>
		  	</td>
		</tr>
		</tbody>
</table>
<div class="div-table-responsive">
  <div class="tagtable liste">
    <table class="tagtable liste" style="margin-bottom: 0;">
      <tbody>
        <tr class="liste_titre_filter">
          <td class="liste_titre" align="left">
              <label>Chercher : <input class="flat" type="text" name="s" ng-model="s" size="50" value="" placeholder="Tapez mot .."></label>
          </td>
          <td class="liste_titre" align="middle">
            <div class="nowrap">
              <input type="image" class="liste_titre" name="button_search" 
										 src="/htdocs/theme/eldy/img/search.png" value="Rechercher" 
										 title="Rechercher"  ng-click='search_func()'>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

	<div class="div-table-responsive">
					<div id="table_proprietaire" style="width: 98%"></div>
	</div>
</div>
</div>
<?php
llxFooter();
?>

<script>
$("#select-all").on("change", function(){
   alert("message test");
 });
</script>
<script src="proprietaire.js"></script>
<?php
$db->close();