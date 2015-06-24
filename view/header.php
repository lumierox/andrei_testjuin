<div class="header">
    <h1> 
        Télépro-photos.fr 
        <?php 
            if(isset($_GET['menu'])){
                print '- '.ucfirst($_GET['menu']);
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
            <input name="user" type="text" placeholder="Utilisateur" required="">
            <input name="password" type="password" placeholder="Mot de passe" required="">
            <input type="submit" value="S'identifier">
        </form>
    <?php else: ?>
    <a href="./includes/logout.php">Déconnexion</a>
    <?php endif; ?>
    
    <div style="clear:both"></div>
    
    <?php
        isset($_SESSION['login']) ? print 'Bienvenue '.$_SESSION['name'].', vous êtes connecté en tant que '.$_SESSION['perm_name'] 
                                : print 'Bienvenue sur Telepro-photos.fr';
    ?>
</div>