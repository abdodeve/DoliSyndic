-- ============================================================================
-- Copyright (C) 2016-2017  Abdelhadi & Mustapha   <contact@marocgeek.com>
-- ============================================================================
-- --------------------------------------------------------

--
-- Structure de la table `oauth_clients`
--

CREATE TABLE `llx_oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `oauth_clients`
--

INSERT INTO `llx_oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', '7uXV5jIxms5Y7zDh9VrfWLf00t8WwyPmnKWC2QHl', 'http://localhost', 1, 0, 0, '2018-02-27 16:37:04', '2018-02-27 16:37:04'),
(2, NULL, 'Laravel Password Grant Client', 'uJ5xB0JrCfTb4716Spp7EEtaCgJnQk2cFHACa2W9', 'http://localhost', 0, 1, 0, '2018-02-27 16:37:04', '2018-02-27 16:37:04');
