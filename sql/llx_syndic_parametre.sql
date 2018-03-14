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
-- Table of llx_syndic_parametre
-- ============================================================================

create table llx_syndic_parametre
(
  rowid                           integer AUTO_INCREMENT PRIMARY KEY,
  budget                          float,
  taux_tantieme                   float,
  totale_tantieme                 float,
  is_penalite_static              bool,
  penalite_static_frais           float,
  penalite_dynamic_taux           float,
  created_at                      timestamp NULL DEFAULT NULL,
  updated_at                      timestamp NULL DEFAULT NULL
)ENGINE=innodb;

--Insert default line
INSERT INTO `llx_syndic_parametre` (`rowid`, `budget`, `taux_tantieme`, `totale_tantieme`, `is_penalite_static`, `penalite_static_frais`, `penalite_dynamic_taux`) VALUES (1, '0', '0', '0', '0', '0', '0');