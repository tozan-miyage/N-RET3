$(document).ready(function() {

  var options = {
    valueNames: ['main_word_submit']
  };

  let mainWordsList = new List('main_words', options);

  var en_text_subject = [];
  var ja_text_subject = [];
  var img_subject = [];
  var num = 0;
  var loc = 0

  const img_text = document.getElementById("img_text");
  const en_text = document.getElementById("en_text");
  const target = document.getElementById("target");
  const logo_img = document.getElementById("logo_img");
  const navi = document.getElementById("navi");
  const alerts = document.getElementById("alerts");
  const change = document.getElementById("change");
  const main_word = document.getElementById("main_word");

  const set_img = (num) => {
    img_text.src = img_subject[num];
  };

  const set_en = (num) => {
    en_text.textContent = en_text_subject[num];
  };

  const set_en_type = (num) => {
    const replaces = en_text_subject[num];
    const replaceValue = / /gi;　
    const inspace = replaces.replace(replaceValue, "_");

    let splitInspace = inspace.split('');

    // 出力用の要素を作成
    let spanAddInspace = "";
    $.each(splitInspace, function(index, val) {
      spanAddInspace += '<span class="spanOpacity">' + val + '</span>';
    });
    // HTMLに出力
    target.innerHTML = spanAddInspace;
  };

let alertNavi = (logo, alertClassName, text) => {
      logo_img.src = logo;
      alerts.className = alertClassName;
      alerts.textContent = text;
    }

    // ロゴ変数
    let red = "../img/logo1.jpg";
    let yellow = "../img/logo2.jpg";　　　
    let blue = "../img/logo3.jpg";

    //alert変数
    let primary = "alert alert-primary";
    let danger = "alert alert-danger";
    let warning = "alert alert-warning";
    let info = "alert alert-info";

    // ロジック

    let game_set = (num) => {
      set_img(num);
      set_en(num);
      set_en_type(num);
    };
    
    // 音声を流す
    const audio = (text) => {
    // 発言を作成
    let uttr = new SpeechSynthesisUtterance(text);
    // 発話言語
    uttr.lang = "en-US";
    // 速度 0.1-10 初期値:1 (倍速なら2, 半分の倍速なら0.5)
    uttr.rate = 0.8;
    // 高さ 0-2 初期値:1
    uttr.pitch = 1.5;
    // 音量 0-1 初期値:1
    uttr.volume = 0.75;
    // 発言を再生 (発言キューに発言を追加)
    speechSynthesis.speak(uttr);
  };
  
  const updateTarget = () => {

    $(".spanOpacity").eq(loc).addClass("notOpacity");

  }


  $.ajaxSetup({ async: false });
  //formのmain_word_btn要素を取得・submitでイベント発火
  $("form.main_word_btn").submit(function(e) {
    //元々のイベントは、発火しないようにする。
    e.preventDefault();

    // 一度クリア
    en_text_subject.length = 0;
    ja_text_subject.length = 0;
    img_subject.length = 0;
    loc =0;
    num =0;

    $("#target").off();　　
    let form = $(this);
    console.log($(`form#${$(this).attr('id')} .main_word_submit`));
    //form.find('.main_word_submit')[0].addClass('disabled');
    $(`form#${$(this).attr('id')} .main_word_submit`).prop('disabled', true);
    //dataobjectに、formの内容を格納（データを文字列に変換）serealize()
    let dataobject = $(this).serialize();

    //URI(/api/materialapi）に接続・dataobjectを渡す      
    $.post('/api/materialapi', dataobject).done(function(data) {
      console.log(form.find('.main_word_submit')[0]);
      //tokuhara add

      $(`form#${form.attr('id')} .main_word_submit`).prop('disabled', false);
      form.find('.main_word_submit')[0].blur();
      //data(オブジェクトで取得)を回す
      data.forEach(object => {
        // オブジェクトのkeyを配列として取得し回す
        Object.keys(object).forEach(key => {
          // もし、keyがenglishだったら、
          if (key == "english") {
            // objectのenglishの値を配列にpush
            en_text_subject.push(object[key]);
          }
          else if (key == "japanese") {
            ja_text_subject.push(object[key]);

          }
          else if (key == "photo") {
            img_subject.push(object[key]);
          }
          else {

          }
        });
      });
    });
    
    game_set(num);

    alertNavi(red, warning, "タイピングでスタート！");

  });

  //これでも、うまくいく↓
  // for (let i = 0; i < data.length; i++) {

  //   en_text_subject.push(data[i]['english']);

  //   ja_text_subject.push(data[i]['japanese']);

  //   let imageDataName = data[i]['photo'];

  //   img_subject.push(`../img/${imageDataName}`);

  // }


  

  // const speakBtn = document.querySelector("#speak-btn");

  // speakBtn.addEventListener("click", function () {
  // アラート表示を変える


  //何度も呼ばれている
  // タイピングが合っていたら、色を付ける

  //start ボタンで呼ぶようにする。ここが何度も呼ばれてインスタンスが生成されているのが問題です。
  window.addEventListener("keydown", (e) => {

    let key = e.key;
    let targetKey = en_text_subject[num][loc];
    let text = en_text_subject[num];
    console.log(targetKey);

    if (loc === 1) {
      //音声のキューをクリア
      // speechSynthesis.cancel();

      audio(text);

    }
    // Enter以外のkey
    if (key !== "Enter") {
      e.preventDefault(); //これでエラーが消えた。う
      if (key === targetKey || key === targetKey.toLowerCase()) {
        alertNavi(yellow, primary, "OK!");

        updateTarget();
        loc++;
        if (loc === en_text_subject[num].length) {
          target.textContent = ja_text_subject[num];
          //音声のキューをクリア
          // speechSynthesis.cancel();

          audio(text);

          alertNavi(blue, info, "次の問題へ（エンターキー）");
        }
      }
      else {
        alertNavi(yellow, danger, "miss!");
      }
    }

    else if (num < img_subject.length) {
      target.textContent = "";
      num++;
      alertNavi(red, warning, "タイピングでスタート！");

      if (num === img_subject.length) {

        en_text_subject.push("Choose a word from the left menu");
        ja_text_subject.push("左Menuから単語を選ぼう");
        img_subject.push("../img/good_job2.jpg");
        alertNavi(blue, primary, "よくできました！");

      }

      game_set(num);
      loc = 0;
    }


  });　
});
