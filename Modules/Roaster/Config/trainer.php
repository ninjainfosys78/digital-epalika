<?php

return [
    /**
     * Show or hide form in trainer form
     **/
    'status' => [
        'bankDetailForm' => env('TRAINER_STATUS_BANK_DETAIL_FORM', true),
        'experienceForm' => env('TRAINER_STATUS_EXPERIENCE_FORM', true),
        'qualificationForm' => env('TRAINER_STATUS_QUALIFICATION_FORM', true),
        'experienceAsTraineeForm' => env('TRAINER_STATUS_EXPERIENCE_AS_TRAINEE_FORM', true),
        'experienceAsTrainerForm' => env('TRAINER_STATUS_EXPERIENCE_AS_TRAINER_FORM', true),
        'otherDocumentForm' => env('TRAINER_STATUS_OTHER_DOCUMENT_FORM', false),
        'compactForm' => env('TRAINER_COMPACT_FORM', true),
    ],
    /**
     * Type of form in trainer form
     * it takes  "compact" or "extended" type only
     **/
    'type' => [
        'bankDetailForm' => env('TRAINER_BANK_DETAIL_FORM_TYPE', 'compact'),
        'experienceForm' => env('TRAINER_EXPERIENCE_FORM_TYPE', 'compact'),
        'qualificationForm' => env('TRAINER_QUALIFICATION_FORM_TYPE', 'compact'),
        'experienceAsTraineeForm' => env('TRAINER_EXPERIENCE_AS_TRAINEE_FORM_TYPE', 'compact'),
        'experienceAsTrainerForm' => env('TRAINER_EXPERIENCE_AS_TRAINER_FORM_TYPE', 'compact'),
    ],
];
