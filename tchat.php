<?php
if(isset($_SESSION["username"]) || empty($_SESSION["username"])){
   header("location:");
}
include "functions.php";
 ?>
<!Doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <ul>
        <li><a class="active" href="register.html">Accueil</a></li>
        <li><a href="deconnexion.php">Deconnexion</a></li>
    </ul>
<div align="center" method="post">
  <h2> Profil de <?php echo $_SESSION["username"]; ?></h2>
  <br/>
  <br/>
  <div id="tchat">
    <?php
    $sql = "SELECT * FROM chat WHERE message ORDER BY date DESC LIMIT 15";
    $resultatReq = requeteSql($sql);
    $req =  mysql_query($resultatReq) OR die (mysql_error());
    while ($db = mysql_fetch_assoc($req)) {
    ?>
    <?php
    }
     ?>
      <p><strong><?php echo $db["username"];?></strong>:<?php echo htmlentities($db["message"]);?></p>
  </div>
  <br/>
  <br/>
  <br/>
  <div class="tchatForm" style="width:100%;">
    <form action="functions.php" method="post" >
    <div style="margin-right:110px;margin-left:110px;">
      <textarea name="message" style="width:100%;height:25%;" ></textarea>
    </div>
    <div class="form_rl">
      <input type="submit" value="Envoyer" id="ok" />
        <button type="reset">Deconnexion</button>
      </div>
        <input type="hidden" value="" name='anchor' id='anchor'>
    </form>
  </div>
</body>
</html>
