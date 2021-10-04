<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport"
    content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=0, viewport-fit=cover">
  <meta name="format-detection" content="telephone=no">
  <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php wp_title('|', true, 'right');bloginfo('name');?></title>
  <?php /* get_template_part('lib/breadcrumb-jsonld');// JSONLDのパンくずを出力 */ ?>
  <?php wp_head(); ?>
  <link href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css" rel="stylesheet">

  <?php if(is_page('contact')): ?>
  <link href="<?php echo get_template_directory_uri(); ?>/assets/css/page_contact.css" rel="stylesheet">
  <?php endif; ?>

</head>

<body <?php body_class(); ?>>
  <div class="l-container<?php echo is_front_page() ? '--top' : null ; ?>">
    <?php
      if(is_front_page()){
        $class = "l-header--top";
      } else if(is_page('buy')){
        $class = "l-header--orange";
      } else {
        $class = "l-header";
      }
    ?>
    <header class="<?php echo $class; ?>">
      <?php if(is_front_page()): ?>
      <div class="l-header__logo">
        <img src="<?php img_path(); ?>/common/logo-belong.png" alt="" class="">
      </div>
      <?php else: ?>
      <a href="<?php echo home_url(); ?>" class="l-header__logo--link">
        <img src="<?php img_path(); ?>/common/logo-belong.png" alt="" class="">
      </a>
      <?php endif; ?>
      <nav class="l-header__nav">
        <ul class="l-header__list c-headerList">
          <li class="c-headerList__item">
            <a href="<?php echo home_url(); ?>/lease_lp1/" class="c-headerList__link u-bold">
              リースプラン
            </a>
          </li>
          <!-- <li class="c-headerList__item">
            <a href="" class="c-headerList__link u-bold">
              販売プラン
            </a>
          </li> -->
          <li class="c-headerList__item">
            <a href="<?php echo home_url(); ?>/buy/" class="c-headerList__link u-bold">
              法人買取
            </a>
          </li>
          <!-- <li class="c-headerList__item">
            <a href="" class="c-headerList__link u-bold">
              お役立ちコンテンツ
            </a>
          </li> -->
          <li class="c-headerList__item">
            <a href="https://about.belong.co.jp/about-us/" target="_blank" class="c-headerList__link u-bold">
              会社概要
            </a>
          </li>
        </ul>
        <a href="<?php echo home_url(); ?>/inquiry/" class="l-header__conv c-headerConv u-txt_m2 u-bold">お問い合わせ</a>
      </nav>
    </header>

    <div class="l-spMenuTriger jsMenuTrig">
      <div class="l-spMenuTriger__inner">
        <span class="l-spMenuTriger__line--1 jsMenu"></span>
        <span class="l-spMenuTriger__line--2 jsMenu"></span>
        <span class="l-spMenuTriger__line--3 jsMenu"></span>
      </div>
    </div>

    <div class="l-spMenu jsMenu">
      <p class="l-spMenu__ttl u-txt_m4 u-bold">
        menu
      </p>
      <nav class="l-spMenu__list">
        <ul class="c-spMenuListMain">
          <li class="c-spMenuListMain__item">
            <a href="<?php echo home_url(); ?>/lease_lp1/" class="l-spMenuLink--lease u-txt_m2 u-bold">
              <div>
                <img src="<?php img_path(); ?>/common/logo-belong_one.png" class="l-spMenuLink__img" alt="belong one">
                <p class="l-spMenuLink__txt--i">
                  リースプラン
                </p>
              </div>
            </a>
          </li>
          <!-- <li class="c-spMenuListMain__item">
            <a href="" class="l-spMenuLink--sale u-txt_m2 u-bold">
              <div>
                <img src="<?php img_path(); ?>/common/logo-belong_one.png" class="l-spMenuLink__img" alt="belong one">
                <p class="l-spMenuLink__txt--i">
                  販売プラン
                </p>
              </div>
            </a>
          </li> -->
          <li class="c-spMenuListMain__item">
            <a href="<?php echo home_url(); ?>/buy/" class="l-spMenuLink--buy u-txt_s2 u-bold">
              <div>
                <p class="l-spMenuLink__txt">
                  法人買取
                </p>
                <img src="<?php img_path(); ?>/common/logo-buy.svg" class="l-spMenuLink__img--pt2" alt="belong one">
              </div>
            </a>
          </li>
        </ul>
        <ul class="c-spMenuListSub">
          <!-- <li class="c-spMenuListSub__item">
            <a href="" class="l-spMenuLink--content u-txt_m2 u-bold">
              お役立ちコンテンツ
            </a>
          </li> -->
          <li class="c-spMenuListSub__item">
            <a href="https://about.belong.co.jp/about-us/" target="_blank"
              class="l-spMenuLink--company u-txt_m2 u-bold">
              会社概要
            </a>
          </li>
        </ul>
        <div class="l-spMenu__conv">
          <a href="<?php echo home_url(); ?>/inquiry/" class="c-spMenuConv u-txt_m4 u-bold">
            お問い合わせ
          </a>
        </div>
      </nav>
    </div>
    <div class="l-spMenuOverLay jsMenu"></div>