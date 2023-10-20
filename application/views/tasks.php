<?php include 'includes/header.php'; ?>
<div class="container">
    <h1>Task List</h1>
    <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#AddTask" onclick="get_usersnames()">Add Task</button><br/><br/>


<div class="form-group">
    <label for="filterByUser">Filter by User:</label>
    <select class="form-control" id="filterByUser">
        <option value="" selected>Select User</option>
    </select>
</div>
<table id="tasks" class="display" style="width:100%">
    <thead>
        <tr>
            <th>id</th>
            <th>Task Name</th>
            <th>Task Description</th>
            <th>Assigned User</th>
            <th>Task Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= $task['id']; ?></td>
                <td><?= $task['task_title']; ?></td>
                <td><?= $task['task_description']; ?></td>
                <td><?= $task['username']; ?></td>
                <td>
                    <?php if ($task['status'] == 'pending'): ?>
                        <p class="text text-warning" style="font-weight: bold" id="status-<?= $task['id'] ?>">Pending</p>
                    <?php else: ?>
                        <p class="text text-success" style="font-weight: bold" id="status-<?= $task['id'] ?>">Completed</p>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="javascript:void(0)" class="btn btn-danger delete-button" data-task-id="<?= $task['id'] ?>" style="margin-bottom:8px"><span class="glyphicon glyphicon-trash"></span></a>
                    <a href="javascript:void(0)" class="btn btn-warning edit-button" data-task-id="<?= $task['id'] ?>" style="margin-bottom:8px"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="javascript:void(0)"><button class="btn btn-success mr-2 mb-2 complete-button" data-task-id="<?= $task['id'] ?>" style="margin-bottom:8px">Complete</button></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

   
</div>

<!-- Modal -->
<div class="modal fade" id="AddTask" tabindex="-1" role="dialog" aria-labelledby="AddTaskModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddTaskModalCenterTitle">Add Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="post">
            <div class="form-group">
                <label for="taskName">Task Name</label>
                <input type="text" class="form-control" id="taskname">
            </div>
            <div class="form-group">
                <label for="taskDescription">Tast Description:</label>
                <input type="text" class="form-control" id="taskDescription">
            </div>
            <div class="form-group">
                <label for="taskDescription">Tast Status:</label>
                <select class="form-control" id="taskStatus">
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            <div class="form-group">
                <label for="taskUsers">Assign Task to User:</label>
                <select class="form-control" id="taskUsers">
                    <option value="" selected disabled>Select User</option>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save_task">Save changes</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="EditTask" tabindex="-1" role="dialog" aria-labelledby="EditTaskModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditTaskModalCenterTitle">Edit Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="post">
            <div class="form-group">
                <label for="taskName">Task Name</label>
                <input type="text" class="form-control" id="updatetaskname">
                <input type="hidden" class="form-control" id="task_id">
            </div>
            <div class="form-group">
                <label for="taskDescription">Tast Description:</label>
                <input type="text" class="form-control" id="updatetaskDescription">
            </div>
            <div class="form-group">
                <label for="taskDescription">Tast Status:</label>
                <select class="form-control" id="updatetaskStatus">
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary update_task">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {

  $('#tasks').DataTable();
  
  $('.save_task').click(function() {
        var taskName = $('#taskname').val();
        var taskDescription = $('#taskDescription').val();
        var taskStatus = $('#taskStatus').val();
        var user_id = $('#taskUsers').val();

        // Validate the form fields
        if (taskName === "" || taskDescription === "") {
            alert("Task Name and Task Description are required.");
            return;
        }

        // Send an AJAX request to the controller
        $.ajax({
            url: 'task/create',
            type: 'POST',
            data: {
                user_id: user_id,
                task_title: taskName,
                task_description: taskDescription,
                task_status: taskStatus
            },
            success: function(response) {
                // Handle the response from the server (e.g., close the modal or show a success message)
                $('#AddTask').modal('hide'); // Close the modal
                location.reload(); // Refresh the page to reflect the new task
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log('Error: ' + textStatus);
            }
        });
    });    


  $('.update_task').click(function() {
        var task_id = $('#task_id').val();
        var taskName = $('#updatetaskname').val();
        var taskDescription = $('#updatetaskDescription').val();
        var taskStatus = $('#updatetaskStatus').val();

        // Validate the form fields
        if (taskName === "" || taskDescription === "") {
            alert("Task Name and Task Description are required.");
            return;
        }

        // Send an AJAX request to the controller
        $.ajax({
            url: 'task/update',
            type: 'POST',
            data: {
                task_id: task_id,
                task_title: taskName,
                task_description: taskDescription,
                task_status: taskStatus
            },
            success: function(response) {
                // Handle the response from the server (e.g., close the modal or show a success message)
                $('#EditTask').modal('hide'); // Close the modal
                location.reload(); // Refresh the page to reflect the new task
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log('Error: ' + textStatus);
            }
        });
    });    



    $('.edit-button').on('click', function() {
        var taskId = $(this).data('task-id');

        // Fetch the task data using AJAX
        $.ajax({
            url: "task/get_task/" + taskId, // Adjust the URL for your controller
            type: 'GET', // You can use POST or GET based on your implementation
            success: function(response) {
                // Prepopulate the modal with the task data
                $('#task_id').val(taskId);
                $('#updatetaskname').val(response.task_title);
                $('#updatetaskDescription').val(response.task_description);
                $('#updatetaskStatus').val(response.status);

                // Display the modal
                $('#EditTask').modal('show');
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log('Error: ' + textStatus);
            }
        });
    });
    
    // $('#tasks').dataTable();
    $('.delete-button').on('click', function() {
        var taskId = $(this).data('task-id'); // Get the task ID from the data attribute
        var confirmation = confirm("Are you sure you want to delete this task?");

        if (confirmation) {
            $.ajax({
                url: 'task/delete/' + taskId,
                type: 'POST',
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log('Error: ' + textStatus);
                }
            });
        }
    });




    $('.complete-button').on('click', function() {
        var taskId = $(this).data('task-id');
    
        $.ajax({
            url: "task/update_status/" + taskId,
            type: 'POST',
            success: function(response) {
        
                var statusElement = $('#status-' + taskId);
                statusElement.text('Completed').removeClass('text-warning').addClass('text-success');
            
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log('Error: ' + textStatus);
            }
        });
    });



});


function get_usersnames(){
    // Send an AJAX request to retrieve usernames from the CodeIgniter controller
    $.ajax({
        type: "GET",
        url: "task/get_usernames", // Adjust the URL to match your controller route
        dataType: "json", // Ensure the response is parsed as JSON
        success: function(usernames) {
            var taskUsersSelect = $("#taskUsers");

            // Clear the existing options
            taskUsersSelect.empty();

            // Add a default option
            taskUsersSelect.append('<option value="" selected disabled>Select User</option>');

            // Loop through the usernames and create an option for each
            $.each(usernames, function(index, user) {
                taskUsersSelect.append('<option value="' + user.id + '">' + user.username + '</option>');
            });
        },
        error: function(xhr, status, error) {
            // Handle errors (e.g., display an error message)
            alert("Error: " + error);
        }
    });
}


$('#filterByUser').on('change', function() {
    $('#tasks').DataTable().search($(this).val()).draw();
});


function filter_by_user(){
    // Send an AJAX request to retrieve usernames from the CodeIgniter controller
    $.ajax({
        type: "GET",
        url: "task/get_usernames", // Adjust the URL to match your controller route
        dataType: "json", // Ensure the response is parsed as JSON
        success: function(usernames) {
            var taskUsersSelect = $("#filterByUser");

            // Clear the existing options
            taskUsersSelect.empty();

            // Add a default option
            taskUsersSelect.append('<option value="" selected>Select User</option>');

            // Loop through the usernames and create an option for each
            $.each(usernames, function(index, user) {
                taskUsersSelect.append('<option value="' + user.username + '">' + user.username + '</option>');
            });
        },
        error: function(xhr, status, error) {
            // Handle errors (e.g., display an error message)
            alert("Error: " + error);
        }
    });
}filter_by_user();
</script>
<?php include 'includes/footer.php'; ?>

