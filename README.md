# Work Alarm

Developed on Arch Linux WSL. The project uses mariadb mysql, lighttpd and php.

Requires a database called work_alarm_db with the following tables:

(Updated, now create db from database.sql)

Still Requires:

```mysql
INSERT INTO is_alive (device) VALUES (1);
INSERT INTO alarm_config (config, value) VALUES ("activated", 1);
INSERT INTO alarm_config (config, value) VALUES ("time_upon_empty", 1);
```

with full permissions for the user 'srv'@'localhost' with password 'srvdbpass'

Some example users:
```mysql
INSERT INTO users (name, password) VALUES ("admin", "$2y$10$b7nUk2.E5p5U6tb9KcbxYeab3AhXgDvCiJ4nTMA2ph6qsPerP5GZK");
INSERT INTO users (name, password) VALUES ("manager", "$2y$10$1pPSys/S/j7a9N919al4q.J8s9p22HxsAQwkB6Za/pZ6uveG72UgW");
INSERT INTO users (name, password) VALUES ("test", "$2y$10$6YADsO4yCklIPGPQAE6bZ.1oSO8Zxb83jAVFST7jvDD/BeIAVn/R.");

INSERT INTO admins (user) VALUES (1);
INSERT INTO managers (user) VALUES (2);
```
# Start Server
```sh
sudo systemctl start lighttpd
sudo systemctl start mysql
```

Then run ``/client/main.py`` on raspberry pi
