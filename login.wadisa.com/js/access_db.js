$(function () {

    $("input").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function ($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function ($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            // get values from FORM
            var userid = $("input#userid").val();
            var id = $("input#id").val();
            var user = $("input#user").val();
            var pass = $("input#pass").val();
            var sec = $("input#sec").val();
            var rpass = $("input#rpass").val();
            var rpassb = $("input#rpassb").val();
            var btnlogin = $("input#type").val();
            var address = $("input#address").val();
            var drname = $("input#drname").val();
            var drphone = $("input#drphone").val();
            var phone = $("input#phone").val();
            var phonee1 = $("input#phonee1").val();
            var phonee2 = $("input#phonee2").val();
            var medicine = $("input#medicine").val();
            var blood = $("input#blood").val();
            var detail = $("input#detail").val();
            var alergy = $("input#alergy").val();
            var name = $("input#name").val();
            var lastname = $("input#lastname").val();
            var qr = $("input#qr").val();
            var firstName = user; // For Success/Failure Message
            // Check for white space in name for Success/Fail message
            if (firstName.indexOf(' ') >= 0) {
                firstName = user.split(' ').slice(0, -1).join(' ');
            }
            $.ajax({
                url: "../config/class.user.php",
                type: "POST",
                data: {
                    phonee1: phonee1,
                    phonee2: phonee2,
                    medicine: medicine,
                    blood: blood,
                    detail: detail,
                    alergy: alergy,
                    name: name,
                    lastname: lastname,
                    drname: drname,
                    drphone: drphone,
                    qr: qr,
                    id: id,
                    userid: userid,
                    btnlogin: btnlogin,
                    user: user,
                    sec: sec,
                    rpass: rpass,
                    rpassb: rpassb,
                    pass: pass,
                    address: address,
                    phone: phone
                },
                cache: false,
                success: function (data) {
                    if (data === "DONE") {
                        // window.location.replace("http://www.buhonet.es/en/home/index.php");
                        window.location.reload(true);
                        // Success message
                        $('#success').html("<div class='alert alert-success'>");
                        $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                                .append("</button>");
                        $('#success > .alert-success')
                                .append("<strong>Account connected success. </strong> ");

                        $('#success > .alert-success')
                                .append('</div>');

                        //clear all fields
                        $('#contactForm').trigger("reset");
                    } else {
                        // Fail message
                        $('#success').html("<div class='alert alert-danger'>");
                        $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                                .append("</button>");
                        $('#success > .alert-danger').append("<strong>Sorry " + firstName + ", we found a problema, " + data);
                        $('#success > .alert-danger').append('</div>');
                        //clear all fields
                        //$('#contactForm').trigger("reset");

                    }
                },
                error: function (data) {
                    alert(data);
                    // Fail message
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                            .append("</button>");
                    $('#success > .alert-danger').append("<strong>Sorry " + firstName + ", we found a problem ");
                    $('#success > .alert-danger').append('</div>');
                    //clear all fields
                    $('#contactForm').trigger("reset");
                }
            });
        },
        filter: function () {
            return $(this).is(":visible");
        }
    });

    $("a[data-toggle=\"tab\"]").click(function (e) {
        e.preventDefault();
        $(this).tab("show");
    });
});


/*When clicking on Full hide fail/success boxes */
$('#name').focus(function () {
    $('#success').html('');
});
