<div id="editor-wrapper">
    <?php if(isset($_GET['action']) && $_GET['action'] == "edit_page_details") { 
        if(isset($blockContent['WBC_block_content_id']) && $blockContent['WBC_section_block_id'] == $section['WSB_section_block_id']) { ?>
            <div id="editor-toolbar" class="editor-toolbar" toolbar-id="editorblocktoolbar<?= $blockContent['WBC_block_content_id'] ?>">
        <?php } else { ?>         
            <div id="editor-toolbar" class="editor-toolbar" toolbar-id="editortoolbar<?= $section['WS_section_id'] ?>">
        <?php }
        } else { ?>
        <div id="editor-toolbar" class="editor-toolbar" toolbar-id="editorwebsiteDefault">
    <?php } ?>
        <span class="ql-formats">
            <select class="ql-size"></select>
        </span>
        <span class="ql-formats">
            <button class="ql-bold"></button>
            <button class="ql-italic"></button>
            <button class="ql-underline"></button>
            <button class="ql-strike"></button>
        </span>
        <span class="ql-formats">
            <select class="ql-color"></select>
            <select class="ql-background"></select>
        </span>
        <span class="ql-formats">
            <button class="ql-script" value="sub"></button>
            <button class="ql-script" value="super"></button>
        </span>
        <span class="ql-formats">
            <button class="ql-header" value="1"></button>
            <button class="ql-header" value="2"></button>
            <button class="ql-blockquote"></button>
        </span>
        <span class="ql-formats">
            <button class="ql-list" value="ordered"></button>
            <button class="ql-list" value="bullet"></button>
            <button class="ql-indent" value="-1"></button>
            <button class="ql-indent" value="+1"></button>
        </span>
        <span class="ql-formats">
            <button class="ql-direction" value="rtl"></button>
            <select class="ql-align"></select>
        </span>
        <span class="ql-formats">
            <button class="ql-link"></button>
            <button class="ql-image"></button>
            <button class="ql-video"></button>
        </span>
        <span class="ql-formats">
            <button class="ql-clean"></button>
        </span>
    </div>
    <?php if(isset($_GET['action']) && $_GET['action'] == "edit_page_details") { 
        if(isset($blockContent['WBC_block_content_id']) && $blockContent['WBC_section_block_id'] == $section['WSB_section_block_id']) { ?>
            <div id="editor-container" class="editor-container editor-block-container" container-id="editorblockcontainer<?= $blockContent['WBC_block_content_id'] ?>">
        <?php } else { ?>         
            <div id="editor-container" class="editor-container editor-section-container" container-id="editorcontainer<?= $section['WS_section_id'] ?>">
        <?php }         
        if($section['WS_variant_id'] == 1) { 
            if(isset($blockContent['WBC_block_content_id'])) { ?>            
                <?= $blockContent['WBC_block_text'] ?>
            <?php } else { ?>
                <?= $section['WSB_block_rich_text'] ?>
            <?php }
        } ?>  
        </div> <?php 
    } else if(isset($_GET['action']) && $_GET['action'] == "edit_page_header_footer") { ?>
        <div id="editor-container" class="editor-container editor-block-container" container-id="editorwebsiteDefault">
            <?= $pageDefault['footer_about'] ?>
        </div>
    <?php } else if(isset($_GET['news_id']) && $_GET['tab'] == "news_editor") { ?>
        <div id="editor-container" class="editor-container editor-block-container" container-id="editorwebsiteNews">
            <?= $content ?>
        </div>
    <?php } else if(!isset($_GET['news_id']) && $_GET['tab'] == "news_editor") { ?>
        <div id="editor-container" class="editor-container editor-block-container" container-id="editorwebsiteNews">

        </div>
    <?php } ?> 
</div>