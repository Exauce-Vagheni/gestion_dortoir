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
                $supprimer=$con->prepare("DELETE FROM chambres WHERE id_chambre=?");
                $supprimer->execute(array($_GET['id']));
                echo"
                <script>
                alert('Chambre supprimé !');
                </script>
                ";
            }
                ?>
         <?php 
            include("connexion.php");
            if(isset($_POST['designation']) AND isset($_POST['rang']) AND isset($_POST['cout'])){
                $ajout=$con->prepare("INSERT INTO chambres(designation,rang,montant_total) VALUES(?,?,?)");
                $ajout->execute(array($_POST['designation'],$_POST['rang'],$_POST['cout']));
                echo"
                <script>
                alert('Chambre ajouté avec succès !');
                </script>
                ";
            }
        ?>
       <div> 
       <label for="">Designation de la chambre</label><br>
        <input type="text" name="designation"><br>
       </div>
       <div> 
       <label for="">Coût de la chambre</label><br>
        <input type="text" name="cout"><br>
        <label for="">Rang de la chambre</label>
        <select name="rang" id="">
            <option value="Rang 1">Rang 1</option>
            <option value="Rang 2">Rang 2</option>
            <option value="Rang 3">Rang 3</option>
        </select>
       </div><br>
       <div>
       </div>
       
        <input type="submit" value="Enregistrer la chambre" id="btn">
        </div>
        
        <div align="center">
        <h3>Liste des chambres</h3>
        <table border="1">
            <tr id="entete">
                <td>Designation</td>
                <td>Rang</td>
                <td>Coût</td>
                <td>Opération</td>
            </tr>
            <tr>
            <?php 
            include("connexion.php");
           
            $select=$con->query("SELECT * FROM chambres");
            while($resultat=$select->fetch()){

                echo "<tr>";
                echo "<td>".$resultat['designation']."</td>";
                echo "<td>".$resultat['rang']."</td>";
                echo "<td>".$resultat['montant_total']."</td>";
                echo "<td><a href='chambres.php?id=".$resultat['id_chambre']."'>Supprimer</a></td>";
                echo "<tr>";

            }
          
        ?>
        </tr>
        </table>
       
</body>
</html>