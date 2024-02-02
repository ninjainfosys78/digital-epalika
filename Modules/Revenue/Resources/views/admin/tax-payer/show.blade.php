@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.revenue.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">करदाता</li>
                    </ol>
                </div>
                <h4 class="page-title">करदाता</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">करदाताहरुको विवरण</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @can('taxPayer_access')
                                <a href="{{route('admin.revenue.taxPayer.index')}}"
                                   class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                    <i class="fa fa-list"></i> सुची</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>करदाताको प्रकार</th>
                            <td>{{$taxPayer->taxPayerType->title ?? ''}}</td>
                            <th>दर्ता भएको आर्थिक वर्ष</th>
                            <td>{{$taxPayer->fiscalYear->title ?? ''}}</td>
                        </tr>
                        <tr>
                            <th>घर नं.</th>
                            <td>{{$taxPayer->house_no}}</td>
                            <th>दर्ता नं.</th>
                            <td>{{$taxPayer->registration_no}}</td>
                        </tr>
                        <tr>
                            <th>नाम</th>
                            <td>{{$taxPayer->name}} ({{$taxPayer->name_en}})</td>
                            <th>फोन</th>
                            <td>{{$taxPayer->phone}}</td>
                        </tr>
                        <tr>
                            <th>ई-मैल</th>
                            <td>{{$taxPayer->email}}</td>
                            <th>ठेगाना</th>
                            <td>{{$taxPayer->address}}</td>
                        </tr>
                        <tr>
                            <th>लिङ्ग</th>
                            <td>{{$taxPayer->gender}}</td>
                            <th>बुवाको नाम</th>
                            <td>{{$taxPayer->father_name}}</td>
                        </tr>
                        <tr>
                            <th>बाजेको नाम</th>
                            <td>{{$taxPayer->grandfather_name}}</td>
                            <th>नागरिकता नं.</th>
                            <td>{{$taxPayer->citizenship_no}}</td>
                        </tr>
                        <tr>
                            <th>नागरिकता जारी जिल्ला</th>
                            <td>{{$taxPayer->issued_district}}</td>
                            <th>नागरिकता जारि मिति</th>
                            <td>{{$taxPayer->issued_date}}</td>
                        </tr>
                        <tr>
                            <th>पुरा ठेगाना</th>
                            <td>{{$taxPayer->local_body_id}}-{{$taxPayer->ward}},{{$taxPayer->tole}}
                                , {{$taxPayer->district_id}},{{$taxPayer->province_id}}</td>
                            <th>कैफियत</th>
                            <td>{{$taxPayer->remarks}}</td>
                        </tr>
                        <tr>
                            <th>सक्रिय छ ?</th>
                            <td>
                                <i class="fa {{$taxPayer->is_active ? "fa-check text-success":"fa-times text-danger"}} "></i>
                            </td>
                            <th>पेशा</th>
                            <td>{{$taxPayer->occupation}}</td>
                        </tr>

                        <tr>
                            <th>गाउँ</th>
                            <td>{{$taxPayer->village}}</td>
                            <th>दर्ता गर्ने कर्मचारी</th>
                            <td>{{$taxPayer->user->name ?? ''}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($invoices as $index=>$invoice)
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="header-title mb-0">{{$index}}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>क्र.स</th>
                                <th>मिति</th>
                                <th>रसिद नं</th>
                                <th>नाम</th>
                                <th>रकम</th>
                                <th>कैफियत</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($invoice as $key=>$data)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->payment_date ?? ''}}</td>
                                    <td>{{$data->invoice_no ?? ''}}</td>
                                    <td>{{$data->name ?? ''}}</td>
                                    <td>{{$data->invoice_particulars_sum_total ?? ''}}</td>
                                    <td>{{$data->remarks ?? ''}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
