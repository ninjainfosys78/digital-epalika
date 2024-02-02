@extends('emap::organization.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">नोटिफिकेसन</li>
                    </ol>
                </div>
                <h4 class="page-title">नोटिफिकेसन</h4>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4 class="header-title mb-0">नोटिफिकेसन</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>क्र.स</th>
                        <th>विषय</th>
                        <th>विवरण</th>
                        <th>समय</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($notifications as $key=>$notification )
                        <tr @class(['table-secondary'=> !$notification->read_at])>
                            <td>{{ $loop->iteration }}</td>
                            <td> @switch(class_basename($notification->type))
                                    @case('ApplyMapNoticeNotification')
                                        घर-नक्सा पासमा नयाँ निबेदन/प्रतिबेदन प्राप्त
                                        @break
                                    @case('MapApplyNotification')
                                        घर-नक्सा पासमा नयाँ नक्सा प्राप्त
                                        @break
                                    @default
                                        नयाँ नोटिफिकेसन
                                @endswitch</td>
                            <td>
                                @foreach ($notification->data as $key=>$data)
                                    <p class="lh-lg">{{ Str::upper($key).' : ' .$data }}</p>
                                @endforeach
                            </td>
                            <td>{{ $notification->created_at->diffForHumans() }}</td>
                            <td>
                                <a data-bs-type="show" href="{{ route('organization.admin.notification.read',$notification) }}"
                                   class="btn btn-outline-primary btn-sm"  data-bs-toggle="tooltip" data-bs-placement="top" title="हेर्नुहोस">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$notifications->links()}}
            </div>
        </div>
    </div>
@endsection
