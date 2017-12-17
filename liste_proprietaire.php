<?php
/* 
 * Copyright (C) 2017-2018	Abdelhadi Habchi	<abdelhadi.deve@gmail.com>
 */
require '../main.inc.php';
// require_once DOL_DOCUMENT_ROOT.'/syndic/class/proprietaire.class.php';
// $prop = new SyndicProprietaire($db);

llxHeader();
?>

<table summary="" class="centpercent notopnoleftnoright" style="margin-bottom: 2px;">
		<tbody>
			<tr>
				<td class="nobordernopadding widthpictotitle" valign="middle">
					<img src="../syndic/img/owner-icon.png" alt="" title="" class="valignmiddle" id="pictotitle">
				</td>
                                <td class="nobordernopadding valignmiddle" valign="middle">
                                        <div class="titre">Liste proprietaires</div>
				</td>
                                <td class="nobordernopadding center valignmiddle">
                                <div class="centpercent center delete_block">
                                  <select data-role="none" class="flat hideobject massaction massactionselect" name="massaction" style="display: inline-block;">
                                    <option value="0">-- Sélectionner l'action --</option>
                                    <option value="delete">Supprimer</option>
                                  </select>
                                <input type="submit" data-role="none" name="confirmmassaction" class="button massaction massactionconfirmed" value="Confirmer"></div>
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
              <label>Chercher : <input class="flat" type="text" name="sref" size="50" value="" placeholder="Tapez mot .."></label>
          </td>
          <td class="liste_titre" align="middle">
            <div class="nowrap">
              <input type="image" class="liste_titre" name="button_search" src="/htdocs/theme/eldy/img/search.png" value="Rechercher" title="Rechercher">
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="div-table-responsive">
        <div id="example-table" style="width: 98%"></div>
</div>

<?php
llxFooter();
?>
<script>
               var tabledata = [{"id":"6","nom":"abdo_2.1","prenom":"abdo_2.2","sup":1},{"id":"7","nom":"abdo_2.1","prenom":"abdo_2.2"}];
                  //console.log(<?php //echo $prop->fetch() ?>);
              //load sample data into the table
              $("#example-table").tabulator("setData", tabledata);
</script>
<?php
$db->close();