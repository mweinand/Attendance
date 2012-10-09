$(document).ready(function() {

	var scanInput = $("#ScanInput");

	var resetForm = function() {
		scanInput.css('background-color', '#FFF');
		scanInput.prop('disabled', false);
		scanInput.val('');
	};

	var showError = function(direction) {
		scanInput.css('background-color', '#F00');
		setTimeout(resetForm, 500);
	};

	var showSuccess = function(direction) {
		scanInput.css('background-color', '#0F0');
		setTimeout(resetForm, 500);
	};

	var verifyQuickAction = function(direction) {
		if(confirm('You just logged in.  Are you sure you want to logout?')) {
			
		}
	};

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
							showSuccess(data.direction);
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
