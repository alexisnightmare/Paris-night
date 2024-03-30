<?php
    $serveur = "localhost";
    $dbname = "cours";
    $user = "root";
    $pass = "root";
    
    $prenom = $_POST["nom"];
    $discord = $_POST["discord"];
    $objet = $_POST["objet"];
    $message = $_POST["message"];
    
    try{
        //On se connecte à la BDD
        $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        //On insère les données reçues
        $sth = $dbco->prepare("
            INSERT INTO form(prenom, discord, objet, message)
            VALUES(:prenom, :discord, :objet, :message)");
        $sth->bindParam(':prenom',$prenom);
        $sth->bindParam(':discord',$discord);
        $sth->bindParam(':objet',$objet);
        $sth->bindParam(':message',$message);
        $sth->execute();
        
        //On renvoie l'utilisateur vers la pobjet de remerciement
        header("Location:form-merci.html");
    }
    catch(PDOException $e){
        echo 'Impossible de traiter les données. Erreur : '.$e->getMessobjet();
    }
?>