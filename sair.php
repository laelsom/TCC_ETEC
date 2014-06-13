<?php
   session_start("login");
   session_destroy();
   header("location:index.php");
?>