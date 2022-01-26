

             // THIS IS FOR THE SIGN-UP
$(document).ready(function () {
    $(".cpassauth").hide();
    $(".alertforsuccess").hide();
    $("#signupform").submit(function (e) { 
        password = $("#reg_password").val();
        cpassword = $("#reg_cpassword").val();
        frontdata = $("#data").val();
        var email = $("#reg_email").val();

        min = 8
  
        if (password != cpassword ) {
                e.preventDefault();
                $(".cpassauth").show();
                $(".cpassauth").addClass("alert text-info");
                $(".cpassauth").text("Password Not Match");

                $("#reg_cpassword").val("");

            } 
            else {
            //     $(".cpassauth").hide();
            //     var url = $(this).attr("action");
            //     var postdata = $(this).serialize();
                
            //     $.post(url, postdata,
            //                 (data, textStatus, jqXHR) => {
            //                     $(".alertforsuccess").addClass("alert alert-success text-info");
            //                     $(".alertforsuccess").show();
            //                     $(".alertforsuccess").text(data);
            //                     console.log(data);
            //                     console.log(email)
            //                     if (data == email+ " Check your Email for the OTP code") {
                                    // setTimeout( () => {
                                    //     window.location.href = "email/verification.php"
                                    // }, 0000);
                                    
            //                     }
            //                 });


         


            }
     });
});


                // THIS IS FOR HIDDEN PASSWORD TOGGLE
$(function () {
    $('[data-toggle="password"]').each(function () {
        var input = $(this);
        var eye_btn = $(this).parent().find('.input-group-text');
        eye_btn.css('cursor', 'pointer').addClass('input-password-hide');
        eye_btn.on('click', function () {
            if (eye_btn.hasClass('input-password-hide')) {
                eye_btn.removeClass('input-password-hide').addClass('input-password-show');
                eye_btn.find('.fad').removeClass('fa-eye').addClass('fa-eye-slash')
                input.attr('type', 'text');
            } else {
                eye_btn.removeClass('input-password-show').addClass('input-password-hide');
                eye_btn.find('.fad').removeClass('fa-eye-slash').addClass('fa-eye')
                input.attr('type', 'password');
            }
        });
    });
});


                // THIS IS FOR THE LOGIN    
$(document).ready(function () {
    $("#loginform").submit(function (e) { 
        e.preventDefault();

            // This is to show judikay how to set a new attr value that will occur right after the form is submitted
            // $(this).attr('new_attr', 'show_judikay');

            $("#login_info").hide();
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
            $.post(url, postdata,
                        (data, textStatus, jqXHR) => {
                            $("#login_info").addClass("alert alert-success text-info");
                            $("#login_info").show();
                            $("#login_info").text(data);
                            // $("body").text(data);
                            console.log(data);
                            if (data == "Login Successful") {
                                setTimeout( () => {
                                    window.location.href = "forum/blog_new.php"; 
                                 }, 1000);       
                            }
                        },
                    );
    });
});


            // THIS IS FOR PASSWORD RECOVERY

$(document).ready(function () {
    $("#recoveryForm").submit(function (e) { 
        e.preventDefault();
        email = $("#email_address").val();
        url = $(this).attr("action");
        postdata = $(this).serialize()
        $.post(url, postdata,
            function (data, textStatus, jqXHR) {
    
                    $("#recoveryinfoSuccess").addClass("alert alert-success text-info");
                    $("#recoveryinfoSuccess").show();
                    console.log(data);
                    
                    if (data == 1) {
                        $("#recoveryinfoSuccess").text(email+" not found!");                                
                        $("#email_address").val("");
                    }
                    else if (data == 2) {
                        $("#recoveryinfoSuccess").text(email+" not verified");                                
                        $("#email_address").val("");      
                    }
                    else if (data == 3) {
                        // $("#recoveryinfoSuccess").text(email+" is not valid");                                
                        $("#recoveryinfoSuccess").text("Check Internet Connection");                                
                        $("#email_address").val("");     
                    }
                    else if (data == 4) {
                        $("#recoveryinfoSuccess").text("Thank You , check your email for the recovery link");                                
                        // $("#recoveryinfoSuccess").text(data);                                
                        // setTimeout( () => {
                        //         window.location.href = "reset_psw.php"; 
                        //         }, 3000);       
                            
                    }


    });

});  
});



// THIS IS FOR THE RESET PASSWORD
// $(document).ready(function () {
//     $("#resetform").submit(function (e) { 
//         e.preventDefault();

//             $("#resetinfo").hide();
//             var rurl = $(this).attr("action");
//             var rpostdata = $(this).serialize();
//             $.post(rurl, rpostdata,
//                         (rdata, textStatus, jqXHR) => {
//                             $("#resetinfo").addClass("alert alert-success text-info");
//                             $("#resetinfo").show();
//                             $("#resetinfo").text(rdata);
//                             // $("body").text(data);
//                             alert(rdata)
//                             console.log(rdata);
//                             if (data == "Password Reset") {
//                                 setTimeout( () => {
//                                     window.location.href = "../../signup.login.html"; 
//                                     }, 1000);       
//                             }
//                         },
//                     );
//     });
// });




