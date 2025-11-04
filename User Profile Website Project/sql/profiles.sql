CREATE TABLE profiles(
    id          INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_name   VARCHAR(255) NOT NULL,
    image_path  VARCHAR(255) NOT NULL,
    created_at  DATETIME DEFAULT CURRENT_TIMESTAMP
);