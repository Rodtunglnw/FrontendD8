<?php
    // $array = ['CODE' => '200', 'DATA' => $_POST];
    // $array2 = ['username', 'password', 'date'];
    // $array2 = 
    // echo json_encode(555);
    if (isset($_POST)) {
        $username = $_POST["username"];
        $password = $_POST['passsword'];
        
        echo json_encode($password);
        
    } else {
        echo json_encode(344324);
    }

    // $array = ['มือ' => 'แขน', 'หัว' => 'เส้นผม'];