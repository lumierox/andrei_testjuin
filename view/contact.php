<div class="content">
    <div id="form_contact">
        <form method="post" name="form_contact">
            
            <label for="nom">Votre nom:</label>
            <input type="text" id="nom" name="nom" required><br><br>
            
            <label for="prenom">Votre prenom:</label>
            <input type="text" id="prenom" name="prenom" required><br><br>
            
            <SELECT name="titre" size="1" required>
                <OPTION value="">Votre Titre:
                <OPTION value="Mr">Mr
                <OPTION value="Mme">Mme
                <OPTION value="Melle">Melle
            </SELECT><br><br>
            
            <label for="email">Votre email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="message">Votre message:</label>
            <textarea id="message" name="text" maxlength="500" required></textarea><br>
            <span id="compteur"></span><br>
            <span class="message"><?php print isset($message) ? $message: '' ;?></span><br><br>
            <input type="submit" name="contact_form" value="Envoyer">
        </form>
    </div>
</div>
