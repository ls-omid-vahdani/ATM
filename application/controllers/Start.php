<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends CI_Controller {        

       public function __construct()
       {
            parent::__construct();            
       }
	function index()
	{
            $note_types = $this->Notes->get_note_types();
            foreach( $note_types as $types)
                $data['note_'.$types] = $this->Notes->get_count($types);

            $action = $this->input->post('action');    
            if (empty($action))
                $this->load->view('start', $data);
            elseif ( $action == "withdraw" ){
                $this->withdraw();                
            }
            elseif ( $action == "add" ) {
                $this->load->view('add_money');
            }

	}
        
        function add()
        {
            if( $this->input->post('note-20') !='' && $this->input->post('note-50') != '' )
            {
                $note_20 = $this->input->post('note-20');
                $note_50 = $this->input->post('note-50');

                if($note_20 < 0) $note_20 = 0;
                if($note_50 < 0) $note_50 = 0;

                $this->Notes->save_count($note_20, $note_50);

                $data['note_20'] = $note_20;
                $data['note_50'] = $note_50;
                $this->load->view('start', $data);
            }
            else 
                $this->load->view('add_money');
        }
        
       function withdraw()
       {
            $note_types = $this->Notes->get_note_types();
            foreach( $note_types as $types)
            {
                $notes[$types] = $this->Notes->get_count($types);
                $data["note_".$types] = $notes[$types]; 
            }
            $amount = $this->input->post('amount');
            $data['message'] = 'Please Enter An Amount';
    
            if (empty($amount))
                $this->load->view('withdraw', $data);
            else
            {
                $response = $this->process_withdraw($amount, $notes);
                $data['message'] = $response['message'];
           
                if ( $response['success'] == 1 )
                {
                    $result = $this->Notes->update_notes($response['notes'], $amount);
                    if(!$result)
                        $data['message'] .= "An error occured while updating money in the ATM";
                }
                foreach( $note_types as $types){
                    $data["note_".$types] = $this->Notes->get_count($types);
                }
                $this->load->view('withdraw', $data);                           
            }
       }
       
       function process_withdraw($amount, $note_types)
       {
            foreach ($note_types as $value => $count)
                $notes[] = array('value' => $value, 'count' => $count) ;

            //print_r($notes);die();
            $lowest_amount = 1000;
            $total_available = 0;

            $message = '';
            $found = 0;

            // to get the total amount in ATM and the lowest possible amount to withdraw
            foreach ($notes as $note)  
            {   
                if( $note['value'] < $lowest_amount ){    
                    $lowest_amount = $note['value'];
                }
                $total_available += $note['value']* $note['count'];
            }

            if( $amount > $total_available ){
                $message =  "The amount entered is too high!";
            }
            else if( $amount < $lowest_amount ) {
                $message = "Please enter higher amount!";
            }
            else {
                for($i=0; $i<=$notes[0]['count']; $i++)
                {
                    for($j=0; $j<=$notes[1]['count']; $j++)
                    {
                        if( ($i*$notes[0]['value']) + ($j*$notes[1]['value']) == $amount )
                        {
                            $message = "Collect Your Cash ($$amount):<br>";
                            $message .= "$i x $".$notes[0]['value']." and $j x $".$notes[1]['value'];
                            $withdraw20 = $i; 
                            $withdraw50 = $j;
                            $found = 1; break;
                        }
                        if($found == 1)
                            break;
                    }
                }
                if (!$found)
                    $message = 'The amount is not available!';
            }
            $respones['success'] = $found;
            $respones['message'] = $message;
            if($found == 1){
                $respones['notes']["20"] = $withdraw20;
                $respones['notes']["50"] = $withdraw50;
            }
            return $respones;    
       }

}
