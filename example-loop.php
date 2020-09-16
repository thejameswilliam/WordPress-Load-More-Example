<?php
if(have_posts()) :
  echo '<div id="posts-container">';
    while (have_posts()) : the_post();
      get_template_part( 'loop' );
    endwhile;
  echo '</div>';
  echo '<button class="load-more-posts">Load More</button>';
else :
  echo '<h3>No Searches Found</h3>';
endif;
