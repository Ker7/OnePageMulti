<?php
echo '<div id="swrap">'
      .'<div class="swrappet">'
        .'<div class="sheader">'

          .'<a href="'.get_home_url().'"><div class="logodiv"></div></a>'
          .''
          .'<h1>'.$postTitle.'</h1>'
        .'</div>'
        .'<div class="sbody">'


        .''.apply_filters( 'the_content', $post->post_content )

        .'</div>'

      .'</div>'
    .'</div>';
echo '</div>';
