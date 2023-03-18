var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);

function deleteUser(command) {
    console.log(command);
    $(".delete-user-modal .modal-footer .delete-button").attr("href", command);
}

function openFileSelector(id, typeOfContent) {
    $(".content-sidebar-wrapper").each(function (index) {
        if ($(this).attr("dirPath") === $(this).attr("origiDir")) {
            $(this).toggleClass("active");
        }
        $(this).attr("lookingForContent", typeOfContent + "-" + id);        
    });
    
}

function openCorrectFileSelector(selector) {
    $(".content-sidebar-wrapper").removeClass("active");
    $(".content-sidebar-wrapper").each(function (index) {
        if ($(this).attr("dirpath") === selector) {
            $(this).toggleClass("active");
        }
    });
}

function closeFileSelector() {
    $(".content-sidebar-wrapper").removeClass("active");
}

function openFileUploader() {
    console.log("hm");
    $(".content-upload-sidebar").toggleClass("active");
}

function uploadFile(filePath, formID) {

    let pageDetailsFormData = new FormData();
    pageDetailsFormData.append("filename", $(formID).prop('files')[0]);
    var blockInfo = $(".content-sidebar-wrapper").attr("lookingforcontent");
    blockInfo = blockInfo.split("-");

    let pageDetailsFormDataXHR = new XMLHttpRequest();
    pageDetailsFormDataXHR.open("POST", "Controllers/media_add_file.php?target_dir=" + filePath + "&contentType=" + blockInfo[0] + "&contentID=" + blockInfo[1]);
    pageDetailsFormDataXHR.send(pageDetailsFormData);

}

function uploadImageToDatabase(data) {
    var myFormID = "form#" + data.substring(1, data.length).replaceAll("/", "_") + " input#myFile";
    uploadFile(data, myFormID);
}

function openInputFileForm(data) {
    var myFormID = "form#" + data.substring(1, data.length).replaceAll("/", "_") + " input#myFile   ";   
    $(myFormID).click();
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
            var sectionID = $(".accordion-body .section-block-info", this).attr("section-id");
            pageSectionBlockFormData.append("section-name", $(".accordion-body #section-name", this).val());
            pageSectionBlockFormData.append("section-class", $(".accordion-body #section-class", this).val());
            pageSectionBlockFormData.append("section-header", $(".accordion-body #section-header", this).val());
            pageSectionBlockFormData.append("section-subheader", $(".accordion-body #section-subheader", this).val());
            var location = 'editor' + $(".accordion-body .editor-section-container", this).attr("container-id");    
            pageSectionBlockFormData.append("section-rich-text", window[location].root.innerHTML);
            var blockTemplateID = $(".accordion-body .template-dropdown li a.active", this).attr("template-id");
            if (typeof blockTemplateID === 'undefined') {
                blockTemplateID = 1;
            }
            pageSectionBlockFormData.append("section-template", blockTemplateID);

            let pageSectionBlockFormDataXHR = new XMLHttpRequest(); 
            pageSectionBlockFormDataXHR.open("POST", "Controllers/Website/Page/website_edit_block_section.php?page_id=" + page_id + "&lang_id=" + lang_id + "&section_id=" + sectionID);
            pageSectionBlockFormDataXHR.send(pageSectionBlockFormData);

            var blockContentList = $(".accordion-body .section-block-content .accordion .accordion-item", this);

            let pageSectionBlockContentFormData = new FormData();
            blockContentList.each(function (blockIndex) {
                pageSectionBlockContentFormData.append("block-content-id", $(".accordion-body", this).attr("block-id"));
                pageSectionBlockContentFormData.append("sequence-num", $(".accordion-body", this).attr("sequence-num"));
                //dodaj še image
                pageSectionBlockContentFormData.append("block-content-link", $(".accordion-body #block-content-link", this).val());
                pageSectionBlockContentFormData.append("block-content-heading", $(".accordion-body #block-content-heading", this).val());
                pageSectionBlockContentFormData.append("block-content-subheading", $(".accordion-body #block-content-subheading", this).val());
                var blocklocation = 'editor' + $(".accordion-body .editor-block-container", this).attr("container-id");
                pageSectionBlockContentFormData.append("block-content-text", window[blocklocation].root.innerHTML);

                let pageSectionBlockContentFormDataXHR = new XMLHttpRequest();
                pageSectionBlockContentFormDataXHR.open("POST", "Controllers/Website/Page/website_edit_block_content.php?page_id=" + page_id + "&lang_id=" + lang_id);
                pageSectionBlockContentFormDataXHR.send(pageSectionBlockContentFormData);
            });
        }
        else if ($(".accordion-body", this).attr("variant-id") == 2) {
            console.log("que");
        }
    });

}
