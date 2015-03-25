<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bank XXX</title>
    <style type="text/css">
    #container {
        text-align: center;
    }
    </style>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
</head>
<body>
<div id="container">
	<h1>Welcome to XXX Bank</h1>
        <form name="start-form" action="<?php echo base_url()?>index.php/start" method="post">
            <p><input type="button" id="withdraw" value="Withdraw Money"></p>
           <p><input type="button" id="add" value="Update Notes In ATM"> *</p>
            <p>*This is not a requirement, just added to change the number of notes to avoid modifying the code!</p>
            <p><hr></p>
            <p>Available $20 notes: <?php echo $note_20; ?></p>
            <p>Available $50 notes: <?php echo $note_50; ?></p>

               <input type="hidden" value="" name="action" id="action">
	</form>
</div>

</body>
</html>
<script>
$(document).ready(function(){
    $("input#withdraw, input#add").click(function(){
        $("#action").val($(this).attr("id"));
        $("form").submit();
    });
});
</script>