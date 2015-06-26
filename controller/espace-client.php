<?php
    if(isset($_SESSION['login'])){
        //DELETE
        $delete='';
        if(isset($_GET['delete'])){
            $user_id=$_GET['id'];
            $image_id=$_GET['delete'];
            $image_name = $_GET['name'];
            if($user_id==$_SESSION['id'] || $_SESSION['permit_id']==1){

                if(is_string(delete('rubric_has_photo', "WHERE photo_id=$image_id")) 
                        && is_string(delete('photo', "WHERE id=$image_id"))
                        && unlink($dossier_ori.$image_name)
                        && unlink($dossier_gd.$image_name)
                        && unlink($dossier_mini.$image_name)){
                    $delete = "Suppression réussie.";
                    //redirection apres supression
                    isset($_GET['a'])?header('Location: ?menu=espace-client&a='.$_GET['a']):header('Location: ?menu=espace-client');
                    exit;
                }else{
                    $delete = "Suppression échouée.";
                }  
            }else{
                $delete = "Vous n'avez pas le droit de supprimer cette image.";
            }
        }
        //EDITION
        $edit='';
        if(isset($_POST['edit'])){
            $user_id=$_POST['user_id'];
            $image_id=$_POST['id'];
            $title = $_POST['titre'];
            $desc = $_POST['desc'];
            $section = '';
            $flag=0;
            if(isset($_POST['section'])){
                $flag = delete('rubric_has_photo', "WHERE photo_id=$image_id")=="Suppression réussie"?1:0;
                foreach ($_POST['section'] as $key => $value){
                    $flag += insert('rubric_has_photo', "photo_id, rubric_id", "$image_id, $value")=="Ajout réussi!"?10:0;
                }
            }else{
                $flag = delete('rubric_has_photo', "WHERE photo_id=$image_id")=="Suppression réussie"?11:0;
            }
            if($user_id==$_SESSION['id'] || $_SESSION['permit_id']<3){
               $flag += update('photo', "title='$title', text='$desc'", "WHERE id=$image_id")=='Mise à jour réussie'?100:0;
            }else{
                $edit = "Vous n'avez pas le droit d'éditer cette image.";
            }
            $edit = $flag >= 111 ? "Modifications prises en compte !": "Modification échouée ! $flag";
        }

        $upload = '';
        if(isset($_POST['letitre'])&&isset($_FILES['lefichier'])){

            $letitre = traite_chaine($_POST['letitre']);
            $ladesc = traite_chaine($_POST['ladesc']);

            $limage = $_FILES['lefichier'];

            $upload = upload_originales($limage,$dossier_ori,$formats_acceptes);

            if(!is_array($upload)){
  
            }else{
                $gd_ok = creation_img($dossier_ori, $upload['nom'],$upload['extension'],$dossier_gd,$grande_large,$grande_haute,$grande_qualite);

                $min_ok = creation_img($dossier_ori, $upload['nom'],$upload['extension'],$dossier_mini,$mini_large,$mini_haute,$mini_qualite,false);

                if($gd_ok==true && $min_ok==true){
                    $sql= "INSERT INTO photo (name,extention,weight,height,width,title,text,user_id) 
                        VALUES ('".$upload['nom']."','jpg',".$upload['poids'].",".$upload['hauteur'].",".$upload['largeur'].",'$letitre','$ladesc',".$_SESSION['id'].");";

                    mysqli_query($db,$sql) or die($upload = mysqli_error($db));

                    $id_photo = mysqli_insert_id($db);

                    if(isset($_POST['section'])){
                        foreach($_POST['section'] AS $clef => $valeur){
                            if(ctype_digit($valeur)){
                                mysqli_query($db,"INSERT INTO rubric_has_photo VALUES ('','$id_photo','$valeur');")or die(mysqli_error($db));
                            }
                        }
                    }

                }else{
                    $upload= 'Erreur lors de la création des images redimenssionnées';
                }

            }    
        }
        //LES AFFICHAGES (SELECTS)
        
        //AFFICHAGE classique page espace client
        if(!isset($_GET['a'])){
            $req=select("photo as p",
                                    "p.id, p.name, p.title, p.text, p.extention, p.user_id, GROUP_CONCAT(r.id) AS rubid, GROUP_CONCAT(r.title) AS rubric_title",
                                    "LEFT JOIN rubric_has_photo AS rp ON rp.photo_id=p.id
                                    LEFT JOIN rubric AS r ON r.id = rp.rubric_id
                                    WHERE p.user_id=".$_SESSION['id']."
                                    GROUP BY p.id
                                    ORDER BY p.id DESC
                                    ");
            
            $nombre_images = !is_string($req)? mysqli_num_rows($req):0;
           
            $limit_a=isset($_GET['pg'])?($_GET['pg']-1)*$nombre_images_page:0;
            $limit_b=$nombre_images_page;
            
            $images_affiche= select("photo as p",
                                    "p.id, p.name, p.title, p.text, p.extention, p.user_id, GROUP_CONCAT(r.id) AS rubid, GROUP_CONCAT(r.title) AS rubric_title",
                                    "LEFT JOIN rubric_has_photo AS rp ON rp.photo_id=p.id
                                    LEFT JOIN rubric AS r ON r.id = rp.rubric_id
                                    WHERE p.user_id=".$_SESSION['id']."
                                    GROUP BY p.id
                                    ORDER BY p.id DESC
                                    LIMIT ".$limit_a.",".$limit_b."
                                    ");
        }
        //AFFICHAGE administration/modération
        else if($_SESSION['permit_id']<3){
            $req = select("photo as p",
                                    "p.id, p.name, p.title, p.text, p.extention, p.user_id, GROUP_CONCAT(r.id) AS rubid, GROUP_CONCAT(r.title) AS rubric_title",
                                    "LEFT JOIN rubric_has_photo AS rp ON rp.photo_id=p.id
                                    LEFT JOIN rubric AS r ON r.id = rp.rubric_id
                                    GROUP BY p.id
                                    ORDER BY p.id DESC
                                    ");
            $nombre_images = !is_string($req)? mysqli_num_rows($req):0;
           
            $limit_a=isset($_GET['pg'])?($_GET['pg']-1)*$nombre_images_page:0;
            $limit_b=$nombre_images_page;
            
            $images_affiche= select("photo as p",
                                    "p.id, p.name, p.title, p.text, p.extention, p.user_id, GROUP_CONCAT(r.id) AS rubid, GROUP_CONCAT(r.title) AS rubric_title",
                                    "LEFT JOIN rubric_has_photo AS rp ON rp.photo_id=p.id
                                    LEFT JOIN rubric AS r ON r.id = rp.rubric_id
                                    GROUP BY p.id
                                    ORDER BY p.id DESC
                                    LIMIT ".$limit_a.",".$limit_b."
                                    ");    
            
        }
        $sections=[];
        $recup_section= select("rubric", "*", "");
        while($ligne = mysqli_fetch_assoc($recup_section)){
            $sections[$ligne['id']]=$ligne['title'];
        }
    }
    include_once 'view/espace-client.php';

