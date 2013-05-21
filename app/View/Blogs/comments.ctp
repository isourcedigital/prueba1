<div id="output1">
<?php 

$items=file("../../cache/json-cache-tmp-".$id.".txt");
$items=json_decode($items[0]);
$item=$items[$item-1];

$urlrsscommentPost=$item->urlrsscomment;
$idPost=explode("?p=", $item->guid);
$idPost=$idPost[1];

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
$RSS = new LectorRSS ($urlrsscommentPost);


preg_match('@^(?:http://)?([^/]+)@i',
		$urlrsscommentPost, $coincidencias);
$hostKL = $coincidencias[1];
preg_match('/[^.]+\.[^.]+$/', $hostKL, $coincidencias);
$dominioKL=$coincidencias[0];


$iteradorRSS=$RSS->obtener_items ();

foreach ( $iteradorRSS as $item){
	$titleItem=$item->obtener_titulo();
	
	$contentItem=$item->obtener_description();
	
	echo "<h1>".$titleItem."</h1>";
	echo "<p>".$contentItem."</p>";
}

?>
<form id="commentform" method="post" action="http://<?php echo $hostKL;?>/wp-comments-post.php">

<p><input type="text" tabindex="1" size="22" value="" id="author" name="author"><label for="author"><small>Name(required)</small></label></p>
<p><input type="text" tabindex="2" size="22" value="" id="email" name="email"><label for="email"><small>E-mail(required)</small></label></p>
<p><input type="text" tabindex="3" size="22" value="" id="url" name="url"><label for="url"><small>Website</small></label></p>
<p class="comment-form-comment"><label for="comment">Comentario</label><textarea aria-required="true" rows="8" cols="45" name="comment" id="comment"></textarea></p>

<p class="form-submit">
<input type="submit" value="Publicar comentario" id="submit" name="submit">
<input type="hidden" id="comment_post_ID" value="<?php echo $idPost;?>" name="comment_post_ID">
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
    alert("Thank you for comments!!!");
} 
</script>
</div>