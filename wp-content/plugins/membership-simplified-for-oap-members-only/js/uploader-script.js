var uploadID = "";
jQuery(document).ready(function() {    
    storeSendToEditor = window.send_to_editor;
    newSendToEditor   = function(html) {
        imgurl = jQuery('img',html).attr('src');
        uploadID.value = imgurl; /*assign the value of the image src to the input*/
        tb_remove();
        window.send_to_editor = storeSendToEditor;
    };
});
function Uploader(id) {
    window.send_to_editor = newSendToEditor;
    uploadID = id;
    formfield = jQuery('.upload').attr('name');
    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
    return false;
}