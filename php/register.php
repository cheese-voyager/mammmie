<?php
session_start();
include 'conn.php';

// ambil data dari form
$nama         = $_POST['nama'];
$username     = $_POST['username'];
$email        = $_POST['email'];
$password     = $_POST['password'];
$role         = $_POST['role'];
$admin_kode   = $_POST['kode'];

// cek apakah username sudah ada
$cek = mysqli_query($connect, "SELECT * FROM user WHERE email='$email'");
if(mysqli_num_rows($cek) > 0){
    echo "<script>alert('Email sudah ada!'); window.location='login.html';</script>";
    exit;
}

if ($admin_kode === 'YupiChocoGlee') {
    $role = 'admin';
} else {
    $role = 'user';
}

// simpan ke database
$query = mysqli_query($connect, "INSERT INTO register (nama, username, email, password, role, admin_kode) VALUES ('$nama', '$username', '$email', '$password', '$role', '$kode')");

if($query){
    // buat session login langsung
    $_SESSION['email'] = $email;
    $_SESSION['status'] = "login";
    echo "<script>alert('Akun berhasil dibuat! Selamat datang $email'); window.location='tableuserShow.php';</script>";
} else {
    echo "<script>alert('Gagal membuat akun!'); window.location='login.html';</script>";
}
?>