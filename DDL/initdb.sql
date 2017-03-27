USE dev;

CREATE TABLE users (
  id       INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(255),
  KEY `i_username` (`username`)
);

INSERT INTO dev.users (username)
VALUES ('name1'), ('name12'), ('name13'), ('name4');