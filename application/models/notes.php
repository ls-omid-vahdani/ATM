<?php
class Notes extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function save_count($note_20, $note_50)
    {
        $amount = ($note_20*20) + ($note_50*50);
        $data_trans = array("trans_type" => "admin_add", "amount" => $amount);

        $this->db->insert('transactions', $data_trans);
        $insert_id = $this->db->insert_id();
        
        $data20 = array('note_id' => 1, 'value' => 20, 'count' => $note_20, 'trans_id' => $insert_id);
        $data50 = array('note_id' => 2, 'value' => 50, 'count' => $note_50, 'trans_id' => $insert_id);
        
        $this->db->insert('available_notes', $data20);
        $this->db->insert('available_notes', $data50);
    }
    function get_count($var)
    {
        $limit = 1;
        $this->db->select('count');
        $this->db->from('available_notes');
        $where = "value = $var";
        $this->db->where($where)->order_by("id", "desc")->limit(1);
        $query = $this->db->get();
        
        foreach ($query->result() as $row)
            return $row->count;
    }
    function get_note_types()
    {
        $this->db->select('value')->distinct();
        $this->db->from('notes');
        $query = $this->db->get();
        //die( $this->db->last_query($query) );
        foreach ($query->result() as $row)
        {
           $note_values[] =  $row->value;
        }
        return ($note_values);
    }
    function update_notes($notes, $amount)
    {
        $data_trans = array("trans_type" => "withdraw", "amount" => $amount);
        $this->db->insert('transactions', $data_trans);
        $insert_id = $this->db->insert_id();

        $complete = 1;
        foreach($notes as $value => $count)
        {
            switch($value){
                case 20: $id = 1; break;
                case 50: $id = 2; break;
                default : $id = 0; break;
            }
            $current_count = $this->get_count($value);
            $note = array('note_id' => $id, 'value' => $value, 'count' => ($current_count-$count), 'trans_id' => $insert_id);
            $result  = $this->db->insert('available_notes', $note);
            if (!$result)
                $complete = 0;
        }
        return $complete;
    }
}

