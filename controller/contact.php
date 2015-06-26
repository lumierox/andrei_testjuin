<?php
    $message='';
    $admin=  mysqli_fetch_assoc(select('user', 'email, name', 'WHERE permit_id=1'));
    if(isset($_POST['nom']) &&
            !empty(trim($_POST['nom'])) &&
            !empty(trim($_POST['text'])) &&
            !empty(trim($_POST['email']))){
        
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $titre=$_POST['titre'];
        $email_texte=$_POST['text'];
        $email_emetteur=$_POST['email'];
        
        $entete = "From: $titre $nom $prenom $email_emetteur\r\n".
        'Reply-To: '.$email_emetteur."\r\n".
        'X-Mailer: PHP/'.phpversion();

        if (mail($admin['email'],$email_emetteur,$email_texte,$entete)){
            $message .= 'Message envoyé à '.$admin['name'];
        } else {
            $message .= "Une erreur est survenue lors de l'envoi du email";
        }
    }
    
    include_once 'view/contact.php';