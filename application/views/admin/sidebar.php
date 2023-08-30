<?php
	$get_setting=$this->Crud_model->get_single('setting');
	$seg2 =$this->uri->segment(2);
?>
<style>
	.cstm_subdrop {background-color: #2fbd8f !important; color: #fff !important;}
</style>
<div class="sidebar" id="sidebar">
	<div class="sidebar-logo">
		<a href="<?php echo base_url('admin/dashboard');?>">
			<img src="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" class="img-fluid" alt="">
		</a>
	</div>
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>
				<li <?php if ($seg2 =='dashboard') {?>class="active"<?php }?>>
					<a href="<?= base_url('admin/dashboard')?>"><i class="fas fa-columns"></i> <span>Dashboard</span></a>
				</li>
				<li <?php if ($seg2 =='category') {?>class="active"<?php }?>>
					<a href="<?= base_url('admin/category')?>"><i class="fas fa-layer-group"></i> <span>Categories</span></a>
				</li>
				<li <?php if ($seg2 =='sub_category') {?>class="active"<?php }?>>
					<a href="<?= base_url('admin/sub_category')?>"><i class="fab fa-buffer"></i> <span>Subcategories</span></a>
				</li>
				<li <?php if ($seg2 =='specialist') {?>class="active"<?php }?>>
					<a href="<?= base_url('admin/specialist')?>"><i class="fa fa-puzzle-piece"></i> <span>List of Skills</span></a>
				</li>
				<li <?php if ($seg2 =='banner') {?>class="active"<?php }?>>
					<a href="<?= base_url('admin/banner')?>"><i class="fas fa-image"></i> <span>Sliders and Banners</span></a>
				</li>
				<li class="treeview <?=($seg2=='manage_cms' || $seg2=='about-us' || $seg2=='faq' || $seg2=='testimonial')?'active1':'' ;?>">
					<a href="javascript:void(0)" class="<?=($seg2=='manage_cms' || $seg2=='about-us' || $seg2=='faq' || $seg2=='testimonial')?'cstm_subdrop':'' ;?>">
						<i class="fa fa-users"></i>
						<span>CMS</span>
						<span class="pull-right-container">
							<span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="<?=($seg2=='manage_cms')?'active':'' ;?>"><a href="<?=admin_url('manage_cms')?>"><i class="fa fa-circle" style="margin-right: 15px;"></i>Content Management</a></li>
						<li class="<?=($seg2=='about-us' || $seg2=='about-us')?'active':'' ;?>"><a href="<?=admin_url('about-us')?>"><i class="fa fa-circle" style="margin-right: 15px;"></i>Job Portal About Us</a></li>
						<li class="<?=($seg2=='faq' || $seg2=='faq')?'active':'' ;?>"><a href="<?=admin_url('faq')?>"><i class="fa fa-circle" style="margin-right: 15px;"></i>Job Portal FAQ</a></li>
						<li class="<?=($seg2=='testimonial' || $seg2=='testimonial')?'active':'' ;?>"><a href="<?=admin_url('testimonial')?>"><i class="fa fa-circle" style="margin-right: 15px;"></i>Job Portal Testimonial</a></li>
					</ul>
				</li>
				<li class="treeview <?=($seg2=='srch_msg' || $seg2=='members' || $seg2=='add_srchmsg')?'active':'' ;?>">
					<a href="#">
						<i class="fa fa-users"></i>
						<span>Job Posts Management</span>
						<span class="pull-right-container">
							<span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="<?=($seg2=='members')?'active':'' ;?>"><a href="<?=admin_url('members')?>"><i class="fa fa-circle" style="margin-right: 15px;"></i>From Job Portal</a></li>
						<li class="<?=($seg2=='srch_msg' || $seg2=='add_srchmsg')?'active':'' ;?>"><a href="<?=admin_url('searchmsg')?>"><i class="fa fa-circle" style="margin-right: 15px;"></i>From Project Portal</a></li>
					</ul>
				</li>
				<li <?php if ($seg2 =='chat') {?>class="active"<?php }?>>
					<a href="<?=base_url('admin/chat'); ?>"><i class="fab fa-rocketchat"></i> <span>Messages</span></a>
				</li>
				<li <?php if ($seg2 =='jobsbidding') {?>class="active"<?php }?>>
					<a href="<?= base_url('admin/jobsbidding')?>"><i class="far fa-calendar-check"></i> <span>Jobs Bidding</span></a>
				</li>
				<li <?php if ($seg2 =='payment') {?>class="active"<?php }?>>
					<a href="<?= base_url('admin/payment')?>"><i class="fas fa-hashtag"></i><span>List of Subscriptions</span></a>
				</li>
				<li <?php if ($seg2 =='subscription') {?>class="active"<?php }?>>
					<a href="<?= base_url('admin/subscription')?>"><i class="far fa-calendar-alt"></i><span>Subscription Plans</span></a>
				</li>
				<li <?php if ($seg2 =='users') {?>class="active"<?php }?>>
					<a href="<?=base_url('admin/'); ?>users"><i class="fas fa-user"></i> <span>Users</span></a>
				</li>
				<li <?php if ($seg2 =='company-logo') {?>class="active"<?php }?>>
					<a href="<?=base_url('admin/'); ?>company-logo"><i class="fas fa-image"></i> <span>Partner Companies</span></a>
				</li>
				<li <?php if ($seg2 =='career') {?>class="active"<?php }?>>
					<a href="<?=base_url('admin/'); ?>career"><i class="fa fa-graduation-cap"></i> <span>Career Tips</span></a>
				</li>
				<li <?php if ($seg2 =='setting') {?>class="active"<?php }?>>
					<a href="<?= base_url('admin/setting')?>"><i class="fas fa-cog"></i> <span>Site Settings</span></a>
				</li>
				<li class="treeview <?=($seg2=='srch_msg' || $seg2=='members' || $seg2=='add_srchmsg')?'active':'' ;?>">
					<a href="#">
						<i class="fa fa-users"></i>
						<span>Providers Management</span>
						<span class="pull-right-container">
							<span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="<?=($seg2=='members')?'active':'' ;?>"><a href="<?=admin_url('members')?>"><i class="fa fa-circle" style="margin-right: 15px;"></i> Provider Lists</a></li>
						<li class="<?=($seg2=='srch_msg' || $seg2=='add_srchmsg')?'active':'' ;?>"><a href="<?=admin_url('searchmsg')?>"><i class="fa fa-circle" style="margin-right: 15px;"></i>Set Message & Time</a></li>
					</ul>
				</li>
				<li class="treeview <?=($seg2=='add_service' || $seg2=='service'|| $seg2=='add_sub_service'|| $seg2=='sub_service')?'active':'' ;?>">
					<a href="#">
						<i class="fa fa-list"></i>
						<span>Service Management</span> 
						<span class="pull-right-container">
							<span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="<?=($seg2=='featured_services')?'active':'' ;?>"><a href="<?= base_url('admin/featured_services')?>"><i class="fa fa-circle" style="margin-right: 15px;"></i>Featured Services</a></li>
						<li class="<?=($seg2=='our-services')?'active':'' ;?>"><a href="<?=base_url('admin/our-services'); ?>"><i class="fa fa-circle" style="margin-right: 15px;"></i>Our Services</a></li>
					</ul>
				</li>
				<li class="<?=($seg2=='enquiry')?'active':'' ;?> ">
					<a href="<?=admin_url('contacts')?>">
						<i class="fa fa-question-circle"></i> <span>Enquiry Management</span>
					</a>
				</li>
				<!-- <li <?php if ($seg2 =='featured_services') {?>class="active"<?php }?>>
					<a href="<?= base_url('admin/featured_services')?>"><i class="fa fa-puzzle-piece"></i> <span>Featured Services</span></a>
				</li>
				<li <?php if ($seg2 =='manage_cms') {?>class="active"<?php }?>>
					<a href="<?= base_url('admin/manage_cms')?>"><i class="fas fa-circle"></i> <span>Content Management</span></a>
				</li>
				<li <?php if ($seg2 =='post_job') {?>class="active"<?php }?>>
					<a href="<?=base_url('admin/post_job'); ?>"><i class="fas fa-star"></i> <span>Job Posts</span></a>
				</li>
				<li <?php if ($seg2 =='our-services') {?>class="active"<?php }?>>
					<a href="<?=base_url('admin/'); ?>our-services"><i class="fas fa-bullhorn"></i> <span>Our Services</span></a>
				</li>
				<li <?php if ($seg2 =='about-us') {?>class="active"<?php }?>>
					<a href="<?=base_url('admin/'); ?>about-us"><i class="fa fa-question-circle"></i> <span>About Us</span></a>
				</li>
				<li <?php if ($seg2 =='faq') {?>class="active"<?php }?>>
					<a href="<?=base_url('admin/'); ?>faq"><i class="fa fa-question-circle"></i> <span>FAQ</span></a>
				</li>
				<li <?php if ($seg2 =='testimonial') {?>class="active"<?php }?>>
					<a href="<?=base_url('admin/'); ?>testimonial"><i class="fa fa-comments"></i> <span>Testimonial</span></a>
				</li>
				<li class="<?=($seg2=='contacts')?'active':'' ;?> ">
					<a href="<?=admin_url('contacts/number_list')?>">
						<i class="fa fa-question-circle"></i> <span>Authenticated Number</span>
					</a>
				</li>
				<li class="<?=($seg2=='option')?'active':'' ;?>">
					<a href="<?=admin_url('option')?>"><i class="fa fa-bolt"></i> How It Works</a>
				</li> -->
			</ul>
		</div>
	</div>
</div>
