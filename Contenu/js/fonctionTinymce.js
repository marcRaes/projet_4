function initialisationTinymce() {
    tinymce.init({
        selector: 'textarea',
        language: "fr_FR",
        height: 380,
        theme: 'modern',
        plugins: 'preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen charmap hr pagebreak nonbreaking anchor advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat'
    });
}

initialisationTinymce();
