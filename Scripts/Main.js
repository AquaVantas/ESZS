var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);

function deleteUser(command) {
    console.log(command);
    $(".delete-user-modal .modal-footer .delete-button").attr("href", command);
}

function setTemplateTitle(data) {
    var templateID = $(data).attr("template-id");
    var button = $(data).parents(".dropdown").find("button");
    $(data).parents(".dropdown").attr("template-id", templateID);
    $(button).text($(data).text());
    console.log(data);
    console.log(button);
}

function selectThisFile(selected_image) {
    var contentType = $(".content-sidebar-wrapper.active").attr("lookingforcontent");
    contentType = contentType.split("-");
    var chosenBlock = $(".accordion-body");
    console.log(chosenBlock);
    if (contentType[0] == "blockContent") {
        for(var i = 0; i < chosenBlock.length; i++) {
            if ($(chosenBlock[i]).attr("block-id") == contentType[1]) {
                chosenBlock = chosenBlock[i];
            }
        }
    }
    if (contentType[0] == "buttonContent") {
        for (var i = 0; i < chosenBlock.length; i++) {
            if ($(chosenBlock[i]).attr("button-id") == contentType[1]) {
                chosenBlock = chosenBlock[i];
            }
        }
    }
    if (contentType[0] == "sectionForm") {
        for (var i = 0; i < chosenBlock.length; i++) {
            if ($(chosenBlock[i]).attr("form-id") == contentType[1]) {
                chosenBlock = chosenBlock[i];
            }
        }
    }
    if (contentType[0] == "websiteDefaultHeader") {
        chosenBlock = $(".website-header");
    }
    if (contentType[0] == "websiteDefaultFooter") {
        chosenBlock = $(".website-footer");
    }

    var chosenImagePicker = $(chosenBlock).find(".add-image-wrapper")[0];
    $(chosenImagePicker).attr("chosen-image-id", selected_image);
    $(chosenImagePicker).empty();
    $(chosenImagePicker).append("<img src='' alt='refresh-to-see'/>");
    $(".media-folder-image").removeClass("chosen-image");
    $($(".media-folder-wrapper[image-id=" + selected_image + "]").find(".media-folder-image")).toggleClass("chosen-image");
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
    console.log("I happened");
}

function closeFileSelector() {
    $(".content-sidebar-wrapper").removeClass("active");
}

function openFileUploader() {
    console.log("hm");
    $(".content-upload-sidebar").toggleClass("active");
}

function uploadFile(filePath, formID) {
    filePath = filePath.replaceAll('.', '_');
    formID = formID.replaceAll('.', '_');
    let pageDetailsFormData = new FormData();
    pageDetailsFormData.append("filename", $(formID).prop('files')[0]);
    var blockInfo = $(".content-sidebar-wrapper").attr("lookingforcontent");
    blockInfo = blockInfo.split("-");

    let pageDetailsFormDataXHR = new XMLHttpRequest();
    pageDetailsFormDataXHR.open("POST", "Controllers/Website/Media/media_add_file.php?target_dir=" + filePath + "&contentType=" + blockInfo[0] + "&contentID=" + blockInfo[1]);
    pageDetailsFormDataXHR.send(pageDetailsFormData);

}

function uploadImageToDatabase(data) {
    var myFormID = "form#" + data.substring(1, data.length).replaceAll("/", "_") + " input#myFile";
    uploadFile(data, myFormID);
}

function openInputFileForm(data) {
    var myFormID = "form#" + data.substring(1, data.length).replaceAll("/", "_").replaceAll(".", "_") + " input#myFile";   
    $(myFormID).click();
}

function deleteThisImage(image) {
    $(image).parent().attr("chosen-image-id", null);
}

function submitPageChanges(page_id, lang_id) {
    let pageDetailsFormData = new FormData();
    pageDetailsFormData.append("page_published", $("#page_published").is(":checked"));
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
            pageSectionBlockFormData.append("section-template", $(".accordion-body #section-template", this).attr("template-id"));
            var location = 'editor' + $(".accordion-body .editor-section-container", this).attr("container-id");    
            pageSectionBlockFormData.append("section-rich-text", window[location].root.innerHTML);
            
            let pageSectionBlockFormDataXHR = new XMLHttpRequest(); 
            pageSectionBlockFormDataXHR.open("POST", "Controllers/Website/Page/website_edit_block_section.php?page_id=" + page_id + "&lang_id=" + lang_id + "&section_id=" + sectionID);
            pageSectionBlockFormDataXHR.send(pageSectionBlockFormData);

            var blockContentList = $(".accordion-body .section-block-content .accordion .block-content-item", this);
            let pageSectionBlockContentFormData = new FormData();
            blockContentList.each(function (blockIndex) {
                pageSectionBlockContentFormData.append("block-content-id", $(".accordion-body", this).attr("block-id"));
                pageSectionBlockContentFormData.append("sequence-num", $(".accordion-body", this).attr("sequence-num"));
                pageSectionBlockContentFormData.append("block-content-image", $(".accordion-body #block-content-image", this).attr("chosen-image-id"));
                pageSectionBlockContentFormData.append("block-content-link", $(".accordion-body #block-content-link", this).val());
                pageSectionBlockContentFormData.append("block-content-heading", $(".accordion-body #block-content-heading", this).val());
                pageSectionBlockContentFormData.append("block-content-subheading", $(".accordion-body #block-content-subheading", this).val());
                var blocklocation = 'editor' + $(".accordion-body .editor-block-container", this).attr("container-id");
                pageSectionBlockContentFormData.append("block-content-text", window[blocklocation].root.innerHTML);

                let pageSectionBlockContentFormDataXHR = new XMLHttpRequest();
                pageSectionBlockContentFormDataXHR.open("POST", "Controllers/Website/Page/website_edit_block_content.php?page_id=" + page_id + "&lang_id=" + lang_id);
                pageSectionBlockContentFormDataXHR.send(pageSectionBlockContentFormData);

                var blockContentButtonList = $(".block-content-button-item", this);
                let pageSectionBlockContentButtonFormData = new FormData();
                blockContentButtonList.each(function (blockContentButtonIndex) {
                    pageSectionBlockContentButtonFormData.append("button-id", $(".accordion-body", this).attr("button-id"));
                    pageSectionBlockContentButtonFormData.append("button-image", $(".accordion-body #button-image", this).attr("chosen-image-id"));
                    pageSectionBlockContentButtonFormData.append("button-heading", $(".accordion-body #button-heading", this).val());
                    pageSectionBlockContentButtonFormData.append("button-link", $(".accordion-body #button-link", this).val());
                    pageSectionBlockContentButtonFormData.append("button-anchor", $(".accordion-body #button-anchor", this).val());
                    pageSectionBlockContentButtonFormData.append("button-link-heading", $(".accordion-body #button-link-heading", this).val());
                    pageSectionBlockContentButtonFormData.append("button-page-link", $(".accordion-body .page-list-wrapper input:checked", this).attr("value"));
                    pageSectionBlockContentButtonFormData.append("button-target", $(".accordion-body #button-target", this).is(":checked"));

                    let pageSectionBlockContentButtonFormDataXHR = new XMLHttpRequest();
                    pageSectionBlockContentButtonFormDataXHR.open("POST", "Controllers/Website/Page/website_edit_block_content_button.php?page_id=" + page_id + "&lang_id=" + lang_id);
                    pageSectionBlockContentButtonFormDataXHR.send(pageSectionBlockContentButtonFormData);
                });
            });
        }
        else if ($(".accordion-body", this).attr("variant-id") == 2) {
            let pageSectionFormFormData = new FormData();
            var sectionID = $(".accordion-body", this).attr("section-id");
            console.log(sectionID);
            pageSectionFormFormData.append("form-image", $("#form-image", this).attr("chosen-image-id"));
            pageSectionFormFormData.append("section-name", $("#section-name", this).val());
            pageSectionFormFormData.append("section-class", $("#section-class", this).val());
            pageSectionFormFormData.append("section-header", $("#section-header", this).val());
            pageSectionFormFormData.append("section-subheader", $("#section-subheader", this).val());
            pageSectionFormFormData.append("form-receivers", $("#form-receivers", this).val());
            pageSectionFormFormData.append("section-template", $("#section-template", this).attr("template-id"));

            let pageSectionFormFormDataXHR = new XMLHttpRequest();
            pageSectionFormFormDataXHR.open("POST", "Controllers/Website/Page/website_edit_form_section.php?page_id=" + page_id + "&lang_id=" + lang_id + "&section_id=" + sectionID);
            pageSectionFormFormDataXHR.send(pageSectionFormFormData);
        }
    });

}

function submitWebsiteDefault(lang_id) {
    let pageDetailsFormData = new FormData();
    pageDetailsFormData.append("website_title", document.getElementById("website_title").value);
    pageDetailsFormData.append("header_logo", $("#header_logo").attr("chosen-image-id"));
    pageDetailsFormData.append("footer_logo", $("#footer_logo").attr("chosen-image-id"));
    pageDetailsFormData.append("footer_copyright", document.getElementById("footer_copyright").value);
    pageDetailsFormData.append("footer_about", $(".ql-editor")[0].innerHTML);

    let pageDetailsFormDataXHR = new XMLHttpRequest();
    pageDetailsFormDataXHR.open("POST", "Controllers/Website/Page/website_edit_default.php?lang_id=" + lang_id);
    pageDetailsFormDataXHR.send(pageDetailsFormData);

    var blockContentButtonList = $(".block-content-button-item");
    let pageSectionBlockContentButtonFormData = new FormData();
    blockContentButtonList.each(function (blockContentButtonIndex) {
        pageSectionBlockContentButtonFormData.append("button-id", $(".accordion-body", this).attr("button-id"));
        pageSectionBlockContentButtonFormData.append("button-image", $(".accordion-body #button-image", this).attr("chosen-image-id"));
        pageSectionBlockContentButtonFormData.append("button-heading", $(".accordion-body #button-heading", this).val());
        pageSectionBlockContentButtonFormData.append("button-link", $(".accordion-body #button-link", this).val());
        pageSectionBlockContentButtonFormData.append("button-anchor", $(".accordion-body #button-anchor", this).val());
        pageSectionBlockContentButtonFormData.append("button-link-heading", $(".accordion-body #button-link-heading", this).val());
        pageSectionBlockContentButtonFormData.append("button-page-link", $(".accordion-body .page-list-wrapper input:checked", this).attr("value"));
        pageSectionBlockContentButtonFormData.append("button-target", $(".accordion-body #button-target", this).is(":checked"));

        let pageSectionBlockContentButtonFormDataXHR = new XMLHttpRequest();
        pageSectionBlockContentButtonFormDataXHR.open("POST", "Controllers/Website/Page/website_edit_block_content_button.php?lang_id=" + lang_id);
        pageSectionBlockContentButtonFormDataXHR.send(pageSectionBlockContentButtonFormData);
    });
}
