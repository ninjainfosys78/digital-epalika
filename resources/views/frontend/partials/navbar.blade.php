<nav class="navbar navbar-expand-lg ">
    <div class="container">
        <a class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span>
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('welcome') ? 'active' : ''}}" aria-current="page" href="{{url('/')}}">
                        <i class="fa fa-home"></i>
                        गृहपृष्ठ
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        परिचय
                    </a>
                    <ul class="dropdown-menu"  aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item " href="{{route('about-us')}}">हाम्रो बारेमा</a></li>
                        <li><a class="dropdown-item " href="{{route('representative')}}">जनप्रतिनिधि</a></li>
                        <li><a class="dropdown-item " href="{{route('employee')}}">कर्मचारीहरु</a></li>

                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        ग्यालेरि
                    </a>
                    <ul class="dropdown-menu"  aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item " href="{{route('photo')}}">फोटोहरु</a></li>
                        <li><a class="dropdown-item " href="{{route('audio')}}">अडियोहरु</a></li>
                        <li><a class="dropdown-item " href="{{route('video')}}">भिडियोहरु</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('notice') ? 'active' : ''}}" href="{{route('notice')}}">
                        सूचना
                    </a>
                </li>
                {{--  <li class="nav-item">
                      <a class="nav-link" aria-current="page" href="{{url('/static/executive')}}">
                          कार्यपालिका न्युज
                      </a>
                  </li>--}}
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('e-map') ? 'active' : ''}}" href="{{route('e-map')}}">
                        इ-नक्सा
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('grievanceHandling.grievance') ? 'active' : ''}}" href="{{route('grievanceHandling.grievance')}}">
                        गुनासो
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('businessRegistration.business') ? 'active' : ''}}" href="{{route('businessRegistration.business')}}">
                        व्यवसाय
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('contact') ? 'active' : ''}}" href="{{route('contact')}}">
                        सम्पर्क
                    </a>
                </li>
{{--                <li class="nav-item dropdown">--}}
{{--                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"--}}
{{--                       data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                        Dropdown--}}
{{--                    </a>--}}
{{--                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
{{--                        <li><a class="dropdown-item" href="#">Action</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
            </ul>
        </div>
    </div>
</nav>
