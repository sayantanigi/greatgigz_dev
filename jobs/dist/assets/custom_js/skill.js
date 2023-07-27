function create_skill()
{
	var admin_url=$('#admin_url').val();
	var skill=$('#skill').val();
	
    if(skill=="")
    {
      	$("#skill_err").fadeIn().html("please enter skill ").css("color","red");
          setTimeout(function(){$("#skill_err").fadeOut("&nbsp;");},2000)

        $("#skill").focus();
        return false;
    }
    
         var form_data= new FormData();
	      form_data.append('skill',skill);
	     
	      	$.ajax({
	        type:"post",
	        url:admin_url+"Skill/create_action",
	        cache:false,
	        contentType: false,
	        processData:false,
	        async:false,
	        data:form_data,
	        success:function(returndata)
	        {

	        if(returndata==1)
	        {

	         $('#skill').val('');
	          location.reload();

	        }
	        else{
				$("#skill_err").fadeIn().html("This skill already exits !").css("color","red");
		          setTimeout(function(){$("#skill_err").fadeOut("&nbsp;");},2000)
					
		        $("#skill").focus();
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

	        url:admin_url+'skill/get_value',
	        data:{
	          id:id,
	        },
	        success:function(returndata)
	        {

		        var obj=$.parseJSON(returndata);

		        $("#edit_skill").val(obj.skill);
		        $("#id").val(obj.id);
		       
	        }
      });

}

function update_skill()
{

	var admin_url=$('#admin_url').val();
	var skill=$('#edit_skill').val();
   var id=$("#id").val();
    if(skill=="")
    {
      	$("#edit_skill_err").fadeIn().html("please enter skill").css("color","red");
          setTimeout(function(){$("#edit_skill_err").fadeOut("&nbsp;");},2000)

        $("#edit_skill").focus();
        return false;
    }
     
         var form_data= new FormData();
    	
	      form_data.append('skill',skill);
	     
	      	form_data.append('id',id);
	      	$.ajax({
	        type:"post",
	        url:admin_url+"skill/update_action",
	        cache:false,
	        contentType: false,
	        processData:false,
	        async:false,
	        data:form_data,
	        success:function(returndata)
	        {

	        if(returndata==1)
	        {

	          location.reload();

	        }
	        else{
	         $("#edit_skill_err").fadeIn().html("This skill already exits ").css("color","red");
          setTimeout(function(){$("#edit_skill_err").fadeOut("&nbsp;");},2000)
            $("#edit_skill").focus();
                  return false;
	        }


	        }
	    });

}
