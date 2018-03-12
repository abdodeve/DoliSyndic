-- ============================================================================
-- Copyright (C) 2016-2017  Abdelhadi & Mustapha   <contact@marocgeek.com>
-- ============================================================================

--
-- Structure de la table `users`
--

CREATE TABLE `llx_users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT primary key,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
