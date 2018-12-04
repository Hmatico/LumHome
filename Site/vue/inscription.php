<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" media="screen and (min-width: 1100px)" href="./css/styleG.css" />
        <link rel="stylesheet" media="screen and (min-width: 650px) and (max-width: 1100px)" href="./css/styleM.css" />
        <link rel="stylesheet" media="screen and (max-width: 650px)" href="./css/styleP.css" />
        <link rel="stylesheet" href="./css/style.css" />
        <title>LumHome - Inscription</title>
    </head>
    <body>
        <nav class="banner">
            <div class="vert-align">
                <a href=#>
                    <img src="./resources/logo.png" class="logo vert-align" alt="Logo LumHome">
                </a>
            </div>
            <a class="go_back" href="./accueil.html">
                <div class="submenu_i">Retourner à la page d'accueil / Annuler l'inscription</div>
            </a>
        </nav>
        <div class="navigation">
            <img src="./resources/maj.png" alt="">
            <a class="histo_site" href="./vue/accueil.html">Accueil</a>
            >
            <a class="histo_site" href="">Page d'inscription</a>
        </div>
        <div class="body_container">
            <form id="inscription_form">
                <div class="p_data">
                    <div class="text_i">
                        Inscrivez-vous :
                    </div>
                    <div class="input_pdata">
                        <input class="pdata_colg"  type="text" id="nom" placeholder="Nom">
                        <input class="pdata_cold" type="text" id="prenom" placeholder="Prénom">
                        <input class="pdata_colg" type="text" id="email" value="<?php echo $email; ?>" placeholder="Adresse email">
                        <input class="pdata_cold" type="text" id="emailc" placeholder="Confirmer votre adresse email">
                        <input class="pdata_colg" type="password" id="pwd" value="<?php echo $pwd; ?>" placeholder="Mot de passe">
                        <input class="pdata_cold" type="password" id="pwdc" placeholder="Confirmer votre mot de passe">
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
                        <input class="adata_colg" type="text" id="nrue" placeholder="Numéro de rue">
                        <input class="adata_cold" type="text" id="nomrue" placeholder="Nom de la rue">
                        <input class="adata_colg" type="text" id="cpostal" placeholder="Code postal">
                        <input class="adata_cold" type="text" id="ville" placeholder="Ville"><br>
                        <textarea class="adata_textaera" rows="4" cols="50" id="complement" placeholder="Complément d'adresse..."></textarea>
                    </div>
                </div>
                <div class="c_data">
                    <div class="text_i">
                        Entrez vos données bancaires :
                    </div>
                    <div class="input_cdata">
                        <input type="text" id="ncarte" placeholder="Numéro de carte">
                        <input type="text" id="expiration" placeholder="Date d'expiration">
                        <input type="text" id="crypto" placeholder="Cryptogramme visuel">
                    </div>
                </div>
                <div class="form_btn">
                    <input class="button" value="Valider l'inscription">
                </div>
            </form>
        </div>
    </body>
    <script type="text/javascript" src="./javaScript/front.js"></script>
    <script type="text/javascript" src="./javaScript/back.js"></script>
</html>