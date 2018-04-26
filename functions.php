<?php

session_start(); //Demarre la session

function requeteSql($sql)
{
    $user = 'root';
    $password = '';
    $db = 'tchat';
    $host = 'localhost';
    $port = 3306;

    // Connexion à la BDD
    $link = mysqli_init();
    $success = mysqli_real_connect(
       $link,
       $host,
       $user,
       $password,
       $db,
       $port
    );

    // Execution de la requete ET renvoi d'erreur si echec d execution + Recuperation de la reponse de la requete sql
    $reponse = mysqli_query($link, $sql) or die ('Erreur SQL. Detail : '.mysqli_error($link));

    // Fermeture de la connexion
    mysqli_close($link);
    return $reponse;
}

function inscription()
{
    $nom = $_POST['nom'];
    $prenom = $_POST ['prenom'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($nom != '' && $prenom != '' && $username != '' && $password != '')
    {
        $requete = "INSERT INTO utilisateur ( `nom`, `prenom`, `username`, `password`) VALUES ('$nom','$prenom','$username','$password')";
        requeteSql($requete);
        header('Location: login.html');
    }
    else
    {
        echo 'Vous devez remplir tous les champs !';
    }
}

function connexion()
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username != '' || $password != '')
    {
        $reponseuser = "SELECT username FROM utilisateur WHERE (username = '$username')";
        $reponsemdp= "SELECT password FROM utilisateur WHERE (password = '$password')";
        $resultatuser = requeteSql($reponseuser);
        $resultatmdp = requeteSql($reponsemdp);
        //Recuperation de la reponse du serveur
        $user = mysqli_fetch_row($resultatuser);
        $mdp = mysqli_fetch_row($resultatmdp);

        if ( $user[0] == $username && $mdp[0] == $password)
        {
            // $_SESSION variable globale permanente
            $_SESSION['session_user'] = $username;
            header('Location:speudo.html');
        }
        else
        {
            echo 'Mauvais identifiants ou mot de passe.';
        }
    }
}
function verificationUsername()
{
    $username = $_POST['username'];
    if($username != '' )
    {
        $verifieuser = "SELECT username FROM utilisateur WHERE (username = '$username')";
        $resultatuser = requeteSql($verifieuser);
        //Recuperation de la reponse du serveur
        $user = mysqli_fetch_row($resultatuser);
    if ( $user[0] == $username )
    {
        // $_SESSION variable globale permanente
        $_SESSION['session_user'] = $username;
        header('Location:tchat.php');
    }
    else
    {
      echo 'Mauvais username';
    }
  }
}
/*function membres()
{
  $username = $_POST['username'];

  if (isset($_POST['username']))
   {
    $getuser = intval($_POST['username']);
    $requser =  "SELECT username FROM utilisateur WHERE (username = '$username')";
    $requser->execute(array($getuser));
      $user = mysqli_fetch_row( $requser);
    }
}*/
//Determine la fonction a executer
if(isset($_POST['anchor']))
{
    switch($_POST['anchor'])
    {
        case 'inscription':
            inscription();
            break;
        case 'connexion':
            connexion();
            break;
       case 'verificationUsername':
            verificationUsername();
            break;
        case 'membres':
              membres();
            break;
        default :
            die ('error');
    }
}

?>
