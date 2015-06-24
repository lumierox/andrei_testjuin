<?php
    $menu=  select("rubric", "*", "");
    if(isset($_POST['user'])){
        $user=$_POST['user'];
        $password=$_POST['password'];
        if(!is_string($req=select("user as u", 
                                    "u.login, u.password, u.name, p.name as perm_name, u.permit_id", 
                                    "INNER JOIN permit as p ON u.permit_id = p.id
                                     WHERE login='$user' AND password='$password'")))
        {
            $user = mysqli_fetch_assoc($req);
            foreach($user as $key => $value){
                $_SESSION[$key]=$value;
            }
        }else print $req;
    }
    include_once 'view/header.php';
