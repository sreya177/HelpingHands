<?php
    if(isset($_POST['bookAppointment']))
    {
         if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
         {
            $username = $_POST['name'];
            $to = $_POST['email'];
            $userphone = $_POST['phone'];
            $doc = $_POST['doctor'];
            $time = $_POST['slot'];
            $subject = 'Appointment confirmation acknowledgment.';
            $message = "Hey, ".$username."\r\nThis is to confirm your appointment booking with ".$doc.".\r\nYour registered number is ".$userphone.". You will get a call on this number at ".$time.".\r\nThank you for choosing us.\n\nRegards,\r\nHelping Hands.";
            $headers = "From: helpinghandsofficialss@gmail.com\r\nReply-To: helpinghandsofficialss@gmail.com";
            $status = mail($to, $subject, $message, $headers);
                if($status==true)
                {
                    echo '<script>alert("Appointment booked! Confirmation mail sent.")</script>';
                }
                else
                {
                    echo '<script>alert("Appointment not booked! Please try again.")</script>';
                }   
        }
    $name = filter_input(INPUT_POST,'name');
    $phone = filter_input(INPUT_POST,'phone');
    $doctor = filter_input(INPUT_POST,'doctor');
    $timeslot = filter_input(INPUT_POST,'slot');
    if(!empty($name)){
        if(!empty($phone)){
            if(!empty($doctor)){
                if(!empty($timeslot)){
                    $host = "localhost";
                    $dbusername = "root";
                    $dbpassword = "";
                    $dbname = "helpinghands";
                    // connection creation
                    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
                    if(mysqli_connect_error()){
                        die('Connection Error('.mysqli_connect_error().')'.mysqli_connect_error());
                    }
                    else{
                        $sql = "INSERT INTO patient_details (Name, PhoneNumber,Doctor,Slot) values ('$name','$phone','$doctor','$timeslot')";
                        if($conn->query($sql)){
                            echo "new record inserted";
                        }
                        else{
                            echo "Error: ". $sql ."<br>". $conn->error;
                        }
                        $conn->close();
                    }
                }
                else{
                    echo "Please choose a time slot";
                    die();
                }
            }
            else{
                echo "Please choose a doctor.";
                die();
            }
        }
        else{
            echo "Phone number should not be empty!";
            die();
        }
    }
    else{
        echo "Name should not be empty!";
        die();
    }
}
?>

<html>

<head>
    <title>Appointments</title>
    <link rel="stylesheet" href="style1.css">
</head>

<body>
    <div class="app-title">
        <h1>Helping Hands Appointments</h1>
    </div>
    <div class="appointment-form">
        <form action="acknowledge.php" method="post">
            <div class="col-12">
                <input name="name" type="text" class="form-control" placeholder="Name" required>
            </div>
            <div class="col-12">
                <input name="email" type="email" class="form-control" placeholder="Email ID" required>
            </div>
            <div class="col-12">
                <input name="phone" type="tel" class="form-control" placeholder="Phone Number" pattern='[0-9]{10}' required>
            </div>
            <div class="col-12">
                <select name="doctor" class="form-select" placeholder="Choose a doctor">
                    <option selected>Choose a Doctor</option>
                    <option>Dr.Amar Singh</option>
                    <option>Dr. Sarika Kumar</option>
                    <option>Dr. Keshav Iyer</option>
                </select>
            </div>
            <div class="col-12">
                <select name="slot" class="form-select" placeholder="Choose a slot">
                    <option selected>Choose a slot</option>
                    <option>10:00 A.M</option>
                    <option>12:00 P.M</option>
                    <option>2:00 P.M</option>
                    <option>4:00 P.M</option>
                    <option>6:00 P.M</option>
                    <option>8:00 P.M</option>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" name="bookAppointment" class="btn submit">Book Appointment</button>
            </div>
        </form>
    </div>
</body>

</html>
