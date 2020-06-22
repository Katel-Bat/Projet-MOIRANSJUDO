<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Test</title>
</head>

<body>
<h2>Adhésion</h2>
<p>Remplir pas à pas les diverses sections</p>

<div class="tab">
  <button class="tablinks" onclick="openSection(event, 'Resp')" id="defaultOpen">Responsable Légal</button>
</div>

<div id="Resp" class="tabcontent">
    <form id="formulaire" name="formulaire">
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
                        <select name="adherents" id="input_adherents" onchange="generateAdh(this)">
                            <option value="0">-Sélectionner-</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <input type="button" onclick="parseForms()" value="bouton inutile pour le moment"/>
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

<script> 
    //Collection des adhérents
    let adhList = []
    //fichier à part pour la classe
    class adherent {

        constructor(_majeur, _certif, _nom, _prenom, _sexe, _dn, _etatJudo, _cat, _cours){
            this.majeur = _majeur;
            this.certif = _certif;
            this.nom = _nom;
            this.prenom = _prenom;
            this.sexe = _sexe;
            this.dn= _dn;
            this.etatJudo = _etatJudo;
            this.cat = _cat;
            this.cours = _cours;
        }
    }
    //===================================================================== affichage des divers onglets =====================================================================
    // Récupérer l'élément avec l'id "defaultOpen"/ la première étape du formulaire : le responsable légal et clique dessus
    document.getElementById("defaultOpen").click();

    function openSection(evt, ongletSelection) {
        // L'id de ce qui doit être affiché doit correspondre à ongletSelection dans les div
        var i, tabcontent, tablinks;  
        // tablinks : les onglets à cliquer pour l'affichage 
        // tabcontent : le contenu de l'affichage après le clic
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none"; 
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(ongletSelection).style.display = "block";
        evt.currentTarget.className += " active";
    }
    // =========================================================== génération des sections pour les adhérents ========================================================================
    // Récupère la valeur du select dans la section responsable légal et en fonction créée en HTML les onglets, et les formulaires en nombre adaptés
    // Les id sont récupérables grâce à l'incrémentation ${i+1} dans les boucles for
    function generateAdh(select){
        let div_adh = document.getElementById("ongletsAdh")
        div_adh.innerHTML = ""
        let div_aff = document.getElementById("contenuAdh")
        div_aff.innerHTML = ""
        let value = select.options[select.selectedIndex].value 
        for (let i = 0; i < value; i++) {
            // onglets
            div_adh.innerHTML += `
            <button class="tablinks" onclick="openSection(event, 'Adh${i+1}')">Adhérent ${i+1}</button><br>
            `
            // formulaires
            div_aff.innerHTML +=`
            <div id="Adh${i+1}" class="tabcontent" style="display : none;">
                <form id="form${i+1}" method="post" action="getData.php"  id="formAdh">
                    <fieldset>
                        <legend>Adhérent ${i+1}</legend>
                        <table>
                            <tr>
                                <td>
                                    Nom :
                                </td>
                                <td>
                                    <input type="text" name="nom${i+1}" id="nom${i+1}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Prenom :
                                </td>
                                <td>
                                    <input type="text" name="prenom${i+1}" id="prenom${i+1}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Sexe : 
                                </td>
                                <td>
                                    Femme <input type="radio" name="sexe${i+1}" id="sexe${i+1}" value="0">
                                </td>
                                <td>
                                    Homme <input type="radio" name="sexe${i+1}" id="sexe${i+1}" value="1">
                                </td>
                            <tr>
                                <td>
                                    Date de naissance :
                                </td>
                                <td>
                                    <input type="date" name="dn" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Rapport avec le club de Judo : 
                                </td>
                                <td>
                                    Nouveau Judoka <input type="radio" name="reinoujudo${i+1}" id="reinoujudo${i+1}" value="1">
                                </td>
                                <td>
                                    Réinscription <input type="radio" name="reinoujudo${i+1}" id="reinoujudo${i+1}" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Ceinture précédente : 
                                </td>
                                <td>
                                    <select name="ceinturePrecedente" id="ceinturePrecedente">
                                        <option value="Blanche">Blanche</option>
                                        <option value="BlancheJaune">Blanche/Jaune</option>
                                        <option value="Jaune">Jaune</option>
                                        <option value="JauneOrange">Jaune/Orange</option>
                                        <option value="Orange">Orange</option>
                                        <option value="OrangeVerte">Orange/Verte</option>
                                        <option value="Verte">Verte</option>
                                        <option value="Bleue">Bleue</option>
                                        <option value="Marron">Marron</option>
                                        <option value="Noire">Noire</option>
                                        <option value="RougeBlanche">Rouge/Blanche</option>
                                        <option value="Rouge">Rouge</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    L'adhérent est majeur :
                                </td>
                                <td>
                                    Oui <input type="radio" name="majeur${i+1}" id="majeur${i+1}" onclick="generateAttest(this, ${i+1})" value="1">
                                </td>
                                <td>
                                    Non <input type="radio" name="majeur${i+1}" id="majeur${i+1}" onclick="generateAttest(this, ${i+1})" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div id="attestMineur${i+1}"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Date du certificat médical : 
                                </td>
                                <td>
                                    <input type="date" name="certif${i+1}" id="certif${i+1}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div id="certificat${i+1}"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Je dispose d'un passeport Judo: 
                                </td>
                                <td>
                                    Oui <input type="radio" name="passeport${i+1}" id="passeport${i+1}" value="1">
                                </td>
                                <td>
                                    Non <input type="radio" name="passeport${i+1}" id="passeport${i+1}" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Cours : 
                                </td>
                                <td>
                                    <div id="contenuCours${i+1}"></div>
                                </td>
                            </tr>
                        </table>
                        <input type="button" onclick="openSection(event,'Adh${i+2}')" value="Valider l'Adhérent ${i+1}">
                        <input type="button" onclick="parseForms(${i+1})"  value="bouton parse"/>
                    </fieldset>
                </form>
            </div>
            `
        }
    }
    function generateCours(select, ic){
        let div_cours = document.getElementById(`contenuCours${ic}`)
        div_cours.innerHTML = ""
        let value = select.options[select.selectedIndex].value 
        if (value == "Prejudo") {
            div_cours.innerHTML=`
            <select name="coursSelect" id="coursSelect">
                <option value="Sam10h30a11h15">Le samedi de 10h30 à 11h15</option>
                <option value="Sam11h15a12h">Le samedi de 11h15 à 12h00 </option>
                <option value="Ven16h30à17h15">Le vendredi de 16h30 à 17h15</option>
            </select>
            `
        }else if (value == "MiniPoussin"){
            div_cours.innerHTML=`
            <select name="coursSelect" id="coursSelect">
                <option value="MarJeu16h45a17h45">Le mardi et jeudi 16h45-17h45</option>
                <option value="Mer17h30a18h30Ven17h15a18h15">Le mercredi 17h30-18h30 et vendredi 17h15-18h15</option>
            </select>
            `
        }else if (value == "Poussin"){
            div_cours.innerHTML=`
            <select name="coursSelect" id="coursSelect">
                <option value="MarJeu17h45a18h45">Le mardi et jeudi 17h45-18h45</option>
                <option value="Mer17h30a18h30Ven17h15a18h15">Le mercredi 17h30-18h30 et vendredi 17h15-18h15</option>
            </select>
            `
        }else if (value == "Benjamin"){
            div_cours.innerHTML=`
            <select name="coursSelect" id="coursSelect">
                <option value="Mer18h30a19h30Ven18h15a19h15">Le mercredi 18h30-19h30 et vendredi 18h15-19h15</option>
            </select>
            `
        }else if (value == "MinimeCadetCompetition"){
            div_cours.innerHTML=`
            <select name="coursSelect" id="coursSelect">
                <option value="MarJeu18h45a20h15">Le mardi et jeudi 18h45-20h15</option>
            </select>
            `
        }else if (value == "AdulteJudoLoisir"){
            div_cours.innerHTML=`
            <select name="coursSelect" id="coursSelect">
                <option value="Ven19h15a19h45">Le vendredi 19h15-19h45 accès tapis libre</option>
                <option value="Ven19h45a21h">Le vendredi 19h45-21h cours</option>
            </select>
            `
        }else {
            div_cours.innerHTML=`
            <select name="coursSelect" id="coursSelect">
                <option value="Mer19h30a21h">Le mercredi 19h30-21h</option>
            </select>
            `
        }
    }
    function generateAttest(radio, val){
        let div_attest=document.getElementById(`attestMineur${val}`)
        div_attest.innerHTML = ""
        let value = radio.value 
        if (value == 0){
            div_attest.innerHTML = `
            <tr>
                <td>
                    Je soussigné représentant légal de l’enfant dont le nom est inscrit ci-dessus autorise mon 
                    enfant à participer aux activités de Moirans Judo pour la saison 2020/2021. En cas d’urgence, j'autorise, 
                    pour mon enfant, toute intervention médicale qui pourrait s'avérer nécessaire.<br>
                   J'accepte <input type="checkbox" name="accepte" id="form_accepte">
                </td>
            </tr>
            `
        }
    }
    // =========================================================================================== stockage des éléments du formulaire =========================================
    
    /*
    // tester écriture sur la base. 
    // séparer les fichiers
    // afficher le recap        
    // voir l'option submit (validation de toutes les parties du formulaire)

    manque : 
        - checkbox j'accepte si pas majeur
        - checkbox j'atteste avoir rep par la neg AQS 
        - select ceinture précédente 
        - select cours
    */

    // for i = 0; i<nbadh; i++  // + verif ? 
    function parseForms(val_i){ 
        //Réinitialisation de la liste 
        let adhList = []
        let radioMajeur = document.getElementsByName(`majeur${val_i}`);
        let majeur;
        for (let i = 0; i < radioMajeur.length; i++) {
            if (radioMajeur[i].checked) {
                majeur = radioMajeur[i].value
            }
        }
        console.log('majeur') 
        console.log(majeur)

        let radioSexe = document.getElementsByName(`sexe${val_i}`);
        let sexe;
        for (let i = 0; i < radioSexe.length; i++) {
            if (radioSexe[i].checked) {
                sexe = radioSexe[i].value
            }
        }
        console.log('sexe') 
        console.log(sexe)

        let radioEtatJudo = document.getElementsByName(`reinoujudo${val_i}`);
        let etatJudo;
        for (let i = 0; i < radioEtatJudo.length; i++) {
            if (radioEtatJudo[i].checked) {
                etatJudo = radioEtatJudo[i].value
            }
        }
        console.log('etatJudo') 
        console.log(etatJudo)
        //  3è 4è et 6è valeurs d'adherent
        //Récupération de tous les objets <Form> dans une liste
        let forms = document.getElementById(`form${val_i}`).children
        console.log(forms)
        let todayDate = new Date()
        let todayYear = todayDate.getFullYear() // 2020 : number
        let todayMonth = (todayDate.getMonth())+1
        console.log('todayMonth')
        console.log(todayMonth)
        let todayDay = todayDate.getDate()
        console.log(todayDay)
        todayYear = todayYear.toString()
        todayMonth = todayMonth.toString()
        todayDay = todayDay.toString()
        let dateoftoday = todayYear + "-" + todayMonth + "-" + todayDay
        for (let i = 0; i < forms.length; i++) {
            //Récupération des balises input dans le form
            let form = forms[i].getElementsByTagName("input");
            // Récupération des données contenues dans les input
            let nom = form[0].value
            let prenom = form[1].value 
            let dateNaissance = form[4].value
            anneeNaissance = dateNaissance.substr(0,4)
            let dateCertif = form[9].value  // récupérer l'année pour calculer : 
                                            // -3ans, questionnaire de santé
            console.log('année mois jour certif : ') 
            console.log(todayYear, todayMonth, todayDay)
            console.log(nom, prenom)
            console.log(dateNaissance) 
            console.log(dateCertif) // juin = 06
            console.log(dateoftoday) // juin = 6
            //Création d'un adhérent et ajout dans la liste
            // boucle for pour plusieurs adherents ? 
            adhList.push(new adherent(majeur, certif, nom, prenom, sexe, datenaissance, etatJudo)) // tri par ordre alhpabetique (cf console.log adhList)
            console.log("la liste : ")
            console.log( adhList)
        }
        let url = "getData.php";
        let xhr = new XMLHttpRequest();
        xhr.open("POST",url,true)
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(JSON.stringify({
            adherents : adhList
        }));
        xhr.send("Oui")
    }
    //Récupérer les données : afficher le récapitulatif (+stocker ?)<br>
    // Bouton valider à paufiner : il doit permettre d'accéder au récapitulatif à partir du dernier adhérent <br>
    // Insertion du logo dans le formulaire<br>
    // CSS Bootstrap Bulma pour l'apparence (code couleur Moirans Judo & police) de la page d'intro et du formulaire. <br>


    /*                           
    <tr>
        <td>
            Catégorie : 
        </td>
        <td>
            <select name="categorie${i+1}" id="categorie${i+1}" onchange="generateCours(this, ${i+1}), test(this, ${i+1})">
                <option value="Selectionner">-Sélectionner-</option>
                <option value="Prejudo">Pré Judo</option>
                <option value="MiniPoussin">Mini Poussin</option>
                <option value="Poussin">Poussin</option>
                <option value="Benjamin">Benjamin</option>
                <option value="MinimeCadetCompetition">Minime, Cadet, compétition</option>
                <option value="AdulteJudoLoisir">Adulte Judo Loisir</option>
                <option value="CompetitionKata">compétition, Kata</option>
            </select>
        </td>
    </tr>
    */
</script>
</html>