<?php
class User_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_user($userId) {
  
        return $this->db->get_where('users', array('id' => $userId))->row_array();
    }

    public function get_all_users() {
        return $this->db->get('users')->result_array();
    }


    public function create_user($data) {
        // Insert a new user into the database
        $this->db->insert('users', $data);

        return $this->db->insert_id();
    }

    public function update_user($userId, $data) {
        // Update user data based on user ID
        $this->db->where('id', $userId);
        $this->db->update('users', $data);

        return $this->db->affected_rows();
    }

    public function delete_user($userId) {
        // Delete a user based on user ID
        $this->db->where('id', $userId);
        $this->db->delete('users');

        return $this->db->affected_rows();
    }


    public function get_usernames() {
        // Replace this with your actual database query to retrieve usernames
        $query = $this->db->select('*')->get('users');

        if ($query->num_rows() > 0) {
            $usernames = $query->result_array();
            return $usernames;
        }

        return [];
    }


}
