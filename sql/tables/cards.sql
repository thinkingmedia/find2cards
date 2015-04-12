/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `game_id` int(10) unsigned NOT NULL,
  `order` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cards_users_idx` (`user_id`),
  KEY `cards_games_idx` (`game_id`),
  KEY `order` (`order`),
  CONSTRAINT `cards_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cards_games` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=889 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
