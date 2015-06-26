<div class="content">
    <?php 
        if(isset($_SESSION['login'])):?>
    
            <div id="formulaire">
                <h3>Formulaire d'insertion d'images:</h3>
                <p>Description formulaire d'insertion d'images [...]</p>
                <form enctype="multipart/form-data" method="POST" name="onposte">
                    <input type="text" name="letitre" required /><br/>
                    <input type="file" name="lefichier" required /><br/>
                    <textarea name="ladesc" required=""></textarea><br/>

                    <input type="submit" value="Envoyer le fichier" /><br/>
                    Sections : 
                    <?php
                        foreach ($sections as $key => $value){
                            print $value." : <input type='checkbox' name='section[]' value='".$key."' >  ";
                        }
                    ?>
                </form>
                <span class="message">
                <?php 
                    is_string($upload)? print $upload : print "Envoie d'image réussi.";
                    is_string($upload)? print  $delete : '';
                    is_string($upload)? print  $edit : '';
                ?>
                </span>
                <hr>
            </div>
            <div id="images_affiche">
                <?php
                    print pagination($nombre_images, isset($_GET['pg'])?$_GET['pg']:1);
                    print '<br>';
                    if(!is_string($images_affiche)){
                        $images_ok="";
                        while($image = mysqli_fetch_assoc($images_affiche)){
                            $images_ok .= "<div class='image'>
                                        <h4>".$image['title']."</h4>
                                        <img class='petite' src='$dossier_mini".$image['name'].'.'.$image['extention']."' title='".$image['title']."' name='".$image['title']."' data-url='$dossier_gd".$image['name'].".".$image['extention']."'>
                                        <p>".$image['text']."</p>
                                        <span>";
                            $images_ok.= is_null($image['rubric_title'])? 'Aucune Catégorie.' : $image['rubric_title'];    
                            $images_ok.= "</span><br>";
                            $images_ok.= isset($_GET['a'])&&$_SESSION['permit_id']!=1?"":"<img src='images/delete.png' title='Supprimer' name='Supprimer' data-title='".$image['title']."' data-image_id='".$image['id']."' data-user_id='".$image['user_id']."' data-name='".$image['name'].'.'.$image['extention']."'>";
                            $images_ok.= isset($_GET['a'])&&$_SESSION['permit_id']>2?"":"<img src='images/edit.png' title='Modifier' name='Modifier'>";
                            $images_ok.= "</div>";
                            $images_ok.= "<form method='post'>
                                    <legend><b>Modification image:</b></legend>
                                    <input type='hidden' name='id' value='".$image['id']."'>
                                    <input type='hidden' name='user_id' value='".$image['user_id']."'>
                                    <input type='text' name='titre' value='".$image['title']."' required /><br/>
                                    <textarea name='desc' required>".$image['text']."</textarea><br/>
                                    ";
                            $recup_section2= select("rubric", "*", "");
                            foreach ($sections as $key => $value) {
                                $check =(in_array($value, explode(',',$image['rubric_title'])))? 'checked':'';
                                $images_ok.= $value." : <input type='checkbox' name='section[]' value='".$key."' $check><br>";
                            }
                            $images_ok.= "<input name='edit' type='submit' value=\"Modifier l'image\">
                                         </form>";      
                        }
                        print $images_ok;
                    }
                    else print $images_affiche;
                    print '<br>';
                    print pagination($nombre_images, isset($_GET['pg'])?$_GET['pg']:1);
                    
                ?>
            </div>
            <hr>
    <?php   
        endif;
    ?>
    
</div>
