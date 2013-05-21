<?php 

$fc=new Facebook(array(
				'appId'  => '253646161335423',
				'apiKey' => '253646161335423',
				'secret' => '0b200063cb29a3c421c6baf6e6c92a3f',
				'cookie' => true,
				'locale' => 'en_US',
		));


//echo '<a href="'.$fc->getLoginUrl(array('display'=>'iframe')).'">Login</a>';
//echo '<a href="javascript:logFace();">Login</a>';
echo $fc->getUser();

?>
<?php //echo $this->Facebook->html(); ?>
<?php //echo $this->Facebook->init(); ?>
<?php //echo $this->Facebook->logout(array('redirect' => 'users/logout')); ?>
<?php //echo $this->Facebook->share('http://www.example.com/url_to_share'); //(default is the current page).?>
<?php //echo $this->Facebook->logout() ?>
<?php //echo $this->Facebook->login(array('perms' => 'email,publish_stream')); ?>

<a href="<?php echo $fc->getLogoutUrl();?>">Logout</a>
<iframe width="400"  height="400" src="<?php echo $fc->getLoginUrl(array('display'=>'iframe'));?>"></iframe>