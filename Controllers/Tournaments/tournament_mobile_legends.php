<?php 
	
	require_once("../../Internal/tournament_database.php");
	
    $to = "prijave@eszs.si"; // this is your Email address
	$infomail = "info@eszs.si";
    $from = $_POST['email']; // this is the sender's Email address
	$team = $_POST['team'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
	$discord = $_POST['discord'];
	$nickname = $_POST['nickname'];
    $ingameId = $_POST['ingameId'];
    $serverId = $_POST['serverId'];
    $nationality = $_POST['nationality'];
	$dateofbirth = $_POST['dateofbirth'];
	$postalcode = $_POST['postalCode'];

	// Player 2
    $from2 = $_POST['email2'];
    $name2 = $_POST['name2'];
    $surname2 = $_POST['surname2'];
    $discord2 = $_POST['discord2'];
    $nickname2 = $_POST['nickname2'];
    $ingameId2 = $_POST['ingameId2'];
    $serverId2 = $_POST['serverId2'];
    $nationality2 = $_POST['nationality2'];
    $dateofbirth2 = $_POST['dateofbirth2'];
    $postalcode2 = $_POST['postalCode2'];

    // Player 3
    $from3 = $_POST['email3'];
    $name3 = $_POST['name3'];
    $surname3 = $_POST['surname3'];
    $discord3 = $_POST['discord3'];
    $nickname3 = $_POST['nickname3'];
    $ingameId3 = $_POST['ingameId3'];
    $serverId3 = $_POST['serverId3'];
    $nationality3 = $_POST['nationality3'];
    $dateofbirth3 = $_POST['dateofbirth3'];
    $postalcode3 = $_POST['postalCode3'];

    // Player 4
    $from4 = $_POST['email4'];
    $name4 = $_POST['name4'];
    $surname4 = $_POST['surname4'];
    $discord4 = $_POST['discord4'];
    $nickname4 = $_POST['nickname4'];
    $ingameId4 = $_POST['ingameId4'];
    $serverId4 = $_POST['serverId4'];
    $nationality4 = $_POST['nationality4'];
    $dateofbirth4 = $_POST['dateofbirth4'];
    $postalcode4 = $_POST['postalCode4'];

    // Player 5
    $from5 = $_POST['email5'];
    $name5 = $_POST['name5'];
    $surname5 = $_POST['surname5'];
    $discord5 = $_POST['discord5'];
    $nickname5 = $_POST['nickname5'];
    $ingameId5 = $_POST['ingameId5'];
    $serverId5 = $_POST['serverId5'];
    $nationality5 = $_POST['nationality5'];
    $dateofbirth5 = $_POST['dateofbirth5'];
    $postalcode5 = $_POST['postalCode5'];

    // Player 6
    $from6 = $_POST['email6'];
    $name6 = $_POST['name6'];
    $surname6 = $_POST['surname6'];
    $discord6 = $_POST['discord6'];
    $nickname6 = $_POST['nickname6'];
    $ingameId6 = $_POST['ingameId6'];
    $serverId6 = $_POST['serverId6'];
    $nationality6 = $_POST['nationality6'];
    $dateofbirth6 = $_POST['dateofbirth6'];
    $postalcode6 = $_POST['postalCode6'];
	
    $subject = "Prijava na IeSF Mobile Legends";
    $subject2 = "Prijava na IeSF Mobile Legends";
    $message = "Spoštovani,\n
vaša prijava na IeSF v Mobile Legends je bila uspešno izvedena.
Prosimo vas, da preverite, ali so spodaj navedeni podatki pravilni in nas v primeru napake čim prej kontaktirajte.\n
Ekipa: " . $team . "\n\n
Kapetan: \n
Ime: " . $name . "
Priimek: " . $surname . "
Email: " . $from . "
Discord: " . $discord . "
Vzdevek: " . $nickname . "
Ingame ID: " . $ingameId . "
Server ID: " . $serverId . "
Državljanstvo: " . $nationality . "
Datum rojstva: " . $dateofbirth . "
Poštna številka: " . $postalcode . "\n\n
Igralec 2: \n
Ime: " . $name2 . "
Priimek: " . $surname2 . "
Email: " . $from2 . "
Discord: " . $discord2 . "
Vzdevek: " . $nickname2 . "
Ingame ID: " . $ingameId2 . "
Server ID: " . $serverId2 . "
Državljanstvo: " . $nationality2 . "
Datum rojstva: " . $dateofbirth2 . "
Poštna številka: " . $postalcode2 . "\n\n
Igralec 3: \n
Ime: " . $name3 . "
Priimek: " . $surname3 . "
Email: " . $from3 . "
Discord: " . $discord3 . "
Vzdevek: " . $nickname3 . "
Ingame ID: " . $ingameId3 . "
Server ID: " . $serverId3 . "
Državljanstvo: " . $nationality3 . "
Datum rojstva: " . $dateofbirth3 . "
Poštna številka: " . $postalcode3 . "\n\n
Igralec 4: \n
Ime: " . $name4 . "
Priimek: " . $surname4 . "
Email: " . $from4 . "
Discord: " . $discord4 . "
Vzdevek: " . $nickname4 . "
Ingame ID: " . $ingameId4 . "
Server ID: " . $serverId4 . "
Državljanstvo: " . $nationality4 . "
Datum rojstva: " . $dateofbirth4 . "
Poštna številka: " . $postalcode4 . "\n\n
Igralec 5: \n
Ime: " . $name5 . "
Priimek: " . $surname5 . "
Email: " . $from5 . "
Discord: " . $discord5 . "
Vzdevek: " . $nickname5 . "
Ingame ID: " . $ingameId5 . "
Server ID: " . $serverId5 . "
Državljanstvo: " . $nationality5 . "
Datum rojstva: " . $dateofbirth5 . "
Poštna številka: " . $postalcode5 . "\n\n
Rezerva: \n
Ime: " . $name6 . "
Priimek: " . $surname6 . "
Email: " . $from6 . "
Discord: " . $discord6 . "
Vzdevek: " . $nickname6 . "
Ingame ID: " . $ingameId6 . "
Server ID: " . $serverId6 . "
Državljanstvo: " . $nationality6 . "
Datum rojstva: " . $dateofbirth6 . "
Poštna številka: " . $postalcode6 . "\n\n
	
Za dodatne informacije smo vam na voljo na info@eszs.si ali na discord server pod #vprašanja.";
	
    $headers = "From:" . $from . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers2 = "From:" . $to;
    $headers2 .= "Content-Type: text/plain; charset=UTF-8\r\n";
    mail($to,$subject,$message,$headers);
    mail($infomail,$subject,$message,$headers);
    //mail($laki,$subject,$message,$headers);
    mail($from,$subject2,$message,$headers2); // sends a copy of the message to the sender
	
	if($_POST['name'] != NULL && $_POST['dateofbirth']) {
	    tournament::addPlayerMobileLegends($team, $name, $surname, $from, $discord, $nickname, $ingameId, $serverId, $nationality, $dateofbirth, $postalcode);
        if($_POST['name2'] != NULL) {
            tournament::addPlayerMobileLegends($team, $name2, $surname2, $from2, $discord2, $nickname2, $ingameId2, $serverId2, $nationality2, $dateofbirth2, $postalcode2);
        }
        if($_POST['name3'] != NULL) {
            tournament::addPlayerMobileLegends($team, $name3, $surname3, $from3, $discord3, $nickname3, $ingameId3, $serverId3, $nationality3, $dateofbirth3, $postalcode3);
        }
        if($_POST['name4'] != NULL) {
            tournament::addPlayerMobileLegends($team, $name4, $surname4, $from4, $discord4, $nickname4, $ingameId4, $serverId4, $nationality4, $dateofbirth4, $postalcode4);
        }
        if($_POST['name5'] != NULL) {
            tournament::addPlayerMobileLegends($team, $name5, $surname5, $from5, $discord5, $nickname5, $ingameId5, $serverId5, $nationality5, $dateofbirth5, $postalcode5);
        }        
        if($_POST['name6'] != NULL) {
            tournament::addPlayerMobileLegends($team, $name6, $surname6, $from6, $discord6, $nickname6, $ingameId6, $serverId6, $nationality6, $dateofbirth6, $postalcode6);
        }
	}
    
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


