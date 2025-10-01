
<?php
session_start(); // Start the session

// Check if the user is logged in by verifying the user_id session variable
if (!isset($_SESSION['id'])) {
    // If not logged in, redirect to login page
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Make an Appointment</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link
    
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Great+Vibes&display=swap"
      rel="stylesheet"
    />

    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      body {
        font-family: "Poppins", sans-serif;
        background-image: url("Appointment.png");
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-repeat:no repeat;
      }

      .nav-tab {
        position: fixed;
        top: 18px;
        left: 0;
        height: 48px;
        padding: 6px 10px;
        display: flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(90deg, #b7dbff, #9bd1ff);
        border-top-right-radius: 24px;
        border-bottom-right-radius: 24px;
        z-index: 105;
        cursor: pointer;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
      }
      .nav-tab .logo {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: white;
        display: grid;
        place-items: center;
        color: #2b6bf7;
        font-weight: 700;
      }
      .nav-tab .start-text {
        font-weight: 700;
        color: #0b2a4a;
        font-size: 14px;
        white-space: nowrap;
      }

      .nav {
        position: fixed;
        top: 0;
        left: -260px;
        width: 260px;
        height: 100%;
        background: linear-gradient(180deg, #b7dbff, #9bd1ff);
        display: flex;
        flex-direction: column;
        padding: 20px;
        transition: left 0.28s ease;
        z-index: 100;
      }
      .nav-tab:hover + .nav,
      .nav:hover {
        left: 0;
      }

      .brand {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 700;
        color: #0b2a4a;
        margin-bottom: 20px;
      }
      .brand .logo {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: white;
        display: grid;
        place-items: center;
        color: #2b6bf7;
        font-weight: 700;
      }
      .nav-links {
        display: flex;
        flex-direction: column;
        gap: 12px;
      }
      .nav-links a {
        padding: 10px 14px;
        text-decoration: none;
        color: #111;
        border-radius: 12px;
        font-weight: 600;
        background: white;
      }
      .nav-links a.active {
        background: rgba(0, 0, 0, 0.06);
        font-weight: 700;
      }
      .nav-links a.cta {
        background: #2b6bf7;
        color: #fff;
      }

      .appointment-section {
        max-width: 1000px;
        margin: 0 auto;
        text-align: center;
        padding: 20px;
      }
      .appointment-section h1 {
        font-family: "Cambria";
        font-size: 60px;
        margin-bottom: 40px;
        color: #111;
      }
      .form-container {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px 40px;
        justify-items: center;
      }
      .input-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
      }
      .input-box input,
      .input-box select {
        width: 100%;
        padding: 14px 20px;
        font-size: 16px;
        border: 2px solid #000;
        border-radius: 40px;
        background: #fff;
        box-shadow: 4px 6px 0px #1abc9c;
        outline: none;
      }
      .input-box label {
        margin-top: 10px;
        font-weight: 600;
      }
      .btn {
        grid-column: 1 / -1;
        margin-top: 20px;
        padding: 15px 30px;
        background: #1abc9c;
        color: white;
        border: none;
        border-radius: 40px;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
      }
      .btn:hover {
        background: #16a085;
      }
    </style>
    
  </head>
  <body>
    <div class="nav-tab">
      <div class="logo">+</div>
      <div class="start-text"></div>
    </div>

    <header class="nav">
      <div class="brand">
        <div class="logo">+</div>
        <div>Start</div>
      </div>
     <nav class="nav-links">
        <a href="homepage.php">Home</a>
        <a href="dashb.php">Dashboard</a>
        <a href="aboutus.php">About Us</a>
        <a href="#">Appointment</a>
        <a href="contactus.php">Contact Us</a>
        <a href="register.php" class="cta active">Sign Up / Sign In</a>
        <a href="login.html">Logout</a>
      </nav>
    </header>

    <section class="appointment-section">
      <h1>MAKE AN APPOINTMENT</h1>

      <form
        class="form-container"
        action="appointment.php"
        method="post"
        autocomplete="off"
      >
        <div class="input-box">
          <input
            type="text"
            name="patient_name"
            placeholder="Enter patient name"
            autocomplete="off"
            required
          />
          <label>Patient Name</label>
        </div>
        <div class="input-box">
          <input type="email" name="email" placeholder="Enter email" required />
          <label>Email</label>
        </div>
        <div class="input-box">
          <input
            type="text"
            name="symptoms"
            placeholder="Enter symptoms"
            required
          />
          <label>Symptoms</label>
        </div>
        <div class="input-box">
          <input
            type="tel"
            name="phone"
            placeholder="09xxxxxxxxx"
            pattern="[0-9]{11}"
            title="Phone must be 11 digits"
            required
          />
          <label>Phone Number</label>
        </div>
        <div class="input-box">
          <input type="date" name="date" required />
          <label>Select Date</label>
        </div>
        <div class="input-box">
          <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
          </select>
          <label>Gender</label>
        </div>
        <button type="submit" onclick="submitSuccess(event)" class="btn">Book Appointment</button>
      </form>
    </section>

    <script>
function submitSuccess(event) {
  event.preventDefault(); // stop form immediately

  Swal.fire({
  title: "Confirm Booking",
  text: "Do you want to book this appointment?",
  icon: "question",
  showCancelButton: true,
  confirmButtonText: "Yes, book it!",
  cancelButtonText: "Cancel"
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire({
      title: "Appointment Booked",
      text: "Your appointment has been successfully booked.",
      icon: "success"
    }).then(() => {
      event.target.form.submit(); // submit AFTER success alert
    });
  }
});
}




      window.onload = function () {
        document.querySelectorAll("input, textarea, select").forEach((el) => {
          if (el.tagName !== "SELECT") el.value = "";
          else el.selectedIndex = 0;
        });
      };
    </script>

  </body>
</html>

<?php

$host = "localhost";   
$user = "root";        
$pass = "";           
$db   = "appointments_db"; 

$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $patient_name = trim($_POST['patient_name']);
    $email        = trim($_POST['email']);
    $symptoms     = trim($_POST['symptoms']);
    $phone        = trim($_POST['phone']);
    $date         = $_POST['date'];
    $gender       = $_POST['gender'];

   
    if (empty($patient_name) || empty($email) || empty($symptoms) || 
        empty($phone) || empty($date) || empty($gender)) {
        die("All fields are required.");
    }

  
    $stmt = $conn->prepare("INSERT INTO appointments 
        (patient_name, email, symptoms, phone, date, gender) 
        VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $patient_name, $email, $symptoms, $phone, $date, $gender);

    if ($stmt->execute()) {
     
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>