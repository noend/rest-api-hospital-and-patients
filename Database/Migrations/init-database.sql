CREATE SCHEMA `credoweb_api` ;

CREATE TABLE `credoweb_api`.`user` (
                                       `id` INT NOT NULL AUTO_INCREMENT,
                                       `email` VARCHAR(255) NULL,
                                       `first_name` VARCHAR(255) NULL,
                                       `last_name` VARCHAR(255) NULL,
                                       `type` TINYINT(2) NOT NULL,
                                       `workplace_id` INT NULL,
                                       `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                                       PRIMARY KEY (`id`));

CREATE TABLE `credoweb_api`.`hospital` (
                                           `id` INT NOT NULL AUTO_INCREMENT,
                                           `name` VARCHAR(255) NULL,
                                           `address` VARCHAR(255) NULL,
                                           `phone` VARCHAR(32) NULL,
                                           PRIMARY KEY (`id`));

