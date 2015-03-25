<?php

$notes = array(array('value' => 50, 'count' => 5 ), array('value' => 20, 'count' => 5 ) );

$amount = 900;
$lowest_amount = 1000;
$total_available = 0;

$message = '';
$found = 0;
//$value_count = count($notes);

// to get the total amount in ATM and the lowest possible amount to withdraw
foreach ($notes as $note)  
{   
    if( $note['value'] < $lowest_amount ){    
        $lowest_amount = $note['value'];
    }
    $total_available += $note['value']* $note['count'];
}

if( $amount > $total_available ){
    $message =  "The amount entered is too high";
}
else if( $amount < $lowest_amount ) {
    $message = "Please enter higher amount";
}
else {
    for($i50=0; $i50<=$notes[0]['count']; $i50++)
    {
        for($i20=0; $i20<=$notes[1]['count']; $i20++)
        {
            if( ($i50*$notes[0]['value']) + ($i20*$notes[1]['value']) == $amount )
            {
                $message = "Collect Your Cash: $i50 x $50 and $i20 x $20";
                $found = 1; break;
            }
            if($found == 1)
                break;
        }
    }
    if (!$found)
        $message = 'The amount is not available!';
}
echo $message;    

?>