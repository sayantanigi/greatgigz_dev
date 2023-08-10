function create_testimonial() {
	var admin_url=$('#admin_url').val();
	var fname=$('#fname').val();
	var designation=$('#designation').val();
	var testimonial_image=$('#testimonial_image')[0].files[0];
	var description=CKEDITOR.instances['description'].getData();
	if(fname=="") {
		$("#fname_err").fadeIn().html("Required").css("color","red");
		setTimeout(function(){$("#fname_err").fadeOut("&nbsp;");},2000)
		$("#fname").focus();
		return false;
	}

	if(designation=="") {
		$("#designation_err").fadeIn().html("Required").css("color","red");
		setTimeout(function(){$("#designation_err").fadeOut("&nbsp;");},2000)
		$("#designation").focus();
		return false;
	}

	if(description=="") {
		$("#description_err").fadeIn().html("Required").css('color','red');
		setTimeout(function(){$("#description_err").html("&nbsp;");},3000);
		$("#description").focus();
		return false;
	}

	var form_data= new FormData();
	form_data.append('fname',fname);
	form_data.append('designation',designation);
	form_data.append('testimonial_image',testimonial_image);
	form_data.append('description',description);
	$.ajax({
		type:"post",
		url:admin_url+"Testimonial/create_action",
		cache:false,
		contentType: false,
		processData:false,
		async:false,
		data:form_data,
		success:function(returndata) {
			if(returndata==1) {
				var title=$('#title').val('');
				var testimonial_image=$('#testimonial_image').val('');
				var description=$('#description').val('');
				location.reload();
			} else {
				$("#title_err").fadeIn().html("This title already exits").css("color","red");
				setTimeout(function(){$("#title_err").fadeOut("&nbsp;");},2000)
				$("#title").focus();
				return false;
			}
		}
	});
}

function getTestimonialValue (id) {
	var admin_url = $("#admin_url").val();
	$.ajax({
		type:'post',
		cache:false,
		url:admin_url+'Testimonial/get_value',
		data:{
			id:id,
		},
		success:function(returndata) {
			var obj=$.parseJSON(returndata);
			//console.log(obj);
			$("#edit_fname").val(obj.fname);
			$("#edit_designation").val(obj.designation);
			$("#id").val(obj.id);
			$("#show_img").html(obj.image);
			$("#old_image").val(obj.old_image);
			CKEDITOR.instances.edit_description.setData(obj.description);
		}
	})
}

function update_testimonial_service() {
	var admin_url = $("#admin_url").val();
	var fname=$("#edit_fname").val().trim();
	var designation=$("#edit_designation").val().trim();
	var testimonial_image=$('#edit_testimonial_image')[0].files[0];
	var old_image=$("#old_image").val();
	var description=CKEDITOR.instances['edit_description'].getData();
	var id=$("#id").val();
	var icon=$("#edit_icon").val();
	if(fname=="") {
		$("#edit_fname_err").fadeIn().html("Required").css('color','red');
		setTimeout(function(){$("#edit_fname_err").html("&nbsp;");},3000);
		$("#edit_fname").focus();
		return false;
	}

	if(designation=="") {
		$("#edit_designation_err").fadeIn().html("Required").css('color','red');
		setTimeout(function(){$("#edit_designation_err").html("&nbsp;");},3000);
		$("#edit_designation").focus();
		return false;
	}

	if(description=="") {
		$("#edit_description_err").fadeIn().html("required").css('color','red');
		setTimeout(function(){$("#edit_description_err").html("&nbsp;");},3000);
		$("#edit_description").focus();
		return false;
	}

	var form_data= new FormData();
	form_data.append('fname',fname);
	form_data.append('designation',designation);
	form_data.append('testimonial_image',testimonial_image);
	form_data.append('old_image',old_image);
	form_data.append('description',description);

	form_data.append('id',id);
	$.ajax({
		type:'post',
		cache:false,
		contentType: false,
		processData:false,
		url:admin_url+'Testimonial/update_action',
		data:form_data,
		success:function(returndata) {
			if(returndata==1) {
				location.reload();
			} else {
				$("#edit_title_err").fadeIn().html("This Name already exits").css('color','red');
				setTimeout(function(){$("#edit_title_err").html("&nbsp;");},3000);
				$("#edit_title").focus();
				return false;
			}
		}
	})
}

function testimonialDelete(obj,cid) {
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
					url:admin_url+'Testimonial/delete',
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
