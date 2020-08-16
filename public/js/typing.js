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

  var mainWordsList = new List('main_words', options);

  // データを格納する変数を宣言 constにするとエラーが起きる。なぜ？
  let en_text_subject = [];
  let ja_text_subject = [];
  let img_subject = [];

  //formのmain_word_btn要素を取得・submitでイベント発火
  $("form.main_word_btn").submit(function(e) {
    // 一度クリア
    en_text_subject = [];
    ja_text_subject = [];
    img_subject = [];

    //元々のイベントは、発火しないようにする。
    e.preventDefault();　　

    //dataobjectに、formの内容を格納（データを文字列に変換）serealize()
    let dataobject = $(this).serialize();

    //URI(/api/materialapi）に接続・dataobjectを渡す      
    $.post('/api/materialapi', dataobject).done(function(data) {

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
      const main_word_submit = document.getElementsByClassName("main_word_submit");

      // 素材の表示
      let num = 0;

      const set_img = (num) => {
        img_text.src = img_subject[num];
      };

      const set_en = (num) => {
        en_text.textContent = en_text_subject[num];
      };

      let inspace;
      const set_en_type = (num) => {
        const replaces = en_text_subject[num];
        const replaceValue = / /gi;
        inspace = replaces.replace(replaceValue, "_");
        target.textContent = inspace;
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
      const alerts_ok = () => {
        alerts.className = "alert alert-primary";
        alerts.textContent = "OK!";
      };

      const alerts_miss = () => {
        alerts.className = "alert alert-danger";
        alerts.textContent = "MISS!";
      };

      const alerts_start = () => {
        alerts.className = "alert alert-warning";
        alerts.textContent = "クリックしてスタート！";
      };

      const alerts_next = () => {
        alerts.className = "alert alert-info _click";
        alerts.textContent = "次の問題へ (エンターキー）";
      };

      // ロゴイメージを変える
      const logo_red = () => {
        logo_img.src = "../img/logo1.jpg";
      };

      const logo_yellow = () => {
        logo_img.src = "../img/logo2.jpg";　　　
      };

      const logo_blue = () => {
        logo_img.src = "../img/logo3.jpg";　　
      };

      // ナビメッセージを変える
      const navi_message = (message) => {
        navi.textContent = message;
      };

      // ロジック

      const game_set = (num) => {
        set_img(num);
        set_en(num);
        set_en_type(num);
      };

      game_set(num);

      // ドットインストールモデル追加
      let loc = 0;

      function updateTarget() {
        // let placeholder = "";
        // for (let i = 0; i < loc; i++) {
        //   placeholder += "_";
        //   console.log(i);
        // }
        change.textContent = en_text_subject[num].slice(0, loc);
        target.textContent = inspace.slice(loc);
      }
      
      const mainWordBtnBlur = () => {
        main_word_submit.blur();
      }
      

      window.addEventListener("keydown", (e) => {
        let key = e.key;
        let targetKey = en_text_subject[num][loc];

        mainWordBtnBlur();
        
        logo_yellow();
        
        navi_message("まねしてタイプ！");
        if (loc === 1) {
          audio();
        }

        if (key !== "Enter") {

          if (key === targetKey || key === targetKey.toLowerCase()) {
            alerts_ok();
            loc++;
            updateTarget();
            if (loc === en_text_subject[num].length) {
              change.textContent = ja_text_subject[num];
              audio();
              logo_blue();
              navi_message("よくできました！");
              alerts_next();
            }
          }
          else {
            alerts_miss();
            navi_message("よく見て！");
          }
        }
        else if (num < img_subject.length) {
          change.textContent = "";
          num++;
          if (num === img_subject.length) {
            change.textContent = "";
            num = 0;
            game_set(num);
            loc = 0;
            logo_red();
            navi_message("はじめよう");
          }
          game_set(num);
          loc = 0;
          alerts_next();
          navi_message("Let's tyaping");
        }
      });　
    });
  });
});
