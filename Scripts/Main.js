var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);

function deleteUser(command) {
    console.log(command);
    $(".delete-user-modal .modal-footer .delete-button").attr("href", command);
}

function submitPageChanges(page_id, lang_id) {
    let pageDetailsFormData = new FormData();
    pageDetailsFormData.append("page_title", document.getElementById("page_title").value);
    pageDetailsFormData.append("meta_name", document.getElementById("meta_name").value);
    pageDetailsFormData.append("meta_description", document.getElementById("meta_description").value);
    pageDetailsFormData.append("meta_keyword", document.getElementById("meta_keyword").value);

    let pageDetailsFormDataXHR = new XMLHttpRequest();
    pageDetailsFormDataXHR.open("POST", "Controllers/Website/Page/website_edit_page_details.php?page_id=" + page_id + "&lang_id=" + lang_id);
    pageDetailsFormDataXHR.send(pageDetailsFormData);

    let pageSectionBlockFormData = new FormData();

    $(".accordion-item").each(function (index) {
        if ($(".accordion-body", this).attr("variant-id") == 1) {
            pageSectionBlockFormData.append("section-name", $(".accordion-body #section-name", this).val());
            pageSectionBlockFormData.append("section-class", $(".accordion-body #section-class", this).val());
            pageSectionBlockFormData.append("section-header", $(".accordion-body #section-header", this).val());
            pageSectionBlockFormData.append("section-subheader", $(".accordion-body #section-subheader", this).val());
        }
        else if ($(".accordion-body", this).attr("variant-id") == 2) {
            console.log("que");
        }
    });

}
