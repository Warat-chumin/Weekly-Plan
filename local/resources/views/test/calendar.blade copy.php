
@extends('layouts.master')

@section('style')
    <!-- Full calendar -->
    {{-- <link rel='stylesheet' href="{{ asset('fullcalendar/core/main.css')}}" />
    <link rel='stylesheet' href="{{ asset('fullcalendar/daygrid/main.css')}}" />
    <link rel='stylesheet' href="{{ asset('fullcalendar/timegrid/main.css')}}" />
    <link rel='stylesheet' href="{{ asset('fullcalendar/list/main.css')}}" /> --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/bootstrap/main.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/list/main.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/timegrid/main.min.css' />
@endsection

@section('main')
<div class="row row-eq-height">
    <div class="col-md-3">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title ">ประเภทงาน</h4>
                </div>

                {{-- <div class="iq-card-header-toolbar d-flex align-items-center">
                    <a href="#"><i class="fa fa-plus  mr-0" aria-hidden="true"></i></a>
                </div> --}}
            </div>
            <div class="iq-card-body">
                <ul class="m-0 p-0 job-classification">
                    <li class=""><i class="ri-check-line bg-info"></i>ประชุม</li>
                    <li class=""><i class="ri-check-line bg-success"></i>พบลูกค้า</li>
                    <li class=""><i class="ri-check-line bg-danger"></i>ลางาน</li>
                    <li class=""><i class="ri-check-line bg-warning"></i>อื่นๆ</li>
                </ul>
            </div>
        </div>
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">แผนงานวันนี้</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <ul class="m-0 p-0 today-schedule">
                    <li class="d-flex">
                        <div class="schedule-icon"><i class="ri-checkbox-blank-circle-fill text-warning"></i>
                        </div>
                        <div class="schedule-text"> <span>เช็ค e-Mail</span>
                            <span>08:30 ถึง 09:00</span></div>
                    </li>
                    <li class="d-flex">
                        <div class="schedule-icon"><i class="ri-checkbox-blank-circle-fill text-warning"></i>
                        </div>
                        <div class="schedule-text"> <span>เคลียร์เอกสาร</span>
                            <span>10:00 ถึง 12:00</span></div>
                    </li>
                    <li class="d-flex">
                        <div class="schedule-icon"><i class="ri-checkbox-blank-circle-fill text-success"></i>
                        </div>
                        <div class="schedule-text"> <span>โทรทำนัด นำเสนองาน</span>
                            <span>13:00 ถึง 15:30</span></div>
                    </li>
                    <li class="d-flex">
                        <div class="schedule-icon"><i class="ri-checkbox-blank-circle-fill text-primary"></i>
                        </div>
                        <div class="schedule-text"> <span>ประชุมงาน ไฟ Alarm และระบบปั้ม</span>
                            <span>15:30 ถึง 16:30</span></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="iq-card">
            {{-- <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Book Appointment</h4>
                </div>
                <div class="iq-card-header-toolbar d-flex align-items-center">
                    <a href="#" class="btn btn-primary"><i class="ri-add-line mr-2"></i>Book Appointment</a>
                </div>
            </div> --}}
            <div class="iq-card-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <!-- Full calendar -->
    {{-- <script src="{{ asset('fullcalendar/core/main.js')}}"></script>
    <script src="{{ asset('fullcalendar/daygrid/main.js')}}"></script>
    <script src="{{ asset('fullcalendar/timegrid/main.js')}}"></script>
    <script src="{{ asset('fullcalendar/list/main.js')}}"></script> --}}

    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullc/alendar/3.1.0/fullcalendar.min.js'></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/bootstrap/main.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/locales-all.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/google-calendar/main.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/interaction/main.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/list/main.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/luxon/main.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/moment-timezone/main.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/moment/main.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/rrule/main.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/timegrid/main.min.js'></script>


    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header ">
                    <h4 class="modal-title">รายละเอียด</h4>
                    <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-dismiss="modal"><i
                            class="mdi mdi-close"></i></button>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">หน่วยงาน</label>
                                    <label class="col-sm-9"><input type="text" class="form-control" name="customer_name_cal" id="customer_name_cal" style="background-color: white;" readonly></label>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">โปรเจค</label>
                                    <label class="col-sm-9"><input type="text" class="form-control" name="project_name_cal" id="project_name_cal" style="background-color: white;" readonly></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">หัวข้อ</label>
                                    <label class="col-sm-9"><input type="text" class="form-control" name="subject_name_cal" id="subject_name_cal" style="background-color: white;" readonly ></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">บุคคลติดต่อ</label>
                                    <label class="col-sm-9"><input type="text" class="form-control" name="contact_person_cal" id="contact_person_cal" style="background-color: white;" readonly></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">สถานที่</label>
                                    <label class="col-sm-9"><input type="text" class="form-control" name="address_cal" id="address_cal" style="background-color: white;" readonly></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">วันที่</label>
                                    <label class="col-sm-9"><input type="text" class="form-control" name="date_cal" id="date_cal" style="background-color: white;" readonly></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">เวลาเริ่ม</label>
                                    <label class="col-sm-9"><input type="text" class="form-control" name="time_start_cal" id="time_start_cal" style="background-color: white;" readonly></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">เวลาจบ</label>
                                    <label class="col-sm-9"><input type="text" class="form-control" name="time_stop_cal" id="time_stop_cal" style="background-color: white;" readonly></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">เรื่องที่พบ</label>
                                    <label class="col-sm-9"><input type="text" class="form-control" name="title" id="title" style="background-color: white;" readonly></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">หมายเหตุ</label>
                                    <label class="col-sm-9"><input type="text" class="form-control" name="note_cal" id="note_cal" style="background-color: white;" readonly></label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">แนบไฟล์</label>
                                    <label class="col-sm-9"><input type="text" class="form-control" name="" id=""></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Event</h4>

                    Start - End:
                    <br />
                    <input type="text" class="form-control" name="date" id="date">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="button" class="btn btn-primary" id="appointment_update" value="Save">
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                selectable: true,
                header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
                },
                events : [
                    @foreach($events as $event)
                    {
                        title : '{{ $event->event_name }}',
                        start : '{{ $event->start_date }}',
                        end   : '{{ $event->end_date }}',
                        project_name : '{{ $event->project_name }}',
                        customer_name : '{{ $event->customer_name }}',
                        subject_name : '{{ $event->subject_name }}',
                        contact_person : '{{ $event->contact_person }}',
                        address : '{{ $event->address }}',
                        note : '{{ $event->note }}',
                        color: 'green'
                    },
                    @endforeach
                ],
                // dateClick: function(info) {
                //     alert('clicked ' + info.dateStr);
                // },
                // select: function(info) {
                //     alert('selected ' + info.startStr + ' to ' + info.endStr);
                //     $('#editModal').modal();
                // },
                // dayClick: function(date, jsEvent, view, resourceObj) {
                //     $('#title').val(date.format());
                //     $('#editModal').modal();
                // },
                select: function(start, end) {
                    $('#addModal').modal("show");
                    $(".modal")
                        .find("#date")
                        .val(start.format('DD/MM/YYYY') +' - '+end.format('DD/MM/YYYY'));
                },
                // eventColor: 'rgb(11, 128, 67)',
                eventTextColor: 'rgb(255, 255, 255)',
                eventClick: function(calEvent, jsEvent, view) {
                    $('#title').val(calEvent.title);
                    $('#start_time').val(moment(calEvent.start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#finish_time').val(moment(calEvent.end).format('YYYY-MM-DD HH:mm:ss'));
                    $('#project_name_cal').val(calEvent.project_name);
                    $('#customer_name_cal').val(calEvent.customer_name);
                    $('#subject_name_cal').val(calEvent.subject_name);
                    $('#contact_person_cal').val(calEvent.contact_person);
                    $('#address_cal').val(calEvent.address);
                    $('#note_cal').val(calEvent.note);
                    $('#date_cal').val(moment(calEvent.start).format('DD/MM/YYYY') + ' ถึง ' + moment(calEvent.end).format('DD/MM/YYYY'));
                    $('#time_start_cal').val(moment(calEvent.start).format('HH:mm'));
                    $('#time_stop_cal').val(moment(calEvent.end).format('HH:mm'));
                    $('#detailModal').modal();
                }
            })
        });
    </script>
@endsection
