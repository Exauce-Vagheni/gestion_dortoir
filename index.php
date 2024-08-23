<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<style>
   input,label{
    font-size:18px;
   } 
   #btn{
    background-color:blue;
    padding:5px;
    color:white;
    border-color:blue;
    border-radius:45px;
   }
</style>
<body>
    <div style="background-color:blue;color:white;margin-top:-25px;padding:1px;">
    <h1 style="margin-left:10px;">DORTOIR PLAZZA</h1>
    </div>
    <div align="center" style="margin-top:50px;">
    <h2 style="color:;">Se connecter en tant que gestionnaire !</h2>
      <form action="" method="post"><br>
      <p> <?php 
            include("connexion.php");
            if(isset($_POST['identifiant']) AND isset($_POST['password'])){
                $req=$con->prepare("SELECT * FROM identifiants WHERE gestionnaire=? AND password=?");
                $req->execute(array($_POST['identifiant'],$_POST['password']));
                $resultat=$req->fetchAll();
                if(count($resultat)>0){
                    session_start();
                    $_SESSION['identifiant']=$_POST['identifiant'];
                    header("location:etudiants.php");
                }else{
                    echo "<script>alert('Les identifiants sont incorrects');</script>";
                }
            }
        ?>
        </p></p>
        <label for="">Gestionnaire</label><br>
        <input type="text" name="identifiant"><br><br>
        <label for="">Mot de passe</label><br>
        <input type="text" name="password"><br><br>
        <input type="submit" id="btn" value="Connexion">
    </form>  
    </div>
    
</body>
</html>