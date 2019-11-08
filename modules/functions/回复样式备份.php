<?php
/*
 * Comment list style
 */
if(!function_exists('gorgeous_comment_format')){
	function gorgeous_comment_format($comment, $args, $depth){
		$GLOBALS['comment'] = $comment;
		?>
		<li <?php comment_class(); ?> id="comment-<?php echo esc_attr(comment_ID()); ?>">
			<div class="contents">
				<div class="comment-arrow">
					<div class="main shadow">
						<div class="profile">
							<a href="<?php comment_author_url(); ?>" target="_blank" rel="nofollow"><?php echo str_replace( 'src=', 'src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.0.2/img/svg/loader/trans.ajax-spinner-preloader.svg" onerror="imgError(this,1)" data-src=', get_avatar( $comment->comment_author_email, '80', '', get_comment_author(), array( 'class' => array( 'lazyload' ) ) ) ); ?></a>
						</div>
						<div class="commentinfo">
							<section class="commeta">
								<div class="left">
									<h4 class="author"><a href="<?php comment_author_url(); ?>" target="_blank" rel="nofollow"><?php echo get_avatar( $comment->comment_author_email, '24', '', get_comment_author() ); ?><span class="bb-comment isauthor" title="中央钦定的<?php #esc_attr_e('Author', 'akina'); ?>">博主</span> <?php comment_author(); ?> <?php echo get_author_class($comment->comment_author_email,$comment->user_id); ?></a></h4>
								</div>
								<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
								<div class="right">
									<div class="info"><time datetime="<?php comment_date('Y-m-d'); ?>"><?php echo get_time_since(strtotime($comment->comment_date_gmt), true );//comment_date(get_option('date_format')); ?></time><?php echo poi_get_useragent($comment->comment_agent); ?><?php echo mobile_get_useragent_icon($comment->comment_agent); ?>&nbsp;来自: <?php echo convertip(get_comment_author_ip()); ?>
    									<?php if (current_user_can('manage_options') and (wp_is_mobile() == false) ) {
                                            $comment_ID = $comment->comment_ID;
                                            $i_private = get_comment_meta($comment_ID, '_private', true);
                                            $flag = ' <i class="fa fa-snowflake-o" aria-hidden="true"></i> 状态: <a href="javascript:;" data-actionp="set_private" data-idp="' . get_comment_id() . '" id="sp" class="sm" style="color:rgba(0,0,0,.35)">私密(<span class="has_set_private">';
                                            if (!empty($i_private)) {
                                                $flag .= '是 <i class="fa fa-lock" aria-hidden="true"></i>';
                                            } else {
                                                $flag .= '否 <i class="fa fa-unlock" aria-hidden="true"></i>';
                                            }
                                            $flag .= '</span>)</a>';
                                            echo $flag;
                                        } ?></div>
								</div>
							</section>
						</div>
						<div class="body">
							<?php comment_text(); ?>
						</div>
					</div>
					<div class="arrow-left"></div>
				</div>
			</div>
			<hr>
		<?php
	}
}