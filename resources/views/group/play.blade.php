@extends('layouts.app_play')
        <!-- メイン画面（中央部分） -->
        @section('content')
    
            <div class="row main_space">
                <!-- 左サイドメニュー -->
                <div id="main_words" class="col-2 menu">
                    <p>Menu</p>
                    <!--<form class="search_input" method="P">-->
                        <div class="search">
                            <input class="search" placeholder="単語を検索" />
                        </div>
                    <!--</form>-->
                    
                    <div class="ul_scroll">
                        <!--{{ print_r($materials) }}-->
                        <ul class="list">
                            @foreach($materials as $material)
                            <li>
                                <!--idを追加しました。tokuhara-->
                                <form class="main_word_btn" id="form-word-{{ $material->id }}" method="POST" action="">
                                    @csrf
                                    <input type="hidden" name="material_id" value="{{ $material->id }}">
                                    <button class="main_word_submit" type="submit">{{ $material -> main_word }}</button>
                                    <!--<input class="main_word_submit" type="submit" value="{{ $material -> main_word }}">-->
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
                            <img id="img_text" src="/img/vishwanath-surpur-MaXtz1BRD08-unsplash.jpg" alt="イメージ画像が入ります" />
                        </div>

                        <!-- 写真を説明する英文 -->
                        <div id="theme_text_en" class="theme_text_en">
                            <p id="en_text">Choose a word from the left menu</p>
                        </div>

                        <!-- タイピング -->
                        <div>
                            <!--<span id="change"></span><p id="target">左Menuから単語を選ぼう</p>-->
                            <p id="target">左Menuから単語を選ぼう</p>
                        </div>

                        <div id="navi_area">
                            <div class="how_to_navi">
                                <img id="logo_img" src="../img/logo1.jpg" alt="" />
                            <span id="alerts" class="alert alert-warning">つかえない英語タイピング</span>
                            
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 右サイド広告エリア -->
                <!--<div class="col-2 ad_text">-->
                <!--    <p>スポンサーリンク</p>-->
                <!--</div>-->
            </div>
            <script>
                // ブラウザでAPIが使用できるかの確認
                const checkBrowser = () => {
                    if ("speechSynthesis" in window) {
                        alert("このブラウザは音声再生に対応しています。🎉");
                    } else {
                        alert("このブラウザは音声再生に対応していません。😭");
                    }
                };
                    checkBrowser();
            </script>
        @endsection