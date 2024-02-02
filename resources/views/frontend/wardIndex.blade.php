@extends('frontend.layouts.master')
@section('content')
<main>
    <section>
        <x-frontend.scroll-news-component />
    </section>
    <section class="notice mt-1">
        <div class="row">
            <div class="col-md-9">
                <div class="table-1">
                    <h2 class="heading">नागरिक वडापत्र</h2>
                    <x-frontend.citizen-charter-component :ward="$ward" />
                </div>
                {{-- <!-- <div class="table-2">
                        <h2 class="heading">करका दायराहरु</h2>
                        <x-frontend.revenue-component  :ward="$ward"/>
                    </div> --> --}}
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class=" mb-2 video-container">
                        <x-frontend.digital-board-video-component :ward="$ward" />
                    </div>
                    <div class="">
                        <h2 class="heading">सूचना र परिपत्र</h2>
                        <x-frontend.notice-vertical-slider-component :ward="$ward" />
                    </div>
                    <div class="">
                        <h2 class="heading">जनप्रतिनिधि/कर्मचारी</h2>
                        <x-frontend.employee-section-component :ward="$ward" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection