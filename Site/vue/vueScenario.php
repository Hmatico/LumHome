<!DOCTYPE html>
<html>
  <head>
    <title>Titre</title>
    <meta charset="utf-8"/>
      <link rel="stylesheet" href="./vue/styleScenario.css"/>
      <script type="text/javascript" src="./vue/jquery.js"></script>

  </head>
  <body>


 <div class=scenario_gestion>
            <table>
                <tr>
                    <td>Nom du scénario</td>
                    <td>Type de scénario</td>
                    <td>Etat</td>
                </tr>



            </table>

            <div>
                <button><a href="scenario.html">Ajouter un scénario</a></button>

            </div>
        </div>
        <div class="separator"></div>
        <div class="scenario_description">
            <h3>Description</h3>
            <div class="bloc">
                <span id=type_description>Ambiance lumineuse :</span>
                <span id=type_description_detail> Alternez les couleurs de l'éclairage entre plusieurs couleurs sélectionnées.</span>
            </div>
            <br/>
            <div class="bloc">
                <span id=scenario_description>
                    Scénario de Noël : Scintillez aux couleurs de Noël : rouge, vert, blanc : les rennes du Père Noël retrouveront plus facilement votre maison !
                </span>
            </div>

            <div class="scenario_parameters">
                <div id="temp_parameters">
                    <h4>Horaires :</h4>
                    <span id=horBegin>20:00</span>
                    <span> à </span>
                    <span id=horEnd>00:00</span>
                    <h4>Répétitions :</h4>
                    <input type="checkbox" name="monday" checked >Lundi<br/>
                    <input type="checkbox" name="tuesday" unchecked >Mardi<br/>
                    <input type="checkbox" name="wednesday" checked >Mercredi<br/>
                    <input type="checkbox" name="thursday" unchecked >Jeudi<br/>
                    <input type="checkbox" name="friday" unchecked >Vendredi<br/>
                    <input type="checkbox" name="saturday" unchecked >Samedi<br/>
                    <input type="checkbox" name="sunday" checked >Dimanche<br/>
                </div>
                <div id="other_parameters">
                    <h4>Couleurs utilisées :</h4>
                    <div class="used_color">
                        <span class="color"></span>
                        <span class="color_val">#FF0000</span>
                    </div>
                    <div class="used_color">
                        <span class="color"></span>
                        <span class="color_val">#00FF00</span>
                    </div>
                    <div class="used_color">
                        <span class="color"></span>
                        <span class="color_val">#0000FF</span>
                    </div>
                    <div class="used_color">
                        <span class="color"></span>
                        <span class="color_val">#FF00FF</span>
                    </div>
                    <h4>Intensité Lumineuse : </h4>
                    <div><span id=lum>70%</span></div>
                </div>
            </div>

            <div class="buttons">
                <button id="mod_scenario">Modifier ce scénario</button>
            </div>

        </div>


    <button id="btnTest">
        Bouton de test
    </button>
    <button id="btnTest2">
        Bouton de test 2
    </button>

    <script type="text/javascript" src="./vue/back.js"></script>
  </body>

</html>
