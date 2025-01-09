-- Active: 1734863141074@@127.0.0.1@3307@devto_db
DROP DATABASE IF EXISTS devto_db;
CREATE DATABASE devto_db;


USE devto_db;


CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    pass VARCHAR(255) NOT NULL,
    bio TEXT,
    profile_picture VARCHAR(255),
    role ENUM('admin', 'author', 'user') NOT NULL DEFAULT 'user'
) ;

CREATE TABLE categories (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    categorie_name TEXT NOT NULL
) ;

CREATE TABLE tags (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name_tag VARCHAR(255) NOT NULL UNIQUE
) ;

CREATE TABLE articles (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    featured_image VARCHAR(255),
    status ENUM('draft', 'published') NOT NULL DEFAULT 'draft',
    category_id BIGINT NOT NULL,
    author_id BIGINT NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    views INTEGER DEFAULT 0,
    UNIQUE KEY idx_articles_slug (slug),
    KEY idx_articles_category (category_id),
    KEY idx_articles_author (author_id),
    CONSTRAINT fk_articles_category FOREIGN KEY (category_id) 
        REFERENCES categories (id),
    CONSTRAINT fk_articles_author FOREIGN KEY (author_id) 
        REFERENCES users (id)
) ;

CREATE TABLE article_tags (
    article_id BIGINT UNSIGNED,
    tag_id BIGINT,
    PRIMARY KEY (article_id, tag_id),
    CONSTRAINT fk_article_tags_article FOREIGN KEY (article_id) 
        REFERENCES articles (id) ON DELETE CASCADE,
    CONSTRAINT fk_article_tags_tag FOREIGN KEY (tag_id) 
        REFERENCES tags (id) ON DELETE CASCADE
) ;


INSERT INTO users (username, email, pass, bio, profile_picture, role) VALUES
('hmizzo', 'hamza@gmail.com', '123456', 'Software developer with a passion for open-source projects.', 'https://cdn.sofifa.net/players/158/023/25_120.png', 'admin');

ALTER TABLE articles
DROP COLUMN excerpt,
DROP COLUMN meta_description;

UPDATE users SET role = 'admin' where id = 10;

CREATE TABLE author_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    request_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



ALTER TABLE users ADD Banned BOOLEAN DEFAULT FALSE;

ALTER TABLE articles ADD created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
 


