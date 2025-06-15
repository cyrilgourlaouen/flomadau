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
    <img src="/uploads/profilePicture/<?= $compte['url_photo_profil'] ?>.jpg" alt="Photo de profil" title="Photo de profil">
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
        <input type="tel" id="telephone" name="telephone" placeholder="<?= $compte['telephone'] ?>" disabled/>
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

      <article>
        <label for="siren">Numéro SIREN</label>
        <input type="text" id="siren" name="siren" placeholder="<?= $data['infosPro'][0]['proPriveData'][0]['siren'] ?>" disabled/>
      </article>
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
      <article>
        <label for="complement">Complément d'adresse</label>
        <input type="text" id="complement" name="complement" placeholder="<?= $compte['complement_adresse'] ?>" disabled/>
      </article>

      <article>
        <label for="ville">Ville</label>
        <input type="text" id="ville" name="ville" placeholder="<?= $compte['ville'] ?>" disabled/>
      </article>
    </div>

      <article>
        <label for="codePostal">Code postal</label>
        <input type="text" id="codePostal" name="codePostal" placeholder="<?= $compte['code_postal'] ?>" disabled/>
      </article>
  </section>
</div>