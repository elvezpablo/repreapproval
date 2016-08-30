var err= 0;
function checkma(ee)
 {
   var vv= $('#'+ee).val();
   if(vv=='')
    {
	  $('#'+ee).attr('placeholder', 'Fill this field');
	  $('#'+ee).addClass('error');
	  err= 1;
	}
   else
    {
	  var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
	  var valid = emailRegex.test(vv);
	  if(!valid)
	   {
	     $('#'+ee).addClass('error');
		 $("#"+ee).attr("value", "");
		 $('#'+ee).attr('placeholder', 'Invalid email');
	     err= 1;
	   }
	  else
	   {
		 $('#'+ee).removeClass('error');
	     err= 0;
	   }
	}
 }

function checkmablur(ee)
 {
   $("#alread").val("");
   var vv= $('#'+ee).val();
   if(vv=='')
    {
	  $('#'+ee).attr('placeholder', 'Fill this field');
	  $('#'+ee).addClass('error');
	  err= 1;
	}
   else
    {
	  var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
	  var valid = emailRegex.test(vv);
	  if(!valid)
	   {
	     $('#'+ee).addClass('error');
		 //$("#"+ee).attr("val", "");
		 $("#"+ee).val("");
		 $('#'+ee).attr('placeholder', 'Invalid email');
	     err= 1;
	   }
	  else
	   {
		 $.ajax({
    		type: "POST",
    		data:{mai:vv},
    		url: "ajaxX.php",
    		dataType: "html",
    		success:function(data)
	  		 {
	   		   if(data=='alright')
			    {
				  $('#alread').attr('value', 'GOTRUE');
				  $('#'+ee).removeClass('error');
	     		  err= 0;
				}
			   else
			    {
				  $('#'+ee).addClass('error');
		 		  $("#"+ee).val("");
		 		  $('#'+ee).attr('placeholder', 'Email Already Registered');
	     		  err= 1;
				}
	  		 }
  		 });
	   }
	}
 }

function fillfield(ee)
 {
   var vv= $('#'+ee).val();
   if(vv=='')
    {
	  $('#'+ee).attr('placeholder', 'Fill this field');
	  $('#'+ee).addClass('error');
	  err= 1;
	}
   else
    {
	  $('#'+ee).removeClass('error');
	  err= 0;
	}
 }

$(document).ready(function(){

  $('.phomo').keyup(function()
   {
    this.value = this.value.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
	//this.value = this.value.replace(/(\d{4})\-?/g,'$1-');
   });

  $('.poin').on('keydown',function(event){
   var e = event || evt;
   var charCode = e.which || e.keyCode;
   if(charCode > 31 && (charCode < 48 || charCode > 57) && (charCode < 96 || charCode > 105))
	 return false;
   return true;
  });

  $('#registerform').submit(function(){
	fillfield('first_name');
	checkma('user_email');
	fillfield('phone');
	fillfield('zip');
	//fillfield('byr1');
	//fillfield('byr2');
	//fillfield('byr3');
	if(err==1)
	 {
	   return false;
	 }
	if($('#break').val()=='ruko')
	 {
	   return false;
	 }
	if($('#alread').val()!='GOTRUE')
	 {
	   return false;
	 }
  });
});
