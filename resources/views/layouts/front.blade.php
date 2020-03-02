<!DOCTYPE HTML>
<html>
  <head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Hello!Project All Image in Ameba Blog</title>
    <link rel="stylesheet" href="{{ secure_asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/normalize.css') }}">
  </head>
  
  <body>
   <header>
    <div class="container">
      <div class="header-title-area">
        <h1 class="logo"> Hello!Project All Image in Ameba Blog </h1>
        <p class="text-sub">推しメンを見逃したくないあなたへ！</p>
      </div>
    
    <ul class="header-navigation">
        <li><a href= "{{ action('HpImagesController@index') }}" >Top</a></li>    
        <li><a href="{{ action('HpImagesController@favorite') }}">Favorite</a></li>
    </ul>
    
    </div>
   </header>
      
    <div class="main">
     @yield('content')
    </div>
    
    <footer>
     <p class="copyright">(C) hello!project. since 1998</p>
    </footer>
    
  </body>
  </html>