<?php
/**
 * Template Name: Custom Template
 */
?>


<!-- Bootstrap Core CSS -->

<!-- Custom CSS -->

<link href="<?php bloginfo('template_url'); ?>/css/videotemp.css" rel="stylesheet">

<!-- Morris Charts CSS -->


<!-- Custom Fonts -->


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>


<![endif]-->
<script>

    angular_app.controller('PostController', ['$scope', '$http', '$sce', function ($scope, $http, $sce) {
        $scope.showWelcomeNote = true;
        $scope.comp = [];

        $http.get('/wp-json/wp/v2/tasks?filter[posts_per_page]=-1').success(function (res) {
            $scope.tasks = res;
            i = $scope.tasks.length;
            i = i - 1;
            $scope.title = $sce.trustAsHtml($scope.tasks[i].title.rendered);
            $scope.id = $scope.tasks[i].id;
            $scope.pid = null;
            $scope.nid = $scope.id + 1;
            $scope.content = $sce.trustAsHtml($scope.tasks[i].content.rendered);
            $scope.drop = "-311";
            $scope.link = $scope.tasks[i].link;
            $scope.comp[$scope.link] = true;
            $scope.video = $scope.tasks[i].vid;
            $scope.vids = $sce.trustAsHtml("<video  class='video-js vjs-default-skin' controls preload='none' data-setup='[]'><source src=" + $scope.video[0] + " type='video/mp4' /></video>");
        });

        $scope.load = function (url) {
            $http.get('/wp-json/wp/v2/tasks?filter[posts_per_page]=-1').success(function (res) {
                $scope.tasks = res;
                $scope.len = $scope.tasks.length;
                i = 0;
                while (url !== $scope.tasks[i].link) {
                    i++;
                }

                $scope.title = $sce.trustAsHtml($scope.tasks[i].title.rendered);
                $scope.id = $scope.tasks[i].id;
                if (i !== $scope.len - 1) {
                    $scope.pid = $scope.id - 1;
                }
                else {
                    $scope.pid = null;
                }
                if (i !== 0) {
                    $scope.nid = $scope.id + 1;
                }
                else {
                    $scope.nid = null;
                }
                $scope.link = $scope.tasks[i].link;
                $scope.comp[$scope.link] = true;
                $scope.content = $sce.trustAsHtml($scope.tasks[i].content.rendered);
                $scope.video = $scope.tasks[i].vid;
                $scope.vids = $sce.trustAsHtml("<video  class='video-js vjs-default-skin'  controls preload='none' data-setup='[]'><source src=" + $scope.video[0] + " type='video/mp4' /></video>");
            });
        };
        $scope.open = function (drop) {
            $scope.drop = drop;
        }

        $scope.goTo = function (id) {
            if (id !== null) {
                $http.get('/wp-json/wp/v2/tasks?filter[posts_per_page]=-1').success(function (res) {
                    $scope.tasks = res;
                    $scope.len = $scope.tasks.length;
                    i = 0;
                    while (id !== $scope.tasks[i].id) {
                        i++;
                    }
                    $scope.title = $sce.trustAsHtml($scope.tasks[i].title.rendered);
                    $scope.id = $scope.tasks[i].id;
                    if (i !== $scope.len - 1) {
                        $scope.pid = $scope.id - 1;
                    }
                    else {
                        $scope.pid = null;
                    }
                    if (i !== 0) {
                        $scope.nid = $scope.id + 1;
                    }
                    else {
                        $scope.nid = null;
                    }
                    $scope.link = $scope.tasks[i].link;
                    $scope.comp[$scope.link] = true;
                    $scope.content = $sce.trustAsHtml($scope.tasks[i].content.rendered);
                    $scope.video = $scope.tasks[i].vid;
                    $scope.vids = $sce.trustAsHtml("<video  class='video-js vjs-default-skin'  controls preload='none' data-setup='[]'><source src=" + $scope.video[0] + " type='video/mp4' /></video>");
                });
            }
        };


    }]);
</script>

<div id="wrapper" ng-app="wpAngularPlugin">
    <div ng-controller="PostController">
        <div class="blog-masthead">
            <div class="container">
                <nav class="blog-nav">
                    <?php wp_nav_menu(array('menu' => 'Video', 'menu_class' => 'blog-menu navbar-nav nav')); ?>
                </nav>
            </div>
        </div>

        <div class="container">

            <div class="row">

                <div class="col-sm-3 blog-sidebar">
                    <div class="sidebar-module sidebar-module-inset" ng-show="showWelcomeNote">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                data-ng-click="showWelcomeNote = false">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4>Welcome</h4>

                        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit
                            amet
                            fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                    </div>


                    <!-- Navigation -->
                    <div class="sidebar-module">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                            <!-- Brand and toggle get grouped for better mobile display -->

                            <!-- Top Menu Items -->

                            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

                            <?php

                            $menu_name = 'Tasks';


                            $menu = wp_get_nav_menu_object($menu_name);

                            $menu_items = wp_get_nav_menu_items($menu->term_id);
                            if (isset($menu_items)) { ?>

                                <?php
                                $count = 0;
                                $submenu = false;

                                foreach ($menu_items as $item):
                                    // set up title and url
                                    $title = $item->title;
                                    $link = $item->url;

                                    // item does not have a parent so menu_item_parent equals 0 (false)
                                    if (!$item->menu_item_parent):

                                        // save this id for later comparison with sub-menu items
                                        $parent_id = $item->ID;
                                        ?>

                                        <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a role="button" ng-click=open(menu-<?php echo $parent_id; ?>)
                                                   data-toggle="collapse" data-parent="#accordion"
                                                   href="#menu-<?php echo $parent_id; ?>"
                                                   aria-expanded="true" aria-controls="menu-<?php echo $parent_id; ?>">
                                                    <?php echo $title; ?>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="menu-<?php echo $parent_id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" ng-class="{'in': (drop == menu-<?php echo $parent_id; ?>)}">
                                    <?php endif; ?>
                                    <?php if ($parent_id == $item->menu_item_parent): ?>
                                    <?php if (!$submenu):
                                        $submenu = true; ?>
                                        <div class="panel-body">
                                        <ul class='progress-indicator stacked'>
                                    <?php endif; ?>
                                    <li class="lesson-item" ng-class='{completed: (comp["<?php echo $link ?>"])}'>
                                        <span class="bubble lesson-bubble"></span>
                                        <span class="stacked-text lesson-stacked-text">
                                            <a style="cursor:pointer;"
                                               ng-click=load("<?php echo $link ?>")><?php echo $title; ?></a></span>
                                    </li>
                                    <?php if ($menu_items[$count + 1]->menu_item_parent != $parent_id && $submenu): ?>
                                        </ul>
                                        </div>
                                        <?php $submenu = false;
                                    endif; ?>

                                <?php endif; ?>
                                    <?php if ($menu_items[$count + 1]->menu_item_parent != $parent_id): ?>

                                    </div></div>

                                    <?php $submenu = false;
                                endif; ?>

                                    <?php $count++; endforeach; ?>


                            <?php } else { ?>
                                <ul>
                                    <li>Menu "' . $menu_name . '" not defined.</li>
                                </ul>
                            <?php }
                            ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-8 blog-main">


                    <div class="blog-post">
                        <nav>
                            <ul class="pager">
                                <li ng-click="goTo(pid)" ng-class="{disabled: (pid == null)}">
                                    <a>Previous</a>
                                </li>
                                <li ng-click="goTo(nid)"
                                    ng-class="{disabled: nid == null}">
                                    <a>Next</a>
                                </li>
                            </ul>
                        </nav>

                        <h2 class="blog-post-title" ng-bind-html="title"></h2>

                        <div ng-bind-html="vids"></div>
                        <div class="tcontent" ng-bind-html="content"></div>
                        <nav>
                            <ul class="pager">
                                <li ng-click="goTo(pid)" ng-class="{disabled: (pid == null)}">
                                    <a>Previous</a>
                                </li>
                                <li ng-click="goTo(nid)"
                                    ng-class="{disabled: nid == null}">
                                    <a>Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /#page-wrapper -->
            </div>

        </div>
    </div>
</div>
<!-- /#wrapper -->

<!-- jQuery -->


<!-- Bootstrap Core JavaScript -->
<footer class="site-footer section-spacing text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <!-- <p class="footer-links"><a href="">Terms of Use</a> <a href="">Privacy Policy</a></p> -->
            </div>
            <div class="col-md-4">
                <small>&copy; 2015 Help for Trauma. All rights reserved.</small>
            </div>
            <div class="col-md-4">

                <!-- ssl cert -->

                <span id="siteseal"><script type="text/javascript"
                                            src="https://seal.godaddy.com/getSeal?sealID=kmhZ5ZUtK8dGPH94uawPLv6QbIWjCxRLlZRzVrgPp9YNQW4PyywL3dZ3NKPr"></script></span>

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




