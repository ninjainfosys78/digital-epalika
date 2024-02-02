<table border="1" cellpadding="1" cellspacing="0" style="width:100%">
    <tbody>
    <tr>
        <td><span style="background-color:#ffffff; color:rgba(0, 0, 0, 0.87); font-family:Roboto,Helvetica,Arial,sans-serif; font-size:14px">क्र.सं.</span></td>
        <td><span style="background-color:#ffffff; color:rgba(0, 0, 0, 0.87); font-family:Roboto,Helvetica,Arial,sans-serif; font-size:14px">पद</span></td>
        <td><span style="background-color:#ffffff; color:rgba(0, 0, 0, 0.87); font-family:Roboto,Helvetica,Arial,sans-serif; font-size:14px">नामथर</span></td>
        <td><span style="background-color:#ffffff; color:rgba(0, 0, 0, 0.87); font-family:Roboto,Helvetica,Arial,sans-serif; font-size:14px">बुवा/पतिको नाम</span></td>
        <td><span style="background-color:#ffffff; color:rgba(0, 0, 0, 0.87); font-family:Roboto,Helvetica,Arial,sans-serif; font-size:14px">बाजेको नाम</span></td>
        <td><span style="background-color:#ffffff; color:rgba(0, 0, 0, 0.87); font-family:Roboto,Helvetica,Arial,sans-serif; font-size:14px">ना.प्र.नं.</span></td>
        <td><span style="background-color:#ffffff; color:rgba(0, 0, 0, 0.87); font-family:Roboto,Helvetica,Arial,sans-serif; font-size:14px">ठेगाना</span></td>
        <td><span style="background-color:#ffffff; color:rgba(0, 0, 0, 0.87); font-family:Roboto,Helvetica,Arial,sans-serif; font-size:14px">सम्पर्क नं.</span></td>
    </tr>
    @forelse($consumerCommitteeMembers as $member)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$member->post->label()??''}}</td>
            <td>{{$member->name}}</td>
            <td>{{$member->father_name}}</td>
            <td>{{$member->grandfather_name}}</td>
            <td>{{$member->citizenship_no}}</td>
            <td>{{$member->address}}</td>
            <td>{{$member->phone}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
        </tr>
    @endforelse
    </tbody>
</table>





