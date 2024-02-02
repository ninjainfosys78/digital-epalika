<!-- table.blade.php -->

<div class="table-responsive">
    <table class="table table-sm table-striped table-bordered">
        <thead>
        <tr>
            <th>क्र.स</th>
            <th>सेवाग्राहीको नाम</th>
            <th>सिफारिस नाम</th>
            <th>सिफारिस स्वीकृति</th>
            <th>स्थिति</th>
            <th>#</th>
        </tr>
        </thead>
{{--        <tbody>--}}
{{--        @forelse ($sipharis as $sipharish)--}}
{{--            <tr>--}}
{{--                <!-- Include the relevant columns as per your data structure -->--}}
{{--                <td>{{ $loop->iteration }}</td>--}}
{{--                <td>--}}
{{--                    @if ($sipharish->personalDetail ?? '')--}}
{{--                        {{ $sipharish->personalDetail->name ?? '' }}--}}
{{--                    @elseif ($sipharish->mobileUser)--}}
{{--                        {{ $sipharish->mobileUser->name ?? '' }}--}}
{{--                    @endif--}}
{{--                </td>--}}
{{--                <td>{{ $sipharish->SipharishFormType?->title ?? '' }}</td>--}}
{{--                <td>{{ $sipharish->approved_status ?? '' }}</td>--}}
{{--                <td>--}}
{{--                    @can('recommendationCategory_access')--}}
{{--                        <!-- Include the relevant actions as per your requirements -->--}}
{{--                    @endcan--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                    @can('recommendationCategory_access')--}}
{{--                        <!-- Include the relevant actions as per your requirements -->--}}
{{--                    @endcan--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @empty--}}
{{--            <tr>--}}
{{--                <td colspan="6" class="text-center">No data available.</td>--}}
{{--            </tr>--}}
{{--        @endforelse--}}
        </tbody>
    </table>
</div>
