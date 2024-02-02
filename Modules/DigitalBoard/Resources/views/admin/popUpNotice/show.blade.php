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
                            <a href="{{route('admin.digitalBoard.popUpNotice.index')}}">Pop Up सूची </a>
                        </li>
                        <li class="breadcrumb-item active">Pop Up हेर्नुहोस</li>
                    </ol>
                </div>
                <h4 class="page-title">Pop Up हेर्नुहोस</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">Pop Up सूची</h4>

                        <a href="{{route('admin.digitalBoard.popUpNotice.index')}}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> Pop Up सूची
                        </a>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-hover">

                                    <tbody>
                                    <tr>
                                        <th>शिर्षक</th>
                                        <td>{{$popUpNotice->title}}</td>
                                    </tr>
                                    <tr>
                                        <th>मिति</th>
                                        <td>{{$popUpNotice->date}}</td>
                                    </tr>

                                    <tr>
                                        <th>बिवरण</th>
                                        <td>{!! $popUpNotice->description !!}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        @foreach($popUpNotice->files as $document)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        <a href="{{route('admin.file-url-download', ['file_url'=>$document->file])}}"
                                           class="btn btn-xs btn-outline-primary">
                                            <i class="fa fa-download"></i>
                                        </a>
                                        <form action="{{route('admin.file.destroy',$document)}}" style="float: right"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="show_confirm btn btn-sm btn-danger ml-2">
                                                <i class="fa fa-window-close"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="card-body">
                                        @if($document->extension ==='pdf')
                                            <iframe src="{{$document->file_url}}" frameborder="0" width="100%"></iframe>
                                        @elseif(($document->extension ==='png') or ($document->extension ==='jpg') or ($document->extension ==='jpeg'))
                                            <img src="{{ $document->file_url }}" class="card-image" alt="Image"
                                                 height=150px;" width="100%">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
