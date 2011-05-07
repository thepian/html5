var mediaUploader = {
	OptionUploaderUseThisImage : function(id,target){
		var win = window.dialogArguments || opener || parent || top;

		win.theme.themeOptionGetImage(id,target);
		win.tb_remove();
	}
}

jQuery(document).ready( function($) {
	if(location.search.indexOf('option_image_upload') != -1){
		jQuery('#media-upload #filter').append('<input type="hidden" value="1" name="option_image_upload">');
		jQuery('#media-upload #gallery-settings').remove();
	}
})