<?php

class Ajax extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        //Sadece AJAX işlemi için kullanılmasını sağlıyoruz..
        if ( false == $this->input->is_ajax_request() )
        {
            log_message('error', 'Geçersiz Ajax Erişimi : '. date('d-m-Y H:i:s').' tarihinde '. $this->input->ip_address() .' adresinden gerçekleşti');
            die('Yetkisiz İşlem');
        }
    }

    public function get_ilceler()
    {
        //ajaxta post ile gelen il id'si
        $il_id = $this->input->post('il_id');

        if ( empty($il_id) )
        {
            $data = array('status' => 'error', 'message' => 'İl ID Bilgisi Alınamadı..!');
        }
        else
        {
            //ile göre ilçeler çekiliyor...
            $ilceler = $this->db->get_where('ilceler', array('il_id' => $il_id));

            if ( $ilceler->num_rows() > 0 )
            {
                $ilceList = array();
                foreach ($ilceler->result() as $item) {
                    $ilceList[] = array('id' => $item->id, 'ilce' => $item->ilce);
                }

                //var olan iller data keyine aktarılıyor...
                $data = array('status' => 'ok', 'message' => '', 'data' => $ilceList);

            }
            else
            {
                $data = array('status' => 'error', 'message' => 'İlçe Bulunamadı..!');
            }

        }

        //çıktıyı jsona uygun bir yapıda set ediyoruz...
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

}