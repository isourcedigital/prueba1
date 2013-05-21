<!DOCTYPE html>
<html>
<head>
<?php  //echo $this->Facebook->html(); ?>
<meta charset="utf-8">
<title>Kaspersky Mobile</title>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<meta name="apple-mobile-web-app-capable" content="yes" />
<?php 
echo $this->Html->css(array(
		'jquery.mobile.flip.css',
		'layoutResponsive.css',
		'jquery.mobile.theme-1.3.0.css',
		'jquery.mobile.structure-1.3.0.css',
		'jquery.mobile-1.3.0.css',
		'/js/shadowbox-3.0.3/shadowbox.css'));
echo $this->Html->script(array(
		'jquery.js',
		'jquery.mobile-1.3.0.js',
		'jquery.mobile.flip.js',
		
		'/js/FeedEk/js/FeedEk.js',
		'jquery.form.js',
		'/js/shadowbox-3.0.3/shadowbox.js',
		));
?>
 
<script type="text/javascript">
Shadowbox.init({
    language: 'en',
    players:  ['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv'],
	modal: false
});


</script>
</head>
<body style="margin:0px 0px 0px 0px;">

<?php echo $content_for_layout;?>

</body>
<?php //echo $this->Facebook->init(); ?>
</html>