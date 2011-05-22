function facebook_verifyLoginStatus(){
	FB.getLoginStatus(function (response) {
		if (response.session == null) {
			return;
		}
		facebook_redirect();
		return;
	});
}

function facebook_redirect(){
	var goto_url = jq('#login_goto_id').val();
    var partner = jq('#partner').val();
    var url = '/users/facebook/index.php?auto_link=1';
	if(goto_url != undefined){
		window.location.href = url + '&decode=1&goto_url=' + goto_url + '&partner=' + partner;
		return;
	}
	window.location.href = url + '&goto_url='+escape(window.location.href);
	return;
}


function facebook_logout(){
	FB.logout();
}
