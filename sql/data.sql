--  Utilisateurs
INSERT INTO users (nom, email, mot_de_passe, genre, role) VALUES 
('Admin', 'admin@example.com', 'admin', 'F', 'admin'),
('user1', 'user1@example.com', '1234', 'M', 'user'),
('user2', 'user2@example.com', '1234', 'F', 'user'),
('Coralie', 'coralie@example.com', '1234', 'F', 'user'),
('Funaki', 'funaki@example.com', '1234', 'M', 'user'),
('Jean', 'jean@example.com', '1234', 'M', 'user');

--  Régimes
INSERT INTO regimes (nom_regime, pourcentage_viande, pourcentage_poisson, pourcentage_volaille, poids_impact_journalier, prix_journalier) VALUES 
('Minceur Océan', 10, 70, 20, -0.300, 5000),
('Force & Muscle', 60, 10, 30, 0.200, 7500),
('Équilibre Vert', 20, 40, 40, -0.100, 5000),
('Turbo Perte', 0, 50, 50, -0.500, 8000),
('Maintien Vital', 33, 33, 34, 0.100, 6000);    

-- Activités Sportives
INSERT INTO activites_sportives (nom_activite) VALUES 
('Natation'), ('Course à pied'), ('Musculation'), ('Yoga'), ('Cyclisme');

-- Codes Porte-monnaie
INSERT INTO codes_porte_monnaie (code_secret, montant) VALUES 
('RECH-001', 5000), ('RECH-002', 10000), ('RECH-003', 15000),
('RECH-004', 20000), ('RECH-005', 25000), ('RECH-006', 30000),
('RECH-007', 35000), ('RECH-008', 40000), ('RECH-009', 45000),
('RECH-010', 50000), ('RECH-011', 55000), ('RECH-012', 60000),
('RECH-013', 65000), ('RECH-014', 70000), ('RECH-015', 75000);

-- Objectifs
INSERT INTO objectifs (libelle, image_url, description) VALUES
('Perdre du Poids', 'perdre_poids.jpg','Réduisez votre poids corporel avec un programme adapté à votre métabolisme.'),
('Atteindre l''IMC idéal', 'imc_ideal.jpg','Atteignez et maintenez un IMC optimal entre 18.5 et 24.9.'),
('Augmenter son Poids', 'augmenter_poids.jpg','Prenez de la masse musculaire ou retrouvez un poids sain grâce à des régimes riches.');

INSERT INTO prix_gold (prix) VALUES 
(30000);

INSERT INTO user_details (user_id, poids_actuel, taille) VALUES 
(1, 80.0, 175),
(2, 80.5, 180), 
(3, 65.0, 165), 
(4, 70.0, 170), 
(5, 90.0, 185), 
(6, 75.0, 175);