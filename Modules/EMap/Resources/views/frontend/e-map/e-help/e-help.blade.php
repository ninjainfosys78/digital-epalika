@extends('frontend.layouts.master')
@section('content')
    <section class="help-section">
        <div class="container">
            <div class="d-flex mt-5">
                <div class="breadcrumb d-flex">
                    <div class="breadcrumb-item">
                        <a class="whitespace-nowrap text-primary-500" href="{{url('e-map')}}">ई-नक्सा</a>
                        <i class="fa fa-angle-double-right text-light"></i>
                        <a class="ml-1 text-primary-500">सहयोग</a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 mt-3">
                    <h4 class="fw-semibold heading-line">सहयोग</h4>
                    <p>इ-नक्सा सबन्धि सहयोगको लागि ।</p>
                    <div class="card-01 mt-3">
                        <strong>१. घर बनौउन के के कुराहरु हुनुपर्छ |</strong>
                        <br>
                        <p>- आफ्नै जग्गा, कुनैपनि सरकारी मुदा नचलेको</p>
                        <hr>
                        <strong>२. घर जग्गाको लागि बुझ्नलाई सम्पर्क न:</strong>
                        <br>
                        <p>- 081-91781289</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
