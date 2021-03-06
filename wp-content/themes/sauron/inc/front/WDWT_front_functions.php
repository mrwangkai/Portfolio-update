<?php


class WDWT_frontend_functions{


  public static function the_title_max_charlength($charlength, $title=false) {

    if($title){
    }
    else{
      $title = the_title($before = '', $after = '', FALSE);
    }

    $title_length = mb_strlen($title);
    if($title_length <= $charlength){
      echo $title;
    }
    else{
      $limited_title = mb_substr($title, 0, $charlength);
      echo $limited_title . "...";
    }

  }



  public static function the_excerpt_max_charlength($charlength,$content=false) {
    if($content){
      $excerpt=strip_shortcodes($content);
    }
    else{
      $excerpt = get_the_excerpt();
    }
    $excerpt = strip_tags($excerpt);
    $charlength++;

    if ( mb_strlen( $excerpt ) > $charlength ) {
      $subex = mb_substr( $excerpt, 0, $charlength - 5 );

      $exwords = explode( ' ', $subex );

      $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );

      if ( $excut < 0 ) {
        return mb_substr( $subex, 0, $excut ).'...';
      }
      else {
        return $subex.'...';
      }
    }
    else {
      return str_replace('[&hellip;]','',$excerpt);
    }
  }

  public static function posted_on() {
    printf('<span class="sep date"></span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
      esc_url( get_permalink() ),
      esc_attr( get_the_time() ),
      esc_attr( get_the_date( 'c' ) ),
      esc_html( get_the_date() )
    );
  }

  public static function posted_on_single() {
    printf('<span class="sep date"></span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="by-author"> <span class="sep author"></span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>',
      esc_url( get_permalink() ),
      esc_attr( get_the_time() ),
      esc_attr( get_the_date( 'c' ) ),
      esc_html( get_the_date() ),
      esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
      esc_attr( sprintf( __( 'View all posts by %s', "sauron" ), get_the_author() ) ),
      get_the_author()
    );
  }


  /**
   * ***********************************
   *
   *  GENERETE IMAGE FOR POST THUMBNAIL
   *
   * ***********************************
   */

  /*ttt!!!*/

  public static function display_thumbnail($width, $height){
    /*there is an error in this funciton ttt!!!*/

    if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {
      the_post_thumbnail(array($width, $height));
    }
    elseif (!self::is_empty_thumb()) {
      return self::first_image($width, $height);
    } else {
      /*ttt!!! this function is not defined and never called*/
      return WD_theme_post_thumbnail($width, $height);
    }
  }

  public static function display_thumbnail_bg($width, $height){
    /*there is an error in this funciton ttt!!!*/

    if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {
      $thumb =  wp_get_attachment_url( get_post_thumbnail_id() );
    }
    elseif (!self::is_empty_thumb()) {
      // return self::first_image($width, $height);
      $image_parametr = self::catch_that_image();
      $thumb = $image_parametr['src'];
    } else {
      /*ttt!!! this function is not defined and never called*/
      return WD_theme_post_thumbnail($width, $height);
    }
    echo $thumb;
  }

  public static function thumbnail($width, $height){
    if (function_exists('has_post_thumbnail') && has_post_thumbnail())
      the_post_thumbnail(array($width, $height));
    elseif (self::is_empty_thumb()) {
      return WD_theme_post_thumbnail($width, $height);
    }
    else
      return '';
  }


  /**
   *  Get first image of post for thumbnail
   */

  public static function  catch_that_image(){
    global $post, $posts, $wdwt_front;
    $grab_image = $wdwt_front->get_param('grab_image');

    $first_img = array('src'=>'','image_catched'=>true);

    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

    if(isset($matches [1] [0]) && $grab_image){
      $first_img['src'] = $matches [1] [0];
    }

    if (empty($first_img['src'])) {
      $first_img['src'] = WDWT_IMG.'default.png';
      $first_img['image_catched']=false;
    }
    return $first_img;
  }


  public static function first_image($width, $height,$url_or_img=0){
    $image_parametr = self::catch_that_image();
    $thumb = $image_parametr['src'];
    $class='';
    if(!$image_parametr['image_catched'])
      $class='class="no_image"';
    if ($thumb) {
      $str = "<img src=\"";
      $str .= $thumb;
      $str .= '"';
      $str .= 'alt="'.get_the_title().'" width="'.$width.'" height="'.$height.'" '.$class.' border="0" style="width:'.$width.'; height:'. $height.';" data-s="gago" />';
      return $str;
    }
  }


  public static function is_empty_thumb(){
    $thumb = get_post_custom_values("Image");
    return empty($thumb);
  }





  public static function remove_last_comma($string=''){

    if(substr($string,-1)==',')
      return substr($string, 0, -1);
    else
      return $string;

  }







  /**
   * returns image tag with image
   * for containers of fixed size
   * image fitted, cropped, centered
   */

  public static function fixed_thumbnail($width, $height, $grab_image = true){

    $tumb_id = get_post_thumbnail_id( get_the_ID() );
    $thumb_url = wp_get_attachment_image_src($tumb_id,array($width,$height));
    $thumb_url = $thumb_url[0];
    if($grab_image) {
      if( !$thumb_url ) {
        $thumb_url = self::catch_that_image();
        $thumb_url = $thumb_url['src'];
      }
    }
    if($thumb_url){
      list($w, $h) = getimagesize($thumb_url);
      if($w == 0){
        $w=10;
      }
      if($h == 0){
        $h=10;
      }
      if($h/$w > $height/$width){
        $scale = $width / $w;
        $style_img = 'width:100%; height:auto; max-width:none; left:0; top:'. ( $height/2 - $h/2 * $scale) .'px;';
      }
      else {
        $scale = $height/ $h;
        $style_img = 'height:100%; width:auto; max-width:none; left:'. ( $width/2 -$w/2 * $scale) .'px;';
      }
      return '<img class="wp-post-image" src="'.$thumb_url.'" alt="'.esc_attr(get_the_title()).'" style="'.$style_img.'" />';
    }
    else {
      return '';
    }
  }
  /**
   * returns image tag with image
   * fits width of container
   * height auto
   */

  public static function auto_thumbnail($grab_image = true){
    $tumb_id = get_post_thumbnail_id( get_the_ID() );
    $thumb_url = wp_get_attachment_image_src($tumb_id,'full');
    $thumb_url = $thumb_url[0];
    if($grab_image) {
      if( !$thumb_url ) {
        $thumb_url = self::catch_that_image();
        $thumb_url = $thumb_url['src'];
      }
    }
    if($thumb_url){
      return '<img class="wp-post-image" src="'.$thumb_url.'" alt="'.esc_attr(get_the_title()).'" style="width:100%;" />';
    }
    else {
      return '';
    }
  }

  /**
   *   @return url of first image in the post content, or empty string if has no image
   */

  public static function post_image_url(){

    $thumb_url = self::catch_that_image();
    if(isset( $thumb_url['image_catched'])){
      if(!$thumb_url['image_catched']){
        $thumb_url='';
      }
      else{
        $thumb_url=$thumb_url['src'];
      }
    }

    return $thumb_url;

  }




  public static  function post_nav() {
    global $post;
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next    = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
      return;
    ?>
    <nav class="page-navigation">
      <?php previous_post_link( '%link', '<span class="meta-nav">&larr;</span> %title', _x('Previous post link','', "sauron" ) ); ?>
      <?php next_post_link( '%link',  '%title <span class="meta-nav">&rarr;</span>', _x('Next post link','', "sauron" )  ); ?>
    </nav>
    <?php
  }

  public static function posts_nav($wp_query) {

    ?>
    <nav class="page-navigation">
      <div class="nav-back" style="float:left;">
        <?php next_posts_link( _x('Older entries','', "sauron" ), $wp_query->max_num_pages ); ?>

      </div>
      <div class="nav-forward" style="float:right;">

        <?php previous_posts_link( _x('Newer entries', '', "sauron" ) ); ?>
      </div>
    </nav>
    <?php
  }


  public static function excerpt_more( $more ) {
    return '...';
  }

  public static function remove_more_jump_link($link){
    $offset = strpos($link, '#more-');
    if ($offset) {
      $end = strpos($link, '"', $offset);
    }
    if ($end) {
      $link = substr_replace($link, '', $offset, $end - $offset);
    }
    return $link;
  }


  /*WooCommerce support */
  public static function wdwt_wrapper_start(){
    global $wdwt_front;
    ?>
    <div class="right_container">
    <div  class="container">
    <?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
      <aside id="sidebar1" >
        <div class="sidebar-container">
          <?php  dynamic_sidebar( 'sidebar-1' );  ?>
          <div class="clear"></div>
        </div>
      </aside>
    <?php } ?>
    <div id="content">
    <?php
  }


  public static function wdwt_wrapper_end(){
    ?>
    </div>
    <?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
      <aside id="sidebar2">
        <div class="sidebar-container">
          <?php  dynamic_sidebar( 'sidebar-2' );  ?>
          <div class="clear"></div>
        </div>
      </aside>
    <?php } ?>
    <div class="clear"></div>
    </div>

    </div>
    <?php
  }







  public static function do_nothing($param=NULL){
    return $param;
  }



}






