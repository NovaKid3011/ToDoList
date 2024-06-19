<?php
require_once 'User.php'; // Include the User class file
require_once 'config.php'; // Include the database connection file

// Create instance of Database class to get the connection
$database = new Database();
$conn = $database->getConnection();

$user_obj = new User($conn); // Create an instance of User class with database connection

// Process form submission to add user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate required fields
    if (isset($_POST['username'], $_POST['email'], $_POST['userRole'], $_POST['password'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['userRole'];
        $password = $_POST['password'];

        // Handle photo upload
        $photo_path = ''; // Default empty photo path
        if ($_FILES['userPhoto']['error'] === UPLOAD_ERR_OK) {
            $photo_tmp_name = $_FILES['userPhoto']['tmp_name'];
            $photo_name = $_FILES['userPhoto']['name'];
            $photo_path = 'uploads/' . $photo_name; // Example path; adjust as needed
            move_uploaded_file($photo_tmp_name, $photo_path);
        }

        // Map role names to numeric values if needed
        if ($role == 'Admin') {
            $roleValue = 1;
        } elseif ($role == 'User') {
            $roleValue = 0;
        } else {
            // Handle invalid role input
            echo "Invalid user role selected.";
            exit;
        }

        // Create user using createUser method from User class
        $user_obj->createUser($username, $email, $password, $roleValue, $photo_path);
    } else {
        echo "One or more required fields are missing.";
    }
}
?>

<!-- Rest of your HTML/PHP code remains unchanged -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin User Management</title>
    <link rel="stylesheet" href="dashboard-test.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }
        .btn-group .btn {
            margin-right: 5px;
        }
        .description-btn {
            text-decoration: none;
        }
        .description-btn:hover {
            text-decoration: underline;
        }
        .profile-photo {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Admin User Management</h2>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Photo</th>
                <th>Role</th>
                <th>Created at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
        // Fetch users from database
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>";
        if (isset($row['id'])) {
            echo "<td><a href='#' class='description-btn' data-bs-toggle='modal' data-bs-target='#viewUserModal' data-id='" . $row['id'] . "'>" . $row['username'] . "</a></td>";
        } else {
            echo "<td>ID not found</td>";
        }

                echo "</td>";
                echo "<td><a href='#' class='description-btn' data-bs-toggle='modal' data-bs-target='#viewUserModal' data-id='" . $row['id'] . "'>" . $row['username'] . "</a></td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td><img src='" . $row['photo'] . "' alt='Profile Photo' class='profile-photo'></td>";
                echo "<td>" . ($row['role'] == 1 ? 'Admin' : 'User') . "</td>"; // Display role as Admin or User
                echo "<td>" . $row['created_at'] . "</td>";
                echo "<td>";
                echo "<button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editUserModal' data-id='" . $row['id'] . "' data-username='" . $row['username'] . "' data-email='" . $row['email'] . "' data-role='" . $row['role'] . "'>Edit</button> ";
                echo "<a href='delete_user.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No users found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="admin-users.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Username</label>
                        <input type="text" class="form-control" id="userName" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="userEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="userPhoto" class="form-label">Photo</label>
                        <input type="file" class="form-control" id="userPhoto" name="userPhoto" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="userRole" class="form-label">User Role</label>
                        <select class="form-control" id="userRole" name="userRole" required>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="userPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="userPassword" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save User</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="user-update.php" enctype="multipart/form-data">
                    <input type="hidden" id="editUserId" name="userId">
                    <div class="mb-3">
                        <label for="editUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="editUsername" name="username" required>
                    </div>
            <div class="mb-3">
                <label for="editUserEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="editUserEmail" name="email" required>
            </div>
            <div class="mb-3">
                <label for="editUserPhoto" class="form-label">Photo</label>
                    <input type="file" class="form-control" id="editUserPhoto" name="userPhoto" accept="image/*">
            </div>
            <div class="mb-3">
                <label for="editUserRole" class="form-label">User Role</label>
                    <select class="form-control" id="editUserRole" name="userRole" required>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
            </div>
            <div class="mb-3">
            <label for="editUserPassword" class="form-label">Password (leave blank to keep current password)</label>
                <input type="password" class="form-control" id="editUserPassword" name="password">
            </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>

</div>
<!-- View User Modal -->
<div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewUserModalLabel">View User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                // Sample user details
                $userId = $row['id'];
                $username = $row['username'];
                $email = $row['email'];
                $photo = $row['photo'];
                $role = $row['role'];
                $created_at = $row['created_at'];
                ?>
                <!-- User details here -->
                <h4><?php echo $username; ?></h4>
                <p>Email: <?php echo $email; ?></p>
                <h5>Photo</h5>
                <img src="<?php echo $photo; ?>" alt="Profile Photo" class="profile-photo">
                <p>User Role: <?php echo $role; ?></p>
                <p>Created at: <?php echo $created_at; ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="window.print()">Print</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
