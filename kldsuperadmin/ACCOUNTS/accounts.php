<?php
// Include the database connection files
require_once 'connect.php'; // Default connection for `accounts`
require_once 'connect2.php'; // Connection for `guidance`
require_once 'connect3.php'; // Connection for `publications`

// Fetch Admins
$query_admins = "SELECT id, username, password FROM accounts";
$stmt_admins = $pdo->prepare($query_admins);
$stmt_admins->execute();
$admins = $stmt_admins->fetchAll(PDO::FETCH_ASSOC);

// Fetch Guidance Employees
$query_guidance = "SELECT * FROM hms_db.tbl_employee";
$stmt_guidance = $pdo->prepare($query_guidance);
$stmt_guidance->execute();
$guidance_employees = $stmt_guidance->fetchAll(PDO::FETCH_ASSOC);

// Fetch Publications
$query_publications = "SELECT * FROM pub_db.users";
$stmt_publications = $pdo->prepare($query_publications);
$stmt_publications->execute();
$publications = $stmt_publications->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Accounts Management</title>
    <style>
        /* Tab Styles */
        .tabs {
            display: flex;
            border-bottom: 2px solid #ccc;
            margin-bottom: 20px;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            font-weight: bold;
        }

        .tab:hover {
            background-color: #f1f1f1;
        }

        .active-tab {
            background-color: #007bff;
            color: white;
        }

        .tab-content {
            display: none;
        }

        .active-tab-content {
            display: block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .search-bar {
            margin-bottom: 10px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: 10px;
        }

        .update-btn {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        .update-btn:disabled {
            background-color: grey;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.all.min.js"></script>

<div class="tabs">
    <div class="tab active-tab" id="admins-tab" onclick="showTab('admins')">Admins</div>
    <div class="tab" id="guidance-tab" onclick="showTab('guidance')">Guidance Employees</div>
    <div class="tab" id="publications-tab" onclick="showTab('publications')">Publications</div>
</div>

<div id="admins" class="tab-content active-tab-content">
    <h3>Admins</h3>
    <input type="text" class="search-bar" id="search-admins" placeholder="Search Username or Password" onkeyup="filter1()">
    <table id="admins-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $admin): ?>
                <tr>
                    <td><?php echo htmlspecialchars($admin['id']); ?></td>
                    <td><?php echo htmlspecialchars($admin['username']); ?></td>
                    <td>**********</td>
                    <td><button onclick="openModal(<?php echo htmlspecialchars($admin['id']); ?>)">Change Password</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="guidance" class="tab-content">
    <h3>Guidance Employees</h3>
    <input type="text" class="search-bar" id="search-guidance" placeholder="Search First Name or Last Name" onkeyup="filter2()">
    <table id="guidance-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($guidance_employees as $employee): ?>
                <tr>
                    <td><?php echo htmlspecialchars($employee['id']); ?></td>
                    <td><?php echo htmlspecialchars($employee['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($employee['last_name']); ?></td>
                    <td><button onclick="openModal(<?php echo htmlspecialchars($employee['id']); ?>)">Change Password</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="publications" class="tab-content">
    <h3>Publications</h3>
    <input type="text" class="search-bar" id="search-publications" placeholder="Search First Name or Last Name" onkeyup="filter3()">
    <table id="publications-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($publications as $publication): ?>
                <tr>
                    <td><?php echo htmlspecialchars($publication['id']); ?></td>
                    <td><?php echo htmlspecialchars($publication['firstname']); ?></td>
                    <td><?php echo htmlspecialchars($publication['lastname']); ?></td>
                    <td><button onclick="openModal(<?php echo htmlspecialchars($publication['id']); ?>)">Change Password</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="passwordModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h4>Change Password</h4>
        <input type="password" id="newPassword" placeholder="New Password">
        <input type="password" id="confirmPassword" placeholder="Confirm Password">
        <div class="error" id="errorMessage"></div>
        <button id="updatePasswordButton" class="update-btn" disabled>Update Password</button>
    </div>
</div>

<script>
    let currentId = null;

    function showTab(tabName) {
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabs.forEach(tab => tab.classList.remove('active-tab'));
        tabContents.forEach(content => content.classList.remove('active-tab-content'));

        document.getElementById(tabName).classList.add('active-tab-content');
        document.getElementById(tabName + '-tab').classList.add('active-tab');
    }

    function filter1() {
        const searchInput = document.getElementById("search-admins");
        const filterText = searchInput.value.toLowerCase();
        const table = document.getElementById("admins-table");
        const rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName("td");
            let match = false;
            
            for (let j = 0; j < cells.length - 1; j++) {
                if (cells[j].textContent.toLowerCase().includes(filterText)) {
                    match = true;
                    break;
                }
            }

            if (match) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    function filter2() {
        const searchInput = document.getElementById("search-guidance");
        const filterText = searchInput.value.toLowerCase();
        const table = document.getElementById("guidance-table");
        const rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName("td");
            let match = false;
            
            for (let j = 0; j < cells.length - 1; j++) {
                if (cells[j].textContent.toLowerCase().includes(filterText)) {
                    match = true;
                    break;
                }
            }

            if (match) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    function filter3() {
        const searchInput = document.getElementById("search-publications");
        const filterText = searchInput.value.toLowerCase();
        const table = document.getElementById("publications-table");
        const rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName("td");
            let match = false;
            
            for (let j = 0; j < cells.length - 1; j++) {
                if (cells[j].textContent.toLowerCase().includes(filterText)) {
                    match = true;
                    break;
                }
            }

            if (match) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    function openModal(id) {
        currentId = id;
        document.getElementById("passwordModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("passwordModal").style.display = "none";
    }

    document.getElementById('newPassword').addEventListener('input', validatePasswords);
    document.getElementById('confirmPassword').addEventListener('input', validatePasswords);

    function validatePasswords() {
        const newPassword = document.getElementById('newPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const errorMessage = document.getElementById('errorMessage');
        const updateButton = document.getElementById('updatePasswordButton');
        
        if (newPassword !== confirmPassword) {
            errorMessage.textContent = 'Passwords do not match';
            updateButton.disabled = true;
        } else {
            errorMessage.textContent = '';
            updateButton.disabled = false;
        }
    }
</script>

</body>
</html>
