<?php
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
                header('Location: ?menu=espace-client');
                exit;
            }else{
                $delete = "Suppression échouée.";
            }  
        }
    }
    
    $edit='';
    if(isset($_GET['update'])){
        $user_id=$_GET['id'];
        $image_id=$_GET['update'];
        if($user_id==$_SESSION['id'] || $_SESSION['permit_id']<3){
            //update($table, $condition);
        }
    }
    
    $upload = '';
    // si on a envoyÃ© le formulaire et qu'un fichier est bien attachÃ©
    if(isset($_POST['letitre'])&&isset($_FILES['lefichier'])){

        // traitement des chaines de caractÃ¨res
        $letitre = traite_chaine($_POST['letitre']);
        $ladesc = traite_chaine($_POST['ladesc']);

        // rÃ©cupÃ©ration des paramÃ¨tres du fichier uploadÃ©
        $limage = $_FILES['lefichier'];

        // appel de la fonction d'envoi de l'image, le rÃ©sultat de la fonction est mise dans la variable $upload
        $upload = upload_originales($limage,$dossier_ori,$formats_acceptes);

        // si $upload n'est pas un tableau c'est qu'on a une erreur
        if(!is_array($upload)){
            ////affichage dans la view

        // si on a pas d'erreur, on va insÃ©rer dans la db et crÃ©er la miniature et grande image   
        }else{
            //var_dump($upload);
            // crÃ©ation de la grande image qui garde les proportions
            $gd_ok = creation_img($dossier_ori, $upload['nom'],$upload['extension'],$dossier_gd,$grande_large,$grande_haute,$grande_qualite);

            // crÃ©ation de la miniature centrÃ©e et coupÃ©e
            $min_ok = creation_img($dossier_ori, $upload['nom'],$upload['extension'],$dossier_mini,$mini_large,$mini_haute,$mini_qualite,false);

            // si la crÃ©ation des 2 images sont effectuÃ©es
            if($gd_ok==true && $min_ok==true){
                //var_dump($_POST);
                // prÃ©paration de la requÃªte (on utilise un tableau venant de la fonction upload_originales, de champs de formulaires POST traitÃ©s et d'une variable de session comme valeurs d'entrÃ©e)
                $sql= "INSERT INTO photo (name,extention,weight,height,width,title,text,user_id) 
            VALUES ('".$upload['nom']."','".$upload['extension']."',".$upload['poids'].",".$upload['hauteur'].",".$upload['largeur'].",'$letitre','$ladesc',".$_SESSION['id'].");";

                mysqli_query($db,$sql) or die($upload = mysqli_error($db));

                // rÃ©cupÃ©ration de la derniÃ¨re id insÃ©rÃ©e par la requÃªte qui prÃ©cÃ¨de (dans photo par l'utilisateur actuel)
                $id_photo = mysqli_insert_id($db);

                // vÃ©rification de l'existence des sections cochÃ©es dans le formulaire
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
    
    $images_affiche= select("photo as p",
                            "p.id, p.name, p.title, p.text, p.extention, p.user_id, GROUP_CONCAT(r.title SEPARATOR '|||') AS rubric_title",
                            "LEFT JOIN rubric_has_photo AS rp
                            ON p.id = rp.photo_id
                            LEFT JOIN rubric AS r
                            ON rp.photo_id = r.id
                            WHERE p.user_id=".$_SESSION['id']."
                            GROUP BY p.id
                            ORDER BY p.id DESC
                            ");
    
    $recup_section= select("rubric", "*", "");
    
    include_once 'view/espace-client.php';

