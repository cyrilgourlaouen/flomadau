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
      <button class="hidden btn-modif-pro" id="btn-delete-pp" type="button">Supprimer</button>
      <article id="new-pp" class="hidden-pp">
        <label for="photo">Nouvelle photo de profil :</label>
        <input type="file" id="photo" name="photo" accept="image/png, image/jpeg, image/webp" size="2097152"></input>
      </article>
      <button class="hidden-pp btn-modif-pro" id="btn-cancel-pp" type="button">Annuler</button>
    </section>
  
    <section class="check-section">
      <h3>Informations générales</h3>
      <div class="check-div">
        <article>
          <label for="prenom">Prénom </label>
          <input type="text" id="prenom" name="prenom" value="<?= $compte['prenom'] ?>" disabled class="not-active"/>
          <span id="erreur-prenom" class="erreur"></span>
        </article>
        
        <article>
          <label for="nom">Nom </label>
          <input type="text" id="nom" name="nom" value="<?= $compte['nom'] ?>" disabled class="not-active"/>
          <span id="erreur-nom" class="erreur"></span>
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
          <span id="erreur-telephone" class="erreur"></span>
        </article>

        <article>
          <label for="email">Adresse e-mail</label>
          <input type="email" id="email" name="email" value="<?= $compte['email'] ?>" disabled class="not-active"/>
          <span id="erreur-email" class="erreur"></span>
        </article>
      </div>

      <div class="check-div">
        <article>
          <label for="denomination">Dénomination sociale</label>
          <input type="text" id="denomination" name="denomination" value="<?= $data['infosPro'][0]['raison_sociale'] ?>" disabled class="not-active"/>
          <span id="erreur-denomination" class="erreur"></span>
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
                <span id="erreur-siren" class="erreur"></span>
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
          <span id="erreur-rue" class="erreur"></span>
        </article>

        <article>
          <label for="numero">Numéro</label>
          <input type="text" id="numero" name="numero" value="<?= $compte['numero_rue'] ?>" disabled class="not-active"/>
          <span id="erreur-numero" class="erreur"></span>
        </article>
      </div>

      <?php
        if(isset($compte['complement_adresse'])){
          ?>
            <article>
              <label for="complement">Complément d'adresse</label>
              <input type="text" id="complement" name="complement" value="<?= $compte['complement_adresse'] ?>" disabled class="not-active"/>
            </article>
          <?php
        }else{
          ?>
            <article class="hidden">
              <label for="complement">Complément d'adresse</label>
              <input type="text" id="complement" name="complement" value="<?= $compte['complement_adresse'] ?>" disabled class="not-active"/>
            </article>
          <?php
        }
      ?>

      <div class="check-div">
        <article>
          <label for="ville">Ville</label>
          <input type="text" id="ville" name="ville" value="<?= $compte['ville'] ?>" disabled class="not-active"/>
          <span id="erreur-ville" class="erreur"></span>
        </article>

        <article>
          <label for="code-postal">Code postal</label>
          <input type="text" id="code-postal" name="code-postal" value="<?= $compte['code_postal'] ?>" disabled class="not-active"/>
          <span id="erreur-code-postal" class="erreur"></span>
        </article>
      </div>
    </section>

    <section class="check-section hidden">
      <h3>Mot de passe</h3>
      <article>
        <label for="old-password">Ancien mot de passe</label>
        <input type="password" id="old-password" name="old-password" disabled class="not-active"/>
        <span id="erreur-old-password" class="erreur"></span>
      </article>

      <article>
        <label for="new-password">Nouveau mot de passe</label>
        <input type="password" id="new-password" name="new-password" disabled class="not-active"/>
        <span id="erreur-new-password" class="erreur"></span>
      </article>

      <article>
        <label for="confirm-password">Confirmation du mot de passe</label>
        <input type="password" id="confirm-password" name="confirm-password" disabled class="not-active"/>
        <span id="erreur-confirm-password" class="erreur"></span>
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
            <button class="hidden btn-modif-pro" id="btn-delete-credit-card" type="button">Supprimer</button>
            <article id="new-credit-card" class="hidden-credit-card">
              <label for="card-number">Numéro de carte</label>
              <input type="text" id="card-number" name="card-number"></input>
              <span id="erreur-card-number" class="erreur"></span>
              
              <label for="expiration-date">Date expiration</label>
              <input type="month" id="expiration-date" name="expiration-date"></input>
              <span id="erreur-expiration-date" class="erreur"></span>
              
              <label for="cvv">Cryptogramme</label>
              <input type="text" id="cvv" name="cvv"></input>
              <span id="erreur-cvv" class="erreur"></span>
            </article>
            <button class="hidden-credit-card btn-modif-pro" id="btn-cancel-credit-card" type="button">Annuler</button>
          </section>
        <?php
      }else{
        ?>
          <section class="check-section hidden">
            <h3>Carte bancaire</h3>
            <article>
              <label for="card-number">Numéro de carte</label>
              <input type="text" id="card-number" name="card-number"></input>
              <span id="erreur-card-number" class="erreur"></span>

              <label for="expiration-date">Date expiration</label>
              <input type="month" id="expiration-date" name="expiration-date"></input>
              <span id="erreur-expiration-date" class="erreur"></span>

              <label for="cvv">Cryptogramme</label>
              <input type="text" id="cvv" name="cvv"></input>
              <span id="erreur-cvv" class="erreur"></span>
            </article>
          </section>
        <?php
      }
    ?>

    <div id="div-btn-modif">
      <button type="button" id="btn-update" class="btn-modif-pro">Modifier</button>
      <button type="button" id="btn-cancel" class="hidden btn-modif-pro">Annuler</button>
      <button type="submit" id="btn-submit" class="hidden btn-modif-pro">Enregistrer</button>
    </div>

  </form>
</div>
<script src="./js/checkModifPro.js"></script>