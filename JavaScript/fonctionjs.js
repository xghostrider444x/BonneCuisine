function getEmail(){
    var courriel = prompt("Entrer votre adresse courriel");
    document.confirmation.action="sendEmail.php?action=envoyer&courriel="+courriel;
}