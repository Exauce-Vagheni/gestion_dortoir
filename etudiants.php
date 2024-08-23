<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
body{
    font-family:arial;
}
input{
    font-size:20px;
    margin:5px;
}
form{
    margin-top:70px;
}
#btn{
    background-color:blue;
    padding:5px;
    border-radius:20px;
    font-size:15px;
    cursor:pointer;
    color:white;
}
ul li{
    list-style-type:none;
    display:inline-block;
    color:white;
}
li a{
    color:white;
    text-decoration:none;
    padding-right:10px;
}
td{
    padding:5px;

}
table{
    width:65%;

}
</style>
<body>
<div  style="background-color:blue;padding:2px;top:0;margin-left:10px;color:white;">

<div style="display:inline-block;">
<nav>
    <ul>
    <li><a href="etudiants.php">Etudiants</a></li>
    <li><a href="chambres.php">Chambres</a></li>
    <li><a href="paiements.php">Paiements</a></li>
    <li><a href="index.php">Deconnexion</a></li>
    </ul>
    </nav>
</div>
<h2 style="margin:4px;display:inline-block;">DORTOIR PLAZZA</h2>
</div>
    <div>
    <form action="" method="POST">
        <div align="center">
        <h3>Liste des chambres</h3>
        <?php 
            include("connexion.php");
            if(isset($_GET['id'])){
                $annuler=$con->prepare("DELETE FROM etudiants WHERE id_etudiant=?");
                $annuler->execute(array($_GET['id']));}
                ?>
         <?php 
            include("connexion.php");
            if(isset($_POST['nom']) AND isset($_POST['postnom'])){
                $ajout=$con->prepare("INSERT INTO etudiants(nom,postnom,id_chambre,montant_paye) VALUES(?,?,?,?)");
                $ajout->execute(array($_POST['nom'],$_POST['postnom'],$_POST['chambre'],$_POST['montant']));
                echo"
                <script>
                alert('Etudiant enregistré avec succès !');
                </script>
                ";
            }
        ?>
       <div> 
       <label for="">Nom</label><br>
        <input type="text" name="nom"><br>
       </div>
       <div> 
       <label for="">Postnom</label><br>
        <input type="text" name="postnom"><br>
        <label for="">Chambre</label>
        <select name="chambre" id="">
        <?php 
            include("connexion.php");
           
            $select=$con->query("SELECT * FROM chambres");
            while($resultat=$select->fetch()){

                echo "<option value=".$resultat['id_chambre'].">".$resultat['designation']."</option>";

            }
          
        ?>
        </select>
       </div><br>
       <label for="">Montant payé</label><br>
        <input type="number" name="montant" min="0"><br>
       <div>
       </div>
       
        <input type="submit" value="Enregistrer la chambre" id="btn">
        </div>
        
        <div align="center">
        <h3>Liste des chambres</h3>
        <table border="1">
            <tr id="entete">
                <td>Nom</td>
                <td>Postnom</td>
                <td>Chambre</td>
                <td>Montant payé</td>
                <td>Montant total</td>
            </tr>
            <tr>
            <?php 
            include("connexion.php");
           
            $select=$con->query("SELECT * FROM etudiants INNER JOIN chambres ON etudiants.id_chambre=chambres.id_chambre");
            while($resultat=$select->fetch()){

                echo "<tr>";
                echo "<td>".$resultat['nom']."</td>";
                echo "<td>".$resultat['postnom']."</td>";
                echo "<td>".$resultat['designation']."</td>";
                echo "<td>".$resultat['montant_paye']."</td>";
                echo "<td>".$resultat['montant_total']."</td>";
                echo "<td><a href='etudiants.php?id=".$resultat['id_etudiant']."'>Supprimer</a></td>";
                echo "<tr>";

            }
          
        ?>
        </tr>
        </table>
       
</body>
</html>