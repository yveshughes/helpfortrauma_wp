<?php while (have_posts()) : the_post(); ?>
<?php if(get_post_type() == "tasks") {?>
    <link href="<?php bloginfo('template_url'); ?>/css/videotemp.css" rel="stylesheet">
    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <?php wp_nav_menu(array('menu' => 'Video', 'menu_class' => 'blog-menu navbar-nav nav')); ?>
        </nav>
      </div>
    </div>
<?php } else {?>
    <header class="hero-section">



      <nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a class="navbar-brand" href=""><img class="logo-nav" alt="logo" src="<?php bloginfo('template_url') ?>/img/logo-nav.png"><img class="logo-head" alt="logo" src="<?php bloginfo('template_url') ?>/img/logo-head.png"></a> </div>
          <div class="collapse navbar-collapse" id="bs-navbar-collapse-1">
            <?php
            if (has_nav_menu('primary_navigation')) :
              wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav nav-left'));
            endif;
            ?>
            <ul class="nav navbar-nav navbar-right">

              <li><a href="http://eepurl.com/bC8TZ5" class="btn" target="_blank">Register for free Videos!</a></li>
            </ul>
          </div>
        </div>
      </nav>

      <!--navigation end-->

      <!--welcome message-->

      <section class="container text-center welcome-message">
        <div class="row">
          <div class="col-md-12">
            <h1>Trauma Can Be Healed</h1>
            <h2>  &nbsp;
              &nbsp;
            </h2>
            <li><a href="http://eepurl.com/bC8TZ5" class="btn" target="_blank">Register for free Videos!</a></li>
            </br></br></br>


            <!-- <div class="play-btn"> <a href="https://vimeo.com/109054393" class="play litebox-hero"><img src="img/play-btn.png" alt="play"></a> </div> -->
            <!-- <div class="cta-btn"> <a href="#" class="btn">GET STARTED</a> -->
            <!-- <p><span class="total-number-1">0</span>K Worldwide Signups</p> -->
          </div>
        </div>
        </div>
      </section>

      <!--welcome message end-->

    </header>
<?php } ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
      <?php
      // Retrieves the stored value from the database
      $meta_value = get_post_meta( get_the_ID(), 'vid', true );

      // Checks and displays the retrieved value
      if( !empty( $meta_value ) ) {
        echo do_shortcode('[videojs mp4="'.$meta_value.'"]');
      }
      the_content();

      $array=array('title'=> $title,'content'=> $content,'video'=>'$meta_value');
      return $array;
      ?>
    </div>
    <footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>')); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
<footer class="site-footer section-spacing text-center">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <!-- <p class="footer-links"><a href="">Terms of Use</a> <a href="">Privacy Policy</a></p> -->
      </div>
      <div class="col-md-4"> <small>&copy; 2015 Help for Trauma. All rights reserved.</small></div>
      <div class="col-md-4">

        <!-- ssl cert -->

        <span id="siteseal"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=kmhZ5ZUtK8dGPH94uawPLv6QbIWjCxRLlZRzVrgPp9YNQW4PyywL3dZ3NKPr"></script></span>

        <!-- end ssl -->
        <!--social

        <ul class="social">
          <li><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a></li>
          <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
          <li><a href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
        </ul>

        <!--social end-->

      </div>
    </div>
  </div>
</footer>