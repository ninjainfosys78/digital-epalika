@extends('frontend.layouts.master')
@section('content')
<section class="employee-section">
    <div class="container">
        <div class="d-flex mt-5">
            <div class="breadcrumb d-flex">
                <div>
                    <a class="whitespace-nowrap text-primary-500" [routerLink]="'/e-map'">परिचय</a>
                </div>
                <div class="d-flex ml-1 whitespace-nowrap">
                    <mat-icon class="icon-size-5 text-secondary" [svgIcon]="'icon_solid:chevron-right'"></mat-icon>
                    <a class="ml-1 text-primary-500">कर्मचारीहरु</a>
                </div>
            </div>
        </div>
        <div class="row">
            <nav class="navbar bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand">कर्मचारीहरु</a>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success me-2" type="submit">Search</button>
                        <div class="form-group col-md-2 me-2">
                            <select id="inputState" class="form-control">
                              <option selected>All</option>
                              <option>test</option>
                              <option>test</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <select id="inputState" class="form-control">
                              <option selected>All</option>
                              <option>test</option>
                              <option>test</option>
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
                                <img src="assets/img/logo.png">
                                <td>Ninja</td>
                                <td>CEO</td>
                                <td>उप-महानगरपालिका</td>
                                <td>epalikad@gmail.com</td>
                            </tr>
                            <tr>
                                <img src="assets/img/flag.gif">
                                <td>Ninja</td>
                                <td>CEO</td>
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
