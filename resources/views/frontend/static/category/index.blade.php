@extends('frontend.layouts.master')
@section('content')
<section class="category-section">
    <div class="container">
        <div class="d-flex mt-5">
            <div class="breadcrumb d-flex">
                <div>
                    <a class="whitespace-nowrap text-primary-500" [routerLink]="'/e-map'">श्रेणीहरु</a>
                </div>
                <div class="d-flex ml-1 whitespace-nowrap">
                    <mat-icon class="icon-size-5 text-secondary" [svgIcon]="'icon_solid:chevron-right'"></mat-icon>
                    <a class="ml-1 text-primary-500">प्रगति प्रतिबेदनहरु</a>
                </div>
            </div>
        </div>
        <h1>श्रेणीहरु</h1>
        <div class="news">
            <div class="row">
                <div class="col-md-8">
                    <div class="title-section">
                        <a href="#">नगरपालिका बारे नया सूचनाहरु ।</a>
                        <span>प्रकाशित मिति : 2022/06/01 12:07</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="read-section">
                        <mat-icon [svgIcon]="'icon_solid:document-text'"></mat-icon>
                        <a href="#">
                            नगरपालिका बिबरण
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="news">
            <div class="row">
                <div class="col-md-8">
                    <div class="title-section">
                        <a href="#">नगरपालिका बारे नया सूचनाहरु ।</a>
                        <span>प्रकाशित मिति : 2022/06/01 12:07</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="read-section">
                        <mat-icon [svgIcon]="'icon_solid:document-text'"></mat-icon>
                        <a href="#">
                            नगरपालिका बिबरण
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
