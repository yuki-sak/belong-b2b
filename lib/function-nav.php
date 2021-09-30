<?php
/**
 * ナビ系設定
 */
// メニュー有効化
add_theme_support('menus');

register_nav_menus( array(
  'header' => 'Header',
  'footer' => 'Footer',
  'spmenu' => 'SPmenu',
) );

/**
 * メニュー操作
 */

// function my_nav_menu_id( $menu_id ){
//   $id = NULL;
//   return $id;
// }
// add_filter( 'nav_menu_item_id', 'my_nav_menu_id' );

// function my_nav_menu_class( $classes, $item ){
//   if( $classes[0] ){
//     array_splice( $classes, 1);
//     //$classes = array_merge(['test'],$classes);
//   }else{
//     $classes = [];
//     //$classes[] = 'test';
//   }
//   // if( $item -> current == true ){
//   //   $classes[] = 'active';
//   // }
//   return $classes;
// }
// add_filter( 'nav_menu_css_class', 'my_nav_menu_class', 10, 2 );


// add_filter('wp_nav_menu','replace_last_nav_item',100,2);
// function replace_last_nav_item($items, $args) {
//   if($args->theme_location == "header"){
//   return substr_replace($items, '', strrpos($items, $args->after), strlen($args->after));
// }
// return $items;
// }

// add_filter('walker_nav_menu_start_el', 'add_class_on_link', 10, 4);
//  function add_class_on_link($item_output, $item,$depth,$args){
//   if($args->theme_location == "header"){

//     if( $item -> current == true ){
//       return preg_replace('/(<a.*?)/', '$1' . " class='nav-link active'", $item_output);
//     } else {
//       return preg_replace('/(<a.*?)/', '$1' . " class='nav-link'", $item_output);
//     }
//   } elseif($args->theme_location == "spmenu"){

//     if( $item -> classes[0] ) {
//       return preg_replace('<div class="row">', '<div class="row ' . $item->classes[0] . '>"', $item_output);

//     }


//   } elseif($args->theme_location == "footer"){
//     return preg_replace('/(<a.*?)/', '$1' . " class='page-title text-black'", $item_output);
//   }
//   return $item_output;
// }


// add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

// function my_wp_nav_menu_objects( $items, $args ) {

//   if($args->theme_location == "spmenu"){
	
// 	// loop
// 	foreach( $items as &$item ) {

		
// 		// vars
//     $image = get_field('ico', $item);
//     if($image):
//       $src = wp_get_attachment_image_src($image, 'full');
//       $alt = $image['alt'];
//       $imgoutput = '<img src="'.$src[0].'" alt="'.$alt.'" class="sp-menu-image w-100">';
//       $imgoutput = '<div class="item image-holder">' . $imgoutput . '</div>';
//     else:
//       $imgoutput = '';
//     endif;

    

//     if(get_field('inner_class', $item)){
//       $inner_class = ' ' . get_field('inner_class', $item);
//     } else {
//       $inner_class = '';
//     }
//     if(get_field('content', $item)){
//       $content = get_field('content', $item);
//     } else {
//       $content = '';
//     }


//     $str = 
//     '<div class="lease-plan-holder flex-box' . $inner_class . '">' .
//       $imgoutput.
//       '<div class="item logo-holder">' .
//         $content .
//       '</div>' .
//       '<div class="item chevron-holder">' .
//         '<i class="fas fa-chevron-right"></i>' .
//       '</div>' .
//     '</div>';
		
		
// 			$item->title = $str;

// 	}
// }
// // return
// return $items;
	
	
// }