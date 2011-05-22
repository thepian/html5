// ajax call for general vars
jQuery.getJSON("/ajax/_general_vars.php", 
		function(r) {
			jQuery('.stat .totalFp').html(format_int(r.user_count, ',')); 
			jQuery('.stat .currency-sign').html(r.currency_sign); 
			jQuery('.stat .currency-code').html(r.currency_code); 
			jQuery('.stat .totalCash').html(format_int(r.deposits, ',')); 
			jQuery('.stat .totalPJ').html(format_int(r.project_count, ',')); 
			
			jQuery('.txt-user-in-million').html(format_num_in_mil(r.user_count));
			jQuery('.txt-project-in-million').html(format_num_in_mil(r.project_count));
			jQuery('.COUNT-REGISTERED-USER').html(format_int(r.user_count, ',')); 
			jQuery('.COUNT-PROJECT').html(r.project_count); 
			jQuery('.COUNT-ONLINE-USER').html(r.onlineusercount); 
		}
);
jQuery('.container-domain-switcher').load("/ajax/domain-switcher.php");
