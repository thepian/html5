var $rotateoptions = new Array();
$rotateoptions[3] = new Array();
$rotateoptions[3]["style"] = "tabs";
$rotateoptions[3]["rotate"] = 0;
$rotateoptions[3]["random_start"] = 0;
$rotateoptions[3]["start_tab"] = 1;
$rotateoptions[3]["interval"] = 10000;


$tw = jQuery.noConflict();

$tw(document).ready(function() {

	$tw('.tabbed-widget').each(function() {
		var $widgetid = $tw(this).attr("id"); // tabbed-widget-1
		$widgetid = $widgetid.split("-", 3)[2];
		
		var $widgetstyle = $rotateoptions[$widgetid]["style"];
		var $do_rotate = $rotateoptions[$widgetid]["rotate"];
		var $rotate_interval = $rotateoptions[$widgetid]["interval"];
		var $random_start = $rotateoptions[$widgetid]["random_start"];
		var $start_tab = $rotateoptions[$widgetid]["start_tab"];
		
		if ($widgetstyle == 'tabs') {
			var $tab_count = 0;
			
			// Build  tab navigation
			var $tabbed_nav = '<ul class="tw-tabbed-nav">';
			$tw('.tw-title', this).each(function(i) {
				$tabbed_nav += '<li id="tab-link-'+ $widgetid +'-'+ i +'"><a href="#tw-content-'+ $widgetid +'-'+ i +'">' + $tw(this).text() + '</a></li>';
				$tab_count++;
			}).hide();
			$tabbed_nav += '</ul>';
			
			$tw('.tw-tabs', this).prepend($tabbed_nav);
			
			var $options = { cookie: { expires: 30 } };
			
			if ($random_start)
				$start_tab = Math.floor($tab_count * Math.random());
			
			jQuery.extend($options, { active: $start_tab });
			
			//console.log($options);
			//console.log($start_tab);
			
			if ($do_rotate)
				$tw('.tw-tabs', this).tabs($options).tabs('rotate', $rotate_interval);
			else
				$tw('.tw-tabs', this).tabs($options);
			
		} else if ($widgetstyle == 'accordion') {
			var $tab_count = 0;
			var $acco = $tw('.tw-accordion', this);
			
			$tw('.tw-title', this).each(function(i) {
				$tw(this).html('<a href="#">'+$tw(this).text()+'</a>');
				$tab_count++;
			});
		
			var $options = { autoHeight: false, header: '.tw-title' };
			
			if ($random_start)
				$start_tab = Math.floor($tab_count * Math.random());
			
			jQuery.extend($options, { active: $start_tab });
		
			$acco.accordion($options);
			
			//$tw('.ui-accordion-header:first', this).addClass('tw-first-widget');
			//$tw('.ui-accordion-header:last', this).addClass('tw-last-widget');
			
			if ($do_rotate) {				
				var $cleared = false;
				var $wasstopped = false;
				
				(function() {
				    var t = 0;
					var $step = 0;
					var $saverotation;
					
					function dorotate() {
						t = ++t;
						if (t == $tab_count) { $step = -2; t = t + $step;  }
						else if (t == 1) { t = t; $step = 0; }
						else { t = t + $step; }
						$acco.accordion('activate', t);
				    }
					
				    if (!$cleared) 
						var rotation = setInterval(function(){ dorotate(); }, $rotate_interval);
					
					$acco.bind("mouseenter", function(){
						clearInterval(rotation);
						rotation = null;
						$cleared = true;
					}).bind("mouseleave",function(){
						if (!$wasstopped) rotation = setInterval(function(){ dorotate(); }, $rotate_interval);
					}).bind("click",function(){
						$wasstopped = true;
						clearInterval(rotation); rotation = null;
					});
					
				})();
			}			
		}		
	});	
	
});