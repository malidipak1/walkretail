tinymce.init({
    selector: "textarea",
    theme: "modern",
    width: 800,
    height: 600,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],
   content_css: "css/content.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | fontselect |  fontsizeselect", 
   image_advtab: true,
   fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ],
	 image_list: [ 
        {title: 'My image 1', value: 'http://www.tinymce.com/my1.gif'}, 
        {title: 'My image 2', value: 'http://www.moxiecode.com/my2.gif'} 
    ]
 }); 
