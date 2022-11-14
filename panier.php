<?php

// crée une connexion avec la base de donnée

function connexion() {

    try{
        $connexion = new PDO("mysql:host=localhost;dbname=dg4", "root", ""); // ICI
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
        $query = "DELETE FROM panier WHERE product_id='" . $_POST['item_id'] . "';";
        $requete = $connexion->prepare($query);
        $requete->execute();
    }

    $query = "SELECT * FROM panier JOIN data ON panier.product_id = data.ID;";
    $requete = $connexion->prepare($query);
    $requete->execute();

    $answer = $requete->fetchall();
}

    catch(PDOException $e){
    echo 'Echec : ' .$e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css"/>
    <title>Panier</title>
</head>
<body>

<section class="entete">
  <div class="titre">
    <b>D E S I G N &nbsp; 4 &nbsp; G R E E N</b>
    <font color="white"> <font size="2px"> <font face='Georgia', Arial>
      <i>Site entièrement programmé par des étudiants esaipiens.</i>
    </font></font></font>
  </div>
</section>

<a href="index.php">< RETOUR</a>

<section class="panier">
<?php
foreach ($answer as $key => $value) { ?>
    <div class="boite">
        <h3><?php echo ucfirst($value['Famille Origine']); ?></h3>
        <p>id :<?php echo ucfirst($value['ID']); ?></p>
        <p>Recommandations :<?php echo ucfirst($value["RECOMMANDATION"]); ?></p>
        <p>Criteres :<?php echo ucfirst($value['CRITERES']); ?></p>
        <p>Justification :<?php echo ucfirst($value['JUSTIFICATIONS']); ?></p>

        <form action="" method="post">
            <input type="hidden" name="item_id" value="<?php echo $value['product_id']; ?>">
            <input type="submit" value="Supprimer">
        </form>
    </div>
<?php
}

?>

</section>

<style>

* {
    margin : 0;
    box-sizing : border-box;
}

.boite {
    width : 80%;
    margin : 10px;
    display : flex;
    flex-direction : column;
    justify-content : space-around;
    align-items : center;
    text-align : center;
}

.boite h3 {
    width : 100%;
}

a {
    width : 100%;
    margin : 8px;
    text-align : center;
    text-decoration : none;
    color : #083B32;
}

</style>

</body>
</html>
