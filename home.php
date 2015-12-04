<?php
/**
 * Template Name: Home
 */
?>


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
<section class="benefits section-spacing text-center" id="features">
  <div class="container">
    <header class="section-header">
     <h2>There is Help for Trauma</h2>
      <h3>Solutions for survivors, voice hearers, and therapists</h3>
    </header>
    <div class="row">
      <?php
$args = array( 'category' => 4, 'order' => 'ASC', 'orderby' => 'post_date', 'numberposts' => 3);

$myposts = get_posts( $args );

foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
	      <div class="col-sm-4">
	      <?php the_post_thumbnail(); ?>
        <h4><?php the_title(); ?></h4>
<?php the_content(); ?>
      </div>
<?php endforeach; 
wp_reset_postdata();?>
    </div>
  </div>
</section>

<!--benefits end--> 

<!--Features-->

<div class="features section-spacing">
  <div class="container"> 
     <?php
$args = array( 'category' => 3, 'order' => 'ASC', 'orderby' => 'post_date', 'numberposts' => 3 );

$myposts = get_posts( $args );
$i=0;
foreach ( $myposts as $post ) : setup_postdata( $post ); $i++;?>
<div class="row">
	 <div class="fimg col-md-7 <?php if($i%2!=0) { echo 'col-md-push-5 '; } ?> text-center"> <?php the_post_thumbnail(); ?></div>
      <div class="col-md-5 <?php if($i%2!=0){echo 'col-md-pull-7'; } ?>">
        <article>
		<h2><?php the_title(); ?></h2>
		<?php the_content(); ?>
	</article>
      </div>
</div>
<?php endforeach; 
wp_reset_postdata();?>
  </div>
</div>

<!--Features end--> 
<!--Team-->

<section class="team section-spacing text-center" id="team">
  <div class="container">
    <header class="section-header">
      <h2>Meet The Team</h2>
      <h3>Pioneers of HopeForTrauma.com</h3>
    </header>
    <div class="row">
      <?php
      $i=0;
      $args = array( 'category' => 5, 'order' => 'ASC', 'orderby' => 'post_date', 'numberposts' => 3);
$myposts = get_posts( $args );
foreach ( $myposts as $post ) : $i++; setup_postdata( $post ); ?>
	   <div class="col-sm-4 <?php if($i==1){echo 'col-sm-offset-2';}?>">
        <div class="team-details">
               <?php the_content(); ?>
           </div>
        </div>
<?php endforeach; 
wp_reset_postdata();?>
      </div>
      
    </div>
  </div>
</section>

<!--Team end--> 
<!--Video section-->

<section class="video-tour text-center">
  <div class="play-btn"> <a href="https://www.youtube.com/watch?v=PVYlZ7WijJY" class="play litebox-tour"><img src="<?php bloginfo('template_url'); ?>/img/play-btn-vs.png" alt="play"></a>
    <h2>Misdiagnosis is Common</h2>
  </div>
  
  <!--HTML5 Video-->
  <video autoplay loop muted id="bgvid" poster="<?php bloginfo('template_url'); ?>/video/poster.jpg">

  </video>
  <!--HTML5 Video end--> 
  
</section>

<!--Video section end--> 

<!--Tour-->

<section class="tour section-spacing text-center">
  <div class="container">
    <div class="row">
      <div class="col-md-8 center-block">
        <h2>Learn More About our Process <a href="http://eepurl.com/bC8TZ5" class="btn" target="_blank">Register for Videos <i class="fa fa-arrow-right"></i></a></h2>
      </div>
    </div>
  </div>
</section>

<!--Tour end--> 

<!--reviews-->

<section class="reviews section-spacing" id="reviews">
  <div class="container">
    <header class="section-header text-center">
      <h2>Testimonials</h2>
      <h3>Substiantial Gains from the ITR Model</h3>
    </header>
    <div class="row">
<?php
$args = array( 'category' => 2, 'order' => 'ASC', 'orderby' => 'post_date', 'numberposts' => 3);
$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
	<div class="col-sm-4"> 
        <figure class="text-center"><?php the_post_thumbnail(); ?> </figure>
<blockquote>
<?php the_content(); ?>
          <cite>—<?php the_title(); ?></cite> </blockquote>
      </div>
<?php endforeach; 
wp_reset_postdata();?>
      </div>
</section>

<!--reviews end--> 




<!--contact us-->

<section class="contact section-spacing text-center" id="contact">
  <div class="container">
    <header class="section-header">
      <h2>Contact Us</h2>
             <?php
$args = array( 'category' => 6);
$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
	<h3><?php the_content(); ?></h3>
<?php endforeach; 
wp_reset_postdata();?>
    </header>
  </div>
  

  
</section>
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

<!--contact us end--> 