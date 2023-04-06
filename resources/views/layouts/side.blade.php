 <!-- Sidebar-->
 <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">タイトル一覧 &emsp;&emsp;&emsp;
                <a href="{{ route('projects.create') }}" class="mr-3 btn btn-primary">追加</a>
                </div>

             
                <div class="list-group list-group-flush">
                    
                
                @foreach ($projects as $project)
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('memo.index',$project->id) }}">{{ $project->project_name }}</a>
             
                @endforeach

                       </div>
            </div>
              