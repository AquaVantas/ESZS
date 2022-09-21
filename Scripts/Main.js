var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);

function deleteUser(user_id) {
    console.log(user_id);
    $(".delete-user-modal .modal-footer .delete-button").attr("href", "Controllers/editors_delete_user.php?user="+user_id);
}