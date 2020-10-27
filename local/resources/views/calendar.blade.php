@extends('layouts.master')

@section('style')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" />
<link rel='stylesheet' href="{{ asset('/fullcalendar/core/main.css') }}" />
<link rel='stylesheet' href="{{ asset('/fullcalendar/daygrid/main.css') }}" />
<link rel='stylesheet' href="{{ asset('/fullcalendar/timegrid/main.css') }}" />
<link rel='stylesheet' href="{{ asset('/fullcalendar/list/main.css') }}" />

<style>
    .fc-event {
        cursor: pointer;
    }

    .fc-list-item {
        cursor: pointer;
    }
</style>
@endsection

@section('main')
<div class="row row-eq-height">
    <div class="col-md-3">
        @foreach ($users as $out_users)
        @foreach ($employee as $out_employee)
        @if($out_employee->employee_code == $out_users->employee_code)
        <div class="iq-card">
            <div class="iq-card-body">
                <li class="d-flex align-items-center">
                    @if($out_users->profile_pic != NULL)
                    <div class="user-img img-fluid"><img src="{{ url('assets/profile/').'/'. $out_users->profile_pic }}"
                            alt="story-img" class="rounded-circle avatar-40"></div>
                    @else
                    <div class="user-img img-fluid"><img src="{{ url('/images/user/user-7.jpg') }}" alt="story-img"
                            class="rounded-circle avatar-40"></div>
                    @endif
                    <div class="media-support-info ml-3">
                        <h6>{{ $out_employee->first_name }} {{ $out_employee->last_name }}</h6>
                        <p class="mb-0">{{ $out_employee->position }}</p>
                    </div>
                </li>
            </div>
        </div>
        @endif
        @endforeach
        @endforeach

        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title ">ประเภทงาน</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <ul class="m-0 p-0 job-classification">
                    @foreach ($subject as $out_subject)
                    <li class=""><i class="ri-check-line"
                            style="background-color: {{ $out_subject->color_code }}"></i>{{ $out_subject->name_subject }}
                    </li>
                    @endforeach
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
                    @if($events_today->isEmpty())
                    <li class="d-flex">
                        <div class="schedule-icon"><i class="ri-checkbox-blank-circle-fill text-danger"></i>
                        </div>
                        <div class="schedule-text"> <span>ไม่มีงานในวันนี้</span>
                            <span>- ถึง -</span></div>
                    </li>
                    @else
                    @foreach ( $events_today as $out_events_today)
                    <li class="d-flex">
                        <div class="schedule-icon">
                            <i class="ri-checkbox-blank-circle-fill"
                                style="color: {{ $out_events_today->color_code }};"></i>
                        </div>
                        <div class="schedule-text">
                            <span>{{ $out_events_today->event_name }}</span>
                            <?php
                                    $date = substr($out_events_today->start_date, 0, 10);
                                    $time_start = substr($out_events_today->start_date, 11, 5);
                                    $time_stop = substr($out_events_today->end_date, 11, 5);
                                    $day =  date("d/m/Y", strtotime($date));
                                ?>
                            <span>{{ $time_start }} ถึง {{ $time_stop }}</span>
                        </div>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="iq-card">
            <div class="iq-card-body">
                <div id='calendar2'></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header ">
                <h4 class="modal-title">แก้ไขงาน</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['class' => 'form-del', 'method' => 'POST' , 'url' => 'calendar/edit/'.$employee_code, 'files' => true]) }}
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">หน่วยงาน</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" name="customer_cal" id="customer_cal">
                                        <option></option>
                                        @foreach ($customer as $out_customer)
                                        <option value="{{ $out_customer->code_customer }}">
                                            {{ $out_customer->name_customer }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">โปรเจค</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" name="project_cal" id="project_cal">
                                        <option></option>
                                        @foreach ($project as $out_project)
                                        <option value="{{ $out_project->code_project }}">
                                            {{ $out_project->name_project }}
                                        </option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" class="form-control" name="project_cal" id="project_cal"
                                        style="background-color: white;"> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">หัวข้อ</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" name="subject_cal" id="subject_cal">
                                        <option></option>
                                        @foreach ($subject as $out_subject)
                                        <option value="{{ $out_subject->code_subject }}">
                                            {{ $out_subject->name_subject }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">บุคคลติดต่อ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="contact_person_cal"
                                        id="contact_person_cal" style="background-color: white;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">สถานที่</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="address_cal" id="address_cal"
                                        placeholder="สถานที่" style="background-color: white;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">วันที่</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control date-range-picker" name="date_cal"
                                        id="date_cal" placeholder="วันที่" style="background-color: white;"
                                        readonly="true" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">เวลาเริ่ม</label>
                                <div class="col-sm-9">
                                    <input type="time" class="form-control" name="time_start_cal" id="time_start_cal"
                                        style="background-color: white;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">เวลาจบ</label>
                                <div class="col-sm-9">
                                    <input type="time" class="form-control" name="time_stop_cal" id="time_stop_cal"
                                        style="background-color: white;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">เรื่องที่พบ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="title_cal" id="title_cal"
                                        style="background-color: white;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">หมายเหตุ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="note_cal" id="note_cal"
                                        style="background-color: white;" placeholder="หมายเหตุ">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3" for="file_cal[]">แนบไฟล์</label>
                                <div class="col-sm-9">
                                    <input type="file" multiple name="file[]" id="file_cal[]"
                                        class="form-control-file" />
                                    <small class="text-danger">#การอัพเดทไฟล์ให้อัพเดทไฟล์เก่ามาด้วย</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="file-insert"></div>
                        </div>
                        <input type="hidden" id="id_cal" name="id_cal">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger mr-auto" id="btn-del" name="btn-del"
                    onclick="if(confirm('คุณต้องการลบรายการนี้ ?')) { $('#id_del').val($('#id_cal').val()); return $('#del_form').submit(); }"
                    formaction="">
                    <i class="fa fa-trash-o pr-0"></i>
                </button>
                <button type="button" class="btn btn-danger float-right mx-1" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-success float-right mx-1">บันทึก</button>
            </div>
            {{ Form::close() }}
        </div>
        {{ Form::open(['id'=>'del_form', 'class' => 'form-del', 'method' => 'POST' , 'url' => 'calendar/delete/'.$employee_code, 'files' => true]) }}
        <input type="hidden" id="id_del" name="id_cal">
        {{ Form::close() }}
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header ">
                <h4 class="modal-title">เพิ่มงาน</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['method' => 'POST' , 'url' => 'calendar/add/'.$employee_code, 'files' => true]) }}
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">หน่วยงาน</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" name="customer_add" id="customer_add"
                                        style="width:100%" required>
                                        <option></option>
                                        @foreach ($customer as $out_customer)
                                        <option value="{{ $out_customer->code_customer }}">
                                            {{ $out_customer->name_customer }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">โปรเจค</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" name="project_add" id="project_add"
                                        style="width: 100%" required>
                                        <option></option>
                                        @foreach ($project as $out_project)
                                        <option value="{{ $out_project->code_project }}">
                                            {{ $out_project->name_project }}
                                        </option>
                                        @endforeach
                                    </select>

                                    {{-- <input type="text" class="form-control" name="project_add" placeholder="โปรเจค"
                                        id="project_add" style="background-color: white;" required> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">หัวข้อ</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" name="subject_add" id="subject_add"
                                        style="width: 100%" required>
                                        <option></option>
                                        @foreach ($subject as $out_subject)
                                        <option value="{{ $out_subject->code_subject }}">
                                            {{ $out_subject->name_subject }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">บุคคลติดต่อ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="contact_person_add"
                                        placeholder="บุคคลติดต่อ" id="contact_person_add"
                                        style="background-color: white;" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">สถานที่</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="address_add" id="address_add"
                                        placeholder="สถานที่" style="background-color: white;" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">วันที่</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="date_add" id="date_add" readonly
                                        required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">เวลาเริ่ม</label>
                                <div class="col-sm-9">
                                    <input type="time" class="form-control" name="time_start_add" id="time_start_add"
                                        style="background-color: white;" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">เวลาจบ</label>
                                <div class="col-sm-9">
                                    <input type="time" class="form-control" name="time_stop_add" id="time_stop_add"
                                        style="background-color: white;" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">เรื่องที่พบ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="title_add" id="title_add"
                                        placeholder="เรื่องที่พบ" style="background-color: white;" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">หมายเหตุ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="note_add" id="note_add"
                                        placeholder="หมายเหตุ" style="background-color: white;" placeholder="หมายเหตุ">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3" for="file[]">แนบไฟล์</label>
                                <div class="col-sm-9">
                                    <input type="file" multiple name="file[]" id="file[]" class="form-control-file" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-success">บันทึก</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection

@section('script')

<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{ asset('fullcalendar/core/main.js') }}"></script>
<script src="{{ asset('fullcalendar/daygrid/main.js') }}"></script>
<script src="{{ asset('fullcalendar/interaction/main.js') }}"></script>
<script src="{{ asset('fullcalendar/timegrid/main.js') }}"></script>
<script src="{{ asset('fullcalendar/list/main.js') }}"></script>

<script>
    $.fn.select2.defaults.set( "theme", "bootstrap", "width", "100%" );
    $( document ).ready(function() {
       $('#customer_add').select2({
            placeholder: "โปรดเลือกหน่วยงาน"
        });

        $('#project_add').select2({
            placeholder: "โปรดเลือกโปรเจค"
        });

        $('#subject_add').select2({
            placeholder: "โปรดเลือกหัวข้อ"
        });

        $('#customer_cal').select2({
            placeholder: "โปรดเลือกหน่วยงาน",
        });

        $('#project_cal').select2({
            placeholder: "โปรดเลือกโปรเจค",
        });

        $('#subject_cal').select2({
            placeholder: "โปรดเลือกหัวข้อ",
        });
    });
</script>

<script>
    window.mobilecheck = function() {
        var check = false;
        (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
        return check;
    };

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar2');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction','dayGrid', 'timeGrid', 'list'],
            defaultView: "dayGridMonth",
            selectable: true,
            longPressDelay: 0,
            locale: 'th',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth, timeGridWeek, timeGridDay, listWeek',
            },
            buttonText: {
                dayGridMonth: 'เดือน',
                timeGridDay: 'วัน',
                timeGridWeek: 'สัปดาห์',
                listWeek: 'แผนงาน',
                today: 'วันนี้'
            },
            nextDayThreshold: '00:00:01',
            events : [
                @foreach($events as $event)
                {
                    title: '{{ $event->event_name }}',
                    start: '{{ $event->start_date }}',
                    end: '{{ $event->end_date }}',
                    color: '{{ $event->color_code }}',
                    textColor: 'white',
                    extendedProps: {
                        title : '{{ $event->event_name }}',
                        start : '{{ $event->start_date }}',
                        end   : '{{ $event->end_date }}',
                        contact_person : '{{ $event->contact_person }}',
                        address : '{{ $event->address }}',
                        note : '{{ $event->note }}',
                        code_customer: '{{ $event->code_customer}}',
                        subject: '{{ $event->subject }}',
                        project: '{{ $event->project }}',
                        id: '{{ $event->id }}',
                    },                            

                },
                @endforeach
            ],
            select: function(info) {
                $('#addModal').modal("show");
                $('#date_add').val(moment(info.start).format('DD/MM/YYYY') + ' - ' + moment(info.end-1).format('DD/MM/YYYY'));
            },
            // dateClick: function(info) {
            //     $('#addModal').modal("show");
            //     $('#date_add').val(moment(info.start).format('DD/MM/YYYY') + ' - ' + moment(info.end-1).format('DD/MM/YYYY'));
            // },
            eventClick: function(info) {
                $('#title_cal').val(info.event.extendedProps.title);
                $('#start_time_cal').val(moment(info.event.extendedProps.start).format('YYYY-MM-DD HH:mm:ss'));
                $('#finish_time').val(moment(info.event.extendedProps.end).format('YYYY-MM-DD HH:mm:ss'));
                $('#project_cal').val(info.event.extendedProps.project).trigger('change');
                // $('#project_cal').val(info.event.extendedProps.project);
                $('#customer_cal').val(info.event.extendedProps.code_customer).trigger('change');
                $('#subject_cal').val(info.event.extendedProps.subject).trigger('change');
                $('#contact_person_cal').val(info.event.extendedProps.contact_person);
                $('#address_cal').val(info.event.extendedProps.address);
                $('#note_cal').val(info.event.extendedProps.note);
                $('#date_cal').daterangepicker({
                    startDate: moment(info.event.extendedProps.start).format('DD/MM/YYYY'),
                    endDate: moment(info.event.extendedProps.end).format('DD/MM/YYYY'),
                    locale: {
                        format: 'DD/MM/YYYY'
                    }
                });
                $('#time_start_cal').val(moment(info.event.extendedProps.start).format('HH:mm'));
                $('#time_stop_cal').val(moment(info.event.extendedProps.end).format('HH:mm'));
                $('#id_cal').val(info.event.extendedProps.id);

                $('.div-file-insert').remove();
                var array = {!! json_encode($file->toArray()) !!};
                
                array.forEach(element => {
                    if(element.event_id == info.event.extendedProps.id){
                        var url = '{{ url("/local/public/file/:id") }}';
                        url = url.replace(':id', encodeURIComponent(element.file.trim()));
                        $('#file-insert').append('\
                            <div class="div-file-insert">\
                                <a target="_blank" href='+url+' }}">\
                                    <i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size:24px;color:red;"></i>\
                                </a>\
                            </div>\
                        ');
                    } 
                });
                $('#detailModal').modal();
            }
        });

        calendar.render();
    });
</script>

<script>
    $('#detailModal').on('shown.bs.modal', function() {
        $('.date-range-picker').daterangepicker({
            autoApply: true,
            autoUpdateInput: false,
            autoclose: true,
            locale: {
                cancelLabel: 'ล้าง',
                applyLabel: "ใช้",
                format: "DD/MM/YYYY",
                daysOfWeek: [
                    "อา.",
                    "จ.",
                    "อ.",
                    "พ.",
                    "พฤ.",
                    "ศ.",
                    "ส."
                ],
                monthNames: [
                    "มกราคม",
                    "กุมภาพันธ์",
                    "มีนาคม",
                    "เมษายน",
                    "พฤษภาคม",
                    "มิถุนายน",
                    "กรกฎาคม",
                    "สิงหาคม",
                    "กันยายน",
                    "ตุลาคม",
                    "พฤศจิกายน",
                    "ธันวาคม"
                ],
            }
        });

        $('.date-range-picker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        });

        $('.date-range-picker').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });
</script>

@endsection