<?php
// namespace App\Models;
// use CodeIgniter\Model;

class Task_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function create_task($data) {
        $this->db->insert('tasks', $data);
    }


    public function get_tasks() {
        $this->db->select('tasks.*, users.username');
        $this->db->from('tasks');
        $this->db->join('users', 'tasks.user_id = users.id', 'inner');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_task_by_id($taskId) {
        $this->db->where('id', $taskId);
        $query = $this->db->get('tasks');

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }

        return false;
    }

    public function get_task($id) {
        return $this->db->get_where('tasks', array('id' => $id))->row_array();
    }

    public function update_task($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('tasks', $data);
    }

    public function delete_task($id) {
        $this->db->where('id', $id);
        $this->db->delete('tasks');
    }

    public function update_task_status($id, $status) {
        $data = array('status' => $status);
        $this->db->where('id', $id);
        $this->db->update('tasks', $data);
    }


}
