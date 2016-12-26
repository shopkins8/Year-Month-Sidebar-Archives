<aside id="mk-sidebar" class="mk-builtin" <?php echo get_schema_markup('sidebar'); ?>>
    <div class="sidebar-wrapper">
    <?php  
    global $post;
    if(isset($post)){

    	mk_sidebar_generator( 'get_sidebar', $post->ID);
		echo '</ul><div class="textwidget" style="margin-left:10px;">';
		echo '<h3 style="margin-bottom:10px;" class="widget-title"><span>Archives</span></h3>';
	global $wpdb;
	$limit = 0;
	$year_prev = null;
	$months = $wpdb->get_results("SELECT DISTINCT MONTH( post_date ) AS month ,  YEAR( post_date ) AS year, COUNT( id ) as post_count FROM $wpdb->posts WHERE post_status = 'publish' and post_date <= now( ) and post_type = 'post' GROUP BY month , year ORDER BY post_date DESC");
	foreach($months as $month) :
	
	    $year_current = $month->year;
		
	    if ($year_current != $year_prev){
			
			?>
            <div class="archive-list">
	    		<p style="cursor:pointer;margin-bottom:5px;font-size:18px;" id="archive-<?php echo $month->year; ?>" class="archive-year"><?php echo $month->year; ?></p>
	    <?php } ?>
	    		<li style="list-style:none;margin-left:10px;"><a href="<?php bloginfo('url') ?>/<?php echo $month->year; ?>/<?php echo date("m", mktime(0, 0, 0, $month->month, 1, $month->year)) ?>"><span class="archive-month"><?php echo date_i18n("F", mktime(0, 0, 0, $month->month, 1, $month->year)) ?></span></a></li>
       
	<?php $year_prev = $year_current;
	 
	 
	endforeach;
	
		echo "</div>";

    }else{

    	mk_sidebar_generator( 'get_sidebar', false);

    } ?>
    </div>
</aside>