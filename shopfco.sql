-- =========================
-- USERS
-- =========================
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) UNIQUE NOT NULL,
  email VARCHAR(150) UNIQUE NOT NULL,
  phone VARCHAR(20),
  password TEXT NOT NULL,
  role TINYINT DEFAULT 0 COMMENT '0:client | 1:admin',
  status TINYINT DEFAULT 1 COMMENT '0:inactive | 1:active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =========================
-- WALLETS
-- =========================
CREATE TABLE wallets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  balance DECIMAL(15,2) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

-- =========================
-- TRANSACTIONS
-- =========================
CREATE TABLE transactions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  amount DECIMAL(15,2) NOT NULL,
  type TINYINT COMMENT '0:scratch_card | 1:bank',
  service_type TINYINT COMMENT '0:topup | 1:buy_account',
  status TINYINT DEFAULT 0 COMMENT '0:pending | 1:success | 2:failed',
  request_id VARCHAR(100) UNIQUE,
  provider VARCHAR(50),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

-- =========================
-- NEWS (SEO BLOG)
-- =========================
CREATE TABLE news (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  slug VARCHAR(255) UNIQUE NOT NULL,
  content LONGTEXT NOT NULL,

  meta_title VARCHAR(255),
  meta_description VARCHAR(500),
  meta_keywords VARCHAR(255),

  thumbnail VARCHAR(255),
  published TINYINT DEFAULT 0 COMMENT '0:draft | 1:published',
  view_count INT DEFAULT 0,

  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =========================
-- CATEGORIES
-- =========================
CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  slug VARCHAR(255) UNIQUE NOT NULL,
  description TEXT,
  image VARCHAR(255),

  meta_title VARCHAR(255),
  meta_description VARCHAR(500),

  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- SERVICES (SEO LANDING PAGE)
-- =========================
CREATE TABLE services (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  slug VARCHAR(255) UNIQUE NOT NULL,
  description TEXT,
  image VARCHAR(255),

  meta_title VARCHAR(255),
  meta_description VARCHAR(500),

  used_count INT DEFAULT 0,
  status TINYINT DEFAULT 1 COMMENT '0:inactive | 1:active',

  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- PRODUCTS
-- =========================
CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_id INT NOT NULL,

  title VARCHAR(255) NOT NULL,
  slug VARCHAR(255) UNIQUE NOT NULL,
  content LONGTEXT,

  sell_price DECIMAL(15,2),
  sale_price DECIMAL(15,2),

  meta_title VARCHAR(255),
  meta_description VARCHAR(500),
  type tinyinteger ProductType 1: account, 2:extra
  status TINYINT DEFAULT 0 COMMENT '0:unsold | 1:sold',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  FOREIGN KEY (category_id) REFERENCES categories(id)
);

