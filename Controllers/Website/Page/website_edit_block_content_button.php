<?php
    // Include the database connection code from "website_database.php"
    require_once("../../../Internal/website_database.php");

    // Initialize variables with default values to avoid errors
    $lang_id = isset($_GET['lang_id']) ? $_GET['lang_id'] : 1;
    $button_id = isset($_POST['button-id']) ? intval($_POST['button-id']) : null;
    $button_image = isset($_POST['button-image']) ? intval($_POST['button-image']) : null;
    $button_heading = $_POST['button-heading'];
    $button_link = $_POST['button-link'];
    $button_anchor = $_POST['button-anchor'];
    $button_link_heading = $_POST['button-link-heading'];
    $button_page_link = isset($_POST['button-page-link']) && $_POST['button-page-link'] !== 'undefined' ? $_POST['button-page-link'] : null;
    $button_target = isset($_POST['button-target']) && $_POST['button-target'] === "true" ? 1 : 0;

    // Perform database updates if button_id is not null
    if ($button_id !== null) {
        // Use prepared statements to prevent SQL injection
        $updateButtonContent = website::updateWebsiteBlockContentButton($button_id, $button_heading, $button_image);
        $updateButtonLink = website::updateWebsiteBlockContentButtonLink($button_id, $button_link, $button_anchor, $button_link_heading, $button_target, $button_page_link);

        if ($updateButtonContent && $updateButtonLink) {
            // Redirect back to the appropriate page
            header('Location: ../../../cpanel.php?tab=webpage_editor&action=edit_page_details&page_id=' . $_GET['page_id'] . '&lang_id=' . $lang_id);
        } else {
            // Handle database update errors (e.g., display an error message)
            echo "Error updating the button content. Please try again or contact support.";
        }
    } else {
        // Handle the case where button_id is null
        echo "Invalid button ID. Please provide a valid button ID for updates.";
    }
?>