<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "appointments_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, patient_name, email, symptoms, phone, date, gender, created_at 
        FROM appointments ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>AppointMed — View Appointments</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f4f8ff;
      background-image:url(homepage.png);
      background-repeat:no repeat;
      background-size:cover;
    }
    .appointments-container {
      margin: 40px;
      padding: 20px;
    }
    h2 { 
      margin-bottom: 20px;
       color: #0b2a4a;
       font-weight: bold;
       font-size: 40px;
       text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    table th, table td {
      padding: 12px 15px;
      border-bottom: 1px solid #eee;
      text-align: left;
    }
    table th {
      background: #0b2a4a ;
      color: #fff;
    }
    table tr:hover td {
      background: #f1f1f1;
    }
    .action-btn {
      margin-right: 8px;
      cursor: pointer;
      font-weight: 600;
      text-decoration: none;
    }
    .update-btn { 
      color: #ffffff; 
      border: solid;
      border-radius: 5px;
      padding: 10px;
      border:none;
      background: #0b2a4a;

    }
    .delete-btn { color: white; 
    border: none;
    background: red;

      border-radius: 5px;
      padding: 10px;}


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

      .nav {
        position: fixed;
        top: 0;
        left: -300px;
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
        transition: background 0.2s;
      }
      .nav-links a.active {
        background: rgba(0, 0, 0, 0.06);
        font-weight: 700;
      }
      .nav-links a.cta {
        background: #2b6bf7;
        color: #fff;
      }










  </style>
</head>
<body>
  <div class="nav-tab">
      <div class="logo">+</div>
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
        <a href="appointment.php">Appointment</a>
        <a href="contactus.php">Contact Us</a>
        <a href="register.php" class="cta active">Sign Up / Sign In</a>
        <a href="login.html">Logout</a>
      </nav>
    </header>

  <div class="appointments-container">
    <h2>📋 APPOINTMENT LIST 📋</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Patient Name</th>
          <th>Email</th>
          <th>Symptoms</th>
          <th>Phone</th>
          <th>Date</th>
          <th>Gender</th>
          <th>Created At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
  <?php
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['patient_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['symptoms']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['gender']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
              <a href="update.php?id=<?php echo $row['id']; ?>" class="action-btn update-btn">Update</a>
              <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['id']; ?>)" class="action-btn delete-btn">Delete</a>
            </td>
          </tr>
          <?php
      }
  } else {
      echo "<tr><td colspan='9'>No appointments found</td></tr>";
  }
  $conn->close();
  ?>
      </tbody>
    </table>
  </div>

<script>
function confirmDelete(id) {
  Swal.fire({
    title: "Are you sure?",
    text: "This appointment will be permanently deleted.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "delete.php?id=" + id;
    }
  });
}
</script>

<?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
<script>
Swal.fire({
  title: "Deleted!",
  text: "Appointment has been deleted successfully.",
  icon: "success",
  confirmButtonColor: "#3085d6"
});
</script>
<?php endif; ?>

</body>
</html>
