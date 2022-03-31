<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="connexion.php">
        <button>
            Connexion
        </button>
    </a>
<?php
    //import des recourses
    include './bdd.php';
    include './fonction.php';
    $data = requete_lire_table_users();

    if(isset($_POST['pseudo_user']) AND isset($_POST['mdp_user']) AND isset($_POST['mail_user']) AND
    $_POST['pseudo_user'] !='' AND $_POST['mdp_user'] !='' AND $_POST['mail_user'] !=''){ 
    /* if(!empty($_POST['pseudo']) AND !empty($_POST['pseudo'])){ */
        $pseudo = $_POST['pseudo_user'];
        $mail = $_POST['mail_user'];
        $mdp = $_POST['mdp_user'];
        // attention metode depasser
        $mdp = md5($mdp);
        $db = connexion_BD();

        addUser($db, $pseudo, $mail, $mdp);
        echo "<p>le compt : $pseudo a ete ajouter en bdd</p>";
        //echo 'le pseudo est : '.$name.' et son mot de passe : '.$mdp.'';
    }
    //sinon affiche un message
    else{
        echo '<p>Veuillez remplir les champs du formulaire</p>';
    }

?>
<div class="container">
    <h1>Liste des utilisateurs</h1>
    <div class="container"> 
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
    </div>

    <table class="table table-striped">
        <thead>
            <th>Id</th>
            <th>Pseudo</th>
            <th>E-mail</th>

        </thead>
        <tbody>
            <?php foreach($data as $value) : ?>
                <tr>
                    <td><?= $value->id_user ?></td>
                    <td><?= $value->pseudo_user ?></td>
                    <td><?= $value->mail_user ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<form action="" method="post">
        <p>Saisir son nom:</p>
        <input type="text" name="pseudo_user" placeholder="Nom">
        <p>Saisir son email</p>
        <input type="mail" name="mail_user" placeholder="Mail">
        <p>Saisir son mot de passe:</p>
        <input type="password" name="mdp_user" placeholder="Mdp">
        <p><input type="submit" value="envoyer" id="boutton"></p>
    </form>


    <a href="logout.php">Logout</a>

</body>
</html>