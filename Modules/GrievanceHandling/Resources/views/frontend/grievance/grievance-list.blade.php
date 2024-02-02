@extends('frontend.layouts.master')
@section('content')
    <section class="grievance-list">
        <div class="container">
            <div class="breadcrumb d-flex mt-5">
                <div class="breadcrumb-item">
                    <a class="whitespace-nowrap text-primary-500"
                       href="{{route('grievanceHandling.grievance')}}">गुनासो</a>
                    <i class="fa fa-angle-double-right ml-lg-1 text-light"></i><a class="ml-1 text-primary-500">गुनासो सुची</a>
                </div>
            </div>
            <div class="row mt-3">
                <h2 class="text-center">दर्ता भएका सम्पूर्ण गुनासो सुची</h2>
                <table class="table table-bordered">
                    <thead>
                    <tr class="fs-5">
                        <th>सि.न</th>
                        <th>आवेदन.न</th>
                        <th>गुनासो प्रकार</th>
                        <th>स्थिति</th>
                        <th>प्रकाशित मिति</th>
                        <th>प्रतिक्रिपा</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>१.</td>
                        <td>२५४५२</td>
                        <td>लागुपदार्थ को दुरुपयोग</td>
                        <td class="d-flex">
                            <button class="btn btn-view btn-light">
                                <i class="fa-solid fa-reply"></i>
                            </button>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </td>
                        <td>२०७९-०६-०६</td>
                        <td>
                            <button class="btn btn-download btn-light">
                                <a href="#"><i class="fa-solid fa-eye"></i></a>
                            </button>
                        </td>

                    </tr>
                    <tr class="bg-gray">
                        <td>१.</td>
                        <td>२५४५२</td>
                        <td>लागुपदार्थ को दुरुपयोग</td>
                        <td class="d-flex">
                            <button class="btn btn-view btn-light">
                                <i class="fa-solid fa-reply"></i>
                            </button>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </td>
                        <td>२०७९-०६-०६</td>
                        <td>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="danger">
                        <td>१.</td>
                        <td>२५४५२</td>
                        <td>लागुपदार्थ को दुरुपयोग</td>
                        <td class="d-flex">
                            <button class="btn btn-view btn-light">
                                <i class="fa-solid fa-reply"></i>
                            </button>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </td>
                        <td>२०७९-०६-०६</td>
                        <td>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="info">
                        <td>१.</td>
                        <td>२५४५२</td>
                        <td>लागुपदार्थ को दुरुपयोग</td>
                        <td class="d-flex">
                            <button class="btn btn-view btn-light">
                                <i class="fa-solid fa-reply"></i>
                            </button>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </td>
                        <td>२०७९-०६-०६</td>
                        <td>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="warning">
                        <td>१.</td>
                        <td>२५४५२</td>
                        <td>लागुपदार्थ को दुरुपयोग</td>
                        <td class="d-flex">
                            <button class="btn btn-view btn-light">
                                <i class="fa-solid fa-reply"></i>
                            </button>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </td>
                        <td>२०७९-०६-०६</td>
                        <td>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="active">
                        <td>१.</td>
                        <td>२५४५२</td>
                        <td>लागुपदार्थ को दुरुपयोग</td>
                        <td class="d-flex">
                            <button class="btn btn-view btn-light">
                                <i class="fa-solid fa-reply"></i>
                            </button>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </td>
                        <td>२०७९-०६-०६</td>
                        <td>
                            <button class="btn btn-download btn-light">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
