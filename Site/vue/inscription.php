<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" media="screen and (min-width: 1100px)" href="./vue/css/styleG.css" />
        <link rel="stylesheet" media="screen and (min-width: 650px) and (max-width: 1100px)" href="./vue/css/styleM.css" />
        <link rel="stylesheet" media="screen and (max-width: 650px)" href="./vue/css/styleP.css" />
        <link rel="stylesheet" href="./vue/css/style.css" />
        <title>LumHome - Inscription</title>
    </head>
    <body>
        <nav class="banner">
            <div class="vert-align">
                <a href=#>
                    <img src="./vue/resources/logo.png" class="logo vert-align" alt="Logo LumHome">
                </a>
            </div>
            <a class="go_back" href="./vue/accueil.html">
                <div class="submenu_i">Retourner à la page d'accueil / Annuler l'inscription</div>
            </a>
        </nav>
        <div class="navigation">
            <img src="./vue/resources/maj.png" alt="">
            <a class="histo_site" href="./vue/accueil.html">Accueil</a>
            >
            <a class="histo_site" href="">Page d'inscription</a>
        </div>
        <div class="body_container">
            <form action="#" method="get">
                <div class="p_data">
                    <div class="text_i">
                        Inscrivez-vous :
                    </div>
                    <div class="input_pdata">
                        <input class="pdata_colg"  type="text" name="nom" placeholder="Nom">
                        <input class="pdata_cold" type="text" name="prenom" placeholder="Prénom">
                        <input class="pdata_colg" type="text" name="email" value="<?php echo $email; ?>" placeholder="Adresse email">
                        <input class="pdata_cold" type="text" name="emailc" placeholder="Confirmer votre adresse email">
                        <input class="pdata_colg" type="password" name="pwd" value="<?php echo $pwd; ?>" placeholder="Mot de passe">
                        <input class="pdata_cold" type="password" name="pwdc" placeholder="Confirmer votre mot de passe">
                    </div>
                    <div>
                        <div>
                        </div>
                        <div class="text_erreur">
                            Le mot de passe doit être constitué d'au moins huit caractères,
                            dont une majuscule, une minuscule, une chiffre et un caractère spécial au minimum.
                        </div>
                    </div>                    
                </div>
                <div class="a_data">
                    <div class="text_i">
                        Entrez l'adresse à laquelle vous voulez être facturé :
                    </div>
                    <div class="input_adata">
                        <input class="adata_colg" type="text" name="nrue" placeholder="Numéro de rue">
                        <input class="adata_cold" type="text" name="nomrue" placeholder="Nom de la rue">
                        <input class="adata_colg" type="text" name="cpostal" placeholder="Code postal">
                        <input class="adata_cold" type="text" name="ville" placeholder="Ville"><br>
                        <textarea class="adata_textaera" rows="4" cols="50" name="complement" placeholder="Complément d'adresse..."></textarea>
                    </div>
                </div>
                <div class="c_data">
                    <div class="text_i">
                        Entrez vos données bancaires :
                    </div>
                    <div class="input_cdata">
                        <input type="text" name="ncarte" placeholder="Numéro de carte">
                        <input type="text" name="expiration" placeholder="Date d'expiration">
                        <input type="text" name="crypto" placeholder="Cryptogramme visuel">
                    </div>
                </div>
                <div class="form_btn">
                    <input type="button" class="button" value="Valider l'inscription">
                </div>
            </form>
        </div>
    </body>
</html>