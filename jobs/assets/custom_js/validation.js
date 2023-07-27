function getsourceaddress() {
    var autocomplete;
    var input = document.getElementById('location');
    var options = {
        componentRestrictions: {country: 'ca'}
    };
    var autocomplete = new google.maps.places.Autocomplete(input);
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        $("#latitude").val(lat);
        $("#longitude").val(lng);
        initMap();
    });
}
google.maps.event.addDomListener(window,'load',getapi_address);

function only_number(event) {
    var x = event.which || event.keyCode;
    console.log(x);
    if((x >= 48 ) && (x <= 57 ) || x == 8 | x == 9 || x == 13 ) {
        return;
    } else {
        event.preventDefault();
    }
}

function only_alphabets(event) {
    var x = event.which || event.keyCode;
    console.log(x);
    if((x >= 65 ) && (x <= 90 ) || (x >= 97 ) && (x <= 122 ) ||(x==32)) {
        return;
    } else {
        event.preventDefault();
    }
}

function get_state(id) {
    var admin_url = $("#admin_url").val();
    $.ajax({
        type:"post",
        cache:false,
        url:admin_url+"Users/get_states",
        data:{
            id:id
        },
        beforeSend:function(){},
        success:function(returndata) {
            $('#state_id').html(returndata);
        }
    });
}

function getcity(id) {
    var admin_url = $("#admin_url").val();
    $.ajax({
        type:"post",
        cache:false,
        url:admin_url+'Users/get_city',
        data:{id:id},
        beforeSend:function(){},
        success:function(returndata) {
            $('#city_id').html(returndata);
        }
    });
}

function change_password() {
    var base_url = $("#base_url").val();
    var cur_password=$('#password').val();
    if(cur_password=="") {
        $("#err_current").fadeIn().html("Required").css('color','red');
        setTimeout(function(){$("#err_current").html("&nbsp;");},3000);
        $("#password").focus();
        return false;
    }

    var new_password=$('#npassword').val();
    if(new_password=='') {
        $("#err_new").fadeIn().html("Required").css('color','red');;
        setTimeout(function(){$("#err_new").html("&nbsp;");},5000)
        $("#npassword").focus();
        return false;
    } else if(new_password.length<6) {
        $("#err_new").fadeIn().html("please enter at least 6 character").css('color','red');;
        setTimeout(function(){$("#err_new").html("&nbsp;");},5000)
        $("#npassword").focus();
        return false;
    }

    var confirm_password=$('#cpassword').val();
    if(confirm_password=='') {
        $("#err_confirm").fadeIn().html("Required").css('color','red');;
        setTimeout(function(){$("#err_confirm").html("&nbsp;");},5000)
        $("#cpassword").focus();
        return false;
    }

    if(new_password!=confirm_password) {
    $('#matchPass1').html('password does not match').css('color','red');
    setTimeout(function(){$("#matchPass1").html("&nbsp;");},5000)
    return null
    }

    $.ajax({
        url: base_url+'user/user_dashboard/update_password',
        type: 'POST',
        data: {cur_password:cur_password,new_password:new_password,confirm_password:confirm_password},
        success:function(data) {
            if(data==1) {
                location.reload();
            } else {
                $("#err_current").fadeIn().html("password doest not match").css('color','red');
                setTimeout(function(){$("#err_current").html("&nbsp;");},3000);
                $("#password").focus();
                return false;
            }
        }
    });
}

function already_message() {
    swal({
        title: "This job has already applied!",
        type: "warning",
        confirmButtonColor: '#A5DC86',
        confirmButtonText: 'ok',
        closeOnConfirm: false,
    }, function(isConfirm) {
        if (isConfirm) {
            swal.close();
        }
    });
}
               
function subscriber() {
    var base_url=$('#base_url').val();
    var email=$('#subscriber_email').val();
    var pattern_email = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if(email=="") {
        $("#email_err").fadeIn().html("please enter email ").css("color","red");
        setTimeout(function(){$("#email_err").fadeOut("&nbsp;");},2000)
        $("#subscriber_email").focus();
        return false;
    } else if(!pattern_email.test(email)) {
        $("#email_err").fadeIn().html("please enter valid email").css("color","red");
        setTimeout(function(){$("#email_err").html("&nbsp;");},5000)
        $("#subscriber_email").focus();
        return false;
    }

    $.ajax({
        type:"post",
        url:base_url+'user/Login/subcriber',
        cache:false,
        data:{email:email},
        success:function(returndata) {
            if(returndata==1) {
                swal({
                    title: "subscribe successfully!",
                    type: "success",
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'ok',
                    closeOnConfirm: false,
                }, function(isConfirm){
                    if (isConfirm) {
                        swal.close();
                    }
                });
                $("#subscriber_email").val('');
            } else {
                swal({
                    title: "Email already exits!",
                    type: "warning",
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'ok',
                    closeOnConfirm: false,
                }, function(isConfirm){
                    if (isConfirm) {
                        swal.close();
                    }
                });
                return false;
            }
        }
    });
}
