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
	$dateofbirth = $_POST['dateofbirth'];
	$postalcode = $_POST['postalCode'];

	// Player 2
    $from2 = $_POST['email2'];
    $name2 = $_POST['name2'];
    $surname2 = $_POST['surname2'];
    $discord2 = $_POST['discord2'];
    $nickname2 = $_POST['nickname2'];
    $dateofbirth2 = $_POST['dateofbirth2'];
    $postalcode2 = $_POST['postalCode2'];

    // Player 3
    $from3 = $_POST['email3'];
    $name3 = $_POST['name3'];
    $surname3 = $_POST['surname3'];
    $discord3 = $_POST['discord3'];
    $nickname3 = $_POST['nickname3'];
    $dateofbirth3 = $_POST['dateofbirth3'];
    $postalcode3 = $_POST['postalCode3'];

    // Player 4
    $from4 = $_POST['email4'];
    $name4 = $_POST['name4'];
    $surname4 = $_POST['surname4'];
    $discord4 = $_POST['discord4'];
    $nickname4 = $_POST['nickname4'];
    $dateofbirth4 = $_POST['dateofbirth4'];
    $postalcode4 = $_POST['postalCode4'];

    // Player 5
    $from5 = $_POST['email5'];
    $name5 = $_POST['name5'];
    $surname5 = $_POST['surname5'];
    $discord5 = $_POST['discord5'];
    $nickname5 = $_POST['nickname5'];
    $dateofbirth5 = $_POST['dateofbirth5'];
    $postalcode5 = $_POST['postalCode5'];

    // Player 6
    $from6 = $_POST['email6'];
    $name6 = $_POST['name6'];
    $surname6 = $_POST['surname6'];
    $discord6 = $_POST['discord6'];
    $nickname6 = $_POST['nickname6'];
    $dateofbirth6 = $_POST['dateofbirth6'];
    $postalcode6 = $_POST['postalCode6'];

    // Player 7
    $from7 = $_POST['email7'];
    $name7 = $_POST['name7'];
    $surname7 = $_POST['surname7'];
    $discord7 = $_POST['discord7'];
    $nickname7 = $_POST['nickname7'];
    $dateofbirth7 = $_POST['dateofbirth7'];
    $postalcode7 = $_POST['postalCode7'];
	
    $subject = "Prijava na Valorant";
    $subject2 = "Prijava na Valorant";
    $message = "Prijava na Valorant:
	
	Ime: " . $name . "
	Priimek: " . $surname . "
	Email: " . $from . "
	Discord: " . $discord . "
	Vzdevek: " . $nickname;
	
	
	
    $messagekapetan = "Spoštovani,\n
vaša prijava na Slovensko državno prvenstvo v Valorant je bila uspešno izvedena.
Prosimo vas, da preverite, ali so spodaj navedeni podatki pravilni in nas v primeru napake čim prej kontaktirajte.\n
Ekipa: " . $team . "\n\n
Kapetan: \n
Ime: " . $name . "
Priimek: " . $surname . "
Email: " . $from . "
Discord: " . $discord . "
Vzdevek: " . $nickname . "
Datum rojstva: " . $dateofbirth . "
Poštna številka: " . $postalcode . "\n\n
Igralec 2: \n
Ime: " . $name2 . "
Priimek: " . $surname2 . "
Email: " . $from2 . "
Discord: " . $discord2 . "
Vzdevek: " . $nickname2 . "
Datum rojstva: " . $dateofbirth2 . "
Poštna številka: " . $postalcode2 . "\n\n
Igralec 3: \n
Ime: " . $name3 . "
Priimek: " . $surname3 . "
Email: " . $from3 . "
Discord: " . $discord3 . "
Vzdevek: " . $nickname3 . "
Datum rojstva: " . $dateofbirth3 . "
Poštna številka: " . $postalcode3 . "\n\n
Igralec 4: \n
Ime: " . $name4 . "
Priimek: " . $surname4 . "
Email: " . $from4 . "
Discord: " . $discord4 . "
Vzdevek: " . $nickname4 . "
Datum rojstva: " . $dateofbirth4 . "
Poštna številka: " . $postalcode4 . "\n\n
Igralec 5: \n
Ime: " . $name5 . "
Priimek: " . $surname5 . "
Email: " . $from5 . "
Discord: " . $discord5 . "
Vzdevek: " . $nickname5 . "
Datum rojstva: " . $dateofbirth5 . "
Poštna številka: " . $postalcode5 . "\n\n
Rezerva 1: \n
Ime: " . $name6 . "
Priimek: " . $surname6 . "
Email: " . $from6 . "
Discord: " . $discord6 . "
Vzdevek: " . $nickname6 . "
Datum rojstva: " . $dateofbirth6 . "
Poštna številka: " . $postalcode6 . "\n\n
Rezerva 2: \n
Ime: " . $name7 . "
Priimek: " . $surname7 . "
Email: " . $from7 . "
Discord: " . $discord7 . "
Vzdevek: " . $nickname7 . "
Datum rojstva: " . $dateofbirth7 . "
Poštna številka: " . $postalcode7 . "\n\n
	
Za dodatne informacije smo vam na voljo na info@eszs.si ali na discord server pod #vprašanja.";
	
    $headers = "From:" . $from . "\r\n";
    $headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
    mail($infomail,$subject,$message,$headers);
    //mail($laki,$subject,$message,$headers);
    mail($from,$subject2,$messagekapetan,$headers2); // sends a copy of the message to the sender
	
	if($_POST['name'] != NULL) {
	    tournament::addPlayerValorant($team, $name, $surname, $from, $discord, $nickname, $dateofbirth, $postalcode);
        tournament::addPlayerValorant($team, $name2, $surname2, $from2, $discord2, $nickname2, $dateofbirth2, $postalcode2);
        tournament::addPlayerValorant($team, $name3, $surname3, $from3, $discord3, $nickname3, $dateofbirth3, $postalcode3);
        tournament::addPlayerValorant($team, $name4, $surname4, $from4, $discord4, $nickname4, $dateofbirth4, $postalcode4);
        tournament::addPlayerValorant($team, $name5, $surname5, $from5, $discord5, $nickname5, $dateofbirth5, $postalcode5);
        if($_POST['name6'] != NULL) {
            tournament::addPlayerValorant($team, $name6, $surname6, $from6, $discord6, $nickname6, $dateofbirth6, $postalcode6);
        }
        if($_POST['name7'] != NULL) {
            tournament::addPlayerValorant($team, $name7, $surname7, $from7, $discord7, $nickname7, $dateofbirth7, $postalcode7);
        }
	}
	
	
    header('Location: index.php'); 
    
?>


