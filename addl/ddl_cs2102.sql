CREATE TABLE region (
reg_id BIGINT PRIMARY KEY,
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
fac_id BIGINT,
reg_id BIGINT,
open_time TIME NOT NULL,
close_time TIME NOT NULL,
capacity INT NOT NULL,
name VARCHAR(100) NOT NULL,
type VARCHAR(10) NOT NULL,
FOREIGN KEY (reg_id) REFERENCES region(reg_id) ON DELETE CASCADE,
PRIMARY KEY (fac_id,reg_id),
CONSTRAINT CHECK(close_time > open_time),
CHECK(type IN ('academic','sports'))
);

CREATE TABLE booking (
book_id BIGINT,
fac_id BIGINT,
reg_id BIGINT,
user_id CHAR(10),
start DATETIME NOT NULL,
end DATETIME NOT NULL,
FOREIGN KEY (fac_id, reg_id) REFERENCES facility(fac_id, reg_id) ON DELETE SET NULL,
FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE,
PRIMARY KEY (book_id),
CHECK (end > start)
);

CREATE TABLE academic (
fac_id BIGINT,
reg_id BIGINT,
whiteboard BOOLEAN DEFAULT FALSE,
audio_system BOOLEAN DEFAULT FALSE,
projector BOOLEAN DEFAULT FALSE,
FOREIGN KEY (fac_id, reg_id) REFERENCES facility(fac_id, reg_id) ON DELETE CASCADE,
PRIMARY KEY (fac_id,reg_id)
);

CREATE TABLE sports (
fac_id BIGINT,
reg_id BIGINT,
scoreboard BOOLEAN DEFAULT FALSE,
spectator_area BOOLEAN DEFAULT FALSE,
FOREIGN KEY (fac_id, reg_id) REFERENCES facility(fac_id, reg_id) ON DELETE CASCADE,
PRIMARY KEY (fac_id,reg_id)
);