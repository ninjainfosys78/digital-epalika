<div class="table-responsive" id="report-content">
    <table class="table table-sm table-striped table-hover mt-2">
        <thead>
        <tr>
            <th>क्र.स</th>
            <th>युनिक आईडी</th>
            <th>कृषक परिचय पत्र नं.</th>
            <th>पुरा नाम</th>
            <th>बुबाको नाम</th>
            <th>बाजे/ससुराको नाम</th>
            <th>लिङ्ग</th>
            <th>वैवाहिक आवस्था</th>
            <th>नागरिकता नं</th>
            <th>सम्पर्क नं.</th>
        </tr>
        </thead>
        <tbody>
        @forelse($farmers as $farmer)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$farmer->unique_id}}</td>
                <td>{{$farmer->farmer_id_card_no}}</td>
                <td>{{$farmer->name}}</td>
                <td>{{$farmer->father_name}}</td>
                <td>{{$farmer->grandfather_name}}</td>
                <td>{{$farmer->gender->label()}}</td>
                <td>{{$farmer->marital_status->label()}}</td>
                <td>{{$farmer->citizenship_no}}</td>
                <td>{{$farmer->phone_no}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
