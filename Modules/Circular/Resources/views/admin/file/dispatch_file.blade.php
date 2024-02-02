@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.circular.files.dispatch-file')}}">चलानी फाईल</a>
                        </li>
                        <li class="breadcrumb-item active">फाईल</li>
                    </ol>
                </div>
                <h4 class="page-title">चलानी फाईल</h4>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="inbox-leftbar">
                        <div class="d-block mb-2">
                            <h5 class="font-16">Dispatch</h5>
                        </div>
                        <div class="custom-list">
                            <ul class="file-list">
                                @foreach(getAllForSideBarFolders('registration') as $folder)
                                    @include('inc.sideFolders',['folder'=>$folder])
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="inbox-rightbar">
                        <div class="d-md-flex justify-content-between align-items-center">
                            <form class="search-bar">
                                <div class="position-relative">
                                    <input type="text" class="form-control form-control-light"
                                           placeholder="Search files...">
                                    <span class="mdi mdi-magnify"></span>
                                </div>
                            </form>
                        </div>

                        <div class="mt-3" id="file-data">
                        </div> <!-- end .mt-3-->
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div> <!-- end card -->

        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                ajaxCall("{{route('admin.file.get-file-manager',['folder'=>'registration'])}}");
            });

            $(".file-handle").click(function () {
                // get data from data-bs-folder
                let folder = $(this).data('bs-folder');

                let url = "{{route('admin.file.get-file-manager',['folder'=>'folder_path'])}}";

                ajaxCall(url.replace('folder_path', folder));
            });

            function ajaxCall(url) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (data) {
                        const printTo = $('#file-data')
                        printTo.empty();
                        data.directories.forEach(function (item) {
                            item.children.forEach(function (child){
                                printTo.append(`<h5 class="mb-2 text-capitalize">` + child.label + `</h5>
                            <div class="row mx-n1 g-0">
                                <div class="col-md-6">
                                    <div class="card m-1 shadow-none border">
                                        <div class="p-2">
                                            <div class="row align-items-center justify-content-between">
                                                <div class="col-auto pe-0">
                                                    <div class="avatar-sm">
                                                        <span class="avatar-title bg-light text-secondary rounded">
                                                            <i class="fa fa-file-pdf font-18"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col text-truncate">
                                                    <a href="javascript:void(0);" class="text-muted fw-bold">Ubold-sketch-design.zip</a>
                                                    <p class="mb-0 font-13">2.3 MB</p>
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button"
                                                            class="btn btn-blue btn-sm waves-effect waves-light"><i
                                                            class="fa fa-download"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`)
                            })
                        });
                    }
                });
            }
        </script>
    @endpush
@endsection
