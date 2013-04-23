(function(){
	'use strict';
	Form.Validator.add('nwEmailIsUnique', {
		errorMsg: 'This email is already in use, please choose another one',
		test: function(elmt){
			// TODO don't check if the other validators haven't passed
			if (elmt.value.length === 0) { return true; }
			var request = new Request.JSON({
				url: '/registration/check-email-availability/format/json',
				async: false
			}).send(elmt.get('name') + '=' + elmt.get('value'));
			return request.response.json.available;
		}
	});

	Form.Validator.add('nwUsernameIsUnique', {
		errorMsg: 'This username is already in use, please choose another one',
		test: function(elmt){
			// TODO don't check if the other validators haven't passed
			if (elmt.value.length === 0) { return true; }
			var request = new Request.JSON({
				url: '/registration/check-username-availability/format/json',
				async: false
			}).send(elmt.get('name') + '=' + elmt.get('value'));
			return request.response.json.available;
		}
	});
})();