CREATE DATABASE IF NOT EXISTS queromoo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE queromoo;

CREATE TABLE IF NOT EXISTS produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(255) NOT NULL,
  descricao TEXT NOT NULL,
  preco DECIMAL(10,2) NOT NULL,
  imagem VARCHAR(255) DEFAULT NULL,
  categoria VARCHAR(120) NOT NULL,
  estoque INT NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(160) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO admins (name, email, password)
VALUES ('Admin', 'admin@queromoo.com', 'admin123')
ON DUPLICATE KEY UPDATE email = email;

INSERT INTO produtos (nome, descricao, preco, imagem, categoria, estoque)
VALUES
('Queijo Canastra Reserva', 'Textura firme, sabor intenso e maturacao lenta.', 89.90, '', 'Curados', 12),
('Queijo Minas Frescal', 'Leve, suave e perfeito para cafes e saladas.', 32.50, '', 'Frescos', 20),
('Queijo Gouda Artesanal', 'Notas adocicadas e final cremoso.', 64.90, '', 'Semi-curados', 8)
ON DUPLICATE KEY UPDATE nome = nome;
