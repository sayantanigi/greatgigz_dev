 function recipient_list(id)
  {
    var admin_url=$('#admin_url').val();
    $('#createModal').modal('show');
     $.ajax({
        type:"POST",
        url:admin_url+'mailer/list_recipients',
        data:{id:id},
        cache:false,
        success:function(returndata)
        {
          
          $('#recipient_list').html(returndata);
        }
      });
  }

   function Delete(obj,cid)
{
  var admin_url=$('#admin_url').val();
  var ask = confirm("Do you want to delete this record?");
  if(ask==true)
  {
    $(".id"+cid).fadeOut();
    var datastring="cid="+cid;
    $.ajax({
        type:"POST",
        url:admin_url+"mailer/sendmail_delete",
        data:datastring,
        cache:false,
        success:function(returndata)
        {
          table.draw();
        }
      });
  }
}