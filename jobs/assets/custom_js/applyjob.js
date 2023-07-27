function apply_now()
  	{
  		 var base_url=$('#base_url').val();
  		 var old_resume=$('#old_resume').val();
  		 var job_id=$('#job_id').val();
  		//   if(old_resume=="")
    // {
    //   	$("#err_resume").fadeIn().html("Required").css("color","red");
    //       setTimeout(function(){$("#err_resume").fadeOut("&nbsp;");},2000)
    
    //     $("#old_resume").focus();
    //     return false;
    // } 
     var form_data= new FormData();
    	var resume=$('#resume')[0].files[0];
	      form_data.append('resume',resume); 
	      form_data.append('old_resume',old_resume); 
        form_data.append('job_id',job_id); 
	      $.ajax({
	        type:"post",
	        url:base_url+"welcome/apply_job",
	        cache:false,
	        contentType: false,   
	        processData:false,
	        async:false,
	        data:form_data,
	        success:function(returndata)
	        {

	        if(returndata==1)
          {
            $('#resume').val('');
            $('#job_id').val('');
             $('#applyModal').modal('hide'); 
            swal({
                   title: "Apply job successfully!",
                   type: "success",
                   confirmButtonColor: '#A5DC86',
                   confirmButtonText: 'ok',
                   closeOnConfirm: false,
               }, function(isConfirm){
                   if (isConfirm) {
                       swal.close();

                   }
               });
          
          }
	          
	        }
	    });
  		
  	}