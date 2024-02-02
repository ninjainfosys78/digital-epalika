@extends('frontend.layouts.master')
@section('content')
<section class="public-grievance">
    <div class="container">
        <div class="row">
            <div class="row pt-2">
                <div class="breadcrumb d-flex">
                    <div class="breadcrumb-item">
                        <a class="whitespace-nowrap text-primary-500" href="{{route('grievanceHandling.grievance')}}">गुनासो</a>
                        <i class="fa fa-angle-double-right ml-lg-1 text-light"></i><a class="ml-1 text-primary-500">सार्वजनिक गुनासो</a>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body grievance-answer">
                        <h3>सार्वजनिक गरिएका गुनासोहरु</h3>
                        <hr>
                        <div class="list-group">
                        <ol>
                            <li class="btn w-100 d-flex justify-content-start list-group-item" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="false" >
                                सार्वजनिक भएका गुनासो हरु को शीर्षक हरु क्रमश: यहा देखिनेछ्न
                            </li>
                        </ol>
                        </div>
                        <div class="collapse" id="collapse">
                            <div class="card card-body">
                                <p><i class="fa fa-angle-double-right m-lg-1"></i>सार्वजनिक भएका गुनासो हरु को उतरहरु क्रमश: यहा देखिनेछ्न |</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
