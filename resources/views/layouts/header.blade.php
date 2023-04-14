 <!-- Page content wrapper-->
 <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-primary" id="sidebarToggle">Toggle Menu</button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <!-- この行が横線３本 　data-bs-toggle="collapse"はコンテンツを非表示にする　-->
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item active"><a class="nav-link" href="#!"></a></li>
<<<<<<< HEAD
                                <form method="GET" action="{{ route('memo.search') }}">

<li class="nav-item"><button type="submit"  class="nav-link dropdown-item" href="{{ route('memo.search') }}">検索</a></li>
@csrf
</form>
                                <form method="POST" action="{{ route('logout') }}">

=======
                                <form method="POST" action="{{ route('logout') }}">
>>>>>>> origin/main
                                <li class="nav-item"><button type="submit"  class="nav-link dropdown-item" href="{{ route('logout') }}">ログアウト</a></li>
                                @csrf
                            </form>
                                <li class="nav-item dropdown">
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
<script>
window.addEventListener('DOMContentLoaded', event => {

// Toggle the side navigation
const sidebarToggle = document.body.querySelector('#sidebarToggle');
<<<<<<< HEAD

=======
console.log(sidebarToggle);
>>>>>>> origin/main
if (sidebarToggle) {
   
    sidebarToggle.addEventListener('click', event => {
        event.preventDefault();
        document.body.classList.toggle('sb-sidenav-toggled');
        // sb-sidenav-toggledというクラスをdocument.bodyに追加/削除している
        localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
    });
}

});
                </script>