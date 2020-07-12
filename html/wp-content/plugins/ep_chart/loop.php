<?php
$all_posts_args = array(

    'post_type' => array('post'),
    'posts_per_page' => 9

); 
$all_posts = new WP_Query($all_posts_args);

if($all_posts->have_posts()) :?>

    <?php while($all_posts->have_posts()):$all_posts->the_post(); ?>

        <div class="tozihat">
        <span class="hotel-title"><?php echo get_the_title($all_posts->post->ID); ?>
        
        </span>

        </div>

    <?php endwhile; ?>
<?php endif; ?>
