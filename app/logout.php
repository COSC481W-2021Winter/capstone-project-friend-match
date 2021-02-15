<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>logout</title>
	<style>
	button.yes {font-size:200%; margin-left:45%; margin-top:5%; }
	button.no {font-size:200%; margin-left:47%; margin-top:4%; width:10%; }

	
	</style>
	
	<head>
	<button onclick ="areYouSure()" class="yes">Confirm Logout?</button>
	<button onclick ="No()" class="no">No</button>
	<script>
		function areYouSure(){
			var currentfile = window.location.pathname;
			//removes current file its at and grabs just directory
			var directory = currentfile.substring(0, currentfile.lastIndexOf('/'));
			window.location.pathname = directory+'/index.html';
			

		}
		function No(){
			var currentfile = window.location.pathname;
			//removes current file its at and grabs just directory
			var directory = currentfile.substring(0, currentfile.lastIndexOf('/'));
			window.location.pathname = directory+'/home.php';
		}
	</script>
</html>
