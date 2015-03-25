<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<head>
    <title>Withdraw</title>
    <style type="text/css">
    #container {
        text-align: center;
    }
    a {
        text-decoration: none;
    }
    </style>
<!--<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script> -->
</head>
<body>
<p><a href="<?php echo base_url()?>index.php/start"><< Back To Home</a></p>    
<div id="container">
	<h3>Please Enter The Desired Amount:</h3>
        <form name="withdraw-form" action="<?php echo base_url()?>index.php/start/withdraw" method="post">
            <p><input type="number" name="amount"></p>
            <p><input type="submit" value="Submit"></p>
<?php echo "<p><br><br>$message</p>"; ?>
            <p><hr></p>
            <p>Available $20 notes: <?php echo $note_20; ?></p>
            <p>Available $50 notes: <?php echo $note_50; ?></p>
            
	</form>
</div>

</body>
<script>
$(document).ready(function(){
});
</script>