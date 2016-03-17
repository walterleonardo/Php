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
            var pass = $("input#pass").val();
            var passa = $("input#passa").val();
            var rpassa = $("input#rpassa").val();
            var firstName = user; // For Success/Failure Message
            // Check for white space in name for Success/Fail message
            if (firstName.indexOf(' ') >= 0) {
                firstName = user.split(' ').slice(0, -1).join(' ');
            }
            $.ajax({
                url: "cambiarclavecode.php",
                type: "POST",
                data: {
                    user: user,
                    pass: pass,
                    passa: passa,
                    rpassa: rpassa
                },
                cache: false,
                success: function(data) {
                //alert( data );
                if (data == "DONE"){
                    // Success message
                    //window.location.reload();
                    $('#success').html("<div class='alert alert-success'>");
                    $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-success')
                        .append("<strong>Clave actualizada.</strong>");
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