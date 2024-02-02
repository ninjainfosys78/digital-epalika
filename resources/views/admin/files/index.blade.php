<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>{{config('app.name','Digital E-Palika')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta
        content="A complete solution for a digital palika."
        name="description"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta content="Digital ePalika" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('images/np.png')}}"/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/style.css')}}">
    <!-- App css -->
    <link
        href="{{asset('assets/backend/css/app.min.css')}}"
        rel="stylesheet"
        type="text/css"
        id="app-style"
    />
    <link
        href="{{asset('assets/backend/css/bootstrap.min.css')}}"
        rel="stylesheet"
        type="text/css"/>
</head>
<body class="authentication-bg">
<div class="mt-2 mb-2">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    @foreach($files as $file)
                    <div class="col-md-3">
                        <div class="gal-box">
                            <a href="{{route('admin.file.show', $file)}}"
                               title="{{$file->file_name}}">
                                <img src="{{$file->file_url}}" class="img-fluid" alt="work-thumbnail">
                            </a>
                            <div class="gall-info">
                                <h4 class="font-16 mt-0">{{$file->file_name}}</h4>
                            </div> <!-- gallery info -->
                        </div> <!-- end gal-box -->
                    </div>
                    @endforeach
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>
</body>
</html>
