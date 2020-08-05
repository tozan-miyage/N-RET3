@extends('layouts.app_play')
        <!-- メイン画面（中央部分） -->
        @section('content')
            <div class="row main_space">
                <!-- 左サイドメニュー -->
                <div class="col-2 menu">
                    <p>Menu</p>
                    <div class="search">
                        <input type="text" placeholder="単語で検索" />
                    </div>
                    <div class="ul_scroll">
                        <!--{{ print_r($materials) }}-->
                        <ul>
                            @foreach($materials as $material)
                            <li>
                                <form class="main_word_btn" method="POST" action="">
                                    @csrf
                                    <input type="hidden" name="material_id" value="{{ $material->id }}">
                                    <button class="main_word_btn" type="submit">{{ $material -> main_word }}</button>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- 中央タイピングエリア -->
                <div class="col-10 typing_erea">
                    <div class="how_to_contents">
                        <!-- 課題の写真 -->
                        <div class="theme_img">
                            <img id="img_text" src="" alt="イメージ画像が入ります" />
                        </div>

                        <!-- 写真を説明する英文 -->
                        <div id="theme_text_en" class="theme_text_en">
                            <p id="en_text"></p>
                        </div>

                        <!-- タイピング -->
                        <div>
                            <span id="change"></span>
                            <p id="target">ok</p>
                        </div>

                        <div id="navi_area">
                            <div class="how_to_navi">
                                <img id="logo_img" src="../img/logo1.jpg" alt="" />
                                <p id="navi">はじめよう！</p>
                            </div>
                            <div id="alerts" class="alert alert-warning" role="alert">
                                タイピングでスタート
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 右サイド広告エリア -->
                <!--<div class="col-2 ad_text">-->
                <!--    <p>スポンサーリンク</p>-->
                <!--</div>-->
            </div>
        @endsection
        @section('js')
        <script type="text/javascript">
        //documentが読み込まれてから実行する。
        $(document).ready(function() {
            //formのmain_word_btn要素を取得・submitでイベント発火
            $("form.main_word_btn").submit(function(e){
            　　//元々のイベントは、発火しないようにする。
                e.preventDefault();
            　　//dataobjectに、formの内容を格納（データを文字列に変換）serealize()
                let dataobject = $(this).serialize();
            　　//ここまでの動作を確認済み
                console.log(dataobject);
                //URI(/api/materialapi）に接続・dataobjectを渡す      
            　  $.post('/api/materialapi',dataobject).done(function(data){
            　  //ここまでの動作を確認済み
                 console.log(data);
                 
                 const materials = json_decode(data);
                 
                 conlole.log(materials);
                 
              });
            });
        });
        </script>
        @endsection