function create_specialist() {
    var admin_url=$('#admin_url').val();
    var specialist_name=$('#specialist_name').val();
	var posted_for = $('#posted_for').val();
	if(specialist_name=="") {
		$("#specialist_err").fadeIn().html("Please Enter Specialist Name").css("color","red");
		setTimeout(function(){$("#specialist_err").fadeOut("&nbsp;");},2000);
		$("#specialist_name").focus();
		return false;
    }

	if(posted_for=="") {
		$("#posted_for_err").fadeIn().html("Please Select Portal").css("color","red");
		setTimeout(function(){$("#posted_for_err").fadeOut("&nbsp;");},2000);
		$("#posted_for").focus();
		return false;
    }

	var form_data= new FormData();
	var specialist_image=$('#specialist_image')[0].files[0];
	form_data.append('specialist_image',specialist_image);
	form_data.append('specialist_name',specialist_name);
	form_data.append('posted_for',posted_for);
	$.ajax({
		type:"post",
		url:admin_url+"Specialist/create_action",
		cache:false,
		contentType: false,
		processData:false,
		async:false,
		data:form_data,
		success:function(returndata) {
			if(returndata==1) {
				location.reload();
			} else {
				$("#specialist_err").fadeIn().html("This specialist already exits ").css("color","red");
				setTimeout(function(){$("#specialist_err").fadeOut("&nbsp;");},2000)
				$("#specialist_name").focus();
				return false;
			}
		}
	});
}

function getValue(id) {
 	var admin_url = $("#admin_url").val();
	$.ajax({
        type:'post',
        cache:false,
		url:admin_url+'Specialist/get_value',
        data:{
			id:id,
        },
        success:function(returndata) {
			var obj=$.parseJSON(returndata);
			$("#edit_specialist_name").val(obj.specialist_name);
            $("#id").val(obj.id);
            $("#show_img").html(obj.image);
            $("#old_image").val(obj.old_image);
			$("#posted_for").val(obj.posted_for);
        }
  	});
}

function update_specialist() {
	var admin_url=$('#admin_url').val();
	var specialist_name=$('#edit_specialist_name').val();
	var posted_for = $('#edit_posted_for').val();
	var old_image=$("#old_image").val();
	var id=$("#id").val();

    if(specialist_name=="") {
		$("#edit_specialist_err").fadeIn().html("Please Enter Specialist Name").css("color","red");
		setTimeout(function(){$("#edit_specialist_err").fadeOut("&nbsp;");},2000);
		$("#edit_specialist_name").focus();
		return false;
    }

	if(posted_for == "") {
		$("#edit_posted_for_err").fadeIn().html("Please Select Portal").css("color","red");
		setTimeout(function(){$("#edit_posted_for_err").fadeOut("&nbsp;");},2000);
		$("#edit_posted_for").focus();
		return false;
    }

	var form_data= new FormData();
	var specialist_image=$('#edit_specialist_image')[0].files[0];
	form_data.append('specialist_image',specialist_image);
	form_data.append('specialist_name',specialist_name);
	form_data.append('posted_for',posted_for);
	form_data.append('old_image',old_image);
	form_data.append('id',id);
	$.ajax({
		type:"post",
		url:admin_url+"Specialist/update_action",
		cache:false,
		contentType: false,
		processData:false,
		async:false,
		data:form_data,
		success:function(returndata) {
			if(returndata==1) {
				location.reload();
			} else {
				$("#edit_specialist_err").fadeIn().html("This specialist already exits ").css("color","red");
				setTimeout(function(){$("#edit_specialist_err").fadeOut("&nbsp;");},2000)
				$("#edit_specialist_name").focus();
	  			return false;
			}
		}
	});
}

function specialDelete(obj,cid) {
	var admin_url=$('#admin_url').val();
    $.confirm({
	    title: 'Confirm!',
	    content: confirmTextDelete,
	    buttons: {
	        confirm: function () {
                $(".id"+cid).fadeOut();
        		var datastring="cid="+cid;
        		$.ajax({
        			type:"POST",
        			url:admin_url+'Specialist/delete',
        			data:datastring,
        			cache:false,
        			success:function(returndata) {
                        location.reload();
        				table.draw();
        			}
        		});
	        },
	        cancel: function () {
	            location.reload();
	        },
	    }
	});
}
