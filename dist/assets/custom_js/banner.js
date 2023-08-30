function create_banner() {
	var admin_url=$('#admin_url').val();
	var posted_for=$('#posted_for').val();
	var page_name=$('#page_name').val();
	var image=$('#image').val();
	if(image=="") {
		$("#image_err").fadeIn().html("Required").css("color","red");
		setTimeout(function(){$("#image_err").fadeOut("&nbsp;");},2000);
		$("#image").focus();
		return false;
    }
	if(posted_for=="") {
		$("#posted_for_err").fadeIn().html("Required").css("color","red");
		setTimeout(function(){$("#posted_for_err").fadeOut("&nbsp;");},2000);
		$("#posted_for").focus();
		return false;
    }
	var form_data= new FormData();
	var image=$('#image')[0].files[0];
	form_data.append('image',image);
	form_data.append('page_name',page_name);
	form_data.append('posted_for',posted_for);
  	$.ajax({
        type:"post",
        url:admin_url+"manage_home/Banner/create_action",
        cache:false,
        contentType: false,
        processData:false,
        async:false,
        data:form_data,
        success:function(returndata) {
        	if(returndata==1) {
				location.reload();
				$('#page_name').val('');
				$('#posted_for').val('');
				$('#image').val('');
			}
        }
    });
}

function getValue(id) {
	var admin_url = $("#admin_url").val();
    $.ajax({
        type:'post',
        cache:false,
        url:admin_url+'manage_home/Banner/get_value',
        data:{
        	id:id,
        },
        success:function(returndata) {
	        var obj=$.parseJSON(returndata);
	        //$("#edit_name").val(obj.heading);
	        $("#edit_page_name").val(obj.page_name);
	        $("#id").val(obj.id);
	        $("#show_img").html(obj.image);
	        $("#old_image").val(obj.old_image);
			$("#edit_posted_for").val(obj.posted_for);
        }
  	});
}

function update_banner() {
	var admin_url=$('#admin_url').val();
	var posted_for=$('#edit_posted_for').val();
	var page_name=$('#edit_page_name').val();
	var old_image=$("#old_image").val();
	var id=$("#id").val();

	var form_data= new FormData();
	var image=$('#edit_image')[0].files[0];
	form_data.append('image',image);
	form_data.append('page_name',page_name);
	form_data.append('old_image',old_image);
	form_data.append('id',id);
	form_data.append('posted_for',posted_for);
  	$.ajax({
		type:"post",
		url:admin_url+"manage_home/Banner/update_action",
		cache:false,
		contentType: false,
		processData:false,
		async:false,
		data:form_data,
		success:function(returndata) {
			if(returndata==1) {
				location.reload();
				$('#edit_page_name').val('');
				$('#edit_image').val('');
				$('#edit_posted_for').val('');
			}
		}
	});
}

function sliderDelete(obj,cid) {
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
					url:admin_url+'manage_home/Banner/delete',
					data:datastring,
					cache:false,
					success:function(returndata) {
						if(returndata = 1){
							location.reload();
							table.draw();
						}
					}
				});
	        },
	        cancel: function () {
	            location.reload();
	        },
	    }
	});
}
