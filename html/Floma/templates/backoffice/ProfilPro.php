<?php
$head_title = "Consultation information";
$head_subtitle = "PROFIL";
$head_svg = "/assets/icons/account_white.svg";
include 'head_title.php';
include 'black_button.php'
?>
<div class="form-container" style="display: flex; flex-direction: column; gap: 2rem; font-family: sans-serif; max-width: 800px; margin: auto;">

  <div class="section">
    <h3 style="border-bottom: 1px solid #000;">Informations générales</h3>
    <div class="grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem 2rem;">
      
      <div>
        <label for="prenom">Prénom </label><br>
        <input type="text" id="prenom" name="prenom" placeholder="Pierre" disabled/>
      </div>
      
      <div>
        <label for="nom">Nom </label><br>
        <input type="text" id="nom" name="nom" placeholder="Durant" disabled/>
      </div>

      <div>
        <label for="telephone">Numéro de téléphone </label><br>
        <input type="tel" id="telephone" name="telephone" placeholder="00 00 00 00 00" disabled/>
      </div>

      <div>
        <label for="email">Adresse e-mail </label><br>
        <input type="email" id="email" name="email" placeholder="pierre.durant@gmail.com" disabled/>
      </div>

      <div>
        <label for="denomination">Dénomination sociale </label><br>
        <input type="text" id="denomination" name="denomination" placeholder="Le commerce de Pierre" disabled/>
      </div>

      <div>
        <label for="siren">Numéro SIREN</label><br>
        <input type="text" id="siren" name="siren" placeholder="362 521 879" disabled/>
      </div>

      <div>
        <label for="password">Mot de passe </label><br>
        <input type="password" id="password" name="password" disabled/>
      </div>

      <div>
        <label for="confirmPassword">Confirmation du mot de passe </label><br>
        <input type="password" id="confirmPassword" name="confirmPassword" disabled/>
      </div>

    </div>
  </div>

  <!-- Adresse -->
  <div class="section">
    <h3 style="border-bottom: 1px solid #000;">Adresse</h3>
    <div class="grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem 2rem;">

      <div>
        <label for="rue">Rue</label><br>
        <input type="text" id="rue" name="rue" placeholder="Rue Lepic" disabled/>
      </div>

      <div>
        <label for="numero">Numéro</label><br>
        <input type="text" id="numero" name="numero" placeholder="15" disabled/>
      </div>

      <div>
        <label for="ville">Ville</label><br>
        <input type="text" id="ville" name="ville" placeholder="Paris" disabled/>
      </div>

      <div>
        <label for="codePostal">Code postal</label><br>
        <input type="text" id="codePostal" name="codePostal" placeholder="75000" disabled/>
      </div>

      <div style="grid-column: 1 / -1;">
        <label for="departement">Département</label><br>
        <input type="text" id="departement" name="departement" placeholder="Ile-Et-Vilaine" disabled/>
      </div>

    </div>
  </div>

</div>