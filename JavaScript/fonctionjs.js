function getEmail(){
    var courriel = prompt("Entrer votre adresse courriel");
    var check = document.getElementById("chk").checked;
    document.confirmation.action="sendEmail.php?action=envoyer&courriel="+courriel+"&livraison="+check;
}
function getEmailForPassword(){
    var courriel = prompt("Entrer votre adresse courriel");
    document.lostPassword.action="recoverMail.php?action=sendRecoverEmail&courriel="+courriel;
}

