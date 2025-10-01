<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "appointments_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Invalid appointment ID");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_name = $_POST['patient_name'];
    $email = $_POST['email'];
    $symptoms = $_POST['symptoms'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $gender = $_POST['gender'];

    $sql = "UPDATE appointments 
            SET patient_name='$patient_name', email='$email', symptoms='$symptoms', 
                phone='$phone', date='$date', gender='$gender' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Appointment updated successfully'); window.location.href='view-appointments.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch current appointment details
$sql = "SELECT * FROM appointments WHERE id=$id";
$result = $conn->query($sql);
$appointment = $result->fetch_assoc();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Update Appointment</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f4f8ff;
      padding: 40px;
    }
    h2 { margin-bottom: 20px; }
    table {
      width: 600px;
      border-collapse: collapse;
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    table td {
      padding: 12px 15px;
      border-bottom: 1px solid #eee;
    }
    table th {
      text-align: left;
      background: #009688;
      color: #fff;
      padding: 12px 15px;
    }
    input, select {
      width: 95%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }
    button {
      margin-top: 15px;
      padding: 10px 18px;
      border: none;
      border-radius: 8px;
      background: #009688;
      color: white;
      font-weight: 600;
      cursor: pointer;
    }
    button:hover {
      background: #00796B;
    }
  </style>
</head>
<body>
  <h2>Update Appointment</h2>
  <form method="POST">
    <table>
      <tr>
        <th colspan="2">Appointment Details</th>
      </tr>
      <tr>
        <td>Patient Name</td>
        <td><input type="text" name="patient_name" value="<?php echo $appointment['patient_name']; ?>" required></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><input type="email" name="email" value="<?php echo $appointment['email']; ?>" required></td>
      </tr>
      <tr>
        <td>Symptoms</td>
        <td><input type="text" name="symptoms" value="<?php echo $appointment['symptoms']; ?>" required></td>
      </tr>
      <tr>
        <td>Phone</td>
        <td><input type="text" name="phone" value="<?php echo $appointment['phone']; ?>" required></td>
      </tr>
      <tr>
        <td>Date</td>
        <td><input type="date" name="date" value="<?php echo $appointment['date']; ?>" required></td>
      </tr>
      <tr>
        <td>Gender</td>
        <td>
          <select name="gender" required>
            <option value="Male" <?php if($appointment['gender']=="Male") echo "selected"; ?>>Male</option>
            <option value="Female" <?php if($appointment['gender']=="Female") echo "selected"; ?>>Female</option>
          </select>
        </td>
      </tr>
    </table>
    <button type="submit">Update Appointment</button>
  </form>
</body>
</html>
