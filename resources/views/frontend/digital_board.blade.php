@extends('frontend.layouts.master')
@section('content')
    <main>
        <section>
            <x-frontend.scroll-news-component />
        </section>
        <section class="notice pt-3" style="background-color:#f5f5f5 ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9">
                        <div class="table-1 overflow-hidden">
                            <h2 class="heading border-0 fs-4" style="line-height: normal">नागरिक वडापत्र</h2>
                            <x-frontend.citizen-charter-component />
                        </div>
                        {{-- <div class="table-2">
                        <h2 class="heading">करका दायराहरु</h2>
                        <x-frontend.revenue-component/>
                    </div>  --}}
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="mt-0 video-container">
                                <x-frontend.digital-board-video-component />
                            </div>
                            <div class="mt-3">
                                <h2 class="heading border-0 fs-5" style="line-height: inherit">सूचना र परिपत्र</h2>
                                <x-frontend.notice-vertical-slider-component />
                            </div>
                            <div class="mt-3">
                                <h2 class="heading border-0 fs-5" style="line-height: inherit">जनप्रतिनिधि/कर्मचारी</h2>
                                <x-frontend.employee-section-component />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
