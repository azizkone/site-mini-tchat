<?php
// deconnexion par liens
 session_start();
 session_destroy();
 header('location:login.html');
 exit;

 ?>
