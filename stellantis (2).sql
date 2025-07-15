-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 08 juil. 2025 à 14:49
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stellantis`
--

-- --------------------------------------------------------

--
-- Structure de la table `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `related_type` varchar(255) NOT NULL,
  `related_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `activities`
--

INSERT INTO `activities` (`id`, `type`, `description`, `user_id`, `related_type`, `related_id`, `created_at`, `updated_at`) VALUES
(1, 'permission', 'Granted edit permission to simo for project \'ESS1-test-test\'', 2, 'App\\Models\\Project', 1, '2025-06-13 09:06:28', '2025-06-13 09:06:28'),
(2, 'permission', 'Removed simo\'s permission from project \'ESS1-test-test\'', 2, 'App\\Models\\Project', 1, '2025-06-13 09:07:45', '2025-06-13 09:07:45'),
(3, 'permission', 'Granted edit permission to ahibou for project \'MES1-mes1-messure1\'', 2, 'App\\Models\\Project', 2, '2025-06-16 14:03:34', '2025-06-16 14:03:34'),
(4, 'permission', 'Removed ahibou\'s permission from project \'MES1-mes1-messure1\'', 2, 'App\\Models\\Project', 2, '2025-06-16 14:05:43', '2025-06-16 14:05:43'),
(5, 'permission', 'Granted edit permission to ahibou for project \'MES1-mes1-messure1\'', 2, 'App\\Models\\Project', 2, '2025-06-18 15:07:57', '2025-06-18 15:07:57'),
(6, 'permission', 'Removed ahibou\'s permission from project \'MES1-mes1-messure1\'', 2, 'App\\Models\\Project', 2, '2025-06-18 15:08:33', '2025-06-18 15:08:33');

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_active_users', 'a:1:{i:2;a:7:{s:7:\"user_id\";i:2;s:2:\"id\";i:2;s:4:\"name\";s:10:\"Abdeljalil\";s:9:\"last_seen\";O:25:\"Illuminate\\Support\\Carbon\":3:{s:4:\"date\";s:26:\"2025-07-08 12:45:01.667029\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:4:\"page\";s:9:\"dashboard\";s:2:\"ip\";s:9:\"127.0.0.1\";s:10:\"user_agent\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36\";}}', 1751979309);

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `essais_messures`
--

CREATE TABLE `essais_messures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('essai','messure') NOT NULL DEFAULT 'essai',
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `person_name` varchar(255) DEFAULT NULL,
  `validator_name` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `commentaire` text DEFAULT NULL,
  `issues` text DEFAULT NULL,
  `etat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `essais_messures`
--

INSERT INTO `essais_messures` (`id`, `project_id`, `user_id`, `type`, `name`, `created_at`, `updated_at`, `person_name`, `validator_name`, `start_date`, `end_date`, `commentaire`, `issues`, `etat`) VALUES
(1, 3, 6, 'messure', 'messure1', '2025-06-19 10:22:49', '2025-06-20 19:40:05', 'marouane', 'jalil', '2025-07-20', '2025-07-31', NULL, NULL, 'pending'),
(2, 4, 6, 'messure', 'mes1', '2025-06-24 07:40:10', '2025-06-24 07:40:10', 'marouane', 'abdeljalil', '2025-07-24', '2025-07-27', NULL, NULL, 'pending'),
(3, 3, 2, 'essai', 'safsafi', '2025-07-02 14:19:07', '2025-07-02 14:19:07', 'benkadour', 'safsaf', '2025-07-24', '2025-07-31', 'hyhy', 'utut', 'pending');

-- --------------------------------------------------------

--
-- Structure de la table `essai_messure_gammes`
--

CREATE TABLE `essai_messure_gammes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `essai_messure_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('CTR','LAS','STR') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `essai_messure_gammes`
--

INSERT INTO `essai_messure_gammes` (`id`, `essai_messure_id`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 'CTR', '2025-06-19 10:35:07', '2025-06-19 10:35:07'),
(2, 1, 'LAS', '2025-06-19 10:35:07', '2025-06-19 10:35:07'),
(3, 1, 'STR', '2025-06-19 10:35:07', '2025-06-19 10:35:07'),
(4, 2, 'CTR', '2025-06-24 07:40:10', '2025-06-24 07:40:10'),
(5, 2, 'STR', '2025-06-24 07:40:10', '2025-06-24 07:40:10'),
(6, 2, 'LAS', '2025-06-24 07:40:10', '2025-06-24 07:40:10'),
(7, 3, 'CTR', '2025-07-02 14:19:07', '2025-07-02 14:19:07'),
(8, 3, 'STR', '2025-07-02 14:19:07', '2025-07-02 14:19:07'),
(9, 3, 'LAS', '2025-07-02 14:19:07', '2025-07-02 14:19:07');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `gammes`
--

CREATE TABLE `gammes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('LAS','STR','CTR') NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `gammes`
--

INSERT INTO `gammes` (`id`, `type`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'LAS', 'Light Automotive Systems', NULL, '2025-06-18 15:09:07'),
(2, 'STR', 'STR', NULL, '2025-06-16 10:28:53'),
(3, 'CTR', 'Control Systems', NULL, '2025-06-18 23:11:48');

-- --------------------------------------------------------

--
-- Structure de la table `gamme_files`
--

CREATE TABLE `gamme_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gamme_id` bigint(20) UNSIGNED NOT NULL,
  `project_gamme_id` bigint(20) UNSIGNED DEFAULT NULL,
  `essai_messure_gamme_id` bigint(20) UNSIGNED DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `size` bigint(20) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `essai_messure_id` bigint(20) UNSIGNED DEFAULT NULL,
  `file_category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `gamme_files`
--

INSERT INTO `gamme_files` (`id`, `gamme_id`, `project_gamme_id`, `essai_messure_gamme_id`, `file_name`, `file_path`, `original_name`, `size`, `type`, `description`, `created_at`, `updated_at`, `project_id`, `essai_messure_id`, `file_category`) VALUES
(1, 1, NULL, NULL, 'eQW97iWHUdvbVF5dSbArA9ZABpHEHvnW3jJyVxd8.pdf', 'game-files/eQW97iWHUdvbVF5dSbArA9ZABpHEHvnW3jJyVxd8.pdf', 'TP_Android_Kotlin[1].pdf', 650254, 'application/pdf', NULL, '2025-06-12 15:12:15', '2025-06-12 15:12:15', NULL, NULL, NULL),
(2, 1, NULL, NULL, 'SE8SqXY7LbHMYrgswO81doSAFnIcuDM7FTSNIWXs.pdf', 'game-files/SE8SqXY7LbHMYrgswO81doSAFnIcuDM7FTSNIWXs.pdf', '2-Cas d\'Utilisation.pdf', 1227944, 'application/pdf', 'uml', '2025-06-12 15:48:09', '2025-06-12 15:48:09', NULL, NULL, NULL),
(3, 2, NULL, NULL, 'fRNi7r7tcr5NN9YTjuxWTeO466W9Xe073YRBOmyv.pdf', 'game-files/fRNi7r7tcr5NN9YTjuxWTeO466W9Xe073YRBOmyv.pdf', 'Atelier_6_Admin_WinServer.pdf', 187526, 'application/pdf', 'WinServer', '2025-06-16 10:29:56', '2025-06-16 10:29:56', NULL, NULL, NULL),
(4, 3, 4, NULL, 'dKQvADuAVSt1kNa4XVbBz2ZvXbvrSZ4j6Hkz2c1c.pdf', 'project-specifications/4/CTR/dKQvADuAVSt1kNa4XVbBz2ZvXbvrSZ4j6Hkz2c1c.pdf', 'TP_Android_Kotlin[1].pdf', 650254, 'CTR', NULL, '2025-06-19 08:52:31', '2025-06-19 08:52:31', NULL, NULL, NULL),
(5, 1, 5, NULL, 'bjIWtHsYyp3yAgsWULzbNB3Z4iAIJVyX1PYhmz0i.pdf', 'project-specifications/4/LAS/bjIWtHsYyp3yAgsWULzbNB3Z4iAIJVyX1PYhmz0i.pdf', '2-Cas d\'Utilisation (1).pdf', 1227944, 'LAS', NULL, '2025-06-19 08:55:58', '2025-06-19 08:55:58', NULL, NULL, NULL),
(6, 2, 6, NULL, 'o6fBGlR7dL6UZ4FdoGDtC1SkrVEbMAskd0EF7hag.pdf', 'project-specifications/4/STR/o6fBGlR7dL6UZ4FdoGDtC1SkrVEbMAskd0EF7hag.pdf', 'Atelier_6_Admin_WinServer.pdf', 187526, 'STR', NULL, '2025-06-19 09:07:50', '2025-06-19 09:07:50', NULL, NULL, NULL),
(7, 3, 1, NULL, '9sDhh6dfpM6Gf2EI1ZuwHitETsO3aeKx4wWGMRuV.pdf', 'project-specifications/3/CTR/9sDhh6dfpM6Gf2EI1ZuwHitETsO3aeKx4wWGMRuV.pdf', 'annual report.pdf', 19088, 'CTR', NULL, '2025-06-19 09:13:28', '2025-06-19 09:13:28', NULL, NULL, NULL),
(8, 1, 2, NULL, 'DvMtvmLXTRjnhDUbiukXC4CTQw1hw0k50N7fBFXX.pdf', 'project-specifications/3/LAS/DvMtvmLXTRjnhDUbiukXC4CTQw1hw0k50N7fBFXX.pdf', 'Cahier des charges Projet de fin de module.pdf', 185240, 'LAS', NULL, '2025-06-19 09:14:35', '2025-06-19 09:14:35', NULL, NULL, NULL),
(9, 3, NULL, 1, 'ReuYvrqv0btQ2FNlAUG196qkrHExTbZonhWP8it6.pdf', 'essai-messure/1/CTR/ReuYvrqv0btQ2FNlAUG196qkrHExTbZonhWP8it6.pdf', '2-Cas d\'Utilisation (3).pdf', 1227944, 'CTR', NULL, '2025-06-19 10:48:44', '2025-06-19 10:48:44', NULL, NULL, NULL),
(10, 2, NULL, 3, 'qoYzymONY8DG0nao4V7ThOZBxNVwVYQJN5wtasGM.pdf', 'essai-messures/1/STR/qoYzymONY8DG0nao4V7ThOZBxNVwVYQJN5wtasGM.pdf', 'Frameworks Laravel Part I.pdf', 1337378, 'STR', NULL, '2025-06-21 19:51:51', '2025-06-21 19:51:51', NULL, NULL, NULL),
(11, 2, 3, NULL, 'gjVfDUL5hXE8iZhdaJnJYL0rteRlhtjOM4waMvGZ.pdf', 'project-specifications/3/STR/gjVfDUL5hXE8iZhdaJnJYL0rteRlhtjOM4waMvGZ.pdf', 'Atelier_2_Admin_WinServer_Partie_1.pdf', 625183, 'STR', NULL, '2025-06-21 19:53:03', '2025-06-21 19:53:03', NULL, NULL, NULL),
(12, 1, 2, NULL, '1l2tMF1kZgeJi2tG8r6yIuudDuYPKWacUVLQSMMx.pdf', 'project-specifications/3/LAS/1l2tMF1kZgeJi2tG8r6yIuudDuYPKWacUVLQSMMx.pdf', 'Comparatif_Plateformes_Musicales.pdf', 3564, 'LAS', NULL, '2025-06-21 19:53:38', '2025-06-21 19:53:38', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_03_21_000001_add_admin_fields_to_users_table', 1),
(5, '2025_05_20_122429_add_usercode_to_users_table', 1),
(6, '2025_05_20_123539_create_projects_table', 1),
(7, '2025_05_20_123540_create_project_permissions_table', 1),
(8, '2025_05_21_082211_add_contre_marque_to_projects_table', 1),
(9, '2025_05_21_140312_add_issues_to_projects_table', 1),
(10, '2025_06_03_125957_create_gammes_table', 1),
(11, '2025_06_03_130017_create_gamme_files_table', 1),
(12, '2025_06_05_092725_create_personal_access_tokens_table', 1),
(13, '2025_06_12_160112_add_size_type_description_to_gamme_files_table', 1),
(14, '2024_03_21_create_activities_table', 2),
(15, '2025_06_18_213445_create_essais_messures_table', 3),
(16, '2025_06_18_213522_create_project_gammes_table', 3),
(17, '2025_06_18_213624_create_essai_messure_gammes_table', 3),
(18, '2025_06_18_213658_add_gamme_links_to_gamme_files_table', 3),
(19, '2025_06_19_000000_create_project_user_table', 4),
(20, '2025_06_18_215823_add_fields_to_essais_messures_table', 5),
(21, '2025_06_20_000000_update_projects_table_for_parent_only', 6),
(22, '2025_06_20_000001_update_essais_messures_table_for_child', 6),
(23, '2025_06_18_234744_drop_name_column_from_projects_table', 7),
(24, '2025_06_19_111802_add_issues_to_essais_messures_table', 8),
(25, '2025_06_11_093536_add_role_and_approval_to_users_table', 9),
(26, '2025_06_21_204231_add_missing_fields_to_gamme_files_table', 9),
(27, '2025_06_21_211647_add_essai_messure_id_to_project_permissions_table', 10);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `person_name` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `contreMarque` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `project_name`, `person_name`, `reference`, `created_at`, `updated_at`, `contreMarque`) VALUES
(3, 2, '4W', 'safsafi', 'ESS2', '2025-06-18 21:30:06', '2025-06-18 21:30:06', ''),
(4, 2, 'O2X', 'simo', 'PRJWQEIAH', '2025-06-18 22:49:36', '2025-06-18 22:49:36', ''),
(5, 10, 'W2', 'Abdeljalil', 'PRJ6856FC7544723', '2025-06-21 17:39:49', '2025-06-21 17:39:49', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `project_gammes`
--

CREATE TABLE `project_gammes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('CTR','LAS','STR') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `project_gammes`
--

INSERT INTO `project_gammes` (`id`, `project_id`, `type`, `created_at`, `updated_at`) VALUES
(1, 3, 'CTR', '2025-06-18 21:30:06', '2025-06-18 21:30:06'),
(2, 3, 'LAS', '2025-06-18 21:30:06', '2025-06-18 21:30:06'),
(3, 3, 'STR', '2025-06-18 21:30:06', '2025-06-18 21:30:06'),
(4, 4, 'CTR', '2025-06-18 22:49:36', '2025-06-18 22:49:36'),
(5, 4, 'LAS', '2025-06-18 22:49:36', '2025-06-18 22:49:36'),
(6, 4, 'STR', '2025-06-18 22:49:36', '2025-06-18 22:49:36');

-- --------------------------------------------------------

--
-- Structure de la table `project_permissions`
--

CREATE TABLE `project_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `permission_type` enum('view','edit') NOT NULL DEFAULT 'view',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `essai_messure_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `project_permissions`
--

INSERT INTO `project_permissions` (`id`, `user_id`, `project_id`, `permission_type`, `created_at`, `updated_at`, `essai_messure_id`) VALUES
(6, 6, 4, 'edit', '2025-06-24 07:40:10', '2025-06-24 07:40:10', 2),
(7, 2, 3, 'edit', '2025-07-02 14:19:07', '2025-07-02 14:19:07', 3);

-- --------------------------------------------------------

--
-- Structure de la table `project_user`
--

CREATE TABLE `project_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `project_user`
--

INSERT INTO `project_user` (`id`, `project_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 4, 6, NULL, NULL),
(2, 3, 6, NULL, NULL),
(3, 5, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2dfM2ynQQ8l2Wx7VLn8ZSciSeEbIZMbhh6OqMH5N', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTllObjRyd0VYamo4NjY5UEY0dHdJR0dUQ2JKdE13VTNLQk1ZYUdaaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751468517),
('7ccCSsZMz7Xl65Vl3MdMQOkCxr6qLzM1FHjD0HNq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM3ZrZE83RE1lQk9leTkyVmFmNXphRXJGcUhRSjZFYUJ3SXhrTFhZdiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly93d3cuc3RlbGxhbnRpcy5jb206ODAwMCI7fX0=', 1751470764),
('uKe74JX1uMUwcQZVOTnP93x5bnROariFf6IDUCGl', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MToiaHR0cDovL3d3dy5zdGVsbGFudGlzLmNvbTo4MDAwL3Byb2plY3RzLzMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiU21ic3VHSFlQbGtjT2dyUkRBWFZyTzFuQ2xvWGFpY3dxRWVabW40YyI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1751978714);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usercode` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `registration_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `approved_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `usercode`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`, `registration_status`, `approved_at`) VALUES
(2, '5NEMFHSS', 'Abdeljalil', 'safsafi593', NULL, '$2y$12$czNNcIg14ELymvqzLMqUm.BO2QX706n2b/Vkp5bttMjRgRkDAKm6W', NULL, '2025-06-12 15:10:01', '2025-06-12 15:10:01', 0, 'approved', '2025-06-12 15:10:01'),
(5, 'LVEDVYK0', 'simo', 'savagemrr617@gmail.com', NULL, '$2y$12$OAhOa2cR3LFdf/8PMJPDyeUdPCwMt3ewrGLS.AIJRVyph06O/XKC2', NULL, '2025-06-12 15:25:31', '2025-06-12 20:49:07', 0, 'approved', '2025-06-12 20:49:07'),
(6, 'LIE3SSAY', 'ahibou', 'ahiboumarouane@gmail.com', NULL, '$2y$12$32cbF0pFSoJqLrnAfqIfeeFGI.OSctUJDfroZdgMQk0/dsks9p9GK', NULL, '2025-06-12 15:38:57', '2025-06-13 08:23:10', 0, 'approved', '2025-06-13 08:23:10'),
(7, 'GECGD5EM', 'safsafi', 'safsafi0001@gmail.com', NULL, '$2y$12$b95OdEH5bci7fRSC8LPl7u3yx5WFKE4npWU59nNnskx4XbVTx6Gue', NULL, '2025-06-20 09:36:52', '2025-07-02 14:10:37', 0, 'approved', '2025-07-02 14:10:37'),
(8, 'ZP0FRBPU', 'safsafi abdeljalil', 'safsafi593@gmail.com', NULL, '$2y$12$yJVz2BnIksDXVoRwqk4bMe8cYROGF4dvLOYInInocVSfxh9poJ5AW', NULL, '2025-06-21 16:45:26', '2025-06-21 17:10:00', 0, 'approved', '2025-06-21 17:10:00'),
(10, 'LKRRE9RL', 'Admin', 'bmci.connect3@gmail.com', NULL, '$2y$12$hmE.Wc1Xvs9aHJAtiUCVt.bihJBdmJ0qsxWdUyYMzjqL4at/G9Fei', NULL, '2025-06-21 16:58:33', '2025-06-21 16:58:33', 1, 'approved', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activities_user_id_foreign` (`user_id`),
  ADD KEY `activities_related_type_related_id_index` (`related_type`,`related_id`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `essais_messures`
--
ALTER TABLE `essais_messures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `essais_messures_project_id_foreign` (`project_id`),
  ADD KEY `essais_messures_user_id_foreign` (`user_id`);

--
-- Index pour la table `essai_messure_gammes`
--
ALTER TABLE `essai_messure_gammes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `essai_messure_gammes_essai_messure_id_foreign` (`essai_messure_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `gammes`
--
ALTER TABLE `gammes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gammes_type_unique` (`type`);

--
-- Index pour la table `gamme_files`
--
ALTER TABLE `gamme_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gamme_files_gamme_id_foreign` (`gamme_id`),
  ADD KEY `gamme_files_project_gamme_id_foreign` (`project_gamme_id`),
  ADD KEY `gamme_files_essai_messure_gamme_id_foreign` (`essai_messure_gamme_id`),
  ADD KEY `gamme_files_project_id_foreign` (`project_id`),
  ADD KEY `gamme_files_essai_messure_id_foreign` (`essai_messure_id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_user_id_foreign` (`user_id`);

--
-- Index pour la table `project_gammes`
--
ALTER TABLE `project_gammes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_gammes_project_id_foreign` (`project_id`);

--
-- Index pour la table `project_permissions`
--
ALTER TABLE `project_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `project_permissions_user_id_project_id_unique` (`user_id`,`project_id`),
  ADD KEY `project_permissions_project_id_foreign` (`project_id`),
  ADD KEY `project_permissions_essai_messure_id_foreign` (`essai_messure_id`);

--
-- Index pour la table `project_user`
--
ALTER TABLE `project_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_user_project_id_foreign` (`project_id`),
  ADD KEY `project_user_user_id_foreign` (`user_id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_usercode_unique` (`usercode`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `essais_messures`
--
ALTER TABLE `essais_messures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `essai_messure_gammes`
--
ALTER TABLE `essai_messure_gammes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `gammes`
--
ALTER TABLE `gammes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `gamme_files`
--
ALTER TABLE `gamme_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `project_gammes`
--
ALTER TABLE `project_gammes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `project_permissions`
--
ALTER TABLE `project_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `project_user`
--
ALTER TABLE `project_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `essais_messures`
--
ALTER TABLE `essais_messures`
  ADD CONSTRAINT `essais_messures_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `essais_messures_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `essai_messure_gammes`
--
ALTER TABLE `essai_messure_gammes`
  ADD CONSTRAINT `essai_messure_gammes_essai_messure_id_foreign` FOREIGN KEY (`essai_messure_id`) REFERENCES `essais_messures` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `gamme_files`
--
ALTER TABLE `gamme_files`
  ADD CONSTRAINT `gamme_files_essai_messure_gamme_id_foreign` FOREIGN KEY (`essai_messure_gamme_id`) REFERENCES `essai_messure_gammes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gamme_files_essai_messure_id_foreign` FOREIGN KEY (`essai_messure_id`) REFERENCES `essais_messures` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gamme_files_gamme_id_foreign` FOREIGN KEY (`gamme_id`) REFERENCES `gammes` (`id`),
  ADD CONSTRAINT `gamme_files_project_gamme_id_foreign` FOREIGN KEY (`project_gamme_id`) REFERENCES `project_gammes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gamme_files_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `project_gammes`
--
ALTER TABLE `project_gammes`
  ADD CONSTRAINT `project_gammes_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `project_permissions`
--
ALTER TABLE `project_permissions`
  ADD CONSTRAINT `project_permissions_essai_messure_id_foreign` FOREIGN KEY (`essai_messure_id`) REFERENCES `essais_messures` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_permissions_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `project_user`
--
ALTER TABLE `project_user`
  ADD CONSTRAINT `project_user_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
