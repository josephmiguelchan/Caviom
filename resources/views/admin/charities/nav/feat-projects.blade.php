

<div class="card-body mt-3">
    <div class="row">
        <div class="col-lg-11">
            <h2><strong>Featured Projects</strong></h2>
            <p class="mb-2">{{$organizationdetail->name}}</p>
        </div>
    </div>
</div>
<div class="card-body">
    <table id="datatable" class="table table-bordered dt-responsive nowrap"
        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Project Name</th>
                <th>Date of Event</th>
                <th>Visibility Status</th>
                <th>Remarks</th>
                <th>Date Added</th>
                <th>Action</th>
            </tr>
        </thead>


        <tbody>
            @foreach ($organizationdetail->featuredProject as $key => $item)
                
         
            <tr>
                <td>{{$key+1}}</td>
                <td>
                    @if ($item->approval_status == 'Pending')
                    <span class="badge bg-warning">PENDING</span> 
                    @elseif($item->approval_status == 'Approved')         
                    <span class="badge bg-success">Approved</span>     
                    @elseif($item->approval_status == 'Rejected')         
                    <span class="badge bg-danger">Rejected</span>   
                    @endif

                    {{$item->name}}</td>
                <td>{{$item->started_on}}</td>

                @if ($item->visibility_status == "Hidden")
                    <td><i class="ri-eye-off-line"></i> {{$item->visibility_status}}</td>
                    @elseif($item->visibility_status == "Visible")
                    <td><i class="ri-eye-line"></i> {{$item->visibility_status}}</td>
                @endif
                <td>  {{ (!empty($item->remark_subject))? $item->remark_subject:'---' }}</td>
                <td>{{$item->created_at}}</td>
                <td>
                    <a href="{{ route('admin.feat-projects.view',$item->code) }}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                        <i class="mdi mdi-open-in-new"></i> View
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>