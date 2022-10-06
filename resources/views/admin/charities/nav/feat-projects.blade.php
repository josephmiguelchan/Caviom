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
            <tr>
                <td>1</td>
                <td><span class="badge bg-warning">PENDING</span> Medical Mission 2022</a></td>
                <td>June 12, 2022</td>
                <td><i class="ri-eye-off-line"></i> Hidden</td>
                <td>---</td>
                <td>2015-04-21 22:32:05</td>
                <td>
                    <a href="{{ route('admin.feat-projects.view') }}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                        <i class="mdi mdi-open-in-new"></i> View
                    </a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td><span class="badge bg-success">APPROVED</span> Lugaw for a Cause</a></td>
                <td>June 2, 2022</td>
                <td><i class="ri-eye-line"></i> Visible</td>
                <td>---</td>
                <td>2015-04-21 22:32:05</td>
                <td>
                    <a href="#" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                        <i class="mdi mdi-open-in-new"></i> View
                    </a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td><span class="badge bg-danger">REJECTED</span> Spanish Inquisition</a></td>
                <td>June 1, 1672</td>
                <td><i class="ri-eye-off-line"></i> Hidden</td>
                <td>Inappropriate Project / Invalid date</td>
                <td>2015-04-21 22:32:05</td>
                <td>
                    <a href="#" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                        <i class="mdi mdi-open-in-new"></i> View
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>