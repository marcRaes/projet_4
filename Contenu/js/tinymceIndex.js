function initializationTinymceIndex() {
    tinymce.init({
        selector: 'textarea',
        language: "fr_FR",
        height: 300,
        theme: "modern",
        branding: false,
        menubar: false,
        statusbar: false,
        toolbar: false
    });
}

initializationTinymceIndex();
