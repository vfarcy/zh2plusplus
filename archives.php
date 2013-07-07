<?php
/**
 * @package WordPress
 * @subpackage zh2
 */
/*
Template Name: Archives
*/
?>



	<?php get_header(); ?>

<script type="text/javascript">
			var root_url = window.location.hostname;
			function Gsitesearch(curobj){
				curobj.q.value="site:"+root_url+" "+curobj.qfront.value
				}

		</script>


		<form action="http://www.google.com/search" method="get" onSubmit="Gsitesearch(this)">

			<p><h2><?php echo __('Search'); ?></h2><br />
			<input name="q" type="hidden" class="texta" />
			<input name="qfront" type="text" style="width: 180px; text-size: 12px; height: 14px;" /> </p>

		</form>

<?php
if(isset($_GET['author_name'])) :
$curauth = get_userdatabylogin($author_name);
else :
$curauth = get_userdata(intval($author));
endif;
?>


		<h2><?php echo('Archives'); ?> <?php echo $curauth->nickname; ?></h2>
	
		<div class="post">
        <ul class="authorpostslist">
        
		<?php if (have_posts()) : ?>
        <?php query_posts("showposts=-1"); // show one latest post only ?>
        <?php while (have_posts()) : the_post(); ?>
        
        <li><strong><?php the_time('d M Y'); ?>:</strong> <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></br>
        </li>

		<?php endwhile; ?>
		<?php else : ?>
		<p class="center"><?php _e('No posts by this author.'); ?></p>
		<?php endif; ?>
        </ul><!-- /end author posts list -->
	<?php wp_footer(); ?>

</body>
</html>