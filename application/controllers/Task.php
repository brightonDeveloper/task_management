<?php
// namespace App\Controllers;
// use App\Models\TaskModel;

class Task extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Task_model');
        $this->load->model('User_model');
    }

    public function index() {
        // Display a list of tasks
        $data['tasks'] = $this->Task_model->get_tasks();
        $this->load->view('tasks', $data);
        
    }

    public function create() {
        $task_title = $this->input->post('task_title');
        $task_description = $this->input->post('task_description');
        $task_status = $this->input->post('task_status');
        $user_id = $this->input->post('user_id');

        // Validation (you should define validation rules in your application)
        $this->form_validation->set_rules('task_title', 'Task Title', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('task_description', 'Task Description', 'required|min_length[3]|max_length[500]');
        $this->form_validation->set_rules('task_status', 'Task Status', 'required|in_list[pending,completed]');

        if ($this->form_validation->run() === FALSE) {
            // Validation failed, return an error response
            $errors = validation_errors();
            echo json_encode(['status' => 'error', 'message' => $errors]);
            return;
        }

        // Task data is valid, proceed with creating the task
        $data = [
            'user_id' => $user_id,
            'task_title' => $task_title,
            'task_description' => $task_description,
            'status' => $task_status,
        ];

        if ($this->Task_model->create_task($data)) {
            // Task creation successful
            echo json_encode(['status' => 'success', 'message' => 'Task created successfully']);
        } else {
            // Task creation failed
            echo json_encode(['status' => 'error', 'message' => 'Failed to create the task']);
        }
    }



    public function update() {
        $task_id = $this->input->post('task_id');
        $task_title = $this->input->post('task_title');
        $task_description = $this->input->post('task_description');
        $task_status = $this->input->post('task_status');

        // Validation (you should define validation rules in your application)
        $this->form_validation->set_rules('task_title', 'Task Title', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('task_description', 'Task Description', 'required|min_length[3]|max_length[500]');
        $this->form_validation->set_rules('task_status', 'Task Status', 'required|in_list[pending,completed]');

        if ($this->form_validation->run() === FALSE) {
            // Validation failed, return an error response
            $errors = validation_errors();
            echo json_encode(['status' => 'error', 'message' => $errors]);
            return;
        }

        // Task data is valid, proceed with creating the task
        $data = [
            'task_title' => $task_title,
            'task_description' => $task_description,
            'status' => $task_status,
        ];

        if ($this->Task_model->update_task($task_id, $data)) {
            // Task creation successful
            echo json_encode(['status' => 'success', 'message' => 'Task updated successfully']);
        } else {
            // Task creation failed
            echo json_encode(['status' => 'error', 'message' => 'Failed to update the task']);
        }
    }


    public function get_task($taskId) {
        $task = $this->Task_model->get_task($taskId);
        if ($task) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($task));
        } else {
            // Handle the case where the task is not found
            $this->output
                ->set_status_header(404)
                ->set_output(json_encode(['error' => 'Task not found']));
        }
    }
    
    public function edit($id) {
        // Edit a task
        $task = $this->Task_model->get_task($id);
        // Add your code to display and update the task in a view
    }

    public function delete($id) {
        // Delete a task
        $this->Task_model->delete_task($id);
    }


    public function update_status($id) {
        $this->Task_model->update_task_status($id, 'completed');
        // Redirect back to the task list or show a success message
    
    }


    public function get_usernames() {
        // Load the model (e.g., UserModel) to retrieve the usernames
        $this->load->model('User_model');
        
        // Get the usernames from the model
        $usernames = $this->User_model->get_usernames();

        // Return the usernames as JSON
        echo json_encode($usernames);
    }

}
