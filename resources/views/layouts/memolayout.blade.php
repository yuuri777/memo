<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title','memo')</title>

        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="/css/styles.css" rel="stylesheet" />
        
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"  crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-0Jk6pORwvBHRUrsWLLP4j02Z4w4QD4hZ8b1Wp5j5LeLAidSknm3q8gBdKLPLxNwU6jDKU6f8U6a/31yplnfK6Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        
        <div class="d-flex" id="wrapper">
            <!-- d-flexを指定すると要素をフレックスコンテナに変換して、フレックスアイテムを配置できるようになる -->
            <!-- サイドバー -->
           @include('layouts.side') 

           <!-- ヘッダー -->
           @include('layouts.memoheader')

           
                <!-- Page content-->
                @yield('content')
                
<!-- フッター -->
        @include('layouts.footer')

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
       
    </body>
</html>


