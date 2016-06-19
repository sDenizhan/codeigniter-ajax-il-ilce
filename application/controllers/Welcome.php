<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function index()
	{
		/**
		 * İller sorgulanıp View Dosyasına Gönderiliyor...
		 */
		$iller = $this->db->get('iller');
		
		if ( $iller->num_rows() > 0 )
		{
			$data['_iller'] = $iller->result();
		}
		else
		{
			$data['_iller'] = false;
		}
		
		$this->load->view('welcome_message', $data);
	}
}
