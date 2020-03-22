
CKEDITOR.editorConfig = function (config) {
    
    config.extraPlugins = 'videoembed,video';
    config.toolbar_Basic =
    [
        ['SwitchBar', '-', 'Bold', 'Italic', 'Underline'],
        ['Link', 'Unlink'],
        ['Font', 'FontSize','TextColor', 'BGColor']
    ];
    config.toolbar_Full =
    [
        ['SwitchBar', '-', 'Source', '-', 'NewPage'],
        ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Print', 'SpellChecker', 'Scayt'],
        ['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'],
        ['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript'],
        ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote', 'CreateDiv'],
        ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
        ['BidiLtr', 'BidiRtl'],
        ['Link', 'Unlink', 'Anchor'],
        ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'],
        ['Styles', 'Format', 'Font', 'FontSize'],
        ['TextColor', 'BGColor'],
        ['Maximize', 'ShowBlocks']
    ];

    config.filebrowserBrowseUrl = 'js/ckfinder/ckfinder.html?type=Files';
    config.filebrowserImageBrowseUrl = 'js/ckfinder/ckfinder.html?type=Images';
    config.filebrowserFlashBrowseUrl = 'js/ckfinder/ckfinder.html?type=Flash';
    config.filebrowserUploadUrl = 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl = 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
