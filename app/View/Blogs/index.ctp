<div id="output1">
<?php 
class LectorRSS {
	var $url;
	var $data;
	function LectorRSS ($url){
		$this->url;
		$this->data = implode ("", file ($url));
	}
	function obtener_items (){
		preg_match_all ("/<item .*>.*<\/item>/xsmUi", $this->data, $matches);
		$items = array ();
		foreach ($matches[0] as $match){
			$items[] = new RssItem ($match);
		}
		return $items;
	}
}
class RssItem {
	var $title, $url,$excerpt, $description,$totalcomments,$fecha;
	function RssItem ($xml){
		$this->populate ($xml);
	}
	function populate ($xml){
		preg_match ("/<title> (.*) <\/title>/xsmUi", $xml, $matches);
		@$this->title = $matches[1];
		preg_match ("/<link> (.*) <\/link>/xsmUi", $xml, $matches);
		@$this->url = $matches[1];
		preg_match ("/<content:encoded> (.*) <\/content:encoded>/xsmUi", $xml, $matches);
		@$this->description = $matches[1];
		preg_match ("/<description> (.*) <\/description>/xsmUi", $xml, $matches);
		@$this->excerpt = $matches[1];
		preg_match ("/<slash:comments> (.*) <\/slash:comments>/xsmUi", $xml, $matches);
		@$this->totalcomments = $matches[1];
		preg_match ("/<pubDate> (.*) <\/pubDate>/xsmUi", $xml, $matches);
		@$this->fecha = $matches[1];


	}
	function obtener_fecha (){
		$originalDate = $this->fecha;
		$newDate = date("m-d-Y", strtotime($originalDate));
		return $newDate;
	}
	function obtener_totalcomments (){
		return $this->totalcomments;
	}
	function obtener_titulo (){
		return $this->title;
	}
	function obtener_url (){
		return $this->url;
	}
	function obtener_description (){

		return htmlspecialchars_decode(str_replace("]]>", "", str_replace("<![CDATA[", "", $this->description)));
	}
	function obtener_excerpt (){
		//return str_replace("]]>", "", str_replace("<![CDATA[", "", $this->excerpt));
		return htmlspecialchars_decode(str_replace("]]>", "", str_replace("<![CDATA[", "", $this->excerpt)));
	}
}
$RSS = new LectorRSS ("http://www.eduardocortez.com.ar/sistema-de-facturacion/feed/");

$iteradorRSS=$RSS->obtener_items ();

foreach ( $iteradorRSS as $item){
	$titleItem=$item->obtener_titulo();
	
	$contentItem=$item->obtener_description();
	
	echo "<h1>".$titleItem."</h1>";
	echo "<p>".$contentItem."</p>";
}

?>
<form id="commentform" method="post" action="http://www.eduardocortez.com.ar/wp-comments-post.php">
<p class="comment-notes">Tu dirección de correo electrónico no será publicada. Los campos necesarios están marcados <span class="required">*</span></p>
<p><input type="text" tabindex="1" size="22" value="Carlos Alberto" id="author" name="author"><label for="author"><small>Name(required)</small></label></p>
<p><input type="text" tabindex="2" size="22" value="ccarli85@hotmail.com" id="email" name="email"><label for="email"><small>E-mail(required)</small></label></p>
<p><input type="text" tabindex="3" size="22" value="" id="url" name="url"><label for="url"><small>Website</small></label></p>
<p class="comment-form-comment"><label for="comment">Comentario</label><textarea aria-required="true" rows="8" cols="45" name="comment" id="comment"></textarea></p>

<p class="form-submit">
<input type="submit" value="Publicar comentario" id="submit" name="submit">
<input type="hidden" id="comment_post_ID" value="10" name="comment_post_ID">
<input type="hidden" value="0" id="comment_parent" name="comment_parent">
</p>
</form>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
/*
	$('#commentform').ajaxForm(function() { 
		alert("Thank you for your comment!"); 
	}); 
  */  
	var options = { 
	        target:        '#output1',   // target element(s) to be updated with server response 
	        //beforeSubmit:  showRequest,  // pre-submit callback 
	        success:       showResponse  // post-submit callback 
	 
	        // other available options: 
	        //url:       url         // override for form's 'action' attribute 
	        //type:      type        // 'get' or 'post', override for form's 'method' attribute 
	        //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
	        //clearForm: true        // clear all form fields after successful submit 
	        //resetForm: true        // reset the form after successful submit 
	 
	        // $.ajax options can be used here too, for example: 
	        //timeout:   3000 
	    }; 
	 
	    // bind form using 'ajaxForm' 
	    $('#commentform').ajaxForm(options); 
	
});

function showResponse(responseText, statusText, xhr, $form)  { 
    // for normal html responses, the first argument to the success callback 
    // is the XMLHttpRequest object's responseText property 
 
    // if the ajaxForm method was passed an Options Object with the dataType 
    // property set to 'xml' then the first argument to the success callback 
    // is the XMLHttpRequest object's responseXML property 
 
    // if the ajaxForm method was passed an Options Object with the dataType 
    // property set to 'json' then the first argument to the success callback 
    // is the json data object returned by the server 
 
    alert('status: ' + statusText + '\n\nresponseText: \n' + responseText + 
        '\n\nThe output div should have already been updated with the responseText.'); 
} 
</script>

<?php 		

	foreach ($blogs_kl as $blog_kl): 
		$id=$blog_kl['Blog']['id'];
		$name=$blog_kl['Blog']['name'];
		if(!empty($blog_kl['BrwImage']['main'])) {
			echo '<img src="'.$blog_kl['BrwImage']['main']['sizes']['1024_1024'].'">';
			echo "<br>";
			echo $this->Html->link($name, array('action' => 'view', $id))."<br>";
			
		}	else{
			echo $this->Html->link($name, array('action' => 'view', $id))."<br>";
		}
	endforeach;
	
	echo "<br><hr><br>";
	if(!empty($blogs_usr)){
	foreach ($blogs_usr as $blog_usr):
	$id=$blog_usr['Blog']['id'];
	$name=$blog_usr['Blog']['name'];	
		echo $this->Html->link($name, array('action' => 'view', $id))."<br>";
	
	endforeach;
	}
?>
</div>