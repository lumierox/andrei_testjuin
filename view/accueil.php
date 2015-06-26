<div class="content">
    <div id="images_affiche">
        <?php
            if(!is_string($images_affiche)){
                $images_ok="";
                while($image = mysqli_fetch_assoc($images_affiche)){
                    $images_ok .= "<div class='image'>
                                <h4>".$image['title']."</h4>
                                <img class='petite' src='$dossier_mini".$image['name'].'.'.$image['extention']."' title='".$image['title']."' name='".$image['title']."' data-url='$dossier_gd".$image['name'].".".$image['extention']."'>
                                <p>".$image['text']."</p>";
                    /*$images_ok.= "<span clas='image_categorie'>";
                    $images_ok.= is_null($image['rubric_title'])? 'Aucune Catégorie.' : $image['rubric_title'];    
                    $images_ok.= "</span><br>";*/
                    $images_ok.= "<span class='image_user_login'>".$image['login']."</span>" ;
                    $images_ok.= "</div>";
                }
                print $images_ok;
            }
            else print $images_affiche;
        ?>
    </div>
</div>
