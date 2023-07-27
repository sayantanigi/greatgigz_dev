function create_service()
{
  var admin_url=$('#admin_url').val();
  var title=$('#title').val();
   var description=$('#description').val();
  
    if(title=="")
    {
        $("#title_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#title_err").fadeOut("&nbsp;");},2000)
    
        $("#title").focus();
        return false;
    } 
     if(description=="")
    {
        $("#description_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#description_err").fadeOut("&nbsp;");},2000)
    
        $("#description").focus();
        return false;
    } 
         var form_data= new FormData();
        form_data.append('title',title);
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
             $('#title').val('');
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

        url:admin_url+'manage_home/our_services/get_value',
        data:{
          id:id,
        },
        success:function(returndata)
        {
         var obj=$.parseJSON(returndata);
         $("#edit_title").val(obj.title);
         // $("#edit_description").val(obj.description);
          $("#id").val(obj.id);
           $("#edit_description").summernote("code", obj.description);
        }
      })
 }

 function update_service()
  {
      var admin_url = $("#admin_url").val();
      var title=$("#edit_title").val().trim();    
      var id=$("#id").val();   
      var description=$('#edit_description').val();
      if(title=="")
      {
          $("#edit_title_err").fadeIn().html("required").css('color','red');
          setTimeout(function(){$("#edit_title_err").html("&nbsp;");},3000);
          $("#edit_title").focus();
          return false;
      }
      if(title=="")
      {
          $("#edit_description_err").fadeIn().html("required").css('color','red');
          setTimeout(function(){$("#edit_description_err").html("&nbsp;");},3000);
          $("#edit_description").focus();
          return false;
      }
       
       var form_data= new FormData();
      
      form_data.append('title',title); 
     form_data.append('description',description);
      
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
         
        }
      })
  }

 