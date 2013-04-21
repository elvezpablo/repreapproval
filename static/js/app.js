/*
	Title: Sammy RePreApproval App
	Author: Paul Rangel
*/


(function($) {

	var app = $.sammy("#main",function() {
		// set up the index route
		//this.use("Template");
		this.use("Title");
		this.use('Handlebars');

		this.setTitle("RePreApproval : ");

		// 
		var current_user = false;

		this.around(function(callback) {
						
			SetActiveLink(this.path);
			var context = this;

			if(!current_user) {
				this.load('data/current_user.json')
				.then(function(data) { 
					current_user = data; 
				})				
				.then(function(partial) {
					context.render("templates/profile.handlebars", current_user).appendTo($("#profile"));
				})				
				.then(callback);	
			} else {
				callback();
			}

	    });

		this.get("#/", function(context) {
			//console.log(context);
			this.title("Hi! "+current_user.first_name);
			context.app.swap('');
			this.load("data/items.json")
				.then(function(items){
					context.items = items;
				})
				.load('templates/item_detail.handlebars')
				.then(function(partial){					
					// NOTE we can have more than one
					context.partials = {letter_detail : partial}; 
					context.partial('templates/welcome.handlebars');					
				});
		});	
		// TODO: do something else if we got here via a post 
		// as we just added a new letter 
		this.post("#/", function(context) {
			//console.log(context);
			this.title("Hiya! "+current_user.first_name);
			context.app.swap('');
			this.load("data/items.json")
				.then(function(items){
					context.items = items;
				})
				.load('templates/item_detail.handlebars')
				.then(function(partial){					
					// NOTE we can have more than one
					context.partials = {letter_detail : partial}; 
					context.partial('templates/welcome.handlebars');					
				});
		});		
		// the detail route 
		this.get("#/item/:id",function(context) {

		})
		//
		this.get("#/create", function(context) {
			var context = this;
			this.title("Create Letter");
			this.load("data/users.json")
				.then(function(users) {
					context.users = users;				
				})
				.render('templates/create.handlebars', context.users)
				.swap()
				.then(function(partial){
					//console.log(partial.$("#newClientModelFormSubmitBtn"));
					PredefinedDatePicker.init();

					$("#createLetterForm").validate({						
						submitHandler: function(form) {							
							if($("#createLetterForm").valid())
								form.submit();
						}
					});

					$("#newClientModelFormSubmitBtn").click(function() {						
						$("#newClientModelForm").submit();
					});

					$("#newClientModelForm").validate({
						submitHandler: function(form) {
							console.log("form valid: "+$("#newClientModelForm").valid());
							//form.submit();
							// TODO: ajax here 
							//
							// add the new user to the list or show error
							$("#clientList")
								.prepend($("<option></option>").attr("value", 2)
								.text($("#inputFullname").val()));							
							// TODO: show error
							// 
							// close the modal
							$("#newClientModal").modal("hide");
							// set the selected index of the users to the new user
							$("#clientList")[0].selectedIndex = 0;
						}
					});

					// formats the number input
					$("#purchasePrice").change(function(){						
						$(this).val(accounting.formatNumber($(this).val()));						
					});
					$("#downPayment").change(function(){						
						$(this).val(accounting.formatNumber($(this).val()));						
					});
					$("#loanAmount").change(function(){						
						$(this).val(accounting.formatNumber($(this).val()));						
					});

					// this.load("data/users.json")
					// 	.then(function(items){
							
					// 		$.each(items, function(i, item) {
					// 			console.log($("#clientList"));
					// 			$("#clientList")
					// 			.append($("<option></option>").attr("value", item.id))
					// 			.text(item.fullname);		
					// 		});
							
					// 	});
				});
			
			
		});
		//
		this.get("#/request", function(context) {
			this.title("Request Changes");	
			context.app.swap('');
			context.$element().html("request");
		});
		this.get("#/request/:id", function(context) {
			this.title("Request Changes");	
			context.app.swap('');
			context.$element().html("request");
		});

		this.get("#/profile", function(context){

		});
		// POST for editing
		this.post("#/profile", function(context){
			
		});

		this.get("#/logout", function(context){
			// TODO: do some logout logic
			current_user = false;
			// need to change state in login, upper right
			this.redirect('#/login');
		});

		this.get("#/login", function(context){
			context.app.swap('');
			context.partial('templates/login.handlebars');
		});

	});

	// sammy doesn't run until you tell it to
	// this connects it to jquery onload event
	$(function() {
		app.run("#/");
	});


})(jQuery);


/*
*
*/


var BASE64_MARKER = ';base64,';

function convertDataURIToBinary(dataURI) {
  var base64Index = dataURI.indexOf(BASE64_MARKER) + BASE64_MARKER.length;
  var base64 = dataURI.substring(base64Index);
  var raw = window.atob(base64);
  var rawLength = raw.length;
  var array = new Uint8Array(new ArrayBuffer(rawLength));

  for(i = 0; i < rawLength; i++) {
    array[i] = raw.charCodeAt(i);
  }
  return array;
}

    

//TODO: this should be moved to nav module
function SetActiveLink(name){
    var ul = $('.nav')        
    ul.find('a').removeClass('active');    
    ul.find('a[href="'+name+'"]').addClass('active');
}

