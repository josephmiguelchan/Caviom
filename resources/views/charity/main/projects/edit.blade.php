@extends('charity.charity_master')
@section('title', 'Edit Project Details')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>PROJECTS</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">Our Charitable Organization</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('charity.projects.all') }}">Projects</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                    @include('charity.modals.projects')
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <h2><strong>Edit Project Details</strong></h2>
                            </div>
                            <div class="col-lg-4 mt-4">
                                <a href="{{ url()->previous() }}" class="text-link float-end">
                                    <i class="ri-arrow-left-line"></i> Go Back
                                </a>
                            </div>
                        </div>

                        <hr class="my-3">

                        <form action="{{route('charity.projects.update',$project->code)}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3 row">
                                <!-- Project Name -->
                                <div class="col-md-9">
                                    <label for="name" class="form-label">*Project Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{$project->name}}" placeholder="@unless($errors->any())Enter name of the project @endunless">
                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Cover Photo -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cover_photo" class="form-label">
                                            Cover Photo
                                            <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Must not exceed 2mb." data-bs-original-title="yes">
                                                <i class="mdi mdi-information-outline"></i>
                                            </span>
                                        </label>
                                        <input class="form-control" name="cover_photo" id="cover_photo" type="file">
                                        @error('cover_photo')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <div class="col-md-9">
                                    <!-- Project Objective / Description -->
                                    <label for="objective" class="form-label">*Objective</label>
                                    <textarea id="elm1" rows="15" name="objective" placeholder="Enter your project's objective/s..."
                                        maxlength="500">
                           
                                        {{$project->objective}}
                                   
                                     
                                    </textarea>
                                    @error('objective')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                        <img class="img-fluid rounded" id="show_cover_photo" alt="Cover Photo Preview" src="{{($project->cover_photo)?url('upload/charitable_org/project_photo/'.$project->cover_photo):url('upload/charitable_org/placeholder.png')}}">
                                </div>
                            </div>



                            <div class="row p-5">
                                <ul class="list-inline mb-0 float-end">
                                    <button type="submit" class="btn btn-dark btn-rounded w-lg waves-effect waves-light float-end"><i class="ri-edit-2-line"></i> Save</button>
                                    <a class="btn list-inline-item float-end mx-4" href="{{ url()->previous() }}">Cancel</a>
                                </ul>
                            </div>

                        </form>
                    </div>
                </div>
            </div> <!-- end col -->

        </div>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var counter = 0;
        if (counter == 5) {

        } else {
            $(document).on("click",".addeventmore",function(){
                var whole_extra_item_add = $('#whole_extra_item_add').html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click",'.removeeventmore',function(event){
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter -= 1
            });

        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#cover_photo').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#show_cover_photo').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>


@endsection