<?php
$included = true; // flag that tells connection info it is being "included"
include_once "connection_info.php";

// define variables and set to empty values
$first_name = "";
$last_name  = "";
$email      = "";
$comments   = "";
$company    = "";
$mobile     = "";

// hold any error messages in this array for later display
$error_msg  = [];

// do we want to try to save?
$input_good = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_good = true; // try to save unless something turn up wrong

    // if the field comes back as anything but false, then it is not empty and has been scrubbed
    if (! $first_name = not_empty("first_name")) {
        $error_msg[] = "First name is required";
    }

    if (! $last_name = not_empty("last_name")) {
        $error_msg[] = "Last name is required";
    }

    if (! $email = not_empty("email")) {
        $error_msg[] = "Email is required";
    } else {
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_msg[] = "Invalid email format";
            $input_good  = false;
        }
    }

    if (!$input_good or !$first_name or !$last_name or !$email) { // if any of these are false, then we have a problem
        $input_good = false;
    }

    // empty is ok just clean them up
    $comments = clean_input($_POST["comments"]);
    $mobile   = clean_input($_POST["mobile"]);
    $company  = clean_input($_POST["company"]);

    if ($input_good) {
        // do insert using parameter binding to avoid SQL injection issues
        // the fields need to be listed in the same order
        $stmt = $pdo->prepare("INSERT INTO contacts ( first_name,  last_name,  mobile,  email,  company,  comments ) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute(                             [$first_name, $last_name, $mobile, $email, $company, $comments]);
        $stmt = null;
    }
}

function not_empty($field_name) {
    $retVal = false;

    if (! empty($_POST[$field_name])) {
        $retVal = clean_input($_POST[$field_name]);
    }

    return $retVal;
}

function clean_input($data) {
    $retVal = trim($data);
    $retVal = stripslashes($retVal);
    $retVal = htmlspecialchars($retVal);
    return $retVal;
}




// if we had good input, then inform the user and exit
if ($input_good) {
    echo "<p><h2>Your Input has been submitted, thank you!</h2></p>";
    exit;
}

// if not, then indicate the issues.  font statement added MB 12/28/2019
?>
<p>
    <font color="ff0000">
    <h3>Errors found:</h3>
    <h4 class="error"><?php foreach ($error_msg as $msg) {echo "$msg<br>";} ?><br></h4>
</p>
