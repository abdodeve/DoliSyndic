-- ============================================================================
-- Copyright (C) 2016-2017	Alexandre Spangaro	 <aspangaro@zendsi.com>
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
-- Table of llx_syndic_proprietaire
-- ============================================================================

create table llx_syndic_proprietaire
(
  rowid             integer AUTO_INCREMENT PRIMARY KEY,
  fk_proprietaire   integer ,
  nom               varchar(200),
  prenom            varchar(200),
  titre             varchar(200),
  civilite          varchar(200),
  ville             varchar(200),
  adresse_1         varchar(200),
  adresse_2         varchar(200),
  email_1           varchar(200),
  email_2           varchar(200),
  tel_1             varchar(200),
  tel_2             varchar(200),
  created_at        timestamp NULL DEFAULT NULL,
  updated_at        timestamp NULL DEFAULT NULL
)ENGINE=innodb;