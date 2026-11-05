<?php
include 'config.php';

// Handle delete action
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql = "DELETE FROM students WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Student record deleted successfully!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Error deleting record!');</script>";
    }
}

// Fetch all students
$result = mysqli_query($conn, "SELECT * FROM students ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Student Record Management System</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    background: linear-gradient(to right, #aac3d5, #a9eff3);
    min-height:100vh;
    padding:40px 20px;
}

.container{
    max-width:1200px;
    margin:auto;
}

.main-card{
    background:#fff;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 15px 35px rgba(0,0,0,0.15);
}

/* HEADER */

.header{
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    color:white;
    padding:30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
}

.header h1{
    font-size:34px;
    margin-bottom:8px;
}

.header p{
    font-size:16px;
    opacity:0.9;
}

.add-btn{
    background:white;
    color:#1e3c72;
    text-decoration:none;
    padding:14px 22px;
    border-radius:12px;
    font-weight:600;
    transition:0.3s;
    box-shadow:0 4px 10px rgba(0,0,0,0.15);
}

.add-btn:hover{
    transform:translateY(-3px);
    background:#f1f5f9;
}

/* TABLE */

.table-section{
    padding:25px;
}

table{
    width:100%;
    border-collapse:collapse;
    overflow:hidden;
    border-radius:15px;
}

th{
    background:#0f172a;
    color:white;
    padding:18px;
    text-align:left;
    font-size:15px;
    letter-spacing:0.5px;
}

td{
    padding:18px;
    border-bottom:1px solid #e2e8f0;
    color:#334155;
    font-size:15px;
}

tr{
    transition:0.3s;
}

tr:hover{
    background:#f8fafc;
    transform:scale(1.002);
}

/* BADGES */

.badge{
    display:inline-block;
    padding:7px 14px;
    border-radius:30px;
    background:#dbeafe;
    color:#1d4ed8;
    font-weight:600;
    font-size:13px;
}

/* BUTTONS */

.actions{
    display:flex;
    gap:10px;
}

.btn{
    text-decoration:none;
    padding:10px 16px;
    border-radius:10px;
    font-size:14px;
    font-weight:600;
    transition:0.3s;
    display:inline-block;
}

.edit-btn{
    background:#facc15;
    color:#000;
}

.edit-btn:hover{
    background:#eab308;
}

.delete-btn{
    background:#ef4444;
    color:white;
}

.delete-btn:hover{
    background:#dc2626;
}

/* EMPTY DATA */

.no-data{
    text-align:center;
    padding:40px;
    font-size:18px;
    color:#64748b;
}

/* RESPONSIVE */

@media(max-width:768px){

    .header{
        flex-direction:column;
        gap:20px;
        text-align:center;
    }

    table{
        font-size:13px;
    }

    th, td{
        padding:12px;
    }

    .actions{
        flex-direction:column;
    }

}

</style>
</head>

<body>

<div class="container">

    <div class="main-card">

        <!-- HEADER -->

        <div class="header">

            <div>
                <h1>🎓 Student Management System</h1>
                <p>
                    Total Student Records :
                    <strong><?php echo mysqli_num_rows($result); ?></strong>
                </p>
            </div>

            <a href="add_student.php" class="add-btn">
                ➕ Add New Student
            </a>

        </div>

        <!-- TABLE -->

        <div class="table-section">

            <table>

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Email Address</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                <?php if(mysqli_num_rows($result) > 0): ?>

                    <?php $count = 1; while($row = mysqli_fetch_assoc($result)): ?>

                    <tr>

                        <td><?php echo $count++; ?></td>

                        <td>
                            <strong>
                                <?php echo htmlspecialchars($row['name']); ?>
                            </strong>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row['email']); ?>
                        </td>

                        <td>
                            <span class="badge">
                                <?php echo htmlspecialchars($row['department']); ?>
                            </span>
                        </td>

                        <td>

                            <div class="actions">

                                <a href="edit_student.php?id=<?php echo $row['id']; ?>"
                                   class="btn edit-btn">
                                   ✏ Edit
                                </a>

                                <a href="index.php?delete=<?php echo $row['id']; ?>"
                                   class="btn delete-btn"
                                   onclick="return confirm('Are you sure you want to delete this student?')">
                                   🗑 Delete
                                </a>

                            </div>

                        </td>

                    </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="5" class="no-data">
                            No student records found!
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>

<?php mysqli_close($conn); ?>