$(document).ready(function() {

	var scanInput = $("#ScanInput");
	var statusMessage = $('#StatusMessage');
	var checking = false;
	var delay = 1000;

	var resetForm = function() {
		scanInput.css('background-color', '#FFF');
		scanInput.prop('disabled', false);
		scanInput.val('');
		scanInput.focus();
	};

	var showError = function(direction) {
		scanInput.css('background-color', '#F00');
		statusMessage.css('color', '#F00');
		statusMessage.text('Invalid User');
		setTimeout(resetForm, delay);
	};

	var showSuccess = function(direction, user) {
		scanInput.css('background-color', '#0F0');
		statusMessage.css('color', '#0F0');
		statusMessage.text(user);
		setTimeout(resetForm, delay);
	};

	var verifyQuickAction = function(direction) {
		if(confirm('You just logged in.  Are you sure you want to logout?')) {
			
		}
	};
	
	scanInput.focus(function() {
		statusMessage.css('color', '#000');
		statusMessage.text('Ready');
	});	

	scanInput.keypress(function(e) {
		if(e.which == 13) {
			scanInput.css('background-color', '#FF0');
			var input = scanInput.val();
			scanInput.prop('disabled', true);
			$.ajax({
				url: '/application/index/trigger', 
				dataType: 'json',
				type: 'POST',
				data: {
					input: input
				}, 
				success: function(data) { 
					switch(data.result) {
						case 0:
							showError(data.direction);
							break;
						case 1:
							showSuccess(data.direction, data.user);
							break;
						case 2:
							break;
					}
				}
			});
		}
	});
	
	resetForm();
	
});
