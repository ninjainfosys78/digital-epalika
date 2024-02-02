<?php
// Set the default time zone to your desired time zone
date_default_timezone_set('Asia/Kathmandu');

// Get the current date and time
$currentDateTime = date('Y-m-d H:i:s');
?>
<div class="background module-header"
    style="background-image: url('{{ officeSetting()->background_image_url ?? asset('images/bg.png') }}')">
    <div class="container-fluid d-lg-flex justify-content-between align-items-center">
        <div class="d-flex gap-2 align-items-center">
            <a href="{{ route('welcome') }}" class="main-logo">
                <img alt="nepal-government-logo" class="logo img-responsive center-block d-block mx-auto"
                    src="{{ asset('assets/frontend/image/logo.png') }}" />
            </a>
            <x-header-component :ward="$ward ?? null" />
        </div>
        <div class="d-flex align-items-center">
            <a href="{{ route('digital-service') }}" class="me-3 text-white ">विधुतीय शुसासन सेवा</a>
            <a href="{{ route('welcome') }}" class="main-logo d-flex align-items-center" style="text-decoration: none">
                <img alt="nepal-flag" class="logo img-responsive center-block ms-2 bg-white"
                    src="{{ asset('assets/frontend/image/nepal_flag.gif') }}"
                    style="height: 35px; padding: 2px; border-radius: 4px; border-top-right-radius: 0; border-bottom-right-radius: 0" />
                <span class="fw-bold"
                    style="display: inline-flex;
                    justify-content: center;
                    align-items: center;
                    padding: 5px 15px;
                    background: transparent;
                    border: 1px solid #fff;
                    color: #fff;
                    border-top-left-radius: 0 !important; 
                    border-bottom-left-radius: 0 !important;
                    margin-left: 0px;
                    border-radius: 5px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-calendar-week" viewBox="0 0 16 16">
                        <path
                            d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                        <path
                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                    </svg>&nbsp;&nbsp;
                    <?php echo $currentDateTime; ?></span>
            </a>
            <a href="tel:०८१५३६३३८" class="main-logo d-flex align-items-center" style="text-decoration: none">
                <span class="fw-bold"
                    style="display: inline-flex;
                    justify-content: center;
                    align-items: center;
                    padding: 5px 15px;
                    background: transparent;
                    border: 1px solid #fff;
                    color: #fff;
                    margin-left: 7px;
                    border-radius: 5px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-telephone" viewBox="0 0 16 16">
                        <path
                            d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                    </svg>&nbsp;&nbsp;
                    फोन नं - ०८१५३६३३८</span>
            </a>
        </div>
    </div>
    <div class="bg-overlay"></div>
</div>
