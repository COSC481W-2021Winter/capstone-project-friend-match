<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>logout</title>

<?php
  session_destroy();
  ?>
  <meta http-equiv="refresh" content="0; url='index.html'"/>
</html>
