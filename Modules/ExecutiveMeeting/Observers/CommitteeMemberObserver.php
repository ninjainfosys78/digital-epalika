<?php

namespace Modules\ExecutiveMeeting\Observers;

use Modules\ExecutiveMeeting\Entities\CommitteeMember;

class CommitteeMemberObserver
{
    public function creating(CommitteeMember $committeeMember)
    {
        if (is_null($committeeMember->position)) {
            $committeeMember->position = CommitteeMember::max('position') + 1;

            return;
        }

        $lowerPriorityCommitteeMembers = CommitteeMember::where('position', '>=', $committeeMember->position)
            ->get();

        foreach ($lowerPriorityCommitteeMembers as $lowerPriorityCommitteeMember) {
            $lowerPriorityCommitteeMember->position++;
            $lowerPriorityCommitteeMember->saveQuietly();
        }
    }

    public function updating(CommitteeMember $committeeMember)
    {
        if ($committeeMember->isClean('position')) {
            return;
        }

        if (is_null($committeeMember->position)) {
            $committeeMember->position = CommitteeMember::max('position');
        }

        if ($committeeMember->getOriginal('position') > $committeeMember->position) {
            $positionRange = [
                $committeeMember->position, $committeeMember->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $committeeMember->getOriginal('position'), $committeeMember->position,
            ];
        }

        $lowerPriorityCommitteeMembers = CommitteeMember::whereBetween('position', $positionRange)
            ->where('id', '!=', $committeeMember->id)
            ->get();

        foreach ($lowerPriorityCommitteeMembers as $lowerPriorityCommitteeMember) {
            if ($committeeMember->getOriginal('position') < $committeeMember->position) {
                $lowerPriorityCommitteeMember->position--;
            } else {
                $lowerPriorityCommitteeMember->position++;
            }
            $lowerPriorityCommitteeMember->saveQuietly();
        }
    }

    public function deleting(CommitteeMember $committeeMember)
    {
        $lowerPriorityCommitteeMembers = CommitteeMember::where('position', '>', $committeeMember->position)
            ->get();

        foreach ($lowerPriorityCommitteeMembers as $lowerPriorityCommitteeMember) {
            $lowerPriorityCommitteeMember->position--;
            $lowerPriorityCommitteeMember->saveQuietly();
        }
    }
}
