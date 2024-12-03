<?php
// Konfigurasi koneksi database
$servername = "localhost"; // Ganti dengan host database Anda
$username = "root";        // Ganti dengan username MySQL Anda
$password = "";            // Ganti dengan password MySQL Anda
$dbname = "db_telkom1";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    // Query untuk menyimpan data ke tabel
    $sql = "INSERT INTO form_data (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Jika berhasil, tampilkan alert dan kembali ke index.html
        echo "<script>
                alert('Terimakasih sudah menghubungi kami!');
                window.location.href = 'index.html';
              </script>";
    } else {
        // Jika gagal, tampilkan pesan error
        echo "<script>
                alert('Gagal mengirim pesan: " . $conn->error . "');
                window.location.href = 'index.html';
              </script>";
    }

    $conn->close();
}
?>