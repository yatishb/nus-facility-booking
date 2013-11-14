CREATE TABLE region (
reg_id CHAR(10) PRIMARY KEY,
name VARCHAR(256) NOT NULL,
location VARCHAR(256)
);

CREATE TABLE user (
user_id CHAR(8) PRIMARY KEY,
name VARCHAR(32) NOT NULL,
password CHAR(32) NOT NULL,
is_admin BOOLEAN
);

CREATE TABLE facility (
fac_id CHAR(10),
reg_id CHAR(10),
open_time TIME NOT NULL,
close_time TIME NOT NULL,
capacity INT NOT NULL,
name VARCHAR(100) NOT NULL,
FOREIGN KEY (reg_id) REFERENCES region(reg_id) ON DELETE CASCADE,
PRIMARY KEY (fac_id,reg_id),
CHECK(close_time > open_time)
);

CREATE TABLE booking (
book_id CHAR(10),
fac_id CHAR(10),
reg_id CHAR(10),
user_id CHAR(10),
start DATETIME NOT NULL,
end DATETIME NOT NULL,
FOREIGN KEY (fac_id, reg_id) REFERENCES facility(fac_id, reg_id) ON DELETE SET NULL,
FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE,
PRIMARY KEY (book_id),
CHECK (end > start)
);

CREATE TABLE academic (
fac_id CHAR(10),
reg_id CHAR(10),
whiteboard BOOLEAN DEFAULT FALSE,
audio_system BOOLEAN DEFAULT FALSE,
projector BOOLEAN DEFAULT FALSE,
FOREIGN KEY (fac_id, reg_id) REFERENCES facility(fac_id, reg_id) ON DELETE CASCADE,
PRIMARY KEY (fac_id,reg_id)
);

CREATE TABLE sports (
fac_id CHAR(10),
reg_id CHAR(10),
scoreboard BOOLEAN DEFAULT FALSE,
spectator_area BOOLEAN DEFAULT FALSE,
FOREIGN KEY (fac_id, reg_id) REFERENCES facility(fac_id, reg_id) ON DELETE CASCADE,
PRIMARY KEY (fac_id,reg_id)
);