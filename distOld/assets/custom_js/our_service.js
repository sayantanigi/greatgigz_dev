function create_service()
{
	var admin_url=$('#admin_url').val();
	var category_id=$('#category_id').val();
  var icon=$('#icon').val();
  var description=$('#description').val();
 
    if(category_id=="")
    {
      	$("#category_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#category_err").fadeOut("&nbsp;");},2000)
    
        $("#category_id").focus();
        return false;
    } 
   
    if(description=="")
      {
          $("#description_err").fadeIn().html("Required").css('color','red');
          setTimeout(function(){$("#description_err").html("&nbsp;");},3000);
          $("#description").focus();
          return false;
      }
         var form_data= new FormData();
    
        form_data.append('category_id',category_id);
        form_data.append('icon',icon);
	       form_data.append('description',description);
	      	$.ajax({
	        type:"post",
	        url:admin_url+"manage_home/our_services/create_action",
	        cache:false,
	        contentType: false,   
	        processData:false,
	        async:false,
	        data:form_data,
	        success:function(returndata)
	        {

	        if(returndata==1)
	        {
              var category_id=$('#category_id').val('');
         var icon=$('#icon').val('');
         var description=$('#description').val('');
	          location.reload();
	         
	        }
	         else{

	           $("#category_err").fadeIn().html("This category already exits").css("color","red");
          setTimeout(function(){$("#category_err").fadeOut("&nbsp;");},2000)
    
        $("#category_id").focus();
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

        url:admin_url+'manage_home/our_services/get_value',
        data:{
          id:id,
        },
        success:function(returndata)
        {
         var obj=$.parseJSON(returndata);
         $("#edit_category_id").val(obj.category_id);
          $("#id").val(obj.id);
          $("#edit_icon").val(obj.icon);
            $("#edit_description").val(obj.description);
         
        }
      })
 }

 function update_service()
  {
      var admin_url = $("#admin_url").val();
      var category_id=$("#edit_category_id").val().trim();    
      var description=$("#edit_description").val().trim();    
      var id=$("#id").val();  
       var icon=$("#edit_icon").val(); 
      
      if(category_id=="")
      {
          $("#edit_category_err").fadeIn().html("Required").css('color','red');
          setTimeout(function(){$("#edit_category_err").html("&nbsp;");},3000);
          $("#edit_category_id").focus();
          return false;
      }
       if(description=="")
      {
          $("#edit_description_err").fadeIn().html("required").css('color','red');
          setTimeout(function(){$("#edit_description_err").html("&nbsp;");},3000);
          $("#edit_description").focus();
          return false;
      }
       var form_data= new FormData();
      
       
      form_data.append('category_id',category_id); 
     form_data.append('description',description);
      form_data.append('icon',icon);
      form_data.append('id',id);
      $.ajax({
        type:'post',
        cache:false,
        contentType: false,   
        processData:false,
        url:admin_url+'manage_home/our_services/update_action',
        data:form_data,
        success:function(returndata)
        {
          if(returndata==1)
          {
            location.reload();
          }
          else{
             $("#edit_category_err").fadeIn().html("This category already exits").css('color','red');
          setTimeout(function(){$("#edit_category_err").html("&nbsp;");},3000);
          $("#edit_category_id").focus();
          return false;
          }
         
        }
      })
  }

 