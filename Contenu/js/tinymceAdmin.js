function initialisationTinymce() {
    tinymce.init({
        selector: 'textarea',
        language: "fr_FR",
        height: 450,
        theme: 'modern',
        plugins: 'preview fullscreen textcolor colorpicker help',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat'
    });
}

initialisationTinymce();