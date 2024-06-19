<?php

require_once 'Task.php'; // Import Tasks.php para magamit ang Task class
include 'session.php'; // Import ng session.php file
include 'dashboard-great-date.php';
include 'dashboard-admin-menu.php';

// Pag-check kung ang user ay naka-login sa isang page
ensure_admin();

// Create GreatDate instance and generate greeting and formatted date
$date = new GreatDate();
$greeting = $date->getGreeting();
$formattedDate = date('l, F j, Y');
$currentRole = getCurrentUserRole();

// Instantiate the AdminMenu class with the current user's role


// Gumawa ng Task object
$taskObj = new Task();
// Kumuhang lahat ng mga tasks mula sa database
$tasks = $taskObj->getTasks();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Motivea - User Side Test 2</title>
  <link rel="stylesheet" href="dashboard-test.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
  <nav class="sidebar">
    <a href="#" class="logo">Motivea</a>
    <svg id="sidebar-icon" onclick="toggleSidebar()" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
      <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
      <path d="M9 4l0 16" />
    </svg>
    <div class="menu-content">
      <div class="profile">
        <a href="image.png">
          <img src="image.png" class="rounded">
        </a>
        <span class="username"> <?php echo htmlspecialchars($username); ?>!</span>
        <svg onclick="toggleAccount(event)" class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
          <polyline points="6 9 12 15 18 9" />
        </svg>
        <div class="dropdown-menu" id="dropdownMenu">
          <a href="#acc-settings">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="15" height="15" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
              <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
              <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
            </svg>
            Account Settings
          </a>

          <a href="#act-log">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-activity" width="15" height="15" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
              <path d="M3 12h4l3 8l4 -16l3 8h4" />
            </svg>
            Activity log
          </a>

          <a href="#Print" id="printButton" onclick="printPage">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="15" height="15" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
              <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
              <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
              <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
            </svg>
            Print
          </a>

          <a href="dashboard-test-logOut.php" class="logout">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="15" height="15" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
              <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
              <path d="M9 12h12l-3 -3" />
              <path d="M18 15l3 -3" />
            </svg>  
            Logout
          </a>

          

          <div class="buttons-container">
            <button href="#version">v01</button>
            <button class="href">What's new?</button>
          </div>
        </div>
      </div>
      <ul class="menu-items">
        <li class="item myTask">
          <a href="#myTask">My Task</a>
        </li>
        <li class="item important">
          <a href="#important">Important</a>
        </li>
        <li class="item important">
            <?php 
            $adminMenu = new AdminMenu($currentRole);
            $menuHtml = $adminMenu->generateMenu();
            echo $menuHtml; ?>
        </li>

      </ul>
    </div>

  </nav>

  <main class="main">
    <svg id="sidebar-icon-hide" class="hidden" onclick="toggleSidebarMain()" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
      <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
      <path d="M9 4l0 16" />
    </svg>
    <div class="great-date">
      <div class="great-user">
        <?php echo $greeting?>, 
        <?php
          $currentRole = 1;
          if ($currentRole == 1) {
              echo "Admin";
          }
        ?>
        <?php echo $currentRole;?>!
      </div>
      <div class="today">Today, <?php echo $formattedDate?></div>

      <div class="dropdown"></div>
    </div>

    <div id="important" style="display: none">
      <h2>Important</h2>
      <p>This is the Important section.</p>
    </div>
    <div class="wrapper">
      <div class="column">
        <?php if (!empty($tasks)): ?> <!-- Check kung may mga tasks -->
          <!-- Loop para ipakita ang mga tasks mula sa database -->
        <?php foreach ($tasks as $task): ?>
            <div class="task-container">
                <div class="task">
                    <div class="task-content">
                        <input type="checkbox" class="task-checkbox" data-task-details="task-details-1">
                        <div>
                            <?php if(isset($task['title'])): ?>
                                <p class="task-title"><?php echo $task['title']; ?></p>
                            <?php endif; ?>
                            <?php if(isset($task['description'])): ?>
                                <p class="task-description"><?php echo $task['description']; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="task-options">
                        <i class="fa fa-edit" onclick="editTask(<?php echo $task['id']; ?>)" data-bs-toggle="modal" data-bs-target="#editTaskModal"></i>
                        <i class="far fa-calendar-alt" onclick="changeDueDate(<?php echo $task['id']; ?>)" data-bs-toggle="modal" data-bs-target="#dueDateModal"></i>
                        <i class="fa fa-trash" onclick="deleteTask(<?php echo $task['id']; ?>)" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"></i>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php else: ?>
          <!-- Kung walang tasks, ipakita ang mensahe na "No tasks available" -->
          <div id="noTasksMessage">No tasks available.</div>
        <?php endif; ?>
      </div>
    </div>
    <button class="addNewList" data-bs-toggle="modal" data-bs-target="#taskModal">+ Add New</button>
  </main>


  <!-- Task Details Modal -->
    <div class="modal fade" id="taskDetailsModal" tabindex="-1" aria-labelledby="taskDetailsModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="taskDetailsModalLabel">Task Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h4 id="modalTaskTitle"></h4>
            <p id="modalTaskDescription"></p>
            <button onclick="printTaskDetails()" class="btn btn-primary">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="15" height="15" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
              </svg> Print
            </button>
          </div>
        </div>
      </div>
    </div>

  <!-- Edit Task Modal -->
  <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" id="editTaskForm" action=""> 
            <input type="hidden" name="action" value="edit"> <!-- Action for editing task -->
            <input type="hidden" name="task_id" id="editTaskId"> <!-- Hidden input to store task ID -->
            <div class="mb-3">
              <label for="editTaskTitle" class="form-label">Title</label>
              <input type="text" class="form-control" id="editTaskTitle" name="title" required>
            </div>
            <div class="mb-3">
              <label for="editTaskDescription" class="form-label">Description</label>
              <textarea class="form-control" id="editTaskDescription" name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Confirm Delete Modal -->
  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this task?</p>
        </div>
        <div class="modal-footer">
          <form method="POST" action="">
            <input type="hidden" name="action" value="delete"> <!-- Action for deleting task -->
            <input type="hidden" name="task_id" id="task_id"> <!-- Hidden input to store task ID -->
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Task Modal -->
  <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="taskModalLabel">Add Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Task creation form -->
          <form method="POST" action="task-create.php" enctype="multipart/form-data"> <!--tasks.php?action=create--->
            <input type="hidden" name="action" value="create"> <!-- Action for creating task -->
            <div class="mb-3">
              <label for="taskTitle" class="form-label">Title</label>
              <input type="text" class="form-control" id="taskTitle" name="title" required>
            </div>
            <div class="mb-3">
              <label for="taskDescription" class="form-label">Description</label>
              <textarea class="form-control" id="taskDescription" name="description"></textarea>
            </div>
            <div class="mb-3">
              <label for="taskFile" class="form-label">Upload File</label>
              <input type="file" class="form-control" id="taskFile" name="file">
            </div>
            <button type="submit" class="btn btn-primary">Save Task</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="dashboard-test.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>