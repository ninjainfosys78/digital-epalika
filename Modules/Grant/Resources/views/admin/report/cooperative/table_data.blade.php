
    <div class="table-responsive" id="report-content">
        <table class="table table-sm table-striped table-hover mt-2">
            <thead>
                <tr>
                    <th>क्र.स</th>
                    <th>सहकारी परिचय पत्र नं.</th>
                    <th>दर्ता.नं.</th>
                    <th>सहकारीको नाम </th>
                    <th>सहकारीको प्रकार </th>
                </tr>
            </thead>
            <tbody>
                @forelse($cooperatives as $cooperative)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $cooperative->unique_id }}</td>
                        <td>{{ $cooperative->registration_no }}</td>
                        <td>{{ $cooperative->name }}</td>
                        <td>{{ $cooperative->cooperativeType->title ?? '' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
