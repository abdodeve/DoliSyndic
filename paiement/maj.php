<?php
/* Copyright (C) 2016-2018 MarocGeek  <contact@marocgeek.com>
 *
 *This Software Created By MarocGeek Team
 * A software for Manage Syndic Activities
 * SiteWeb : www.marocgeek.com
 *
 */

/**
 *  \ingroup    syndic/paiement
 *  \brief      Page mise a jour des données
 */

require '../../main.inc.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formfile.class.php';
?>
    <link rel="stylesheet" type="text/css" href="/htdocs/syndic/css/bootstrap-3.0.2.min.css">

<?php
llxHeader('',$title='Mise à jour paiement');
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
			<td class="titlefieldcreate">Num paiement</td>
			<td><input name="num_paiement" size="40" value="" ng-model="num_paiement"></td>
		</tr>
		<tr>
			<td>Date paiement</td>
      <td>
				<input type="text" size="40" ng-model="date_paiement" jqdatepicker></td>
		</tr>
		<tr>
			     <td>Mode paiement</td>
                  <!-- 			<td><input name="titre" size="40" value="" ng-model="titre"></td> -->
                  <td>
                     <label><input type="radio" name="mode_paiement" ng-model="mode_paiement" value="Cheque"> Chèque</label>
                     <label><input type="radio" name="mode_paiement" ng-model="mode_paiement" value="Espece"> Espèce</label>
                     <label><input type="radio" name="mode_paiement" ng-model="mode_paiement" value="Virement"> Virement</label>
                  </td>
		</tr>
		<tr>
			<td>Affectation paiement</td>
			<td><input name="affectation_paiement" size="40" value="" ng-model="affectation_paiement"></td>
		</tr>
		<tr>
			<td>Montant paiement</td>
			<td><input name="montant_paiement" size="40" value="" ng-model="montant_paiement"></td>
		</tr>
		<tr>
			<td>Propriete</td>
			<td>
				<div custom-select="t as t.num_propriete for t in proprietes | filter: {num_propriete: $searchTerm} " ng-model="person">
					<div class="pull-left">
						<strong>{{ t.num_propriete }}</strong><br />
						<span>{{ t.num_titre }}</span>
					</div>
					<div class="clearfix"></div>
				</div>
<!-- 								<div class="col-sm-4" style="padding:0;">
				           <div id="num_propriete" class="selectpicker" data-clear="true" data-live="true">
                                    <a href="#" class="clear"><span class="fa fa-times"></span><span class="sr-only">Annuler la sélection</span></a>
                                    <button data-id="prov" type="button" class="btn btn-md btn-block btn-default dropdown-toggle">
                                        <span class="placeholder">Choisis une option</span>
                                        <span class="caret"></span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <div class="live-filtering" data-clear="true" data-autocomplete="true" data-keys="true">
                                            <label class="sr-only" for="input-bts-ex-5">Chercher dans la list</label>
                                            <div class="search-box">
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="search-icon5">
                                                        <span class="fa fa-search"></span>
                                                      <a href="#" class="filter-clear"><span><i class="fa fa-times" aria-hidden="true"></i> Supp. filtre</span></a>
                                                    </span>
                                                    <input type="text" placeholder="Chercher dans la liste" id="input-bts-ex-5" class="form-control live-search" aria-describedby="search-icon5" tabindex="1" />
                                                </div>
                                            </div>
                                            <div class="list-to-filter">
                                                <ul class="list-unstyled">
                                                    <li class="optgroup">
                                                        <ul class="list-unstyled" id="ul_propriete">
                                                        </ul>
                                                    </li>
                                                </ul>
                                                <div class="no-search-results">
                                                    <div class="alert alert-warning" role="alert"><i class="fa fa-warning margin-right-sm"></i>Aucune resultat <strong>'<span></span>'</strong> est trouvé.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="bts-ex-5" value="">
                                </div>
														</div> -->
				
			</td>
		</tr>
		<tr>
			<td>Date reçus</td>
      <td><input name="date_recu" id="date_recu" size="40" value="" ng-model="date_recu" jqdatepicker></td>
		</tr>
		<tr>
			<td>Charge reçus</td>
      <td><input name="charge_recu" id="charge_recu" size="40" value="" ng-model="charge_recu"></td>
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

<script src="/htdocs/syndic/js/tabcomplete.min.js"></script>
<script src="/htdocs/syndic/js/livefilter.min.js"></script>
<script src="/htdocs/syndic/js/bootstrap-select.js"></script>

<?php

$db->close();