var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);

function deleteUser(command) {
    console.log(command);
    $(".delete-user-modal .modal-footer .delete-button").attr("href", command);
}