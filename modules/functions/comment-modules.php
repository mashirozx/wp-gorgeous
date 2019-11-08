<?php
/*
 * Comment list style
 */
if(!function_exists('gorgeous_comment_format')){
	function gorgeous_comment_format($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment;
        empty ( get_comment_author_url() ) ? $author_url_control = 'onclick="return false"' : $author_url_control = '';
        ?>
<!--comment-item-->
<li class="comment-item <?php echo get_user_level($comment->comment_author_email) ?>" id="comment-<?php echo esc_attr(comment_ID()); ?>" data-cmt-link="<?php echo get_comment_link() ?>">
	<div class="commentator-avatar">
		<a href="<?php comment_author_url(); ?>" target="_blank" <?php echo $author_url_control; ?>>
			<?php echo get_avatar( $comment->comment_author_email, '50', '', get_comment_author(), array( 'class' => array( 'lazyload' ) ) )?>
		</a>
        <i class="iconfont icon-big-vip"></i>
	</div>
	<div class="commentator-comment">
		<span class="commentator-name"><strong class="author-name"><a href="<?php comment_author_url(); ?>" target="_blank" <?php echo $author_url_control; ?> rel="external nofollow" class="url"><?php comment_author(); ?></a></strong></span>&nbsp;<span class="iconfont icon-user-<?php echo get_user_comment_level($comment->comment_author_email) ?>"></span>
		<div class="comment-chat">
			<div class="comment-comment">
				<?php comment_text(); ?>
				<div class="comment-info">
					<?php echo get_comment_floor($comment->comment_ID, $comment->comment_post_ID, $comment->comment_parent);?><span class="comment-time"><?php echo get_time_since(strtotime($comment->comment_date_gmt), true, true ); ?></span><span class="post-like"><a href="javascript:;" data-action="comment_zan" data-id="1680" class=""><i class="iconfont icon-like-s-o"></i><span class="count">0</span></a></span><span class="post-like"><a href="javascript:;" data-action="comment_cai" data-id="1680" class=""><i class="iconfont icon-dislike-s-o"></i><span class="count">0</span></a></span><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				</div>
			</div>
		</div>
	</div>
	<!--get children-->
        <?php
	}
}

/*
 * Ajax comment
 */
// notification
if(!function_exists('poi_ajax_comment_err')) {
    function poi_ajax_comment_err($t) {
        header('HTTP/1.0 500 Internal Server Error');
        header('Content-Type: text/plain;charset=UTF-8');
        echo $t;
        exit;
    }
}
// robots check
function pio_robot_comment(){
  if ( !$_POST['no-robot'] && !is_user_logged_in()) {
     poi_ajax_comment_err('Please comfirm you are not a robot.');
  }
}
//if(akina_option('norobot')) add_action('pre_comment_on_post', 'poi_robot_comment');
// intercept comments without any Chinese word
function scp_comment_post( $incoming_comment ) {
  global $user_ID; 
  if( $user_ID && current_user_can('level_10') ) {
    return( $incoming_comment );
  } elseif(!preg_match('/[一-龥]/u', $incoming_comment['comment_content'])){
    poi_ajax_comment_err('写点汉字吧。You should add some Chinese words.');
  }
  return( $incoming_comment );
}
// add_filter('preprocess_comment', 'scp_comment_post');

// comments commiting
if(!function_exists('poi_ajax_comment_callback')) {
    function poi_ajax_comment_callback(){
        $comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
        if( is_wp_error( $comment ) ) {
            $data = $comment->get_error_data();
            if ( !empty( $data ) ) {
                poi_ajax_comment_err($comment->get_error_message());
            } else {
                exit;
            }
        }
        $user = wp_get_current_user();
        do_action('set_comment_cookies', $comment, $user);
        $GLOBALS['comment'] = $comment; 
        empty ( get_comment_author_url() ) ? $author_url_control = 'onclick="return false"' : $author_url_control = '';
        ?>
<!--new comment item-->
<li class="comment-item <?php echo get_user_level($comment->comment_author_email) ?> animated lightSpeedIn" id="comment-<?php echo esc_attr(comment_ID()); ?>">
	<div class="commentator-avatar">
		<a href="<?php comment_author_url(); ?>" target="_blank" <?php echo $author_url_control; ?>>
			<?php echo get_avatar( $comment->comment_author_email, '50', '', get_comment_author(), array( 'class' => array( 'lazyload' ) ) )?>
		</a>
        <i class="iconfont icon-big-vip"></i>
	</div>
	<div class="commentator-comment">
		<span class="commentator-name"><strong class="author-name"><a href="<?php comment_author_url(); ?>" target="_blank" <?php echo $author_url_control; ?> rel="external nofollow" class="url"><?php comment_author(); ?></a></strong></span>&nbsp;<span class="iconfont icon-user-<?php echo get_user_comment_level($comment->comment_author_email) ?>"></span>
		<div class="comment-chat">
			<div class="comment-comment">
				<?php comment_text(); ?>
				<div class="comment-info">
					<?php echo get_comment_floor($comment->comment_ID, $comment->comment_post_ID, $comment->comment_parent);?><span class="comment-time"><?php echo get_time_since(strtotime($comment->comment_date_gmt), true, true ); ?></span><span class="post-like"><a href="javascript:;" data-action="comment_zan" data-id="1680" class=""><i class="iconfont icon-like-s-o"></i><span class="count">0</span></a></span><span class="post-like"><a href="javascript:;" data-action="comment_cai" data-id="1680" class=""><i class="iconfont icon-dislike-s-o"></i><span class="count">0</span></a></span>
				</div>
			</div>
		</div>
	</div>
</li>
<!--new comment item eof-->
      <?php die();
    }
}
add_action('wp_ajax_nopriv_ajax_comment', 'poi_ajax_comment_callback');
add_action('wp_ajax_ajax_comment', 'poi_ajax_comment_callback');

/**
 * user comment level
 */
function get_user_comment_level($comment_author_email){
    global $wpdb;
    $author_count = count($wpdb->get_results(
        "SELECT comment_ID as author_count FROM $wpdb->comments WHERE comment_author_email = '$comment_author_email' "
    ));
    $level = 'level-0';
    if($author_count>=1 && $author_count< 5 )           $level = 'level-0';
    else if($author_count>=6 && $author_count< 10)      $level = 'level-1';
    else if($author_count>=10 && $author_count< 20)     $level = 'level-2';
    else if($author_count>=20 && $author_count< 40)     $level = 'level-3';
    else if($author_count>=40 && $author_count< 80)     $level = 'level-4';
    else if($author_count>=80 && $author_count< 160)    $level = 'level-5';
    else if($author_count>=160)                         $level = 'level-6';
    return $level;
}

/**
 * user type accroding to user level
 */
function get_user_level($comment_author_email, $is_registered = false){
    $user = get_user_by( 'email', $comment_author_email );
    if ($user){
        if ($is_registered) {
            return true;
        }
        
        $levels = array('administrator', 'editor', 'author', 'contributor', 'subscriber');
        
        $user_roles = $user->roles;
        $user_level = 'subscriber';
        
        foreach ($levels as $value) {
            if ( in_array( $value, $user_roles, true ) ) {
                $user_level = $value;
                break;
            }
        }
        return $user_level;
        
    } else {
        if ($is_registered) {
            return false;
        }
        return 'visitor';
    }
}

//customize reply title
add_filter( 'comment_form_defaults', 'custom_reply_title' );
function custom_reply_title( $defaults ){
  $defaults['title_reply_before'] = '<h3 id="reply-title" class="comment-reply-title"><div id="reply-to" class="reply-to" style="display: none"></div>';
  $defaults['title_reply_after'] = '</h3>';
  //$defaults['cancel_reply_before'] = '';
  //$defaults['cancel_reply_after'] = '';
  return $defaults;
}


/**
 * get comment floor number
 */
function get_comment_floor($comment_ID, $comment_post_ID, $comment_parent){
    if ( $comment_parent == 0 ) {
        global $wpdb;
        $comment_floor = $wpdb->get_var(
            "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_post_ID = $comment_post_ID AND comment_parent = 0 AND comment_ID <= $comment_ID"
        );
        $res = '<span class="floor">#'.$comment_floor.'</span>';
    } else {
        $res = '';
    }
    return $res;
}

/*
 * Add @ tag on comment
 */
function comment_add_at( $comment_text, $comment = '') {
    //var_dump($comment);
    if(is_object ($comment)){
        if( $comment->comment_parent > 0) {
            $comment_text = '<a href="#comment-' . $comment->comment_parent . '" class="comment-at">@'.get_comment_author( $comment->comment_parent ) . '</a>&nbsp;' . $comment_text;
        }
    }
    return $comment_text;
}
add_filter( 'comment_text' , 'comment_add_at', 20, 2);

/*
function comment_like_post(){
	
}
*/