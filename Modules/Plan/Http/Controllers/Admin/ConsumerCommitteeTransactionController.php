<?php

namespace Modules\Plan\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Plan\Entities\ConsumerCommitteeTransaction;
use Modules\Plan\Entities\Project;
use Modules\Plan\Http\Requests\ConsumerCommitteeTransaction\StoreConsumerCommitteeTransactionRequest;
use Modules\Plan\Http\Requests\ConsumerCommitteeTransaction\UpdateConsumerCommitteeTransactionRequest;

class ConsumerCommitteeTransactionController extends Controller
{
    public function index(Project $project)
    {
        $project->load(['consumerCommitteeTransactions'])->loadSum('projectAllocatedAmounts', 'amount');

        return view('plan::admin.consumer_committee_transaction.index', compact('project'));
    }

    public function create(Project $project)
    {
        return view('plan::admin.consumer_committee_transaction.create', compact('project'));
    }

    public function store(StoreConsumerCommitteeTransactionRequest $request, Project $project)
    {
        $project->consumerCommitteeTransactions()->create($request->validated());

        toast('किस्ता/पेश्की विवरण सफलतापूर्वक थपियो', 'success');
        return redirect(route('admin.plan.project.consumerCommitteeTransaction.index', $project));
    }

    public function show(Project $project, ConsumerCommitteeTransaction $consumerCommitteeTransaction)
    {
        return view('plan::show');
    }

    public function edit(Project $project, ConsumerCommitteeTransaction $consumerCommitteeTransaction)
    {
        return view('plan::admin.consumer_committee_transaction.edit', compact('project', 'consumerCommitteeTransaction'));
    }

    public function update(UpdateConsumerCommitteeTransactionRequest $request, Project $project, ConsumerCommitteeTransaction $consumerCommitteeTransaction)
    {
        $consumerCommitteeTransaction->update($request->validated());

        toast('किस्ता/पेश्की विवरण सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.plan.project.consumerCommitteeTransaction.index', $project));
    }

    public function destroy(Project $project, ConsumerCommitteeTransaction $consumerCommitteeTransaction)
    {
        $consumerCommitteeTransaction->delete();

        toast('किस्ता/पेश्की विवरण सफलतापूर्वक मेटाइयो', 'success');

        return back();
    }
}
