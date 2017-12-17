<?php
/* 
 * Copyright (C) 2017-2018	Abdelhadi Habchi	<abdelhadi.deve@gmail.com>
 */

require '../main.inc.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formfile.class.php';
require_once DOL_DOCUMENT_ROOT.'/syndic/class/proprietaire.class.php';

$form = new Form($db);
$prop = new SyndicProprietaire($db);

//echo '<h1>adev test'.$prop->create().'</h1>';
//setEventMessages('test msg');
//	print $form->formconfirm('page.com','title','question ?','action delete','',"",1);

		/*		$sql = "select * FROM ".MAIN_DB_PREFIX."proprietaire" ;
			  $resql=$db->query($sql);
				$obj = $db->fetch_object($resql);
        var_dump($obj); */


	//***********************
	// Create
	//***********************

$action=GETPOST('action','alpha');
if ($action == 'add') 
{
	$prop->nom 						= trim($_POST["nom"]);
        $prop->prenom						= trim($_POST["prenom"]);
	$prop->titre 						= trim($_POST["titre"]);
	$prop->civilite                                         = trim($_POST["civilite"]);
	$prop->ville 						= trim($_POST["ville"]);
	$prop->create();
	header("Location: ".DOL_URL_ROOT.'/syndic/prop.php?action=create');
	exit;
}

llxHeader();
if ($action == 'create') 
{
?>
<table summary="" class="centpercent notopnoleftnoright" style="margin-bottom: 2px;">
		<tbody>
			<tr>
				<td class="nobordernopadding widthpictotitle" valign="middle">
					<img src="../syndic/img/owner-icon.png" alt="" title="" class="valignmiddle" id="pictotitle">
				</td>
				<td class="nobordernopadding" valign="middle">
					<div class="titre">Nouveau propriétaire</div>
				</td>
			</tr>
		</tbody>
</table>

<form action="<?php echo $_SERVER["PHP_SELF"] ; ?>" method="post">
	<div class="tabBar tabBarWithBottom">
		<input type="hidden" name="token" value="<?php echo $_SESSION['newtoken'] ; ?>">
		<input type="hidden" name="action" value="add">
		<table class="border" width="100%">
		<tr>
			<td class="titlefieldcreate">Nom</td>
			<td><input name="nom" size="40" value=""></td>
		</tr>
		<tr>
			<td>Prenom</td>
			<td><input name="prenom" size="40" value=""></td>
		</tr>
		<tr>
			<td>Titre</td>
			<td><input name="titre" size="40" value=""></td>
		</tr>
		<tr>
			<td>Civilite</td>
			<td><input name="civilite" size="40" value=""></td>
		</tr>
		<tr>
			<td>Ville</td>
			<td><input name="ville" size="40" value=""></td>
		</tr>
		</table>
	</div>	
		<div class="center">
		<input type="submit" class="button" name="create" value="Créer">
		<input type="submit" class="button" name="cancel" value="Annuler">
		</div>
	</form>
<?php
}

// Remove a proprietaire
if ($action == 'delete_section')
{
	print $form->formconfirm($_SERVER["PHP_SELF"].'?section='.$section, $langs->trans('DeleteSection'), $langs->trans('ConfirmDeleteSection',$ecmdir->label), 'confirm_deletesection');
}


llxFooter();
$db->close();