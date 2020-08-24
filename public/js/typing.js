// ブラウザでAPIが使用できるかの確認
// const checkBrowser = () => {
//   if ("speechSynthesis" in window) {
//     alert("このブラウザは音声再生に対応しています。🎉");
//   } else {
//     alert("このブラウザは音声再生に対応していません。😭");
//   }
// };
// checkBrowser();
$(document).ready(function() {

  var options = {
    valueNames: ['main_word_submit']
  };

  let mainWordsList = new List('main_words', options);

  let en_text_subject = [];
  let ja_text_subject = [];
  let img_subject = [];

  //formのmain_word_btn要素を取得・submitでイベント発火
  $("form.main_word_btn").submit(function(e) {
    //元々のイベントは、発火しないようにする。
    e.preventDefault();

    // 一度クリア
    en_text_subject = [];
    ja_text_subject = [];
    img_subject = [];


    　　
    let form = $(this);
    //dataobjectに、formの内容を格納（データを文字列に変換）serealize()
    let dataobject = $(this).serialize();

    //URI(/api/materialapi）に接続・dataobjectを渡す      
    $.post('/api/materialapi', dataobject).done(function(data) {
      console.log(form.find('.main_word_submit')[0]);
      //tokuhara add
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


      //これでも、うまくいく↓
      // for (let i = 0; i < data.length; i++) {

      //   en_text_subject.push(data[i]['english']);

      //   ja_text_subject.push(data[i]['japanese']);

      //   let imageDataName = data[i]['photo'];

      //   img_subject.push(`../img/${imageDataName}`);

      // }

      const img_text = document.getElementById("img_text");
      const en_text = document.getElementById("en_text");
      const target = document.getElementById("target");
      const logo_img = document.getElementById("logo_img");
      const navi = document.getElementById("navi");
      const alerts = document.getElementById("alerts");
      const change = document.getElementById("change");
      const main_word = document.getElementById("main_word");

      // 素材の表示

      let num = 0;

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

      // 音声を流す
      const audio = () => {
        const text = en_text.textContent;
        // 発言を作成
        const uttr = new SpeechSynthesisUtterance(text);
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

      // const speakBtn = document.querySelector("#speak-btn");

      // speakBtn.addEventListener("click", function () {
      // アラート表示を変える

      const alertNavi = (logo, alertClassName, text) => {
        logo_img.src = logo;
        alerts.className = alertClassName;
        alerts.textContent = text;
      }

      // ロゴ変数
      const red = "../img/logo1.jpg";
      const yellow = "../img/logo2.jpg";　　　
      const blue = "../img/logo3.jpg";

      //alert変数
      const primary = "alert alert-primary";
      const danger = "alert alert-danger";
      const warning = "alert alert-warning";
      const info = "alert alert-info";

      // ロジック

      const game_set = (num) => {
        set_img(num);
        set_en(num);
        set_en_type(num);
      };

      game_set(num);

      // タイピングが合っていたら、色を付ける
      let loc = 0;

      const updateTarget = () => {

        $(".spanOpacity").eq(loc).addClass("notOpacity");

      }


      alertNavi(red, warning, "タイピングでスタート！");

      window.addEventListener("keydown", (e) => {

        let key = e.key;
        let targetKey = en_text_subject[num][loc];
        console.log(targetKey);

        if (loc === 1) {
          //音声のキューをクリア
          speechSynthesis.cancel();

          audio();

        }
        // Enter以外のkey
        if (key !== "Enter") {

          if (key === targetKey || key === targetKey.toLowerCase()) {
            alertNavi(yellow, primary, "OK!");

            updateTarget();
            loc++;
            if (loc === en_text_subject[num].length) {
              target.textContent = ja_text_subject[num];
              //音声のキューをクリア
              speechSynthesis.cancel();

              audio();

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
  });
});
