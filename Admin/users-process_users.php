<?php
include 'components/connect.php';
session_start();

// Lakukan koneksi ke database (ganti dengan detail koneksi yang sesuai)
// ...

// Ambil data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $status = $_POST['status'];
    $password = sha1($_POST['password']);
    $level = $_POST['level'];
    $about = $_POST['about'];
    $country = $_POST['country'];
    $address = $_POST['address'];

    // Query untuk menyimpan data ke tabel users
    $stmt = $conn->prepare("INSERT INTO users (username, fullname, email, phone, status, password, level, about, country, address) VALUES (:username, :fullname, :email, :phone, :status, :password, :level, :about, :country, :address)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':level', $level);
    $stmt->bindParam(':about', $about);
    $stmt->bindParam(':country', $country);
    $stmt->bindParam(':address', $address);
    
    $stmt->execute();

    // Set pesan keberhasilan dalam session
    $_SESSION['success_message'] = "User berhasil ditambahkan.";

    // Redirect kembali ke halaman utama
    header("Location: users.php");
    exit();
}
?>
