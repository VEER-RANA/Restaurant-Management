<?php
session_start();
unset($_SESSION['customer_id']);
session_destroy();
header("Location: http://localhost/SNV's/Restro/customer/index.php");
exit;
