 <!-- Sidebar-->
<div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light">タイトル一覧 &emsp;
        <a href="{{ route('projects.create') }}" class="mr-3 btn btn-primary">追加</a>
    </div>
    <div class="list-group list-group-flush">
    <!-- リストグループとは　　複数の関連するアイテムを一覧表示するために使用されます。
    アイテムを縦方向に表示、各アイテムはボーダーや背景色などで区別される.アイテムリストを作成位するために使用される -->
    <!-- list-group-flushクラスはリストグループのアイテム間に余分なスペースを追加せずにアイテムを綺麗にするために称される。 -->
    @foreach ($projects as $project)
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('memo.index',$project->id) }}">{{ $project->project_name }}</a>
        <!-- list-group-itemはリストグループの要素にスタイルを適用するクラスめい -->
    @endforeach
     </div>
</div>
            