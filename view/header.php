<div class="header">
    <h1> 
        Télépro-photos.fr
        <?php 
            if(isset($_GET['menu'])){
                print ' - '.ucfirst($_GET['menu']);
            }
        ?>
    </h1>
    <nav>
        <ul>
            <li><a href="./">Accueil</a></li>
            <li>Catégories
                <ul>
                    <?php
                        while($rubric = mysqli_fetch_assoc($menu)){
                            $rubric_table[$rubric['url']]=$rubric['title'];
                            print "<li><a href='?menu=".$rubric['url']."'>".$rubric['title']."</a></li>";
                        }
                    ?>
                </ul>
            </li>
            <li><a href="?menu=contact">Nous Contacter</a></li>
            <li><a href="?menu=espace-client">Espace Client</a></li>


        </ul>
        
    </nav>
    <?php if(!isset($_SESSION['login'])):?>
        <form action="" method="POST">
            <input name="user" type="text" placeholder="Utilisateur" required=""><br>
            <input name="password" type="password" placeholder="Mot de passe" required=""><br>
            <input type="submit" value="S'identifier">
        </form>
    <?php else: ?>
    <a href="./includes/logout.php" class="deco">Déconnexion</a>
    <?php endif; ?>
    
    <br>
    
    <?php
        if(isset($_GET['menu'])){
            //titre page pour l'accueil, contact, espace client
            foreach($rubric_table as $key => $value){
                if($key==$_GET['menu']){
                    isset($_SESSION['login']) ? print '<h2>Catégorie '.$value.' - Bienvenue '.$_SESSION['name'].', vous êtes connecté en tant que '.$_SESSION['perm_name'].'</h2>' 
                                    : print '<h2>Bienvenue sur la catégorie: '.$value.' sur Telepro-photos.fr</h2>';
                }
            }
            //titre page pour les catégories
            switch($_GET['menu']){

                case 'contact':isset($_SESSION['login']) ? print '<h2>Contact - Bienvenue '.$_SESSION['name'].', vous êtes connecté en tant que '.$_SESSION['perm_name'].'</h2>' 
                                    : print '<h2>Bienvenue sur la page de contact sur Telepro-photos.fr</h2>';
                break;
                case 'espace-client':isset($_SESSION['login']) ? print '<h2>Espace Client -  Bienvenue '.$_SESSION['name'].', vous êtes connecté en tant que '.$_SESSION['perm_name'].'</h2>' 
                                    : print '<h2>Bienvenue sur la page Espace Client sur Telepro-photos.fr</h2>';
                break;
            }
        }
        else{
            print '<h2>Bienvenue sur Telepro-photos.fr</h2>';
        }
        
    ?>
</div>