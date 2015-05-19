<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autocomplete extends CI_Controller {

	function index()
	{
		$this->load->view('autocomplete_view');
	}

            
    function GetAutocomplete($options=array())
    {
   $this->db->select('countries');
	    $this->db->like('countries', $options['countries'], 'after');
   		$query = $this->db->get('countries');
		return $query->result();

    }
        
        
	function suggestions()
{
	
	$term = $this->input->post('term',TRUE);

	$rows = $this->GetAutocomplete(array('countries' => $term));

	$keywords = array();
	foreach ($rows as $row)
		 array_push($keywords, $row->countries);

	echo json_encode($keywords);
}
}

/* End of file autocomplete.php */
/* Location: ./application/controllers/autocomplete.php */