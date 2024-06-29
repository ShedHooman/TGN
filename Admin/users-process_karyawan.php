<?php
session_start();
include '../components/connect.php';

// Ambil data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $status = $_POST['status'];
    $password = sha1($_POST['password']);
    $level = $_POST['level'];
    $about = $_POST['about'];
    $job = $_POST['job'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    $profile_image = $_POST['profile_image'];

    // Query untuk menyimpan data ke tabel karyawan
    $stmt = $conn->prepare("INSERT INTO karyawan (fullname, name, email, phone, status, password, level, about, job, country, address, profile_image) VALUES (:fullname, :name, :email, :phone, :status, :password, :level, :about, :job, :country, :address, :profile_image)");
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':level', $level);
    $stmt->bindParam(':about', $about);
    $stmt->bindParam(':job', $job);
    $stmt->bindParam(':country', $country);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':profile_image', $profile_image);
    
    $stmt->execute();

    // Set pesan keberhasilan dalam session
    $_SESSION['success_message'] = "Data karyawan berhasil ditambahkan.";

    // Redirect kembali ke halaman utama
    header("Location: users.php");
    exit();
}
?>
