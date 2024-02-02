@extends('installer.app')

@section('title','Welcome to laravel Installer')

@section('content')
    <p class="text-center">
        Easy Installation and Setup Wizard
    </p>
    <p class="text-center">

        <a href="{{ route('installer.requirements') }}" class="button">
            Check License
            <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
        </a>
    </p>
@endsection
