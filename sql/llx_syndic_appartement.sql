-- ============================================================================
-- Copyright (C) 2016-2017	Abdelhadi & Mustapha	 <contact@marocgeek.com>
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
-- Table of llx_syndic_appartement
-- ============================================================================

create table llx_syndic_appartement
(
  rowid                      integer AUTO_INCREMENT PRIMARY KEY,
  fk_residence               integer ,
  num_appartement            varchar(200),
  num_titre                  varchar(200),
  quote_part_terrain         varchar(200),
  surface                    int,
  pt_indivision              int
)ENGINE=innodb;