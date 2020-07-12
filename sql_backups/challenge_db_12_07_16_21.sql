/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.4.11-MariaDB : Database - challenge
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`challenge` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `challenge`;

/*Table structure for table `admin` */

CREATE TABLE `admin` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(80) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `admin` */

insert  into `admin`(`id`,`username`,`password`) values (1,'admin','$2y$10$vwUPtFn9QdFT9KNx9DEnJOxg0KGWsZtbfTqcYufromRLjLFRctS4y');

/*Table structure for table `users` */

CREATE TABLE `users` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `surname` varchar(128) DEFAULT NULL,
  `phone` varchar(128) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `discount_codes` */

CREATE TABLE `discount_codes` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `owner_id` int(8) unsigned DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_owner_id` (`owner_id`),
  CONSTRAINT `FK_owner_id` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `discount_codes` */

insert  into `discount_codes`(`id`,`title`,`code`,`owner_id`,`status`) values (1,'Yeni kullanıcılar için geçerli tüm alışverişlerde 15% indirim','EMRE',1,1);
insert  into `discount_codes`(`id`,`title`,`code`,`owner_id`,`status`) values (2,'Yeni kullanıcılar için geçerli tüm alışverişlerde 20% indirim','LAYKA',NULL,0);
insert  into `discount_codes`(`id`,`title`,`code`,`owner_id`,`status`) values (3,'Yeni kullanıcılar için geçerli tüm alışverişlerde 40% indirim','HEKTOR',NULL,0);

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`surname`,`phone`,`email`,`password`,`profile_photo`) values (1,'Emre','Baştürmen','5342655919','ebasturmen@outlook.com','$2y$10$vwUPtFn9QdFT9KNx9DEnJOxg0KGWsZtbfTqcYufromRLjLFRctS4y',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
