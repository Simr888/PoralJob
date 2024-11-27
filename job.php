<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Load Composer's autoloader (if you're using Composer)
require 'vendor/autoload.php';
$con = mysqli_connect('localhost', 'root', '', 'job_db'); // Update with your database credentials
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['submit'])) {
    // Sanitize form inputs
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $skills = htmlspecialchars($_POST['skills']);
    $applied_for = htmlspecialchars($_POST['applied_for']);

    $filename = $_FILES['image']['name']; // Get the resume filename

    // Directory where files will be uploaded
    $upload_dir = "uploads/";

    // Check if directory exists, create it if not
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true); // Create directory with permissions if it doesn't exist 
                                        // 0777 is refers to as the permission for folder {permissions like : read, write, update}
    }

    // Full path to the uploaded file
    $upload_file = $upload_dir . basename($_FILES["image"]["name"]);

    // Attempt to move the uploaded file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $upload_file)) {
        // File uploaded successfully, now proceed with sending the email

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true); // Passing `true` enables exceptions

        try {
            // Server settings
            $mail->isSMTP();                                          // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';                     // Set Gmail SMTP server
            $mail->SMTPAuth   = true;                                 // Enable SMTP authentication
            $mail->Username   = 'simran.jsr06@gmail.com';               // Your Gmail address
            $mail->Password   = 'tyeg oesb kmvf kped';                  // Your App Password or Gmail password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       // Enable TLS encryption
            $mail->Port       = 587;                                  // TCP port for TLS

            // Recipients (Admin/Company)
            $adminEmail = 'admin@example.com';
            $mail->setFrom('your-email@gmail.com', 'Job Portal');      // Sender email and name
            $mail->addAddress($adminEmail);                           // Recipient email (Admin/Company)
            $mail->addReplyTo($email, $name);                         // Add a reply-to email (applicant's email)

            // Attachments
            $mail->addAttachment($upload_file);                       // Attach the uploaded resume file

            // Content
            $mail->isHTML(true);                                      // Set email format to HTML
            $mail->Subject = "New Job Application from $name";        // Customize the subject
            $mail->Body    = "                                      
                <html>
                <head><title>Job Application</title></head>             
                <body>
                    <p>A new job application has been submitted:</p>
                    <p><strong>Name:</strong> $name</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Phone:</strong> $phone</p>
                    <p><strong>Skills:</strong> $skills</p>
                    <p><strong>Resume:</strong> Attached</p>
                </body>
                </html>
            "; // this above mail is to been send to the admin gmail id.. 

            // Send the email to the admin/company
            $mail->send();
            echo "<script>alert('Email sent successfully ');</script>";

            // Now, insert data into the database
            $sql = "INSERT INTO hire_tbl (email, name, phone, skills, applied_for, image, date) 
                    VALUES ('$email', '$name', '$phone', '$skills', '$applied_for' , '$filename', NOW())";
            $result = mysqli_query($con, $sql);

            if ($result) {
                
                echo "<script>alert('Application submitted successfully ');</script>";
                header('location:hire.php');
            } else {
                echo "Error: " . mysqli_error($con); 
            }
            // Send confirmation email to the applicant
            $mail->clearAddresses(); // Clear admin addresses to avoid sending to the same email
            $mail->addAddress($email); // Send confirmation to applicant's email
            $mail->Subject = "Thank you for applying!";
            $mail->Body    = "
                <html>
    <head>
        <title>Application Confirmation</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #2c2c2c; /* Dark background color */
                color: #ffffff; /* Light text color */
            }
            .container {
                width: 100%;
                padding: 20px;
                background-color: #3c3c3c; /* Slightly lighter background for the container */
                border-radius: 8px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
                max-width: 600px;
                margin: auto;
                box-sizing: border-box; /* Ensure padding is included in the total width */
            }
            h1 {
                color: #ffcc00; /* Golden color for the heading */
                font-size: 24px;
            }
            p {
                color: #e0e0e0; /* Light grey for paragraph text */
                line-height: 1.6;
            }
            .footer {
                margin-top: 20px;
                font-size: 12px;
                color: #aaa; /* Lighter grey for footer text */
                text-align: center;
            }
            a {
                color: #ffcc00; /* Golden color for links */
                text-decoration: none;
            }
            a:hover {
                text-decoration: underline; /* Underline on hover */
            }

            /* Responsive styles */
            @media (max-width: 600px) {
                .container {
                    padding: 15px; /* Reduce padding on smaller screens */
                }
                h1 {
                    font-size: 20px; /* Smaller heading size */
                }
                p {
                    font-size: 14px; /* Smaller paragraph text */
                }
                .footer {
                    font-size: 10px; /* Smaller footer text */
                }
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1>Application Confirmation</h1>
            <p>Dear $name,</p>
            <p>Thank you for applying for the job position. We have received your application and will review it shortly.</p>
            <p>We appreciate your interest in joining our team!</p>
            <p>Best Regards,<br>The Job Portal Team</p>
        </div>
        <div class='footer'>
            <p>This email is automatically generated. Please do not reply.</p>
        </div>
    </body>
</html>
";
            // Send confirmation email to the applicant/receiptant
            $mail->send(); 
            echo "Confirmation email sent to the applicant: $email!";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Failed to upload file.";
    }

    // Close the database connection
    mysqli_close($con);
}
?>
