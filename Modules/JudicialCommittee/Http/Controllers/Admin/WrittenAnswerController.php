<?php

namespace Modules\JudicialCommittee\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\JudicialCommittee\Entities\ComplaintApplication;
use Modules\JudicialCommittee\Entities\WrittenAnswer;
use Modules\JudicialCommittee\Enums\ComplainantDefendantTypeEnum;
use Modules\JudicialCommittee\Events\ComplaintLogEvent;
use Modules\JudicialCommittee\Http\Requests\WrittenAnswer\StoreWrittenAnswerRequest;
use Modules\JudicialCommittee\Http\Requests\WrittenAnswer\UpdateWrittenAnswerRequest;

class WrittenAnswerController extends Controller
{
    public function index(ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('writtenAnswer_access');

        $complaintApplication->load(['writtenAnswers',
            'supportedDocuments' => function ($query) {
                $query->where('type', ComplainantDefendantTypeEnum::DEFENDANT);
            },
            'witnesses' => function ($query) {
                $query->where('type', ComplainantDefendantTypeEnum::DEFENDANT);
            }
        ]);

        return view('judicialcommittee::admin.written_answer.index', compact('complaintApplication'));
    }

    public function create(ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('writtenAnswer_create');

        return view('judicialcommittee::admin.written_answer.create', compact('complaintApplication'));
    }

    public function store(StoreWrittenAnswerRequest $request, ComplaintApplication $complaintApplication)
    {
        $this->checkAuthorization('writtenAnswer_create');

        $writtenAnswer = $complaintApplication->writtenAnswers()->create($request->validated());
        $this->uploadFiles($request, $writtenAnswer);

        event(new ComplaintLogEvent($complaintApplication->id, WrittenAnswer::class, $writtenAnswer->id, 'लिखित जवाफ', "मिति $writtenAnswer->submitted_date गते लिखित जवाफ पेश गरियो।"));

        toast('लिखित जवाफ सफलतापूर्वक थपियो', 'success');

        return redirect(route('admin.judicialCommittee.complaintApplication.writtenAnswer.index', $complaintApplication));
    }

    public function show(ComplaintApplication $complaintApplication, WrittenAnswer $writtenAnswer)
    {
        $this->checkAuthorization('writtenAnswer_access');

        $writtenAnswer->load('files');

        return view('judicialcommittee::admin.written_answer.show', compact('complaintApplication', 'writtenAnswer'));
    }

    public function edit(ComplaintApplication $complaintApplication, WrittenAnswer $writtenAnswer)
    {
        $this->checkAuthorization('writtenAnswer_edit');

        return view('judicialcommittee::admin.written_answer.edit', compact('complaintApplication', 'writtenAnswer'));
    }

    public function update(UpdateWrittenAnswerRequest $request, ComplaintApplication $complaintApplication, WrittenAnswer $writtenAnswer)
    {
        $this->checkAuthorization('writtenAnswer_edit');

        $complaintApplication->update($request->validated());

        $this->uploadFiles($request, $writtenAnswer);

        toast('लिखित जवाफ सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.judicialCommittee.complaintApplication.writtenAnswer.index', $complaintApplication));
    }

    public function destroy(ComplaintApplication $complaintApplication, WrittenAnswer $writtenAnswer)
    {
        $this->checkAuthorization('writtenAnswer_delete');
    }

    private function uploadFiles($request, $writtenAnswer)
    {
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $writtenAnswer->files()->create([
                    'file_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                    'extension' => $file->getClientOriginalExtension(),
                    'file' => $file->store('judicial_committee/files', 'public'),
                ]);
            }
        }
    }
}
