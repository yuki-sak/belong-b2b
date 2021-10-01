<?php
if(is_front_page()){
  $class = "l-footer--top";
} else if(is_page('buy')){
  $class = "l-footer--orange";
} else {
  $class = "l-footer";
}
?>

<footer class="<?php echo $class; ?>">
  <nav>
    <ul class="l-footer__link c-footerLink">
      <li class="c-footerLink__item">
        <a href="" class="c-footerLink__link u-txt_m7 u-bold">リースプラン</a>
      </li>
      <li class="c-footerLink__item">
        <a href="" class="c-footerLink__link u-txt_m7 u-bold">販売プラン</a>
      </li>
      <li class="c-footerLink__item">
        <a href="<?php home_url(); ?>/buy/" class="c-footerLink__link u-txt_m7 u-bold">法人買取</a>
      </li>
      <li class="c-footerLink__item">
        <a href="" class="c-footerLink__link u-txt_m7 u-bold">お役立ちコンテンツ</a>
      </li>
      <li class="c-footerLink__item">
        <a href="https://about.belong.co.jp/about-us/" target="_blank"
          class="c-footerLink__link u-txt_m7 u-bold">会社概要</a>
      </li>
      <li class="c-footerLink__item">
        <a href="" class="c-footerLink__link u-txt_m7 u-bold">お問い合わせ</a>

      </li>
    </ul>
  </nav>

  <ul class="l-footer__logo c-foonterLogo">
    <li class="c-foonterLogo__item">
      <a href="" class="c-foonterLogo__link--belong">

        <img src="<?php img_path(); ?>/common/logo-belong.png" class="c-foonterLogo__img" alt="belong ロゴ" class="">
      </a>
    </li>
    <li class="c-foonterLogo__item">
      <a href="" class="c-foonterLogo__link--itochu">
        <img src="<?php img_path(); ?>/common/logo-itochu.png" class="c-foonterLogo__img" alt="itochu ロゴ" class="">
      </a>
    </li>
  </ul>
  <p class="l-footer__desc u-txt_s3 u-ta_c">Belongは、伊藤忠商事の100%グループ会社です。</p>
  <div class="l-footer__data">
    <a href="" class="l-footer__link u-txt_s3 u-ta_lr">
      プライバシーポリシー
    </a>
    <p class="l-footer__copy u-txt_s3 u-ta_lr">
      Copyright 2020 Belong Inc. All Rights Reserved.
    </p>
  </div>
</footer>
</div>

<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/assets/lib/slick/slick.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/common.js"></script>
</body>

</html>