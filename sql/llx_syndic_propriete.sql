-- ============================================================================
-- Copyright (C) 2016-2017	Abdelhadi & Mustapha	 <contact@marocgeek.com>
--
--
-- Table of llx_syndic_propriete
-- ============================================================================

create table llx_syndic_propriete
(
  rowid                      integer AUTO_INCREMENT PRIMARY KEY,
  fk_residence               integer ,
  num_propriete              varchar(200),
  num_titre                  varchar(200),
  quote_part_terrain         varchar(200),
  surface                    int,
  pt_indivision              int,
  created_at                 timestamp NULL DEFAULT NULL,
  updated_at                 timestamp NULL DEFAULT NULL
)ENGINE=innodb;