SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- 1. BẢNG USERS (Tài khoản)
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_type` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1: Admin, 2: Candidate, 3: Employer',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `account_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Quản trị viên', 'admin@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, '2026-04-10 00:00:00', '2026-04-10 00:00:00'),
(2, 'Võ Văn Thành', 'vothanh@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, 1, '2026-04-10 00:00:00', '2026-04-10 00:00:00'),
(3, 'Trần Thanh Thúy', 'thuytran@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, 1, '2026-04-10 00:00:00', '2026-04-10 00:00:00'),
(4, 'FPT Software', 'tuyendung@fpt.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, 1, '2026-04-10 00:00:00', '2026-04-10 00:00:00'),
(5, 'CMC Global', 'tuyendung@cmc.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, 1, '2026-04-10 00:00:00', '2026-04-10 00:00:00');
-- (Pass mặc định cho tất cả user trên là chữ: password)

-- --------------------------------------------------------

-- 2. BẢNG PROFILES (Hồ sơ ứng viên - Quan hệ 1-1 với Users)
CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cv_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `profiles` (`id`, `user_id`, `phone`, `address`, `cv_link`, `created_at`, `updated_at`) VALUES
(1, 2, '0987654321', 'Cầu Giấy, Hà Nội', 'cv_vothanh.pdf', '2026-04-10 00:00:00', '2026-04-10 00:00:00'),
(2, 3, '0912345678', 'Thanh Xuân, Hà Nội', 'cv_thuytran.pdf', '2026-04-10 00:00:00', '2026-04-10 00:00:00');

-- --------------------------------------------------------

-- 3. BẢNG CATEGORIES (Danh mục ngành nghề)
CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Lập trình Web', 'Backend, Frontend, Fullstack', 1, '2026-04-10 00:00:00', '2026-04-10 00:00:00'),
(2, 'Lập trình Mobile', 'iOS, Android, React Native', 1, '2026-04-10 00:00:00', '2026-04-10 00:00:00'),
(3, 'Kiểm thử phần mềm (QA/QC)', 'Manual Test, Automation Test', 1, '2026-04-10 00:00:00', '2026-04-10 00:00:00');
-- --------------------------------------------------------

-- 4. BẢNG JOB_POSTS (Tin tuyển dụng - Quan hệ 1-N với User và Category)
CREATE TABLE `job_posts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'ID Nhà tuyển dụng',
  `category_id` bigint(20) UNSIGNED NOT NULL COMMENT 'ID Ngành nghề',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expire_date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_posts_user_id_foreign` (`user_id`),
  KEY `job_posts_category_id_foreign` (`category_id`),
  CONSTRAINT `job_posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `job_posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `job_posts` (`id`, `user_id`, `category_id`, `title`, `description`, `salary`, `expire_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'PHP Developer (Laravel, MySQL)', 'Làm việc tại tòa nhà FPT Cầu Giấy, phát triển dự án outsource cho thị trường Nhật.', '10.000.000 - 20.000.000 VNĐ', '2026-12-31', 1, '2026-04-10 00:00:00', '2026-04-10 00:00:00'),
(2, 4, 2, 'React Native Developer', 'Phát triển ứng dụng mobile cho khách hàng doanh nghiệp.', '15.000.000 - 30.000.000 VNĐ', '2026-11-30', 1, '2026-04-10 00:00:00', '2026-04-10 00:00:00'),
(3, 5, 3, 'QA/QC Tester (Manual & Auto)', 'Kiểm thử phần mềm tại CMC Global tòa nhà Duy Tân, yêu cầu tiếng Anh tốt.', 'Thoả thuận', '2026-10-15', 1, '2026-04-10 00:00:00', '2026-04-10 00:00:00');

-- --------------------------------------------------------

-- 5. BẢNG SKILLS (Kỹ năng)
CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `skills` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 'PHP', 'Hard Skill', '2026-04-10 00:00:00', '2026-04-10 00:00:00'),
(2, 'Laravel', 'Hard Skill', '2026-04-10 00:00:00', '2026-04-10 00:00:00'),
(3, 'React Native', 'Hard Skill', '2026-04-10 00:00:00', '2026-04-10 00:00:00'),
(4, 'Automation Test', 'Hard Skill', '2026-04-10 00:00:00', '2026-04-10 00:00:00'),
(5, 'Tiếng Nhật N3', 'Soft Skill', '2026-04-10 00:00:00', '2026-04-10 00:00:00');

-- --------------------------------------------------------

-- 6. BẢNG JOB_POST_SKILL (Bảng trung gian nối Bài Đăng và Kỹ Năng)
CREATE TABLE `job_post_skill` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `job_post_id` bigint(20) UNSIGNED NOT NULL,
  `skill_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_post_skill_job_post_id_foreign` (`job_post_id`),
  KEY `job_post_skill_skill_id_foreign` (`skill_id`),
  CONSTRAINT `job_post_skill_job_post_id_foreign` FOREIGN KEY (`job_post_id`) REFERENCES `job_posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `job_post_skill_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `job_post_skill` (`id`, `job_post_id`, `skill_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-04-10 00:00:00', '2026-04-10 00:00:00'),
(2, 1, 2, '2026-04-10 00:00:00', '2026-04-10 00:00:00'),
(3, 2, 3, '2026-04-10 00:00:00', '2026-04-10 00:00:00'),
(4, 2, 5, '2026-04-10 00:00:00', '2026-04-10 00:00:00'),
(5, 3, 4, '2026-04-10 00:00:00', '2026-04-10 00:00:00');

-- --------------------------------------------------------

-- 7. BẢNG APPLICATIONS (Đơn ứng tuyển)
CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'ID Ứng viên nộp CV',
  `job_post_id` bigint(20) UNSIGNED NOT NULL COMMENT 'ID Bài đăng tuyển dụng',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: Chờ duyệt, 1: Đã duyệt, 2: Từ chối',
  `applied_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `applications_user_id_foreign` (`user_id`),
  KEY `applications_job_post_id_foreign` (`job_post_id`),
  CONSTRAINT `applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `applications_job_post_id_foreign` FOREIGN KEY (`job_post_id`) REFERENCES `job_posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `applications` (`id`, `user_id`, `job_post_id`, `status`, `applied_date`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 0, '2026-04-12', '2026-04-12 08:00:00', '2026-04-12 08:00:00'),
(2, 3, 3, 1, '2026-04-15', '2026-04-15 09:30:00', '2026-04-16 10:00:00');

COMMIT;