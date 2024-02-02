@extends('frontend.layouts.master')
@section('content')
    <section class="grievance-list">
        <div class="container mt-4">
            <div class="breadcrumb d-flex">
                <div class="breadcrumb-item">
                    <a class="whitespace-nowrap text-primary-500" href="{{route('welcome')}}">गृहपृष्ठ</a>
                    <i class="fa fa-angle-double-right"></i>
                    <a class=" text-primary-500 text-center">सूचना सुची</a>
                </div>

            </div>
            <div class="row mt-3">
                <h2>सुचनाहरु</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>सि.न</th>
                        <th>शीर्षक</th>
                        <th>प्रकाशित मिति</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($notices as $notice)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$notice->title}}</td>
                            <td>{{$notice->date}}</td>
                            <td>
                                <button class="btn btn-download btn-light">
                                    <a href="{{route('single-notice',$notice)}}"><i class="fa-solid fa-eye"></i></a>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

