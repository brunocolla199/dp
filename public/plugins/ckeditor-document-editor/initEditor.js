  
function initEditor(content, customCSS, base_path){

    CKEDITOR.replace( 'speed-editor', {
        // Define the toolbar: http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_toolbar
        // The full preset from CDN which we used as a base provides more features than we need.
        // Also by default it comes with a 3-line toolbar. Here we put all buttons in a single row.
        toolbar: [
            { name: 'document', items: [ 'Print', 'PasteFromWord' ] },
            { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
            { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting' ] },
            { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
            { name: 'align', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
            { name: 'links', items: [ 'Link', 'Unlink' ] },
            { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
            { name: 'insert', items: [ 'Image', 'Table', 'PageBreak', 'SpecialChar' ] },
            { name: 'tools', items: [  ] },
            { name: 'editing', items: [  ] }
        ],

        

        font_names : 
        'Arial/Arial, Helvetica, sans-serif;'+
        'Comic Sans MS/Comic Sans MS, cursive;'+
        'Courier New/Courier New, Courier, monospace;' +
        'Georgia/Georgia, serif;' +
        'Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;' +
        'Tahoma/Tahoma, Geneva, sans-serif;' +
        'Times New Roman/Times New Roman, Times, serif;' +
        'Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;' +
        'Calibri/Calibri, Calibri, sans-serif;' + /* here is your font */
        'Verdana/Verdana, Geneva, sans-serif',
        
        // Since we define all configuration options here, let's instruct CKEditor to not load config.js which it does by default.
        // One HTTP request less will result in a faster startup time.
        // For more information check http://docs.ckeditor.com/ckeditor4/docs/#!/api/CKEDITOR.config-cfg-customConfig
        customConfig: base_path+'plugins/ckeditor-document-editor/initEditor.js',
        
        // Sometimes applications that convert HTML to PDF prefer setting image width through attributes instead of CSS styles.
        // For more information check:
        //  - About Advanced Content Filter: http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_advanced_content_filter
        //  - About Disallowed Content: http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_disallowed_content
        //  - About Allowed Content: http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_allowed_content_rules
        disallowedContent: 'img{width,height,float}',
        extraAllowedContent: 'img[width,height,align]',
        
        // Enabling extra plugins, available in the full-all preset: http://ckeditor.com/presets-all
        extraPlugins: 'tableresize,uploadimage,uploadfile',
        
        /*********************** File management support ***********************/
        // In order to turn on support for file uploads, CKEditor has to be configured to use some server side
        // solution with file upload/management capabilities, like for example CKFinder.
        // For more information see http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_ckfinder_integration
        
        // Uncomment and correct these lines after you setup your local CKFinder instance.
        // filebrowserBrowseUrl: 'http://example.com/ckfinder/ckfinder.html',
        // filebrowserUploadUrl: 'http://example.com/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        /*********************** File management support ***********************/
        
        // Make the editing area bigger than default.
        height: 800,
        

        filebrowserBrowseUrl: base_path+'/plugins/ckfinder/ckfinder.html',
        filebrowserUploadUrl: base_path+'/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserWindowWidth: '1000',
        filebrowserWindowHeight: '700',

        // An array of stylesheets to style the WYSIWYG area.
        // Note: it is recommended to keep your own styles in a separate file in order to make future updates painless.
        contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/full-all/contents.css', customCSS ],
        
        // This is optional, but will let us define multiple different styles for multiple editors using the same CSS file.
        bodyClass: 'document-editor',
        
        // Reduce the list of block elements listed in the Format dropdown to the most commonly used.
        format_tags: 'p;h1;h2;h3;pre',
        
        // Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
        removeDialogTabs: 'image:advanced;link:advanced',
        
        // Define the list of styles which should be available in the Styles dropdown list.
        // If the "class" attribute is used to style an element, make sure to define the style for the class in "mystyles.css"
        // (and on your website so that it rendered in the same way).
        // Note: by default CKEditor looks for styles.js file. Defining stylesSet inline (as below) stops CKEditor from loading
        // that file, which means one HTTP request less (and a faster startup).
        // For more information see http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_styles
        stylesSet: [
            /* Inline Styles */
            { name: 'Marker', element: 'span', attributes: { 'class': 'marker' } },
            { name: 'Cited Work', element: 'cite' },
            { name: 'Inline Quotation', element: 'q' },
            
            /* Object Styles */
            {
                name: 'Special Container',
                element: 'div',
                styles: {
                    padding: '5px 10px',
                    background: '#eee',
                    border: '1px solid #ccc'
                }
            },
            {
                name: 'Compact table',
                element: 'table',
                attributes: {
                    cellpadding: '5',
                    cellspacing: '0',
                    border: '1',
                    bordercolor: '#ccc'
                },
                styles: {
                    'border-collapse': 'collapse'
                }
            },
            { name: 'Borderless Table', element: 'table', styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
            { name: 'Square Bulleted List', element: 'ul', styles: { 'list-style-type': 'square' } }
        ]
    } );
        

    
    CKEDITOR.on( 'instanceReady', function( ev ) {



        var ol = CKEDITOR.instances['speed-editor'].document.getElementsByTag('ol');
        
        for (var l in ol){
            if(typeof ol[l] == 'object' ){
                // console.log(ol[l]);
                for(var o in ol[l]){
                    if(typeof ol[l][o] == 'object' && ol[l][o].hasAttribute('start')){
                        // console.log(ol[l][o]);

                        var item = ol[l][o].firstChild;
                        item.style.textTransform = 'uppercase'; 
                        item.setAttribute('start', ol[l][o].getAttribute("start"));
                        console.log(ol[l][o].getAttribute("start"));
                    }
                }
            }
        }

            
        
        // CK.find('ol[start]').each(function(index, value){
        //     console.log(index);
        //     console.log(value);
        // });

        // 
        // var lists = CKEDITOR.instances['speed-editor'].document.getElementsByTag('ul');
        
        
        // for (var l in lists){
        //     if(typeof lists[l] == 'object'){
        //         for(var ul in lists[l]){
        //             if(typeof lists[l][ul] == 'object'){
        //                 console.log(lists[l][ul]);
                 
        //                 // if(lists[l][ul].hasAttribute("style", "list-style-type: disc;")){
        //                 //     lists[l][ul].setAttribute("style","list-style-image:url(\'images/arrow.png\')");
        //                 // }
                        
        //                 // if(lists[l][ul].hasAttribute("style", "list-style-type: square;")){
        //                 //     lists[l][ul].setAttribute("style","list-style-image:url(\'images/check.png\')");
        //                 // }
                        
        //                 // if(lists[l][ul].hasAttribute("style", "list-style-type: circle;")){
        //                 //     lists[l][ul].setAttribute("style","list-style-image:url(\'images/circle.png\')");
        //                 // }
        //             }
        //         }
        //     }
        // }

    });




    if(content !== ''){
        CKEDITOR.instances['speed-editor'].setData(content);
    }
}