@extends('admin.layouts.master')
@section('content')
    <div class="wizard">
        <div class="wizard-inner">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation">
                    <a href="#step1" class="active" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"
                       data-step="1">
                        <span class="round-tab">1</span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#step2" class="disabled" data-toggle="tab" aria-controls="step2" role="tab"
                       aria-expanded="false" data-step="2">
                        <span class="round-tab">2</span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#step3" class="disabled" data-toggle="tab" aria-controls="step3" role="tab"
                       data-step="3">
                        <span class="round-tab">3</span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#step4" class="disabled" data-toggle="tab" aria-controls="step4" role="tab"
                       data-step="4">
                        <span class="round-tab">4</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @push('style')
        <style>
            .wizard>div.wizard-inner {
                position: absolute;
                bottom: 20px;
            }

            .wizard .nav-tabs {
                position: relative;
                margin-bottom: 0;
                border-bottom-color: transparent;
            }

            .wizard .nav-tabs>li {
                width: 25%;
                position: relative;
            }

            .wizard .nav-tabs>li::before,
            .wizard .nav-tabs>li::after {
                content: '';
                position: absolute;
                height: 2px;
                width: 100%;
                top: 50%;
                background-color: #ced2f2;
                left: 15px;
                transition: 0.5s;
            }

            .wizard .nav-tabs>li a {
                padding: 15px;
                position: relative;
            }

            .wizard .nav-tabs>li>a.active .round-tab,
            .wizard .nav-tabs>li>a.active:hover .round-tab,
            .wizard .nav-tabs>li>a.active:focus .round-tab {
                cursor: default;
                background-color: #5161ce;
                color: #fff;
            }

            .wizard .nav-tabs>li a .round-tab {
                width: 30px;
                height: 30px;
                color: #868cbd;
                font-weight: 600;
                background-color: #ced2f2;
                display: inline-block;
                border-radius: 50%;
                padding-top: 6px;
                text-align: center;
                z-index: 1;
                position: relative;
                transition: 0.5s;
            }

            .wizard .nav-tabs>li::after {
                background-color: #42b161;
                width: 0;
            }

            .wizard .nav-tabs>li::before,
            .wizard .nav-tabs>li::after {
                content: '';
                position: absolute;
                height: 2px;
                width: 100%;
                top: 50%;
                background-color: #ced2f2;
                left: 15px;
                transition: 0.5s;
            }
        </style>
    @endpush
@endsection
