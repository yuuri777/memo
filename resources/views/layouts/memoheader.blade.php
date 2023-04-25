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
                            <a href="{{ route('memo.create',$currentProjectid) }}" class="plus-button">＋</a>
                                <li class="nav-item active"><button type="submit" id="edit-text" class="nav-link dropdown-item" >編集</a></li>

                        <form method="POST" action="{{ route('logout') }}">
                                <li class="nav-item"><button type="submit"  class="nav-link dropdown-item" href="{{ route('logout') }}">ログアウト</a></li>
                                @csrf
                            </form>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">その他</a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('memo.search')}}">検索</a>
                                        <div class="daropdown-divider"></div>
                                        
                                        <form method="POST" action="{{ route('project.delete',$currentProjectid) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class=" dropdown-item" >メモタイトルを削除する</a>
                                        </form> 
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
if (sidebarToggle) {
    // Uncomment Below to persist sidebar toggle between refreshes
    // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
    //     document.body.classList.toggle('sb-sidenav-toggled');
    // }
    sidebarToggle.addEventListener('click', event => {
        event.preventDefault();
        document.body.classList.toggle('sb-sidenav-toggled');
         // sb-sidenav-toggledというクラスをdocument.bodyに追加/削除している
        localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
    });

    /*const editbtn=document.body.querySelector('#edit-btn');
    editbtn.addEventListener('click',event => {
        
    });*/

    const editbtn=document.body.querySelector('#edit-btn');
    editbtn.addEventListener('click',event => {
        
    });
}

});
 </script>
