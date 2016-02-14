<?php
/*
Template Name: Pédagogie Page
*/
?>
<?php get_header()?>

<div id="content">
	<?php the_post() ?>
	<div class="entry-single">
		<div class="entry-top">
			<h2 class="entry-title"><?php the_title() ?></h2>
			<div class="entry-meta-top">
				<span class="entry-meta-sep">|</span>
			</div>
		</div>
		<div class="entry-content clearfix">
			<?php the_content() ?>
		</div>
		<div class="entry-meta entry-bottom">
			<?php the_tags( __( '<span class="tag-links">Tags: ', 'wpbx' ), ", ", "</span>\n" ) ?>
		</div>
	</div><!-- .post -->
</div>
<?php 
      if (!is_page('le-programme'))
      {
	include(TEMPLATEPATH."/my_sidebar.php");
	}
	else
	{
		get_sidebar();
	}
	    
?>
<?php get_footer() ?>
