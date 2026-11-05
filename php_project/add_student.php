<?php
include 'config.php';

$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name       = trim(mysqli_real_escape_string($conn, $_POST['name']));
    $email      = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $department = trim(mysqli_real_escape_string($conn, $_POST['department']));

    if (empty($name) || empty($email) || empty($department)) {

        $error = "All fields are required!";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Please enter a valid email address!";

    } else {

        $sql = "INSERT INTO students (name, email, department)
                VALUES ('$name', '$email', '$department')";

        if (mysqli_query($conn, $sql)) {

            $success = "Student record added successfully!";

        } else {

            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Add Student - SRMS</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    min-height:100vh;
    background: linear-gradient(to right, #aac3d5, #a9eff3);
    display:flex;
    justify-content:center;
    align-items:center;
    padding:30px;
}

.container{
    width:100%;
    max-width:600px;
}

.form-card{
    background:#fff;
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 15px 40px rgba(0,0,0,0.2);
}

/* HEADER */

.form-header{
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    padding:30px;
    text-align:center;
    color:white;
}

.form-header h2{
    font-size:32px;
    margin-bottom:8px;
}

.form-header p{
    opacity:0.9;
    font-size:15px;
}

/* FORM */

.form-body{
    padding:35px;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
    color:#334155;
}

.input-group{
    margin-bottom:22px;
}

input,
select{
    width:100%;
    padding:14px 16px;
    border:2px solid #e2e8f0;
    border-radius:12px;
    font-size:15px;
    transition:0.3s;
    background:#f8fafc;
}

input:focus,
select:focus{
    border-color:#2563eb;
    background:white;
    outline:none;
    box-shadow:0 0 10px rgba(37,99,235,0.15);
}

/* BUTTON */

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
    box-shadow:0 8px 20px rgba(37,99,235,0.3);
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
    color:#2563eb;
    font-weight:600;
    transition:0.3s;
}

.back-btn:hover{
    color:#1d4ed8;
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

            <h2>➕ Add New Student</h2>

            <p>
                Fill the form below to add student information
            </p>

        </div>

        <!-- FORM -->

        <div class="form-body">

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

            <form method="POST" action="add_student.php">

                <div class="input-group">

                    <label for="name">
                        Student Name
                    </label>

                    <input type="text"
                           id="name"
                           name="name"
                           placeholder="Enter full student name"
                           required>

                </div>

                <div class="input-group">

                    <label for="email">
                        Email Address
                    </label>

                    <input type="email"
                           id="email"
                           name="email"
                           placeholder="Enter student email"
                           required>

                </div>

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

                        <option value="Computer Science">
                            Computer Science
                        </option>

                        <option value="Software Engineering">
                            Software Engineering
                        </option>

                        <option value="Information Technology">
                            Information Technology
                        </option>

                        <option value="Electrical Engineering">
                            Electrical Engineering
                        </option>

                        <option value="Business Administration">
                            Business Administration
                        </option>

                        <option value="Mathematics">
                            Mathematics
                        </option>

                    </select>

                </div>

                <button type="submit" class="btn-submit">
                    💾 Save Student Record
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