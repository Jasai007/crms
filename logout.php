<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: ind.php"); // Redirecting To Home Page
}
?>