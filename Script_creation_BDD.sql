DROP SCHEMA IF EXISTS bdd_flomadau CASCADE;
CREATE SCHEMA bdd_flomadau;
SET SCHEMA 'bdd_flomadau';

--Gestion des comptes


CREATE TABLE Compte (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    telephone VARCHAR(20) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    ville VARCHAR(50) NOT NULL,
    code_postal VARCHAR(10) NOT NULL,
    nom_rue VARCHAR(100) NOT NULL,
    numero_rue INT NOT NULL,
    est_pro BOOLEAN DEFAULT FALSE,
    complement_adresse VARCHAR(20),
    url_photo_profil VARCHAR(255)
);


CREATE TABLE Professionnel (
    code SERIAL PRIMARY KEY,
    raison_sociale VARCHAR(50) NOT NULL,
    id_compte INT NOT NULL,
    est_prive BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_compte) REFERENCES Compte(id) ON DELETE CASCADE
);


CREATE TABLE Pro_prive (
    siren INT NOT NULL,
    numero_carte BIGINT,
    code_securite INT,
    date_expiration DATE,
    code_professionnel INT PRIMARY KEY,
    FOREIGN KEY (code_professionnel) REFERENCES Professionnel(code) ON DELETE CASCADE
);


CREATE TABLE Pro_publique (
    association BOOLEAN DEFAULT FALSE,
    code_professionnel INT PRIMARY KEY,
    FOREIGN KEY (code_professionnel) REFERENCES Professionnel(code) ON DELETE CASCADE
);

CREATE TABLE Membre (
    code SERIAL PRIMARY KEY,
    pseudo VARCHAR(25) NOT NULL,
    id_compte INT NOT NULL,
    FOREIGN KEY (id_compte) REFERENCES Compte(id) ON DELETE CASCADE
);

--Gestion des offres

CREATE TABLE Offre (
    id SERIAL PRIMARY KEY,
    titre VARCHAR(50) NOT NULL,
    resume VARCHAR(155) NOT NULL,
    ville VARCHAR(50) NOT NULL,
    code_postal VARCHAR(10) NOT NULL,
    categorie VARCHAR(20) NOT NULL,
    conditions_accessibilite VARCHAR(300) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    en_ligne BOOLEAN DEFAULT TRUE,
    date_creation DATE DEFAULT CURRENT_DATE,
    description_detaillee VARCHAR(500) NOT NULL,
    nom_rue VARCHAR(100),
    numero_rue INT,
    complement_adresse VARCHAR(20),
    site_web VARCHAR(255),
    note_moyenne REAL DEFAULT 0,
    nombre_avis INT DEFAULT 0,
    code_professionnel INT NOT NULL,
    FOREIGN KEY (code_professionnel) REFERENCES Professionnel(code) ON DELETE CASCADE
);


-- gestion offres > gestion des tags
CREATE TABLE Tag(
    id SERIAL PRIMARY KEY,
    nom_tag VARCHAR(50) NOT NULL,
    tag_restaurant BOOLEAN DEFAULT FALSE
);


-- gestion offres > gestion des jours d'ouverture pour une offre
CREATE TABLE Jour_ouverture(
    id SERIAL PRIMARY KEY,
    nom_jour VARCHAR(10) NOT NULL
);


-- gestion offres > gestion des options visibilite (en relief, a la une)
CREATE TABLE Option_visibilite (
    id SERIAL PRIMARY KEY,
    nom_option VARCHAR(10),
    prix REAL NOT NULL
);


-- gestion offres > gestion des images
CREATE TABLE Image (
    id SERIAL PRIMARY KEY,
    url_img VARCHAR(255),
    principale BOOLEAN DEFAULT FALSE,
    id_offre INT NOT NULL,
    FOREIGN KEY (id_offre) REFERENCES Offre(id) ON DELETE CASCADE
);


-- gestion offres > gestion des l'état en ligne / hors ligne
CREATE TABLE En_ligne (
    id SERIAL PRIMARY KEY,
    mise_en_ligne DATE,
    mise_hors_ligne DATE,
    id_offre INT NOT NULL,
    FOREIGN KEY (id_offre) REFERENCES Offre(id) ON DELETE CASCADE
);


-- gestion offres > gestion des avis
CREATE TABLE Avis (
    id SERIAL PRIMARY KEY,
    titre VARCHAR(50) NOT NULL,
    note REAL NOT NULL,
    commentaire VARCHAR(255) NOT NULL,
    date_visite DATE NOT NULL,
    contexte_visite VARCHAR(50) NOT NULL,
    date_publication DATE DEFAULT CURRENT_DATE,
    nb_like INT DEFAULT 0,
    nb_dislike INT DEFAULT 0,
    signalements INT DEFAULT 0,
    signalement_pro BOOLEAN DEFAULT FALSE,
    id_offre INT NOT NULL,
    code_membre INT NOT NULL,
    FOREIGN KEY (id_offre) REFERENCES Offre(id) ON DELETE CASCADE,
    FOREIGN KEY (code_membre) REFERENCES Membre(code) ON DELETE CASCADE
);


-- gestion offres > gestion des avis > réponse pro
CREATE TABLE Reponse_pro (
    id SERIAL PRIMARY KEY,
    reponse VARCHAR(255) NOT NULL,
    signalement BOOLEAN DEFAULT FALSE,
    id_avis INT NOT NULL,
    FOREIGN KEY (id_avis) REFERENCES Avis(id) ON DELETE CASCADE
);


CREATE TABLE Spectacle (
    prix_minimal REAL NOT NULL,
    duree VARCHAR(10) NOT NULL,
    capacite INT NOT NULL,
    id_offre INT PRIMARY KEY,
    FOREIGN KEY (id_offre) REFERENCES Offre(id) ON DELETE CASCADE
);


CREATE TABLE Activite (
    prix_minimal REAL NOT NULL,
    duree VARCHAR(10) NOT NULL,
    age_requis INT NOT NULL,
    prestations_incluses VARCHAR(100) NOT NULL,
    prestations_non_incluses VARCHAR(100) NOT NULL,
    id_offre INT PRIMARY KEY,
    FOREIGN KEY (id_offre) REFERENCES Offre(id) ON DELETE CASCADE
);


CREATE TABLE Parc_attraction (
    url_plan VARCHAR(255) NOT NULL,
    nombre_attraction INT NOT NULL,
    prix_minimal REAL NOT NULL,
    age_requis INT NOT NULL,
    id_offre INT PRIMARY KEY,
    FOREIGN KEY (id_offre) REFERENCES Offre(id) ON DELETE CASCADE
);


-- gestion offres > gestion des langues pour la visite guidée
CREATE TABLE Langue_guide(
    id SERIAL PRIMARY KEY,
    nom_langue VARCHAR(50) UNIQUE
);


CREATE TABLE Visite (
    prix_minimal REAL NOT NULL,
    duree VARCHAR(10) NOT NULL,
    guidee BOOLEAN DEFAULT FALSE,
    id_offre INT PRIMARY KEY,
    FOREIGN KEY (id_offre) REFERENCES Offre(id) ON DELETE CASCADE
);


-- gestion offres > gestion des types de repas servis
CREATE TABLE Type_repas(
    id SERIAL PRIMARY KEY,
    nom_type VARCHAR(20)
);


CREATE TABLE Restaurant (
    gamme_de_prix INT NOT NULL,
    url_carte_restaurant VARCHAR(255),
    id_offre INT PRIMARY KEY,
    FOREIGN KEY (id_offre) REFERENCES Offre(id) ON DELETE CASCADE
);


-- Associations


-- Association entre langues_visite et visite
CREATE TABLE Langue_guide_visite (
    id_langue INT NOT NULL,
    id_offre INT NOT NULL,
    PRIMARY KEY(id_offre, id_langue),
    FOREIGN KEY (id_langue) REFERENCES Langue_guide(id) ON DELETE CASCADE,
    FOREIGN KEY (id_offre) REFERENCES Visite(id_offre) ON DELETE CASCADE
);


-- Association entre type_repas et restaurant
CREATE TABLE Type_repas_restaurant (
    id_type INT NOT NULL,
    id_offre INT NOT NULL,
    PRIMARY KEY(id_offre, id_type),
    FOREIGN KEY (id_type) REFERENCES Type_repas(id) ON DELETE CASCADE,
    FOREIGN KEY (id_offre) REFERENCES Restaurant(id_offre) ON DELETE CASCADE
);


-- Association entre les offres et leurs tags
CREATE TABLE Tag_offre (
    id_offre INT NOT NULL,
    id_tag INT NOT NULL,
    PRIMARY KEY(id_offre, id_tag),
    FOREIGN KEY (id_offre) REFERENCES Offre(id) ON DELETE CASCADE,
    FOREIGN KEY (id_tag) REFERENCES Tag(id) ON DELETE CASCADE
);


-- Association entre les offres et leurs jours d'ouverture
CREATE TABLE Jour_ouverture_offre (
    id_offre INT NOT NULL,
    id_jour INT NOT NULL,
    horaire_debut TIME NOT NULL,
    horaire_fin TIME NOT NULL,
    PRIMARY KEY(id_offre, id_jour, horaire_debut),
    FOREIGN KEY (id_offre) REFERENCES Offre(id) ON DELETE CASCADE,
    FOREIGN KEY (id_jour) REFERENCES Jour_ouverture(id) ON DELETE CASCADE,
    CONSTRAINT chk_horaires CHECK (horaire_fin > horaire_debut)
);


-- Association entre une offre et les options souscrites
CREATE TABLE Option_souscrite(
    id_offre INT NOT NULL,
    id_option INT NOT NULL,
    nombre_jour INT NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    PRIMARY KEY(id_offre, id_option),
    FOREIGN KEY (id_offre) REFERENCES Offre(id) ON DELETE CASCADE,
    FOREIGN KEY (id_option) REFERENCES Option_visibilite(id) ON DELETE CASCADE
);
