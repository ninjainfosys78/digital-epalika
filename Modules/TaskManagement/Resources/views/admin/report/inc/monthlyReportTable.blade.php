@foreach ($monthlyData as $month)
    <tr>
        <td rowspan="{{ $month['activities_count'] }}">{{ $month['month'] }}</td>
    </tr>
    @foreach ($month['activities'] as $activity)
        <tr>
            <td rowspan="{{ $activity->activityLists->count() }}">{{ $loop->iteration }}</td>
            <td rowspan="{{ $activity->activityLists->count() }}">{{ $activity->user->name ?? '' }}</td>
            <td rowspan="{{ $activity->activityLists->count() }}"> {{ $activity->branch->branch_name ?? '' }} </td>
            <td>{{ $activity->activityLists->first()->title ?? '' }}</td>
            <td>{{ $activity->activityLists->first()->description ?? '' }}</td>
            <td>{{ $activity->activityLists->first()->remarks ?? '' }}</td>
            <td rowspan="{{ $activity->activityLists->count() }}">{{ $activity->remarks }}</td>
        </tr>
        @foreach ($activity->activityLists->skip(1) as $activityList)
            <tr>
                <td>{{ $activityList->title ?? '' }}</td>
                <td>{{ $activityList->description ?? '' }}</td>
                <td>{{ $activityList->remarks ?? '' }}</td>
            </tr>
        @endforeach
    @endforeach
@endforeach
