document.addEventListener("DOMContentLoaded", function () {
	const sidebar = document.querySelector(".sidebar");
	const sidebarClose = document.querySelectorAll("#sidebar-icon, #sidebar-icon-hide");
	const menu = document.querySelector(".menu-content");
	const menuItems = document.querySelectorAll(".submenu-item");
	const subMenuTitles = document.querySelectorAll(".submenu .menu-title");

	// Initially hide the sidebar-icon-hide
	const svgIcon = document.querySelector("#sidebar-icon-hide");
	svgIcon.classList.add("hidden");

	sidebarClose.forEach((icon) => {
		icon.addEventListener("click", () => {
			sidebar.classList.toggle("close");
			toggleSidebarIconVisibility(); // Call function to toggle visibility of SVG icon
			if (sidebar.classList.contains("close")) {
				// If sidebar is closed, remove show-submenu class from all submenu items
				menuItems.forEach((item) => {
					item.classList.remove("show-submenu");
				});
			}
		});
	});

	menuItems.forEach((item, index) => {
		item.addEventListener("click", () => {
			menu.classList.add("submenu-active");
			item.classList.add("show-submenu");
			menuItems.forEach((item2, index2) => {
				if (index !== index2) {
					item2.classList.remove("show-submenu");
				}
			});
		});
	});

	subMenuTitles.forEach((title) => {
		title.addEventListener("click", () => {
			menu.classList.remove("submenu-active");
		});
	});

	function toggleSidebarIconVisibility() {
		const svgIcon = document.querySelector("#sidebar-icon-hide");
		svgIcon.classList.toggle("hidden");
	}
});

/// for account drop down
document.getElementById("dropdown-icon").addEventListener("click", toggleAccount, false);

function toggleAccount(event) {
	var dropdownMenu = document.getElementById("dropdownMenu");
	dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
	event.stopPropagation();
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function (event) {
	var dropdownMenu = document.getElementById("dropdownMenu");
	if (!event.target.matches(".dropdown-icon") && dropdownMenu.style.display === "block") {
		dropdownMenu.style.display = "none";
	}
};

function showImportant(event) {
	event.preventDefault(); // Prevent default anchor behavior
	var importantSection = document.getElementById("important");
	var isVisible = importantSection.style.display === "block";
	importantSection.style.display = isVisible ? "none" : "block";
}

document.addEventListener("DOMContentLoaded", function () {
	const taskDetailsModalElement = document.getElementById("taskDetailsModal");
	const editTaskModalElement = document.getElementById("editTaskModal");
	const confirmDeleteModalElement = document.getElementById("confirmDeleteModal");

	const taskDetailsModal = new bootstrap.Modal(taskDetailsModalElement);
	const editTaskModal = new bootstrap.Modal(editTaskModalElement);
	const confirmDeleteModal = new bootstrap.Modal(confirmDeleteModalElement);

	const tasks = document.querySelectorAll(".task");

	// Event listener for each task to open the details modal
	tasks.forEach(function (task) {
		// Event listener for task click to open task details modal
		task.addEventListener("click", function () {
			const title = task.querySelector(".task-title").innerText;
			const description = task.querySelector(".task-description").innerText;

			document.getElementById("modalTaskTitle").innerText = title;
			document.getElementById("modalTaskDescription").innerText = description;

			taskDetailsModal.show();
		});
	});

	const editTaskForm = document.getElementById("editTaskForm");

	// Function to handle editing task
	window.editTask = function (taskId) {
		const task = tasks.find((task) => task.dataset.taskId === taskId);

		const title = task.querySelector(".task-title").innerText;
		const description = task.querySelector(".task-description").innerText;

		document.getElementById("editTaskId").value = taskId;
		document.getElementById("editTaskTitle").value = title;
		document.getElementById("editTaskDescription").value = description;

		editTaskModal.show();
	};

	// Ensure the modal backdrop is removed when other modals are hidden
	editTaskModalElement.addEventListener("hidden.bs.modal", function () {
		document.querySelectorAll(".modal-backdrop").forEach((el) => el.remove());
		document.body.classList.remove("modal-open");
		document.body.style.paddingRight = "";
	});

	// Function to print task details
	window.printTaskDetails = function () {
		window.print();
	};

	// Function to handle deleting task
	window.deleteTask = function (taskId) {
		const task = tasks.find((task) => task.dataset.taskId === taskId);

		confirmDeleteBtn.onclick = function () {
			task.remove();
			confirmDeleteModal.hide();
		};

		confirmDeleteModal.show();
	};

	// Ensure the modal backdrop is removed when other modals are hidden
	confirmDeleteModalElement.addEventListener("hidden.bs.modal", function () {
		document.querySelectorAll(".modal-backdrop").forEach((el) => el.remove());
		document.body.classList.remove("modal-open");
		document.body.style.paddingRight = "";
	});


	confirmDeleteModalElement.addEventListener("hidden.bs.modal", function () {
		document.querySelectorAll(".modal-backdrop").forEach((el) => el.remove());
		document.body.classList.remove("modal-open");
		document.body.style.paddingRight = "";
	});
});

function toggleAccount(event) {
	const dropdownMenu = document.getElementById("dropdownMenu");
	dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
	event.stopPropagation();
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function (event) {
	const dropdownMenu = document.getElementById("dropdownMenu");
	if (!event.target.matches(".dropdown-icon") && dropdownMenu.style.display === "block") {
		dropdownMenu.style.display = "none";
	}
};

function showImportant(event) {
	event.preventDefault(); // Prevent default anchor behavior
	const importantSection = document.getElementById("important");
	const isVisible = importantSection.style.display === "block";
	importantSection.style.display = isVisible ? "none" : "block";
}

document.addEventListener("DOMContentLoaded", function () {
	const tasks = document.querySelectorAll(".task");

	// Event listener for each task to open the details modal
	tasks.forEach(function (task) {
		const checkbox = task.querySelector(".task-checkbox");

		// Event listener for the checkbox to toggle strike-through style
		checkbox.addEventListener("change", function () {
			const title = task.querySelector(".task-title");
			const description = task.querySelector(".task-description");

			if (checkbox.checked) {
				// If checked, apply strike-through style
				title.style.textDecoration = "line-through";
				description.style.textDecoration = "line-through";
			} else {
				// If unchecked, remove strike-through style
				title.style.textDecoration = "none";
				description.style.textDecoration = "none";
			}
		});

		// Prevent showing task details when checkbox is clicked
		checkbox.addEventListener("click", function (event) {
			event.stopPropagation(); // Prevent task click event from firing
		});
	});
});

  function setTaskId(taskId) {
		document.getElementById("task_id").value = taskId;
	}

	  // Function to set task ID and current values before editing
  function setEditTaskValues(taskId, title, description) {
    document.getElementById('editTaskId').value = taskId;
    document.getElementById('editTaskTitle').value = title;
    document.getElementById('editTaskDescription').value = description;
  }
//   function printPage() {
// 		window.print();
// 	}

function printPage() {
	// Hide the dropdown menu
	var dropdownMenu = document.getElementById("dropdownMenu");
	if (dropdownMenu) {
		dropdownMenu.style.display = "none";
	}

	// Trigger the print functionality
	window.print();

	// Restore the dropdown menu after printing
	if (dropdownMenu) {
		dropdownMenu.style.display = "block";
	}
}

// Add event listener to the print button
document.getElementById("printButton").addEventListener("click", printPage);

// Kapag itinutok ang cursor sa task-container, ipakita ang task-options
document.querySelectorAll('.task-container').forEach(taskContainer => {
  taskContainer.addEventListener('mouseenter', () => {
    taskContainer.querySelector('.task-options').style.display = 'flex';
  });

  taskContainer.addEventListener('mouseleave', () => {
    taskContainer.querySelector('.task-options').style.display = 'none';
  });
});

    function setTaskDetails(title, description) {
			document.getElementById("modalTaskTitle").textContent = title;
			document.getElementById("modalTaskDescription").textContent = description;
		}

let itemIdToDelete;

function getID(itemId) {
    itemIdToDelete = itemId;
}

document.getElementById('confirmDelete').addEventListener('click', function() {
	fetch(`task-delete.php?id=${itemIdToDelete}`, {
			method: 'DELETE'
	})
	.then(response => response.json())
	.then(data => {
			if (data.success) {
					alert('Item deleted successfully');
					closeModal();
					// Optionally, remove the item from the DOM or refresh the page
			} else {
					alert('Failed to delete item');
			}
	})
	.catch(error => console.error('Error:', error));
});
