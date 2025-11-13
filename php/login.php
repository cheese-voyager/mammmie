<?php 
session_start();
include 'conn.php';

// Tangkap data dari form
$email = $_POST['email'];
$password = $_POST['password'];

// Cek email dan password
$query = "SELECT * FROM user WHERE email='$email' AND password='$password' LIMIT 1";
$result = mysqli_query($connect, $query);
$user = mysqli_fetch_assoc($result);

if ($user) {
    $_SESSION['email'] = $user['email'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['status'] = "login";

    // Arahkan sesuai role
    if ($user['role'] == 'admin') {
        header("Location: tabeluserShow.php");
        exit;
    } else {
        header("Location: index.php");
        exit;
    }
} else {
    echo "<script>alert('Login gagal! Email atau password salah');</script>";
    echo "<script>window.location='login.html';</script>";
}
?>
