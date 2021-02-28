<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>logout</title>
	<style>
	button.yes {font-size:200%; margin-left:45%; margin-top:5%; }
	button.no {font-size:200%; margin-left:47%; margin-top:4%; width:10%; }	
	</style>
	<head>
	<a href="logoutRE.php"><button onclick ="areYouSure()" class="yes">Confirm Logout?</button></a>
	<a href="home.php"><button onclick ="No()" class="no">No</button></a>
	
</html>
