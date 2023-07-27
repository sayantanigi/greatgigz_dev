function create_service()
{
	var admin_url=$('#admin_url').val();
	var title=$('#title').val();
  var image=$('#image').val();
	 var description=$('#description').val();

    if(title=="")
    {
      	$("#title_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#title_err").fadeOut("&nbsp;");},2000)

        $("#title").focus();
        return false;
    }
    if(image=="")
    {
        $("#image_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#image_err").fadeOut("&nbsp;");},2000)

        $("#image").focus();
        return false;
    }

         var form_data= new FormData();
      var image=$('#image')[0].files[0];
	      form_data.append('image',image);
        form_data.append('title',title);
	       form_data.append('description',description);
	      	$.ajax({
	        type:"post",
	        url:admin_url+"manage_home/services/create_action",
	        cache:false,
	        contentType: false,
	        processData:false,
	        async:false,
	        data:form_data,
	        success:function(returndata)
	        {

	        if(returndata==1)
	        {
             $('#title').val('');
           $('#image').val('');
            $('#description').val('');
	          location.reload();

	        }


	        }
	    });

}

function getValue(id)
 {
        var admin_url = $("#admin_url").val();
        $.ajax({
        type:'post',
        cache:false,

        url:admin_url+'manage_home/services/get_value',
        data:{
          id:id,
        },
        success:function(returndata)
        {
         var obj=$.parseJSON(returndata);
         $("#edit_title").val(obj.title);
        $("#edit_description").summernote("code", obj.description);
          $("#id").val(obj.id);
          $("#show_img").html(obj.image);
            $("#old_image").val(obj.old_image);

        }
      })
 }

 function update_service()
  {
      var admin_url = $("#admin_url").val();
      var title=$("#edit_title").val().trim();
      var id=$("#id").val();
       var old_image=$("#old_image").val();
      var description=$('#edit_description').val();
      if(title=="")
      {
          $("#edit_title_err").fadeIn().html("required").css('color','red');
          setTimeout(function(){$("#edit_title_err").html("&nbsp;");},3000);
          $("#edit_title").focus();
          return false;
      }

       var form_data= new FormData();
       var image=$('#edit_image')[0].files[0];
        form_data.append('image',image);
      form_data.append('title',title);
     form_data.append('description',description);
      form_data.append('old_image',old_image);
      form_data.append('id',id);
      $.ajax({
        type:'post',
        cache:false,
        contentType: false,
        processData:false,
        url:admin_url+'manage_home/services/update_action',
        data:form_data,
        success:function(returndata)
        {
          if(returndata==1)
          {
            location.reload();
          }

        }
      })
  }
