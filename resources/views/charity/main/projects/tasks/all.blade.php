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
            <tr>
                <td>1</td>
                <td>
                    <span class="badge badge-soft-warning">Pending</span> Prepare the program flow for..
                </td>
                <td>Prioritize this task as this will be..</td>
                <td><a href="#">Pangilinan, J.</a></td>
                <td><a href="#">Galleno, J.</a></td>
                <td>Thu, Dec 25, 2022 2:15 PM</td>
                <td>2 days</td>
                <td>
                    <a href="{{ route('charity.projects.tasks.view') }}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                        <i class="mdi mdi-open-in-new"></i> View
                    </a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>
                    <span class="badge badge-soft-primary">In-Progress</span> End the generational tra..
                </td>
                <td>---</td>
                <td><a href="#">Pangilinan, J.</a></td>
                <td><a href="#">Jojo, D.</a></td>
                <td>Thu, Dec 25, 2022 2:15 PM</td>
                <td>14 hours ago</td>
                <td>
                    <a href="" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                        <i class="mdi mdi-open-in-new"></i> View
                    </a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>
                    <span class="badge badge-soft-success">Completed</span> Prepare the financial plan for..
                </td>
                <td>---</td>
                <td><a href="#">Pangilinan, J.</a></td>
                <td><strong>You</strong></td>
                <td>Thu, Dec 25, 2022 2:15 PM</td>
                <td>Just now</td>
                <td>
                    <a href="" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                        <i class="mdi mdi-open-in-new"></i> View
                    </a>
                </td>
            </tr>
        </tbody>
    </table>

</div>