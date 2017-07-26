$(document).ready(function(){
      if ($('#textarea-ckeditor').length > 0) {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        //CKEDITOR.replace( 'editor1' );
        CKEDITOR.replace( 'textarea-ckeditor', {
            filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
            filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        } );
        /*timer = setInterval(updateDiv,100);
        function updateDiv(){
            var editorText = CKEDITOR.instances.desc.getData();
            $('#{-- $teaxtarea_name --}').html(editorText);
        }*/
      }
      if ($('#textarea-ckeditor1').length > 0) {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'textarea-ckeditor1', {
            filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
            filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        } );
      }
      if ($('#textarea-ckeditor2').length > 0) {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'textarea-ckeditor2', {
            filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
            filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        } );
      }
      if ($('#textarea-ckeditor3').length > 0) {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'textarea-ckeditor3', {
            filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
            filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        } );
      }
  })