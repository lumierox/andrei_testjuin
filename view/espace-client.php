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
                        while($ligne = mysqli_fetch_assoc($recup_section)){
                            print $ligne['title']." : <input type='checkbox' name='section[]' value='".$ligne['id']."' >  ";
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
                /////////////////
                ///////////////// A TRAVAILLER le 2eme WHILE+ les categories (rubric)
                
                    if(!is_string($images_affiche)){
                        while($image = mysqli_fetch_assoc($images_affiche)){
                            print "<div class='image'>
                                        <h4>".$image['title']."</h4>
                                        <img src='$dossier_mini".$image['name'].'.'.$image['extention']."' title='".$image['title']."' name='".$image['title']."'>
                                        <p>".$image['text']."</p>
                                        <span>";
                                   is_null($image['rubric_title'])? print 'Aucune Catégorie.' : print $image['rubric_title'];    
                                   print "</span><br>
                                        <img src='images/delete.png' title='Supprimer' name='Supprimer' data-title='".$image['title']."' data-image_id='".$image['id']."' data-user_id='".$image['user_id']."' data-name='".$image['name'].'.'.$image['extention']."'>
                                        <img src='images/edit.png' title='Modifier' name='Modifier'>
                                   </div>";
                            print "<form method='post'>
                                    <input type='text' name='letitre' value='".$image['title']."' required /><br/>
                                    <textarea name='ladesc' required>".$image['text']."</textarea><br/>
                                    Sections:";
                            while($ligne = mysqli_fetch_assoc($recup_section)){
                                print 'alo';
                                $check=($lige['title']==$image['rubric_title'])? 'checked':'';
                                print $ligne['title']." : <input type='checkbox' name='section[]' value='".$ligne['id']."' $check>";
                            }
                            print "</form>
                                ";      
                        }
                    }
                    else print $images_affiche;
                    
                ?>
            </div>
            <hr>
    <?php   
        endif;
    ?>
    
</div>
