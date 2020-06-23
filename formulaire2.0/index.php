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
                        <input type="button" onclick="generateAdh()" value="Valider"/>
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
    let todayDate = new Date()
    let todayYear = todayDate.getFullYear() // 2020 : number
    let todayMonth = (todayDate.getMonth())+1 //1 à 12 (si juin alors todayMonth = 6)
    let todayDay = todayDate.getDate()

    let tableCategorie = [
        { categorie : "PreJudo", age : 5,  passeport : 0 }, // element
        { categorie : "MiniPoussin", age : 7,  passeport : 1 },
        { categorie : "Poussin", age : 9,  passeport : 1 },
        { categorie : "Benjamin", age : 11,  passeport : 1 },
        { categorie : "Minime", age : 13,  passeport : 1 },
        { categorie : "Cadet", age : 16,  passeport : 2 },
        { categorie : "Junior", age : 19,  passeport : 2 },
        { categorie : "Senior", age :  39,  passeport : 2 },
        { categorie : "Veteran", age : 40,  passeport : 2 },
    ];
    function getCategorie(agePersonne){
        let cat;
        tableCategorie.forEach(element => {
            if(cat != undefined) // s'arrête a la première bonne itération car cat est défini et le if est dans la bonne valeur
                return;          // l'empêche de continuer a itérer
            if (element.age >= agePersonne){ // return l'age de la catégorie la plus grande
                cat = element.categorie;
            }
        });
        return cat;
    }
    function getPasseport(agePersonne){
        let passeport;
        tableCategorie.forEach(element => {
            if(passeport != undefined) // s'arrête a la première bonne itération car cat est défini et le if est dans la bonne valeur
                return;          // l'empêche de continuer a itérer
            if (element.age >= agePersonne){ // return l'age de la catégorie la plus grande
                passeport = element.passeport;
            }
        });
        return passeport;
    }
    //fichier à part pour la classe
    class adherent {

        constructor(_majeur, _certif, _nom, _prenom, _sexe, _dn, _etatJudo, _cat, _cours, _ceinturePrec, _passeportJudo){
            this.majeur = _majeur;
            this.certif = _certif;
            this.nom = _nom;
            this.prenom = _prenom;
            this.sexe = _sexe;
            this.dn= _dn;
            this.etatJudo = _etatJudo;
            this.cat = _cat;
            this.cours = _cours;
            this.ceinturePrec = _ceinturePrec;
            this.passeportJudo = _passeportJudo;
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
    function generateAdh(){
        let select = document.getElementById('nbadherents');
        let nbAdh = select.value
        let div_adh = document.getElementById("ongletsAdh")
        div_adh.innerHTML = ""
        let div_aff = document.getElementById("contenuAdh")
        div_aff.innerHTML = ""
        for (let i = 0; i < nbAdh; i++) {
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
                                    Homme <input type="radio" name="sexe${i+1}" id="sexe${i+1}" value="1">
                                </td>
                            <tr>
                                <td>
                                    Date de naissance :
                                </td>
                                <td>
                                    <input type="date" name="dn" id="dateNaissance${i+1}" required>
                                    <input type="button" onclick="generateCours(${i+1}), generatePasseport(${i+1})"  value="Valider la date"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Avez-vous déjà été licencié à la Fédération Française de Judo ? 
                                </td>
                                <td>
                                    Oui <input type="radio" name="licenceFFJ${i+1}" id="licenceFFJ${i+1}" value="1">
                                    Non <input type="radio" name="licenceFFJ${i+1}" id="licenceFFJ${i+1}" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Ceinture précédente : 
                                </td>
                                <td>
                                    <select name="ceinturePrecedente" id="ceinturePrecedente${i+1}">
                                        <option value="0">-Inconnue-</option>
                                        <option value="1">Blanche</option>
                                        <option value="2">Blanche 1 liseré</option>
                                        <option value="3">Blanche 2 liserés</option>
                                        <option value="4">Blanche/Jaune</option>
                                        <option value="5">Jaune</option>
                                        <option value="6">Jaune/Orange</option>
                                        <option value="7">Orange</option>
                                        <option value="8">Orange/Verte</option>
                                        <option value="9">Verte</option>
                                        <option value="10">Verte/Bleue</option>
                                        <option value="11">Bleue</option>
                                        <option value="12">Bleue/Marron</option>
                                        <option value="13">Marron</option>
                                        <option value="14">Noire</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    L'adhérent est majeur :
                                </td>
                                <td>
                                    Oui <input type="radio" name="majeur${i+1}" id="majeur${i+1}" onclick="generateAttest(this, ${i+1})" value="1">
                                    Non <input type="radio" name="majeur${i+1}" id="majeur${i+1}" onclick="generateAttest(this, ${i+1})" value="0">
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
                                    Catégorie : 
                                </td>
                                <td>
                                    <input type="text" id="categorie${i+1}" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div id="pass"></div>
                                </td>
                                <td>
                                    <div id="passeportJudo${i+1}"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div id="Cours"><div>
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
                <div id="attestMineur${i+1}"></div>
            </div>
            `
        }
    }

    // récupère l'année de naissance et calcule l'age de l'adhérent + retourne sa catégorie grâce à l'appel de la fonction getCategorie()  
    function generateCategorie(val_i){
        dateNais = document.getElementById(`dateNaissance${val_i}`).value
        let yearNaisCut = dateNais.substr(0,4);
        let naisYear = parseInt(yearNaisCut)
        let ageAdh = todayYear - naisYear
        categorie = getCategorie(ageAdh)
        document.getElementById(`categorie${val_i}`).value = categorie;
        return categorie; 
    }
    function generatePasseport(val_i){
        dateNais = document.getElementById(`dateNaissance${val_i}`).value
        let yearNaisCut = dateNais.substr(0,4);
        let naisYear = parseInt(yearNaisCut)
        let ageAdh = todayYear - naisYear
        passeport = getPasseport(ageAdh)
        let passeport_affichage = document.getElementById("pass")
        passeport_affichage.innerHTML = ""
        let passeportJudo = document.getElementById(`passeportJudo${val_i}`)
        passeportJudo.innerHTML = ""
        if (passeport == 1){
            passeportJudo.innerHTML = `
                Oui <input type="radio" name="passeport${val_i}" id="passeport${val_i}" value="1">
                Non <input type="radio" name="passeport${val_i}" id="passeport${val_i}" value="0">
            `
            passeport_affichage.innerHTML = `Avez-vous un passeport jeune ?` 
            return;
        } else if (passeport == 2) {
            passeportJudo.innerHTML = `
                Oui <input type="radio" name="passeport${val_i}" id="passeport${val_i}" value="1">
                Non <input type="radio" name="passeport${val_i}" id="passeport${val_i}" value="0">
            `
            passeport_affichage.innerHTML = `Avez-vous un passeport de judo adulte?` 
            return;
        }
    }
    // génère le cours en fonction de la catégorie 
    function generateCours(val_i){
        cat = generateCategorie(val_i)
        let div_affCours = document.getElementById("Cours");
        div_affCours.innerHTML = `Cours :`
        let div_cours = document.getElementById(`contenuCours${val_i}`)
        div_cours.innerHTML = "";
        if (cat == "PreJudo") {
            div_cours.innerHTML=`
            <select name="coursSelect" id="coursSelect">
                <option value="Sam10h30a11h15">Le samedi de 10h30 à 11h15</option>
                <option value="Sam11h15a12h">Le samedi de 11h15 à 12h00 </option>
                <option value="Ven16h30à17h15">Le vendredi de 16h30 à 17h15</option>
            </select>
            `
            return;
        }else if (cat == "MiniPoussin"){
            div_cours.innerHTML=`
            <select name="coursSelect" id="coursSelect">
                <option value="MarJeu16h45a17h45">Le mardi et jeudi 16h45-17h45</option>
                <option value="Mer17h30a18h30Ven17h15a18h15">Le mercredi 17h30-18h30 et vendredi 17h15-18h15</option>
            </select>
            `
            return;
        }else if (cat == "Poussin"){
            div_cours.innerHTML=`
            <select name="coursSelect" id="coursSelect">
                <option value="MarJeu17h45a18h45">Le mardi et jeudi 17h45-18h45</option>
                <option value="Mer17h30a18h30Ven17h15a18h15">Le mercredi 17h30-18h30 et vendredi 17h15-18h15</option>
            </select>
            `
            return;
        }else if (cat == "Benjamin"){
            div_cours.innerHTML=`
            <select name="coursSelect" id="coursSelect">
                <option value="Mer18h30a19h30Ven18h15a19h15">Le mercredi 18h30-19h30 et vendredi 18h15-19h15</option>
            </select>
            `
            return;
        }else if (cat == "Minime"){ // CHGT
            div_cours.innerHTML=`
            <select name="coursSelect" id="coursSelect">
                <option value="MarJeu18h45a20h15">Le mardi et jeudi 18h45-20h15</option>
            </select>
            `
            return;
        }else if (cat == "Cadet"){
            div_cours.innerHTML=`
            <select name="coursSelect" id="coursSelect">
                <option value="MarJeu18h45a20h15">Le mardi et jeudi 18h45-20h15</option>
            </select>
            `
            return;
        }else if (cat == "Junior") {
            div_cours.innerHTML=`
            <select name="coursSelect" id="coursSelect">
                <option value="Ven19h15a21h">Le vendredi 19h15-21h</option>
                <option value="Ven19h15a21hMer19h30a21h">Le mercredi 19h30-21h et vendredi 19h15-21h</option>
            </select>
            `
            return;
        } else if (cat == "Senior") {
            div_cours.innerHTML=`
            <select name="coursSelect" id="coursSelect">
                <option value="Ven19h15a21h">Le vendredi 19h15-21h</option>
                <option value="Ven19h15a21hMer19h30a21h">Le mercredi 19h30-21h et vendredi 19h15-21h</option>
            </select>
            `
            return;
        } else if (cat == "Veteran") {
            div_cours.innerHTML=`
            <select name="coursSelect" id="coursSelect">
                <option value="Ven19h15a21h">Le vendredi 19h15-21h</option>
                <option value="Ven19h15a21hMer19h30a21h">Le mercredi 19h30-21h et vendredi 19h15-21h</option>
            </select>
            `
            return;
        }
    }
    function generateAttest(radio, val){
        let div_attest=document.getElementById(`attestMineur${val}`)
        div_attest.innerHTML = ""
        let value = radio.value 
        if (value == 0){
            div_attest.innerHTML = `
            <form>
                <fieldset>
                    <legend>Attestation pour l'adhérent mineur ${val}</legend>
                    <table>
                        <tr>
                            <td>
                                Je soussigné représentant légal de l’enfant dont le nom est inscrit ci-dessus autorise mon 
                                enfant à participer aux activités de Moirans Judo pour la saison 2020/2021. En cas d’urgence, j'autorise, 
                                pour mon enfant, toute intervention médicale qui pourrait s'avérer nécessaire.<br>
                            J'accepte <input type="checkbox" name="accepte" id="form_accepte">
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
            `
        }
    }

    function generateRecap(){
        let div_recap = document.getElementById("Recap")
        div_adh.innerHTML = ""
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
        let categorie; 

        let cours;

        let passeportJudo;

        let select = document.getElementById(`ceinturePrecedente${val_i}`);
        let ceinturePrec = select.value
        let radioMajeur = document.getElementsByName(`majeur${val_i}`);
        let majeur;
        for (let i = 0; i < radioMajeur.length; i++) {
            if (radioMajeur[i].checked) {
                majeur = radioMajeur[i].value
            }
        }
        let radioSexe = document.getElementsByName(`sexe${val_i}`);
        let sexe;
        for (let i = 0; i < radioSexe.length; i++) {
            if (radioSexe[i].checked) {
                sexe = radioSexe[i].value
            }
        }
        let radioEtatJudo = document.getElementsByName(`licenceFFJ${val_i}`);
        let etatJudo;
        for (let i = 0; i < radioEtatJudo.length; i++) {
            if (radioEtatJudo[i].checked) {
                etatJudo = radioEtatJudo[i].value
            }
        }
        //  3è 4è et 6è valeurs d'adherent
        //Récupération de tous les objets <Form> dans une liste
        let forms = document.getElementById(`form${val_i}`).children
        console.log('forms.length')
        console.log(forms.length)
        for (let i = 0; i < forms.length; i++) {

            //Récupération des balises input dans le form
            let form = forms[i].getElementsByTagName("input");
            // Récupération des données contenues dans les input
            let nom = form[0].value
            let prenom = form[1].value 
            let dateNaissance = form[4].value

            let yearBirthCut = dateNaissance.substr(0,4)
            let birthYear = parseInt(yearBirthCut)
            let monthBirthCut = dateNaissance.substr(6,8)
            let birthMonth = parseInt(monthBirthCut)
            let dayBirthCut = dateNaissance.substr(8,10)
            let birthDay = parseInt(dayBirthCut)

            let dateCertif = form[9].value  // récupérer l'année pour calculer : 
                                            // -3ans, questionnaire de santé
            let yearCertCut = dateCertif.substr(0,4);
            let certYear = parseInt(yearCertCut)
            let monthCertCut = dateCertif.substr(6,8)
            let certMonth = parseInt(monthCertCut)
            let dayCertCut = dateCertif.substr(8,10)
            let certDay = parseInt(dayCertCut);
            // etatJudo vaut 0 : certif requis (nouvel adh)
            // idem si etatJudo vaut 1 et certif +3 ans (ancien adh et vieux certif)
            // etatJudo vaut 1 et certif - 3 ans : AQS (ancien adh et certif entre 1 et 3 ans)
            if (etatJudo == 1 && (todayYear - certYear) < 3) { // pas assez précis : date complète
                console.log('AQS')
                console.log(etatJudo)
                console.log(todayYear - certYear)
            } else {
                console.log('go get un certif')
                console.log(etatJudo)
                console.log(todayYear - certYear)
            }
            
            //Création d'un adhérent et ajout dans la liste
            // boucle for pour plusieurs adherents ? 
            adhList.push(new adherent(majeur, dateCertif, nom, prenom, sexe, dateNaissance, etatJudo, categorie, cours, ceinturePrec, passeportJudo)) // tri par ordre alhpabetique (cf console.log adhList)
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
</script>
</html>