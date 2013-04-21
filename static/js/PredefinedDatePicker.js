/*
	title: PredefinedDatePicker.js
	author: Paul Rangel
	description: Date picker with some predefined dates
*/

var PredefinedDatePicker = (function () {

	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
	var plus60 = new Date(now.getTime());							

	var _init = function() {
		
		plus60.setDate(now.getDate()+60);

		var expiresDatePicker = $('#expirationDate').datepicker({
			onRender : function(date) {
				return date.valueOf() < now.valueOf() ? 'disabled' : '';
			}
		}).on('changeDate', function(ev) {
			var selectedDate = new Date(ev.date);
			_sync(selectedDate);						

		}).data('datepicker');

		expiresDatePicker.setValue(now);

		$('#expiresToday').click(function(evt) {						
			expiresDatePicker.setValue(now);
			_sync(now);						
		});

		$('#expires60').click(function(evt) {																		
			expiresDatePicker.setValue(plus60);
			_sync(plus60);
		});
	}		
	
	var _sync = function(newDate) {
		
		var diff = newDate.getTime() - now.getTime();
		var days = (diff / (24*60*60*1000));
		if(days > 0) {
			$('#expiresDateHelp').html("Expires in "+days+" days");	
		} else {
			$('#expiresDateHelp').html("Use buttons to jump date.")
		}		
		_syncButtons(newDate);
	}

	var _syncButtons = function(date) {
		if(now.getTime() == date.getTime()) {
			$('#expiresToday').addClass("btn-primary");
		} else {
			$('#expiresToday').removeClass("btn-primary");
		}
		if(plus60.getTime() == date.getTime()) {
			$('#expires60').addClass("btn-primary");
		} else {
			$('#expires60').removeClass("btn-primary");
		}
	}

	return {    	  
    	init: function( foo ) {		 
      		_init();
    	}
	};
})($);