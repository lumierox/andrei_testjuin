<?php 
    session_start();
    include_once 'includes/config.php';
    include_once 'includes/header-html.php';
    include_once 'model/fonctions-db.php';
    
    include_once 'controller/header.php';
    
    if(!isset($_GET['menu'])){
        include_once 'controller/accueil.php';
    }else if(array_key_exists($_GET['menu'], $rubric_table)){
        include_once 'controller/categorie.php';
    }
    
    include_once 'includes/footer.php';
