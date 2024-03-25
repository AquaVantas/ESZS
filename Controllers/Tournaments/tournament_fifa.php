<?php 
	require_once("../../Internal/tournament_database.php");
	require_once("../../Internal/website_database.php");
	
    $to = "prijave@eszs.si"; // this is your Email address
	$infomail = "info@eszs.si";
    $from = $_POST['email']; // this is the sender's Email address
    $first_name = $_POST['name'];
    $last_name = $_POST['surname'];
	$nickname = $_POST['nickname'];
	$discord = $_POST['discord'];
	$ekipa = $_POST['ekipa'];
	$platform = $_POST['platform'];
	$term = $_POST['term'];
	$dateofbirth = $_POST['dateofbirth'];
	$postalCode = $_POST['postalCode'];

    $subject = "Prijava na SDP FIFA24";
    $message = "Prijava na SDP FIFA24:
Ime: " . $first_name . "
Priimek: " . $last_name . "
PSN ID: " . $nickname . "
Email: " . $from . "
Discord: " . $discord . "
Ekipa / društvo: " . $ekipa . "
Platform: " . $platform . "
Termin kvalifikacij: " . $term . "
Datum rojstva: " . $dateofbirth . "
postalCode: " . $postalCode;
$message2 = "
Spoštovani,\n
vaša prijava na Slovensko državno prvenstvo v FIFA24 je bila uspešno izvedena.
Za lažjo organizacijo vas prosimo, da se pridružite uradnemu EŠZS Discordu (https://discord.gg/kF4KkfKzuf) in si v strežniku ime spremenite v svoje ime in priimek.
Spomniti Vas želimo tudi, da se morate kot pogoj za udeležbo Slovenskega državnega prvenstva včlaniti v eno od obstoječih društev, ki so člani E-športne zveze Slovenije.
Prosimo vas, da preverite, ali so spodaj navedeni podatki pravilni in nas v primeru napake čim prej kontaktirate.\n
" . $message . "\n
Za dodatne informacije smo vam na voljo na info@eszs.si.";

	$headers = "From:" . $from . "\r\n";
	$headers2 = "From:" . $to;
	foreach(website::getWebsiteSectionForm($_GET['section_id']) as $sectionForm) {
		$emails = $sectionForm['WSF_form_receivers'];
	}

	$emailsarray = preg_split('/\s+/', $emails);
	foreach($emailsarray as $email) {
		mail($email,$subject,$message,$headers);
	}
	mail($to,$subject,$message,$headers);
    mail($infomail,$subject,$message,$headers);
	mail($from,$subject,$message2,$headers2);
	
	tournament::addPlayerFifa($first_name, $last_name, $nickname, $discord, $from, $ekipa, $platform, $term, $dateofbirth, $postalCode);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava uspešna</title>
    <meta http-equiv="refresh" content="15;url=/"> <!-- Change 'index.php' to your desired destination -->
    <link rel="stylesheet" href="../../Style/Master.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12" style="text-align: center;">                
                <h1>Vaša prijava na turnir je bila uspešna.</h1>
                <p>Potrdilo je bilo poslano na Vaš e-poštni naslov. Če ga ne vidite, prosimo, poglejte še pod vsiljeno pošto.</p>
            </div>
        </div>
    </div>
</body>
</html>

