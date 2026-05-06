# Projet: Appplication de sante

- [] comprendre les objectifs du sujet

## Commencement
- [] creation de la base de donnees
    - [] creer les tables
        - [] users 
        (id,nom,email,date_naissance,mot_de_passe,genre,role,is_gold, solde_monnaie,created_at)

        - [] user_details
        (id,user_id,poids_actuel,taille,update_at)

        - [] regimes
        (id,nom_regime,description,%viande,%poisson.%volaille,poids_impact_journalier,prix_journalier)

        - [] activites_sportives
        (id,nom_activite)

        - [] codes_porte_monnaie
        (id,code_secret,montant,est_valide)
        
        - [] achats_programmes
        (id,user_id,regime_id,sport_id,poides_depart,poids_objectif,duree_jours,prix_total_paye,date_achat)
    
    - [] inserer les donnees de teste

- [] creer le dossier de depart du projet
    - [] prendre le code original de base de codeigniter

- [] configurations
    - [] configurer la connection base de donnees

- [] creation de models + controllers de base (CRUD) pour :
    - [] table 'users'
    - [] table 'regimes'
    - [] table 'activites_sportives'
    - [] table 'code_porte_monnaie'
    - [] table 'achats_programmes'

- [] creer le formulaire d'Inscription
    - [] informations personnelles + contact
        (nom, prenom,genre, email, adresse)
    - [] informations de santes 
        (poids, taille)
    - [] securite
        (pwd)

- [] creer le formulaire de login
    - [] email + mot de passe

- [] Profil de l'utilisateur 
    - [] Informations personnelles 
        - [] Nom, prénom, date de naissance, email, adresse 
        - [] solde dans mon porte-monnaie
    - [] Informations de santé 
        - [] Genre, poids actuel, taille
    - [] Affiche son indice de masse corporelle(IMC)
    
    - [] creer formulaire pour completer ou modifier les informations de l'utilisateur
        - [] informations personnelles + contact
            (nom, prenom, genre, date_naissance, email, adresse)
        - [] informations de santes 
            (poids, taille)
        - [] securite
            (pwd)

    - [] porte monnaie
        - [] bouton 'Recharger mon porte-monnaie'
        - [] saisi du code de recharge
        - [] validation du transaction

- [] Page pour voir les suggestions de regimes adequats
    - [] choisir l'objectif a atteindre
        - [] gain de poids (saisir le poids cible)
        - [] perte de poids (saisir le poids cible)
        - [] atteindre IMC ideal
    
    - [] Afficher les regimes qui correspondent aux objectifs choisis de l'utilisateur
        - [] affichage de regime: nom_regime, %nutriments, effet par jour, prix par jour, duree, prix total, activite sportive adequat
