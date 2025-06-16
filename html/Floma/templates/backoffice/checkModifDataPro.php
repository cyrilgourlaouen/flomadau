<?php
  $head_title = "Consultation informations";
  $compte = $data['infosPro'][0]['compteData'][0];
  $head_subtitle = $compte['prenom']." ". $compte['nom'];
  $head_svg = "/assets/icons/account_white.svg";
  include 'head_title.php';
?>
<div id="main-check">
  <form action="?path=/pro/update/account" method="POST" enctype="multipart/form-data" id="form-pro">
    <section class="check-section">
      <h3>Photo de profil</h3>
      <article id="check-pp">
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
      </article>
      <button class="cache">Supprimer</button>
      <article id="new-pp">
        <label for="photo">Nouvelle photo de profil :</label>
        <input type="file" id="photo" name="photo" accept="image/png, image/jpeg image/webp" size="2097152"></input>
      </article>
    </section>
  
    <section class="check-section">
      <h3>Informations générales</h3>
      <div class="check-div">
        <article>
          <label for="prenom">Prénom </label>
          <input type="text" id="prenom" name="prenom" value="<?= $compte['prenom'] ?>" disabled class="not-active"/>
        </article>
        
        <article>
          <label for="nom">Nom </label>
          <input type="text" id="nom" name="nom" value="<?= $compte['nom'] ?>" disabled class="not-active"/>
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
          <input type="tel" id="telephone" name="telephone" value="<?= $numAvecEspaces ?>" disabled class="not-active"/>
        </article>

        <article>
          <label for="email">Adresse e-mail</label>
          <input type="email" id="email" name="email" value="<?= $compte['email'] ?>" disabled class="not-active"/>
        </article>
      </div>

      <div class="check-div">
        <article>
          <label for="denomination">Dénomination sociale</label>
          <input type="text" id="denomination" name="denomination" value="<?= $data['infosPro'][0]['raison_sociale'] ?>" disabled class="not-active"/>
        </article>

        <?php
          if(isset($data['infosPro'][0]['proPriveData'][0]['siren'])){
            $numSirenSansEspace = $data['infosPro'][0]['proPriveData'][0]['siren'];
            $numSirenExplode = str_split($numSirenSansEspace, 3);
            $numSirenAvecEspaces = implode(' ', $numSirenExplode);
            ?>
              <article>
                <label for="siren">Numéro SIREN</label>
                <input type="text" id="siren" name="siren" value="<?= $numSirenAvecEspaces ?>" disabled class="not-active"/>
              </article>
            <?php
          }
        ?>
      </div>
    </section>

    <section class="check-section">
      <h3>Adresse</h3>
      <div class="check-div">
        <article>
          <label for="rue">Rue</label>
          <input type="text" id="rue" name="rue" value="<?= $compte['nom_rue'] ?>" disabled class="not-active"/>
        </article>

        <article>
          <label for="numero">Numéro</label>
          <input type="text" id="numero" name="numero" value="<?= $compte['numero_rue'] ?>" disabled class="not-active"/>
        </article>
      </div>

      <div class="check-div">
        <?php
          if(isset($compte['complement_adresse'])){
            ?>
              <article>
                <label for="complement">Complément d'adresse</label>
                <input type="text" id="complement" name="complement" value="<?= $compte['complement_adresse'] ?>" disabled class="not-active"/>
              </article>
            <?php
          }
        ?>

        <article>
          <label for="ville">Ville</label>
          <input type="text" id="ville" name="ville" value="<?= $compte['ville'] ?>" disabled class="not-active"/>
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
          <input type="text" id="codePostal" name="codePostal" value="<?= $compte['code_postal'] ?>" disabled class="not-active"/>
        </article>
      <?php 
        if(!isset($compte['complement_adresse'])){
          ?>
            </div>
          <?php
        }
      ?>
    </section>

    <section class="check-section cache">
      <h3>Mot de passe</h3>
      <article>
        <label for="old-password">Ancien mot de passe</label>
        <input type="password" id="old-password" name="old-password"/>
      </article>

      <article>
        <label for="new-password">Nouveau mot de passe</label>
        <input type="password" id="new-password" name="new-password" disabled/>
      </article>

      <article>
        <label for="confirm-password">Confirmation du mot de passe</label>
        <input type="password" id="confirm-password" name="confirm-password" disabled/>
      </article>
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
            <button class="cache">Supprimer</button>
            <article id="new-credit-card">
              <label for="card-number">Numéro de carte</label>
              <input type="text" id="card-number" name="card-number"></input>

              <label for="expiration-date">Date expiration</label>
              <input type="date" id="expiration-date" name="expiration-date"></input>

              <label for="CVV">Cryptogramme</label>
              <input type="text" id="CVV" name="CVV"></input>
            </article>
          </section>
        <?php
      }else{
        ?>
          <section class="check-section cache">
            <h3>Carte bancaire</h3>
            <article>
              <label for="card-number">Numéro de carte</label>
              <input type="text" id="card-number" name="card-number"></input>

              <label for="expiration-date">Date expiration</label>
              <input type="date" id="expiration-date" name="expiration-date"></input>

              <label for="CVV">Cryptogramme</label>
              <input type="text" id="CVV" name="CVV"></input>
            </article>
          </section>
        <?php
      }
    ?>

    <button type="button" id="btn-modifier">Modifier</button>
    <button type="submit" id="btn-enregistrer" class="cache">Enregistrer les modifications</button>
    <button type="button" id="btn-annuler" class="cache">Annuler</button>

  </form>
</div>
<script src="./js/checkModifPro.js"></script>