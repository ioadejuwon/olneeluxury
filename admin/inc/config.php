<?php    
    $dbhost = 'localhost';
    // $dbuser = 'u421730478_olneeLux';
    // $dbpass = 'A4?g/rpJb';
    // $dbname = 'u421730478_olnee_luxury';

    $dbuser = 'root';
    $dbpass = 'root';
    $dbname = 'olnee_luxury';
    $conn = mysqli_connect($dbhost,$dbuser,$dbpass, $dbname);

    // if(!$conn){
    //     die("Could not connectnn ". mysqli_connect_error());
    // }else{
    //     echo 'Connection successful!';
    // }