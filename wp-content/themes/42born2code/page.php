<?php get_header() ?>
<div id="content">
<?php the_post() //cf. codex the_post() ?>
	<div class="entry">
		<h2 class="page-title"><?php the_title() ?></h2>
		<div class="entry-content">
		<?php the_content() ?>
		<img src="<?php wp_link_pages('before=<div id="page-links">&after=</div>'); ?>
<?php $image = get_post_meta($post->ID, 'id_dailymotion', true);
echo $image; ?>">
		</div>
	</div><!-- entry -->
	<div class="entry">
<?php if ( get_post_meta($post->ID, 'Second Excerpt', true) ) : ?>
<?php echo get_post_meta($post->ID, 'Second Excerpt', true) ?>
<?php endif; ?>
      	    </div>

<?php if ( get_post_custom_values('comments') ) comments_template() ?>
</div><!-- #content -->

<?php include(TEMPLATEPATH."/my_sidebar.php");?>
<?php if (has_post_thumbnail())
      the_post_thumbnail(); ?>

<?php get_footer() ?>