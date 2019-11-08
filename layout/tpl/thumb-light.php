<?php 
if(has_post_thumbnail()){
	$large_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
	$post_img_url = $large_image[0];
}else{
	$post_img_url = get_template_directory_uri().'/assets/image/usd.jpg';
}

$the_cat = get_the_category();
?>
<div class="post-thumb-item">
    <div class="light card">
        <div class="date">
            <span class="day"><?php echo get_the_date( 'j' ) ?></span>
            <span class="month"><?php echo get_the_date( 'F' ) ?></span>
            <span class="year"><?php echo get_the_date( 'Y' ) ?></span>
        </div>
        <div class="wrapper" style="background: url(<?php echo $post_img_url ?>) 20% 1%/cover no-repeat;">

            <div class="data">
                <div class="content">
                    <span class="author"><?php echo $the_cat[0]->cat_name ?></span>
                    <h1 class="title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h1>
                    <p class="text"><?php echo get_the_excerpt() ?></p>
                    <label for="show-menu-<?php echo get_the_ID() ?>" class="menu-button"><span></span></label>
                </div>
                <input type="checkbox" id="show-menu-<?php echo get_the_ID() ?>" />
                <ul class="menu-content">
                    <li>
                        <a href="#" class="fa fa-eye"><span><?php echo wp_statistics_pages('total','uri',get_the_ID()); ?></span></a>
                    </li>
                    <li><a href="#" class="fa fa-heart-o"><span>233</span></a></li>
                    <li><a href="#" class="fa fa-comment-o"><span><?php echo get_comments_number() ?></span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>