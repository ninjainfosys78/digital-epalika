@extends('frontend.layouts.master')
@section('content')
    <section class="inner-section mt-lg-5 ">
        <div class="container-fluid">
            <div class="row d-flex mt-5 ">
                    <div class="breadcrumb d-flex">
                        <div class="breadcrumb-item">
                            <a class="whitespace-nowrap text-primary-500" href="{{url('e-map')}}">ई-नक्सा</a>
                            <i class="fa fa-angle-double-right text-light"></i>
                            <a class=" text-primary-500 text-center">सूचना</a>
                        </div>

                    </div>
                    <h4 class="fw-semibold heading-line">सूचनाहरु</h4>
                    <p>तल दिएको सूचना पढनुहोस् र आफुले चाहेको सूचना डाउनलोड गर्नुहोस्। </p>
                    <div class="bg-card shadow rounded overflow-hidden">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">क्र.स.</th>
                                <th scope="col">सूचना शीर्षक</th>
                                <th scope="col">प्रकाशित मिति</th>
                                <th scope="col">फाईल</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">१</th>
                                <td>विपन्‍न बस्तीमा मुख्यमन्त्री कार्यक्रम सञ्‍चालन मापदण्ड, २०७८</td>
                                <td>२०७९/०२/११</td>
                                <td class="d-flex justify-content-around">
                                    <a href=""><i class="fa fa-eye"></i></a>
                                    <a href=""><i class="fa fa-download"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">१</th>
                                <td>विपन्‍न बस्तीमा मुख्यमन्त्री कार्यक्रम सञ्‍चालन मापदण्ड, २०७८</td>
                                <td>२०७९/०२/११</td>
                                <td class="d-flex justify-content-around">
                                    <a href=""><i class="fa fa-eye"></i></a>
                                    <a href=""><i class="fa fa-download"></i></a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </section>
@endsection
