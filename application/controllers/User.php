<?php
class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }


    public function index() {
        // Display a list of tasks
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('users', $data);
        
    }

    public function create() {
        $data = array(
            'username' => $this->input->post('name'),
            'surname' => $this->input->post('surname'),
            'gender' => $this->input->post('gender'),
        );

        $userId = $this->User_model->create_user($data);
    }

    public function get_all_users() {
        $users = $this->User_model->get_all_users();
    }

    public function get($userId) {

        $user = $this->User_model->get_user($userId);
        if ($user) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($user));
        } else {
            // Handle the case where the task is not found
            $this->output
                ->set_status_header(404)
                ->set_output(json_encode(['error' => 'User not found']));
        }

    }

    public function update() {
        $userId = $this->input->post('userId');
        $data = array(
            'username' => $this->input->post('name'),
            'surname' => $this->input->post('surname'),
            'gender' => $this->input->post('gender')
        );
        $affectedRows = $this->User_model->update_user($userId, $data);
    }

    public function delete($userId) {
        $affectedRows = $this->User_model->delete_user($userId);

    }
}
