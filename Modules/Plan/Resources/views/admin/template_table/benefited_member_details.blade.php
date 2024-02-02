<table border="1" cellpadding="1" cellspacing="0" style="width:100%">
    <thead style="vertical-align: middle">
    <tr>
        <td rowspan="2">वडा नं.</td>
        <td rowspan="2">गाँउ बस्ति</td>
        <td colspan="3" style="vertical-align: middle;text-align: center">घरधुरी संख्या</td>
        <td colspan="3" style="vertical-align: middle;text-align: center">जनसंख्या</td>

    </tr>
    <tr>
        <td>दलित तथा पिछडिएका वर्ग</td>
        <td>अन्य</td>
        <td>जम्मा</td>
        <td>महिला</td>
        <td>पुरुष</td>
        <td>जम्मा</td>
    </tr>
    </thead>
    <tbody>
    @forelse($benefitedMemberDetails as $benefitedMemberDetail)
        <tr>
            <td>{{$benefitedMemberDetail->ward_no}}</td>
            <td>{{$benefitedMemberDetail->village}}</td>
            <td>{{$benefitedMemberDetail->dalit_backward_no}}</td>
            <td>{{$benefitedMemberDetail->other_households_no}}</td>
            <td>{{$benefitedMemberDetail->total_household}}</td>
            <td>{{$benefitedMemberDetail->no_of_male}}</td>
            <td>{{$benefitedMemberDetail->no_of_female}}</td>
            <td>{{$benefitedMemberDetail->total_population}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
        </tr>
    @endforelse
    </tbody>
</table>
