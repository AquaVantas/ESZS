<?php 
if(!isset($_COOKIE['cookies'])) { ?>
    <div class="cookies">
        <?php foreach(website::getWebsiteDefault($lang_id) as $default) { ?>
            <div class="heading-line">
                <img src="Content/Images/Icons/cookies-icon.svg" alt="cookies-icon" />
                <?= $default['website_cookies_title'] ?>
            </div>
            <?= $default['website_cookies_text'] ?>
            <div class="accept-deny">
                <a class="btn btn-primary" id="deny-cookies" onclick="cookiePolicy('cookies', 'no', 365)">Zavrni</a>
                <a class="btn btn-primary" id="accept-cookies" onclick="cookiePolicy('cookies', 'yes', 365)">Sprejmi</a>
            </div>
        <?php } ?>
    </div>
<?php }  ?>