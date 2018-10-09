<?php

$Config = shortcode_atts(
	array(
		'numcols' => CT_SHRT_NUMCOLUMNS,
		'class' => '',
		'showlogo' => true
		), $Config);
?>

<ul class="clients-list-holder">
	
	<?php
	foreach($ClientList as $Client)
	{
	?>
	    <li class="clients-list-item <?php $Config['class']; ?>">
	    	<a href="<?php echo ct\addhttp($Client->url); ?>" target="_blank">
	    		<?php echo $Client->name; ?>
	    	</a>
	    </li>
	<?php
	}
	?>

</ul>