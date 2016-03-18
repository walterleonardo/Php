$(function() {

    $("input").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            // get values from FORM
            var user = $("input#user").val();
            var address = $("input#address").val();
            var phone = $("input#phone").val();
            var nas = $("input#nas").val();
            var nas1 = $("input#nas1").val();
            var nas2 = $("input#nas2").val();
            var nas3 = $("input#nas3").val();
            var nas4 = $("input#nas4").val();
            var nas5 = $("input#nas5").val();
            var code = $("input#code").val();
            var firstName = user; // For Success/Failure Message
            // Check for white space in name for Success/Fail message
            if (firstName.indexOf(' ') >= 0) {
                firstName = user.split(' ').slice(0, -1).join(' ');
            }
            $.ajax({
                url: "update.php",
                type: "POST",
                data: {
                    user: user,
                    address: address,
                    phone: phone,
                    nas: nas,
                    nas1: nas1,
                    nas2: nas2,
                    nas3: nas3,
                    nas4: nas4,
                    nas5: nas5,
                    code: code
                },
                cache: false,
                success: function(data) {
                //alert( data );
                if (data == "DONE"){
                    // Success message
                    //window.location.reload();
                    window.location.reload(true);
                    $('#success').html("<div class='alert alert-success'>");
                    $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-success')
                        .append("<strong>Información actualizada, refresque la pagina para ver los cambios.</strong>");
                    $('#success > .alert-success')
                        .append('</div>');

                    //clear all fields
                    $('#contactForm').trigger("reset");
                    }else{
	                    // Fail message
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-danger').append("<strong>Lo siento " + firstName + ", parece existir un problema, " + data);
                    $('#success > .alert-danger').append('</div>');
                    //clear all fields
                    //$('#contactForm').trigger("reset");
	                    
                    }
                },
                error: function(data) {
                //alert( data );
                    // Fail message
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-danger').append("<strong>Lo siento " + firstName + ", parece existir un problema, "+ data);
                    $('#success > .alert-danger').append('</div>');
                    //clear all fields
                    //$('#contactForm').trigger("reset");
                },
            })
        },
        filter: function() {
            return $(this).is(":visible");
        },
    });

    $("a[data-toggle=\"tab\"]").click(function(e) {
        e.preventDefault();
        $(this).tab("show");
    });
});


/*When clicking on Full hide fail/success boxes */
$('#name').focus(function() {
    $('#success').html('');
});