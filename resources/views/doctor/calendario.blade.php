@extends('layouts.base')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
        font-family: 'Montserrat', sans-serif;
    }

    .calendar-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        color: #212121;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    #calendar {
        background: white;
        border-radius: 15px;
        padding: 1rem;
    }

    .fc-event {
        cursor: pointer;
    }
</style>

<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="text-dark mb-2">
                        <i class="bi bi-calendar3 me-2"></i>Calendario de Citas
                    </h1>
                    <p class="text-muted">Dr. {{ $doctor->user->name }} - {{ $doctor->especialidad }}</p>
                </div>
                <a href="{{ route('doctor.dashboard') }}" class="btn btn-warning">
                    <i class="bi bi-arrow-left me-2"></i>Volver al Dashboard
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="calendar-card">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales/es.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: @json($citas),
            eventClick: function(info) {
                alert('Cita: ' + info.event.title + '\nFecha: ' + info.event.start.toLocaleString());
            },
            eventColor: function(info) {
                    return info.event.extendedProps.color || '#1976D2';
            },
            height: 'auto',
            weekends: true,
            editable: false,
            selectable: false,
        });
        calendar.render();
    });
</script>

@endsection

