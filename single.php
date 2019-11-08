<?php 
get_header(); 

if(has_post_thumbnail()){
	$large_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
	$post_img_url = $large_image[0];
}else{
	$post_img_url = get_template_directory_uri().'/assets/image/usd.jpg';
}

$the_cat = get_the_category();
?>


<!--pjax -->
<div id="page-container" class="page-container">
    <main id="page" class="page">
        <!-- header -->
        <?php get_template_part( 'layout/component/page-header' ); ?>

        <section>
            <div id="entry-viewbox" class="entry-viewbox">
                <!-- animation: onload, onshow, onhover, onclick -->
                <div id="entry-container" class="entry-container animated" data-animate="onshow bounceInUp">
                    <div id="entry-content" class="entry-content">
                        <figure class="feature-image">
                            <img id="page-feature-image" class="page-feature-image" src="<?php echo $post_img_url ?>" alt="Trulli">
                            <div class="title-container">
                                <h1 class="entry-title"><?php the_title() ?></h1>
                                <p class="entry-census">
                                    <span><a href="#"><img src="https://dev.2heng.xin/wp-content/themes/Gorgeous/assets/image/avatar.jpg"></a></span><span><a href="#">Mashiro</a></span><span class="bull">·</span>2018-12-16<span class="bull">·</span>404 次阅读<span class="bull">·</span><span><a href="./">EDIT</a></span></p>
                            </div>
                        </figure>
                        
                        <article class="markdown-body">
                            <?php the_post(); the_content();?>
                        </article>
                        
                    </div>
                    <aside>
                        <div class="scroll">
                            <img src="https://view.moezx.cc/images/2019/01/18/Cii-tFxA-giIQsvlAAExfDgNXqsAATNegC2BwkAATGU717.jpg">
                        </div>
                        <div class="sticky">
                            <div class="sticky-block">
                                <div id="button-show-comment" class="button-show-comment"><span><i class="fa fa-comments" aria-hidden="true"></i></span> Show Comments</div>
                                <div class="toc"></div>
                            </div>
                            <div class="site-footer">
                                &copy; 2019 <a href="https://2heng.xin" target="_blank">Mashiro</a>
                                <span style="float: right">Theme <a href="https://github.com/mashirozx/Gorgeous" target="_blank">Gorgeous</a></span>
                            </div>
                        </div>
                    </aside>
                </div>
                <!--comment box-->
                <div id="comment-box" class="comment-box">
                    <?php get_template_part( 'css' ); ?>
                    <?php
                        comments_template('', true); 
                    ?>
                </div>
            </div>


            <footer id="mobile-site-footer" class="mobile-site-footer">
                <div class="footer-info-1">&copy; 2019 <a href="https://2heng.xin" target="_blank">Mashiro</a></div>
                <div class="footer-info-2">Theme <a href="https://github.com/mashirozx/Gorgeous" target="_blank">Gorgeous</a></div>
            </footer>

        </section>

        <!--read mode-->
        <div id="read-mode-container" class="read-mode-container">
            <div class="header">
                <div id="close-read-mode" class="close-read-mode">Quit Read Mode <i class="fa fa-times" aria-hidden="true"></i></div>
            </div>
            <div id="read-mode-scroll-layer" class="read-mode-scroll-layer"></div>
        </div>

    </main>
</div>


<?php get_footer(); ?>