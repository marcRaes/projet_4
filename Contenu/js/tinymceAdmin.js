function initializationTinymceAdmin() {
    tinymce.init({
        selector: 'textarea',
        language: "fr_FR",
        resize: "both",
        height: 450,
        theme: "modern",
        branding: false,
        plugins: "preview fullscreen textcolor colorpicker help",
        toolbar1: "formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat"
    });
}

initializationTinymceAdmin();
