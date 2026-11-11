<?php
$db = mysqli_connect("localhost", "root", "", "ujian");

if(isset($_POST['daftar'])){
    $username = $_POST['username'];
    $pasword = $_POST['pasword'];
}