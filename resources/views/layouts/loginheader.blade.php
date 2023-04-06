<header>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1f1f1f;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">タスク管理</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    @auth
                        <a class="mr-lg-3 my-lg-0 my-3 btn btn-sm btn-dark text-light nav-item nav-link" href="#">ユーザーA</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-danger text-light nav-item nav-link w-100">ログアウト</button>
                        </form>
                    @else
                        <a class="mr-lg-3 my-lg-0 my-3 btn btn-sm btn-dark text-light nav-item nav-link" href="{{ route('login') }}">ログイン</a>
                        <a class="btn btn-sm btn-primary text-light nav-item nav-link" href="{{ route('register') }}">新規登録</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <script>
                    window.addEventListener('DOMContentLoaded', event => {

// Toggle the side navigation
const sidebarToggle = document.body.querySelector('#sidebarToggle');
if (sidebarToggle) {
    // Uncomment Below to persist sidebar toggle between refreshes
    // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
    //     document.body.classList.toggle('sb-sidenav-toggled');
    // }
    sidebarToggle.addEventListener('click', event => {
        event.preventDefault();
        document.body.classList.toggle('sb-sidenav-toggled');
        localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
    });
}

});
                </script>
</header>
