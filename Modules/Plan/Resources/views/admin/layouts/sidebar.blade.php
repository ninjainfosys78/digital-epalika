<li class="{{request()->is('admin/plan/dashboard') ? 'active' : ''}}">
    <a href="{{route('admin.plan.dashboard')}}">
        <i class="fa fa-home"></i>
        <span> ड्यासबोर्ड</span>
    </a>
</li>
@can('project_access')
    <li class="{{request()->is('admin/plan/project') ? 'active' : ''}}">
        <a href="{{route('admin.plan.project.index')}}">
            <i class="fa fa-list"></i>
            <span> योजना/कार्यक्रमहरु </span>
        </a>
    </li>
@endcan

<li class="{{request()->is('admin/plan/report*') ? 'active' : ''}}">
    <a href="#sidebarPlanReport"
       {{request()->is('admin/plan/report*') ? 'aria-expanded=true' : ''}}
       data-bs-toggle="collapse">
        <i class="fa fa-clipboard-list"></i>
        <span>रिपोर्ट</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{request()->is('admin/plan/report*') ? 'show' : ''}}"
         id="sidebarPlanReport">
        <ul class="nav-second-level">
            <li class="{{request()->is('admin/plan/report') ? 'active' : ''}}">
                <a href="{{route('admin.plan.report.index')}}">
                    <span>प्रतिवेदनहरु</span>
                </a>
            </li>
            <li class="{{request()->is('admin/plan/report/annual-progress-report') ? 'active' : ''}}">
                <a href="{{route('admin.plan.report.annual-progress-report')}}">
                    <span>वार्षिक प्रगति प्रतिवेदन</span>
                </a>
            </li>
            <li class="{{request()->is('admin/plan/report/consumer-committee-projects') ? 'active' : ''}}">
                <a href="{{route('admin.plan.report.consumer-committee-projects')}}">
                    <span>उ.स. अन्तर्गतका योजनाहरु</span>
                </a>
            </li>
            <li class="{{request()->is('admin/plan/report/contract-projects') ? 'active' : ''}}">
                <a href="{{route('admin.plan.report.contract-projects-page')}}">
                    <span>ठेक्का अन्तर्गतका योजनाहरु</span>
                </a>
            </li>
            <li class="{{request()->is('admin/plan/report/incomplete-projects') ? 'active' : ''}}">
                <a href="{{route('admin.plan.report.incomplete-projects')}}">
                    <span>सम्पन्न हुन बाकि योजनाहरुको रिपोर्ट </span>
                </a>
            </li>
            <li class="{{request()->is('admin/plan/report/price-range-report') ? 'active' : ''}}">
                <a href="{{route('admin.plan.report.price-range-report-page')}}">
                    <span>योजना छनौट रिपोर्ट</span>
                </a>
            </li>
            <li class="{{request()->is('admin/plan/report/work-detail-report') ? 'active' : ''}}">
                <a href="{{route('admin.plan.report.work-detail-report-page')}}">
                    <span>उ.स. र निर्माण व्यवसायीबाट भएको कार्य विवरण</span>
                </a>
            </li>
        </ul>
    </div>
</li>

<li class="{{request()->is('admin/plan/estimateSetting/*') ? 'active' : ''}}">
    <a href="#sidebarPlanSetting"
       {{request()->is('admin/plan/setting/*') ? 'aria-expanded=true' : ''}}
       data-bs-toggle="collapse">
        <i class="fa fa-cogs"></i>
        <span>  आधारभूत सेटिङ</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{request()->is('admin/plan/setting/*') ? 'show' : ''}}"
         id="sidebarPlanSetting">
        <ul class="nav-second-level">
            @can('planArea_access')
                <li class="{{request()->is('admin/plan/setting/planArea') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.planArea.index','planAreaCategory')}}">
                        <span>  योजना क्षेत्र  </span>
                    </a>
                </li>
            @endcan
            @can('planArea_access')
                <li class="{{request()->is('admin/plan/setting/planArea') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.planArea.index','planAreaSubCategory')}}">
                        <span>  योजना उप-क्षेत्र  </span>
                    </a>
                </li>
            @endcan
            @can('planLevel_access')
                <li class="{{request()->is('admin/plan/setting/planLevel') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.planLevel.index','planLevel')}}">
                        <span> योजना स्तरहरु </span>
                    </a>
                </li>
            @endcan
            @can('planLevel_access')
                <li class="{{request()->is('admin/plan/setting/planLevel') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.planLevel.index','planSubLevel')}}">
                        <span> योजना उप-स्तरहरु </span>
                    </a>
                </li>
            @endcan
            @can('budgetHead_access')
                <li class="{{request()->is('admin/plan/setting/budgetHead') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.budgetHead.index','budgetHead')}}">
                        <span> बजेट शिर्षक </span>
                    </a>
                </li>
            @endcan
            @can('budgetHead_access')
                <li class="{{request()->is('admin/plan/setting/budgetHead') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.budgetHead.index','budgetSubHead')}}">
                        <span> बजेट उप-शिर्षक </span>
                    </a>
                </li>
            @endcan
            @can('planTemplate_access')
                <li class="{{request()->is('admin/plan/setting/expenseHead') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.expenseHead.index')}}">
                        <span> खर्च शीर्षक </span>
                    </a>
                </li>
            @endcan
            @can('planTemplate_access')
                <li class="{{request()->is('admin/plan/setting/planTemplate') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.planTemplate.index')}}">
                        <span> टेम्प्लेट </span>
                    </a>
                </li>
            @endcan

        </ul>
    </div>
</li>

<li class="{{request()->is('admin/plan/estimateSetting/*') ? 'active' : ''}}">
    <a href="#sidebarPlanEstimateSetting"
       {{request()->is('admin/plan/estimateSetting/*') ? 'aria-expanded=true' : ''}}
       data-bs-toggle="collapse">
        <i class="fa fa-cogs"></i>
        <span> Estimate Setting</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{request()->is('admin/plan/estimateSetting/*') ? 'show' : ''}}"
         id="sidebarPlanEstimateSetting">
        <ul class="nav-second-level">

                <li class="{{request()->is('admin/plan/estimateSetting/labour') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.labour.index')}}">
                        <span>  Labour  </span>
                    </a>
                </li>
                <li class="{{request()->is('admin/plan/estimateSetting/labourRate') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.labourRate.index')}}">
                        <span>  Labour Rate  </span>
                    </a>
                </li>
                <li class="{{request()->is('admin/plan/estimateSetting/fuel') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.fuel.index')}}">
                        <span>  इन्धन  </span>
                    </a>
                </li>
                <li class="{{request()->is('admin/plan/estimateSetting/fuelRate') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.fuelRate.index')}}">
                        <span>  इन्धन दर  </span>
                    </a>
                </li>
                  <li class="{{request()->is('admin/plan/estimateSetting/equipment') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.equipment.index')}}">
                        <span>  उपकरण  </span>
                    </a>
                </li>

                <li class="{{request()->is('admin/plan/estimateSetting/equipmentAdditionalCost') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.equipmentAdditionalCost.index')}}">
                        <span>  उपकरण अतिरिक्त लागत  </span>
                    </a>
                </li>
                     {{-- <li class="{{request()->is('admin/plan/estimateSetting/fuelDemand') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.fuelDemand.index')}}">
                        <span> इन्धनको माग  </span>
                    </a>
                </li>
                     <li class="{{request()->is('admin/plan/estimateSetting/crewRate') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.crewRate.index')}}">
                        <span>  चालक दलको दर  </span>
                    </a>
                </li> --}}
                <li class="{{request()->is('admin/plan/estimateSetting/materialType') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.materialType.index')}}">
                        <span>  सामग्री प्रकार  </span>
                    </a>
                </li>
                <li class="{{request()->is('admin/plan/estimateSetting/material') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.material.index')}}">
                        <span>  सामग्री   </span>
                    </a>
                </li>
                <li class="{{request()->is('admin/plan/estimateSetting/materialRate') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.materialRate.index')}}">
                        <span>  सामाग्री दर   </span>
                    </a>
                </li>
                <li class="{{request()->is('admin/plan/estimateSetting/materialCollection') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.materialCollection.index')}}">
                        <span>  सामग्री संग्रह  </span>
                    </a>
                </li>

                  <li class="{{request()->is('admin/plan/estimateSetting/materialCollection') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.materialCollection.index')}}">
                        <span>  सामग्री संग्रह  </span>
                    </a>
                </li>
                <li class="{{request()->is('admin/plan/estimateSetting/cargoHandling') ? 'active' : ''}}">
                    <a href="{{route('admin.plan.cargoHandling.index')}}">
                        <span>कार्गो ह्यान्डलिङ</span>
                    </a>
                </li>



        </ul>
    </div>
</li>
