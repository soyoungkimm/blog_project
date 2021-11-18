<?php
    class Contact_m extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        public function add($data) { 
            $this->db->set('writeday', 'now()', false);
            $arr = array(
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'message' => $data['message']
            );
            $this->db->insert('contact', $arr);
        }

    }
?>