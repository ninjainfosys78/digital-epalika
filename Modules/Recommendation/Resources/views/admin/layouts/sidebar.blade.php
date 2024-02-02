<li class="{{request()->is('admin/recommendation/dashboard') ? 'active' : ''}}">
    <a href="{{route('admin.recommendation.dashboard')}}">
        <i class="fa fa-home"></i>
        <span> ड्यासबोर्ड</span>
    </a>
</li>
@can('personalDetail_access')
    <li class="{{request()->is('admin/recommendation/setting/personalDetail') ? 'active' : ''}}">
        <a href="{{route('admin.recommendation.setting.personalDetail.index')}}">
            <i class="fa fa-user"></i>
            <span>व्यक्तिगत विवरण</span>
        </a>
    </li>
@endcan
@can('recommendationSetting_access')
    <li class="{{request()->is('admin/recommendation/sipharish/sipharishCreate*') ? 'active' : ''}}">
        <a href="{{route('admin.recommendation.sipharish.sipharishCreate.index')}}">
            <i class="fa fa-file"></i>
            <span>सिफारिस सिर्जना गर्नुहोस्</span>
        </a>
    </li>
@endcan

{{--
@foreach(recommendationCategory() as $recommendationCategory)
    @if($recommendationCategory->recommendationCategories->count() > 0)
        <li title="{{$recommendationCategory->title}}" class="{{request()->is('admin/recommendation/recommendationCategory/registrationDetail*') ? 'active' : ''}}">
            <a href="#recommendationCategory{{$loop->iteration}}"
               {{request()->is('admin/recommendation/recommendationCategory/registrationDetail*')  ? 'aria-expanded=true' : ''}}
               data-bs-toggle="collapse">
                <i class="fa fa-clipboard-list"></i>
                <span>{{Str::limit($recommendationCategory->title,20,'..')}}</span>
                <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
            </a>
            <div
                class="collapse {{request()->is('admin/recommendation/recommendationCategory/registrationDetail*') ? 'show' : ''}}"
                id="recommendationCategory{{$loop->iteration}}">
                <ul class="nav-second-level">
                    @foreach($recommendationCategory->recommendationCategories as $category)
                        <li class="{{request()->is('admin/recommendation/recommendationCategory/registrationDetail*') ? 'active' : ''}}">
                            <a href="{{route('admin.recommendation.recommendationCategory.registrationDetail.index',$category)}}">
                                <span>{{$category->title}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </li>
    @else
        <li title="{{$recommendationCategory->title}}" class="{{request()->is('admin/recommendation/recommendationCategory/'.$recommendationCategory->id.'/registrationDetail*') ? 'active' : ''}}">
            <a href="{{route('admin.recommendation.recommendationCategory.registrationDetail.index',$recommendationCategory->id)}}">
                <i class="fa fa-id-card"></i>
                <span>{{Str::limit($recommendationCategory->title,20,'..')}}</span>
            </a>
        </li>
    @endif

@endforeach
--}}
{{--

<li class="{{request()->is('admin/recommendation/report*') ? 'active' : ''}}">
    <a href="#recommendationReport"
       {{request()->is('admin/recommendation/report*') || request()->is('admin/recommendation/report*') ? 'aria-expanded=true' : ''}}
       data-bs-toggle="collapse">
        <i class="fa fa-clipboard-list"></i>
        <span>रिपोर्ट</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div
        class="collapse {{request()->is('admin/recommendation/report*') || request()->is('admin/recommendation/report*') ? 'show' : ''}}"
        id="recommendationReport">
        <ul class="nav-second-level">
            @can('recommendationReport_main')
                <li class="{{request()->is('admin/recommendation/report') ? 'active' : ''}}">
                    <a href="{{route('admin.recommendation.report.index')}}">
                        <span>प्रतिवेदन</span>
                    </a>
                </li>
            @endcan
            @can('recommendationReport_ward')
                <li class="{{request()->is('admin/recommendation/report/ward-wise') ? 'active' : ''}}">
                    <a href="{{route('admin.recommendation.report.ward-wise')}}">
                        <span>वडा नं अनुसार</span>
                    </a>
                </li>
            @endcan
            @can('recommendationReport_recommendationCategory')
                <li class="{{request()->is('admin/recommendation/report/recommendation-category-wise') ? 'active' : ''}}">
                    <a href="{{route('admin.recommendation.report.recommendation-category-wise')}}">
                        <span>सिफारिस अनुसार</span>
                    </a>
                </li>
            @endcan
            @can('recommendationReport_personalDetail')
                <li class="{{request()->is('admin/recommendation/report/personal-detail') ? 'active' : ''}}">
                    <a href="{{route('admin.recommendation.report.personal-detail')}}">
                        <span>व्यक्तिगत अनुसार</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</li>
<li class="{{request()->is('admin/setting*') ? 'active' : ''}}">
    <a href="#recommendationSetting"
       {{request()->is('admin/recommendation/setting/recommendation*') || request()->is('admin/recommendation/setting/recommendation*') ? 'aria-expanded=true' : ''}}
       data-bs-toggle="collapse">
        <i class="fa fa-cogs"></i>
        <span>आधारभूत सेटिंग</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div
        class="collapse {{request()->is('admin/recommendation/setting/recommendation*') || request()->is('admin/recommendation/setting/recommendation*') ? 'show' : ''}}"
        id="recommendationSetting">
        <ul class="nav-second-level">
            @can('recommendationCategory_access')
                <li class="{{request()->is('admin/recommendation/setting/recommendationCategory/recommendationCategory*') ? 'active' : ''}}">
                    <a href="{{route('admin.recommendation.setting.recommendationCategory.index','recommendationCategory')}}">
                        <span>सिफारिस श्रेणी</span>
                    </a>
                </li>

            @endcan
            @can('recommendationCategory_access')
                <li class="{{request()->is('admin/recommendation/setting/recommendationSubCategory/recommendationCategory*') ? 'active' : ''}}">
                    <a href="{{route('admin.recommendation.setting.recommendationCategory.index','recommendationSubCategory')}}">
                        <span>सिफारिस उप-श्रेणी</span>
                    </a>
                </li>
            @endcan
            @can('recommendationSetting_access')
                <li class="{{request()->is('admin/recommendation/setting/recommendationSetting*') ? 'active' : ''}}">
                    <a href="{{route('admin.recommendation.setting.recommendationSetting.index')}}">
                        <span>सेटिङ</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</li>
--}}


<li class="{{request()->is('admin/recommendation/sipharish*') ? 'active' : ''}}">
    <a href="#recommendationSetting"
       {{request()->is('admin/recommendation/sipharish/sipharishCategory*') || request()->is('admin/recommendation/sipharish/sipharishCategory*') ? 'aria-expanded=true' : ''}}
       data-bs-toggle="collapse">
        <i class="fa fa-cogs"></i>
        <span>सिफारिस आधारभूत सेटिंग</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div
        class="collapse {{request()->is('admin/recommendation/sipharish/sipharishCategory*') || request()->is('admin/recommendation/sipharish/sipharishCategory*') ? 'show' : ''}}"
        id="recommendationSetting">
        <ul class="nav-second-level">
            @can('recommendationCategory_access')
                <li class="{{request()->is('admin/recommendation/sipharish/sipharishCategory*') ? 'active' : ''}}">
                    <a href="{{route('admin.recommendation.sipharish.sipharishCategory.index')}}">
                        <span>सिफारिस श्रेणी</span>
                    </a>
                </li>

            @endcan
            @can('recommendationCategory_access')
                <li class="{{request()->is('admin/recommendation/sipharish/sipharishSubCategory*') ? 'active' : ''}}">
                    <a href="{{route('admin.recommendation.sipharish.sipharishSubCategory.index')}}">
                        <span>सिफारिस उप-श्रेणी</span>
                    </a>
                </li>
            @endcan
            @can('recommendationSetting_access')
                <li class="{{request()->is('admin/recommendation/sipharish/sipharishFormType*') ? 'active' : ''}}">
                    <a href="{{route('admin.recommendation.sipharish.sipharishFormType.index')}}">
                        <span>सेटिङ</span>
                    </a>
                </li>
            @endcan
            @can('recommendationSetting_access')
                <li class="{{request()->is('admin/recommendation/sipharish/sipharisSignatureDetail*') ? 'active' : ''}}">
                    <a href="{{route('admin.recommendation.sipharish.sipharisSignatureDetail.index')}}">
                        <span>हस्ताक्षर सेटिङ</span>
                    </a>
                </li>
            @endcan

        </ul>
    </div>
</li>


