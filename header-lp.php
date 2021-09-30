<?php
/**
 * ページのヘッダ部分をここに記述する。
 */
 ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=0, viewport-fit=cover">
  <meta name="format-detection" content="telephone=no">
  <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php wp_title('|', true, 'right');bloginfo('name');?></title>



  <!-- page css here -->
  <link href="<?php echo get_template_directory_uri(); ?>/assets/css/common.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <!-- end of page css here -->



  <?php get_template_part('lib/breadcrumb-jsonld');// JSONLDのパンくずを出力 ?>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>