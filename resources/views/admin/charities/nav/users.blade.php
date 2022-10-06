<div class="card-body mt-3">
    <div class="row">
        <div class="col-lg-11">
            <h2><strong>Charity User Accounts</strong></h2>
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
                <th>Organizational ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Email Address</th>
                <th>Account Status</th>
                <th>Role</th>
                <th>Remarks</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($organizationdetail->users as $key => $item)            
            <tr>
                <td>{{$key+1}}</td>
                <td><span class="badge bg-light">{{$item->info->organizational_id_no}}</span></td>
                <td>{{$item->info->last_name}}</td>
                <td>{{$item->info->first_name}}</td>
                <td>
                    <a href="mailto: {{$item->email}}">{{$item->email}}</a>
                </td>
                <td><i class="ri-checkbox-blank-circle-fill font-size-10 align-middle me-2 {{($item->status == 'Active')?'text-success':'text-warning'}}"></i>{{($item->status == 'Active')?'Active':'Pending'}}</td>  <!--change color based on status-->
                <td>{{$item->role}}</td>
                <td>{{(!empty($item->remakrs))? $item->remarks:'---'}}</td>
                <td>
                    <a href="{{route('admin.charities.users.view',$item->code )}}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                        <i class="mdi mdi-open-in-new"></i> View
                    </a>
                    <a href="{{route('admin.charities.users.edit', $item->code)}}" class="btn btn-sm btn-outline-dark waves-effect waves-light">
                        <i class="mdi mdi-pencil"></i> Edit
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>