<?php
 
	/**
	 * COMMENTS TEMPLATE
	 */

	/*if('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die(esc_html__('Please do not load this page directly.', 'poi'));*/

	if(post_password_required()){
		return;
	}

?>

	<?php if(comments_open()): ?>
    
    <div class="cmt-box-header">
        <h3 id="comments-list-title" class="comments-list-title"><span class="noticom"><?php comments_number('NOTHING', '1 条评论', '% 条评论'); ?> </span><span id="button-hide-comment" class="button-hide-comment"><i class="fa fa-times" aria-hidden="true"></i></span></h3> 
    </div>
    
    <div class="m-cmt-box-header">
        <h3 id="comments-list-title" class="comments-list-title"><span class="noticom"><?php comments_number('NOTHING', '1 条评论', '% 条评论'); ?> </span></h3> 
    </div>

	<div id="comments" class="comments">

		<div class="comments-main">
        
                    
		<div id="loading-comments"><span></span></div>
			<?php if(have_comments()): ?>

				<ol id="comment-wrap" class="comment-wrap">
					<?php wp_list_comments(array(
                            'type'      => 'comment',
                            'callback'  => 'gorgeous_comment_format'
                          )); ?>	
				</ol>
                
			 <?php else : ?>

				<?php if(comments_open()): ?>
					<div class="commentwrap">
						<div class="notification-hidden"><i class="iconfont icon-mark"></i> <?php esc_html_e('暂无评论', 'poi'); ?></div>
					
					</div>
				<?php endif; ?>

			<?php endif; ?>
            
            

		</div>
        
	</div>
    
    <div id="comment-footer" class="comment-footer">
        <nav id="comments-navi" class="comments-navi">
            <?php paginate_comments_links('prev_text=«&next_text=»');?>
        </nav>
        <div id="comment-user-avatar" class="comment-user-avatar" style="display:none">
            <input type="text" name="avatar" value="" autocomplete="off"/>
            <img src="https://en.gravatar.com/avatar/?s=100&d=mm">
            <span class="socila-check qq-check"><i class="fa fa-qq" aria-hidden="true"></i></span>
            <span class="socila-check gravatar-check"><i class="fa fa-google" aria-hidden="true"></i></span>
        </div>


			<?php

				if(comments_open()){
					$robot_comments = POI('norobot') ? '<label class="siren-checkbox-label"><input class="siren-checkbox-radio" type="checkbox" name="no-robot"><span class="siren-no-robot-checkbox siren-checkbox-radioInput"></span>滴，学生卡 | I\'m not a robot</label>' : '';
					$private_ms = POI('open_private_message') ? '<label class="siren-checkbox-label"><input class="siren-checkbox-radio" type="checkbox" name="is-private"><span class="siren-is-private-checkbox siren-checkbox-radioInput"></span>悄悄话 | Comment in private</label>' : '';
					$args = array(
                        'format' => 'html5',
						'id_form' => 'commentform',
						'id_submit' => 'submit',
						'title_reply' => '',
						'title_reply_to' => '<div class="graybar">RE: ' . esc_html__('Leave a Reply to', 'poi') . ' %s' . '</div>',
						'cancel_reply_link' => esc_html__('Cancel Reply', 'poi'),
						'label_submit' => esc_html__('Commit', 'poi'),
						'comment_field' => '<div id="comment-body-container" class="comment-body-container"><textarea placeholder="' . esc_attr__('请开始你的表演', 'poi') . ' ..." name="comment" class="comment-body" id="comment-body" rows="1" tabindex="4"></textarea></div>',
						'comment_notes_after' => '',
						'comment_notes_before' => '',
						'fields' => apply_filters( 'comment_form_default_fields', array(
							'author' =>
								'<div id="cmt-info-container" class="cmt-info-container animated" data-animate="null"><div class="comment-user-info"><div class="popup cmt-popup cmt-author"><span class="popuptext">输入QQ号将自动拉取昵称和头像</span><input type="text" placeholder="' . esc_attr__('昵称或QQ号', 'poi') . ' ' . ( $req ?  '(' . esc_attr__('必填 Name* ', 'poi') . ')' : '') . '" name="author" id="author" class="info-input" value="' . esc_attr($comment_author) . '" size="22" autocomplete="off" tabindex="1" ' . ($req ? "aria-required='true'" : '' ). ' /></div>',
							'email' =>
								'<div class="popup cmt-popup"><span class="popuptext">你将收到回复通知</span><input type="text" placeholder="' . esc_attr__('邮箱', 'poi') . ' ' . ( $req ? '(' . esc_attr__('必填 Email* ', 'poi') . ')' : '') . '" name="email" id="email" class="info-input" value="' . esc_attr($comment_author_email) . '" size="22" tabindex="1" autocomplete="off" ' . ($req ? "aria-required='true'" : '' ). ' /></div>',
							'url' =>
								'<div class="popup cmt-popup"><span class="popuptext">禁止小广告😀</span><input type="text" placeholder="' . esc_attr__('网站 (选填 Site)', 'poi') . '" name="url" id="url" class="info-input" value="' . esc_attr($comment_author_url) . '" size="22" autocomplete="off" tabindex="1" /></div></div></div>' . $robot_comments . $private_ms ,
                            'qq' =>
								'<input type="text" placeholder="' . esc_attr__('QQ', 'poi') . '" name="new_field_qq" id="qq" value="' . esc_attr($comment_author_url) . '" style="display:none" autocomplete="off"/>'
							)
						)
					);
					comment_form($args);
				}

			?>
            </div>
<?php endif; ?>
