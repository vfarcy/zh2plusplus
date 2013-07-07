<?php get_header(); ?>

<script type="text/javascript">
			var root_url = window.location.hostname;
			function Gsitesearch(curobj){
				curobj.q.value="site:"+root_url+" "+curobj.qfront.value
				}

		</script>


		<form action="http://www.google.com/search" method="get" onSubmit="Gsitesearch(this)">

			<p><h2><?php echo __('Search'); ?></h2> :<br />
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


		<h2><?php echo('Posts by'); ?> <?php echo $curauth->nickname; ?>:</h2>
	
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



        <div id="recent-author-comments">
        <h3><?php _e('Last 10 Comments by '); echo $curauth->display_name; ?></h3>
        <?php
$number=10; // number of recent comments to display
$comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_approved = '1' and comment_author_email='$curauth->user_email' ORDER BY comment_date_gmt DESC LIMIT $number");
?>
<ul class="authorpostslist">
<?php
if ( $comments ) : foreach ( (array) $comments as $comment) :
echo '<li class="recentcomments">' . sprintf(__('%1$s on %2$s'), get_comment_date(), '<a href="'. get_comment_link($comment->comment_ID) . '">' . get_the_title($comment->comment_post_ID) . '</a>') . '</li>';
endforeach; else: ?>
<p><?php _e('No comments by '); echo $curauth->display_name; ?></p>
<?php endif; ?>
</ul>
</div><!--#recentAuthorComments-->


		</div> <!-- /end .post -->
<?php get_footer(); ?>