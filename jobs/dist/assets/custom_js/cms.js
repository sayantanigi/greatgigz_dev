function create_cms()
{
	var admin_url=$('#admin_url').val();
	var title=$('#title').val();
	 var description=CKEDITOR.instances['description'].getData();

    if(title=="")
    {
      	$("#title_err").fadeIn().html("Please Enter title").css("color","red");
          setTimeout(function(){$("#title_err").fadeOut("&nbsp;");},2000)
    
        $("#title").focus();
        return false;
    } 
    if(description=="")
      {
          $("#description_err").fadeIn().html("Please enter description").css('color','red');
          setTimeout(function(){$("#description_err").html("&nbsp;");},3000);
          $("#description").focus();
          return false;
      }
         var form_data= new FormData();
      var image=$('#image')[0].files[0];
       form_data.append('image',image);
	      form_data.append('title',title);
	       form_data.append('description',description);
	      	$.ajax({
	        type:"post",
	        url:admin_url+"cms/create_action",
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
	          location.reload();
	         
	        }
	        else{
	         $("#title_err").fadeIn().html("This title already exits ").css("color","red");
          setTimeout(function(){$("#title_err").fadeOut("&nbsp;");},2000)
            $("#title").focus();
                  return false;
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

        url:admin_url+'cms/get_value',
        data:{
          id:id,
        },
        success:function(returndata)
        {
         var obj=$.parseJSON(returndata);
         $("#edit_title").val(obj.title);
          $("#id").val(obj.id);
          $("#old_image").val(obj.image);
          $("#show_img").html(obj.img);
         
        CKEDITOR.instances.edit_description.setData(obj.description);
        }
      })
 }

 function update_cms()
  {
      var admin_url = $("#admin_url").val();
      var title=$("#edit_title").val().trim();    
      var id=$("#id").val(); 
       var old_image=$("#old_image").val();  
      var description=CKEDITOR.instances['edit_description'].getData();
      if(title=="")
      {
          $("#edit_title_err").fadeIn().html("Please enter title").css('color','red');
          setTimeout(function(){$("#edit_title_err").html("&nbsp;");},3000);
          $("#edit_title").focus();
          return false;
      }
       if(description=="")
      {
          $("#edit_description_err").fadeIn().html("Please enter description").css('color','red');
          setTimeout(function(){$("#edit_description_err").html("&nbsp;");},3000);
          $("#edit_description").focus();
          return false;
      }
       var form_data= new FormData();
       var image=$('#edit_image')[0].files[0];
        form_data.append('image',image);
      form_data.append('title',title); 
     form_data.append('description',description);
      form_data.append('id',id);
       form_data.append('old_image',old_image);
      $.ajax({
        type:'post',
        cache:false,
        contentType: false,   
        processData:false,
        url:admin_url+'cms/update_action',
        data:form_data,
        success:function(returndata)
        {
          if(returndata==1)
          {
            location.reload();
          }
          else
          {
             $("#edit_title_err").fadeIn().html("This title already exits").css('color','red');
          setTimeout(function(){$("#edit_title_err").html("&nbsp;");},3000);
          $("#edit_title").focus();
          return false;
          }
        }
      })
  }

  function view_data(id)
 {      
        var admin_url = $("#admin_url").val();
        $.ajax({
        type:'post',
        cache:false,

        url:admin_url+'cms/view',
        data:{
          id:id,
        },
        success:function(returndata)
        {
         var obj=$.parseJSON(returndata);
         $("#show_description").html(obj.description);
        }
      })
 }