<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Notes</title>
<style type="text/css">
    #container {
        text-align: center;
    }
    a {
        text-decoration: none;
    }    
</style>
</head>
<body>
<p><a href="<?php echo base_url()?>index.php/start"><< Start Over</a></p>
<div id="container">
	<h3>Update $50 and $20 notes count</h3>
        <form name="add-form" action="<?php echo base_url()?>index.php/start/add" method="post">
            <p>Enter A Number for $20 Note: <input type="number" name="note-20"></p>
            <p>Enter A Number for $50 Note: <input type="number" name="note-50"></p>
            <p><input type="submit" value="Submit"></p>
	</form>
</div>

</body>
</html>
<script>
$(document).ready(function(){
});
</script>