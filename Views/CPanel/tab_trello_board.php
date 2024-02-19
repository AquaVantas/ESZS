<div class="trello-board-wrapper">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Glavna deska</button>
        </li>
        <?php if($role_trello_admin || $role_admin) { ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-admins-tab" data-bs-toggle="pill" data-bs-target="#pills-admins" type="button" role="tab" aria-controls="pills-admins" aria-selected="false">Admini</button>
            </li>
        <?php } if($role_trello_tournaments || $role_admin) { ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-tournaments-tab" data-bs-toggle="pill" data-bs-target="#pills-tournaments" type="button" role="tab" aria-controls="pills-tournaments" aria-selected="false">Tekmovanja</button>
            </li>
        <?php } if($role_trello_socials || $role_admin) { ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-socials-tab" data-bs-toggle="pill" data-bs-target="#pills-socials" type="button" role="tab" aria-controls="pills-socials" aria-selected="false">Socials</button>
            </li>
        <?php } if($role_trello_organs || $role_admin) { ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-organs-tab" data-bs-toggle="pill" data-bs-target="#pills-organs" type="button" role="tab" aria-controls="pills-organs" aria-selected="false">Organi EŠZS</button>
            </li>
        <?php } if($role_trello_graphics || $role_admin) { ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-graphics-tab" data-bs-toggle="pill" data-bs-target="#pills-graphics" type="button" role="tab" aria-controls="pills-graphics" aria-selected="false">Grafike</button>
            </li>
        <?php } if($role_trello_devs || $role_admin) { ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-devs-tab" data-bs-toggle="pill" data-bs-target="#pills-devs" type="button" role="tab" aria-controls="pills-devs" aria-selected="false">Devs</button>
            </li>
        <?php } if($role_trello_stream || $role_admin) { ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-stream-tab" data-bs-toggle="pill" data-bs-target="#pills-stream" type="button" role="tab" aria-controls="pills-stream" aria-selected="false">Stream</button>
            </li>
        <?php } ?>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <iframe src="https://trello.com/b/K5pzpYrE.html"></iframe>
        </div>
        <?php if($role_trello_admin || $role_admin) { ?>
            <div class="tab-pane fade" id="pills-admins" role="tabpanel" aria-labelledby="pills-admins-tab">
                <iframe src="https://trello.com/b/rF1n7MAY.html"></iframe>
            </div>
        <?php } if($role_trello_tournaments || $role_admin) { ?>
            <div class="tab-pane fade" id="pills-tournaments" role="tabpanel" aria-labelledby="pills-tournaments-tab">
                <iframe src="https://trello.com/b/qjz3BqvZ.html"></iframe>
            </div>
        <?php } if($role_trello_socials || $role_admin) { ?>
            <div class="tab-pane fade" id="pills-socials" role="tabpanel" aria-labelledby="pills-socials-tab">
                <iframe src="https://trello.com/b/chwcUwaa.html"></iframe>
            </div>
        <?php } if($role_trello_organs || $role_admin) { ?>
            <div class="tab-pane fade" id="pills-organs" role="tabpanel" aria-labelledby="pills-organs-tab">
                <iframe src="https://trello.com/b/2LYqszgM.html"></iframe>
            </div>
        <?php } if($role_trello_graphics || $role_admin) { ?>
            <div class="tab-pane fade" id="pills-graphics" role="tabpanel" aria-labelledby="pills-graphics-tab">
                <iframe src="https://trello.com/b/KpIKNWN0.html"></iframe>
            </div>
        <?php } if($role_trello_devs || $role_admin) { ?>
            <div class="tab-pane fade" id="pills-devs" role="tabpanel" aria-labelledby="pills-devs-tab">
                <iframe src="https://trello.com/b/zIgoiEBN.html"></iframe>
            </div>
        <?php } if($role_trello_stream || $role_admin) { ?>
            <div class="tab-pane fade" id="pills-stream" role="tabpanel" aria-labelledby="pills-stream-tab">
                <iframe src="https://trello.com/b/H5wio048.html"></iframe>
            </div>
        <?php } ?>
    </div>
</div>
<?php 
if((isset($cpanel_tab) && $cpanel_tab == "news_editor")  && ($role_admin || $role_news)) { } ?>