<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Messages extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('table');
    }

    function index() {
        
    }

    function inbox() {
        $data['settings_view'] = 'inbox_v';

        $data['pm_count'] = $this->pm_count();
        $data['message_available'] = $this->getCheckForMessages();        
        $config["base_url"] = base_url() . "messages/inbox/";
        $config['total_rows'] = $this->getMessageCount();
        $config['per_page'] = 10;
        $config["num_links"] = 5;
        $config["full_tag_open"] = '<div id="pagination">';
        $config["full_tag_close"] = '</div>';
        $this->pagination->initialize($config);
        $data['messages'] = $this->getMessages($config['per_page'],$this->uri->segment(3));
        $data['links'] = $this->pagination->create_links();

        $this->base_params($data);
    }

    function compose() {
        $data['settings_view'] = 'compose_v';
        $data['pm_count'] = $this->pm_count();
        $this->base_params($data);
    }

    function view($message_id) {
        $data['settings_view'] = 'view_v';
        $data['pm_count'] = $this->pm_count();
        $data['messages_id'] = $this->view_message($message_id);
         $messages=  $this->checkForMessages();
        foreach ($messages as $message){
        $this->session->set_userdata('messages',$message->pm_count);
        }
        $this->base_params($data);
    }

    function view_message($message_id) {
        $this->db->where('id', $message_id);
        $query = $this->db->get('messages');
        $this->update_message($message_id);
        return $result = $query->result();
    }

    function update_message($message_id) {
        $data = array(
            'recieved' => '1'
        );
        $this->db->where('id', $message_id);
        $this->db->update('messages', $data);
    }

    function delete_message() {
        $pmcount = $this->pm_count();
        $pm_count = $pmcount[0]->pm_count;
        $new_pm_count = $pm_count - '1';
        $user_id = $this->session->userdata('user_name');
        foreach ($this->input->post('pms') as $num => $pm_id) {

            $this->db->where('id', $pm_id);
            $this->db->where('reciever', $user_id);
            $this->db->delete('messages');

            $data = array(
                'pm_count' => $new_pm_count
            );
            $this->db->where('id', $user_id);
            $this->db->update('user', $data);
             $messages=  $this->checkForMessages();
        foreach ($messages as $message){
        $this->session->set_userdata('messages',$message->pm_count);
        }
            
        }
        redirect('messages/inbox/');
    }

    function pm_count() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('pm_count,username');
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');
        $result = $query->result();
        return $result;
    }
      function recievers_pm_count() {
         $pmcount = $this->pm_count();
        $username = $pmcount[0]->username;  
        $this->db->select('pm_count');
        $this->db->where('username', $username);
        $query = $this->db->get('user');
        return $result = $query->result();
       // print_r($result);
       
    }

    function getCheckForMessages() {
         $pmcount = $this->pm_count();
        $username = $pmcount[0]->username;      
        $this->db->where('reciever', $username);
        $query = $this->db->get('messages');
        return $result = $query->num_rows();
        
    }

    function getMessageCount() {
        $username=$this->session->userdata['username'];
        $this->db->where('reciever', $username);
        $count = $this->db->count_all('messages');
        return $count;
    }

    function getMessages($limit, $start) {
       
       // $user_id = $this->pm_count();
       // $username=$user_id[0]->username;
        
       $username=$this->session->userdata['username'];
        
       // $this->load->database();
       // //$query=$this->db->query("select * from messages where reciever='$username'");
       // return $results=$query->result();
         
        $this->db->where('reciever', $username);
        $this->db->limit($limit, $start);
        $query = $this->db->get('messages');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
         
         
    }

    function checkUserExistsThenSendorError() {
        $user_is = $this->input->post('username');
        $this->db->select('username');
        $this->db->where('username', $user_is);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return '1';
        } else {
            return '0';
        }
    }

    function send() {
        if ($this->checkUserExistsThenSendorError() == '1') {
            $message_pm_count=  $this->recievers_pm_count();
            $pm_count1=$message_pm_count[0]->pm_count;
            $pm_count=$pm_count1+1;
            $user = $this->pm_count();
            $sender=$user[0]->username;

            $username = $this->input->post('username');
            $subject = $this->input->post('subject');
            $body = $this->input->post('message');

            if ($pm_count1 == '1000') {
                echo 'users inbox is full, try some other time';
            } else {
                $data = array(
                    'reciever' => $username,
                    'sender' => $sender,
                    'subject' => $subject,
                    'message' => $body
                );
                $this->db->insert('messages', $data);

                $pm_count_update = array(
                    'pm_count' => $pm_count
                );
                $this->db->where('username', $username);
                $this->db->update('user', $pm_count_update);
                $this->updateTable();
                echo 'Private message successfully sent';                
            }
        } else {
            echo 'That recipient does not exist';
        }
    }
    
    function updateTable(){     
       
        $this->db->where('labref', $this->uri->segment(3));
        $this->db->where('test_subject',$this->session->userdata('module'));
        $this->db->update('tests_done',array('approval_status'=>'2'));
    }
    
    
    	function GetRecipients($options=array())
    {
        $this->db ->distinct();
        $this->db->select('username');
        $this->db->like('username', $options['username'], 'after');
        $query = $this->db->get('user');
        return $query->result();

    }
        
        
    function recipients()
{
    
    $term = $this->input->post('term',TRUE);

    $rows = $this->GetRecipients(array('username' => $term));

    $keywords = array();
    foreach ($rows as $row)
         array_push($keywords, $row->username);

    echo json_encode($keywords);
	
	
}
   function checkForMessages(){
        $user_id=  $this->session->userdata('user_id');
        $this->db->select('pm_count');
        $this->db->where('id',$user_id);
        $query=  $this->db->get('user');
       return  $result=$query->result();
       // print_r($result);
    }

    public function base_params($data) {
        $data['title'] = "Messages";
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['quick_link'] = "request";
        $data['content_view'] = "settings_v";
        $data['banner_text'] = "NQCL Settings";
        $data['link'] = "settings_management";

        $this->load->view('template', $data);
    }

}

?>
