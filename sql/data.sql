-- --------------------------------------------------------
-- INSERTION DES DONNÉES MINIMALES REQUISES
-- --------------------------------------------------------

-- 5 Utilisateurs
INSERT INTO users (nom, email, mot_de_passe, genre, role) VALUES 
('Coralie', 'coralie@example.com', 'hash_mdp', 'F', 'user'),
('Admin', 'admin@fit.mg', 'hash_admin', 'M', 'admin'),
('Jean', 'jean@example.com', 'hash_mdp', 'M', 'user'),
('Miora', 'miora@example.com', 'hash_mdp', 'F', 'user'),
('Tahina', 'tahina@example.com', 'hash_mdp', 'M', 'user');

-- 5 Régimes (Impact par jour)
INSERT INTO regimes (nom_regime, pourcentage_viande, pourcentage_poisson, pourcentage_volaille, poids_impact_journalier, prix_journalier) VALUES 
('Minceur Océan', 10, 70, 20, -0.300, 5000),
('Force & Muscle', 60, 10, 30, 0.200, 7500),
('Équilibre Vert', 20, 40, 40, -0.100, 4500),
('Turbo Perte', 0, 50, 50, -0.500, 8000),
('Maintien Vital', 33, 33, 34, 0.000, 4000);    

-- 5 Activités Sportives
INSERT INTO activites_sportives (nom_activite) VALUES 
('Natation'), ('Course à pied'), ('Musculation'), ('Yoga'), ('Cyclisme');

-- 15 Codes Porte-monnaie
INSERT INTO codes_porte_monnaie (code_secret, montant) VALUES 
('RECH-001', 5000), ('RECH-002', 10000), ('RECH-003', 15000),
('RECH-004', 20000), ('RECH-005', 5000), ('RECH-006', 10000),
('RECH-007', 25000), ('RECH-008', 50000), ('RECH-009', 10000),
('RECH-010', 5000), ('RECH-011', 15000), ('RECH-012', 2000),
('RECH-013', 10000), ('RECH-014', 30000), ('RECH-015', 10000);

-- 3 Objectifs
INSERT INTO objectifs (libelle, image_url, description) VALUES
('Perdre du Poids', 'perdre_poids.jpg','Réduisez votre poids corporel avec un programme adapté à votre métabolisme.'),
('Atteindre l''IMC idéal', 'imc_ideal.jpg','Atteignez et maintenez un IMC optimal entre 18.5 et 24.9.'),
('Augmenter son Poids', 'augmenter_poids.jpg','Prenez de la masse musculaire ou retrouvez un poids sain grâce à des régimes riches.');

INSERT INTO prix_gold (prix) VALUES 
(30000);