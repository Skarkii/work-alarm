# Work Alarm

Developed on Arch Linux WSL. The project uses mariadb mysql, lighttpd and php.

Requires a database called work_alarm_db with the following tables:
```
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
)
```

```
CREATE TABLE `admins` (
  `user` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`user`),
  CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`)
)
```
