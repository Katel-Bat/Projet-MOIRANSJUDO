//Collection des adhérents
let adhList = [];
//Date d'aujourd'hui séparée en année mois jour (numbers)
let todayDate = new Date();
let todayYear = todayDate.getFullYear();
let todayMonth = (todayDate.getMonth())+1; //0 à 11 donc +1
let todayDay = todayDate.getDate();
// catégorie et passeport possibles en fonction de l'age
let tableCategorie = [
    { categorie : "PreJudo", age : 5,  passeport : 0 }, 
    { categorie : "MiniPoussin", age : 7,  passeport : 1 },
    { categorie : "Poussin", age : 9,  passeport : 1 },
    { categorie : "Benjamin", age : 11,  passeport : 1 },
    { categorie : "Minime", age : 13,  passeport : 1 },
    { categorie : "Cadet", age : 16,  passeport : 2 },
    { categorie : "Junior", age : 19,  passeport : 2 },
    { categorie : "Senior", age :  39,  passeport : 2 },
    { categorie : "Veteran", age : 40,  passeport : 2 },
];
// element vaut par exemple : ligne 10 
// retourne la catégorie en fonction de l'âge
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
// retourne le passeport en fonction de l'âge
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
// retourne l'année de la value d'un input type date 
function getAnnee(date){
    anneeStr = date.substr(0,4);
    anneeNbr = parseInt(anneeStr);
    return anneeNbr;
}
//retourne la différence entre l'année présente et l'année de la value d'un input type date 
function getdifferenceAnnee(date) {
    anneeEntree = getAnnee(date);
    differenceAnnee = todayYear - anneeEntree;
    return differenceAnnee;
}
// retourne la valeur selectionnée d'un bouton radio
function getRadioValue(radio){
    let value;
    for (let i = 0; i < radio.length; i++) {
        if (radio[i].checked) {
            value = radio[i].value
        }
    }
    return value;
}
//fichier à part pour la classe
class adherent {

    constructor(_majeur, _certif, _nom, _prenom, _sexe, _dn, _etatJudo, _cat, _cours, _ceinturePrec, _passeportJudo, _typePasseport){
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
        this.typePasseport = _typePasseport; 
    }
}
//===================================================================== affichage des divers onglets =====================================================================
// Récupérer l'élément avec l'id "defaultOpen" / la première étape du formulaire est le responsable légal donc doit être cliqué par défaut
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
// =========================================================== génération en HTML ========================================================================
// Récupère la valeur du select dans la section responsable légal et en fonction créée en HTML les onglets, et les formulaires en nombre adaptés
// Les id sont récupérables grâce à l'incrémentation ${i+1} dans la boucle for
function generateAdh(){
    let select = document.getElementById('nbadherents');
    let nbAdh = select.value;
    let div_adh = document.getElementById("ongletsAdh");
    div_adh.innerHTML = "";
    let div_aff = document.getElementById("contenuAdh");
    div_aff.innerHTML = "";
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
                    <div id="btnval"><div>
                    <input type="button" onclick="openSection(event,'Adh${i+2}'), parseForms(${i+1})" value="Valider l'Adhérent ${i+1}">
                </fieldset>
            </form>
            <div id="attestMineur${i+1}"></div>
        </div>
        `
    } // boucle if pour générer le bon bonton si adh ou si récap ? 
}
// récupère l'année de naissance et calcule l'age de l'adhérent 
// retourne sa catégorie grâce à l'appel de la fonction getCategorie() 
// l'insère dans l'input readonly de la catégorie
function generateCategorie(val_i){
    dateNais = document.getElementById(`dateNaissance${val_i}`).value;
    ageAdh = getdifferenceAnnee(dateNais);
    categorie = getCategorie(ageAdh);
    document.getElementById(`categorie${val_i}`).value = categorie;
    return categorie; 
}
function generatePasseport(val_i){
    dateNais = document.getElementById(`dateNaissance${val_i}`).value
    ageAdh = getdifferenceAnnee(dateNais);
    passeport = getPasseport(ageAdh);
    let passeport_affichage = document.getElementById("pass");
    passeport_affichage.innerHTML = "";
    let passeportJudo = document.getElementById(`passeportJudo${val_i}`);
    passeportJudo.innerHTML = "";
    if (passeport == 1){
        passeportJudo.innerHTML = `
            Oui <input type="radio" name="passeport${val_i}" id="passeport${val_i}" value="1">
            Non <input type="radio" name="passeport${val_i}" id="passeport${val_i}" value="0">
        `;
        passeport_affichage.innerHTML = `Avez-vous un passeport jeune ?`;
    } else if (passeport == 2) {
        passeportJudo.innerHTML = `
            Oui <input type="radio" name="passeport${val_i}" id="passeport${val_i}" value="1">
            Non <input type="radio" name="passeport${val_i}" id="passeport${val_i}" value="0">
        `;
        passeport_affichage.innerHTML = `Avez-vous un passeport de judo adulte?`;
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
        <select name="coursSelect${val_i}" id="coursSelect${val_i}">
            <option value="Sam10h30a11h15">Le samedi de 10h30 à 11h15</option>
            <option value="Sam11h15a12h">Le samedi de 11h15 à 12h00 </option>
            <option value="Ven16h30à17h15">Le vendredi de 16h30 à 17h15</option>
        </select>
        `;
    }else if (cat == "MiniPoussin"){
        div_cours.innerHTML=`
        <select name="coursSelect${val_i}" id="coursSelect${val_i}">
            <option value="MarJeu16h45a17h45">Le mardi et jeudi 16h45-17h45</option>
            <option value="Mer17h30a18h30Ven17h15a18h15">Le mercredi 17h30-18h30 et vendredi 17h15-18h15</option>
        </select>
        `;
    }else if (cat == "Poussin"){
        div_cours.innerHTML=`
        <select name="coursSelect${val_i}" id="coursSelect${val_i}">
            <option value="MarJeu17h45a18h45">Le mardi et jeudi 17h45-18h45</option>
            <option value="Mer17h30a18h30Ven17h15a18h15">Le mercredi 17h30-18h30 et vendredi 17h15-18h15</option>
        </select>
        `;
    }else if (cat == "Benjamin"){
        div_cours.innerHTML=`
        <select name="coursSelect${val_i}" id="coursSelect${val_i}">
            <option value="Mer18h30a19h30Ven18h15a19h15">Le mercredi 18h30-19h30 et vendredi 18h15-19h15</option>
        </select>
        `;
    }else if (cat == "Minime"){ // CHGT
        div_cours.innerHTML=`
        <select name="coursSelect${val_i}" id="coursSelect${val_i}">
            <option value="MarJeu18h45a20h15">Le mardi et jeudi 18h45-20h15</option>
        </select>
        `;
    }else if (cat == "Cadet"){
        div_cours.innerHTML=`
        <select name="coursSelect${val_i}" id="coursSelect${val_i}">
            <option value="MarJeu18h45a20h15">Le mardi et jeudi 18h45-20h15</option>
        </select>
        `;
    }else if (cat == "Junior") {
        div_cours.innerHTML=`
        <select name="coursSelect${val_i}" id="coursSelect${val_i}">
            <option value="Ven19h15a21h">Le vendredi 19h15-21h</option>
            <option value="Ven19h15a21hMer19h30a21h">Le mercredi 19h30-21h et vendredi 19h15-21h</option>
        </select>
        `;
    } else if (cat == "Senior") {
        div_cours.innerHTML=`
        <select name="coursSelect${val_i}" id="coursSelect${val_i}" >
            <option value="Ven19h15a21h">Le vendredi 19h15-21h</option>
            <option value="Ven19h15a21hMer19h30a21h">Le mercredi 19h30-21h et vendredi 19h15-21h</option>
        </select>
        `;
    } else if (cat == "Veteran") {
        div_cours.innerHTML=`
        <select name="coursSelect${val_i}" id="coursSelect${val_i}">
            <option value="Ven19h15a21h">Le vendredi 19h15-21h</option>
            <option value="Ven19h15a21hMer19h30a21h">Le mercredi 19h30-21h et vendredi 19h15-21h</option>
        </select>
        `;
    }
}
function generateAttest(radio, val){
    let div_attest=document.getElementById(`attestMineur${val}`);
    div_attest.innerHTML = "";
    let value = radio.value;
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
        `;
    }
}

function generateRecap(){
    let div_recap = document.getElementById("Recap");
    div_adh.innerHTML = "";
}
// =========================================================================================== stockage des éléments du formulaire =========================================
// cours / ceinturePrec / majeur / sexe / etatJudo / nom / prenom / dateNaissance / passeportJudo / typePasseport / categorie / dateCertif 
function parseForms(val_i){ 
    let selectCours = document.getElementById(`coursSelect${val_i}`);
    let cours = selectCours.value;
    let selectCeint = document.getElementById(`ceinturePrecedente${val_i}`);
    let ceinturePrec = selectCeint.value;
    let radioMajeur = document.getElementsByName(`majeur${val_i}`);
    let majeur = getRadioValue(radioMajeur);
    let radioSexe = document.getElementsByName(`sexe${val_i}`);
    let sexe = getRadioValue(radioSexe);
    let radioEtatJudo = document.getElementsByName(`licenceFFJ${val_i}`);
    let etatJudo = getRadioValue(radioEtatJudo);
    //Récupération de tous les objets <Form> dans une liste
    let forms = document.getElementById(`form${val_i}`).children
    for (let i = 0; i < forms.length; i++) {
        //Récupération des balises input dans le form
        let form = forms[i].getElementsByTagName("input");
        // Récupération des données contenues dans les input
        let nom = form[0].value
        let prenom = form[1].value 
        let dateNaissance = form[4].value
        let ageAdh = getdifferenceAnnee(dateNaissance);
        let passeportNbr = getPasseport(ageAdh);
        if (passeportNbr == 2){
            let radioAdulte = document.getElementsByName(`passeport${val_i}`);
            passeportJudo =  getRadioValue(radioAdulte);
            typePasseport = "adulte";
        } else if (passeportNbr == 1) {
            let radioJeune = document.getElementsByName(`passeport${val_i}`);
            passeportJudo =  getRadioValue(radioJeune);
            typePasseport = "jeune";
        } else {
            passeportJudo = 0;
            typePasseport = "prejudo";
        }
        let categorie = getCategorie(ageAdh);
        let dateCertif = form[9].value  // récupérer l'année pour calculer : 
                                        // -3ans, questionnaire de santé
        let certYear = getAnnee(dateCertif)
        let monthCertCut = dateCertif.substr(6,8)
        let certMonth = parseInt(monthCertCut)
        let dayCertCut = dateCertif.substr(8,10)
        let certDay = parseInt(dayCertCut);
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
        adhList.push(new adherent(majeur, dateCertif, nom, prenom, sexe, dateNaissance, etatJudo, categorie, cours, ceinturePrec, passeportJudo, typePasseport)) // tri par ordre alhpabetique (cf console.log adhList)
        console.log("la liste : ")
        console.log( adhList)
    }
    // recup des val de adhList
    let htmlTab = document.getElementById("Recap");
    let text =""
    for (let i = 0; i < adhList.length; i++) { // 2 par ex
        text += `<form><fieldset><legend>Adhérent${i+1}</legend><table><tbody>`;
        for (key in adhList[i]) { //12
            text += `<tr><td>${key} : </td><td> ${adhList[i][key]} </td></tr>`;
        }
        text += `</tbody></table></fieldset></form>`;
    }
    htmlTab.innerHTML+= text;   
    let nomadhs = [];
    for (let i = 0; i < adhList.length; i++) {
        nomadhs.push(adhList[i].nom);
    }
    console.log('nomadhs')
    console.log(nomadhs)

    return adhList;
    let url = "getData.php";
    let xhr = new XMLHttpRequest();
    xhr.open("POST",url,true)
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify({
        adherents : adhList
    }));
    xhr.send("Oui")
}
