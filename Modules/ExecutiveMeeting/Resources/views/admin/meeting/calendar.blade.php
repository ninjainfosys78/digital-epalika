@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.executiveMeeting.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">बैठक क्यालेन्डर</li>
                    </ol>
                </div>
                <h4 class="page-title">बैठक क्यालेन्डर</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="create-meeting-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="staticBackdropLabel">नयाँ बैठक विवरण थप्नुहोस्</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createMeetingForm" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="committee_id" class="form-label">समिति *</label>
                                <select
                                    name="committee_id"
                                    class="form-control"
                                    id="committee_id" required>
                                    <option value="">-- छान्नुहोस् ---</option>
                                    @foreach($committees as $committee)
                                        <option
                                            value="{{$committee->id}}">
                                            {{$committee->committee_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="meeting_name" class="form-label">बैठकको शिर्षक *</label>
                                <input
                                    type="text"
                                    name="meeting_name"
                                    value="{{old('meeting_name')}}"
                                    class="form-control"
                                    id="meeting_name"
                                    placeholder="नाम"
                                    required
                                />
                            </div>
                            <div class="col-md-6 mb-2">
                                <x-date-input-component
                                    nameNe="start_date" labelNe="सुरू मिति *"
                                    nameEn="en_start_date" labelEn="Start Date"
                                    container="#create-meeting-modal"
                                    :getTodayDate="false"
                                />
                            </div>
                            <div class="col-md-6 mb-2">
                                <x-date-input-component
                                    nameNe="end_date" labelNe="अन्तिम मिति"
                                    nameEn="en_end_date" labelEn="End Date"
                                    container="#create-meeting-modal"
                                    :getTodayDate="false"
                                />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="recurrence" class="form-label">पुनरावृत्ति *</label>
                                <select
                                    name="recurrence"
                                    class="form-control"
                                    id="recurrence" required>
                                    <option value="">-- छान्नुहोस् ---</option>
                                    @foreach(\Modules\ExecutiveMeeting\Enums\RecurrenceTypeEnum::cases() as $recurrence)
                                        <option
                                            value="{{$recurrence->value}}">
                                            {{$recurrence->label()}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <x-date-input-component
                                    nameNe="recurrence_end_date" labelNe="पुनरावृत्ति अन्तिम मिति"
                                    nameEn="en_recurrence_end_date" labelEn="Recurrence End Date"
                                    container="#create-meeting-modal"
                                    :getTodayDate="false"
                                />
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">सन्देश *</label>
                                <textarea
                                    name="description"
                                    id="description"
                                    class="form-control"
                                    placeholder="विवरण"
                                    required
                                    cols="30" rows="3">{{old('description')}}</textarea>
                            </div>
                        </div>

                        <button type="submit" id="submitBtn" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-meeting-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="staticBackdropLabel">बैठक विवरण सम्पादन गर्नुहोस्</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editMeetingForm" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="edit_committee_id" class="form-label">समिति *</label>
                                <select
                                    name="committee_id"
                                    class="form-select"
                                    id="edit_committee_id" required>
                                    <option value="">-- छान्नुहोस् ---</option>
                                    @foreach($committees as $committee)
                                        <option
                                            value="{{$committee->id}}">
                                            {{$committee->committee_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="edit_meeting_name" class="form-label">बैठकको शिर्षक *</label>
                                <input
                                    type="text"
                                    name="meeting_name"
                                    value="{{old('meeting_name')}}"
                                    class="form-control"
                                    id="edit_meeting_name"
                                    placeholder="नाम"
                                    required
                                />
                            </div>
                            <div class="col-md-6 mb-2">
                                <x-date-input-component
                                    idNe="edit_start_date"
                                    nameNe="start_date" labelNe="सुरू मिति *"
                                    idEn="edit_en_start_date"
                                    nameEn="en_start_date" labelEn="Start Date"
                                    container="#edit-meeting-modal"
                                    :getTodayDate="false"
                                />
                            </div>
                            <div class="col-md-6 mb-2">
                                <x-date-input-component
                                    idNe="edit_end_date"
                                    nameNe="end_date" labelNe="अन्तिम मिति"
                                    idEn="edit_en_end_date"
                                    nameEn="en_end_date" labelEn="End Date"
                                    container="#edit-meeting-modal"
                                    :getTodayDate="false"
                                />
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="edit_description" class="form-label">सन्देश *</label>
                                <textarea
                                    name="description"
                                    id="edit_description"
                                    class="form-control"
                                    placeholder="विवरण"
                                    required
                                    cols="30" rows="3">{{old('description')}}</textarea>
                            </div>
                        </div>

                        <button type="submit" id="editSubmitBtn" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('style')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">
    @endpush

    @push('scripts')
        <script src="{{asset('assets/backend/js/plugins/datepicker.min.js')}}"></script>
        <!-- plugin js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>
        <!-- Calendar init -->
        <script type="text/javascript">
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#calendar').fullCalendar({
                    selectable: true,
                    droppable: true,
                    editable: true,
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    events: "{{route('admin.executiveMeeting.calendar.meetingCalendar')}}",
                    select: function(start, end, jsEvent, view) {
                        $('#createMeetingForm').trigger('reset')
                        $('#en_start_date').val(start.format('YYYY-MM-DD'))
                        $('#en_end_date').val(start.format('YYYY-MM-DD'))
                        let parsedDate = NepaliFunctions.ParseDate(start.format('YYYY-MM-DD'));
                        let nepaliDate = NepaliFunctions.AD2BS(parsedDate.parsedDate)
                        let formattedNepaliDate = NepaliFunctions.ConvertDateFormat(nepaliDate, "YYYY-MM-DD")
                        $('#start_date').val(formattedNepaliDate)
                        $('#end_date').val(formattedNepaliDate)
                        $('#create-meeting-modal').modal('toggle');
                    },
                    eventClick: function(eventInfo) {
                        $('#edit_meeting_name').val(eventInfo.title)
                        $('#edit_start_date').val(eventInfo.ne_start_date)
                        $('#edit_en_start_date').val(eventInfo.start.format('YYYY-MM-DD'))
                        $('#edit_end_date').val(eventInfo.ne_end_date)
                        $('#edit_committee_id').val(eventInfo.committee_id)
                        $('#edit_en_end_date').val(eventInfo.en_end_date)
                        $('#edit_description').val(eventInfo.description)
                        const meetingUrl="{{route('admin.executiveMeeting.meeting.index')}}"
                        $('#editMeetingForm').attr('data-edit-meeting-url',`${meetingUrl}/${eventInfo.id}`)
                        $('#edit-meeting-modal').modal('toggle');
                    }
                });

                $(document).delegate('#createMeetingForm','submit',function (e){
                    e.preventDefault()
                    $.ajax({
                        type: "post",
                        url: "{{route('admin.executiveMeeting.meeting.store')}}",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        beforeSend: function () {
                            $('#submitBtn').prop('disabled', true);
                            $('#submitBtn').html("<i class='fa fa-spinner fa-spin'></i>");
                        },
                        success: function (resp) {
                            $('#submitBtn').prop('disabled', false);
                            $('#calendar').fullCalendar('refetchEvents');
                            $('#submitBtn').html("पेश गर्नुहोस्");
                            toastMessage('success', resp.message)
                            $('#create-meeting-modal').modal('toggle')
                            $('#createMeetingForm').trigger('reset')
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            $('#submitBtn').prop('disabled', false)
                            $('#submitBtn').html("पेश गर्नुहोस्");
                            toastMessage('error', XMLHttpRequest.responseJSON.message)
                        }
                    });
                })

                $(document).delegate('#editMeetingForm','submit',function (e){
                    e.preventDefault()
                    $.ajax({
                        type: "post",
                        url: $(this).data('edit-meeting-url'),
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        beforeSend: function () {
                            $('#editSubmitBtn').prop('disabled', true);
                            $('#editSubmitBtn').html("<i class='fa fa-spinner fa-spin'></i>");
                        },
                        success: function (resp) {
                            $('#editSubmitBtn').prop('disabled', false);
                            $('#calendar').fullCalendar('refetchEvents');
                            $('#editSubmitBtn').html("पेश गर्नुहोस्");
                            toastMessage('success', resp.message)
                            $('#edit-meeting-modal').modal('toggle')
                            $('#editMeetingForm').trigger('reset')
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            $('#editSubmitBtn').prop('disabled', false)
                            $('#editSubmitBtn').html("पेश गर्नुहोस्");
                            toastMessage('error', XMLHttpRequest.responseJSON.message)
                        }
                    });
                })

                function toastMessage(type, title) {
                    swal.fire({
                        title: title,
                        toast: true,
                        position: 'top-right',
                        showConfirmButton: false,
                        width: 450,
                        timer: 3000,
                        timerProgressBar: true,
                        icon: type,
                    });
                }
            });
        </script>
    @endpush
@endsection
