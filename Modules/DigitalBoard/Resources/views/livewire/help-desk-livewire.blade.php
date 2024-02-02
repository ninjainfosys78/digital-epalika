<div class="row mt-5">
    <div class="col-md-6">
        <div class="card border-info p-2">
            <div class="text-center">
                <h5 class="fw-bold">शाखाहरु</h5>
            </div>
            @foreach($branches as $branch)
                <p class="branch-title">
                    <button class="btn fs-5 w-100 d-flex justify-items-start" type="button"
                            data-toggle="collapse" data-target="#collapse{{$loop->iteration}}" aria-expanded="false"
                            wire:click.prevent="setBranchId({{$branch}})">
                        {{$branch->branch_name}}
                    </button>
                </p>
                @if(count($branch->branches)!==0)
                    <div class="collapse {{$loop->first ? 'show' :''}}" id="collapse{{$loop->iteration}}">
                        <div class="card-body sub-branch">
                            <ul class="list-group">
                                @foreach($branch->branches as $subBranch)
                                    <li class="list-group-item d-flex justify-content-between fs-5"
                                        wire:click.prevent="setBranchId({{$subBranch}})">
                                        {{$subBranch->branch_name}}
                                        <i class="fs-5 pt-1 fa-solid fa-angles-right"></i>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </div>
    <div class="col-md-6">
        <div class="card branch-service border-info p-2">
            <div class="text-center">
                <h6 class="fw-bold fs-5">सेवाहरु</h6>
            </div>
            <ul class="list-group">
                @forelse($services as $service)
                    <a href="{{route('service.view',$service)}}">
                        <li class="list-group-item text-white rounded mb-2 fs-5 d-flex d-flex">
                            <i class="fa fa-check-double m-lg-1"></i>{{$service->service_name}}
                        </li>
                    </a>
                @empty
                    <p class="text-center element fs-5 mt-3"><i class="fa-solid fa-angles-left fs-5"></i>सेवा लिने शाखा
                        वायाँ मा रहेको तालिका बाट छान्नुहोस् </p>
                @endforelse
            </ul>
        </div>
    </div>
</div>
