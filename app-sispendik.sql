-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 08 Sep 2020 pada 15.49
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app-sispendik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absences`
--

CREATE TABLE `absences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `absence_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` int(11) NOT NULL,
  `school_id` bigint(20) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` char(1) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'L : Laki-Laki',
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(25, '2014_10_12_000000_create_users_table', 1),
(26, '2014_10_12_100000_create_password_resets_table', 1),
(27, '2019_08_19_000000_create_failed_jobs_table', 1),
(28, '2020_05_11_075048_create_schools_table', 1),
(29, '2020_05_11_081742_create_students_table', 1),
(30, '2020_05_11_083044_create_classes_table', 1),
(31, '2020_05_11_083339_create_employees_table', 1),
(32, '2020_05_11_085021_create_absences_table', 1),
(33, '2020_05_11_085615_create_lessons_table', 1),
(34, '2020_05_11_090847_add_relationships_student_to_class_table', 1),
(35, '2020_05_11_091237_add_relationships_absence_to_lesson_table', 1),
(36, '2020_06_17_050925_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(2, 'App\\User', 3),
(2, 'App\\User', 4),
(2, 'App\\User', 5),
(2, 'App\\User', 6),
(2, 'App\\User', 7),
(2, 'App\\User', 8),
(2, 'App\\User', 9),
(2, 'App\\User', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'read dataSekolah', 'web', '2020-06-29 02:00:25', '2020-06-29 02:00:25'),
(2, 'create dataSekolah', 'web', '2020-06-29 02:00:34', '2020-06-29 02:00:34'),
(3, 'edit dataSekolah', 'web', '2020-06-29 02:00:43', '2020-06-29 02:00:43'),
(4, 'delete dataSekolah', 'web', '2020-06-29 02:00:49', '2020-06-29 02:00:49'),
(5, 'read schoolverified', 'web', '2020-06-29 02:01:32', '2020-06-29 02:01:32'),
(6, 'create schoolverified', 'web', '2020-06-29 02:01:52', '2020-06-29 02:01:52'),
(7, 'edit schoolverified', 'web', '2020-06-29 02:01:58', '2020-06-29 02:01:58'),
(8, 'delete schoolverified', 'web', '2020-06-29 02:02:04', '2020-06-29 02:02:04'),
(9, 'read schoolNotverified', 'web', '2020-06-29 02:02:28', '2020-06-29 02:02:28'),
(10, 'create schoolNotverified', 'web', '2020-06-29 02:02:35', '2020-06-29 02:02:35'),
(11, 'edit schoolNotverified', 'web', '2020-06-29 02:02:41', '2020-06-29 02:02:41'),
(12, 'delete schoolNotverified', 'web', '2020-06-29 02:02:47', '2020-06-29 02:02:47'),
(13, 'read student', 'web', '2020-07-28 23:48:50', '2020-07-28 23:48:50'),
(14, 'create student', 'web', '2020-07-28 23:48:57', '2020-07-28 23:48:57'),
(15, 'edit student', 'web', '2020-07-28 23:49:05', '2020-07-28 23:49:05'),
(16, 'delete student', 'web', '2020-07-28 23:49:14', '2020-07-28 23:49:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'web', '2020-06-29 01:58:52', '2020-06-29 01:58:52'),
(2, 'admin', 'web', '2020-06-29 01:58:57', '2020-06-29 01:58:57'),
(3, 'student', 'web', '2020-06-29 01:59:18', '2020-06-29 01:59:18'),
(4, 'employee', 'web', '2020-06-29 01:59:27', '2020-06-29 01:59:27'),
(5, 'finance', 'web', '2020-06-29 01:59:32', '2020-06-29 01:59:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `schools`
--

CREATE TABLE `schools` (
  `id` bigint(20) NOT NULL,
  `code` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_pos` int(10) DEFAULT NULL,
  `kelurahan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kabupaten` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_sekolah` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenjang_pend` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `schools`
--

INSERT INTO `schools` (`id`, `code`, `name`, `kode_pos`, `kelurahan`, `kecamatan`, `kabupaten`, `provinsi`, `status_sekolah`, `jenjang_pend`, `address`, `created_at`, `updated_at`, `deleted_status`) VALUES
(1, 101, 'Sispendik', 0, '0', '0', '0', '0', '0', '0', 'Jl. Setia Budi Dukuh wringin Kab.Tegal Kec.Slawi', '2020-07-23 06:37:53', '2020-07-23 06:37:53', 0),
(2, 20325270, 'SMK N 1 SLAWi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Slawi', '2020-09-07 09:58:55', '2020-09-07 09:58:55', 0),
(3, 20325258, 'SMK N 1 SLAWi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Slawi', '2020-09-07 10:07:41', '2020-09-07 10:07:41', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nis` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `gender` char(1) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'L : Laki-Laki',
  `school_years` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `id_users` bigint(20) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` char(1) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 : superadmin',
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `activation_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_online` tinyint(1) NOT NULL DEFAULT 0,
  `time_online` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `id_users`, `password`, `remember_token`, `photo`, `api_token`, `role`, `status`, `activation_code`, `status_online`, `time_online`, `created_at`, `updated_at`, `deleted_status`) VALUES
(1, 'Admin Sispendik', 'sispendikapps@gmail.com', '2020-09-03 05:06:11', 101, '$2y$10$n.HLvUSYHuGVrQP/bbwk.OXIwAkyv8/GBocQQif7UNQSLbuYpN2Ha', NULL, NULL, 'asBJ9iwVfqO1km0c2E3FvCX8IXT6ylOUM3CxpNMf', '0', 1, '', 0, NULL, '2020-09-03 05:06:11', '2020-09-07 07:03:18', 0),
(2, 'SMK N 2 SLAWI', 'muhamadlukman937@gmail.com', '2020-09-07 10:06:56', 20325270, '$2y$10$uCALwmeyyVD4rEHO8eBF9eehRShFVaACfu.LzEIXy2URC4EO8CVxe', NULL, NULL, NULL, '1', 0, 'iuEWr3GzJsfEJ115qGBJeHy8kJsjwjvSgLekv2FCepyCbKKKa7UaVQrUHwne', 0, NULL, '2020-09-07 09:58:49', '2020-09-07 10:06:56', 0),
(3, 'SMK N 1 SLAWi', 'muhamadlukman937@gmail.com', NULL, 20325258, '$2y$10$OhQ2MUBOY2i3nHovRAxnOe4m86F7FZZQmFPpZvOQChFaMij/Y3TdO', NULL, NULL, NULL, '1', 0, 'ebAhOzyrh3xjPg9Dor11v2oZDgzee6TSspH54aKzPmz2D3yKh1QwfAyDqKJB', 0, NULL, '2020-09-07 10:07:36', '2020-09-07 10:07:36', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absences`
--
ALTER TABLE `absences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absences_lesson_id_foreign` (`lesson_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indeks untuk tabel `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classes_code_unique` (`code`),
  ADD KEY `school_id` (`school_id`);

--
-- Indeks untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_nip_unique` (`nip`),
  ADD KEY `school_id` (`school_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lessons_code_unique` (`code`),
  ADD KEY `school_id` (`school_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schools_code_unique` (`code`);

--
-- Indeks untuk tabel `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_nis_unique` (`nis`),
  ADD KEY `students_school_id_foreign` (`school_id`),
  ADD KEY `students_class_id_foreign` (`class_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id_users_unique` (`id_users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absences`
--
ALTER TABLE `absences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `schools`
--
ALTER TABLE `schools`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absences`
--
ALTER TABLE `absences`
  ADD CONSTRAINT `absences_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id_users`),
  ADD CONSTRAINT `absences_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`);

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
