<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">
            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light"
                   data-bs-toggle="dropdown"
                   href="#"
                   role="button"
                   aria-haspopup="false"
                   aria-expanded="false" id="noti-tour">
                    <i @class(['ring-bell'=>count(auth('organization')->user()->unreadNotifications ?? [])>0,'fa', 'fa-bell', 'noti-icon'])></i>
                    <span class="badge bg-danger {{count(auth('organization')->user()->unreadNotifications?? [])>0 ? 'd-block':'d-none'}} rounded-circle noti-icon-badge">
                                        {{count(auth('organization')->user()->unreadNotifications?? [])}}
                                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-lg">
                    <div class="dropdown-item noti-title">
                        <h5 class="m-0">
                            <span class="float-end">
                      <a href="{{route('organization.admin.notification.readAllNotification')}}" class="text-dark">
                        <small>सबै खाली गर्नुहोस्</small>
                      </a> </span>नोटिफिकेसन</h5>
                    </div>
                    <div class="noti-scroll" data-simplebar>
                        @forelse(auth('organization')->user()->unreadNotifications?? [] as $notification)
                            <a href="{{route('organization.admin.notification',$notification)}}"
                               class="dropdown-item notify-item">
                                <div class="notify-icon bg-info">
                                    <i class="fas fa-bell"></i>
                                </div>
                                <p class="notify-details">
                                    @switch(class_basename($notification->type))
                                        @case('ApplyMapNoticeNotification')
                                            घर-नक्सा पासमा नयाँ निबेदन/प्रतिबेदन प्राप्त
                                            @break
                                        @case('MapApplyNotification')
                                            घर-नक्सा पासमा नयाँ नक्सा प्राप्त
                                            @break
                                        @default
                                            नयाँ नोटिफिकेसन
                                    @endswitch
                                    <small class="text-muted">{{$notification->created_at->diffForHumans()}}</small>
                                </p>
                            </a>
                        @empty
                            <h4 class="text-center">कुनै डाटा उपलब्ध छैन !</h4>
                        @endforelse
                    </div>
                    <!-- All-->
                    <a href="{{route('organization.admin.notification')}}"
                       class="dropdown-item text-center text-primary notify-item notify-all">सबै हेर्नुहोस्
                        <i class="fe-arrow-right"></i>
                    </a>
                </div>
            </li>
            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light"
                   data-bs-toggle="dropdown"
                   href="#"
                   role="button"
                   aria-haspopup="false"
                   aria-expanded="false" id="profile-tour">
                    <img src="{{auth('traineeUser')->user()->profile_photo_url ??''}}"
                         alt="user-image"
                         class="rounded-circle"/>
                    <span class="pro-user-name ms-1">
                  {{auth('traineeUser')->user()->name ??''}} <i class="fa fa-angle-down"></i>
                </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown">

                    <a href="{{route('traineeOrganization.admin.auth-organization.profile')}}" class="dropdown-item notify-item">
                        <i class="fa fa-user"></i>
                        <span>मेरो प्रोफाइल</span>
                    </a>
                    <a href="{{route('traineeOrganization.admin.traineeTaxClearance.index')}}" class="dropdown-item notify-item">
                        <i class="fa fa-clipboard"></i>
                        <span>कर चुक्ता</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('roaster.traineeUser.logout') }}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item notify-item">
                            <i class="fa fa-sign-out-alt"></i>
                            <span>बाहिर निस्कनु</span>
                        </button>
                    </form>
                </div>
            </li>
        </ul>
        <!-- LOGO -->
        <div class="logo-box dropdown">
            <div class="logo logo-light text-center">
                <span class="logo-sm">
                        <img src="{{asset(config('app.logo_sm'))}}" alt=""
                             height="40"/>
                </span>
                <span class="logo-lg">
                        <img src="{{asset(config('app.logo'))}}" alt=""
                             height="35"/>
              </span>
            </div>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fa fa-bars"></i>
                </button>
            </li>
        </ul>
    </div>
</div>
