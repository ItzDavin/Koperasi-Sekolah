<?php
$host = "localhost";
$dbname = "sistem_informasi_koperasi_sekolah";                  
$username = "root";
$password = "";
 
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
 
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,       
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  
  PDO::ATTR_EMULATE_PREPARES => false                
];
 
try {
  $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $error) {
  die("Koneksi ke database gagal: " . $error->getMessage());
}
