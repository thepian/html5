jq = jQuery.noConflict();
jq.getJSON('/ajax/count-24h.php', function(r) {
	var fp_24h = r.user_count_24h;
	var fp_s = 86400000 / fp_24h;
	var PJ_24h = r.project_count_24h;
	var PJ_s = 86400000 / PJ_24h;
	var deposits_24h = r.deposits_24h;
	var deposits_s = deposits_24h / 17280;
	
	rpt('.totalFp', fp_s, 1);
	rpt('.totalCash', 5000, deposits_s);
	rpt('.totalPJ', PJ_s, 1);
}); 