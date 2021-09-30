$(function() {
  $.extend($.validator.messages, {
    required: "<span class='err-ico'>!</span>必須項目です。",
    email: "<span class='err-ico'>!</span>メールアドレスを入力してください。",
  });
  //郵便番号（例:012-3456）
  jQuery.validator.addMethod("postnum", function (value, element) {
    return this.optional(element) || /^\d{3}\-?\d{4}$/.test(value);
  }, "<span class='err-ico'>!</span>郵便番号を入力してください（例:123-4567）。"
  );

  //電話番号（例:012-345-6789）
  jQuery.validator.addMethod("telnum", function (value, element) {
    return this.optional(element) || /^[0-9-]{10,13}$/.test(value);
  }, "<span class='err-ico'>!</span>電話番号を入力してください（例:012-345-6789）。"
  );

  //ひらがな
  jQuery.validator.addMethod("hiragana", function (value, element) {
    return this.optional(element) || /^[あ-んぁ-ぉゃ-ょー\s]+$/.test(value);
  }, "<span class='err-ico'>!</span>全角ひらがなで入力してください。"
  );

  //全角カタカナのみ
  jQuery.validator.addMethod("katakana", function(value, element) {
    return this.optional(element) || /^([ァ-ヶー\s]+)$/.test(value);
    }, "<span class='err-ico'>!</span>全角カタカナを入力してください"
  );

  // AjaxZip3
  // $(function() {
  //   $('input[name="zip_2"').keyup(function(e) {
  //     AjaxZip3.zip2addr('zip_1','zip_2','address_1','address_2');
  //   })
  // });

  // Validation
  $form = $('form');
  $form.validate({
    onfocusout: function(element) {
      $(element).valid();
    },
    groups: {
      name: 'name_1 name_2',
    },
    errorPlacement: function (error, element) {
      console.log("a");
      var elmname = "";
      if (element.attr('type') == 'checkbox') {
        elmname = element.attr('name');
        elmname = elmname.replace("[", "_");
        elmname = elmname.replace("]", "");
        elmname = elmname.replace("[", "");
        elmname = elmname.replace("]", "");
        error.appendTo($(".err_" + elmname));
      } else {
        elmname = element.attr('name');
        error.appendTo($(".err_" + elmname));
      }
    },
    rules: {
      txt_1: {
        required: true
      },
      name_1: {
        required: true
      },
      name_2: {
        required: true
      },
      mail_1: {
        required: true,
        email: true
      },
      tel_1: {
        required: true,
        telnum: true
      },
      txa_1: {
        required: true
      },
    },
    invalidHandler: function() {
      var scrollPosition = $('form').offset().top;
      $('body,html').animate({
        scrollTop: scrollPosition
      }, 'slow');
    }
  });

  // 全角英数を半角英数に自動変換
  $('input.conv_half_alphanumeric, input[type="tel"], input[type="email"], input[type="number"]').change(function() {
    var txt = $(this).val();
    var half = txt.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
      return String.fromCharCode(s.charCodeAt(0) - 0xFEE0)
    });
    $(this).val(half);
  });

  // カタカナをひらがなに変換
  $('input.ktoh').bind('change', function() {
    var TargetString = tozenkaku($(this).val());
    var ResString = TargetString.replace(/[ァ-ン]/g, function(s) {
      return String.fromCharCode(s.charCodeAt(0) - 0x60);
    });
    $(this).val(ResString);
  });

  // 配列
  function tozenkaku(txt) {
    hankaku = new Array("ｶﾞ", "ｷﾞ", "ｸﾞ", "ｹﾞ", "ｺﾞ", "ｻﾞ", "ｼﾞ", "ｽﾞ", "ｾﾞ", "ｿﾞ", "ﾀﾞ", "ﾁﾞ", "ﾂﾞ", "ﾃﾞ", "ﾄﾞ", "ﾊﾞ", "ﾊﾟ", "ﾋﾞ", "ﾋﾟ", "ﾌﾞ", "ﾌﾟ", "ﾍﾞ", "ﾍﾟ", "ﾎﾞ", "ﾎﾟ", "ｳﾞ", "ｧ", "ｱ", "ｨ", "ｲ", "ｩ", "ｳ", "ｪ", "ｴ", "ｫ", "ｵ", "ｶ", "ｷ", "ｸ", "ｹ", "ｺ", "ｻ", "ｼ", "ｽ", "ｾ", "ｿ", "ﾀ", "ﾁ", "ｯ", "ﾂ", "ﾃ", "ﾄ", "ﾅ", "ﾆ", "ﾇ", "ﾈ", "ﾉ", "ﾊ", "ﾋ", "ﾌ", "ﾍ", "ﾎ", "ﾏ", "ﾐ", "ﾑ", "ﾒ", "ﾓ", "ｬ", "ﾔ", "ｭ", "ﾕ", "ｮ", "ﾖ", "ﾗ", "ﾘ", "ﾙ", "ﾚ", "ﾛ", "ﾜ", "ｦ", "ﾝ", "｡", "｢", "｣", "､", "･", "ｰ", "ﾞ", "ﾟ");
    zenkaku = new Array("ガ", "ギ", "グ", "ゲ", "ゴ", "ザ", "ジ", "ズ", "ゼ", "ゾ", "ダ", "ヂ", "ヅ", "デ", "ド", "バ", "パ", "ビ", "ピ", "ブ", "プ", "ベ", "ペ", "ボ", "ポ", "ヴ", "ァ", "ア", "ィ", "イ", "ゥ", "ウ", "ェ", "エ", "ォ", "オ", "カ", "キ", "ク", "ケ", "コ", "サ", "シ", "ス", "セ", "ソ", "タ", "チ", "ッ", "ツ", "テ", "ト", "ナ", "ニ", "ヌ", "ネ", "ノ", "ハ", "ヒ", "フ", "ヘ", "ホ", "マ", "ミ", "ム", "メ", "モ", "ャ", "ヤ", "ュ", "ユ", "ョ", "ヨ", "ラ", "リ", "ル", "レ", "ロ", "ワ", "ヲ", "ン", "。", "「", "」", "、", "・", "ー", "゛", "゜");

    for (i = 0; i <= 88; i++) { // 89文字あるのでその分だけ繰り返す
      while (txt.indexOf(hankaku[i]) >= 0) { // 該当する半角カナがなくなるまで繰り返す
        txt = txt.replace(hankaku[i], zenkaku[i]); // 半角カナに対応する全角カナに置換する
      }
    }
    return txt;
  }

  // ひらがなをカタカナに変換
  $('input.htok').bind('change', function() {
    var TargetString = $(this).val();
    var ResString = TargetString.replace(/[ぁ-ん]/g, function(s) {
      return String.fromCharCode(s.charCodeAt(0) + 0x60);
    });
    $(this).val(ResString);
  });

});