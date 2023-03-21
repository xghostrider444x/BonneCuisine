function getEmail(){
    var courriel = prompt("Entrer votre adresse courriel");
    var check = document.getElementById("chk").checked;
    document.confirmation.action="sendEmail.php?action=envoyer&courriel="+courriel+"&livraison="+check;
}

function getEmailForPassword(){
    var courriel = prompt("Entrer votre adresse courriel");
    document.lostPassword.action="recoverMail.php?action=sendRecoverEmail&courriel="+courriel;
}

function askPermissionToDelete(){
    if(confirm("Vous êtes sur le point de supprimer les menus sélectionnés voulez-vous toujours procédés?")){
        document.supprimer.action="supprimerMenu.php?action=supprimer";
    }
}

function upload_file(e) {
    e.preventDefault();
    var fileobj = e.dataTransfer.files[0];
    ajax_file_upload(fileobj);
}

function file_explorer() {
    var fileobj;
    document.getElementById('selectfile').click();
    document.getElementById('selectfile').onchange = function() {
        fileobj = document.getElementById('selectfile').files[0];
        ajax_file_upload(fileobj);
    };
    fileobj = document.getElementById('selectfile').files[0];
    ajax_file_upload(fileobj);
}

function ajax_file_upload(file_obj) {
    if (file_obj != undefined) {
        var form_data = new FormData();
        form_data.append('file', file_obj);
        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            contentType: false,
            processData: false,
            data: form_data,
            success: function(response) {
                alert(response);
                $('#selectfile').val('');
            }
        });
    }
}


