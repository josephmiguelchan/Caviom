@extends('charity.charity_master')
@section('title', 'My Notifications')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class="p-2 mb-4">
                        <h1 class="mb-0" style="color: #62896d"><strong>NOTIFICATIONS</strong></h1>
                        <ol class="breadcrumb m-0 p-0 mb-3">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">
                                <a href="javascript: void(0);">My Account</a>
                            </li>
                            <li class="breadcrumb-item active">All Notifications</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-body">
                        <h2 class="mb-4"><strong>My Notifications</strong></h2>

                        @foreach ($notifications as $item)

                            <!-- Delete Modal -->
                            <div id="deleteModal_{{$item->code}}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>This will permanently delete this notification. Continue?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                            <a href="{{route('notifications.delete',$item->code)}}" class="btn btn-danger waves-effect waves-light w-sm">Yes</a>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
                        @endforeach

                        <table id="datatable" class="table table-borderless dt-responsive nowrap table-hover"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="table-bordered">
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($notifications as $key => $item)
                                @if ($item->read_status == 'read')
                                <tr class="table-light">
                                @endif

                                    <td>{{$key+1}}</td>
                                    <td>{{$item->category}}</td>
                                    <td>
                                        <a href="{{ route('notifications.view', $item->code) }}" class="text-reset">
                                            <div class="d-flex">
                                                <div class="avatar-xs me-3">
                                                    <span class="avatar-title bg-{{$item->color}} rounded-circle font-size-16">
                                                        <i class="{{$item->icon}}"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-1">
                                                    <h6 class="mb-1">{{$item->subject}} @if($item->read_status == 'unread')<span class="badge bg-danger">NEW</span>@endif</h6>
                                                    <div class="font-size-12 text-muted">
                                                        <p class="mb-1">{{Str::limit($item->message, 95)}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <td>{{Carbon\Carbon::parse($item->created_at)->toDateTimeString()}}</td>
                                    <td>
                                        <a href="{{ route('notifications.view', $item->code) }}" class="btn btn-sm btn-outline-primary waves-effect waves-light"
                                            title="View">
                                            <i class="mdi mdi-open-in-new"></i>
                                        </a>
                                        <button data-bs-toggle="modal" data-bs-target="#deleteModal_{{$item->code}}" class="btn btn-sm btn-outline-danger waves-effect waves-light"
                                            title="Delete">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>

                    </div>
                </div>

            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
@endsection