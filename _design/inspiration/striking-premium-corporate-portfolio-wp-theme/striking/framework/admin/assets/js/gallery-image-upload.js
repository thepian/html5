function themeImageInsertIntoGallery(id){
	var win = window.dialogArguments || opener || parent || top;

	win.themeGalleryGetImage(id);
	win.tb_remove();
}

jQuery(document).ready( function($) {
	if(location.search.indexOf('gallery_image_upload') != -1){
		jQuery('#media-upload #filter').append('<input type="hidden" value="1" name="gallery_image_upload">');
		jQuery('#media-upload #gallery-settings').remove();
	}
})