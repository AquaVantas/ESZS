<?php    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);  // Display errors in the browser (useful for development)
    ini_set('log_errors', 1);  // Log errors
    ini_set('error_log', 'C:\xampp\php\logs\php_error_log');  // Log to a specific file
    header('Content-Type: application/json'); // Ensure the response is JSON

    require_once("../../Internal/tournament_database.php");

    if (empty($_POST['date_of_birth_1'])) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid or missing dateTime']);
        exit();
    }

    if (!isset($_POST['company_name'], $_POST['name_1'], $_POST['player_nationality_1'])) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
        exit();
    }

    //TEAM INFO
    $company_name = htmlspecialchars($_POST['company_name'], ENT_QUOTES, 'UTF-8');
    $team_name = htmlspecialchars($_POST['team_name'], ENT_QUOTES, 'UTF-8');

    $team_logo = null;
    if (isset($_FILES['team_logo']) && $_FILES['team_logo']['error'] === UPLOAD_ERR_OK) {
        // Check if the file type is valid
        $fileType = mime_content_type($_FILES['team_logo']['tmp_name']);
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($fileType, $allowedTypes)) {
            $team_logo = file_get_contents($_FILES['team_logo']['tmp_name']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid file type for team_logo']);
            exit();
        }
    } else {
        // Handle file upload errors
        if ($_FILES['team_logo']['error'] !== UPLOAD_ERR_OK) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'File upload error: ' . $_FILES['team_logo']['error']]);
            exit();
        }
    }

    $country = htmlspecialchars($_POST['country'], ENT_QUOTES, 'UTF-8');
    $city = htmlspecialchars($_POST['city'], ENT_QUOTES, 'UTF-8');
    $team_representative = htmlspecialchars($_POST['team_representative'], ENT_QUOTES, 'UTF-8');
    $contact_number = htmlspecialchars($_POST['contact_number'], ENT_QUOTES, 'UTF-8');
    $contact_email = htmlspecialchars($_POST['contact_email'], ENT_QUOTES, 'UTF-8');
    $about = htmlspecialchars($_POST['about'], ENT_QUOTES, 'UTF-8');
    $team_social_media = htmlspecialchars($_POST['team_social_media'], ENT_QUOTES, 'UTF-8');

    //PLAYER ONE
    $name_1 = htmlspecialchars($_POST['name_1'], ENT_QUOTES, 'UTF-8');
    $nickname_1 = htmlspecialchars($_POST['nickname_1'], ENT_QUOTES, 'UTF-8');

    $player_icon_1 = null;
    if (isset($_FILES['player_icon_1']) && $_FILES['player_icon_1']['error'] === UPLOAD_ERR_OK) {
        // Validate file type and size (optional)
        $fileType = mime_content_type($_FILES['player_icon_1']['tmp_name']);
        if (in_array($fileType, $allowedTypes)) {
            $player_icon_1 = file_get_contents($_FILES['player_icon_1']['tmp_name']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid file type for player_icon_1']);
            exit();
        }
    }

    $player_sex_1 = htmlspecialchars($_POST['player_sex_1'], ENT_QUOTES, 'UTF-8');
    $date_of_birth_1 = DateTime::createFromFormat('Y-m-d', $_POST['date_of_birth_1'])->format('Y-m-d'); // Ensure correct date format
    $player_nationality_1 = htmlspecialchars($_POST['player_nationality_1'], ENT_QUOTES, 'UTF-8');
    $player_emso_1 = (int)$_POST['player_emso_1'];
    $player_document_no_1 = htmlspecialchars($_POST['player_document_no_1'], ENT_QUOTES, 'UTF-8');
    $player_position_1 = htmlspecialchars($_POST['player_position_1'], ENT_QUOTES, 'UTF-8');
    $player_jersey_1 = (int)$_POST['player_jersey_1'];
    $player_class_p_1 = (int)$_POST['player_class_p_1']; // Use PDO::PARAM_INT
    $player_class_p_plus_1 = (int)$_POST['player_class_p_plus_1']; // Use PDO::PARAM_INT
    $player_social_media_1 = htmlspecialchars($_POST['player_social_media_1'], ENT_QUOTES, 'UTF-8');//PLAYER TWO
    $name_2 = htmlspecialchars($_POST['name_2'], ENT_QUOTES, 'UTF-8');
    $nickname_2 = htmlspecialchars($_POST['nickname_2'], ENT_QUOTES, 'UTF-8');
    
    $player_icon_2 = null;
    if (isset($_FILES['player_icon_2']) && $_FILES['player_icon_2']['error'] === UPLOAD_ERR_OK) {
        // Validate file type and size (optional)
        $fileType = mime_content_type($_FILES['player_icon_2']['tmp_name']);
        if (in_array($fileType, $allowedTypes)) {
            $player_icon_2 = file_get_contents($_FILES['player_icon_2']['tmp_name']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid file type for player_icon_2']);
            exit();
        }
    }
    
    $player_sex_2 = htmlspecialchars($_POST['player_sex_2'], ENT_QUOTES, 'UTF-8');
    $date_of_birth_2 = DateTime::createFromFormat('Y-m-d', $_POST['date_of_birth_2'])->format('Y-m-d'); // Ensure correct date format
    $player_nationality_2 = htmlspecialchars($_POST['player_nationality_2'], ENT_QUOTES, 'UTF-8');
    $player_emso_2 = (int)$_POST['player_emso_2'];
    $player_document_no_2 = htmlspecialchars($_POST['player_document_no_2'], ENT_QUOTES, 'UTF-8');
    $player_position_2 = htmlspecialchars($_POST['player_position_2'], ENT_QUOTES, 'UTF-8');
    $player_jersey_2 = (int)$_POST['player_jersey_2'];
    $player_class_p_2 = (int)$_POST['player_class_p_2']; // Use PDO::PARAM_INT
    $player_class_p_plus_2 = (int)$_POST['player_class_p_plus_2']; // Use PDO::PARAM_INT
    $player_social_media_2 = htmlspecialchars($_POST['player_social_media_2'], ENT_QUOTES, 'UTF-8');
    
    //PLAYER THREE
    $name_3 = htmlspecialchars($_POST['name_3'], ENT_QUOTES, 'UTF-8');
    $nickname_3 = htmlspecialchars($_POST['nickname_3'], ENT_QUOTES, 'UTF-8');
    
    $player_icon_3 = null;
    if (isset($_FILES['player_icon_3']) && $_FILES['player_icon_3']['error'] === UPLOAD_ERR_OK) {
        // Validate file type and size (optional)
        $fileType = mime_content_type($_FILES['player_icon_3']['tmp_name']);
        if (in_array($fileType, $allowedTypes)) {
            $player_icon_3 = file_get_contents($_FILES['player_icon_3']['tmp_name']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid file type for player_icon_3']);
            exit();
        }
    }
    
    $player_sex_3 = htmlspecialchars($_POST['player_sex_3'], ENT_QUOTES, 'UTF-8');
    $date_of_birth_3 = DateTime::createFromFormat('Y-m-d', $_POST['date_of_birth_3'])->format('Y-m-d'); // Ensure correct date format
    $player_nationality_3 = htmlspecialchars($_POST['player_nationality_3'], ENT_QUOTES, 'UTF-8');
    $player_emso_3 = (int)$_POST['player_emso_3'];
    $player_document_no_3 = htmlspecialchars($_POST['player_document_no_3'], ENT_QUOTES, 'UTF-8');
    $player_position_3 = htmlspecialchars($_POST['player_position_3'], ENT_QUOTES, 'UTF-8');
    $player_jersey_3 = (int)$_POST['player_jersey_3'];
    $player_class_p_3 = (int)$_POST['player_class_p_3']; // Use PDO::PARAM_INT
    $player_class_p_plus_3 = (int)$_POST['player_class_p_plus_3']; // Use PDO::PARAM_INT
    $player_social_media_3 = htmlspecialchars($_POST['player_social_media_3'], ENT_QUOTES, 'UTF-8');
    
    //PLAYER FOUR
    $name_4 = htmlspecialchars($_POST['name_4'], ENT_QUOTES, 'UTF-8');
    $nickname_4 = htmlspecialchars($_POST['nickname_4'], ENT_QUOTES, 'UTF-8');
    
    $player_icon_4 = null;
    if (isset($_FILES['player_icon_4']) && $_FILES['player_icon_4']['error'] === UPLOAD_ERR_OK) {
        // Validate file type and size (optional)
        $fileType = mime_content_type($_FILES['player_icon_4']['tmp_name']);
        if (in_array($fileType, $allowedTypes)) {
            $player_icon_4 = file_get_contents($_FILES['player_icon_4']['tmp_name']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid file type for player_icon_4']);
            exit();
        }
    }
    
    $player_sex_4 = htmlspecialchars($_POST['player_sex_4'], ENT_QUOTES, 'UTF-8');
    $date_of_birth_4 = DateTime::createFromFormat('Y-m-d', $_POST['date_of_birth_4'])->format('Y-m-d'); // Ensure correct date format
    $player_nationality_4 = htmlspecialchars($_POST['player_nationality_4'], ENT_QUOTES, 'UTF-8');
    $player_emso_4 = (int)$_POST['player_emso_4'];
    $player_document_no_4 = htmlspecialchars($_POST['player_document_no_4'], ENT_QUOTES, 'UTF-8');
    $player_position_4 = htmlspecialchars($_POST['player_position_4'], ENT_QUOTES, 'UTF-8');
    $player_jersey_4 = (int)$_POST['player_jersey_4'];
    $player_class_p_4 = (int)$_POST['player_class_p_4']; // Use PDO::PARAM_INT
    $player_class_p_plus_4 = (int)$_POST['player_class_p_plus_4']; // Use PDO::PARAM_INT
    $player_social_media_4 = htmlspecialchars($_POST['player_social_media_4'], ENT_QUOTES, 'UTF-8');
    
    //PLAYER FIVE
    $name_5 = htmlspecialchars($_POST['name_5'], ENT_QUOTES, 'UTF-8');
    $nickname_5 = htmlspecialchars($_POST['nickname_5'], ENT_QUOTES, 'UTF-8');
    
    $player_icon_5 = null;
    if (isset($_FILES['player_icon_5']) && $_FILES['player_icon_5']['error'] === UPLOAD_ERR_OK) {
        // Validate file type and size (optional)
        $fileType = mime_content_type($_FILES['player_icon_5']['tmp_name']);
        if (in_array($fileType, $allowedTypes)) {
            $player_icon_5 = file_get_contents($_FILES['player_icon_5']['tmp_name']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid file type for player_icon_5']);
            exit();
        }
    }
    
    $player_sex_5 = htmlspecialchars($_POST['player_sex_5'], ENT_QUOTES, 'UTF-8');
    $date_of_birth_5 = DateTime::createFromFormat('Y-m-d', $_POST['date_of_birth_5'])->format('Y-m-d'); // Ensure correct date format
    $player_nationality_5 = htmlspecialchars($_POST['player_nationality_5'], ENT_QUOTES, 'UTF-8');
    $player_emso_5 = (int)$_POST['player_emso_5'];
    $player_document_no_5 = htmlspecialchars($_POST['player_document_no_5'], ENT_QUOTES, 'UTF-8');
    $player_position_5 = htmlspecialchars($_POST['player_position_5'], ENT_QUOTES, 'UTF-8');
    $player_jersey_5 = (int)$_POST['player_jersey_5'];
    $player_class_p_5 = (int)$_POST['player_class_p_5']; // Use PDO::PARAM_INT
    $player_class_p_plus_5 = (int)$_POST['player_class_p_plus_5']; // Use PDO::PARAM_INT
    $player_social_media_5 = htmlspecialchars($_POST['player_social_media_5'], ENT_QUOTES, 'UTF-8');
    
    //PLAYER SIX
    $name_6 = htmlspecialchars($_POST['name_6'], ENT_QUOTES, 'UTF-8');
    $nickname_6 = htmlspecialchars($_POST['nickname_6'], ENT_QUOTES, 'UTF-8');
    
    $player_icon_6 = null;
    if (isset($_FILES['player_icon_6']) && $_FILES['player_icon_6']['error'] === UPLOAD_ERR_OK) {
        // Validate file type and size (optional)
        $fileType = mime_content_type($_FILES['player_icon_6']['tmp_name']);
        if (in_array($fileType, $allowedTypes)) {
            $player_icon_6 = file_get_contents($_FILES['player_icon_6']['tmp_name']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid file type for player_icon_6']);
            exit();
        }
    }
    
    $player_sex_6 = htmlspecialchars($_POST['player_sex_6'], ENT_QUOTES, 'UTF-8');
    $date_of_birth_6 = DateTime::createFromFormat('Y-m-d', $_POST['date_of_birth_6'])->format('Y-m-d'); // Ensure correct date format
    $player_nationality_6 = htmlspecialchars($_POST['player_nationality_6'], ENT_QUOTES, 'UTF-8');
    $player_emso_6 = (int)$_POST['player_emso_6'];
    $player_document_no_6 = htmlspecialchars($_POST['player_document_no_6'], ENT_QUOTES, 'UTF-8');
    $player_position_6 = htmlspecialchars($_POST['player_position_6'], ENT_QUOTES, 'UTF-8');
    $player_jersey_6 = (int)$_POST['player_jersey_6'];
    $player_class_p_6 = (int)$_POST['player_class_p_6']; // Use PDO::PARAM_INT
    $player_class_p_plus_6 = (int)$_POST['player_class_p_plus_6']; // Use PDO::PARAM_INT
    $player_social_media_6 = htmlspecialchars($_POST['player_social_media_6'], ENT_QUOTES, 'UTF-8');
    
    //PLAYER SEVEN
    $name_7 = htmlspecialchars($_POST['name_7'], ENT_QUOTES, 'UTF-8');
    $nickname_7 = htmlspecialchars($_POST['nickname_7'], ENT_QUOTES, 'UTF-8');
    
    $player_icon_7 = null;
    if (isset($_FILES['player_icon_7']) && $_FILES['player_icon_7']['error'] === UPLOAD_ERR_OK) {
        // Validate file type and size (optional)
        $fileType = mime_content_type($_FILES['player_icon_7']['tmp_name']);
        if (in_array($fileType, $allowedTypes)) {
            $player_icon_7 = file_get_contents($_FILES['player_icon_7']['tmp_name']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid file type for player_icon_7']);
            exit();
        }
    }
    
    $player_sex_7 = htmlspecialchars($_POST['player_sex_7'], ENT_QUOTES, 'UTF-8');
    $date_of_birth_7 = DateTime::createFromFormat('Y-m-d', $_POST['date_of_birth_7'])->format('Y-m-d'); // Ensure correct date format
    $player_nationality_7 = htmlspecialchars($_POST['player_nationality_7'], ENT_QUOTES, 'UTF-8');
    $player_emso_7 = (int)$_POST['player_emso_7'];
    $player_document_no_7 = htmlspecialchars($_POST['player_document_no_7'], ENT_QUOTES, 'UTF-8');
    $player_position_7 = htmlspecialchars($_POST['player_position_7'], ENT_QUOTES, 'UTF-8');
    $player_jersey_7 = (int)$_POST['player_jersey_7'];
    $player_class_p_7 = (int)$_POST['player_class_p_7']; // Use PDO::PARAM_INT
    $player_class_p_plus_7 = (int)$_POST['player_class_p_plus_7']; // Use PDO::PARAM_INT
    $player_social_media_7 = htmlspecialchars($_POST['player_social_media_7'], ENT_QUOTES, 'UTF-8');
    
    //PLAYER EIGHT
    $name_8 = htmlspecialchars($_POST['name_8'], ENT_QUOTES, 'UTF-8');
    $nickname_8 = htmlspecialchars($_POST['nickname_8'], ENT_QUOTES, 'UTF-8');
    
    $player_icon_8 = null;
    if (isset($_FILES['player_icon_8']) && $_FILES['player_icon_8']['error'] === UPLOAD_ERR_OK) {
        // Validate file type and size (optional)
        $fileType = mime_content_type($_FILES['player_icon_8']['tmp_name']);
        if (in_array($fileType, $allowedTypes)) {
            $player_icon_8 = file_get_contents($_FILES['player_icon_8']['tmp_name']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid file type for player_icon_8']);
            exit();
        }
    }
    
    $player_sex_8 = htmlspecialchars($_POST['player_sex_8'], ENT_QUOTES, 'UTF-8');
    $date_of_birth_8 = isset($_POST['date_of_birth_8']) && !empty($_POST['date_of_birth_8'])
    ? DateTime::createFromFormat('Y-m-d', $_POST['date_of_birth_8'])->format('Y-m-d') 
    : null; // or use a default date like '0000-00-00' if needed
    $player_nationality_8 = htmlspecialchars($_POST['player_nationality_8'], ENT_QUOTES, 'UTF-8');
    $player_emso_8 = (int)$_POST['player_emso_8'];
    $player_document_no_8 = htmlspecialchars($_POST['player_document_no_8'], ENT_QUOTES, 'UTF-8');
    $player_position_8 = htmlspecialchars($_POST['player_position_8'], ENT_QUOTES, 'UTF-8');
    $player_jersey_8 = (int)$_POST['player_jersey_8'];
    $player_class_p_8 = (int)$_POST['player_class_p_8']; // Use PDO::PARAM_INT
    $player_class_p_plus_8 = (int)$_POST['player_class_p_plus_8']; // Use PDO::PARAM_INT
    $player_social_media_8 = htmlspecialchars($_POST['player_social_media_8'], ENT_QUOTES, 'UTF-8');
    
    //PLAYER NINE
    $name_9 = htmlspecialchars($_POST['name_9'], ENT_QUOTES, 'UTF-8');
    $nickname_9 = htmlspecialchars($_POST['nickname_9'], ENT_QUOTES, 'UTF-8');
    
    $player_icon_9 = null;
    if (isset($_FILES['player_icon_9']) && $_FILES['player_icon_9']['error'] === UPLOAD_ERR_OK) {
        // Validate file type and size (optional)
        $fileType = mime_content_type($_FILES['player_icon_9']['tmp_name']);
        if (in_array($fileType, $allowedTypes)) {
            $player_icon_9 = file_get_contents($_FILES['player_icon_9']['tmp_name']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid file type for player_icon_9']);
            exit();
        }
    }
    
    $player_sex_9 = htmlspecialchars($_POST['player_sex_9'], ENT_QUOTES, 'UTF-8');
    $date_of_birth_9 = isset($_POST['date_of_birth_9']) && !empty($_POST['date_of_birth_9'])
    ? DateTime::createFromFormat('Y-m-d', $_POST['date_of_birth_9'])->format('Y-m-d') 
    : null; // or use a default date
    $player_nationality_9 = htmlspecialchars($_POST['player_nationality_9'], ENT_QUOTES, 'UTF-8');
    $player_emso_9 = (int)$_POST['player_emso_9'];
    $player_document_no_9 = htmlspecialchars($_POST['player_document_no_9'], ENT_QUOTES, 'UTF-8');
    $player_position_9 = htmlspecialchars($_POST['player_position_9'], ENT_QUOTES, 'UTF-8');
    $player_jersey_9 = (int)$_POST['player_jersey_9'];
    $player_class_p_9 = (int)$_POST['player_class_p_9']; // Use PDO::PARAM_INT
    $player_class_p_plus_9 = (int)$_POST['player_class_p_plus_9']; // Use PDO::PARAM_INT
    $player_social_media_9 = htmlspecialchars($_POST['player_social_media_9'], ENT_QUOTES, 'UTF-8');
    
    //PLAYER TEN
    $name_10 = htmlspecialchars($_POST['name_10'], ENT_QUOTES, 'UTF-8');
    $nickname_10 = htmlspecialchars($_POST['nickname_10'], ENT_QUOTES, 'UTF-8');
    
    $player_icon_10 = null;
    if (isset($_FILES['player_icon_10']) && $_FILES['player_icon_10']['error'] === UPLOAD_ERR_OK) {
        // Validate file type and size (optional)
        $fileType = mime_content_type($_FILES['player_icon_10']['tmp_name']);
        if (in_array($fileType, $allowedTypes)) {
            $player_icon_10 = file_get_contents($_FILES['player_icon_10']['tmp_name']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid file type for player_icon_10']);
            exit();
        }
    }
    
    $player_sex_10 = htmlspecialchars($_POST['player_sex_10'], ENT_QUOTES, 'UTF-8');
    $date_of_birth_10 = isset($_POST['date_of_birth_10']) && !empty($_POST['date_of_birth_10'])
    ? DateTime::createFromFormat('Y-m-d', $_POST['date_of_birth_10'])->format('Y-m-d') 
    : null; // or use a default date
    $player_nationality_10 = htmlspecialchars($_POST['player_nationality_10'], ENT_QUOTES, 'UTF-8');
    $player_emso_10 = (int)$_POST['player_emso_10'];
    $player_document_no_10 = htmlspecialchars($_POST['player_document_no_10'], ENT_QUOTES, 'UTF-8');
    $player_position_10 = htmlspecialchars($_POST['player_position_10'], ENT_QUOTES, 'UTF-8');
    $player_jersey_10 = (int)$_POST['player_jersey_10'];
    $player_class_p_10 = (int)$_POST['player_class_p_10']; // Use PDO::PARAM_INT
    $player_class_p_plus_10 = (int)$_POST['player_class_p_plus_10']; // Use PDO::PARAM_INT
    $player_social_media_10 = htmlspecialchars($_POST['player_social_media_10'], ENT_QUOTES, 'UTF-8');
    
    $teamId = tournament::addPlayerPhygitalFootball(
        $company_name, $team_name, $team_logo, $country, $city, $team_representative, 
        $contact_number, $contact_email, $about, $team_social_media, 
        $name_1, $nickname_1, $player_icon_1, $player_sex_1, $date_of_birth_1, 
        $player_nationality_1, $player_emso_1, $player_document_no_1, 
        $player_position_1, $player_jersey_1, $player_class_p_1, 
        $player_class_p_plus_1, $player_social_media_1
    );

    if ($teamId) {
        echo json_encode(['status' => 'success', 'message' => 'Prijava je bila uspešno oddana', 'teamId' => $teamId]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Prijava ni bila oddana. Prosimo, ponovno preverite vnešene podatke pri igralcu 1.']);
    }
    
    $teamId = tournament::addPlayerPhygitalFootball(
        $company_name, $team_name, null, $country, $city, $team_representative, 
        $contact_number, $contact_email, $about, $team_social_media, 
        $name_2, $nickname_2, $player_icon_2, $player_sex_2, $date_of_birth_2, 
        $player_nationality_2, $player_emso_2, $player_document_no_2, 
        $player_position_2, $player_jersey_2, $player_class_p_2, 
        $player_class_p_plus_2, $player_social_media_2
    );

    if ($teamId) {
        echo json_encode(['status' => 'success', 'message' => 'Prijava je bila uspešno oddana', 'teamId' => $teamId]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Prijava ni bila oddana. Prosimo, ponovno preverite vnešene podatke pri igralcu 2.']);
    }

    // Player 3
    $teamId = tournament::addPlayerPhygitalFootball(
        $company_name, $team_name, null, $country, $city, $team_representative, 
        $contact_number, $contact_email, $about, $team_social_media, 
        $name_3, $nickname_3, $player_icon_3, $player_sex_3, $date_of_birth_3, 
        $player_nationality_3, $player_emso_3, $player_document_no_3, 
        $player_position_3, $player_jersey_3, $player_class_p_3, 
        $player_class_p_plus_3, $player_social_media_3
    );

    if ($teamId) {
        echo json_encode(['status' => 'success', 'message' => 'Prijava je bila uspešno oddana', 'teamId' => $teamId]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Prijava ni bila oddana. Prosimo, ponovno preverite vnešene podatke pri igralcu 3.']);
    }

    // Player 4
    $teamId = tournament::addPlayerPhygitalFootball(
        $company_name, $team_name, null, $country, $city, $team_representative, 
        $contact_number, $contact_email, $about, $team_social_media, 
        $name_4, $nickname_4, $player_icon_4, $player_sex_4, $date_of_birth_4, 
        $player_nationality_4, $player_emso_4, $player_document_no_4, 
        $player_position_4, $player_jersey_4, $player_class_p_4, 
        $player_class_p_plus_4, $player_social_media_4
    );

    if ($teamId) {
        echo json_encode(['status' => 'success', 'message' => 'Prijava je bila uspešno oddana', 'teamId' => $teamId]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Prijava ni bila oddana. Prosimo, ponovno preverite vnešene podatke pri igralcu 4.']);
    }

    // Player 5
    $teamId = tournament::addPlayerPhygitalFootball(
        $company_name, $team_name, null, $country, $city, $team_representative, 
        $contact_number, $contact_email, $about, $team_social_media, 
        $name_5, $nickname_5, $player_icon_5, $player_sex_5, $date_of_birth_5, 
        $player_nationality_5, $player_emso_5, $player_document_no_5, 
        $player_position_5, $player_jersey_5, $player_class_p_5, 
        $player_class_p_plus_5, $player_social_media_5
    );

    if ($teamId) {
        echo json_encode(['status' => 'success', 'message' => 'Prijava je bila uspešno oddana', 'teamId' => $teamId]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Prijava ni bila oddana. Prosimo, ponovno preverite vnešene podatke pri igralcu 5.']);
    }

    // Player 6
    $teamId = tournament::addPlayerPhygitalFootball(
        $company_name, $team_name, null, $country, $city, $team_representative, 
        $contact_number, $contact_email, $about, $team_social_media, 
        $name_6, $nickname_6, $player_icon_6, $player_sex_6, $date_of_birth_6, 
        $player_nationality_6, $player_emso_6, $player_document_no_6, 
        $player_position_6, $player_jersey_6, $player_class_p_6, 
        $player_class_p_plus_6, $player_social_media_6
    );

    if ($teamId) {
        echo json_encode(['status' => 'success', 'message' => 'Prijava je bila uspešno oddana', 'teamId' => $teamId]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Prijava ni bila oddana. Prosimo, ponovno preverite vnešene podatke pri igralcu 6.']);
    }

    // Player 7
    $teamId = tournament::addPlayerPhygitalFootball(
        $company_name, $team_name, null, $country, $city, $team_representative, 
        $contact_number, $contact_email, $about, $team_social_media, 
        $name_7, $nickname_7, $player_icon_7, $player_sex_7, $date_of_birth_7, 
        $player_nationality_7, $player_emso_7, $player_document_no_7, 
        $player_position_7, $player_jersey_7, $player_class_p_7, 
        $player_class_p_plus_7, $player_social_media_7
    );

    if ($teamId) {
        echo json_encode(['status' => 'success', 'message' => 'Prijava je bila uspešno oddana', 'teamId' => $teamId]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Prijava ni bila oddana. Prosimo, ponovno preverite vnešene podatke pri igralcu 7.']);
    }

    // Player 8
    if (!empty($date_of_birth_8)) {
        $teamId = tournament::addPlayerPhygitalFootball(
            $company_name, $team_name, null, $country, $city, $team_representative, 
            $contact_number, $contact_email, $about, $team_social_media, 
            $name_8, $nickname_8, $player_icon_8, $player_sex_8, $date_of_birth_8, 
            $player_nationality_8, $player_emso_8, $player_document_no_8, 
            $player_position_8, $player_jersey_8, $player_class_p_8, 
            $player_class_p_plus_8, $player_social_media_8
        );

        if ($teamId) {
            echo json_encode(['status' => 'success', 'message' => 'Prijava je bila uspešno oddana', 'teamId' => $teamId]);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Prijava ni bila oddana. Prosimo, ponovno preverite vnešene podatke pri igralcu 8.']);
        }
    }

    // Player 9
    if (!empty($date_of_birth_9)) {
        $teamId = tournament::addPlayerPhygitalFootball(
            $company_name, $team_name, null, $country, $city, $team_representative, 
            $contact_number, $contact_email, $about, $team_social_media, 
            $name_9, $nickname_9, $player_icon_9, $player_sex_9, $date_of_birth_9, 
            $player_nationality_9, $player_emso_9, $player_document_no_9, 
            $player_position_9, $player_jersey_9, $player_class_p_9, 
            $player_class_p_plus_9, $player_social_media_9
        );

        if ($teamId) {
            echo json_encode(['status' => 'success', 'message' => 'Prijava je bila uspešno oddana', 'teamId' => $teamId]);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Prijava ni bila oddana. Prosimo, ponovno preverite vnešene podatke pri igralcu 9.']);
        }
    }

    // Player 10
    if (!empty($date_of_birth_10)) {
        $teamId = tournament::addPlayerPhygitalFootball(
            $company_name, $team_name, null, $country, $city, $team_representative, 
            $contact_number, $contact_email, $about, $team_social_media, 
            $name_10, $nickname_10, $player_icon_10, $player_sex_10, $date_of_birth_10, 
            $player_nationality_10, $player_emso_10, $player_document_no_10, 
            $player_position_10, $player_jersey_10, $player_class_p_10, 
            $player_class_p_plus_10, $player_social_media_10
        );

        if ($teamId) {
            echo json_encode(['status' => 'success', 'message' => 'Prijava je bila uspešno oddana', 'teamId' => $teamId]);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Prijava ni bila oddana. Prosimo, ponovno preverite vnešene podatke pri igralcu 10.']);
        }
    }
?>
