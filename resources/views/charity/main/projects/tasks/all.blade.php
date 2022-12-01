
<div class="card-body p-0 mt-5">
    <h1><strong>Tasks</strong></h1>
    <button type="button" class="btn btn-rounded btn-sm w-lg btn-success waves-effect waves-light mb-3" data-bs-toggle="modal" data-bs-target="#addTaskModal">
        <i class="mdi mdi-plus-circle-outline"></i> Add New
    </button>
    @include('charity.main.projects.tasks.add')
    <table id="datatable" class="table table-bordered dt-responsive nowrap"
        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Task</th>
                <th>Note</th>
                <th>Assigned By</th>
                <th>Assigned To</th>
                <th>Deadline</th>
                <th>Last Updated at</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($tasks as $key => $item)
            <tr>
                <td>{{$key+1}}</td>

                <td>
                    @if ($item->status == 'Pending')
                    <span class="badge badge-soft-warning">Pending</span> {{ Str::limit($item->title,20)}}
                    @elseif($item->status == 'Completed')
                    <span class="badge badge-soft-success">Completed</span> {{Str::limit($item->title,20)}}
                    @elseif($item->status == 'In-Progress')
                    <span class="badge badge-soft-primary">In-Progress</span> {{Str::limit($item->title,20)}}
                    @endif

                </td>
                <td>{{(!empty($item->note))? Str::limit($item->note, 10):'---'}}
                </td>
                <td>
                    @unless ($item->AssignedBy == null)
                    <a target="_blank" href="{{route('charity.users.view',$item->AssignedBy->code)}}">{{$item->AssignedBy->username}}</a>
                    @else
                    <span class="text-muted">[ Deleted User ]</span>
                    @endunless
                </td>
                <td>
                    @unless ($item->AssignedTo == null)
                    <a target="_blank" href="{{route('charity.users.view',$item->AssignedTo->code)}}">{{$item->AssignedTo->username}}</a>
                    @else
                    <span class="text-muted">[ Deleted User ]</span>
                    @endunless
                </td>
                <td>{{$item->deadline}}</td>
                <td>{{(!empty($item->updated_at))? Carbon\Carbon::parse($item->updated_at)->isoFormat('LL (h:mm A)'):'---'}}</td>
                <td>
                    <a href="{{ route('charity.projects.tasks.view',$item->code) }}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                        <i class="mdi mdi-open-in-new"></i> View
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>