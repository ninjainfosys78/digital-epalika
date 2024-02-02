<?php

use Illuminate\Support\Facades\Route;
use Modules\ExecutiveMeeting\Http\Controllers\Admin\CalenderController;
use Modules\ExecutiveMeeting\Http\Controllers\Admin\CommitteeController;
use Modules\ExecutiveMeeting\Http\Controllers\Admin\CommitteeMemberController;
use Modules\ExecutiveMeeting\Http\Controllers\Admin\CommitteeTypeController;
use Modules\ExecutiveMeeting\Http\Controllers\Admin\DashboardController;
use Modules\ExecutiveMeeting\Http\Controllers\Admin\MeetingAgendaController;
use Modules\ExecutiveMeeting\Http\Controllers\Admin\MeetingController;
use Modules\ExecutiveMeeting\Http\Controllers\Admin\MeetingDecisionController;
use Modules\ExecutiveMeeting\Http\Controllers\Admin\ReportController;
use Modules\ExecutiveMeeting\Http\Controllers\MinuteSettingController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard/ajax', [DashboardController::class, 'ajaxData'])->name('dashboard.ajax');

Route::prefix('setting')->as('setting.')->group(function () {
    Route::resource('committeeType', CommitteeTypeController::class);
    Route::resource('committee', CommitteeController::class);
    Route::resource('minuteSetting', MinuteSettingController::class);
});

Route::controller(CalenderController::class)
    ->as('calendar.')
    ->group(function () {
        Route::get('calendar', 'index')->name('index');
        Route::get('meeting-calendar', 'getData')->name('meetingCalendar');
    });

Route::resource('committee/{committee}/committeeMember', CommitteeMemberController::class)->names('committee.committeeMember');
Route::get('meeting/{meeting}/meetingMinute', [MeetingController::class, 'minuteForm'])->name('meeting.meetingMinute.index');
Route::post('meeting/{meeting}/meetingMinute', [MeetingController::class, 'storeMeetingMinute'])->name('meeting.meetingMinute.store');
Route::get('meeting/{meeting}/printMinute', [MeetingController::class, 'printMinute'])->name('meeting.printMinute');
Route::resource('meeting', MeetingController::class);

Route::get('meeting/{meeting}/meetingAgenda/{meetingAgenda}/updateStatus', [MeetingAgendaController::class, 'updateStatus'])->name('meeting.meetingAgenda.updateStatus');
Route::resource('meeting/{meeting}/meetingAgenda', MeetingAgendaController::class)->names('meeting.meetingAgenda');
Route::resource('meeting/{meeting}/meetingDecision', MeetingDecisionController::class)->names('meeting.meetingDecision');

Route::controller(ReportController::class)->prefix('reports')->as('report.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('report-data', 'report')->name('report-data');
});
