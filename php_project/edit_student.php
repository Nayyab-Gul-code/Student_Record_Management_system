<?php
include 'config.php';

$success = $error = "";

// Fetch student data for editing
if (isset($_GET['id'])) {

    $id = intval($_GET['id']);

    $result = mysqli_query($conn,
        "SELECT * FROM students WHERE id = $id"
    );

    if (mysqli_num_rows($result) == 0) {

        echo "<script>
                alert('Student not found!');
                window.location='index.php';
              </script>";

        exit();
    }

    $student = mysqli_fetch_assoc($result);

} else {

    header("Location: index.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id         = intval($_POST['id']);

    $name       = trim(
                    mysqli_real_escape_string(
                        $conn,
                        $_POST['name']
                    )
                  );

    $email      = trim(
                    mysqli_real_escape_string(
                        $conn,
                        $_POST['email']
                    )
                  );

    $department = trim(
                    mysqli_real_escape_string(
                        $conn,
                        $_POST['department']
                    )
                  );

    if (empty($name) || empty($email) || empty($department)) {

        $error = "All fields are required!";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Please enter a valid email address!";

    } else {

        $sql = "UPDATE students
                SET
                    name='$name',
                    email='$email',
                    department='$department'
                WHERE id=$id";

        if (mysqli_query($conn, $sql)) {

            $success = "Student record updated successfully!";

            // Refresh data
            $result = mysqli_query(
                $conn,
                "SELECT * FROM students WHERE id = $id"
            );

            $student = mysqli_fetch_assoc($result);

        } else {

            $error = "Error updating record: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Student - SRMS</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    min-height:100vh;
    background: linear-gradient(to right,  #aac3d5, #a9eff3);
    display:flex;
    justify-content:center;
    align-items:center;
    padding:30px;
}

.container{
    width:100%;
    max-width:650px;
}

.form-card{
    background:white;
    border-radius:24px;
    overflow:hidden;
    box-shadow:0 18px 40px rgba(0,0,0,0.2);
}

/* HEADER */

.form-header{
    background: linear-gradient(135deg, #f59e0b, #ea580c);
    padding:35px;
    text-align:center;
    color:white;
}

.form-header h2{
    font-size:32px;
    margin-bottom:10px;
}

.form-header p{
    font-size:15px;
    opacity:0.9;
}

/* FORM BODY */

.form-body{
    padding:35px;
}

.student-id{
    background:#fff7ed;
    color:#c2410c;
    padding:12px;
    border-radius:12px;
    text-align:center;
    font-weight:600;
    margin-bottom:25px;
}

.input-group{
    margin-bottom:22px;
}

label{
    display:block;
    margin-bottom:8px;
    color:#334155;
    font-weight:600;
}

input,
select{
    width:100%;
    padding:14px 16px;
    border:2px solid #e2e8f0;
    border-radius:12px;
    font-size:15px;
    background:#f8fafc;
    transition:0.3s;
}

input:focus,
select:focus{
    border-color:#f59e0b;
    background:white;
    outline:none;
    box-shadow:0 0 10px rgba(245,158,11,0.2);
}

/* BUTTON */

.btn-submit{
    width:100%;
    padding:15px;
    border:none;
    border-radius:12px;
    background: linear-gradient(to right, #f59e0b, #ea580c);
    color:white;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}

.btn-submit:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 20px rgba(234,88,12,0.25);
}

/* ALERTS */

.success{
    background:#dcfce7;
    color:#166534;
    padding:14px;
    border-radius:10px;
    margin-bottom:20px;
    font-weight:500;
}

.error{
    background:#fee2e2;
    color:#991b1b;
    padding:14px;
    border-radius:10px;
    margin-bottom:20px;
    font-weight:500;
}

/* BACK BUTTON */

.back-btn{
    display:block;
    text-align:center;
    margin-top:20px;
    text-decoration:none;
    color:#ea580c;
    font-weight:600;
    transition:0.3s;
}

.back-btn:hover{
    color:#c2410c;
}
/* HEADER */

.form-header{
    background: linear-gradient(135deg, #1e3c72, #2563eb);
    padding:35px;
    text-align:center;
    color:white;
}

/* STUDENT ID BOX */

.student-id{
    background:#dbeafe;
    color:#1d4ed8;
    padding:12px;
    border-radius:12px;
    text-align:center;
    font-weight:600;
    margin-bottom:25px;
}

/* INPUT FOCUS */

input:focus,
select:focus{
    border-color:#2563eb;
    background:white;
    outline:none;
    box-shadow:0 0 10px rgba(37,99,235,0.2);
}

/* SUBMIT BUTTON */

.btn-submit{
    width:100%;
    padding:15px;
    border:none;
    border-radius:12px;
    background: linear-gradient(to right, #2563eb, #1d4ed8);
    color:white;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}

.btn-submit:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 20px rgba(37,99,235,0.25);
}

/* BACK BUTTON */

.back-btn{
    display:block;
    text-align:center;
    margin-top:20px;
    text-decoration:none;
    color:#2563eb;
    font-weight:600;
    transition:0.3s;
}

.back-btn:hover{
    color:#1e40af;
}

/* RESPONSIVE */

@media(max-width:600px){

    .form-header h2{
        font-size:26px;
    }

    .form-body{
        padding:25px;
    }

}

</style>

</head>

<body>

<div class="container">

    <div class="form-card">

        <!-- HEADER -->

        <div class="form-header">

            <h2>✏️ Edit Student Record</h2>

            <p>
                Update student information easily
            </p>

        </div>

        <!-- FORM -->

        <div class="form-body">

            <div class="student-id">
                Editing Student ID :
                <strong>
                    #<?php echo $student['id']; ?>
                </strong>
            </div>

            <?php if($success): ?>

                <div class="success">
                    ✅ <?php echo $success; ?>
                </div>

            <?php endif; ?>

            <?php if($error): ?>

                <div class="error">
                    ❌ <?php echo $error; ?>
                </div>

            <?php endif; ?>

            <form method="POST" action="edit_student.php">

                <input type="hidden"
                       name="id"
                       value="<?php echo $student['id']; ?>">

                <!-- NAME -->

                <div class="input-group">

                    <label for="name">
                        Student Name
                    </label>

                    <input type="text"
                           id="name"
                           name="name"
                           value="<?php echo htmlspecialchars($student['name']); ?>"
                           required>

                </div>

                <!-- EMAIL -->

                <div class="input-group">

                    <label for="email">
                        Email Address
                    </label>

                    <input type="email"
                           id="email"
                           name="email"
                           value="<?php echo htmlspecialchars($student['email']); ?>"
                           required>

                </div>

                <!-- DEPARTMENT -->

                <div class="input-group">

                    <label for="department">
                        Department
                    </label>

                    <select id="department"
                            name="department"
                            required>

                        <option value="">
                            -- Select Department --
                        </option>

                        <?php

                        $departments = [
                            'Computer Science',
                            'Software Engineering',
                            'Information Technology',
                            'Electrical Engineering',
                            'Business Administration',
                            'Mathematics'
                        ];

                        foreach ($departments as $dept) {

                            $selected =
                                ($student['department'] == $dept)
                                ? 'selected'
                                : '';

                            echo "
                                <option value='$dept' $selected>
                                    $dept
                                </option>
                            ";
                        }

                        ?>

                    </select>

                </div>

                <!-- BUTTON -->

                <button type="submit" class="btn-submit">
                    🔄 Update Student Record
                </button>

            </form>

            <a href="index.php" class="back-btn">
                ← Back to All Students
            </a>

        </div>

    </div>

</div>

</body>
</html>

<?php mysqli_close($conn); ?>