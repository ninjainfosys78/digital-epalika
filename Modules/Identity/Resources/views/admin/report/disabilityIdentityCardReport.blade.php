@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('identity.admin.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active"> अपाङ्गता परिचयपत्र रिपोर्ट</li>
                    </ol>
                </div>
                <h4 class="page-title"> अपाङ्गता परिचयपत्र रिपोर्ट</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card" >
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title"> अपाङ्गता परिचयपत्र रिपोर्ट</h4>
                        <div>
                            <button class="btn btn-sm btn-info" onclick="printJS({
                            printable: 'printData',
                            targetStyles: ['*'],
                            ignoreElements:['ignore-header'],
                            type: 'html'
                            })">
                                <i class="fa fa-print"></i> Print
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body" >
                    <div class="table-responsive">
                        <table id="printData" class="table table-sm table-bordered table-hover">
                            <thead>
                            <tr>
                                <th rowspan="3" class="align-middle">क्रम संख्या</th>
                                <th rowspan="3" class="align-middle">अपाङ्गताको प्रकार</th>
                                <th colspan="20" class="text-center">वर्ग</th>
                            </tr>
                            <tr>
                                @foreach($governmentalDisabilityTypes as $governmentalDisabilityType)
                                    <th colspan="4">{{$governmentalDisabilityType->category?->label()??''}} वर्ग  {{$governmentalDisabilityType->title}}</th>
                                @endforeach
                                <th colspan="4">जम्मा</th>
                            </tr>
                            <tr>
                                <td>पुरुष</td>
                                <td>महिला</td>
                                <td>अन्य</td>
                                <td>जम्मा</td>
                                <td>पुरुष</td>
                                <td>महिला</td>
                                <td>अन्य</td>
                                <td>जम्मा</td>
                                <td>पुरुष</td>
                                <td>महिला</td>
                                <td>अन्य</td>
                                <td>जम्मा</td>
                                <td>पुरुष</td>
                                <td>महिला</td>
                                <td>अन्य</td>
                                <td>जम्मा</td>
                                <td>पुरुष</td>
                                <td>महिला</td>
                                <td>अन्य</td>
                                <td>जम्मा</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($disabilityTypes as $disabilityType)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$disabilityType->title}}</td>
                                    @foreach($disabilityType->cardsCount as $cardCount)
                                        <td>{{$cardCount['male'] ??'-'}}</td>
                                        <td>{{$cardCount['female']??'-'}}</td>
                                        <td>{{$cardCount['other'] ??'-'}}</td>
                                        <td>{{$cardCount['total'] ??'-'}}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


