CREATE TABLE `vcard_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `card_id` varchar(191) NOT NULL,
  `product_id` varchar(191) NOT NULL,
  `badge` longtext NOT NULL,
  `product_image` longtext NOT NULL,
  `product_name` longtext NOT NULL,
  `product_subtitle` longtext DEFAULT NULL,
  `regular_price` double(15,2) NOT NULL,
  `sales_price` double(15,2) NOT NULL,
  `product_status` varchar(191) NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (id) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `vcard_products` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `vcard_products` ADD `currency` VARCHAR(191) NOT NULL AFTER `badge`;

CREATE TABLE `visitors` (
  `id` int(10) UNSIGNED NOT NULL,
  `card_id` varchar(191) NOT NULL,
  `type` varchar(191) NOT NULL,
  `ip_address` varchar(191) NOT NULL,
  `platform` varchar(191) NOT NULL,
  `device` varchar(191) NOT NULL,
  `language` varchar(191) NOT NULL,
  `user_agent` varchar(191) NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `visitors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `pages` ADD `status` VARCHAR(191) NOT NULL DEFAULT 'active' AFTER `keywords`;
ALTER TABLE `business_cards` ADD `enquiry_email` TEXT NULL AFTER `description`;
INSERT INTO `config` (`config_key`, `config_value`) VALUES ('tiny_api_key', 'YOUR_TINY_API_KEY');
ALTER TABLE `settings` ADD `custom_css` TEXT NULL AFTER `tawk_chat_bot_key`, ADD `custom_scripts` TEXT NULL AFTER `custom_css`;
ALTER TABLE `users` ADD `choosed_theme` VARCHAR(191) NOT NULL DEFAULT 'light' AFTER `id`;