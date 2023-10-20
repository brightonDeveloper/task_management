<?php include 'includes/header.php'; ?>
<div class="container">
    <h1>Users List</h1>
    <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#AddUser">Add User</button><br/><br/>

<table id="users" class="display" style="width:100%">
    <thead>
        <tr>
            <th>id</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Gender</th>
            <th>Date Created</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id']; ?></td>
                <td><?= $user['username']; ?></td>
                <td><?= $user['surname']; ?></td>
                <td><?= $user['gender']; ?></td>
                <td><?= $user['date_created']; ?></td>
                <td>
                    <a href="javascript:void(0)" class="btn btn-danger delete-button" data-user-id="<?= $user['id'] ?>" style="margin-bottom:8px"><span class="glyphicon glyphicon-trash"></span></a>
                    <a href="javascript:void(0)" class="btn btn-warning edit-button" data-user-id="<?= $user['id'] ?>" style="margin-bottom:8px"><span class="glyphicon glyphicon-pencil"></span></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="AddUser" tabindex="-1" role="dialog" aria-labelledby="AddUserModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddUserModalCenterTitle">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="post">
            <div class="form-group">
                <label for="userName">Name:</label>
                <input type="text" class="form-control" id="userName" name="userName" required>
                <div class="text-danger" id="userNameError"></div>
            </div>

            <div class="form-group">
                <label for="userSurname">Surname:</label>
                <input type="text" class="form-control" id="userSurname" name="userSurname" required>
                <div class="text-danger" id="userSurnameError"></div>
            </div>

            <div class="form-group">
                <label for="userGender">Gender:</label>
                <select class="form-control" id="userGender" name="userGender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <div class="text-danger" id="userGenderError"></div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save_user">Save changes</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="EditUser" tabindex="-1" role="dialog" aria-labelledby="EditUserModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditUserModalCenterTitle">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="post">
            <div class="form-group">
                <label for="edituserName">Name:</label>
                <input type="text" class="form-control" id="edituserName" name="userName" required>
                <input type="hidden" class="form-control" id="user_id" name="user_id" required>
                <div class="text-danger" id="userNameError"></div>
            </div>

            <div class="form-group">
                <label for="eituserSurname">Surname:</label>
                <input type="text" class="form-control" id="eituserSurname" name="userSurname" required>
                <div class="text-danger" id="userSurnameError"></div>
            </div>

            <div class="form-group">
                <label for="edituserGender">Gender:</label>
                <select class="form-control" id="edituserGender" name="userGender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <div class="text-danger" id="userGenderError"></div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary update_user">Save changes</button>
      </div>
    </div>
  </div>
</div>




<script>
$(document).ready(function() {
    $('#users').DataTable();

        $(".save_user").click(function() {
            // Reset previous error messages
            $(".text-danger").html("");

            // Get user input from the modal fields
            var name = $("#userName").val();
            var surname = $("#userSurname").val();
            var gender = $("#userGender").val();

            // Client-side validation
            if (name.trim() === "") {
                $("#userNameError").html("Name is required.");
                return;
            }
            if (surname.trim() === "") {
                $("#userSurnameError").html("Surname is required.");
                return;
            }

            // Create a data object to send to the server
            var userData = {
                name: name,
                surname: surname,
                gender: gender
            };

            // Send the AJAX request to the CodeIgniter controller
            $.ajax({
                type: "POST",
                url: "user/create", // Adjust the URL to match your CodeIgniter controller
                data: userData,
                success: function(response) {
                    // Handle the response from the server (e.g., display success message)
                    alert("User added successfully!");
                    // Close the modal
                    $("#AddUser").modal("hide");
                    window.location.reload();
                    // You can also update the user list or perform any other actions here
                },
                error: function(xhr, status, error) {
                    // Handle errors (e.g., display an error message)
                    console.log("Error: " + error);
                }
            });
        });


    // $('#tasks').dataTable();
    $('.delete-button').on('click', function() {
        var userId = $(this).data('user-id'); // Get the task ID from the data attribute
        var confirmation = confirm("Are you sure you want to delete this user?");

        if (confirmation) {
            $.ajax({
                url: 'user/delete/' + userId,
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



    $('.edit-button').on('click', function() {
        var userId = $(this).data('user-id');
        
        // Fetch the task data using AJAX
        $.ajax({
            url: "user/get/" + userId, // Adjust the URL for your controller
            type: 'GET', // You can use POST or GET based on your implementation
            success: function(response) {
                console.log(response);
                // Display the modal
                $('#EditUser').modal('show');
                // Prepopulate the modal with the task data
                $('#user_id').val(userId);
                $('#edituserName').val(response.username);
                $('#eituserSurname').val(response.surname);
                $('#edituserGender').val(response.gender);
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log('Error: ' + textStatus);
            }
        });
    });



        // Handle the "Save changes" button in the EditUser modal
        $(".update_user").click(function() {
            // Reset previous error messages
            $(".text-danger").html("");

            // Get user input from the modal fields
            var name = $("#edituserName").val();
            var surname = $("#eituserSurname").val();
            var gender = $("#edituserGender").val();
            var userId = $("#user_id").val();

            // Client-side validation
            if (name.trim() === "") {
                $("#userNameError").html("Name is required.");
                return;
            }
            if (surname.trim() === "") {
                $("#userSurnameError").html("Surname is required.");
                return;
            }

            // Create a data object to send to the server
            var userData = {
                userId: userId,
                name: name,
                surname: surname,
                gender: gender
            };

            // Send the AJAX request to update the user
            $.ajax({
                type: "POST",
                url: "user/update", // Adjust the URL to match your CodeIgniter controller
                data: userData,
                success: function(response) {
                    // Handle the response from the server (e.g., display success message)
                    alert("User updated successfully!");
                    // Close the modal
                    $("#EditUser").modal("hide");
                    window.location.reload();
                    // You can also update the user list or perform any other actions here
                },
                error: function(xhr, status, error) {
                    // Handle errors (e.g., display an error message)
                    alert("Error: " + error);
                    console.log(error)
                }
            });
        });


});    
</script>
</div>