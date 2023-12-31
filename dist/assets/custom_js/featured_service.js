function create_service() {
	var admin_url=$('#admin_url').val();
	var title=$('#title').val();
	var service_image=$('#fservice_image')[0].files[0];
	var description=CKEDITOR.instances['description'].getData();
	if(title=="") {
		$("#title_err").fadeIn().html("Required").css("color","red");
		setTimeout(function(){$("#title_err").fadeOut("&nbsp;");},2000)
		$("#title").focus();
		return false;
	}

	if(description=="") {
		$("#description_err").fadeIn().html("Required").css('color','red');
		setTimeout(function(){$("#description_err").html("&nbsp;");},3000);
		$("#description").focus();
		return false;
	}

	var form_data= new FormData();
	form_data.append('title',title);
	form_data.append('service_image',service_image);
	form_data.append('description',description);
	$.ajax({
		type:"post",
		url:admin_url+"featured_services/create_action",
		cache:false,
		contentType: false,
		processData:false,
		async:false,
		data:form_data,
		success:function(returndata) {
			if(returndata==1) {
				var title=$('#title').val('');
				var service_image=$('#service_image').val('');
				var description=$('#description').val('');
				location.reload();
			} else {
				$("#title_err").fadeIn().html("This category already exits").css("color","red");
				setTimeout(function(){$("#title_err").fadeOut("&nbsp;");},2000)
				$("#title").focus();
				return false;
			}
		}
	});
}

function getfeaturedValue(id) {
	var admin_url = $("#admin_url").val();
	$.ajax({
		type:'post',
		cache:false,
		url:admin_url+'featured_services/get_value',
		data:{
			id:id,
		},
		success:function(returndata) {
			var obj=$.parseJSON(returndata);
			//console.log(obj);
			$("#edit_title").val(obj.title);
			$("#id").val(obj.id);
			$("#show_img").html(obj.image);
			$("#old_image").val(obj.old_image);
			CKEDITOR.instances.edit_description.setData(obj.description);
		}
	})
}

function update_featured_service() {
	var admin_url = $("#admin_url").val();
	var title=$("#edit_title").val().trim();
	var featuredservice_image=$('#edit_featuredservice_image')[0].files[0];
	var old_image=$("#old_image").val();
	var description=CKEDITOR.instances['edit_description'].getData();
	var id=$("#id").val();
	var icon=$("#edit_icon").val();
	if(title=="") {
		$("#edit_title_err").fadeIn().html("Required").css('color','red');
		setTimeout(function(){$("#edit_title_err").html("&nbsp;");},3000);
		$("#edit_title").focus();
		return false;
	}

	if(description=="") {
		$("#edit_description_err").fadeIn().html("required").css('color','red');
		setTimeout(function(){$("#edit_description_err").html("&nbsp;");},3000);
		$("#edit_description").focus();
		return false;
	}

	var form_data= new FormData();
	form_data.append('title',title);
	form_data.append('featuredservice_image',featuredservice_image);
	form_data.append('old_image',old_image);
	form_data.append('description',description);

	form_data.append('id',id);
	$.ajax({
		type:'post',
		cache:false,
		contentType: false,
		processData:false,
		url:admin_url+'Featured_services/update_action',
		data:form_data,
		success:function(returndata) {
			if(returndata==1) {
				location.reload();
			} else {
				$("#edit_title_err").fadeIn().html("This title already exits").css('color','red');
				setTimeout(function(){$("#edit_title_err").html("&nbsp;");},3000);
				$("#edit_title").focus();
				return false;
			}
		}
	})
}

function ourfeaturedServicesDelete(obj,cid) {
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
					url:admin_url+'featured_services/delete',
					data:datastring,
					cache:false,
					success:function(returndata) {
						if(returndata = 1) {
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
