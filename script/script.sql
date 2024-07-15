-- Création de la base de données
CREATE DATABASE garage;

-- Utilisation de la base de données
USE garage;

-- Création de la table vehicule
CREATE TABLE vehicule (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type ENUM('legere', '4x4', 'utilitaire') NOT NULL,
    immatriculation VARCHAR(20) NOT NULL UNIQUE
);

-- Création de la table service
CREATE TABLE service (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    duree INT NOT NULL,
    date_paiement DATE
);

-- Création de la table slot
CREATE TABLE slot(
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero CHAR(1) NOT NULL UNIQUE -- Assumant que les numéros de slot sont A, B, C, etc.
);

-- Création de la table rendez_vous
CREATE TABLE rendez_vous (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_debut DATE NOT NULL,
    date_fin TIME NOT NULL,
    id_service INT NOT NULL,
    id_slot INT NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    id_vehicule INT NOT NULL,
    FOREIGN KEY (id_service) REFERENCES service(id),
    FOREIGN KEY (id_slot) REFERENCES slot(id),
    FOREIGN KEY (id_vehicule) REFERENCES vehicule(id)
);

--Creation de la table admin
CREATE TABLE administrateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255),
    mots_de_passe VARCHAR(255)
);

CREATE TABLE date_reference (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_reference DATE
);