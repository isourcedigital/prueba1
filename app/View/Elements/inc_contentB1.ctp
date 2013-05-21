<?php 
class LectorRSSDate {
	var $url;
	var $data;
	function LectorRSSDate ($url){
		$this->url;
		$this->data = implode ("", file ($url));
	}
	function obtener_lastBuildDate (){
		preg_match_all ("/<lastBuildDate .*>.*<\/lastBuildDate>/xsmUi", $this->data, $matches);
		//preg_match ("/<lastBuildDate> (.*) <\/lastBuildDate>/xsmUi", $this->data, $matches);
		return $matches[0];
	}
}

?>
<div class="ui-grid-b">
	<?php 
		$blog1=1;
		foreach ($blogs_kl as $blog_kl):
			$id=$blog_kl['Blog']['id'];
			$name=$blog_kl['Blog']['name'];
			$url=$blog_kl['Blog']['url'];

			$RSS = new LectorRSSDate ($url);
			$dateUpdate=str_replace("<lastBuildDate>", "", $RSS->obtener_lastBuildDate ());
			$dateUpdate=str_replace("</lastBuildDate>", "", $dateUpdate);
			
			echo $dateUpdate[0];
	?>
	<?php if($blog1==1){?>
	<div class="bloque1 blog" id="blog1">
		<a href="<?php echo $this->webroot?>blogs/view/<?php echo $id;?>" data-transition="slide" id="blogkl-<?php echo $id;?>">
		<div class="bloque">
		<img src="<?php echo $blog_kl['BrwImage']['main']['sizes']['1024_1024'];?>">
			<div class="tituloBlog">
				<p><?php echo $name;?></p>
			</div>
		</div>
		</a>
	</div>
	<?php }else{?>
	<div class="bloqueNuevo blog" id="blog3">
		<a href="<?php echo $this->webroot?>blogs/view/<?php echo $id;?>" data-transition="slide" id="blogkl-<?php echo $id;?>">
			<div class="bloque">
				<img src="<?php echo $blog_kl['BrwImage']['main']['sizes']['1024_1024'];?>">
				<div class="tituloBlog">
					<p><?php echo $name;?></p>
				</div>
			</div>
		</a>
	</div>
	<?php }?>
	<?php 
	$blog1++;
	endforeach;	
	
	
	$fechas_nacimiento = array(
			array(
					'nombre' => 'Paco',
					'fecha'  => '22-12-2012'
			),
			array(
					'nombre' => 'Luis',
					'fecha'  => '30-08-2012'
			),
			array(
					'nombre' => 'Mar&iacute;a',
					'fecha'  => '25-01-2013'
			)
	);
	
	function ordenar( $a, $b ) {
		return strtotime($b['fecha']) - strtotime($a['fecha']);
	}
	
	function mostrar_array($datos) {
		foreach($datos as $dato)
			echo "{$dato['fecha']} -&gt; {$dato['nombre']}<br/>";
	}
	
	
	usort($fechas_nacimiento, 'ordenar');
	
	mostrar_array($fechas_nacimiento);
	?>
	<div class="clear"></div>
</div>
