@extends('frontend.layouts.master')
@section('content')
<section class="employee-section">
    <div class="container">
        <div class="d-flex mt-5">
            <div class="breadcrumb d-flex">
                <div class="breadcrumb-item">
                    <a class="whitespace-nowrap text-primary-500" href="{{route('about-us')}}">परिचय</a>
                    <i class="fa fa-angle-double-right"></i>
                    <a class="ml-1 text-primary-500">जनप्रतिनिधिहरु</a>
                </div>
            </div>
        </div>
        <div class="row">
            <nav class="navbar bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand">जनप्रतिनिधिहरु</a>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success me-2" type="submit">Search</button>
                        <div class="form-group col-md-2 me-2">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>All</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>All</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </form>
                </div>
            </nav>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="shadow">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>फोटो</th>
                            <th>नाम</th>
                            <th>पद</th>
                            <th>कार्यलय</th>
                            <th>इमेल</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td> <img src="{{asset('assets/frontend/image/submetro.jpg')}}"></td>
                            <td>Ninja</td>
                            <td>Mayor</td>
                            <td>उप-महानगरपालिका</td>
                            <td>epalikad@gmail.com</td>
                        </tr>
                        <tr>
                            <td> <img src="{{asset('assets/frontend/image/submetro.jpg')}}"></td>
                            <td>Ninja</td>
                            <td>Deputy mayor</td>
                            <td>उप-महानगरपालिका</td>
                            <td>epalikad@gmail.com</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
