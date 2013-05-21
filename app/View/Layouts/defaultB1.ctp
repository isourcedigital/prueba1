<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php echo $this->Facebook->html(); ?>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		
		<?php echo $title_for_layout; ?>
	</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('cake.generic');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');	
		//echo $this->Html->css(array('/js/shadowbox-3.0.3/shadowbox'));	
		echo $this->Html->script(array('/js/FeedEk/js/FeedEk.js',));
		
		
		//'/js/rss/jquery.zrssfeed.js',
		
	?>
	
</head>
<body>
<div id="menu">
<?php echo $this->Html->link(__('Blog'), array('controller' => 'blogs', 'action' => 'index','p' => false)); ?> |
<?php 
$usr=$fc->getUser();
?>
<?php if(!empty($authUser)){?>
<?php echo $this->Html->link(__('Add Blog'), array('controller' => 'blogs', 'action' => 'add','p' => true)); ?> |
<?php echo $this->Html->link(__('Preferences'), array('controller' => 'users', 'action' => 'preference','p' => true)); ?> |
<?php 
if(!empty($usr)){
?>
<a href="<?php echo $fc->getLogoutUrl(array('next' => FULL_BASE_URL.$this->webroot.'users/logout'));?>">Logout</a>
<?php }else{?>
<?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout','p' => false)); ?>
<?php }// end else de verificacion si es usr de facebook?>
<?php }else{?>
<?php echo $this->Html->link(__('Register'), array('controller' => 'users', 'action' => 'register' ,'p' => false)); ?> |
<?php echo $this->Html->link(__('Login'), array('controller' => 'users', 'action' => 'login','p' => false)); ?> |
<?php echo '<a href="'.$fc->getLoginUrl(array('perms' => 'email,publish_stream')).'">Login with Facebook</a>';?>
<?php }?>

</div>
<div id="content">
	<?php		
	
		echo $content_for_layout;
	?>
</div>
</body>
<?php echo $this->Facebook->init(); ?>
</html>