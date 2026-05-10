CREATE DATABASE IF NOT EXISTS regime_db;
USE regime_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    date_naissance DATE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    genre ENUM('M', 'F') NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    is_gold BOOLEAN DEFAULT FALSE, 
    solde_monnaie DECIMAL(10, 2) DEFAULT 0.00,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE objectifs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(100) NOT NULL,
    image_url VARCHAR(255),
    description TEXT
);

CREATE TABLE user_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    poids_actuel DECIMAL(5, 2) NOT NULL,
    taille DECIMAL(5, 2) NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE user_objectifs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    objectif_id INT NOT NULL,
    poids_cible INT NOT NULL,
    date_selection TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (objectif_id) REFERENCES objectifs(id) ON DELETE CASCADE
);

CREATE TABLE regimes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_regime VARCHAR(100) NOT NULL,
    description TEXT,
    pourcentage_viande DECIMAL(5, 2) NOT NULL,
    pourcentage_poisson DECIMAL(5, 2) NOT NULL, 
    pourcentage_volaille DECIMAL(5, 2) NOT NULL,
    poids_impact_journalier DECIMAL(5, 3) NOT NULL, 
    prix_journalier DECIMAL(10, 2) NOT NULL,
    CONSTRAINT check_total_percent CHECK (pourcentage_viande + pourcentage_poisson + pourcentage_volaille = 100)
);

CREATE TABLE activites_sportives (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_activite VARCHAR(100) NOT NULL,
    description TEXT
);

CREATE TABLE codes_porte_monnaie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code_secret VARCHAR(20) UNIQUE NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    est_valide BOOLEAN DEFAULT TRUE -- Devient FALSE une fois utilisé
);

CREATE TABLE achats_programmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    regime_id INT NOT NULL,
    sport_id INT NOT NULL,
    poids_depart DECIMAL(5, 2) NOT NULL,
    poids_objectif DECIMAL(5, 2) NOT NULL,
    duree_jours INT NOT NULL,
    prix_total_paye DECIMAL(10, 2) NOT NULL,
    date_achat TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (regime_id) REFERENCES regimes(id),
    FOREIGN KEY (sport_id) REFERENCES activites_sportives(id)
);

CREATE TABLE porte_monnaie_transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    type_transaction ENUM('credit', 'debit') NOT NULL,
    description TEXT,
    date_transaction TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);