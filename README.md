# Work Alarm

Developed on Arch Linux WSL. The project uses mariadb mysql, lighttpd and php.

Requires a database called work_alarm_db with the following tables:

users:

+----------+--------------+------+-----+---------+----------------+

| Field    | Type         | Null | Key | Default | Extra          |

+----------+--------------+------+-----+---------+----------------+

| id       | int(11)      | NO   | PRI | NULL    | auto_increment |

| name     | varchar(50)  | NO   |     | NULL    |                |

| password | varchar(100) | NO   |     | NULL    |                |

+----------+--------------+------+-----+---------+----------------+

admins:

+-------+---------+------+-----+---------+----------------+

| Field | Type    | Null | Key | Default | Extra          |

+-------+---------+------+-----+---------+----------------+

| user  | int(11) | NO   | PRI | NULL    | auto_increment |

+-------+---------+------+-----+---------+----------------+

user references users(id)
