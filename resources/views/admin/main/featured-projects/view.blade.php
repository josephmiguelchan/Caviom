@extends('admin.admin_master')
@section('title', 'View Featured Projects')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>FEATURED PROJECTS</strong></h1>
                    <ol class="breadcrumb m-0 p-0 mb-3">
                        <li class="breadcrumb-item">Menu</li>
                        <li class="breadcrumb-item"><a href="{{route('admin.feat-projects.all')}}">Featured Projects</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- IF this Featured Project's Status == 'PENDING' -->
            <!-- Reject Modal -->
            <div id="rejectModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('admin.feat-projects.reject',$fp->code)}}" method="POST">
                                @csrf

                                <h4 class="fw-bold">Remarks for Rejection</h4>
                                <div class="m-3">
                                    <!-- Foreach ($notifiers (in featured project category) as $item) -->
                                    @foreach ($FpRemarks as $key => $item)
                                    
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="remarks_subject"
                                            id="remarks_subject_{{$key+1}}" value="{{$item->subject}}" required>
                                        <label class="form-check-label" for="remarks_subject_{{$key+1}}">
                                            <!-- $notifier->subject -->
                                            {{$item->subject}}
                                        </label>
                                        <p>
                                            {{$item->message}}
                                        </p>
                                    </div>
                                    <!-- End iF -->
                                    @endforeach
                                </div>

                                <p>
                                    You are about to <strong>REJECT</strong> this Featured Project with the following remarks above. This action <strong>CANNOT</strong> be undone and
                                    will refund their Star Tokens while notifying all other users in their Charitable Organization. Continue?
                                </p>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-danger waves-effect waves-light w-sm">Yes</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>

            <!-- Approve Modal -->
            <div id="approveModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>
                                You are about to <strong>APPROVE</strong> this featured project request.
                                This action <strong>CANNOT</strong> be undone and will notify all other users in their Charitable Organization.
                            </p>
                            <p>
                                Visibility status = <strong>VISIBLE</strong>, Approval Status = <strong>APPROVED</strong> and
                                Caviom will <strong>ACCEPT</strong> the Star Token Payment for this. Continue?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                            <a href="{{route('admin.feat-projects.approve',$fp->code)}}" class="btn btn-dark waves-effect waves-light w-sm">Yes</a>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        <!-- end IF -->


        <div class="col-12">
            <div class="card p-4">
                <div class="card-body">
                    <div class="row px-2">
                        <div class="col-lg-8">
                            <h2 class="fw-bold">{{$fp->name}}</h2>
                            <p>{{$fp->charity->name}}</p>
                        </div>
                        <div class="col-lg-4 mt-4">
                            <a href="{{ route('admin.feat-projects.all') }}" class="text-link float-end">
                                <i class="ri-arrow-left-line"></i> Go Back
                            </a>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-5 px-2">
                        <div class="col-lg-6">
                            <div class="row">
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Venue:</strong></h4></dt>
                                <dt class="col-md-8 mb-2">{{$fp->venue}}</dt>
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>No. of Beneficiaries:</strong></h4></dt>
                                <dt class="col-md-8 mb-2">{{$fp->total_beneficiaries}}</dt>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Date:</strong></h4></dt>
                                <dt class="col-md-8 mb-2">{{$fp->started_on}}</dt>
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Sponsors:</strong></h4></dt>
                                <dt class="col-md-8 mb-2"> {{ ($fp->Sponsors)?$item->Sponsors:'---' }}</dt>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="row">
                                    <dl class="col-md-12">
                                        <h4 class="font-size-15"><strong>Objective:</strong></h4>
                                        <p>
                                           {!!$fp->objectives!!}
                                        </p>

                                        <h4 class="font-size-15 mt-4"><strong>Thanksgiving Message:</strong></h4>
                                        <p>
                                           {!!$fp->message!!}
                                        </p>

                                        <div class="col-6">
                                            <h4 class="font-size-15 mt-4"><strong>Photos:</strong></h4>
              
                                            <div class="row text-center">
                                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-inner" role="listbox">
                                                        <div class="carousel-item active">
                                                            <img class="d-block img-fluid" src="{{ url('upload/featured_project/'.$fp->cover_photo) }}" alt="Cover Photo" 
                                                                style="max-height: 100%; width: 100%;">
                                                        </div>
                                                        @isset($fp->photos->featured_photo_1)
                                                        <div class="carousel-item">
                                                            <img class="d-block img-fluid" src="{{ url('upload/featured_project/'.$fp->photos->featured_photo_1) }}" alt="First Photo" 
                                                                style="max-height: 100%; width: 100%;">
                                                        </div>
                                                        @endisset
                                                        @isset($fp->photos->featured_photo_2)
                                                        <div class="carousel-item">
                                                            <img class="d-block img-fluid" src="{{ url('upload/featured_project/'.$fp->photos->featured_photo_2) }}" alt="Second Photo" 
                                                                style="max-height: 100%; width: 100%;">
                                                        </div>
                                                        @endisset

                                                        @isset($fp->photos->featured_photo_3)
                                                        <div class="carousel-item">
                                                            <img class="d-block img-fluid" src="{{ url('upload/featured_project/'.$fp->photos->featured_photo_3) }}" alt="Third Photo" 
                                                                style="max-height: 100%; width: 100%;">
                                                        </div>
                                                        @endisset

                                                        @isset($fp->photos->featured_photo_4)
                                                        <div class="carousel-item">
                                                            <img class="d-block img-fluid" src="{{ url('upload/featured_project/'.$fp->photos->featured_photo_4) }}" alt="Fourth Photo" 
                                                                style="max-height: 100%; width: 100%;">
                                                        </div>
                                                        @endisset

                                                        @isset($fp->photos->featured_photo_5)
                                                        <div class="carousel-item">
                                                            <img class="d-block img-fluid" src="{{ url('upload/featured_project/'.$fp->photos->featured_photo_5) }}" alt="Fifth Photo" 
                                                                style="max-height: 100%; width: 100%;">
                                                        </div>
                                                        @endisset
                                                    </div>
                                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                            </div>
                                           
                                        </div>

                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-5 px-2">
                        <div class="col-lg-6">
                            <div class="row">
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Visibility Status:</strong></h4></dt>

                                @if ($fp->visibility_status == "Hidden")
                                <dt class="col-md-8 mb-2"><i class="ri-eye-off-line"></i> {{$fp->visibility_status}}</dt>
                                @elseif($fp->visibility_status == "Visible")
                                <dt class="col-md-8 mb-2"><i class="ri-eye-line"></i> {{$fp->visibility_status}}</dt>
                                @endif

                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Approval Status:</strong></h4></dt>

                                @if ($fp->approval_status == 'Pending')
                                <dt class="col-md-8 mb-2"><span class="badge bg-warning">{{$fp->approval_status}}</span></dt>
                                @elseif($fp->approval_status == 'Approved')         
                                <dt class="col-md-8 mb-2"><span class="badge bg-success">{{$fp->approval_status}}</span></dt>     
                                @elseif($fp->approval_status == 'Rejected')         
                                <dt class="col-md-8 mb-2"><span class="badge bg-danger">Rejected</span></dt> 
                                @endif
                                
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Remarks:</strong></h4></dt>
                                <dt class="col-md-8 mb-2"><h6 class="fw-bold">{{ ($fp->remarks_subject)?$fp->remarks_subject:'---' }}</h6></dt>
                                <dd class="col-md-8 offset-md-4">{{ ($fp->remarks_message)?$fp->remarks_message:'' }}</dt>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Date Added:</strong></h4></dt>
                                <dt class="col-md-8 mb-2">{{ ($fp->created_at)?Carbon\Carbon::parse($fp->created_at)->isoFormat('MMMM d, YYYY'):'---' }}</dt>
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Status Last Updated:</strong></h4></dt>
                                <dt class="col-md-8 mb-2">{{ ($fp->updated_at)?Carbon\Carbon::parse($fp->status_updated_at)->diffForHumans():'---' }}</dt>
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Reviewed By:</strong></h4></dt>
                                <dt class="col-md-8 mb-2">{!! ($fp->reviewed_by)?'<a target="_blank" href="'.route('admin.users.view',$fp->user->code).'">'.$fp->user->username.'</a>':'---' !!}</dt>
                            </div>
                        </div>
                    </div>

                    <!-- Show these buttons only IF this Featured Project's Status == 'PENDING' -->
                    @if ($fp->approval_status == 'Pending')
                    <div class="float-end">
                        <div class="row my-3 mx-2">
                            <div class="col-md-12">
                               
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#rejectModal" class="btn w-lg btn-outline-danger waves-effect waves-light">
                                        <i class="mdi mdi-close-thick"></i> Reject
                                    </button>

                                    <button type="button" class="btn w-lg btn-success waves-effect waves-light mx-1" data-bs-target="#approveModal" data-bs-toggle="modal">
                                        <i class="mdi mdi-check"></i> Approve
                                    </button>
                                </div>
                               
                             
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- End IF -->

                </div>

            </div>
        </div> <!-- end col -->


    </div>

</div>

@endsection