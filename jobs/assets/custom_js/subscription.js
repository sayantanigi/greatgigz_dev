function cancel_subscription(id)
{
	var base_url=$('#base_url').val();
	swal({   
            title: "Are you sure want to cancel subscription plan!",   
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#A5DC86',
            cancelButtonColor: '#0bc2f3',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No', 
            closeOnConfirm: false,   
            closeOnCancel: true 
        }, function(isConfirm){
            if (isConfirm) {
              $.ajax({
          type:"post",
          url:base_url+"user/user_dashboard/cancel_subscription",
          cache:false,

          data:{id:id},
          success:function(returndata)
          {
          	 if(returndata==1)
          {

            swal({
                   title: "Cancel subscription plan successfully!",
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
        });
}

 function renew_subscription(subscription_id)
{
	var base_url=$('#base_url').val();
	swal({   
            title: "Are you sure want to renew subscription plan!",   
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#A5DC86',
            cancelButtonColor: '#0bc2f3',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No', 
            closeOnConfirm: false,   
            closeOnCancel: true 
        }, function(isConfirm){
            if (isConfirm) {
            $.ajax({
          type:"post",
          url:base_url+"user/user_dashboard/renew_subscription",
          cache:false,

          data:{subscription_id:subscription_id},
          success:function(returndata)
          {
          	 if(returndata==1)
          {

            swal({
                   title: "Renew subscription plan successfully!",
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
        });
}