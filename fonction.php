<?php

function requete_lire_table_users(){
    $db = connexion_BD();
    $sql = "SELECT * FROM users";
    $req = $db->prepare($sql);
    $req->execute();
    $data = $req->fetchAll(PDO::FETCH_OBJ);
    return $data;
}

function addUser($db, $nom, $mail, $mdp){
    try{
        $db = connexion_BD(); 
        $req = $db->prepare('INSERT INTO users(pseudo_user, mail_user, mdp_user)
        VALUE(:pseudo_user, :mail_user, :mdp_user)');
        $req->execute(array(
            'pseudo_user' => $nom,
            'mail_user' => $mail,
            'mdp_user' => $mdp
        ));
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}
    
?>