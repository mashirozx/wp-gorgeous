<?php 
/**
* The main template file.
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package Gorgeous
*/
get_header(); 
?>


<!--pjax -->
<div id="page-container" class="page-container">
    <main id="page" class="page">
        <!-- header -->
        <?php get_template_part( 'layout/component/page-header' ); ?>

        <section id="horizontal-scroll-container" class="horizontal-scroll-container">
            <!--list-->
            <div id="post-thumb-list" class="post-thumb-list animated" data-animate="onload bounceInRight">
                <!--thumb list item-->
                <?php 
                if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();
                        get_template_part( 'layout/tpl/content', 'thumb' );
                    } 
                }
                
                ?>
                <!--eof-->
                <div class="post-thumb-item-eof">
                    <div class="next-page">
                        <h1 id="pagination"><?php next_posts_link('Previous'); ?></h1>
                    </div>
                </div>
            </div>
        </section>
        <footer id="site-footer" class="animated slideInUp" data-animate="null">
            <div class="footer-info-1">&copy; 2019 <a href="https://2heng.xin" target="_blank">Mashiro</a></div>
            <div class="footer-info-2">Theme <a href="https://github.com/mashirozx/Gorgeous" target="_blank">Gorgeous</a></div>
        </footer>

    </main>
</div>


<?php 
get_footer();