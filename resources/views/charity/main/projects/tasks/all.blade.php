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
                <th>Status</th>
                <th>Deadline</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>1</td>
                <td>
                    Prepare the program flow for..
                </td>
                <td>Prioritize this task as this will be..</td>
                <td>Pangilinan, J.</td>
                <td>Galleno, J.</td>
                <td>
                    <span class="text-warning">Pending</span>
                </td>
                <td>Thu, Dec 25, 2022 2:15 PM</td>
                <td>
                    <a href="" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                        <i class="mdi mdi-open-in-new"></i>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>

</div>