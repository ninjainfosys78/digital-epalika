@extends('frontend.layouts.master')
@section('content')
    <section class="inner-section mt-lg-5 ">
        <div class="container">
            <div class="row d-flex mt-5 ">
                <div class="breadcrumb d-flex">
                    <div class="breadcrumb-item">
                        <a class="whitespace-nowrap text-primary-500"
                            href="{{ route('grievanceHandling.grievance') }}">गुनासो</a>
                        <i class="fa fa-angle-double-right ml-lg-1 text-light"></i><a class="ml-1 text-primary-500">गुनासो
                            ट्रयाक</a>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="col-md-8 border shadow p-4 rounded  overflow-hidden">
                        <h5>गुनासोको विषय: {{ $grievanceDetail->subject }}</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>आवेदकको नाम: {{ $grievanceDetail->grievanceUser->name ?? '' }}</h6>
                                <h6>आवेदकको नम्बर: {{ $grievanceDetail->grievanceUser->phone ?? '' }}</h6>
                                <h6>टोकन नम्बर: {{ $grievanceDetail->token ?? '' }}</h6>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-end">गुनासोको प्रकार: {{ $grievanceDetail->grievanceType->title ?? '' }}
                                </h6>
                                <h6 class="text-end">सम्वन्धित शाखा: {{ $grievanceDetail->grievanceOffice->title ?? '' }}
                                </h6>
                                <h6 class="text-end">गुनासोको स्थिति: <span
                                        class="px-2 text-white rounded {{ $grievanceDetail->status->color() ?? '' }}">{{ $grievanceDetail->status->label() ?? '' }}</span>
                                </h6>
                            </div>
                        </div>
                        <div>
                        </div>
                        <div class="grievanceChat mt-2 border rounded px-2 overflow-auto">
                            <div id="chat">
                                <div class="my-2 p-2" style="height:100vh;overflow-y:scroll;">
                                    <div class="border rounded p-2">
                                        <div class="d-flex justify-content-end my-3 border p-2 rounded">
                                            <div class="d-flex align-items-center gap-2">
                                                <img class="order-2"
                                                    src="{{ $grievanceDetail->grievanceUser->avatar ?? '' }}" alt="avatar 1"
                                                    height="50">
                                                <div class="order-1">
                                                    <p class="small">{{ $grievanceDetail->grievanceUser->name ?? '' }}</p>
                                                    <p class="small text-muted">
                                                        {{ $grievanceDetail->created_at?->calendar() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column align-items-end">
                                            <h6 class="p-2 me-3 mb-1 rounded bg-light">
                                                {{ $grievanceDetail->description }}</h6>
                                            @foreach ($grievanceDetail->files as $file)
                                                <a class="me-3 btn btn-primary btn-sm" href="{{ $file->file_url }}"
                                                    download="{{ $file->file_url }}">
                                                    {{ $file->file_name }} <i class="fa fa-download"></i>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <hr>
                                    @foreach ($grievanceDetail->grievanceDetails as $detail)
                                        @if (!empty($detail->user_id))
                                            <div class="border rounded p-2">
                                                <div class="d-flex justify-content-start my-3 border p-2 rounded">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <img class="order-1" src="{{ $detail->user->avatar ?? '' }}"
                                                            alt="avatar 1" height="50">
                                                        <div class="order-2">
                                                            <p class="small">{{ $detail->user->name ?? '' }}</p>
                                                            <p class="small text-muted">
                                                                {{ $detail->created_at?->calendar() }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column align-items-start">
                                                    <h6 class="p-2 ms-3 mb-1 rounded bg-light">
                                                        {{ $detail->description }}</h6>
                                                    @foreach ($detail->files as $detailFile)
                                                        <a class="me-3 btn btn-primary btn-sm"
                                                            href="{{ $detailFile->file_url }}"
                                                            download="{{ $detailFile->file_url }}">
                                                            {{ $detailFile->file_name }} <i class="fa fa-download"></i>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                            <div class="border rounded p-2">
                                                <div class="d-flex justify-content-end my-3 border p-2 rounded">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <img class="order-2"
                                                            src="{{ $detail->grievanceUser->avatar ?? '' }}" alt="avatar 1"
                                                            height="50">
                                                        <div class="order-1">
                                                            <p class="small">{{ $detail->grievanceUser->name ?? '' }}</p>
                                                            <p class="small text-muted">
                                                                {{ $detail->created_at?->calendar() }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column align-items-end">
                                                    <h6 class="p-2 me-3 mb-1 rounded bg-light">
                                                        {{ $detail->description }}</h6>
                                                    @foreach ($detail->files as $detailFile)
                                                        <a class="me-3 btn btn-primary btn-sm"
                                                            href="{{ $detailFile->file_url }}"
                                                            download="{{ $detailFile->file_url }}">
                                                            {{ $detailFile->file_name }} <i class="fa fa-download"></i>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        @if (!$loop->last)
                                            <hr>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <form enctype="multipart/form-data"
                                action="{{ route('grievanceHandling.replyGrievance', $grievanceDetail) }}"
                                method="POST">
                                @csrf
                                <div class="d-flex justify-content-start align-items-center my-4 p-2">
                                    <input type="text" class="form-control flex-shrink-1" name="description"
                                        id="description" placeholder="Type message">
                                    <div class="flex-shrink-0 text-center">


                                        <input type="file" id="upload" name="files[]" multiple hidden />
                                        <label class="ms-1 text-muted" for="upload"><i
                                                class="fas fa-paperclip"></i></label>



                                        <button type="submit" class="btn bg-white ms-3 link-info" href="#"><i
                                                class="fas fa-paper-plane"></i></button>
                                    </div>
                                </div>
                            </form>
                            @error('files.*')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            @error('files')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
