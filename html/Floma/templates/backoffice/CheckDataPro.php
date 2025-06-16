<?php
  $head_title = "Consultation informations";
  $compte = $data['infosPro'][0]['compteData'][0];
  $head_subtitle = $compte['prenom']." ". $compte['nom'];
  $head_svg = "/assets/icons/account_white.svg";
  include 'head_title.php';
?>
<div id="main-check">
  <section class="check-section">
    <h3>Photo de profil</h3>
    <?php
      if(isset($compte['url_photo_profil'])){
        ?>
          <img src="/uploads/profilePicture/<?= $compte['url_photo_profil'] ?>.jpg" alt="Photo de profil" title="Photo de profil">
        <?php
      }else{
        ?>
          <img src="/uploads/profilePicture/pp_compte_defaut.jpg" alt="Photo de profil" title="Photo de profil">
        <?php
      }

    ?>
  </section>
  
  <section class="check-section">
    <h3>Informations générales</h3>
    <div class="check-div">
      <article>
        <label for="prenom">Prénom </label>
        <input type="text" id="prenom" name="prenom" placeholder="<?= $compte['prenom'] ?>" disabled/>
      </article>
      
      <article>
        <label for="nom">Nom </label>
        <input type="text" id="nom" name="nom" placeholder="<?= $compte['nom'] ?>" disabled/>
      </article>
    </div>

    <div class="check-div">
      <article>
        <label for="telephone">Numéro de téléphone</label>
        <?php 
          $numSansEspace = $compte['telephone'];
          $numExplode = str_split($numSansEspace, 2);
          $numAvecEspaces = implode(' ', $numExplode);
        ?>
        <input type="tel" id="telephone" name="telephone" placeholder="<?= $numAvecEspaces ?>" disabled/>
      </article>

      <article>
        <label for="email">Adresse e-mail</label>
        <input type="email" id="email" name="email" placeholder="<?= $compte['email'] ?>" disabled/>
      </article>
    </div>

    <div class="check-div">
      <article>
        <label for="denomination">Dénomination sociale</label>
        <input type="text" id="denomination" name="denomination" placeholder="<?= $data['infosPro'][0]['raison_sociale'] ?>" disabled/>
      </article>

      <?php
        if(isset($compte['url_photo_profil'])){
          $numSirenSansEspace = $data['infosPro'][0]['proPriveData'][0]['siren'];
          $numSirenExplode = str_split($numSirenSansEspace, 3);
          $numSirenAvecEspaces = implode(' ', $numSirenExplode);
          ?>
            <article>
              <label for="siren">Numéro SIREN</label>
              <input type="text" id="siren" name="siren" placeholder="<?= $numSirenAvecEspaces ?>" disabled/>
            </article>
          <?php
        }
      ?>
    </div>

      <!-- Ajouter la pp ? MDP inutile pour cette partie mais utilse pour modif<article>
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" disabled/>
      </article>

      <article>
        <label for="confirmPassword">Confirmation du mot de passe</label>
        <input type="password" id="confirmPassword" name="confirmPassword" disabled/>
      </article>-->
  </section>

  <section class="check-section">
    <h3>Adresse</h3>
    <div class="check-div">
      <article>
        <label for="rue">Rue</label>
        <input type="text" id="rue" name="rue" placeholder="<?= $compte['nom_rue'] ?>" disabled/>
      </article>

      <article>
        <label for="numero">Numéro</label>
        <input type="text" id="numero" name="numero" placeholder="<?= $compte['numero_rue'] ?>" disabled/>
      </article>
    </div>

    <div class="check-div">
      <?php
        if(isset($compte['complement_adresse'])){
          ?>
            <article>
              <label for="complement">Complément d'adresse</label>
              <input type="text" id="complement" name="complement" placeholder="<?= $compte['complement_adresse'] ?>" disabled/>
            </article>
          <?php
        }
      ?>

      <article>
        <label for="ville">Ville</label>
        <input type="text" id="ville" name="ville" placeholder="<?= $compte['ville'] ?>" disabled/>
      </article>
    <?php 
      if(isset($compte['complement_adresse'])){
        ?>
          </div>
        <?php
      }
    ?>
      <article>
        <label for="codePostal">Code postal</label>
        <input type="text" id="codePostal" name="codePostal" placeholder="<?= $compte['code_postal'] ?>" disabled/>
      </article>
    <?php 
      if(!isset($compte['complement_adresse'])){
        ?>
          </div>
        <?php
      }
    ?>
  </section>

  <?php
    if(isset($data['infosPro'][0]['proPriveData'][0]['numero_carte'])){
      $numCarte = $data['infosPro'][0]['proPriveData'][0]['numero_carte'];
      $numCarteDebut = substr($numCarte, 0, 4);
      $numCarteFin = substr($numCarte, 12, 15);
      $numCarteCache = $numCarteDebut." **** **** ".$numCarteFin;

      $dateExpiration = $data['infosPro'][0]['proPriveData'][0]['date_expiration'];
      $dateExplode = explode('-', $dateExpiration);
      $dateExpirationFr = $dateExplode[1].'/'.$dateExplode[0];
      ?>
        <section class="check-section">
        <h3>Carte bancaire</h3>
          <article id="check-card">
            <p id="check-num-card"><?= $numCarteCache ?></p>
            <p>Expire fin : <?= $dateExpirationFr ?></p>
            <p><?= $compte['nom']." ". $compte['prenom'] ?></p>
          </article>
        </section>
      <?php
      }
    ?>
</div>