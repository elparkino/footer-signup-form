<?php
/*
Template Name: Footer Template
*/
?>

<div class="container-fluid">
    <div class="row-fluid" id="box-top">
        <div class="span8 pull-left">
            <form class="form-inline" id="newsletter-signup" action="?action=signup" method="post">
                <input type="email" class="input-small" name="signup-email" id="signup-email" placeholder="Email">
                <input type="email" class="input-small" name="confirm-email" id="confirm-email" placeholder="Confirm Email">

                <button type="submit" class="btn btn-alert" id="submit-button">Submit!</button>
            </form>
        </div>
        <div class="span3 offset1">
            <span>Connect with us!</span>

        </div>
    </div>
    <div class="row-fluid">

    </div>    
    <div class="row-fluid">

    </div>
</div>

<?php
if($_GET['action'] == 'signup'){  
    mysql_connect('localhost','YOUR DB USERNAME','YOUR DB PASSWORD');    
    mysql_select_db('parker_');  
    $email = mysql_real_escape_string($_POST['signup-email']);  
  
    //validate email address - check if input was empty  
if(empty($email)){  
    $status = 'error';  
    $message = 'You did not enter an email address!';  
}  
else if(!preg_match($emailRegex, $email)){ //validate email address - check if is a valid email address  
    $status = 'error';  
    $message = 'You have entered an invalid email address!';  
}  
else {  
    $existingSignup = mysql_query("SELECT * FROM signups WHERE signup_email_address='$email'");     
    if(mysql_num_rows($existingSignup) < 1){  
  
        //database insert code  
     
    }  
    else {  
        $status = 'error';  
        $message = 'This email address has already been registered!';  
    }  
}

$date = date('Y-m-d');  
$time = date('H:i:s');  
  
$insertSignup = mysql_query("INSERT INTO signups (signup_email_address, signup_date, signup_time) VALUES ('$email','$date','$time')");  
if($insertSignup){  
    $status = 'success';  
    $message = 'you have been signed up!';    
}  
else {  
    $status = 'error';  
    $message = 'Oops, there\'s been a technical error! You have not been signed up.';      
}  

    //return json response   
    $data = array(  
        'status' => $status,  
        'message' => $message  
    );  
  
    echo json_encode($data); 
  
    exit;  
}  


?>