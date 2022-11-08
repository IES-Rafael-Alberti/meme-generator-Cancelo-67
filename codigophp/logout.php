<?php 
require("logintest.php");

unset($_SESSION["nombre"]);
session_destroy();
session_write_close();
header("Location: login.php");