$(document).ready(function(){

var addr;
  $('#select_address').change(function(){
    addr=$(this).find("option:selected").val();
    console.log(addr);
    $.ajax({
    	url: 'http://localhost/wexplore2/get_address/'+addr,
    	success: function(data) {
        //console.log(JSON.stringify(data));
        $("[name='first_name']").val(data.first_name);
        $("[name='last_name']").val(data.last_name);
        $("[name='email']").val(data.email);
        $("[name='phone_number']").val(data.phone_number);
        $("[name='city']").val(data.city);
        $("[name='state']").val(data.state);
        $("[name='post_code']").val(data.post_code);
        $("[name='country'] option:eq("+data.country+")").attr('selected', 'selected');
    	$("[name='address_id']").val(data.addr_id);
    	},
    	complete: function(){
    		
    	}
    }); // ajax*/
  });
	// Paypal payment select
	$('[name=paymentOption]').change(function(){
		var selected_val=$(this).val();
		if(selected_val=='paypal_credit_card'){
			$('#paypal_direct_payment_form').hide();
			$('#paypal_credit_card_form').show();
            $('#paypal_direct').attr('disabled','disabled');
            $('#paypal_credit_card').attr('disabled',false);
		}
		else{
			$('#paypal_credit_card_form').hide();
			$('#paypal_direct_payment_form').show();
            $('#paypal_direct').attr('disabled',false);
            $('#paypal_credit_card').attr('disabled','disabled');
		}
	});
	// Credit card month and year picker
	$("#monthpicker").datepicker( {
    format: "mm", // Notice the Extra space at the beginning
    viewMode: "months", 
    minViewMode: "months"
	});
	$("#yearpicker").datepicker( {
    format: "yyyy", // Notice the Extra space at the beginning
    viewMode: "years", 
    minViewMode: "years"
	});
	// Validate credit card
	/*jQuery.validator.addMethod("cardNumber", function(value, element) {
    return this.optional(element) || Stripe.card.validateCardNumber(value);
}, "Please specify a valid credit card number.");*/
	$("#paypal_credit_card_form").validate({
        errorPlacement: function(error, element) {
			// Append error within linked label
			/*$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "']" )
						.append( error );*/
            $( element )
                .closest( "form" )
                    .find("[name='" + element.attr( "name" ) + "'] + .with-errors")
                        .html( error ); 
		},
		errorElement: "span",
        rules: {
						card_number:{
								required: true,
                number: true,
                minlength: 16,
                maxlength: 16
            },
        },
         messages: {
            card_number:{
								required: "* Credit card number is required",
                number: "*Only numeric number is allowed",
                minlength: "*Required length is 16",
                maxlength: "*Required length is 16"
            }
          }
    });
  // add more fields for market analysis
  var x = 1; //initlal text box count
  $(".add_field_button").click(function(e){ //on add input button click
      e.preventDefault();
      if(x < 10){ //max input box allowed
          x++; //text box increment
          $(".file_fields_wrap").append('<div class="form-group"><input type="file" class="form-control" name="market_analysis_pdf[]"><a href="#" class="remove_field">Remove</a></div>'); //add input box
      }
  });
  // remnove
  $(document).on("click",".remove_field", function(e){ //user click on remove text
      e.preventDefault();
      $(this).parent('div').remove();
      x--;
  });
  // $('select[name="industry"] option').hover(function () {
  //   $('.profile-help-desc').hide();
  //   $('#' + $(this).val()).show();
  // });

  // $('select[name="Occupation"] option').hover(function () {
  //   $('.profile-help-desc').hide();
  //   $('#' + $(this).val()).show();
  // });


});
$(document).ready(function(event) {
    $( ".main-sidebar" ).append( "<div class='Toggle_menu_burger'><span class='span_1'></span><span class='span_2'></span><span class='span_3'></span></div>" );
});


$(document).ready(function(){
   $(".Toggle_menu_burger").click(function(){
      $("body, html").toggleClass('open_class');
    });
});
