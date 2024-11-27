// let champ_nom=document.getElementById("nom")
// let champ_prénom=document.getElementById("prenom")
// let radio_un = document.getElementById("Aloïs")
// let radio_deux=document.getElementById("Enzo")
// let radio_trois=document.getElementById("Jolan")
// let radio_quatre=document.getElementById("Evan")
// let radio_cinq=document.getElementById("Islam")
// let champ_select=document.getElementById("consent")
// function valider_nom(champ_nom){
//     let errornom=document.querySelector(".deux")
//     let style=document.getElementById("nom")
//     if (champ_nom.value===""){
//         errornom.classList.add("active")
//         style.classList.add("contour")
//         return false
//     }else{
//         errornom.classList.remove("active")
//         style.classList.remove("contour")
//         return true}
// }
// function valider_prenom(champ_prenom){
//     let errorprenom=document.querySelector(".un")
//     let style=document.getElementById("prenom")
//     if (champ_prenom.value===""){
//         errorprenom.classList.add("active")
//         style.classList.add("contour")
//         return false
//     }else {
//         errorprenom.classList.remove("active")
//         style.classList.remove("contour")
//         return true}
// }
// function valider_choix(radio_un,radio_deux,radio_trois,radio_quatre,radio_cinq){
//     let errorradio=document.querySelector(".trois")
//     if ((!radio_un.checked && !radio_deux.checked)){
//         if(!radio_trois.checked && !radio_quatre.checked){
//             if(!radio_cinq.checked){
//                 errorradio.classList.add("active")
//                 return false
//             }
//         }   
//     }else{
//         errorradio.classList.remove("active")
//         return true}
//     }
//     function valider_consent(champ_select){
//         let errorconsent=document.querySelector(".quatre")
//         if (!champ_select.checked){
//             errorconsent.classList.add("active")
//             return false
//         }else{
//             errorconsent.classList.remove("active")
//             return true}
//     }
    function afficherPopup(){
        let popup=document.querySelector(".formulaire")
        let bouton=document.querySelector(".cv-grid")
        document.getElementById("formulaire").reset()
        popup.classList.add("active")
        bouton.classList.add("deactive")
    }
    function retirerPopup(){
        let popup=document.querySelector(".formulaire")
        let bouton=document.querySelector(".cv-grid")
        popup.classList.remove("active")
        bouton.classList.remove("deactive")
    }
//     function downloads(radio_un,radio_deux,radio_trois,radio_quatre,radio_cinq){
//         if (radio_un.checked){
//             const a = document.createElement("a");
//             a.href = "images/portfolio/cvalois.pdf";
//             a.download = "CV-alois.pdf"; 
//             a.click();
//         }
//         if (radio_deux.checked){
//             const b = document.createElement("b");
//             b.href = "images/portfolio/cvenzo.pdf";
//             b.download = "CV-enzo.pdf"; 
//             b.click();
//         }
//         if (radio_trois.checked){
//             const c = document.createElement("c");
//             c.href = "images/portfolio/cvalois.pdf";
//             c.download = "CV-jollan.pdf"; 
//             c.click();
//         }
//         if (radio_quatre.checked){
//             const d = document.createElement("d");
//             d.href = "images/portfolio/evan.pdf";
//             d.download = "CV-evan.pdf"; 
//             d.click();
//         }
//         if (radio_cinq.checked){
//             const e = document.createElement("e");
//             e.href = "images/portfolio/cvislam.pdf";
//             e.download = "CV-islam.pdf"; 
//             e.click();
//         }
//     }

//     function validation(){
//         let indice=0
//         indice = ( valider_nom(champ_nom)) ? indice + 1 : indice
//         indice=( valider_prenom(champ_prénom) ) ? indice+1 : indice
//         indice=( valider_consent(champ_select) ) ? indice+1 : indice
//         indice=( valider_choix(radio_un,radio_deux,radio_trois,radio_quatre,radio_cinq) ) ? indice+1 : indice
//         if (indice===4){
//             downloads(radio_un,radio_deux,radio_trois,radio_quatre,radio_cinq)
//             retirerPopup()
//             document.getElementById("formulaire").reset()
//         }
//     }
