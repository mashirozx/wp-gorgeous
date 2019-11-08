<style>
	.comment-user-avatar {
		width: 64px;
		height: 0;
		margin: 10px auto;
		cursor: pointer;
		-webkit-transform: scale(0);
		transform: scale(0);
		-webkit-transition: -webkit-transform: 0.5s;
		-moz-transition: transform 0.5s;
		-ms-transition: transform 0.5s;
		-o-transition: transform 0.5s;
		transition: transform 0.5s;
	}

	.comment-user-avatar.focus {
		height: 64px;
		-webkit-transform: scale(1);
		transform: scale(1);
	}

	.comment-user-avatar input {
		position: absolute;
		width: 64px;
		height: 64px;
		opacity: 0;
		cursor: pointer;
	}

	.comment-user-avatar img {
		width: 100%;
		height: 100%;
		border-radius: 50%
	}

	.comment-user-avatar .socila-check {
		display: none;
		width: 1.5em;
		height: 1.5em;
		font-size: 1em;
		line-height: 1.5em;
		text-align: center;
		color: #fff;
		border-radius: 50%;
		position: absolute;
		margin: -28px 0 0 42px
	}

	.qq-check {
		background-color: #99ce00
	}

	.gravatar-check {
		background-color: #1e8cbe;
		-ms-transform: rotate(270deg);
		-webkit-transform: rotate(270deg);
		transform: rotate(270deg)
	}

	.cmt-info-container {
		top: -160px;
		width: calc(100% - 12px);
		position: absolute;
		background: #fff;
		margin: 6px;
		height: 148px;
		border: 1px solid #e5e5e5;
		border-radius: 3px;
		-webkit-transform: scale(0);
		transform: scale(0);
		transform-origin: calc(100% - 46px) 100%;
		-webkit-transition: -webkit-transform: 0.5s;
		-moz-transition: transform 0.5s;
		-ms-transition: transform 0.5s;
		-o-transition: transform 0.5s;
		transition: transform 0.5s;
	}

	.cmt-info-container:before {
		content: "";
		position: absolute;
		bottom: -8px;
		left: calc(100% - 46px);
		width: 16px;
		height: 16px;
		border-width: 0 1px 1px 0;
		border-style: solid;
		border-color: #e5e5e5;
		background: #fff;
		-webkit-transform: rotate(45deg);
		-moz-transform: rotate(45deg);
		-ms-transform: rotate(45deg);
		-o-transform: rotate(45deg);
	}

	.cmt-info-container.show {
		-webkit-transform: scale(1);
		transform: scale(1);
	}

	.comment-user-info {
		height: 100%;
		display: -webkit-flex;
		display: flex;
		flex-flow: column wrap;
		justify-content: space-around;

	}

	.comment-user-info .info-input {
		border: 1px solid #ddd;
		width: calc(100% - 12px);
		background-color: rgba(255, 255, 255, 0);
		font-size: 14px;
		padding: 8px 6px;
		color: #535a63;
		background: #fff;
		border-radius: 3px;
		line-height: 1.5;
		border: 1px solid #ddd;
	}

	.popup {
		position: relative;
		display: inline-block;
		cursor: pointer
	}

	.cmt-popup {
		margin: 6px 0 0 6px;
		width: 100%;
	}

	.cmt-popup:last-child {
		margin-bottom: 6px
	}

	.popup .popuptext {
		visibility: hidden;
		display: block;
		background-color: #555;
		color: #fff;
		text-align: center;
		border-radius: 6px;
		padding: 8px;
		position: absolute;
		bottom: calc(100% + 8px);
		left: 50%;
		transform: translateX(-50%);
		white-space: nowrap;
	}

	.popup .popuptext::after {
		content: "";
		position: absolute;
		top: 100%;
		left: 50%;
		margin-left: -5px;
		border-width: 5px;
		border-style: solid;
		border-color: #555 transparent transparent transparent
	}

	.popup .insert-img-popuptext {
		visibility: hidden;
		width: 66px;
		background-color: #555;
		color: #fff;
		text-align: center;
		border-radius: 6px;
		padding: 8px 3px;
		position: absolute;
		z-index: 1;
		bottom: 9%;
		left: 10%;
		margin-left: -80px
	}

	.popup .insert-img-popuptext::after {
		content: "";
		position: absolute;
		top: 33%;
		left: 109%;
		margin-left: -7px;
		border-width: 7px;
		border-style: solid;
		border-color: transparent transparent transparent #555
	}

	.popup .show {
		visibility: visible;
		-webkit-animation: fadeIn 1s;
		animation: fadeIn 1s
	}

	@-webkit-keyframes fadeIn {
		from {
			opacity: 0
		}

		to {
			opacity: 1
		}
	}

	@keyframes fadeIn {
		from {
			opacity: 0
		}

		to {
			opacity: 1
		}
	}

</style>


<style>
	.comment-box {
		display: flex;
		flex-direction: column;
	}

	.cmt-box-header {
		position: sticky;
		top: 0;
		padding: 10px;
		background-color: #fff;
		box-shadow: 0 1px 3px rgba(26, 26, 26, 0.1);
	}

	@media only screen and (min-width: 861px) {
		.m-cmt-box-header {
			display: none
		}
	}

	@media only screen and (max-width: 860px) {
		.m-cmt-box-header {
			display: block;
			top: 0;
			padding: 10px;
			background-color: #fff;
		}

		.cmt-box-header {
			display: none
		}
	}


	.comments-list-title {
		margin: 0;
		font-size: 20px;
	}

	.button-hide-comment {
		float: right;
		display: flex;
		align-items: center;
		padding: 6px;
		border-radius: 3px;
		color: #8590a6;
		background: #f6f6f6;
		cursor: pointer;
		font-size: 16px;
	}

	.comments {
		height: 100%;
		overflow-y: auto;
		overflow-x: hidden;
	}

	.comment-footer {
		width: 100%;
		background-color: #fff;
		box-shadow: 0 -1px 3px rgba(26, 26, 26, 0.1);
	}

	.comment-footer .comments-navi {
		text-align: center;
		display: flex;
		flex-flow: row nowrap;
		justify-content: space-between;
		width: 100%;
		padding: 0;
		margin: 0;
	}

	.comments-navi .page-numbers {
		display: inline;
	}

	.comments-navi .page-numbers {
		color: black;
		padding: 8px 0;
		margin: 6px;
		border-radius: 3px;
		text-decoration: none;
		width: 100%;
		white-space: nowrap;
	}

	.comments-navi .page-numbers.current {
		background-color: #0084FF;
		color: white;
	}

	.comments-navi .page-numbers:hover:not(.current) {
		background-color: #ddd;
	}

	.comment-footer .comment-reply-title {
		margin: 0 6px
	}

	.comment-footer .comment-reply-title .reply-to {
		font-size: 80%;
	}

	.comment-footer .comment-reply-title small {
		font-size: 80%;
		float: right;
		display: inline-block;
	}

	.comment-footer .comment-form {
		display: flex;
	}

	.comment-footer .comment-form p {
		margin: 0
	}

	.comment-footer .logged-in-as {
		display: none
	}

	.comment-footer .comment-respond {
		position: relative;
	}

	.comment-footer .comment-body-container {
		width: 100%;
		min-width: calc(100% - 12px);
		border: 1px solid #8590A6;
		background-color: #F6F6F6;
		margin: 6px;
		border-radius: 3px;
		overflow: hidden;
		min-height: 36px;
		height: 36px;
		-webkit-transition: min-width 0.5s, height 0.5s;
		-moz-transition: min-width 0.5s, height 0.5s;
		-ms-transition: min-width 0.5s, height 0.5s;
		-o-transition: min-width 0.5s, height 0.5s;
		transition: min-width 0.5s, height 0.5s;
	}

	.comment-footer .comment-body-container.focus {
		background-color: #fff;
		border: 1px solid #ddd;
		margin: 6px 0 6px 6px;
		width: 100%;
		min-width: calc(100% - 6px - 98px);
		height: 108px
	}

	.comment-footer .comment-body {
		background-color: transparent;
		border: 0;
		width: calc(100% + 10px);
		resize: none;
		padding: 6px 12px 6px 6px;
		font-size: 15px;
		line-height: 1.3;
		overflow-y: auto;
	}

	.comment-footer .comment-body:focus {
		outline: none;
	}

	.comment-footer .form-submit {
		width: 98px;
		min-width: 98px;
		bottom: 0;
		-webkit-transform: scale(0);
		transform: scale(0);
		-webkit-transition: -webkit-transform: 0.5s;
		-moz-transition: transform 0.5s;
		-ms-transition: transform 0.5s;
		-o-transition: transform 0.5s;
		transition: transform 0.5s;
	}

	.comment-footer .form-submit.focus {
		-webkit-transform: scale(1);
		transform: scale(1);
	}

	.comment-footer .submit {
		color: #fff;
		background-color: #0084FF;
		border: none;
		position: absolute;
		right: 6px;
		bottom: 6px;
		padding: 0 16px;
		font-size: 14px;
		line-height: 32px;
		text-align: center;
		cursor: pointer;
		border-radius: 3px;
		width: 86px;
		outline: none;
		transition: all 0.25s ease;
	}


	.comment-footer .submitting {
		position: absolute;
		right: 33px;
		bottom: 6px;
		width: 32px;
		height: 32px;
		border-radius: 50%;
		border: 2px solid #0084FF;
		cursor: pointer;
		transition: all 0.25s ease;
		border-color: #bbbbbb;
		border-width: 3px;
		border-left-color: #0084FF;
		-webkit-animation: rotating 2s 0.25s linear infinite;
		animation: rotating 2s 0.25s linear infinite;
		font-size: 0;
		padding: 0;
		background-color: transparent;
	}

	@-webkit-keyframes rotating {
		from {
			-webkit-transform: rotate(0deg);
			transform: rotate(0deg);
		}

		to {
			-webkit-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}

	@keyframes rotating {
		from {
			-webkit-transform: rotate(0deg);
			transform: rotate(0deg);
		}

		to {
			-webkit-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}

</style>

<style>
	#loading-comments {
		display: none;
		margin: 6px auto 0 auto;
		height: 60px;
		text-align: center;
		line-height: 60px;
		background-image: url(https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/disqus-preloader.svg);
		background-position: center;
		background-repeat: no-repeat;
		background-size: auto 100%;
	}

	.comment-wrap {
		position: relative;
		padding: 6px;
		margin: 6px;
		min-height: 50px;
		border-top: 1px solid #e5e9ef
	}

	.comment-wrap:before {
		content: none
	}

	.comment-wrap .center {
		text-align: center;
		padding: 40px 0 10px
	}

	.comment-wrap .center i {
		font-size: 24px;
		vertical-align: -4px
	}

	.comment-part.giligili-item {
		overflow: visible
	}

	.comment-item {
		list-style: none
	}

	.comment-item .commentator-avatar {
		float: left;
		width: 50px;
		margin-top: 20px;
		position: relative
	}

	.comment-item .commentator-avatar img {
		border-radius: 50%;
		width: 50px
	}

	.comment-item .commentator-avatar .icon-big-vip {
		display: none
	}

	.comment-item.administrator>.commentator-avatar .icon-big-vip,
	.comment-item.editor>.commentator-avatar .icon-big-vip,
	.comment-item.author>.commentator-avatar .icon-big-vip,
	.comment-item.contributor>.commentator-avatar .icon-big-vip,
	.comment-item.subscriber>.commentator-avatar .icon-big-vip {
		display: block
	}

	.comment-item .commentator-avatar .icon-big-vip {
		position: absolute;
		left: 36px;
		top: 34px;
		color: #ff6599;
		background: #fff;
		border-radius: 50%
	}

	.comment-item .children .commentator-avatar .icon-big-vip {
		left: 16px;
		top: 16px;
		font-size: 12px
	}

	.comment-item .commentator-comment .commentator-name a {
		color: #6d757a
	}

	.comment-item .commentator-comment .commentator-name a:hover {
		color: #00a1d6
	}

	.comment-item.administrator>.commentator-comment .commentator-name a,
	.comment-item.editor>.commentator-comment .commentator-name a,
	.comment-item.author>.commentator-comment .commentator-name a,
	.comment-item.contributor>.commentator-comment .commentator-name a,
	.comment-item.subscriber>.commentator-comment .commentator-name a {
		color: #fb7299
	}

	.comment-wrap .commentator-comment {
		padding: 14px 0;
		margin-left: 70px
	}

	.comment-wrap>.comment-item,
	.new-comment .comment-item {
		border-bottom: 1px solid #e5e9ef
	}

	.comment-item .commentator-comment .commentator-name {
		font-size: 14px;
		font-weight: bold;
		line-height: 18px;
		padding-bottom: 4px;
		display: inline-block;
		word-wrap: break-word
	}

	.comment-item .commentator-comment .commentator-name a {
		text-decoration: none
	}

	.comment-item .commentator-comment .iconfont {
		font-size: 20px;
		vertical-align: -2px
	}

	.comment-item .commentator-comment .icon-user-level-0 {
		color: #BFBFBF
	}

	.comment-item .commentator-comment .icon-user-level-1 {
		color: #BFBFBF
	}

	.comment-item .commentator-comment .icon-user-level-2 {
		color: #95DDB2
	}

	.comment-item .commentator-comment .icon-user-level-3 {
		color: #92D1E5
	}

	.comment-item .commentator-comment .icon-user-level-4 {
		color: #FFB37C
	}

	.comment-item .commentator-comment .icon-user-level-5 {
		color: #FF6C00
	}

	.comment-item .commentator-comment .icon-user-level-6 {
		color: #FF0000
	}

	.comment-item .commentator-comment .comment-chat {
		line-height: 20px;
		padding: 2px 0;
		font-size: 14px;
		text-shadow: none;
		overflow: hidden;
		word-wrap: break-word
	}

	.comment-item .commentator-comment .comment-chat p {
		margin: 0
	}

	.comment-item .commentator-comment .comment-chat img {
		max-width: 100%
	}

	.comment-respond .login-must {
		margin: 10px 0
	}

	.comment-respond .login-must a,
	.comment-item .commentator-comment .comment-chat .comment-comment .edit-info .comment-reply-link {
		font-weight: bold
	}

	.comment-item .commentator-comment .comment-chat .comment-comment .comment-info span,
	.comment-item .commentator-comment .comment-chat .comment-comment .comment-info a {
		color: #99a2aa;
		text-decoration: none;
		line-height: 26px;
		font-size: 12px;
		border-radius: 4px;
		display: inline-block
	}

	.comment-item .commentator-comment .comment-chat .comment-comment .comment-info .comment-reply-link {
		padding: 0 5px
	}

	.comment-item .commentator-comment .comment-chat .comment-comment .comment-info .comment-reply-link:hover {
		color: #00a1d6;
		background: #e5e9ef
	}

	.comment-item .commentator-comment .comment-chat .comment-comment .comment-info>span {
		margin-right: 20px
	}

	.comment-item .commentator-comment .comment-chat .comment-comment .comment-info .post-like a:hover,
	.comment-item .commentator-comment .comment-chat .comment-comment .comment-info .post-like a:hover span {
		color: #61c1e4
	}

	.comment-wrap>.comment-item>.children {
		margin-left: 70px;
		padding: 0
	}

	.comment-wrap>.comment-item>.children .children {
		padding-inline-start: 0px;
	}

	.comment-wrap>.comment-item>.children .comment-item .commentator-comment {
		margin-left: 35px
	}

	.comment-wrap>.comment-item>.children .comment-item .commentator-avatar {
		width: 25px;
		margin-top: 0
	}

	.comment-wrap>.comment-item>.children .comment-item .commentator-avatar img {
		width: 25px;
		height: 25px
	}

	.comment-wrap>.comment-item>.children .comment-item .commentator-comment {
		padding: 0 0 14px
	}

</style>
