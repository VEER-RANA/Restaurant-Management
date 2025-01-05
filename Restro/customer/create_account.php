<?php
session_start();
include('config/config.php');

// Define variables and initialize with empty values
//$customer_name = $customer_phoneno = $customer_email = $customer_password = $err = $success = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addCustomer'])) {
    // Check if all fields are filled
    if (empty(trim($_POST["customer_phoneno"])) || empty(trim($_POST["customer_name"])) || empty(trim($_POST['customer_email'])) || empty($_POST['customer_password'])) {
        $err = "Blank Values Not Accepted";
    } else {
        // Retrieve form data
        $customer_name = trim($_POST['customer_name']);
        $customer_phoneno = trim($_POST['customer_phoneno']);
        $customer_email = trim($_POST['customer_email']);
        $customer_password = trim($_POST['customer_password']);
        
        // Validate customer name
        if (!preg_match("/^[a-zA-Z-' ]*$/", $customer_name)) {
            $err = "Only letters and spaces allowed in the name";    
        }
        // Validate phone number
        elseif (!preg_match("/^[0-9]*$/", $customer_phoneno)) {
            $err = "Only numeric values are allowed for phone number";
        } elseif (strlen($customer_phoneno) != 10) {
            $err = "Phone number must contain 10 digits";
        }
        // Validate email
        elseif (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
            $err = "Invalid email format";
        }
        // Validate password
        elseif (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()-_+=])[a-zA-Z0-9!@#$%^&*()-_+=]{5,10}$/", $customer_password)) {
            $err = "Password must be at least 5 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character";
        }
        
        $customer_id = $_POST['customer_id'];
        
        // If there are no validation errors, proceed with inserting data into the database
        if (empty($err)) {
            // Hash the password
            $customer_password = $customer_password; // Not recommended to use sha1 and md5 for password hashing, consider using bcrypt or Argon2
        
            // Insert into the database
            $postQuery = "INSERT INTO rpos_customers (customer_id, customer_name, customer_phoneno, customer_email, customer_password) VALUES (?, ?, ?, ?, ?)";
            $postStmt = $mysqli->prepare($postQuery);
            if ($postStmt) {
                // Bind parameters
                $postStmt->bind_param('sssss', $customer_id, $customer_name, $customer_phoneno, $customer_email, $customer_password);
                if ($postStmt->execute()) {
                    $success = "Customer Account Created";
                    header("refresh:1; url=index.php");
                } else {
                    $err = "Failed to insert data into the database";
                }
            } else {
                $err = "Failed to prepare statement";
            }
        }
    }
}
require_once('partials/_head.php');
require_once('config/code-generator.php');
?>






<body class="bg-dark">
    <div class="main-content">
        <div class="header bg-gradient-primar py-7">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6">
                            <h1 class="text-white">Restaurant Point Of Sale</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <form method="post" role="form">
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input class="form-control" required name="customer_name" placeholder="Full Name" type="text">
                                        <input class="form-control" value="<?php echo $cus_id;?>" required name="customer_id"  type="hidden">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input class="form-control" required name="customer_phoneno" placeholder="Phone Number" type="text">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control" required name="customer_email" placeholder="Email" type="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" required name="customer_password" placeholder="Password" type="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" required name="confirm_password" placeholder="confirm Password" type="password">
                                    </div>
                                </div>

                                <div class="text-center">
                                </div>
                                <div class="form-group">
                                    <div class="text-left">
                                        <button type="submit" name="addCustomer" class="btn btn-primary my-4">Create Account</button>
                                        <a href="index.php" class=" btn btn-success pull-right">Log In</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <!-- <a href="../admin/forgot_pwd.php" target="_blank" class="text-light"><small>Forgot password?</small></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php
    require_once('partials/_footer.php');
    ?>
    <!-- Argon Scripts -->
    <?php
    require_once('partials/_scripts.php');
    ?>
</body>

</html>