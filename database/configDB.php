<?php 

function connDB() {

   $dbServer = 'localhost';
   $dbUser = 'cuanukmi_botte';
   $dbPass = '%fC6O[g.F%B1';
   $dbName = "cuanukmi_botte";

   $conn = mysqli_connect($dbServer, $dbUser, $dbPass);

   if(!$conn) {
         die('Koneksi gagal: ' . mysqli_error());
   }
   
   mysqli_select_db($conn, $dbName);
  
   return $conn;
}