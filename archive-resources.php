<?php get_header();
?>

<?php
  $separator = ', ';
  $r_topics = get_terms(['taxonomy' => 'media_topic', 'hide_empty' => true]);//'exclude'=>array('archive, educational-psa')

  $r_topic = '';
  foreach ($r_topics as $t) {
    $r_topic .= '"'.$t->name.'"'.$separator;
  }

  //Get page titles from all of our posts
  $r_types = get_terms(['taxonomy' => 'media_type', 'hide_empty' => false]);
  $r_type = '';
  foreach ($r_types as $rt) {
    $r_topic .= '"'.$rt->name.'"'.$separator;
  }

  $args2 = array(
  'post_type' => 'resources',
  'posts_per_page' => -1,
  //'meta_key' => 'event_start_date',
  // 'orderby' => 'post_date',
  // 'order' => 'DESC',
  'paged'=>$paged
  );

  $page_titles = wp_list_pluck( get_pages($args2), 'post_title' );
  var_dump($page_titles);

  $titles='';
  foreach($page_titles as $title){
    $titles .= '"'.addslashes($title).'"'.$separator;
  }

  $r_excerpt = '';

  $query = new WP_Query( $args2 );

  if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();

      $content = the_content();
      //$excerpt = get_field('custom_excerpt');
      $excerpt = get_post_meta(get_the_ID(), 'custom_excerpt');
      //var_dump($excerpt);

      foreach($excerpt as $e){
        //$e_desc.='"'.addslashes($desc).'"'.$separator;
        $f_excerpt .= $e.' ';

        //$e_desc = implode($e_desc);
      }

  endwhile; endif; wp_reset_postdata();
  //Split up and clean the paragraph content
  $remove = array('.', '!', ',', '?', '\n', '\r', "\r\n", 'and', 'the', 'in', 'on', 'a', 'but');
  $r_excerpt = str_replace($remove,'', $r_excerpt);
  //var_dump($f_excerpt);
  $r_excerpt = explode(' ', addslashes($f_excerpt));
  $f_excerpt = array_unique($f_excerpt);

  //Loop through our content and add it to an array
  $exc = '';
  foreach($f_excerpt as $e){
    if($e != ''){
      $exc .='"'.$e.'"'.$separator;
    }
  }
?>

<script>
var rc_choices = [];
rc_choices.push(<?php echo $r_topic.$r_type.$titles; ?>);

</script>

 <?php
   $background_img = get_field('r_background_image', 'options');
   $background_image_url = $background_img['sizes']['short-banner'];
   $v_ogg = get_field('r_video_ogg', 'options');
   $vo_url = $v_ogg['url'];
   $v_mp4 = get_field('r_video_mp4', 'options');
   $vm_url = $v_mp4['url'];
   $v_webm = get_field('r_video_webm', 'options');
   $vw_url = $v_webm['url'];
   $l_page_callout = get_field('r_banner_callout_text', 'options');
   $title = get_field('r_page_title', 'options');
   $archive_title = post_type_archive_title('',false);
   $page_title = '';
   if($title != '' ){
    $page_title = $title;
   }else{
    $page_title = $archive_title;
   }
?>
<div class="welcome-gate interior" style="background-image:url('<?php echo $background_image_url; ?>">
   <!-- <img src="<//?php echo get_template_directory_uri(); ?>/img/everymothercounts_logo_primary_white_40in.png" alt=""> -->
   <?php if ($vm_url == '' && $vo_url == '' && $vw_url == ""){ ?>
   <div class="welcome-gate-bg" style="background-image:url('<?php echo $background_image_url; ?>');"></div>
   <?php } ?>
   <div class="banner-text columns-5 offset-by-1">
      <p class="top-callout"><?php echo $page_title; ?></p>
      <h1 class="page-title heading1"><?php echo $l_page_callout; ?></h1>
   </div>
   <div class="overlay" aria-hidden="true"></div>
   <?php if ($vm_url != '' && $vo_url != '' && $vw_url != ""){ ?>
      <video placeholder="<?php echo $background_image_url; ?>" autoplay="true" loop="true" muted="true" playsinline>
         <source src ="<?php echo $vm_url; ?>" autoplay="true" loop="true" muted="true" playsinline>
         <source src ="<?php echo $vo_url; ?>" autoplay="true" loop="true" muted="true" playsinline>
         <source src ="<?php echo $vw_url; ?>" autoplay="true" loop="true" muted="true" playsinline>
      </video>
   <?php } ?>
</div>

<main id="content" class="landing">
<div class="panel filters">
   <div class="container">
      <div class="row">
         <div class="columns-10 offset-by-1">
            <ul>
               <li>
                  <p>Explore our resources:</p>
               </li>
               <li class="filter">
                  <a class="filter-trigger" id="topicTrigger">
                     <p>Filter by topic</p>
                     <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
                        <style type="text/css">
                           .st0{fill:#EED9BD;}
                           .st1{fill:#EC742E;}
                        </style>
                        <polygon class="st1" points="71.9,50.7 71.9,50.7 65.6,44.4 65.6,44.4 34.1,12.9 28.3,18.8 59.7,50.2 28.1,81.8 34.4,88.2
                           39.3,83.3 66,56.5 71.9,50.7 "/>
                     </svg>
                  </a>
               </li>
               <li class="filter">
                  <a class="filter-trigger" id="locationTrigger">
                     <p>Filter by media</p>
                     <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
                        <style type="text/css">
                           .st0{fill:#EED9BD;}
                           .st1{fill:#EC742E;}
                        </style>
                        <polygon class="st1" points="71.9,50.7 71.9,50.7 65.6,44.4 65.6,44.4 34.1,12.9 28.3,18.8 59.7,50.2 28.1,81.8 34.4,88.2
                           39.3,83.3 66,56.5 71.9,50.7 "/>
                     </svg>
                  </a>
               </li>
               <li class="filter">
                  <a class="filter-trigger" id="searchTrigger">
                     <p>Search</p>
                     <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
                        <style type="text/css">
                           .st0{fill:#EED9BD;}
                           .st1{fill:#EC742E;}
                        </style>
                        <polygon class="st1" points="71.9,50.7 71.9,50.7 65.6,44.4 65.6,44.4 34.1,12.9 28.3,18.8 59.7,50.2 28.1,81.8 34.4,88.2
                           39.3,83.3 66,56.5 71.9,50.7 "/>
                     </svg>
                  </a>
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<div class="filter-bar">
   <div class="panel topics">
      <div class="">
         <div class="row">
            <div class=""><!-- columns-10 offset-by-1 -->
               <button class="arrow-up">
                  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
                    <style type="text/css">
                      .st0{fill:#EED9BD;}
                      .st1{fill:#EC742E;}
                    </style>
                    <polygon class="st1" points="71.9,50.7 71.9,50.7 65.6,44.4 65.6,44.4 34.1,12.9 28.3,18.8 59.7,50.2 28.1,81.8 34.4,88.2
                      39.3,83.3 66,56.5 71.9,50.7 "/>
                  </svg>
               </button>
               <button class="arrow-down">
                  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
                    <style type="text/css">
                      .st0{fill:#EED9BD;}
                      .st1{fill:#EC742E;}
                    </style>
                    <polygon class="st1" points="71.9,50.7 71.9,50.7 65.6,44.4 65.6,44.4 34.1,12.9 28.3,18.8 59.7,50.2 28.1,81.8 34.4,88.2
                      39.3,83.3 66,56.5 71.9,50.7 "/>
                  </svg>
               </button>
               <ul class="scrollable r-topic-filters scroller">
                  <li data-filter="">All</li>
                  <?php
                           //$categories='';
                           //$separator=", ";
                           // $terms = get_terms([
                           //     'taxonomy' => 'category',
                           //     'hide_empty' => true,
                           // ]);

                           $resource_topics = get_terms(['taxonomy' => 'media_topic', 'hide_empty' => true]);

                           //var_dump($terms);
                              foreach ($resource_topics as $topic) {?>

                                <li data-filter="<?php echo $topic->slug; ?>"><?php echo $topic->name ?></li>
                        <?php } ?>

               </ul>
            </div>
         </div>
      </div>
   </div>
   <div class="panel locations">
      <div class="">
         <div class="row">
            <div class=""><!-- columns-10 offset-by-1 -->
               <button class="arrow-up">
                  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
                    <style type="text/css">
                      .st0{fill:#EED9BD;}
                      .st1{fill:#EC742E;}
                    </style>
                    <polygon class="st1" points="71.9,50.7 71.9,50.7 65.6,44.4 65.6,44.4 34.1,12.9 28.3,18.8 59.7,50.2 28.1,81.8 34.4,88.2
                      39.3,83.3 66,56.5 71.9,50.7 "/>
                  </svg>
               </button>
               <button class="arrow-down">
                  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
                    <style type="text/css">
                      .st0{fill:#EED9BD;}
                      .st1{fill:#EC742E;}
                    </style>
                    <polygon class="st1" points="71.9,50.7 71.9,50.7 65.6,44.4 65.6,44.4 34.1,12.9 28.3,18.8 59.7,50.2 28.1,81.8 34.4,88.2
                      39.3,83.3 66,56.5 71.9,50.7 "/>
                  </svg>
               </button>
               <ul class="scrollable r-type-filters scroller">
                  <li data-filter="">All</li>
                  <?php
                          //$categories='';
                          //$separator=", ";
                          // $terms = get_terms([
                          //     'taxonomy' => 'category',
                          //     'hide_empty' => true,
                          // ]);

                          $resource_type = get_terms(['taxonomy' => 'media_type', 'hide_empty' => false]);

                          //var_dump($terms);
                             foreach ($resource_type as $type) {?>

                               <li data-filter="<?php echo $type->slug; ?>"><?php echo $type->name ?></li>
                       <?php } ?>
               </ul>
            </div>
         </div>
      </div>
   </div>
   <div class="panel r-search-filter search-filter event-search">
      <div class="container">
         <div class="row">
            <div class="columns-10 offset-by-1">
               <div class="search-wrap">
                  <div class="search-field">
                     <form action="<?php home_url(); ?>" method="get">
                        <label class="sr-only" for="search">Search</label>
                        <input class="" type="text" name="sr" value="" placeholder="Search">
                        <button class="submit">
                           <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                               viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
                              <style type="text/css">
                                 .st9{fill:#70594C;}
                              </style>
                              <polygon class="st9" points="71.9,50.7 71.9,50.7 65.6,44.4 65.6,44.4 34.1,12.9 28.3,18.8 59.7,50.2 28.1,81.8 34.4,88.2
                                 39.3,83.3 66,56.5 71.9,50.7 "/>
                           </svg>
                        </button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
   <div class="panel events resources">
      <div class="container">
         <div class="row">
            <section id="emc-resources">
               <!-- <div class="row event-grid"> -->
                   <?php

                   $args = array(
                     'post_type' => 'resources',
                     'posts_per_page' => 6,
                     //'meta_key' => 'event_start_date',
                     //'orderby' => 'meta_value',
                     //'order' => 'ASC',
                     'paged'=>$paged
                  );
                  $wp_query = new WP_Query( $args );
                  $count = $wp_query->post_count;?>
                  <?php if ($wp_query->have_posts()) :

                  $r_cnt=0;
                  ?>
                  <div class="row event-grid resource-grid">
                  <?php while ($wp_query->have_posts()) : $wp_query->the_post();
                     $r_cnt++;
                     $div_class='';
                     $icon = get_field('resource_icon');
                     $icon_url = $icon['sizes']['medium'];
                     $icon_alt = $icon['alt'];
                     //$event_desc = get_field('event_description');
                     //$event_loc = get_field('event_location');
                     //$event_start = get_field('event_start_date');
                     //$event_sd = date('F j, Y', $event_start);
                     //$event_end = get_field('event_end_date');
                     //$event_link_text = get_field('el_text');
                     $resource_link = get_field('resource_link');
                     $external = get_field('external');
                     $event_tax = get_the_terms(get_the_ID(),'event_topic');

                     $r_type = get_the_terms(get_the_id(), 'media_type')[0]->name;
                     //$r_type = $r_types['media_type']['name'][0];
                     $topic_name='';
                     if($event_tax != ''){
                        foreach($event_tax as $topic){
                           $topic_name = $topic->name;
                        }
                     }
                     $target = '';
                     if($external == true){
                        $target='target="_blank"';
                     }

                     if($r_cnt % 2 != 0){
                        $div_class = 'offset-by-1';
                     }

                     if($r_cnt %2 == 0){
                        //echo '</div><div class="row event-grid">';
                     }


                       $categories='';
                       $separator=", ";
                       $media_terms = get_the_terms(get_the_ID(), 'media_topic');
                       if($media_terms != ''){
                         foreach ($media_terms as $cat) {
                            $categories .= $cat->name . $separator;
                         }
                       }


                  ?>
                     <div class="columns-5 card <?php echo $div_class; ?>">
                        <div class="row">
                           <div class="resource-columns-3">
                              <img style="max-width:100%;" src="<?php echo $icon_url; ?>" alt="<?php echo $icon_alt; ?>">
                           </div>
                           <div class="resource-columns-7">
                             <p class="heading6 date"><?php echo rtrim($categories, $separator); ?></p>
                             <p class="title">
                               <a href="<?php echo $resource_link; ?>" target="_blank">
                                 <span class="category"><?php echo $r_type; ?>:</span> <?php the_title(); ?>
                                   <!-- <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                   viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
                                     <style type="text/css">
                                     .st0{fill:#EED9BD;}
                                     .st1{fill:#EC742E;}
                                     </style>
                                     <polygon class="st1" points="71.9,50.7 71.9,50.7 65.6,44.4 65.6,44.4 34.1,12.9 28.3,18.8 59.7,50.2 28.1,81.8 34.4,88.2
                                     39.3,83.3 66,56.5 71.9,50.7 "/>
                                   </svg> -->
                               </a>
                             </p>
                           </div>
                        </div>
                     </div>
                  <?php
                  if($r_cnt %2 != 0){
                     //echo '</div>';
                  }
                   if($r_cnt %2 == 0 && $r_cnt != $count){
                        echo '</div><div class="row event-grid resource-grid">';
                     }elseif($r_cnt == $count){
                      echo '</div>';
                     }

                     endwhile;
                  ?>
                   <!-- </div> --> <!--end row-->
               <?php endif;  wp_reset_postdata();?>

            </section>
         </div>
   <nav class="load_more">
            <?php next_posts_link( 'Load More' ); ?>
          </nav>


         <script type="text/javascript">
              //Move this to the mesh.js file
           jQuery(document).ready(function($){

              jQuery('.load_more a').live('click', function(e){
                 e.preventDefault();
                 var link = jQuery(this).attr('href');
                 //console.log(link+);
                 $('.load_more a').text('Loading More Posts...');
                 $.get(link, function(data) {
                    var post = $("#emc-resources .row.resource-grid ", data);
                    console.log(post);
                    $('#emc-resources').append(post);
                 });
                 $('.load_more').load(link+' .load_more a');
                 //var url = link;

              });
           });
         </script>
      </div>
   </div>
</main><!-- End of Content -->

<?php get_footer(); ?>
