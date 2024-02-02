<table border="1" cellpadding="1" cellspacing="0" style="width:100%">
    <tbody>
    <tr>
        <td><span style="background-color:#ffffff; color:rgba(0, 0, 0, 0.87); font-family:Roboto,Helvetica,Arial,sans-serif; font-size:14px">क्र.सं.</span></td>
        <td><span style="background-color:#ffffff; color:rgba(0, 0, 0, 0.87); font-family:Roboto,Helvetica,Arial,sans-serif; font-size:14px">उपलब्ध गराउने स्रोत/निकाय</span></td>
        <td><span style="background-color:#ffffff; color:rgba(0, 0, 0, 0.87); font-family:Roboto,Helvetica,Arial,sans-serif; font-size:14px">सामाग्रीको नाम</span></td>
        <td><span style="background-color:#ffffff; color:rgba(0, 0, 0, 0.87); font-family:Roboto,Helvetica,Arial,sans-serif; font-size:14px">परिमाण</span></td>
        <td><span style="background-color:#ffffff; color:rgba(0, 0, 0, 0.87); font-family:Roboto,Helvetica,Arial,sans-serif; font-size:14px">एकाइ</span></td>
    </tr>
    @forelse($projectGrantDetails as $projectGrantDetail)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$projectGrantDetail->grant_source?->label()}}</td>
            <td>{{$projectGrantDetail->asset_name}}</td>
            <td>{{$projectGrantDetail->quantity}}</td>
            <td>{{$projectGrantDetail->asset_unit}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
        </tr>
    @endforelse
    </tbody>
</table>





