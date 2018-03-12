-- ============================================================================
-- Copyright (C) 2016-2017  Abdelhadi & Mustapha   <contact@marocgeek.com>
-- ============================================================================
-- --------------------------------------------------------

--
-- Structure de la table `llx_oauth_access_tokens`
--

CREATE TABLE `llx_oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `oauth_access_tokens`
--

INSERT INTO `llx_oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('08fd2445009372e05c7abfe0907b7ea1e01408b64a6b949e6849a46cc56e951ba19f92142f0cae96', 17, 1, 'MyApp', '[]', 0, '2018-03-02 15:20:50', '2018-03-02 15:20:50', '2019-03-02 16:20:50'),
('af92676da98293c46937aafe8e2c9c55ead6c1f67ff6c5f6980f92261dd2395a74ea9e6dae40793b', 15, 1, 'MyApp', '[]', 0, '2018-03-02 00:13:59', '2018-03-02 00:13:59', '2019-03-02 01:13:59'),
('bfe5546b02d3e2475e0705545439a49e7f9e1bf4429d87be8b0951adef4cbd41614383c58580aee9', 15, 1, 'MyApp', '[]', 0, '2018-03-02 00:13:55', '2018-03-02 00:13:55', '2019-03-02 01:13:55'),
('1edf982888e2955db74e7745fe658584bbd1cb4b47f43c6910ee8f8ec9809e3f938febe7327294c6', 15, 1, 'MyApp', '[]', 0, '2018-03-02 00:13:53', '2018-03-02 00:13:53', '2019-03-02 01:13:53'),
('ece4cde61c22d7e4263d3faf7df52c4e38a56a54d3412859c2694765174a3caea51077a93697462c', 15, 1, 'MyApp', '[]', 0, '2018-03-02 00:13:45', '2018-03-02 00:13:45', '2019-03-02 01:13:45'),
('0d80ba9484c9307ae34caef46ffa574c5d094a34e49443287b8e681764af95afc27cc1062016d276', 1, 1, 'MyApp', '[]', 0, '2018-03-01 10:16:53', '2018-03-01 10:16:53', '2019-03-01 11:16:53');


--
-- Index pour la table `oauth_access_tokens`
--
ALTER TABLE `llx_oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);