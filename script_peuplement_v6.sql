SET SCHEMA 'bdd_flomadau';

--IMPORTANT : les mots de passes seront hachés dans la base (sous la forme : $2a$10$sV.zX7y.N1o.G9r.C2a.J4d.QpQ.rF9vX2b.7kM.wZ5o.P1u.L6o.G), 
--ils sont en clair pour l'exemple

-- GESTION DES COMPTES --

-- Création des membres

-- Insertion pour le premier membre
WITH compte1_membre_cte AS (
    INSERT INTO Compte (nom, prenom, email, telephone, mot_de_passe, ville, code_postal, nom_rue, numero_rue, complement_adresse, url_photo_profil)
    VALUES ('Morel', 'Lucas', 'lucas.morel@email-azur.com', '0493123456', '$2y$10$0t1kmjnBucJVQtE3LRE.CeT2m8UEsuBPSa5XTIC5lYuyqL55OagvO', 'Nice', 06000, 'Promenade des Anglais', 10, 'bis', 'pp_compte_1')
    RETURNING id
)
INSERT INTO Membre (pseudo, id_compte)
SELECT 'LMorelAzur', id FROM compte1_membre_cte;

-- Insertion pour le deuxième membre
WITH compte2_membre_cte AS (
    INSERT INTO Compte (nom, prenom, email, telephone, mot_de_passe, ville, code_postal, nom_rue, numero_rue)
    VALUES ('Petit', 'Chloé', 'chloe.petit@agence-riviera.fr', '0492987654', '$2y$10$yZiWjqafL9tnQc4HnkERr.JW5bxb6.d1o2O30EEot38GYurbuPVC6', 'Cannes', 06400, 'Boulevard de la Croisette', 50)
    RETURNING id
)
INSERT INTO Membre (pseudo, id_compte)
SELECT 'CPetitRiviera', id FROM compte2_membre_cte;

-- Insertion pour le troisième membre
WITH compte3_membre_cte AS (
    INSERT INTO Compte (nom, prenom, email, telephone, mot_de_passe, ville, code_postal, nom_rue, numero_rue, complement_adresse, url_photo_profil)
    VALUES ('Garcia', 'Hugo', 'hugo.garcia@monaco-style.mc', '0037797123', '$2y$10$793PTUaVOyMER4kIm0nXXe3r0b2JD1xwpLANAtnjW4JASJYXfUzSe', 'Monaco', 98000, 'Avenue Princesse Grace', 22, 'ter', 'pp_compte_3')
    RETURNING id
)
INSERT INTO Membre (pseudo, id_compte)
SELECT 'HGarciaMC', id FROM compte3_membre_cte;


-- Création des professionnels

-- Premier professionnel privé
WITH compte1_pro_cte AS (
    INSERT INTO Compte (nom, prenom, email, telephone, mot_de_passe, ville, code_postal, nom_rue, numero_rue, est_pro)
    VALUES ('Bernard', 'Sophie', 'sophie.bernard.art@email-azur.com', '0493010203', '$2y$10$wVpLvsyVo0rtil3arfeDO.vo29G3Aj.pZr4Mpx40.XcGF.an1j2Ve', 'Nice', 06000, 'Rue Paradis', 15, TRUE)
    RETURNING id
), pro1 AS (
    INSERT INTO Professionnel (raison_sociale, id_compte, est_prive)
    SELECT 'Galerie d''Art Azuréenne', id, TRUE FROM compte1_pro_cte
    RETURNING code
)
INSERT INTO Pro_prive (siren, numero_carte, code_securite, date_expiration, code_professionnel)
SELECT 111222333, 1111222233334444, 123, '2026-12-31', code FROM pro1;


-- Deuxième professionnel privé
WITH compte2_pro_cte AS (
    INSERT INTO Compte (nom, prenom, email, telephone, mot_de_passe, ville, code_postal, nom_rue, numero_rue, est_pro, complement_adresse, url_photo_profil)
    VALUES ('Dubois', 'Julien', 'julien.dubois.events@riviera-pro.com', '0492040506', '$2y$10$hjiJRJCh/Tb6ITpMBGFtCOdPJddbaIHulx2hBeQXx/vb7JT4J4S5y', 'Cannes', 06400, 'Rue d''Antibes', 30, TRUE, 'Étage 2', 'pp_compte_5')
    RETURNING id
), pro2 AS (
    INSERT INTO Professionnel (raison_sociale, id_compte, est_prive)
    SELECT 'Riviera Events & Co', id, TRUE FROM compte2_pro_cte
    RETURNING code
)
INSERT INTO Pro_prive (siren, code_professionnel)
SELECT 444555666, code FROM pro2;


-- Premier professionnel public
WITH compte3_pro_cte AS (
    INSERT INTO Compte (nom, prenom, email, telephone, mot_de_passe, ville, code_postal, nom_rue, numero_rue, est_pro)
    VALUES ('Leroy', 'Isabelle', 'isabelle.leroy@nice-tourisme.fr', '0494070809', '$2y$10$KcJJuWajcih9e/H8OpX2SeC2ZlwIU6Jv8SrLkcbeQNUKnxAZLhaAS', 'Nice', 06000, 'Quai Jean Jaurès', 2, TRUE)
    RETURNING id
), pro3 AS (
    INSERT INTO Professionnel (raison_sociale, id_compte)
    SELECT 'Office de Tourisme de Nice', id FROM compte3_pro_cte
    RETURNING code
)
INSERT INTO Pro_publique (code_professionnel)
SELECT code FROM pro3;


-- Deuxième professionnel public
WITH compte4_pro_cte AS (
    INSERT INTO Compte (nom, prenom, email, telephone, mot_de_passe, ville, code_postal, nom_rue, numero_rue, est_pro, complement_adresse, url_photo_profil)
    VALUES ('Martin', 'Pierre', 'pierre.martin@mediatheque-antibes.fr', '0493091011', '$2y$10$xRd9IovqDMvcswtTwZcDwOLb1n7g0wD2onYuBNDuXWSlhlfS6H11W', 'Antibes', 06600, 'Avenue Philippe Rochat', 10, TRUE, 'Entrée A', 'pp_compte_7')
    RETURNING id
), pro4 AS (
    INSERT INTO Professionnel (raison_sociale, id_compte)
    SELECT 'Médiathèque d''Antibes Juan-les-Pins', id FROM compte4_pro_cte
    RETURNING code
)
INSERT INTO Pro_publique (code_professionnel)
SELECT code FROM pro4;


-- Troisième professionnel public
WITH compte5_pro_cte AS (
    INSERT INTO Compte (nom, prenom, email, telephone, mot_de_passe, ville, code_postal, nom_rue, numero_rue, est_pro)
    VALUES ('Roux', 'Manon', 'manon.roux@cn-menton.org', '0492111213', '$2y$10$j3j4p2KeY/dGTNvmAbgqi.MXfZiuRF2Xz33XscQ6eARgy6Ydz7XZC', 'Menton', 06500, 'Promenade du Soleil', 120, TRUE)
    RETURNING id
), pro5 AS (
    INSERT INTO Professionnel (raison_sociale, id_compte)
    SELECT 'Club Nautique de Menton', id FROM compte5_pro_cte
    RETURNING code
)
INSERT INTO Pro_publique (association, code_professionnel)
SELECT TRUE, code FROM pro5;


-- Quatrième professionnel public
WITH compte6_pro_cte AS (
    INSERT INTO Compte (nom, prenom, email, telephone, mot_de_passe, ville, code_postal, nom_rue, numero_rue, est_pro, complement_adresse)
    VALUES ('Blanc', 'Olivier', 'olivier.blanc@nuits-azureennes.mc', '0037797131', '$2y$10$olCD8.inXpaTPnHp/d5b9OgMSYlmYGn6GngRVToSYHgMuZTTIU8J.', 'Monaco', 98000, 'Avenue des Spélugues', 5, TRUE, 'Appartement 10')
    RETURNING id
), pro6 AS (
    INSERT INTO Professionnel (raison_sociale, id_compte)
    SELECT 'Association Les Nuits Azuréennes', id FROM compte6_pro_cte
    RETURNING code
)
INSERT INTO Pro_publique (association, code_professionnel)
SELECT TRUE, code FROM pro6;


-- PEUPLEMENT DES TABLES UTILES POUR LES OFFRES --

-- Création des tags
INSERT INTO Tag (nom_tag, tag_restaurant) VALUES ('Culturel', FALSE), ('Patrimoine', FALSE), ('Histoire', FALSE), ('Urbain', FALSE), ('Nature', FALSE), ('Plein air', FALSE), ('Sport', FALSE), ('Nautique', FALSE),
('Musée', FALSE), ('Atelier', FALSE), ('Musique', FALSE), ('Famille', FALSE), ('Cinéma', FALSE), ('Cirque', FALSE), ('Son et lumière', FALSE), ('Humour', FALSE),
('Française', TRUE), ('Fruits de mer', TRUE), ('Asiatique', TRUE), ('Indienne', TRUE), ('Italienne', TRUE), ('Gastronomique', TRUE), ('Restauration rapide', TRUE), ('Crêperie', TRUE);

-- Création des jours d'ouverture
INSERT INTO Jour_ouverture (nom_jour) VALUES ('Lundi'), ('Mardi'), ('Mercredi'), ('Jeudi'), ('Vendredi'), ('Samedi'), ('Dimanche');

-- Création des options de visibilité
INSERT INTO Option_visibilite (nom_option, prix) VALUES ('En relief', 8.34), ('A la une', 16.68);

-- Création des Langues pour les visites guidées
INSERT INTO Langue_guide (nom_langue) VALUES ('Français'), ('Anglais'), ('Espagnol'), ('Allemand'), ('Italien'), ('Portugais'), ('Chinois'), ('Japonais'), ('Néerlandais');

-- Création des types de repas
INSERT INTO Type_repas (nom_type) VALUES ('Petit-déjeuner'), ('Brunch'), ('Déjeuner'), ('Dîner'), ('Boissons');

-- PEUPLEMENT DES OFFRES

DO $$
DECLARE
    -- Id des professionnels
    code_pro1 INT := (SELECT code FROM Professionnel WHERE raison_sociale = 'Galerie d''Art Azuréenne');
    code_pro2 INT := (SELECT code FROM Professionnel WHERE raison_sociale = 'Riviera Events & Co');
    code_pro3 INT := (SELECT code FROM Professionnel WHERE raison_sociale = 'Office de Tourisme de Nice');
    code_pro4 INT := (SELECT code FROM Professionnel WHERE raison_sociale = 'Médiathèque d''Antibes Juan-les-Pins');
    code_pro5 INT := (SELECT code FROM Professionnel WHERE raison_sociale = 'Club Nautique de Menton');
    code_pro6 INT := (SELECT code FROM Professionnel WHERE raison_sociale = 'Association Les Nuits Azuréennes');

    -- Id des membres
    code_membre1 INT := (SELECT code FROM Membre WHERE pseudo = 'LMorelAzur');
    code_membre2 INT := (SELECT code FROM Membre WHERE pseudo = 'CPetitRiviera');
    code_membre3 INT := (SELECT code FROM Membre WHERE pseudo = 'HGarciaMC');

    -- Id des tags
    tag_culturel INT := (SELECT id FROM Tag WHERE nom_tag = 'Culturel');
    tag_patrimoine INT := (SELECT id FROM Tag WHERE nom_tag = 'Patrimoine');
    tag_histoire INT := (SELECT id FROM Tag WHERE nom_tag = 'Histoire');
    tag_urbain INT := (SELECT id FROM Tag WHERE nom_tag = 'Urbain');
    tag_nature INT := (SELECT id FROM Tag WHERE nom_tag = 'Nature');
    tag_plein_air INT := (SELECT id FROM Tag WHERE nom_tag = 'Plein air');
    tag_sport INT := (SELECT id FROM Tag WHERE nom_tag = 'Sport');
    tag_nautique INT := (SELECT id FROM Tag WHERE nom_tag = 'Nautique');
    tag_musee INT := (SELECT id FROM Tag WHERE nom_tag = 'Musée');
    tag_atelier INT := (SELECT id FROM Tag WHERE nom_tag = 'Atelier');
    tag_musique INT := (SELECT id FROM Tag WHERE nom_tag = 'Musique');
    tag_famille INT := (SELECT id FROM Tag WHERE nom_tag = 'Famille');
    tag_son_lumiere INT := (SELECT id FROM Tag WHERE nom_tag = 'Son et lumière');
    tag_humour INT := (SELECT id FROM Tag WHERE nom_tag = 'Humour');
    tag_francaise INT := (SELECT id FROM Tag WHERE nom_tag = 'Française');
    tag_fruits_mer INT := (SELECT id FROM Tag WHERE nom_tag = 'Fruits de mer');
    tag_italienne INT := (SELECT id FROM Tag WHERE nom_tag = 'Italienne');
    tag_gastronomique INT := (SELECT id FROM Tag WHERE nom_tag = 'Gastronomique');
    tag_restauration_rapide INT := (SELECT id FROM Tag WHERE nom_tag = 'Restauration rapide');
    tag_creperie INT := (SELECT id FROM Tag WHERE nom_tag = 'Crêperie');

    -- Id des jours
    jour_lun INT := (SELECT id FROM Jour_ouverture WHERE nom_jour = 'Lundi');
    jour_mar INT := (SELECT id FROM Jour_ouverture WHERE nom_jour = 'Mardi');
    jour_mer INT := (SELECT id FROM Jour_ouverture WHERE nom_jour = 'Mercredi');
    jour_jeu INT := (SELECT id FROM Jour_ouverture WHERE nom_jour = 'Jeudi');
    jour_ven INT := (SELECT id FROM Jour_ouverture WHERE nom_jour = 'Vendredi');
    jour_sam INT := (SELECT id FROM Jour_ouverture WHERE nom_jour = 'Samedi');
    jour_dim INT := (SELECT id FROM Jour_ouverture WHERE nom_jour = 'Dimanche');

    -- Id des langues
    lang_fr INT := (SELECT id FROM Langue_guide WHERE nom_langue = 'Français');
    lang_en INT := (SELECT id FROM Langue_guide WHERE nom_langue = 'Anglais');
    lang_es INT := (SELECT id FROM Langue_guide WHERE nom_langue = 'Espagnol');
    lang_it INT := (SELECT id FROM Langue_guide WHERE nom_langue = 'Italien');
    lang_de INT := (SELECT id FROM Langue_guide WHERE nom_langue = 'Allemand');
    lang_pt INT := (SELECT id FROM Langue_guide WHERE nom_langue = 'Portugais');

    -- Id des types de repas
    repas_petitdej INT := (SELECT id FROM Type_repas WHERE nom_type = 'Petit-déjeuner');
    repas_brunch INT := (SELECT id FROM Type_repas WHERE nom_type = 'Brunch');
    repas_dej INT := (SELECT id FROM Type_repas WHERE nom_type = 'Déjeuner');
    repas_din INT := (SELECT id FROM Type_repas WHERE nom_type = 'Dîner');
    repas_boissons INT := (SELECT id FROM Type_repas WHERE nom_type = 'Boissons');

    -- Id des options de visibilité
    opt_vis_relief INT := (SELECT id FROM Option_visibilite WHERE nom_option = 'En relief');
    opt_vis_une INT := (SELECT id FROM Option_visibilite WHERE nom_option = 'A la une');

    offre_id INT;
    avis_id INT;

BEGIN

    -- CATÉGORIE: VISITE
    
    -- Offre 1: Visite
    INSERT INTO Offre (titre, resume, ville, code_postal, categorie, conditions_accessibilite, telephone, description_detaillee, nom_rue, numero_rue, complement_adresse, site_web, code_professionnel, note_moyenne, nombre_avis)
    VALUES ('Nice Historique & Saleya', 'Charme du Vieux-Nice et couleurs du Cours Saleya', 'Nice', 06000, 'Visite', 'Majoritairement plat, quelques pavés', '04 92 04 05 06', 
    'Explorez les ruelles baroques du Vieux-Nice, ses places animées, et terminez par le célèbre marché aux fleurs du Cours Saleya. Une balade de 2h avec un guide local pour saisir l''âme niçoise.',
    'Place Masséna', 1, 'bis', 'https://riviera-events.com/nice-tour', code_pro2, 4.5, 2)
    RETURNING id INTO offre_id;
    
    INSERT INTO Visite (prix_minimal, duree, guidee, id_offre) VALUES (20.00, '02h00', TRUE, offre_id);
    
    INSERT INTO Image (url_img, principale, id_offre) VALUES ('ambiance-salyeya_1.jpg', TRUE, 1), ('sc_nice-cours-saleya_1.jpg', FALSE, 1);
    
    INSERT INTO Tag_offre (id_offre, id_tag) VALUES (offre_id, tag_culturel), (offre_id, tag_patrimoine), (offre_id, tag_urbain), (offre_id, tag_histoire);
    
    INSERT INTO Jour_ouverture_offre (id_offre, id_jour, horaire_debut, horaire_fin) VALUES (offre_id, jour_mar, '10:00:00', '12:00:00'), (offre_id, jour_mar, '15:00:00', '17:00:00'), (offre_id, jour_mer, '10:00:00', '12:00:00'),
    (offre_id, jour_mer, '15:00:00', '17:00:00'), (offre_id, jour_jeu, '10:00:00', '12:00:00'), (offre_id, jour_ven, '10:00:00', '12:00:00'), (offre_id, jour_ven, '15:00:00', '17:00:00'), 
    (offre_id, jour_sam, '10:00:00', '12:00:00');
    
    INSERT INTO Langue_guide_visite (id_offre, id_langue) VALUES (offre_id, lang_fr), (offre_id, lang_en), (offre_id, lang_it);
    
    INSERT INTO Option_souscrite (id_offre, id_option, nombre_jour, date_debut, date_fin) VALUES (offre_id, opt_vis_relief, 14, CURRENT_DATE - INTERVAL '7 days', CURRENT_DATE + INTERVAL '7 days');
    
    INSERT INTO En_ligne (mise_en_ligne, id_offre) VALUES (CURRENT_DATE - INTERVAL '7 days', offre_id);
    
    INSERT INTO Avis (titre, note, commentaire, date_visite, contexte_visite, id_offre, code_membre)
    VALUES ('Magnifique Nice !', 5.0, 'Guide passionnant, le Cours Saleya est un enchantement.', CURRENT_DATE - INTERVAL '5 days', 'En couple', offre_id, code_membre1)
    RETURNING id INTO avis_id;
    
    INSERT INTO Reponse_pro (reponse, id_avis) VALUES ('Merci ! Ravie que Nice vous ait plu.', avis_id);
    
    INSERT INTO Avis (titre, note, commentaire, date_visite, contexte_visite, nb_like, nb_dislike, id_offre, code_membre)
    VALUES ('Très sympa', 4.0, 'Belle balade, un peu rapide sur la fin.', CURRENT_DATE - INTERVAL '4 days', 'Amis', 12, 5, offre_id, code_membre2);


    -- Offre 2: Visite
    INSERT INTO Offre (titre, resume, ville, code_postal, categorie, conditions_accessibilite, telephone, en_ligne, description_detaillee, nom_rue, numero_rue, code_professionnel, note_moyenne, nombre_avis)
    VALUES ('Expo Picasso et la Joie de Vivre', 'Rétrospective des œuvres de Picasso créées à Antibes', 'Antibes', 06600, 'Visite', 'Accessible PMR. Prêt de fauteuils', '04 93 09 10 11', FALSE,
    'Découvrez la période lumineuse de Picasso à Antibes au Château Grimaldi. Peintures, dessins, céramiques... une collection exceptionnelle qui respire la Méditerranée. Idéal pour les amateurs d''art moderne.', 
    'Place Mariejol', 1, code_pro1, 4.8, 1)
    RETURNING id INTO offre_id;
    
    INSERT INTO Visite (prix_minimal, duree, id_offre) VALUES (0.00, '04h00', offre_id);
    
    INSERT INTO Image (url_img, principale, id_offre) VALUES ('picasso_2.webp', TRUE, 2), ('picasso_joiedevivre_2.jpg', FALSE, 2);
    
    INSERT INTO Tag_offre (id_offre, id_tag) VALUES (offre_id, tag_culturel), (offre_id, tag_musee), (offre_id, tag_histoire);
    
    INSERT INTO Jour_ouverture_offre (id_offre, id_jour, horaire_debut, horaire_fin) VALUES (offre_id, jour_mar, '10:00:00', '18:00:00'), (offre_id, jour_mer, '10:00:00', '18:00:00'), (offre_id, jour_jeu, '10:00:00', '18:00:00'),
    (offre_id, jour_ven, '10:00:00', '20:00:00'), (offre_id, jour_sam, '10:00:00', '18:00:00'), (offre_id, jour_dim, '10:00:00', '18:00:00');
    
    INSERT INTO Langue_guide_visite (id_offre, id_langue) VALUES (offre_id, lang_fr), (offre_id, lang_en), (offre_id, lang_es), (offre_id, lang_de);
    
    INSERT INTO Avis (titre, note, commentaire, date_visite, contexte_visite, nb_like, nb_dislike, id_offre, code_membre)
    VALUES ('Picasso lumineux', 4.8, 'Une collection magnifique dans un cadre superbe.', CURRENT_DATE - INTERVAL '20 days', 'Solo', 45, 6, offre_id, code_membre3);

    
    -- CATÉGORIE: SPECTACLE (2 offres)
    

    -- Offre 3: spectacle
    INSERT INTO Offre (titre, resume, ville, code_postal, categorie, conditions_accessibilite, telephone, description_detaillee, site_web, code_professionnel)
    VALUES ('Nice Jazz Festival Soirée Prestige', 'Scène Masséna en effervescence avec des légendes du Jazz', 'Nice', 06000, 'Spectacle', 'Accès PMR zones dédiées', '04 93 05 40 11',
    'Vibrez au son des plus grandes légendes du jazz et des talents émergents sur la mythique Place Masséna, transformée pour l''occasion en un écrin musical à ciel ouvert. Le Nice Jazz Festival vous convie à une soirée prestige, 
    promesse d''une ambiance électrique et de performances inoubliables, fusionnant traditions et explorations sonores contemporaines. Profitez d''une acoustique soignée et d''installations de qualité pour une immersion totale.',
    'https://www.nicejazzfest.fr', code_pro6)
    RETURNING id INTO offre_id;
    
    INSERT INTO Spectacle (prix_minimal, duree, capacite, id_offre) VALUES (45.00, '03h00', 5000, offre_id);
    
    INSERT INTO Image (url_img, principale, id_offre) VALUES ('Nice-Jazz-Festival_3.png', TRUE, 3);
    
    INSERT INTO Tag_offre (id_offre, id_tag) VALUES (offre_id, tag_musique), (offre_id, tag_culturel), (offre_id, tag_urbain), (offre_id, tag_plein_air);
    
    INSERT INTO En_ligne (mise_en_ligne, id_offre) VALUES (CURRENT_DATE - INTERVAL '90 days', offre_id);
    
    INSERT INTO Jour_ouverture_offre (id_offre, id_jour, horaire_debut, horaire_fin) VALUES (offre_id, jour_ven, '21:00:00', '23:00:00'), (offre_id, jour_sam, '19:00:00', '21:00:00'), (offre_id, jour_sam, '21:30:00', '23:00:00');


    -- Offre 4: spectacle
    INSERT INTO Offre (titre, resume, ville, code_postal, categorie, conditions_accessibilite, telephone, description_detaillee, code_professionnel)
    VALUES ('Soirée Humour sous les Étoiles', 'Les meilleurs humoristes de la Riviera à Cannes', 'Cannes', 06400, 'Spectacle', 'Accès difficile pour PMR (nombreux escaliers)', '0493091045',
    '''Soirée Humour sous les Étoiles'' vous accueille au cadre enchanteur du Théâtre de Verdure pour des moments de pur rire et de détente. Découvrez une sélection d''artistes talentueux, des têtes d''affiche de l''humour 
    francophone aux révélations les plus prometteuses de la scène comique actuelle. Consultez la programmation pour ne pas manquer vos humoristes favoris et vivre une soirée unique !',
    code_pro2)
    RETURNING id INTO offre_id;
    
    INSERT INTO Spectacle (prix_minimal, duree, capacite, id_offre) VALUES (25.00, '02h00', 800, offre_id);
    
    INSERT INTO Image (url_img, principale, id_offre) VALUES ('publicrire_4.jpg', TRUE, 4), ('sous-les-etoiles_4.jpg', FALSE, 4);
    
    INSERT INTO Tag_offre (id_offre, id_tag) VALUES (offre_id, tag_humour), (offre_id, tag_famille);
    
    INSERT INTO Jour_ouverture_offre (id_offre, id_jour, horaire_debut, horaire_fin) VALUES (offre_id, jour_ven, '21:00:00', '23:00:00');
    
    INSERT INTO En_ligne (mise_en_ligne, id_offre) VALUES (CURRENT_DATE - INTERVAL '17 days', offre_id);
    

    -- CATÉGORIE: RESTAURANT (2 offres)
    
    -- Offre 5: Restaurant
    INSERT INTO Offre (titre, resume, ville, code_postal, categorie, conditions_accessibilite, telephone, description_detaillee, nom_rue, numero_rue, site_web, code_professionnel, note_moyenne, nombre_avis)
    VALUES ('Restaurant La Palme d''Or', 'Haute gastronomie et vue mer sur la Croisette', 'Cannes', 06400, 'Restaurant', 'Accès PMR', '04 97 84 50 11', 'Vivez une expérience culinaire d''exception au restaurant ''La Palme d''Or'', 
    véritable institution gastronomique sur la Croisette à Cannes. Notre Chef vous propose une carte inventive où les saveurs de la Méditerranée sont sublimées avec créativité et respect des produits nobles. 
    Dégustez des mets raffinés, des fruits de mer d''une fraîcheur incomparable et des desserts artistiques, dans un décor élégant offrant une vue imprenable sur la mer.', 
   'Boulevard de la Croisette', 73, 'https://www.lapalmedor-restaurant.fr/', code_pro2, 5, 1)
    RETURNING id INTO offre_id;
    
    INSERT INTO Restaurant (gamme_de_prix, url_carte_restaurant, id_offre) VALUES (3, 'carte_resto_1.png', offre_id);
    
    INSERT INTO Image (url_img, principale, id_offre) VALUES ('la-palme-restaurant_5.jpg', TRUE, 5), ('la-palme-terasse_5.jpg', FALSE, 5);
    
    INSERT INTO Tag_offre (id_offre, id_tag) VALUES (offre_id, tag_gastronomique), (offre_id, tag_fruits_mer);
    
    INSERT INTO Type_repas_restaurant (id_offre, id_type) VALUES (offre_id, repas_din), (offre_id, repas_dej);
    
    INSERT INTO Jour_ouverture_offre (id_offre, id_jour, horaire_debut, horaire_fin) VALUES (offre_id, jour_mar, '19:30:00', '22:30:00'), (offre_id, jour_mer, '19:30:00', '22:30:00'), (offre_id, jour_jeu, '12:00:00', '14:00:00'),
    (offre_id, jour_jeu, '19:30:00', '22:30:00'), (offre_id, jour_ven, '12:00:00', '14:00:00'),(offre_id, jour_ven, '19:30:00', '22:30:00'), (offre_id, jour_sam, '12:00:00', '14:00:00'),
    (offre_id, jour_sam, '19:30:00', '23:00:00');
    
    INSERT INTO Option_souscrite (id_offre, id_option, nombre_jour, date_debut, date_fin) VALUES (offre_id, opt_vis_une, 30, CURRENT_DATE - INTERVAL '10 days', CURRENT_DATE - INTERVAL '20 days');
    
    INSERT INTO Avis (titre, note, commentaire, date_visite, contexte_visite, id_offre, nb_like, code_membre)
    VALUES ('Divin !', 5.0, 'Une expérience culinaire inoubliable. Le cadre est somptueux.', CURRENT_DATE - INTERVAL '12 days', 'Affaires', offre_id, 30, code_membre3)
    RETURNING id INTO avis_id;
    
    INSERT INTO Reponse_pro (reponse, id_avis) VALUES ('Merci infiniment pour ces mots. Ce fut un plaisir de vous accueillir.', avis_id);
    
    INSERT INTO En_ligne (mise_en_ligne, id_offre) VALUES (CURRENT_DATE - INTERVAL '100 days', offre_id);


    -- Offre 6: restaurant
    INSERT INTO Offre (titre, resume, ville, code_postal, categorie, conditions_accessibilite, telephone, description_detaillee, nom_rue, numero_rue, code_professionnel)
    VALUES ('Chez Pipo - Socca Niçoise', 'L''authentique socca cuite au four à bois', 'Nice', 06300, 'Restaurant', 'Accès PMR', '0493558882', 'Vivez une expérience niçoise authentique chez ''Chez Pipo'', 
    l''adresse emblématique pour savourer la vraie socca depuis 1923, au cœur du Vieux-Nice. Notre spécialité, préparée selon une recette traditionnelle et cuite à la perfection dans un grand four à bois, 
    offre une texture unique : croustillante à l''extérieur, fondante à l''intérieur.', 'Rue Bavastro', 13, code_pro3)
    RETURNING id INTO offre_id;
    
    INSERT INTO Restaurant (gamme_de_prix, id_offre) VALUES (1, offre_id);
    
    INSERT INTO Image (url_img, principale, id_offre) VALUES ('gallery-11_6.webp', TRUE, 6), ('gallery-21_6.webp', FALSE, 6);
    
    INSERT INTO Tag_offre (id_offre, id_tag) VALUES (offre_id, tag_restauration_rapide), (offre_id, tag_urbain);
    
    INSERT INTO Type_repas_restaurant (id_offre, id_type) VALUES (offre_id, repas_dej), (offre_id, repas_din), (offre_id, repas_boissons);
    
    INSERT INTO Jour_ouverture_offre (id_offre, id_jour, horaire_debut, horaire_fin) VALUES (offre_id, jour_mar, '11:30:00', '14:00:00'),(offre_id, jour_mar, '17:30:00', '22:00:00'), (offre_id, jour_mer, '11:30:00', '14:00:00'),
    (offre_id, jour_mer, '17:30:00', '22:00:00'), (offre_id, jour_jeu, '11:30:00', '14:00:00'),(offre_id, jour_jeu, '17:30:00', '22:00:00'), (offre_id, jour_ven, '11:30:00', '14:00:00'),(offre_id, jour_ven, '17:30:00', '22:00:00'),
    (offre_id, jour_sam, '11:30:00', '22:00:00'), (offre_id, jour_dim, '11:30:00', '22:00:00');
        
    INSERT INTO En_ligne (mise_en_ligne, id_offre) VALUES (CURRENT_DATE - INTERVAL '54 days', offre_id);

    -- CATÉGORIE: ACTIVITE (2 offres)
    

    -- Offre 7: Activite
    INSERT INTO Offre (titre, resume, ville, code_postal, categorie, conditions_accessibilite, telephone, description_detaillee, code_professionnel)
    VALUES ('Créez Votre Parfum à Grasse', 'Atelier de création de parfum personnalisé', 'Grasse', 06130, 'Activite', 'Accès PMR', '04 93 58 78 82', 'Initiez-vous à l''art envoûtant de la parfumerie à Grasse, capitale mondiale du parfum, 
    lors d''un atelier de création exclusif. Pendant deux heures, un parfumeur ''nez'' expérimenté vous guidera à travers les mystérieuses familles olfactives et vous enseignera les secrets d''assemblage des essences les plus fines. 
    Vous aurez le privilège de manipuler une sélection de matières premières nobles pour composer pas à pas votre propre fragrance unique, véritable reflet de votre personnalité.', code_pro4)
    RETURNING id INTO offre_id;
    
    INSERT INTO Activite (prix_minimal, duree, age_requis, prestations_incluses, prestations_non_incluses, id_offre) VALUES (45.00, '02h00', 12, 'Essences, flacon, formateur', 'Transport', offre_id);
    
    INSERT INTO Image (url_img, principale, id_offre) VALUES ('creez-votre-fragrance_7.jpg', TRUE, 7), ('creation-de-parfum_7.jpg', FALSE, 7);
    
    INSERT INTO En_ligne (mise_en_ligne, id_offre) VALUES (CURRENT_DATE - INTERVAL '70 day', offre_id);
    
    INSERT INTO Tag_offre (id_offre, id_tag) VALUES (offre_id, tag_atelier), (offre_id, tag_culturel), (offre_id, tag_famille);
    
    INSERT INTO Jour_ouverture_offre (id_offre, id_jour, horaire_debut, horaire_fin) VALUES (offre_id, jour_mar, '11:30:00', '14:00:00'), (offre_id, jour_jeu, '17:30:00', '20:00:00'), (offre_id, jour_ven, '11:30:00', '14:00:00');
    


    -- Offre 8: activité
    INSERT INTO Offre (titre, resume, ville, code_postal, categorie, conditions_accessibilite,  telephone, description_detaillee, code_professionnel, note_moyenne, nombre_avis)
    VALUES ('Plongée Îles de Lérins', 'Explorez les fonds marins préservés de la baie de Cannes', 'Cannes', 06400, 'Activite', 'Non accessible PMR', '04 78 58 78 82', 'Explorez la splendeur des fonds sous-marins préservés des Îles de Lérins 
    lors d''une sortie plongée inoubliable au départ de Cannes. Que vous soyez un plongeur certifié ou que vous souhaitiez réaliser un baptême en toute sérénité, nos moniteurs diplômés d''État vous accompagneront en toute 
    sécurité à la découverte de sites exceptionnels : tombants rocheux richement colorés, herbiers de posidonie foisonnants, et une faune méditerranéenne variée (mérous, sars, dorades...).', code_pro5, 3.8, 1)
    RETURNING id INTO offre_id;
    
    INSERT INTO Activite (prix_minimal, duree, age_requis, prestations_incluses, prestations_non_incluses, id_offre) VALUES (55.00, '03h00', 16, 'Bouteille, plombs, guide de palanquée', 'Location combinaisons', offre_id);
    
    INSERT INTO Image (url_img, principale, id_offre) VALUES ('plonge_8.jpg', TRUE, 8), ('nage_8.jpg', FALSE, 8);
    
    INSERT INTO Tag_offre (id_offre, id_tag) VALUES (offre_id, tag_nautique), (offre_id, tag_sport), (offre_id, tag_plein_air), (offre_id, tag_nature);
    
    INSERT INTO Jour_ouverture_offre (id_offre, id_jour, horaire_debut, horaire_fin) VALUES (offre_id, jour_sam, '09:00:00', '12:00:00'), (offre_id, jour_sam, '14:00:00', '17:00:00'), 
    (offre_id, jour_dim, '09:00:00', '12:00:00');
    
    INSERT INTO Avis (titre, note, commentaire, date_visite, contexte_visite, nb_dislike, id_offre, code_membre)
    VALUES ('Super spot, mais visi moyenne ce jour-là', 3.8, 'Les moniteurs sont top, mais la mer était un peu agitée.', CURRENT_DATE - INTERVAL '6 days', 'famille', 1, offre_id, code_membre1)
    RETURNING id INTO avis_id;
    
    INSERT INTO En_ligne (mise_en_ligne, id_offre) VALUES (CURRENT_DATE - INTERVAL '16 day', offre_id);
    

    -- CATÉGORIE: PARC D'ATTRACTION (2 offres)
    

    -- Offre 9: parc d'attraction
    INSERT INTO Offre (titre, resume, ville, code_postal, categorie, conditions_accessibilite, telephone, description_detaillee, code_professionnel)
    VALUES ('Marineland Antibes', 'Parc marin avec orques, dauphins et otaries', 'Antibes', 06600, 'Parc d''attraction', 'Accessible à tous', '04 93 65 32 82', 'Surplombant la Principauté, le Jardin Exotique de Monaco offre un panorama 
    époustouflant sur la Méditerranée. Ce lieu unique, aménagé à flanc de falaise, abrite des milliers de plantes succulentes et cactées aux formes étonnantes, venues des régions arides du globe. La visite inclut l''accès à 
    la Grotte de l''Observatoire, une cavité naturelle ornée de stalactites et stalagmites, où la température reste constante.', code_pro3)
    RETURNING id INTO offre_id;
    
    INSERT INTO Parc_attraction (url_plan, nombre_attraction, prix_minimal, age_requis, id_offre) VALUES ('plan_carte.png', 30, 39.90, 5, offre_id);
    
    INSERT INTO Image (url_img, principale, id_offre) VALUES ('marineland_9.jpg', TRUE, 9), ('orcas_9.jpg', FALSE, 9);
    
    INSERT INTO Tag_offre (id_offre, id_tag) VALUES (offre_id, tag_famille), (offre_id, tag_nature), (offre_id, tag_musee), (offre_id, tag_plein_air);
    
    INSERT INTO Jour_ouverture_offre (id_offre, id_jour, horaire_debut, horaire_fin) VALUES (offre_id, jour_lun, '10:00:00', '18:00:00'), (offre_id, jour_mar, '10:00:00', '18:00:00'), (offre_id, jour_mer, '10:00:00', '18:00:00'), 
    (offre_id, jour_jeu, '10:00:00', '18:00:00'), (offre_id, jour_ven, '10:00:00', '19:00:00'), (offre_id, jour_sam, '10:00:00', '19:00:00'), (offre_id, jour_dim, '10:00:00', '19:00:00');
    
    INSERT INTO En_ligne (mise_en_ligne, id_offre) VALUES (CURRENT_DATE - INTERVAL '148 day', offre_id);
    

    -- Offre 10: parc d'attraction
    INSERT INTO Offre (titre, resume, ville, code_postal, categorie, conditions_accessibilite, telephone, description_detaillee, code_professionnel)
    VALUES ('Jardin Exotique & Grotte de l''Observatoire', 'Vue panoramique et collection unique de succulentes', 'Monaco', 98000, 'Parc d''attraction', 'Accès difficile pour PMR (nombreux escaliers)', '07 93 15 29 80', 'Vivez une journée 
    d''émerveillement à Marineland d''Antibes, l''un des plus grands parcs marins d''Europe ! Approchez les créatures fascinantes des océans : assistez aux spectacles grandioses des orques et dauphins, laissez-vous charmer par 
    les otaries et découvrez les mystères du monde polaire avec manchots et ours polaires. Le parc offre aussi un tunnel aux requins, des aquariums tropicaux et des aires de jeux.', code_pro6)
    RETURNING id INTO offre_id;
    
    INSERT INTO Parc_attraction (url_plan, nombre_attraction, prix_minimal, age_requis, id_offre) VALUES ('plan_carte_2.jpg', 1, 7.20, 3, offre_id);
    
    INSERT INTO Image (url_img, principale, id_offre) VALUES ('jardin-exotique_10.jpg', TRUE, 10), ('grotte-observatoire-monaco_10.jpg', FALSE, 10), ('grotte-observatoire-monaco_seconde_10.jpg', FALSE, 10);
    
    INSERT INTO Tag_offre (id_offre, id_tag) VALUES (offre_id, tag_famille), (offre_id, tag_nature), (offre_id, tag_patrimoine), (offre_id, tag_urbain);
    
    INSERT INTO Jour_ouverture_offre (id_offre, id_jour, horaire_debut, horaire_fin) VALUES (offre_id, jour_lun, '09:00:00', '18:00:00'),(offre_id, jour_mar, '09:00:00', '18:00:00'), (offre_id, jour_mer, '09:00:00', '18:00:00'),
    (offre_id, jour_jeu, '09:00:00', '18:00:00'), (offre_id, jour_ven, '09:00:00', '18:00:00'),(offre_id, jour_sam, '09:00:00', '18:00:00'), (offre_id, jour_dim, '09:00:00', '18:00:00');
    
    INSERT INTO En_ligne (mise_en_ligne, id_offre) VALUES (CURRENT_DATE - INTERVAL '60 days', offre_id);

END $$;

SELECT 'Peuplement terminé' AS statut;
