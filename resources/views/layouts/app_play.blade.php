<!DOCTYPE html>
<html lang="ja">
<head>
    <!-- 以下の meta tags（charset と viewport）は必須です-->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap の CSS（CDN経由）の読み込み -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <!--<link rel="stylesheet" href="../css/main.css"/>-->
    <link rel="stylesheet" href="{{ mix('css/typing.css') }}"/>
    <title>N-RET TYPING</title>
</head>
<body>
    <!--<div id="app">-->
    <div class="wrapper">
        @component('components.header')
        @endcomponent

        <main class="container-md">
            @yield('content')
            
        </main>
        
        @component('components.footer')
        @endcomponent
    </div>
    <!-- 関連 JavaScript の読み込み-->
    <!-- jQuery, Popper.js, Bootstrap JS の順に読み込みます-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    @yield('js')
    <script src={{ mi("js/typing.js") }}></script>
    
</body>
</html>
