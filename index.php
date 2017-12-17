<?php
/* Copyright (C) 2001-2004 Rodolphe Quiedeville <rodolphe@quiedeville.org>
 * Copyright (C) 2004-2012 Laurent Destailleur  <eldy@users.sourceforge.net>
 * Copyright (C) 2015      Jean-François Ferry	<jfefe@aternatik.fr>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *   	\file       htdocs/admin/index.php
 *		\brief      Home page of setup area
 */
require '../main.inc.php';

llxHeader();


?>
<table summary="" class="centpercent notopnoleftnoright" style="margin-bottom: 2px;">
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

print "<h1>Syndic soulutions de gestion des résidences</h1>" ;

?>
<div class="fichethirdleft">
<?php
	print '<table class="noborder" width="100%">';
		print '<tr class="liste_titre">';
		print '<th colspan="3">Salam</th></tr>';
		?> 			<tr class="oddeven"><td colspan="3" class="opacitymedium">Pas de données</td></tr> <?php
	print '</table>' ;
		
?>
</div>
<?php

	print '<table class="border" width="100%">';
	// Reference
	print '<tr><td class="titlefieldcreate fieldrequired">' . $langs->trans('Ref') . '</td><td>' . $langs->trans("Draft") . '</td></tr>';
	// Ref customer
	print '<tr><td>' . $langs->trans('RefCustomer') . '</td><td>';
	print '<input type="text" name="ref_client" value="'.GETPOST('ref_client').'"></td>';
	print '</tr>';
  print '</table>' ;

llxFooter();

//b->close();