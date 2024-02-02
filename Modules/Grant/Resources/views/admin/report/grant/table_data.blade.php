
<div class="table-responsive" id="report-content">
    <table class="table table-sm table-bordered table-striped table-hover mt-2">
        <thead>
        <tr>
            <th class="text-center">क्र.स</th>
            <th class="text-center">कार्यक्रम/क्रियाकलाप</th>
            <th class="text-center">अनुदानग्रहिको प्रकार</th>
            <th>अनुदानग्रहि</th>
            <th>अनुदानग्रहिको लगानी</th>
            <th>नयाँ/निरन्तर</th>
            <th>गत वर्षको लगानी</th>
            <th>अनुदान स्थल</th>
            <th>कित्ता नं</th>
            <th>सम्पर्क व्यक्ति</th>
            <th>सम्पर्क नं.</th>
        </tr>
        </thead>
        <tbody>
        @forelse($grantDetails as $grantDetail)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$grantDetail->grant->grantProgram->name??''}}</td>
                <td>{{$grantDetail->grant_for->label()}}</td>
                <td>{{$grantDetail->model->name ?? ''}}</td>
                <td>{{$grantDetail->personal_investment}}</td>
                <td>{{$grantDetail->is_old ? 'निरन्तरता': 'नयाँ'}}</td>
                <td>{{$grantDetail->investment_amount}}</td>
                <td>{{$grantDetail->localBody->local_body ?? ''}} - {{$grantDetail->ward_no}}</td>
                <td>{{$grantDetail->contact_person}}</td>
                <td>{{$grantDetail->contact}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
