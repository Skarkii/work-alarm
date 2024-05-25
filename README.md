# Work Alarm

Developed on Arch Linux WSL. The project uses mariadb mysql, lighttpd and php.

Requires a database called work_alarm_db with the following tables:
```mysql
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
)
```

```mysql
CREATE TABLE `admins` (
  `user` int(11) NOT NULL,
  KEY 'user' (`user`),
  CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`)
)
```

```mysql
CREATE TABLE `managers` (
  `user` int(11) NOT NULL DEFAULT,
  KEY `user` (`user`),
  CONSTRAINT `managers_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`)
)
```

with full permissions for the user 'srv'@'localhost' with password 'srvdbpass'
