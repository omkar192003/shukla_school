<?php
require 'smtp/PHPMailerAutoload.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$errors = [];
$name = $email = $mobile = $class = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate child name
    if (empty($_POST["child-name"])) {
        $errors["child-name"] = "Child name is required";
    } else {
        $name = test_input($_POST["child-name"]);
    }
    
    // Validate parent name
    if (empty($_POST["parent-name"])) {
        $errors["parent-name"] = "Parent name is required";
    }
    
    // Validate email
    if (empty($_POST["parent-email"])) {
        $errors["parent-email"] = "Email is required";
    } else {
        $email = test_input($_POST["parent-email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["parent-email"] = "Invalid email address";
        }
    }
    
    
    // Validate mobile number
    if (empty($_POST["mobile-number"])) {
        $errors["mobile-number"] = "Mobile number is required";
    } else {
        $mobile = test_input($_POST["mobile-number"]);
        if (!preg_match("/^[0-9]{10}$/", $mobile)) {
            $errors["mobile-number"] = "Invalid mobile number format";
        }
    }
    
    // Validate selected class
    if (empty($_POST["select-class"])) {
        $errors["select-class"] = "Please select a class";
    } else {
        $class = test_input($_POST["select-class"]);
    }
    
    // If no errors, send email
    if (empty($errors)) {
        $to = "newlittleworldpreschool@gmail.com";
        $subject = "New Form Submission";
        $body = "Child Name: $name<br>"
      . "Parent Name: " . $_POST["parent-name"] . "<br>"
      . "Email: $email<br>"
      . "Mobile Number: $mobile<br>"
      . "Class: $class";

        
    // PHPMailer code for sending email
        $mail = new PHPMailer(); 
        $mail->IsSMTP(); 
        $mail->SMTPAuth = true; 
        $mail->SMTPSecure = 'tls'; 
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; 
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        //$mail->SMTPDebug = 2;
        $mail->Username = "newlittleworldpreschool@gmail.com";
        $mail->Password = "zxpa vtph zndl tlpi";
        $mail->SetFrom($email);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($to);
        $mail->SMTPOptions = array('tls' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => false
        ));
        
        if (!$mail->Send()) {
            echo "<script>alert('Error submitting form. Please try again later.')</script>";
        } else {
            echo "<script>alert('Form submitted successfully. We will get in touch with you soon.')</script>";
        }
    }
}

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Little World </title>
    <link rel="stylesheet" href="styles.css">
    <script src="srcipt.js"></script>
</head>
<body>
<!-- Header Section -->
<header>
    <div class="logo">
        <img src="logo.png" alt="New Little World Logo">
        
    </div>
    <nav>
        
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a id="#our-programmes" href="#our-programmes">Programs</a></li>
            <li><a href="#admissions">Admissions</a></li>
            <li><a id="#location" href="#location">Contact Us</a></li>
        </ul>
    
    </nav>
</header>


<section id="enquiry" class="enquiry">
    <h2 id="head">New Little World</h2>
   
    <div class="enquiry-form">
        <h2>Enquiry Form</h2><br>
        <form id="enquiry-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" id="child-name" name="child-name" placeholder="Child name" value="<?php echo $name; ?>" required><br>
            <span class="error"><?php echo $errors["child-name"] ?? ""; ?></span><br>
        
            <input type="text" id="parent-name" name="parent-name" placeholder="Parent name" required><br>
            <span class="error"><?php echo $errors["parent-name"] ?? ""; ?></span><br>
        
            <input type="email" id="parent-email" name="parent-email" placeholder="Email" value="<?php echo $email; ?>" required><br>
            <span class="error"><?php echo $errors["parent-email"] ?? ""; ?></span><br>
        
            <input type="tel" id="mobile-number" name="mobile-number" pattern="[0-9]{10}" placeholder="Mobile number" value="<?php echo $mobile; ?>" required><br>
            <span class="error"><?php echo $errors["mobile-number"] ?? ""; ?></span><br>
            
            <select id="select-class" name="select-class" required>
                <option value="">Select Class</option>
                <option value="playgroup">Playgroup - 2 to 3 years</option>
                <option value="nursery">Nursery - 3 to 4 years</option>
                <option value="junior-kg">Junior KG - 4 to 5 years</option>
                <option value="senior-kg">Senior KG - 5 to 6 years</option>
            </select><br>
            <span class="error"><?php echo $errors["select-class"] ?? ""; ?></span><br>
        
            <input type="checkbox" id="allow-communication" name="allow-communication" required>
            <label for="allow-communication">By clicking on submit, I allow all communication from New Little World</label><br><br>
        
            <input type="submit" value="Enquire Now &#10162;">
        </form>
    </div>
</section>


<section id="our-programmes" class="our-programmes">
    <h2>Our Programmes</h2>
    <div class="programmes-grid">
        <div class="programme-box">
            <img src="playgroup.jpg" alt="Playgroup Image">
            <h3>Playgroup</h3>
            <p> &#128118; 2-3 years</p>
            <p>&#128197; 5 days a week</p>
            <p>&#x1F551; 2 hours 15 minutes per day</p>
            <a class="enroll-button" href="#enquiry">Enroll</a>
        </div>
        <div class="programme-box">
            <img src="nursery.jpg" alt="Playgroup Image">
            <h3>Nursery</h3>
            <p> &#128118; 3-4 years</p>
            <p>&#128197; 5 days a week</p>
            <p>&#x1F551; 2 hours 15 minutes per day</p>
            <a class="enroll-button" href="#enquiry">Enroll</a>
        </div>
        <div class="programme-box">
            <img src="junior.jpeg" alt="Playgroup Image">
            <h3>Junior KG </h3>
            <p> &#128118; 4-5 years</p>
            <p>&#128197; 5 days a week</p>
            <p>&#x1F551; 2 hours 15 minutes per day</p>
            <a class="enroll-button" href="#enquiry">Enroll</a>
        </div>
        <div class="programme-box">
            <img src="senior.jpg" alt="Playgroup Image">
            <h3>Senior KG</h3>
            <p> &#128118; 5-6 years</p>
            <p>&#128197; 5 days a week</p>
            <p>&#x1F551; 2 hours 15 minutes per day</p>
            <a class="enroll-button" href="#enquiry">Enroll</a>
            
        </div>
    </div>
</section>


<section id="parents-speak" class="parents-speak">
    <h2>Parents Speak</h2>
    <div class="parent-reviews">
        <div class="review">
            <img src="profile.png" alt="Parent 1">
            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam."</p>
            <p>- Parent 1</p>
        </div><br>
        <div class="review">
            <img src="profile1.png" alt="Parent 2">
            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam."</p>
            <p>- Parent 2</p>
        </div><br>
        <div class="review">
            <img src="profile2.png" alt="Parent 3">
            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam."</p>
            <p>- Parent 3</p>
        </div>
    </div>
</section>

<section id="location" class="location">
    <h2>Preschool Near You</h2>
    <p>New Little World in kalyan</p>
    <div class="location-container">
        <div class="location-info">
            <p><b>Address:</b><br>64JQ+FJJ, Kolsewadi, Shivaji Colony, Kalyan, Maharashtra 421306</p>
            
            <p><b>Email:</b><br>newlittleworldpreschool@gmail.com</p>
            
            <p><b>Contact:</b><br>+91 7900128034 <br>+91 8268177397</p>
            
        </div>
        <div class="location-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3767.1753559124422!2d73.13641937483777!3d19.231187982005608!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be795cd39291e01%3A0xe2945ae167abe7b0!2sNew%20Little%20World%20Pre%20School!5e0!3m2!1sen!2sin!4v1713092795392!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> 
        </div>
    </div>
</section>
<?php
include "footer.html";
?>
</body>
</html>
