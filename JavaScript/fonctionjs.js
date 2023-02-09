function getEmail(){
    var courriel = prompt("Entrer votre adresse courriel");
    var check = document.getElementById("chk").checked;
    document.confirmation.action="sendEmail.php?action=envoyer&courriel="+courriel+"&livraison="+check;
}

