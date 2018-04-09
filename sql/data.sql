-- Copyright (C) 2001-2004 Rodolphe Quiedeville <rodolphe@quiedeville.org>
-- Copyright (C) 2003      Jean-Louis Bergamo   <jlb@j1b.org>
-- Copyright (C) 2004-2009 Laurent Destailleur  <eldy@users.sourceforge.net>
-- Copyright (C) 2004      Benoit Mortier       <benoit.mortier@opensides.be>
-- Copyright (C) 2004      Guillaume Delecourt  <guillaume.delecourt@opensides.be>
-- Copyright (C) 2005-2009 Regis Houssin        <regis.houssin@capnetworks.com>
-- Copyright (C) 2007 	   Patrick Raguin       <patrick.raguin@gmail.com>
--
-- This program is free software; you can redistribute it and/or modify
-- it under the terms of the GNU General Public License as published by
-- the Free Software Foundation; either version 3 of the License, or
-- (at your option) any later version.
--
-- This program is distributed in the hope that it will be useful,
-- but WITHOUT ANY WARRANTY; without even the implied warranty of
-- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU General Public License for more details.
--
-- You should have received a copy of the GNU General Public License
-- along with this program. If not, see <http://www.gnu.org/licenses/>.
--
--

--
-- Ne pas placer de commentaire en fin de ligne, ce fichier est parsé lors
-- de l'install et tous les sigles '--' sont supprimés.
--

--
-- Proprietaire
--

--delete from llx_proprietaire
--insert into llx_proprietaire (rowid , label_1,label_2) values (7,'test lab 3',   'test lab 3');

-----------------------------------------------------------------------------------------------------------------------
-- Create triggers for copy user (Dolibarr) to users (Laravel) data
-----------------------------------------------------------------------------------------------------------------------

-- Action : Insert
--CREATE TRIGGER insert_users AFTER INSERT ON llx_user FOR EACH ROW BEGIN delete from llx_users ; INSERT INTO llx_users (`id`,`name`,`password`) SELECT `rowid`,`login`,`pass_crypted` as email FROM llx_user ; END ;

-- Action : Update
--CREATE TRIGGER update_users AFTER update ON llx_user FOR EACH ROW BEGIN delete from llx_users ; INSERT INTO llx_users (`id`,`name`,`password`) SELECT `rowid`,`login`,`pass_crypted` as email FROM llx_user ; END ;

-- Action : Delete
--CREATE TRIGGER delete_users AFTER DELETE ON llx_user FOR EACH ROW BEGIN delete from llx_users ; INSERT INTO llx_users (`id`,`name`,`password`) SELECT `rowid`,`login`,`pass_crypted` as email FROM llx_user ; END ;
