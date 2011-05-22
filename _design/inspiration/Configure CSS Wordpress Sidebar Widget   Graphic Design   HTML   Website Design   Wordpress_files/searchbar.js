	JQ= jQuery.noConflict();
    JQ(document).ready(function() {
								
	  JQ("#thnavbar .thmenu").hover(function() {
		JQ(this).children("ul.subnav").show();
		JQ(this).hover(function() {
				JQ(this).find("a:first").addClass("thhover");
			}, function(){	
				JQ(this).parent().find("ul.subnav").hide();
				JQ(this).find("a:first").removeClass("thhover");
			});
		}).hover(function() {
			JQ(this).find("a:first").addClass("thhover");
		}, function(){
			JQ(this).find("a:first").removeClass("thhover");
	});
	  
        JQ('#search-bar form div.form-container input').focus(function() {
          if (this.value === this.defaultValue){  
            this.value = '';  
          } else {  
            this.select();  
          }
         
          JQ('#search-bar div.fancy-panel').show();
          JQ('#search-bar div.arrow').removeClass('arrow-up')
          JQ('#search-bar div.arrow').addClass('arrow-down')
        
        });
      
        JQ('#search-bar form div.form-container input').click(function() {
          JQ('#search-bar div.fancy-panel').show();
          JQ('#search-bar div.arrow').removeClass('arrow-up')
          JQ('#search-bar div.arrow').addClass('arrow-down')
        
        });
		
        JQ('#search-bar form div.form-container').mouseleave(function() {            
            JQ('#search-bar div.fancy-panel').hide();
            JQ('#search-bar div.arrow').removeClass('arrow-down')
          JQ('#search-bar div.arrow').addClass('arrow-up')
        });
        JQ('#search-bar form div.form-container input').blur(function() {
          if (JQ.trim(this.value) === ''){  
            this.value = (this.defaultValue ? this.defaultValue : '');  
          }
        });

		JQ("input.search_type").change(function() {
			var search_type = JQ("input.search_type:checked").attr('search_type');
			JQ("#search-bar form").attr('action', "/" + search_type + "/search.php");
			if (search_type == 'marketplace') {
				JQ("#search-bar form").attr('method', 'get');
			} else {
				JQ("#search-bar form").attr('method', 'post');
			}
	  	});
	 });
	

