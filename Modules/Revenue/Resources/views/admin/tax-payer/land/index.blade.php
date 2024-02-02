@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.revenue.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">करदाताको सम्पति विवरण</li>
                    </ol>
                </div>
                <h4 class="page-title">करदाताको सम्पति विवरण</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">करदाताको सम्पति विवरण सूची</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @includeIf('inc.filter_form')
                            @can('taxPayerLand_create')
                                <a href="{{ route('admin.revenue.taxPayer.taxPayerLand.create', $taxPayer) }}"
                                    class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                    <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th colspan="4">जग्गाको विवरण</th>
                                    <th rowspan="2">जग्गा रहेको स्थान</th>
                                    <th rowspan="2">जग्गा जोडिएको मुख्य सडक <small>(सडकको नाम र सडकको प्रकार)</small>
                                    </th>
                                    <th rowspan="2">क्षेत्र</th>
                                    <th rowspan="2">जग्गाको प्रयोग</th>
                                    <th rowspan="2">जग्गाको चलन चल्तीको मूल्य</th>
                                    <th rowspan="2">कैफियत</th>
                                    <th rowspan="2">#</th>
                                </tr>
                                <tr>
                                    <th>कि.नं.</th>
                                    <th>साबिक <small>(गाविस र वडा)</small></th>
                                    <th>हालको वडा नं.</th>
                                    <th>क्षेत्रफल (वर्ग मीटरमा)</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($taxPayer->taxPayerLands as $key=>$taxPayerLand)
                                    <tr>
                                        <td>{{ $taxPayerLand->plot_no }}</td>
                                        <td>{{ $taxPayerLand->former_vdc }}-{{ $taxPayerLand->former_ward }}</td>
                                        <td>{{ $taxPayerLand->ward_no }}</td>
                                        <td>{{ $taxPayerLand->area }}</td>
                                        <td>{{ $taxPayerLand->land_address }}</td>
                                        <td>{{ $taxPayerLand->place->title ?? '' }}</td>
                                        <td>{{ $taxPayerLand->sector->title ?? '' }}</td>
                                        <td>{{ $taxPayerLand->land_use }}</td>
                                        <td>रु. {{ $taxPayerLand->current_rate }}</td>
                                        <td>{{ $taxPayerLand->remarks }}</td>
                                        <td class="d-flex gap-1">
                                            @can('taxPayerLand_edit')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.revenue.taxPayer.taxPayerLand.edit', [$taxPayer, $taxPayerLand]) }}"
                                                    class="btn btn-xs btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                    title="सम्पादन गर्नुहोस्">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can('taxPayerLand_delete')
                                                <form
                                                    action="{{ route('admin.revenue.taxPayer.taxPayerLand.destroy', [$taxPayer, $taxPayerLand]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-bs-type="delete"
                                                        class="btn btn-xs btn-outline-danger {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"
                                                        title="मेटाउनु होस्">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
