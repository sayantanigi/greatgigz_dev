<?php $settings=$this->Crud_model->get_single('settingss'); ?>
<!DOCTYPE html>
<html>
<head>
	   <title>Email Management</title>
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
		
			<p style="font-size:24px;">
      <?= $body;?>   
      </p>
        <?php if(!empty($attachment)){?>
        <p style="font-size:24px;">
      <i class="fas fa-paperclip"></i><a href="<?= base_url('uploads/email/'.@$attachment)?>"><?= @$attachment?></a>
      </p>
      <?php } ?>
		
    
		</div>
          
	</div>
</body>
</html>
