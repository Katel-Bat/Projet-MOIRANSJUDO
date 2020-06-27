<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>

<body>
<h2>Adhésion</h2>
<p>Remplir pas à pas les diverses sections</p>

<div class="tab">
  <button class="tablinks" onclick="openSection(event, 'Resp')" id="defaultOpen">Responsable Légal</button>
</div>

<div id="Resp" class="tabcontent">
    <form id="formResp" name="formulaire">
        <fieldset>
            <legend>Responsable Légal</legend>
            <table>
                <tr>
                    <td>
                        Nom du responsable légal :
                    </td>
                    <td>
                        <input type="text" name="nomRespLegal" placeholder="Robert Dupont" maxlength="70" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Adresse :
                    </td>
                    <td>
                        <input type="text" name="adresse" placeholder="Exemple : 6 rue des Champs Elysées"
                            maxlength="256" style="width:300px;" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Code postal :
                    </td>
                    <td>
                        <input type="text" name="cp" placeholder="Exemple : 75000" maxlength="5" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Ville :
                    </td>
                    <td>
                        <input type="text" name="ville" placeholder="PARIS" maxlength="30" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Numéro de téléphone :
                    </td>
                    <td>
                        <input type="tel" name="tel" placeholder="Exemple : 0123456789" maxlength="10" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        E-mail :
                    </td>
                    <td>
                        <input type="email" name="mail" placeholder="email@exemple.fr" maxlength="100" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Combien d'adhérent(s) souhaitez vous inscrire ?
                    </td>
                    <td>
                        <select name="nbadherents" id="nbadherents">
                            <option value="0">-Sélectionner-</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input type="button" onclick="generateAdh(), parseResp()" value="Valider"/>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
<div id="ongletsAdh"></div>
<div id="contenuAdh">
</div>
<button class="tablinks" onclick="openSection(event, 'Recap')">Récapitulatif</button>
<div id="Recap" class="tabcontent">
    <h3>Récapitulatif</h3>
    <p>SAISIE ...</p>
</div>
</body>
<script src="formulaire.js"></script> 
</html>