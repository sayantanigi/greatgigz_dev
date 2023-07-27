<?php $settings=$this->Crud_model->get_single('settingss');?>
<!DOCTYPE html>
<html>
<head>
	   <title>Sign-up</title>
	   <meta charset="utf-8">
	  <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
      
</head>
<body>
	<div style="width:600px;margin: 0 auto;background: #fff;font-family: 'Poppins', sans-serif; border: 1px solid #e6e6e6;">
		<div style="padding: 30px 30px 15px 30px;box-sizing: border-box;">
			<?php if(!empty($settings->logo) && file_exists('uploads/logo/'.@$settings->logo)){?>
			<img src="<?= base_url('uploads/logo/'.@$settings->logo)?>" style="width:100px;float: right;margin-top: 0 auto;">
			<?php } ?>
			<h3 style="padding-top:40px; line-height: 30px;">Welcome to <span style="font-weight: 900;font-size: 35px;color: #F44C0D; display: block;">Phillyhire.com</span></h3>
			<p>Hello <?= @$fullname ?></p>
			<!--<p>Thank you for registering on <span style="font-size:20px;"><b>< ?= ucwords(@$job_title)?></b></span></p>-->
			<p>You have successfully registered an account with Phillyhire.com</p>
			<p style="text-align: center;">
			<a href="<?= base_url('login')?>" style="height: 50px;
					    width: 300px;
					    background: rgb(253,179,2);
						background: linear-gradient(0deg, rgba(253,179,2,1) 0%, rgba(244,77,9,1) 100%);
					    text-align: center;
					    font-size: 18px;
					    color: #fff;
					    border-radius: 12px;
					    display: inline-block;
					    line-height: 50px;
					    text-decoration: none;
					    text-transform: uppercase;
					    font-weight: 600;">CLICK HERE TO LOGIN</a></p>

    <p>E-mail : <span><b><?= @$email ?> </b><a href="javascript:void(0)"></a></span></p>
    	<p>Password : <span><b><?= @$password ?></b><a href="javascript:void(0)"></a></span></p>
    	<p style="font-size:20px;">Thank you!</p>
    	<li style="font-size:20px;list-style: none;">sincerly</li>
    	<li style="list-style: none;"><b>Team phillyhire</b></li>

    	<ul style="list-style: none;padding: 0;box-sizing: border-box; margin: 4px 0;"> 


    	 <li style="vertical-align: top;display: inline-block;"><b style="font-size:10px;margin-bottom: 10px;">Let's Explore Together !</b></li> 
    			<li style="display: inline-block;"><a href="<?= @$settings->facebook ?>"><img src="<?php echo base_url('assets/images/facebook2x.png')?>" height="35px"></a></li>
    				<li style="display: inline-block;"><a href="<?= @$settings->linkedin ?>"><img src="<?php echo base_url('assets/images/linkedin2x.png')?>" style="height:35px;"></a></li>
    				<li style="display: inline-block;"><a href="<?= @$settings->twitter ?>"><img src="<?php echo base_url('assets/images/twitter2x.png')?>" style="height:35px;"></a></li>
    </ul>
    	<!--<li style="list-style:none;"><b>visit us:</b> <span><?= @$settings->address?></span></li>-->
     <?php $phone=preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($settings->phone)), 2);?>
    	<li style="list-style:none;"><b>call us:</b> <span><?=@$phone?></span></li>
    	<li style="list-style:none"><b>Email us:</b> <span><?= @$settings->email ?></span></li>
    	<p>click here to <a href="javascript:void(0)">UNSUBSCRIBE </a> from our mailling list</p>
    	
		</div>
           <footer style="height:25px;width:100%;background: #F44C0D;"><span style="padding-left: 10px;"> copyright &copy; <?= date('Y')?> phillyhire-All right reserverd</span></footer>
	</div>
</body>
</html>