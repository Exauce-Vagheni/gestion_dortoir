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
        <h3>Liste des paiements faits</h3>
         <?php 
            include("connexion.php");
            if(isset($_POST['id_etudiant']) AND isset($_POST['montant'])){

                $update=$con->prepare("UPDATE etudiants SET montant_paye=montant_paye+? WHERE id_etudiant=?");
                $update->execute(array($_POST['montant'],$_POST['id_etudiant']));
                $insert=$con->prepare("INSERT INTO paiements(id_etudiant,montant,date_paiement) VALUES(?,?,NOW())");
                $insert->execute(array($_POST['id_etudiant'],$_POST['montant']));
                echo"
                <script>
                alert('Montant enregistré avec succès !');
                </script>
                ";
            }
        ?>
       <div>
        <label for="">Etudiant: </label>
        <select name="id_etudiant" id="">
        <?php 
            include("connexion.php");
           
            $select=$con->query("SELECT * FROM etudiants");
            while($resultat=$select->fetch()){

                echo "<option value=".$resultat['id_etudiant'].">".$resultat['nom']." ".$resultat['postnom']."</option>";

            }
          
        ?>
        </select>
       </div><br>
       <label for="">Montant payé</label><br>
        <input type="number" name="montant" min="0"><br>
       <div>
       </div>
       
        <input type="submit" value="Sauvegarder paiement" id="btn">
        </div>
        
        <div align="center">
        <h3>Paiements</h3>
        <table border="1">
            <tr id="entete">
                <td>Montant payé</td>
                <td>Nom</td>
                <td>Postnom</td>
                <td>Chambre</td>
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