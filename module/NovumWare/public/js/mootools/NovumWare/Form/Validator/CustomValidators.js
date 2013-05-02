(function(){
	'use strict';
	Form.Validator.add('nwEmailIsUnique', {
		errorMsg: 'This email is already in use, please choose another one',
		test: function(elmt){
			// TODO don't check if the other validators haven't passed
			if (elmt.value.length === 0) { return true; }
			var request = new Request.JSON({
				url: (elmt.get('data-nwEmailIsUnique-url')) ? elmt.get('data-nwEmailIsUnique-url') + '/' + elmt.get('value') : '/registration/check-email-availability/format/json',
				async: false
			}).send();
			return !request.response.json.emailTaken;
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

	Form.Validator.add('nwNameIsUnique', {
		errorMsg: 'This name is already in use, please choose another one',
		test: function(elmt){
			// TODO don't check if the other validators haven't passed
			if (elmt.value.length === 0) { return true; }
			var request = new Request.JSON({
				url: (elmt.get('data-nwNameIsUnique-url')) ? elmt.get('data-nwNameIsUnique-url') + '/' + elmt.get('value') : '/registration/check-username-availability/format/json',
				async: false
			}).send();
			return !request.response.json.nameTaken;
		}
	});
	Form.Validator.add('nwPhoneIsUnique', {
		errorMsg: 'This phone number is already in use, please choose another one',
		test: function(elmt){
			// TODO don't check if the other validators haven't passed
			if (elmt.value.length === 0) { return true; }
			var request = new Request.JSON({
				url: (elmt.get('data-nwPhoneIsUnique-url')) ? elmt.get('data-nwPhoneIsUnique-url') + '/' + elmt.get('value') : '/registration/check-username-availability/format/json',
				async: false
			}).send();
			return !request.response.json.phoneTaken;
		}
	});
})();