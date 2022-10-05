<div class="card-body mt-3">
    <div class="row">
        <div class="col-lg-11">
            <h2><strong>Charity User Accounts</strong></h2>
            <p class="mb-2">Our Lady of Sorrows Foundation, Inc.</p>
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
            <tr>
                <td>1</td>
                <td><span class="badge bg-light">11231231</span></td>
                <td>Madre</td>
                <td>Sierra</td>
                <td>
                    <a href="mailto: martinagpalza+test2@gmail.com">martinagpalza+test2@gmail.com</a>
                </td>
                {{-- <td><i class="ri-checkbox-blank-circle-fill font-size-10 align-middle me-2 {{($item->status == 'Active')?'text-success':'text-warning'}}"></i>{{($item->status == 'Active')?'Active':'Pending'}}</td>  <!--change color based on status--> --}}
                <td><i class="ri-checkbox-blank-circle-fill font-size-10 align-middle me-2 text-success"></i>Active</td>  <!--change color based on status-->
                <td>Charity Admin</td>
                <td>---</td>
                <td>
                    <a href="{{route('admin.charities.users.view', '535b921d-8063-4fe4-ac6a-718273344e11')}}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                        <i class="mdi mdi-open-in-new"></i> View
                    </a>
                    <a href="{{route('admin.charities.users.edit', '535b921d-8063-4fe4-ac6a-718273344e11')}}" class="btn btn-sm btn-outline-dark waves-effect waves-light">
                        <i class="mdi mdi-pencil"></i> Edit
                    </a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td><span class="badge bg-light">20222323291</span></td>
                <td>Sharon</td>
                <td>Shanghai</td>
                <td>
                    <a href="mailto: supercell321xc@gmail.com">supercell321xc@gmail.com</a>
                </td>
                {{-- <td><i class="ri-checkbox-blank-circle-fill font-size-10 align-middle me-2 {{($item->status == 'Active')?'text-success':'text-warning'}}"></i>{{($item->status == 'Active')?'Active':'Pending'}}</td>  <!--change color based on status--> --}}
                <td><i class="ri-checkbox-blank-circle-fill font-size-10 align-middle me-2 text-success"></i>Active</td>  <!--change color based on status-->
                <td>Charity Associate</td>
                <td>---</td>
                <td>
                    <a href="#" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                        <i class="mdi mdi-open-in-new"></i> View
                    </a>
                    <a href="#" class="btn btn-sm btn-outline-dark waves-effect waves-light">
                        <i class="mdi mdi-pencil"></i> Edit
                    </a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td><span class="badge bg-light">2022515365</span></td>
                <td>Dungaw</td>
                <td>Manglangit</td>
                <td>
                    <a href="mailto: dont_me23@gmail.com">dont_me23@gmail.com</a>
                </td>
                {{-- <td><i class="ri-checkbox-blank-circle-fill font-size-10 align-middle me-2 {{($item->status == 'Active')?'text-success':'text-warning'}}"></i>{{($item->status == 'Active')?'Active':'Pending'}}</td>  <!--change color based on status--> --}}
                <td><i class="ri-checkbox-blank-circle-fill font-size-10 align-middle me-2 text-warning"></i>Pending</td>  <!--change color based on status-->
                <td>Charity Associate</td>
                <td>
                    <h6>Associate Suspicious Activity</h6>
                </td>
                <td>
                    <a href="#" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                        <i class="mdi mdi-open-in-new"></i> View
                    </a>
                    <a href="#" class="btn btn-sm btn-outline-dark waves-effect waves-light">
                        <i class="mdi mdi-pencil"></i> Edit
                    </a>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td><span class="badge bg-light">2022953132</span></td>
                <td>Cheng</td>
                <td>Mang Insala</td>
                <td>
                    <a href="mailto: robinhd_Lo@gmail.com">robinhd_Lo@gmail.com</a>
                </td>
                {{-- <td><i class="ri-checkbox-blank-circle-fill font-size-10 align-middle me-2 {{($item->status == 'Active')?'text-success':'text-warning'}}"></i>{{($item->status == 'Active')?'Active':'Pending'}}</td>  <!--change color based on status--> --}}
                <td><i class="ri-checkbox-blank-circle-fill font-size-10 align-middle me-2 text-danger"></i>Inactive</td>  <!--change color based on status-->
                <td>Charity Associate</td>
                <td>---</td>
                <td>
                    <a href="#" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                        <i class="mdi mdi-open-in-new"></i> View
                    </a>
                    <a href="#" class="btn btn-sm btn-outline-dark waves-effect waves-light">
                        <i class="mdi mdi-pencil"></i> Edit
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>