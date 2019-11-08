
<header class="animated" data-animate="onload bounceInDown">
    <div id="header-layer-top" class="header-layer-top">
        <div class="header-logo">
            <img src="<?php echo get_template_directory_uri() ?>/assets/image/logo.png">
        </div>
        <div class="nav-container">
            <nav><a href="<?php echo get_home_url() ?>">Home</a> / Archive / Link / About</nav>
            <div class="nav-search"><i class="fa fa-search" aria-hidden="true"></i></div>
            <div class="nav-user-avatar">
                <img src="<?php echo get_template_directory_uri() ?>/assets/image/avatar.jpg">
            </div>
        </div>
    </div>
    
    <?php if( is_single() ): ?>
    
    <div id="header-layer-bottom" class="header-layer-bottom">
        <div class="left">
            <p><?php the_title() ?></p>
        </div>
        <div class="right">
            <div class="button-container">
                <!--<span><a href="./"><i class="fa fa-home" aria-hidden="true"></i> Home</a></span>-->
                <span id="open-read-mode"><i class="fa fa-eye" aria-hidden="true"></i> Read Mode</span>
                <span id="nav-go-top">Go Top</span>
            </div>
        </div>
    </div>
    
    <?php endif ?>
    
</header>