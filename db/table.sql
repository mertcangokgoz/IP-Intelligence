-- ipintel.ip_address definition

CREATE DATABASE IF NOT EXISTS `ipintel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE ipintel.ip_address
(
    id         INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    ip_address INTEGER UNSIGNED    NOT NULL UNIQUE,
    created_at TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;
