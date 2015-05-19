<?php

$sesssion= $this->session->userdata('user_id');


$this->db->select('fname,lname');
$this->db->where('id',$sesssion);
$query1=$this->db->get('user');
foreach($query1->result() as $value){
   $data[]=$value;
}
echo $value->fname;
echo $value->lname;
echo date('d-m-yy : H:i:s',time());
