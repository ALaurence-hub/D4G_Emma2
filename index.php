<!-- lien bdd et html -->
<?php

// crée une connexion avec la base de donnée

function connexion() {

  try{
      $connexion = new PDO("mysql:host=localhost;dbname=dg4", "root", "");// ICI
      $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $connexion->exec("SET NAMES utf8");
  }

  catch(PDOException $e){
      echo 'Echec de la connexion : ' .$e->getMessage();
  }
}

try {

  $connexion = new PDO("mysql:host=localhost;dbname=d4g", "root", ""); // ICI
  $connexion->exec("SET NAMES utf8");

  if (isset($_POST['item_id'])) {
      $query = "INSERT INTO panier(product_id) VALUES ('" . $_POST['item_id'] . "')";
      $requete = $connexion->prepare($query);
      $requete->execute();
  }

  $query = "SELECT * FROM data;";
  $requete = $connexion->prepare($query);
  $requete->execute();

  $items = $requete->fetchall();
}

  catch(PDOException $e){
  echo 'Echec : ' .$e->getMessage();
}

?>

<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="utf-8"/>
      <title> PROJET D4G - BRIEU, EYMAR, PLAINDOUX & VANTOURNHOUDT </title>
      <link rel="stylesheet" href="index.css"/>
    </head>

    <!-- entete et titre -->
    <body>
      <section class="entete">
        <div class="titre">
          <b>D E S I G N &nbsp; 4 &nbsp; G R E E N</b>
          <font color="white"> <font size="2px"> <font face='Georgia', Arial>
            <i>Site entièrement programmé par des étudiants esaipiens. </i>
          </font></font></font>
        </div>
      </section>

      <!-- menu -->
      <nav>

        <li><a href="#famille1">STRATEGIE</a></li>
        <li><a href="#famille2">SPECIFICATIONS</a></li>
        <li><a href="#famille3">UX/UI</a></li>
        <li><a href="#famille4">CONTENUS</a></li>
        <li><a href="#famille5">ARCHITECTURE</a></li>
        <li><a href="#famille6">FRONTEND</a></li>
        <li><a href="#famille7">BACKEND</a></li>
        <li><a href="#famille8">HEBERGEMENT</a></li>
        <li><a href="panier.php">PANIER</a></li>

      </nav>




      <!-- articles -->
      <section class="corps">
        <div class="titre2">
          <center> LES BONNES PRATIQUES
          <br/><hr width=60% height=25px color=#850606></center>
        </div>

        <div class="article">
          <?php foreach($items as $item){ ?>
            <div class="boite">
              <center>
              <div class="corps-boite">
                <h1>
                  <?php echo htmlspecialchars($item['Famille Origine']); ?>
                </h1>

                <h5>
                  <?php echo htmlspecialchars($item['ID']); ?>
                </h5>

                <div class="texte">
                  <?php echo htmlspecialchars($item['CRITERES']); ?>
                </div>
              </div>
              </center>
              <div class="boutton">
                <form action="" method="post" class="boutton">
                  <button type="envoyer" class="btn" name="ajouter">Ajouter au panier</button>
                  <input type='hidden' name='item_id' value='<?php echo $item['ID']; ?>'>
                </form>
              </div>
            </div>
          <?php } ?>
        </div>
      </section>

      <!-- pied de page -->
      <footer>
          <p><b>Tous droits réservés © BRIEU Emma, EYMAR Alexandre, PLAINDOUX Teddy & VANTOURNHOUDT Adrien | 2022</b></p>
      </footer>
    </body>
</html>
