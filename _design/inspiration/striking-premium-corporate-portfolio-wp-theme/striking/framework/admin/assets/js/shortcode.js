var shortcode = {
	
	init:function(){
		jQuery('.shortcode_selector select').val('');
		jQuery('.shortcode_selector select').change(function(){
			jQuery(".shortcode_wrap").hide();
			if(this.value !=''){
				var wrap = jQuery("#shortcode_"+this.value).show();
				if(wrap.children('.sub_shortcode_wrap').size() == 0){
					wrap.find('.toggle-button:checkbox').iphoneStyle();
					wrap.find('select.tri-toggle-button').iphoneStyleTriToggle();
				}
			}
		});
		
		jQuery('#shortcode_send').click(function(){
			shortcode.sendToEditor();
		});
		jQuery('.shortcode_sub_selector select').val('');
		jQuery('.shortcode_sub_selector select').change(function(){
			jQuery(this).closest('.shortcode_wrap').children('.sub_shortcode_wrap').hide();
			if(this.value !=''){
				sub = jQuery("#sub_shortcode_"+this.value).show();
				sub.find('.toggle-button:checkbox').iphoneStyle();
				sub.find('select.tri-toggle-button').iphoneStyleTriToggle();
			}
		});
		var tabs_number = jQuery('[name="sc_tabs_number"]').val();
		jQuery('#shortcode_tabs table tr').each(function(i){
			if(i>(2+tabs_number*2)){
				jQuery(this).hide();
			}else{
				jQuery(this).show();
			}
		});
		jQuery('[name="sc_tabs_number"]').change(function(){
			var tabs_number = jQuery(this).val();
			jQuery('#shortcode_tabs table tr').each(function(i){
				if(i>(2+tabs_number*2)){
					jQuery(this).hide();
				}else{
					jQuery(this).show();
				}
			});
		});
		
		jQuery('#shortcode_accordion table tr').each(function(i){
			if(i>(tabs_number*2)){
				jQuery(this).hide();
			}else{
				jQuery(this).show();
			}
		});
		jQuery('[name="sc_accordion_number"]').change(function(){
			var tabs_number = jQuery(this).val();
			jQuery('#shortcode_accordion table tr').each(function(i){
				if(i>(tabs_number*2)){
					jQuery(this).hide();
				}else{
					jQuery(this).show();
				}
			});
		});
	},
	
	generate:function(){
		var type = jQuery('.shortcode_selector select').val();
		switch( type ){
		case 'columns':
			var type = shortcode.getVal('columns', 'type');
			if(type != ''){
				return '\n['+type+']\n'+shortcode.getVal('columns', 'content')+'\n[/'+type+']\n';
			}else{
				return '';
			}
			break;
		case 'layouts':
			var sub_type = shortcode.getVal('layouts','selector');
			switch(sub_type){
			case 'one_half_layout':
				return '\n[one_half]\n'+shortcode.getVal('layouts', 'one_half_layout', '1')+'\n[/one_half]\n\n[one_half_last]\n'+shortcode.getVal('layouts', 'one_half_layout', '2')+'\n[/one_half_last]\n';
				break;
			case 'one_third_layout':
				return '\n[one_third]\n'+shortcode.getVal('layouts', 'one_third_layout', '1')+'\n[/one_third]\n\n[one_third]\n'+shortcode.getVal('layouts', 'one_third_layout', '2')+'\n[/one_third]\n\n[one_third_last]\n'+shortcode.getVal('layouts', 'one_third_layout', '3')+'\n[/one_third_last]\n';
				break;
			case 'one_fourth_layout':
				return '\n[one_fourth]\n'+shortcode.getVal('layouts', 'one_fourth_layout', '1')+'\n[/one_fourth]\n\n[one_fourth]\n'+shortcode.getVal('layouts', 'one_fourth_layout', '2')+'\n[/one_fourth]\n\n[one_fourth]\n'+shortcode.getVal('layouts', 'one_fourth_layout', '3')+'\n[/one_fourth]\n\n[one_fourth_last]\n'+shortcode.getVal('layouts', 'one_fourth_layout', '4')+'\n[/one_fourth_last]\n';
				break;
			case 'one_fifth_layout':
				return '\n[one_fifth]\n'+shortcode.getVal('layouts', 'one_fifth_layout', '1')+'\n[/one_fifth]\n\n[one_fifth]\n'+shortcode.getVal('layouts', 'one_fifth_layout', '2')+'\n[/one_fifth]\n\n[one_fifth]\n'+shortcode.getVal('layouts', 'one_fifth_layout', '3')+'\n[/one_fifth]\n\n[one_fifth]\n'+shortcode.getVal('layouts', 'one_fifth_layout', '4')+'\n[/one_fifth]\n\n[one_fifth_last]\n'+shortcode.getVal('layouts', 'one_fifth_layout', '5')+'\n[/one_fifth_last]\n';
				break;
			case 'one_sixth_layout':
				return '\n[one_sixth]\n'+shortcode.getVal('layouts', 'one_sixth_layout', '1')+'\n[/one_sixth]\n\n[one_sixth]\n'+shortcode.getVal('layouts', 'one_sixth_layout', '2')+'\n[/one_sixth]\n\n[one_sixth]\n'+shortcode.getVal('layouts', 'one_sixth_layout', '3')+'\n[/one_sixth]\n\n[one_sixth]\n'+shortcode.getVal('layouts', 'one_sixth_layout', '4')+'\n[/one_sixth]\n\n[one_sixth]\n'+shortcode.getVal('layouts', 'one_sixth_layout', '5')+'\n[/one_sixth]\n\n[one_sixth_last]\n'+shortcode.getVal('layouts', 'one_sixth_layout', '6')+'\n[/one_sixth_last]\n';
				break;
			case 'one_third_two_third':
				return '\n[one_third]\n'+shortcode.getVal('layouts', 'one_third_two_third', '1')+'\n[/one_third]\n\n[two_third_last]\n'+shortcode.getVal('layouts', 'one_third_two_third', '2')+'\n[/two_third_last]\n';
				break;
			case 'two_third_one_third':
				return '\n[two_third]\n'+shortcode.getVal('layouts', 'two_third_one_third', '1')+'\n[/two_third]\n\n[one_third_last]\n'+shortcode.getVal('layouts', 'two_third_one_third', '2')+'\n[/one_third_last]\n';
				break;
			case 'one_fourth_three_fourth':
				return '\n[one_fourth]\n'+shortcode.getVal('layouts', 'one_fourth_three_fourth', '1')+'\n[/one_fourth]\n\n[three_fourth_last]\n'+shortcode.getVal('layouts', 'one_fourth_three_fourth', '2')+'\n[/three_fourth_last]\n';
				break;
			case 'three_fourth_one_fourth':
				return '\n[three_fourth]\n'+shortcode.getVal('layouts', 'three_fourth_one_fourth', '1')+'\n[/three_fourth]\n\n[one_fourth_last]\n'+shortcode.getVal('layouts', 'three_fourth_one_fourth', '2')+'\n[/one_fourth_last]\n';
				break;
			case 'one_fourth_one_fourth_one_half':
				return '\n[one_fourth]\n'+shortcode.getVal('layouts', 'one_fourth_one_fourth_one_half', '1')+'\n[/one_fourth]\n\n[one_fourth]\n'+shortcode.getVal('layouts', 'one_fourth_one_fourth_one_half', '2')+'\n[/one_fourth]\n\n[one_half_last]\n'+shortcode.getVal('layouts', 'one_fourth_one_fourth_one_half', '3')+'\n[/one_half_last]\n';
				break;
			case 'one_fourth_one_half_one_fourth':
				return '\n[one_fourth]\n'+shortcode.getVal('layouts', 'one_fourth_one_half_one_fourth', '1')+'\n[/one_fourth]\n\n[one_half]\n'+shortcode.getVal('layouts', 'one_fourth_one_half_one_fourth', '2')+'\n[/one_half]\n\n[one_fourth_last]\n'+shortcode.getVal('layouts', 'one_fourth_one_half_one_fourth', '3')+'\n[/one_fourth_last]\n';
				break;
			case 'one_half_one_fourth_one_fourth':
				return '\n[one_half]\n'+shortcode.getVal('layouts', 'one_half_one_fourth_one_fourth', '1')+'\n[/one_half]\n\n[one_fourth]\n'+shortcode.getVal('layouts', 'one_half_one_fourth_one_fourth', '2')+'\n[/one_fourth]\n\n[one_fourth_last]\n'+shortcode.getVal('layouts', 'one_half_one_fourth_one_fourth', '3')+'\n[/one_fourth_last]\n';
				break;
			case 'four_fifth_one_fifth':
				return '\n[four_fifth]\n'+shortcode.getVal('layouts', 'four_fifth_one_fifth', '1')+'\n[/four_fifth]\n\n[one_fifth_last]\n'+shortcode.getVal('layouts', 'four_fifth_one_fifth', '2')+'\n[/one_fifth_last]\n';
				break;
			case 'one_fifth_four_fifth':
				return '\n[one_fifth]\n'+shortcode.getVal('layouts', 'one_fifth_four_fifth', '1')+'\n[/one_fifth]\n\n[four_fifth_last]\n'+shortcode.getVal('layouts', 'one_fifth_four_fifth', '2')+'\n[/four_fifth_last]\n';
				break;
			case 'two_fifth_three_fifth':
				return '\n[two_fifth]\n'+shortcode.getVal('layouts', 'two_fifth_three_fifth', '1')+'\n[/two_fifth]\n\n[three_fifth_last]\n'+shortcode.getVal('layouts', 'two_fifth_three_fifth', '2')+'\n[/three_fifth_last]\n';
				break;
			case 'three_fifth_two_fifth':
				return '\n[three_fifth]\n'+shortcode.getVal('layouts', 'three_fifth_two_fifth', '1')+'\n[/three_fifth]\n\n[two_fifth_last]\n'+shortcode.getVal('layouts', 'three_fifth_two_fifth', '2')+'\n[/two_fifth_last]\n';
				break;
			case 'one_sixth_five_sixth':
				return '\n[one_sixth]\n'+shortcode.getVal('layouts', 'one_sixth_five_sixth', '1')+'\n[/one_sixth]\n\n[five_sixth_last]\n'+shortcode.getVal('layouts', 'one_sixth_five_sixth', '2')+'\n[/five_sixth_last]\n';
				break;
			case 'five_sixth_one_sixth':
				return '\n[five_sixth]\n'+shortcode.getVal('layouts', 'five_sixth_one_sixth', '1')+'\n[/five_sixth]\n\n[one_sixth_last]\n'+shortcode.getVal('layouts', 'five_sixth_one_sixth', '2')+'\n[/one_sixth_last]\n';
				break;
			case 'one_sixth_one_sixth_one_sixth_one_half':
				return '\n[one_sixth]\n'+shortcode.getVal('layouts', 'one_sixth_one_sixth_one_sixth_one_half', '1')+'\n[/one_sixth]\n\n[one_sixth]\n'+shortcode.getVal('layouts', 'one_sixth_one_sixth_one_sixth_one_half', '2')+'\n[/one_sixth]\n\n[one_sixth]\n'+shortcode.getVal('layouts', 'one_sixth_one_sixth_one_sixth_one_half', '3')+'\n[/one_sixth]\n\n[one_half_last]\n'+shortcode.getVal('layouts', 'one_sixth_one_sixth_one_sixth_one_half', '4')+'\n[/one_half_last]\n';
				break;
			}
			break;
		case 'typography':
			var sub_type = shortcode.getVal('typography','selector');
			switch(sub_type){
			case 'dropcap1':
			case 'dropcap2':
			case 'dropcap3':
			case 'dropcap4':
				var color = shortcode.getVal('typography',sub_type,'color');
				if(color !== ''){
					color = ' color="'+color+'"';
				}
				return '['+sub_type+color+']'+shortcode.getVal('typography',sub_type,'text')+'[/'+sub_type+']';
				break;
			case 'blockquote':
				var align = shortcode.getVal('typography','blockquote','align');
				var cite = shortcode.getVal('typography','blockquote','cite');
				if(align !== ''){
					align = ' align="'+align+'"';
				}
				if(cite !== ''){
					cite = ' cite="'+cite+'"';
				}
				return '[blockquote'+align+cite+']'+ shortcode.getVal('typography','blockquote','content') +'[/blockquote]\n';
				break;
			case 'pre_code':
				var s = shortcode.getVal('typography','pre_code','type');
				if(s == ''){
					s='code';
				}
				return '\n['+s+']\n'+shortcode.getVal('typography','pre_code','content')+'\n[/'+s+']\n';
			case 'styledlist':
				var style = shortcode.getVal('typography','styledlist','style');
				var color = shortcode.getVal('typography','styledlist','color');
				if(style !== ''){
					style= ' style="'+style+'"';
				}
				if(color !== ''){
					color = ' color="'+color+'"';
				}
				return '\n[list'+style+color+']\n'+shortcode.getVal('typography','styledlist','content')+'\n[/list]\n';
			case 'icon':
				var style = shortcode.getVal('typography','icon','style');
				var color = shortcode.getVal('typography','icon','color');
				if(style !== ''){
					style= ' style="'+style+'"';
				}
				if(color !== ''){
					color = ' color="'+color+'"';
				}
				return '\n[icon'+style+color+']'+shortcode.getVal('typography','icon','text')+'[/icon]\n';
			case 'icon_link':
				var style = shortcode.getVal('typography','icon_link','style');
				var href = shortcode.getVal('typography','icon_link','href');
				var color = shortcode.getVal('typography','icon_link','color');
				var target = shortcode.getVal('typography','icon_link','target');
				if(style !== ''){
					style= ' style="'+style+'"';
				}
				if(href !== ''){
					href= ' href="'+href+'"';
				}
				if(color !== ''){
					color = ' color="'+color+'"';
				}
				if(target!= ''){
					target = ' target="'+target+'"';
				}
				return '\n[icon_link'+style+href+color+target+']'+shortcode.getVal('typography','icon_link','text')+'[/icon_link]\n';
			case 'highlight':
				var t = shortcode.getVal('typography','highlight','type');
				if(t!==''){
					t = ' type="'+t+'"';
				}
				return '[highlight'+t+']'+shortcode.getVal('typography','highlight','content')+'[/highlight]';
			}
			break;
		case 'styledboxes':
			var sub_type = shortcode.getVal('styledboxes','selector');
			switch(sub_type){
			case 'messageboxes':
				var t = shortcode.getVal('styledboxes','messageboxes','type');
				if(t == ''){
					t='info';
				}
				return '\n['+t+']\n'+shortcode.getVal('styledboxes','messageboxes','content')+'\n[/'+t+']\n';
			case 'framed_box':
				var width = shortcode.getVal('styledboxes','framed_box','width');
				var height = shortcode.getVal('styledboxes','framed_box','height');
				var bgColor = shortcode.getVal('styledboxes','framed_box','bgColor');
				var textColor = shortcode.getVal('styledboxes','framed_box','textColor');
				var rounded = shortcode.getVal('styledboxes','framed_box','rounded');

				if(width!=0){
					width = ' width="'+width+'"';
				}else{
					width ='';
				}

				if(height!=0){
					height = ' height="'+height+'"';
				}else{
					height ='';
				}

				if(bgColor != ''){
					bgColor = ' bgColor="'+ bgColor +'"';
				}
				if(textColor != ''){
					textColor = ' textColor="'+ textColor +'"';
				}

				if(rounded===true){
					rounded = ' rounded="true"';
				}else{
					rounded = '';
				}
				return '\n[framed_box'+width+height+bgColor+textColor+rounded+']\n'+shortcode.getVal('styledboxes','framed_box','content')+'\n[/framed_box]\n';
			case 'note_box':
				var title = shortcode.getVal('styledboxes','note_box','title');
				var align = shortcode.getVal('styledboxes','note_box','align');
				var width = shortcode.getVal('styledboxes','note_box','width');

				if(title != ''){
					title = ' title="'+title+'"';
				}
				if(align !== ''){
					align = ' align="'+align+'"';
				}
				if(width!=0){
					width = ' width="'+width+'"';
				}else{
					width ='';
				}
				return '\n[note'+title+align+width+']\n'+shortcode.getVal('styledboxes','note_box','content')+'\n[/note]\n';
			}
			break;
		case 'table':
			var width = shortcode.getVal('table','width');
			if(width!= ''){
				width = ' width="'+width+'"';
			}
			
			return '\n[styled_table'+width+']\n'+shortcode.getVal('table','content')+'\n[/styled_table]\n';
			break;
		case 'buttons':
			var id = shortcode.getVal('buttons','id');
			var c = shortcode.getVal('buttons','class');
			var size = shortcode.getVal('buttons','size');
			var align = shortcode.getVal('buttons','align');
			var full = shortcode.getVal('buttons','full');
			var link = shortcode.getVal('buttons','link');
			var linkTarget = shortcode.getVal('buttons','linkTarget');
			var color = shortcode.getVal('buttons','color');
			var text = shortcode.getVal('buttons','text');
			var bgColor = shortcode.getVal('buttons','bgColor');
			var textColor = shortcode.getVal('buttons','textColor');
			var hoverBgColor = shortcode.getVal('buttons','hoverBgColor');
			var hoverTextColor = shortcode.getVal('buttons','hoverTextColor');
			var width = shortcode.getVal('buttons','width');

			if(id != ''){
				id = ' id="'+ id +'"';
			}
			if(c != ''){
				c = ' class="'+ c +'"';
			}
			if(size!=''){
				size =' size="'+size+'"';
			}
			if(align!=''){
				align =' align="'+align+'"';
			}
			if(full===true){
				full = ' full="true"';
			}else{
				full = '';
			}
			if(link!= ''){
				link = ' link="'+link+'"';
			}
			if(linkTarget!= ''){
				linkTarget = ' linkTarget="'+linkTarget+'"';
			}
			if(color!=''){
				color = ' color="'+color+'"';
			}
			if(bgColor != ''){
				bgColor = ' bgColor="'+ bgColor +'"';
			}
			if(textColor != ''){
				textColor = ' textColor="'+ textColor +'"';
			}
			if(hoverBgColor != ''){
				hoverBgColor = ' hoverBgColor="'+ hoverBgColor +'"';
			}
			if(hoverTextColor != ''){
				hoverTextColor = ' hoverTextColor="'+ hoverTextColor +'"';
			}
			if(width!=0){
				width = ' width="'+width+'"';
			}else{
				width ='';
			}
			return '[button'+id+c+size+align+full+link+linkTarget+color+bgColor+textColor+hoverBgColor+hoverTextColor+width+']'+text+'[/button]';
			break;
		case 'tabs':
			var type = shortcode.getVal('tabs','type');
			var number = shortcode.getVal('tabs','number');
			var history = shortcode.getVal('tabs','history');
			if(type == ''){
				type = 'tabs';
			}
			if(history===true){
				history = ' history="true"';
			}else{
				history = '';
			}
			var ret = '\n['+type+history+']\n';
			for(var i=1;i<=number;i++){
				ret +='[tab title="'+shortcode.getVal('tabs','title_'+i)+'"]\n'+shortcode.getVal('tabs','content_'+i)+'\n[/tab]\n';
			}
			ret +='[/'+type+']\n';
			return ret;
			break;
		case 'accordion':
			var number = shortcode.getVal('accordion','number');
			var ret = '\n[accordions]\n';
			for(var i=1;i<=number;i++){
				ret +='[accordion title="'+shortcode.getVal('accordion','title_'+i)+'"]\n'+shortcode.getVal('accordion','content_'+i)+'\n[/accordion]\n';
			}
			ret +='[/accordions]\n';
			return ret;
			break;
		case 'toggle':
			return '\n[toggle title="'+shortcode.getVal('toggle','title')+'"]\n'+shortcode.getVal('toggle','content')+'\n[/toggle]\n';
			break;
		case 'divider':
			return '\n['+shortcode.getVal('divider','type')+']\n';
			break;
		case 'images':
			var sub_type = shortcode.getVal('images','selector');
			switch(sub_type){
				case 'picture_frame':
					var title = shortcode.getVal('images','picture_frame','title');
					if(title!=''){
						title = ' title="'+title+'"';
					}
					return '[picture_frame'+title+']'+shortcode.getVal('images','picture_frame','src')+'[/picture_frame]';
					break;
				case 'image':
					var src = shortcode.getVal('images','image','src');
					var title = shortcode.getVal('images','image','title');
					var size = shortcode.getVal('images','image','size');
					var align = shortcode.getVal('images','image','align');
					var icon = shortcode.getVal('images','image','icon');
					var lightbox = shortcode.getVal('images','image','lightbox');
					var group = shortcode.getVal('images','image','group');
					var width = shortcode.getVal('images','image','width');
					var height = shortcode.getVal('images','image','height');
					var autoHeight = shortcode.getVal('images','image','autoHeight');
					var link = shortcode.getVal('images','image','link');
					var linkTarget = shortcode.getVal('images','image','linkTarget');
					var quality = shortcode.getVal('images','image','quality');
					
					if(size!=''){
						size =' size="'+size+'"';
					}
					if(align!=''){
						align =' align="'+align+'"';
					}
					if(icon!=''){
						icon =' icon="'+icon+'"';
					}
					if(lightbox===true){
						lightbox = ' lightbox="true"';
					}else{
						lightbox = '';
					}
					if(link!= ''){
						link = ' link="'+link+'"';
					}
					if(linkTarget!= ''){
						linkTarget = ' linkTarget="'+linkTarget+'"';
					}
					if(group!=''){
						group = ' group="'+group+'"';
					}
					if(width!=0){
						width = ' width="'+width+'"';
					}else{
						width ='';
					}
					if(height!=0){
						height = ' height="'+height+'"';
					}else{
						height ='';
					}
					if(autoHeight===true){
						autoHeight = ' autoHeight="true"';
					}else{
						autoHeight = '';
					}
					if(title!=''){
						title = ' title="'+title+'"';
					}
					if(quality!='75'){
						quality = ' quality="'+quality+'"';
					}else{
						quality = '';
					}
					return '[image'+title+size+align+icon+lightbox+group+link+linkTarget+width+height+autoHeight+quality+']'+src+'[/image]';
					break;
			};
			break;
		case 'iframe':
			var src = shortcode.getVal('iframe','src');
			var width = shortcode.getVal('iframe','width');
			var height = shortcode.getVal('iframe','height');
			
			if(src!= ''){
				src = ' src="'+src+'"';
			}
			if(width!= ''){
				width = ' width="'+width+'"';
			}
			if(height!= ''){
				height = ' height="'+height+'"';
			}
			return '[iframe'+src+width+height+']';
			break;
		case 'gmap':
			var width = shortcode.getVal('gmap','width');
			var height = shortcode.getVal('gmap','height');
			var address = shortcode.getVal('gmap','address');
			var latitude = shortcode.getVal('gmap','latitude');
			var longitude = shortcode.getVal('gmap','longitude');
			var zoom = shortcode.getVal('gmap','zoom');
			var marker = shortcode.getVal('gmap','marker');
			var html = shortcode.getVal('gmap','html');
			var popup = shortcode.getVal('gmap','popup');
			var controls = shortcode.getVal('gmap','controls');
			var scrollwheel = shortcode.getVal('gmap','scrollwheel');
			var maptype = shortcode.getVal('gmap','maptype');

			if(width!=0){
				width = ' width="'+width+'"';
			}else{
				width ='';
			}
			if(height!=0){
				height = ' height="'+height+'"';
			}else{
				height ='';
			}
			if(address!= ''){
				address = ' address="'+address+'"';
			}
			if(latitude!= ''){
				latitude = ' latitude="'+latitude+'"';
			}
			if(longitude!=''){
				longitude = ' longitude="'+longitude+'"';
			}
			if(zoom!=0){
				zoom = ' zoom="'+zoom+'"';
			}else{
				zoom ='';
			}
			if(marker===true){
				marker = '';
			}else{
				marker = ' marker="false"';
			}
			if(popup===true){
				popup = ' popup="true"';
			}else{
				popup = '';
			}
			if(html!= ''){
				html = ' html="'+html+'"';
			}
			if(controls!= ''){
				controls = ' controls="'+controls+'"';
			}
			if(scrollwheel===false){
				scrollwheel = '';
			}else{
				scrollwheel = ' scrollwheel="false"';
			}
			if(maptype == 'G_NORMAL_MAP'){
				maptype = '';
			}
			if(maptype!= ''){
				maptype = ' maptype="'+maptype+'"';
			}

			return '\n[gmap'+width+height+address+latitude+longitude+zoom+marker+popup+html+controls+scrollwheel+maptype+']\n';
			break;
		case 'widget':
			var sub_type = shortcode.getVal('widget','selector');
			switch(sub_type){
			case 'contactform':
				var email = shortcode.getVal('widget','contactform','email');
				if(email !="" ){
					email = ' email="'+email+'"'
				}
				var content = shortcode.getVal('widget','contactform','content');
				if(content != ""){
					return '\n[contactform'+email+']\n'+content+'\n[/contactform]\n';
				}else{
					return '\n[contactform'+email+']\n';
				}
				break;
			case 'twitter':
				var username = shortcode.getVal('widget','twitter','username');
				var count = shortcode.getVal('widget','twitter','count');
				var avatarSize = shortcode.getVal('widget','twitter','avatarSize');
				var query = shortcode.getVal('widget','twitter','query');
				
				if(username !="" ){
					username = ' username="'+username+'"';
				}
				if(count !="" ){
					count = ' count="'+count+'"';
				}
				if(avatarSize !="0" ){
					avatarSize = ' avatarSize="'+avatarSize+'"';
				}else{
					avatarSize = '';
				}
				if(query !="" ){
					query = ' query="'+query+'"';
				}
				return '\n[twitter'+username+count+avatarSize+query+']\n';
				break;
			case 'flickr':
				var id = shortcode.getVal('widget','flickr','id');
				var type = shortcode.getVal('widget','flickr','type');
				var count = shortcode.getVal('widget','flickr','count');
				var display = shortcode.getVal('widget','flickr','display');
				if(id !="" ){
					id = ' id="'+id+'"';
				}
				if(type !="" ){
					type = ' type="'+type+'"';
				}
				if(count !="" ){
					count = ' count="'+count+'"';
				}
				if(display !="" ){
					display = ' display="'+display+'"';
				}
				return '\n[flickr'+id+type+count+display+']\n';
				break;
			case 'contact_info':
				var color = shortcode.getVal('widget','contact_info','color');
				var phone = shortcode.getVal('widget','contact_info','phone');
				var cellphone = shortcode.getVal('widget','contact_info','cellphone');
				var email = shortcode.getVal('widget','contact_info','email');
				var link = shortcode.getVal('widget','contact_info','link');
				var address = shortcode.getVal('widget','contact_info','address');
				var city = shortcode.getVal('widget','contact_info','city');
				var state = shortcode.getVal('widget','contact_info','state');
				var zip = shortcode.getVal('widget','contact_info','zip');
				var name = shortcode.getVal('widget','contact_info','name');

				if(color !="" ){
					color = ' color="'+color+'"';
				}
				if(phone !="" ){
					phone = ' phone="'+phone+'"';
				}
				if(cellphone !="" ){
					cellphone = ' cellphone="'+cellphone+'"';
				}
				if(email !="" ){
					email = ' email="'+email+'"';
				}
				if(link !="" ){
					link = ' link="'+link+'"';
				}
				if(address !="" ){
					address = ' address="'+address+'"';
				}
				if(city !="" ){
					city = ' city="'+city+'"';
				}
				if(state !="" ){
					state = ' state="'+state+'"';
				}
				if(zip !="" ){
					zip = ' zip="'+zip+'"';
				}
				if(name !="" ){
					name = ' name="'+name+'"';
				}
				return '\n[contact_info'+color+phone+cellphone+email+link+address+city+state+zip+name+']\n';
				break;
			case 'popular_posts':
				var count = shortcode.getVal('widget','popular_posts','count');
				var thumbnail = shortcode.getVal('widget','popular_posts','thumbnail');
				var extra = shortcode.getVal('widget','popular_posts','extra');
				var cat = shortcode.getVal('widget','popular_posts','cat');
				var desc_length = shortcode.getVal('widget','recent_posts','desc_length');
				
				if(count !="" ){
					count = ' count="'+count+'"';
				}
				if(thumbnail===true){
					thumbnail = ' thumbnail="true"';
				}else{
					thumbnail = ' thumbnail="false"';
				}
				if(extra !="" ){
					extra = ' extra="'+extra+'"';
				}

				if(desc_length !="" ){
					desc_length = ' desc_length="'+desc_length+'"';
				}
				if(extra == "time"){
					desc_length = '';
				}
				if(cat!=undefined){
					cat = ' cat="'+cat+'"';
				}else{
					cat = '';
				}

				return '\n[popular_posts'+count+thumbnail+extra+desc_length+cat+']\n';
				break;
			case 'recent_posts':
				var count = shortcode.getVal('widget','recent_posts','count');
				var thumbnail = shortcode.getVal('widget','recent_posts','thumbnail');
				var extra = shortcode.getVal('widget','recent_posts','extra');
				var cat = shortcode.getVal('widget','recent_posts','cat');
				var desc_length = shortcode.getVal('widget','recent_posts','desc_length');

				if(count !="" ){
					count = ' count="'+count+'"';
				}
				if(thumbnail===true){
					thumbnail = ' thumbnail="true"';
				}else{
					thumbnail = ' thumbnail="false"';
				}
				if(extra !="" ){
					extra = ' extra="'+extra+'"';
				}
				if(desc_length !="" ){
					desc_length = ' desc_length="'+desc_length+'"';
				}
				if(extra == "time"){
					desc_length = '';
				}
				if(cat!=undefined){
					cat = ' cat="'+cat+'"';
				}else{
					cat = '';
				}
				return '\n[recent_posts'+count+thumbnail+extra+desc_length+cat+']\n';
				break;
			}
			break;
		case 'slideshow':
			var sub_type = shortcode.getVal('slideshow','selector');
			switch(sub_type){
				case 'nivo':
					var category = shortcode.getVal('slideshow','nivo','category');
					var number = shortcode.getVal('slideshow','nivo','number');
					var width = shortcode.getVal('slideshow','nivo','width');
					var height = shortcode.getVal('slideshow','nivo','height');
					var effect = shortcode.getVal('slideshow','nivo','effect');
					var slices = shortcode.getVal('slideshow','nivo','slices');
					var animSpeed = shortcode.getVal('slideshow','nivo','animSpeed');
					var pauseTime = shortcode.getVal('slideshow','nivo','pauseTime');
					var controlNav = shortcode.getVal('slideshow','nivo','controlNav');
					var pauseOnHover = shortcode.getVal('slideshow','nivo','pauseOnHover');
					
					if(category!=''){
						category = ' category="'+category+'"';
					}else{
						category = '';
					}
					if(number!=0){
						number = ' number="'+number+'"';
					}else{
						number ='';
					}
					if(width!=0){
						width = ' width="'+width+'"';
					}else{
						width ='';
					}
					if(height!=0){
						height = ' height="'+height+'"';
					}else{
						height ='';
					}
					
					if(effect !=""){
						effect = ' effect="'+effect+'"';
					}
					if(slices!=''){
						slices =' slices="'+slices+'"';
					}
					if(animSpeed!=''){
						animSpeed =' animSpeed="'+animSpeed+'"';
					}
					if(pauseTime!=''){
						pauseTime =' pauseTime="'+pauseTime+'"';
					}
					if(controlNav===true){
						controlNav = ' controlNav="true"';
					}else{
						controlNav = ' controlNav="false"';
					}
					if(pauseOnHover===true){
						pauseOnHover = ' pauseOnHover="true"';
					}else{
						pauseOnHover = ' pauseOnHover="false"';
					}
					//if(shortcode.getVal('slideshow','nivo','content')!=''){
					//	return '[slideshow type="nivo"'+category+number+width+height+effect+slices+animSpeed+pauseTime+controlNav+pauseOnHover+']'+shortcode.getVal('slideshow','nivo','content')+'[/slideshow]';
					//}else{
						return '[slideshow type="nivo"'+category+number+width+height+effect+slices+animSpeed+pauseTime+controlNav+pauseOnHover+']';
					//}
					break;
			};
			break;
		case 'video':
			var sub_type = shortcode.getVal('video','selector');
			switch(sub_type){
				case 'html5':
					var poster = shortcode.getVal('video','html5','poster');
					var mp4 = shortcode.getVal('video','html5','mp4');
					var webm = shortcode.getVal('video','html5','webm');
					var ogg = shortcode.getVal('video','html5','ogg');
					var width = shortcode.getVal('video','html5','width');
					var height = shortcode.getVal('video','html5','height');
					var download = shortcode.getVal('video','html5','download');
					var preload = shortcode.getVal('video','html5','preload');
					var autoplay = shortcode.getVal('video','html5','autoplay');

					if(poster !=""){
						poster = ' poster="'+poster+'"';
					}
					if(mp4!=''){
						mp4 =' mp4="'+mp4+'"';
					}
					if(webm!=''){
						webm =' webm="'+webm+'"';
					}
					if(ogg!=''){
						ogg =' ogg="'+ogg+'"';
					}
					if(width!=0){
						width = ' width="'+width+'"';
					}else{
						width ='';
					}
					if(height!=0){
						height = ' height="'+height+'"';
					}else{
						height ='';
					}
					switch(download){
						case true:
							download = ' download="true"';
							break;
						case false:
							download = ' download="false"';
							break;
						default:
							download = '';
					}
					switch(preload){
						case true:
							preload = ' preload="true"';
							break;
						case false:
							preload = ' preload="false"';
							break;
						default:
							preload = '';
					}
					switch(autoplay){
						case true:
							autoplay = ' autoplay="true"';
							break;
						case false:
							autoplay = ' autoplay="false"';
							break;
						default:
							autoplay = '';
					}
					
					return '[video type="html5"'+poster+mp4+webm+ogg+width+height+download+preload+autoplay+']';
					break;
				case 'flash':
					var id = shortcode.getVal('video','flash','id');
					var src = shortcode.getVal('video','flash','src');
					var width = shortcode.getVal('video','flash','width');
					var height = shortcode.getVal('video','flash','height');
					var play = shortcode.getVal('video','flash','play');
					var flashvars = shortcode.getVal('video','flash','flashvars');
					
					if(id !=""){
						id = ' id="'+id+'"';
					}
					if(src !=""){
						src = ' src="'+src+'"';
					}
					if(width!=0){
						width = ' width="'+width+'"';
					}else{
						width ='';
					}
					if(height!=0){
						height = ' height="'+height+'"';
					}else{
						height ='';
					}
					if(play===true){
						play = ' play="true"';
					}else{
						play = '';
					}
					if(flashvars !=""){
						flashvars = ' flashvars="'+flashvars+'"';
					}
					
					return '[video type="flash"'+src+id+width+height+play+flashvars+']';
					break;
				case 'youtube':
					var clip_id = shortcode.getVal('video','youtube','clip_id');
					var width = shortcode.getVal('video','youtube','width');
					var height = shortcode.getVal('video','youtube','height');
					
					var autohide = shortcode.getVal('video','youtube','autohide');
					var autoplay = shortcode.getVal('video','youtube','autoplay');
					var controls = shortcode.getVal('video','youtube','controls');
					var disablekb = shortcode.getVal('video','youtube','disablekb');
					var fs = shortcode.getVal('video','youtube','fs');
					var hd = shortcode.getVal('video','youtube','hd');
					var loop = shortcode.getVal('video','youtube','loop');
					var rel = shortcode.getVal('video','youtube','rel');
					var showinfo = shortcode.getVal('video','youtube','showinfo');
					var showsearch = shortcode.getVal('video','youtube','showsearch');
					

					if(clip_id !=""){
						clip_id = ' clip_id="'+clip_id+'"';
					}
					if(width!=0){
						width = ' width="'+width+'"';
					}else{
						width ='';
					}
					if(height!=0){
						height = ' height="'+height+'"';
					}else{
						height ='';
					}
					
					switch(autohide){
						case 'default':
							autohide = '';
							break;
						default:
							autohide = ' autohide="'+autohide+'"';
					}
					switch(autoplay){
						case true:
							autoplay = ' autoplay="true"';
							break;
						case false:
							autoplay = ' autoplay="false"';
							break;
						default:
							autoplay = '';
					}
					switch(controls){
						case true:
							controls = ' controls="true"';
							break;
						case false:
							controls = ' controls="false"';
							break;
						default:
							controls = '';
					}
					switch(disablekb){
						case true:
							disablekb = ' disablekb="true"';
							break;
						case false:
							disablekb = ' disablekb="false"';
							break;
						default:
							disablekb = '';
					}
					switch(fs){
						case true:
							fs = ' fs="true"';
							break;
						case false:
							fs = ' fs="false"';
							break;
						default:
							fs = '';
					}
					switch(hd){
						case true:
							hd = ' hd="true"';
							break;
						case false:
							hd = ' hd="false"';
							break;
						default:
							hd = '';
					}
					switch(loop){
						case true:
							loop = ' loop="true"';
							break;
						case false:
							loop = ' loop="false"';
							break;
						default:
							loop = '';
					}
					switch(rel){
						case true:
							rel = ' rel="true"';
							break;
						case false:
							rel = ' rel="false"';
							break;
						default:
							rel = '';
					}
					switch(showinfo){
						case true:
							showinfo = ' showinfo="true"';
							break;
						case false:
							showinfo = ' showinfo="false"';
							break;
						default:
							showinfo = '';
					}
					switch(showsearch){
						case true:
							showsearch = ' showsearch="true"';
							break;
						case false:
							showsearch = ' showsearch="false"';
							break;
						default:
							showsearch = '';
					}
					
					return '[video type="youtube"'+clip_id+width+height+autohide+autoplay+controls+disablekb+fs+hd+loop+rel+showinfo+showsearch+']';
					break;
				case 'vimeo':
					var clip_id = shortcode.getVal('video','vimeo','clip_id');
					var width = shortcode.getVal('video','vimeo','width');
					var height = shortcode.getVal('video','vimeo','height');
					var byline = shortcode.getVal('video','vimeo','byline');
					var title = shortcode.getVal('video','vimeo','title');
					var portrait = shortcode.getVal('video','vimeo','portrait');
					var autoplay = shortcode.getVal('video','vimeo','autoplay');
					var loop = shortcode.getVal('video','vimeo','loop');
					
					if(clip_id !=""){
						clip_id = ' clip_id="'+clip_id+'"';
					}
					if(width!=0){
						width = ' width="'+width+'"';
					}else{
						width ='';
					}
					if(height!=0){
						height = ' height="'+height+'"';
					}else{
						height ='';
					}
					if(title===true){
						title = ' title="true"';
					} else {
						title = '';
					}
					switch(byline){
						case true:
							byline = ' byline="true"';
							break;
						case false:
							byline = ' byline="false"';
							break;
						default:
							byline = '';
					}
					switch(title){
						case true:
							title = ' title="true"';
							break;
						case false:
							title = ' title="false"';
							break;
						default:
							title = '';
					}
					switch(portrait){
						case true:
							portrait = ' portrait="true"';
							break;
						case false:
							portrait = ' portrait="false"';
							break;
						default:
							portrait = '';
					}
					switch(autoplay){
						case true:
							autoplay = ' autoplay="true"';
							break;
						case false:
							autoplay = ' autoplay="false"';
							break;
						default:
							autoplay = '';
					}
					switch(loop){
						case true:
							loop = ' loop="true"';
							break;
						case false:
							loop = ' loop="false"';
							break;
						default:
							loop = '';
					}
					return '[video type="vimeo"'+clip_id+width+height+byline+title+portrait+autoplay+loop+']';
					break;
				case 'dailymotion':
					var clip_id = shortcode.getVal('video','dailymotion','clip_id');
					var width = shortcode.getVal('video','dailymotion','width');
					var height = shortcode.getVal('video','dailymotion','height');
					var related = shortcode.getVal('video','dailymotion','related');
					var autoplay = shortcode.getVal('video','dailymotion','autoplay');
					var chromeless = shortcode.getVal('video','dailymotion','chromeless');
					if(clip_id !=""){
						clip_id = ' clip_id="'+clip_id+'"';
					}
					if(width!=0){
						width = ' width="'+width+'"';
					}else{
						width ='';
					}
					if(height!=0){
						height = ' height="'+height+'"';
					}else{
						height ='';
					}
					switch(related){
						case true:
							related = ' related="true"';
							break;
						case false:
							related = ' related="false"';
							break;
						default:
							related = '';
					}
					switch(autoplay){
						case true:
							autoplay = ' autoplay="true"';
							break;
						case false:
							autoplay = ' autoplay="false"';
							break;
						default:
							autoplay = '';
					}
					switch(chromeless){
						case true:
							chromeless = ' chromeless="true"';
							break;
						case false:
							chromeless = ' chromeless="false"';
							break;
						default:
							chromeless = '';
					}
					
					return '[video type="dailymotion"'+clip_id+width+height+related+autoplay+chromeless+']';
					break;
			};
			break;
		case 'lightbox':
			var href = shortcode.getVal('lightbox','href');
			var title = shortcode.getVal('lightbox','title');
			var group = shortcode.getVal('lightbox','group');
			var width = shortcode.getVal('lightbox','width');
			var height = shortcode.getVal('lightbox','height');
			var iframe = shortcode.getVal('lightbox','iframe');
			var inline = shortcode.getVal('lightbox','inline');
			var inline_id = shortcode.getVal('lightbox','inline_id');
			var inline_html = shortcode.getVal('lightbox','inline_html');
			var photo = shortcode.getVal('lightbox','photo');
			var close = shortcode.getVal('lightbox','close');
			
			if(href !=""){
				href = ' href="'+href+'"';
			}else{
				href = '';
			}
			if(title !=""){
				title = ' title="'+title+'"';
			}else{
				title = '';
			}
			if(group !=""){
				group = ' group="'+group+'"';
			}else{
				group = '';
			}
			if(width !=""){
				width = ' width="'+width+'"';
			}else{
				width = '';
			}
			if(height !=""){
				height = ' height="'+height+'"';
			}else{
				height = '';
			}
			if(iframe===true){
				iframe = ' iframe="true"';
			} else {
				iframe = '';
			}
			if(inline===true){
				inline = ' inline="true"';
				inline_html = '\n<div class="hidden"><div id="'+inline_id+'">\n'+inline_html+'\n</div></div>';
				href = ' href="#'+inline_id+'"';
			} else {
				inline = '';
				inline_html = '';
			}
			if(photo===true){
				photo = ' photo="true"';
			} else {
				photo = '';
			}
			if(close===false){
				close = ' close="false"';
			} else {
				close = '';
			}

			return '[lightbox'+title+group+href+width+height+iframe+inline+photo+close+']'+shortcode.getVal('lightbox','content')+'[/lightbox]'+inline_html;
			break;
		case 'chart':
			var data = shortcode.getVal('chart','data');
			var labels = shortcode.getVal('chart','labels');
			var colors = shortcode.getVal('chart','colors');
			var bg = shortcode.getVal('chart','bg');
			var size = shortcode.getVal('chart','size');
			var title = shortcode.getVal('chart','title');
			var type = shortcode.getVal('chart','type');
			var advanced = shortcode.getVal('chart','advanced');

			if(data !=""){
				data = ' data="'+data+'"';
			}else{
				data = '';
			}
			if(labels !=""){
				labels = ' labels="'+labels+'"';
			}else{
				labels = '';
			}
			if(colors !=""){
				colors = ' colors="'+colors+'"';
			}else{
				colors = '';
			}
			if(bg !=""){
				bg = ' bg="'+bg+'"';
			}else{
				bg = '';
			}
			if(size !=""){
				size = ' size="'+size+'"';
			}else{
				size = '';
			}
			if(title !=""){
				title = ' title="'+title+'"';
			}else{
				title = '';
			}
			if(type !=""){
				type = ' type="'+type+'"';
			}else{
				type = '';
			}
			if(advanced !=""){
				advanced = ' advanced="'+advanced+'"';
			}else{
				advanced = '';
			}

			return '[chart'+data+labels+bg+size+title+type+advanced+']';
			break;
		case 'portfolio':
			var column = shortcode.getVal('portfolio','column');
			var height = shortcode.getVal('portfolio','height');
			var nopaging = shortcode.getVal('portfolio','nopaging');
			var max = shortcode.getVal('portfolio','max');
			var sortable = shortcode.getVal('portfolio','sortable');
			var cat = shortcode.getVal('portfolio','cat');
			var ids = shortcode.getVal('portfolio','ids');
			var title = shortcode.getVal('portfolio','title');
			var desc = shortcode.getVal('portfolio','desc');
			var advanceDesc = shortcode.getVal('portfolio','advanceDesc');
			var full = shortcode.getVal('portfolio','full');
			var more = shortcode.getVal('portfolio','more');
			var moreText = shortcode.getVal('portfolio','moreText');
			var group = shortcode.getVal('portfolio','group');
			var lightboxTitle = shortcode.getVal('portfolio','lightboxTitle');
			
			
			if(column !=""){
				column = ' column="'+column+'"';
			}else{
				column = ' column="4"';
			}
			if(height!=0){
				height = ' height="'+height+'"';
			}else{
				height ='';
			}
			if(sortable===true){
				sortable = ' sortable="true"';
				//max = '';
			} else {
				sortable = '';
			}
			if(nopaging===true){
				nopaging = ' nopaging="true"';
				//max = '';
			}else{
				nopaging = '';
			}

			if(max!='-1' && max!='0'){
				max = ' max="'+max+'"';
			}else{
				max = '';
			}

			if(cat!=undefined){
				cat = ' cat="'+cat+'"';
			}else{
				cat = '';
			}
			
			if(ids!=undefined){
				ids = ' ids="'+ids+'"';
			}else{
				ids = '';
			}
			if(title===true){
				title = ' title="true"';
			} else {
				title = ' title="false"';
			}
			if(desc===true){
				desc = ' desc="true"';
			} else {
				desc = ' desc="false"';
			}
			
			if(advanceDesc===true){
				advanceDesc = ' advanceDesc="true"';
			} else {
				advanceDesc = '';
			}
			if(more===true){
				more = ' more="true"';
			} else {
				more = ' more="false"';
			}
			if(moreText!=''){
				moreText = ' moreText="'+moreText+'"';
			}
			if(group!==true){
				group = ' group="false"';
			}else{
				group = '';
			}
			if(lightboxTitle !="portfolio"){
				lightboxTitle = ' lightboxTitle="'+lightboxTitle+'"';
			}else{
				lightboxTitle = '';
			}
			return '[portfolio'+column+height+nopaging+sortable+max+cat+ids+title+desc+advanceDesc+more+moreText+group+lightboxTitle+']';
			break;
		case 'blog':
			var column = shortcode.getVal('blog','column');
			var count = shortcode.getVal('blog','count');
			var posts = shortcode.getVal('blog','posts');
			var cat = shortcode.getVal('blog','cat');
			var image = shortcode.getVal('blog','image');
			var width = shortcode.getVal('blog','width');
			var height = shortcode.getVal('blog','height');
			var meta = shortcode.getVal('blog','meta');
			var desc = shortcode.getVal('blog','desc');
			var full = shortcode.getVal('blog','full');
			var nopaging = shortcode.getVal('blog','nopaging');
			
			if(column !=1){
				column = ' column="'+column+'"';
			}else{
				column = '';
			}
			
			if(count!==''){
				count = ' count="'+count+'"';
			}else{
				count = '';
			}
			if(posts!=undefined){
				posts = ' posts="'+posts+'"';
			}else{
				posts = '';
			}
			if(cat!=undefined){
				cat = ' cat="'+cat+'"';
			}else{
				cat = '';
			}
			if(image===false){
				image = ' image="false"';
			} else {
				image = '';
			}
			if(width!=0){
				width = ' width="'+width+'"';
			}else{
				width ='';
			}
			if(height!=0){
				height = ' height="'+height+'"';
			}else{
				height ='';
			}
			if(meta===false){
				meta = ' meta="false"';
			} else {
				meta = '';
			}
			if(desc===false){
				desc = ' desc="false"';
			} else {
				desc = '';
			}
			if(full===true){
				full = ' full="true"';
			} else {
				full = '';
			}
			if(nopaging===false){
				nopaging = ' nopaging="false"';
			}else{
				nopaging = '';
			}

			return '[blog'+column+count+posts+cat+image+width+height+meta+desc+full+nopaging+']';
			break;
		case 'sitemap':
			var sub_type = shortcode.getVal('sitemap','selector');
			switch(sub_type){
				case 'all':
					var shows = shortcode.getVal('sitemap','all','shows');
					var number = shortcode.getVal('sitemap','all','number');

					if(shows!=undefined){
						shows = ' shows="'+shows+'"';
					}else{
						shows ='';
					}

					if(number!=0){
						number = ' number="'+number+'"';
					}else{
						number ='';
					}

					return '[sitemap type="all"'+shows+number+']';
					break;
				case 'pages':
					var depth = shortcode.getVal('sitemap','pages','depth');
					var number = shortcode.getVal('sitemap','pages','number');

					if(depth!=0){
						depth = ' depth="'+depth+'"';
					}else{
						depth ='';
					}

					if(number!=0){
						number = ' number="'+number+'"';
					}else{
						number ='';
					}

					return '[sitemap type="pages"'+depth+number+']';
					break;
				case 'categories':
					var show_count = shortcode.getVal('sitemap','categories','show_count');
					var show_feed = shortcode.getVal('sitemap','categories','show_feed');
					var depth = shortcode.getVal('sitemap','categories','depth');
					var number = shortcode.getVal('sitemap','categories','number');
					
					if(show_count===false){
						show_count = ' show_count="false"';
					} else {
						show_count = '';
					}
					if(show_feed===false){
						show_feed = ' show_feed="false"';
					} else {
						show_feed = '';
					}
					
					if(depth!=0){
						depth = ' depth="'+depth+'"';
					}else{
						depth ='';
					}

					if(number!=0){
						number = ' number="'+number+'"';
					}else{
						number ='';
					}

					return '[sitemap type="categories"'+show_count+show_feed+depth+number+']';
					break;
				case 'posts':
					var show_comment = shortcode.getVal('sitemap','posts','show_comment');
					var number = shortcode.getVal('sitemap','posts','number');
					var posts = shortcode.getVal('sitemap','posts','posts');
					var cat = shortcode.getVal('sitemap','posts','cat');
					
					if(show_comment===false){
						show_comment = ' show_comment="false"';
					} else {
						show_comment = '';
					}
					if(number!=0){
						number = ' number="'+number+'"';
					}else{
						number ='';
					}
					if(posts!=undefined){
						posts = ' posts="'+posts+'"';
					}else{
						posts = '';
					}
					if(cat!=undefined){
						cat = ' cat="'+cat+'"';
					}else{
						cat = '';
					}

					return '[sitemap type="posts"'+show_comment+number+posts+cat+']';
					break;
				case 'portfolios':
					var show_comment = shortcode.getVal('sitemap','portfolios','show_comment');
					var number = shortcode.getVal('sitemap','portfolios','number');
					var cat = shortcode.getVal('sitemap','portfolios','cat');
					
					if(show_comment===false){
						show_comment = '';
					} else {
						show_comment = ' show_comment="true"';
					}
					
					if(number!=0){
						number = ' number="'+number+'"';
					}else{
						number ='';
					}
					if(cat!=undefined){
						cat = ' cat="'+cat+'"';
					}else{
						cat = '';
					}

					return '[sitemap type="portfolios"'+show_comment+number+cat+']';
					break;
			}
			break;
		}
		return '';
	},
	getVal:function(a,b,c){
		if(b == undefined){
			var target = jQuery('[name="sc_'+a+'"]');
			if(target.is('.toggle-button')){
				if(target.is(':checked')){
					return true;
				}else{
					return false;
				}
			}
			if(target.size() == 0){
				return jQuery('[name="sc_'+a+'[]"]').val();
			}else{
				return target.val();
			}
		}else if(c == undefined){
			var target = jQuery('[name="sc_'+a+'_'+b+'"]');
			if(target.is('.toggle-button')){
				if(target.is(':checked')){
					return true;
				}else{
					return false;
				}
			}
			if(target.size() == 0){
				return jQuery('[name="sc_'+a+'_'+b+'[]"]').val();
			}else{
				return target.val();
			}
		}else {
			var target = jQuery('[name="sc_'+a+'_'+b+'_'+c+'"]');
			if(target.is('.toggle-button')){
				if(target.is(':checked')){
					return true;
				}else{
					return false;
				}
			}
			if(target.is('.tri-toggle-button')){
				switch(target.val()){
					case 'true':
						return true;
					case 'false':
						return false;
					case 'default':
						return '';
				}
			}
			if(target.size() == 0){
				return jQuery('[name="sc_'+a+'_'+b+'_'+c+'[]"]').val();
			}else{
				return target.val();
			}
		}
		
	},
	sendToEditor :function(){
		 send_to_editor(shortcode.generate());
	}
		
}

jQuery(document).ready( function($) {
	shortcode.init();
});
