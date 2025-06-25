@extends('layouts.v_template2')

@section('title', 'Kalender Kegiatan')
@section('page', 'Kalender Kegiatan Ekstrakurikuler')

@section('content')
<div class="container-fluid">

    {{-- Notifikasi Error & Success --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5>Kalender Kegiatan</h5>
        </div>
        <div class="card-body">
            <div id="calendar"></div>
        </div>
    </div>
</div>

<!-- Modal Detail Kegiatan -->
<div class="modal fade" id="modalKegiatan" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Detail Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p><strong>Judul Kegiatan:</strong> <span id="modal-title"></span></p>
                <p><strong>Ekstrakurikuler:</strong> <span id="modal-ekskul"></span></p>
                <p><strong>Jenis Kegiatan:</strong> <span id="modal-jenis"></span></p>
                <p><strong>Waktu:</strong> <span id="modal-waktu"></span></p>
                <p><strong>Lokasi:</strong> <span id="modal-lokasi"></span></p>
                <p><strong>Keterangan:</strong> <span id="modal-keterangan"></span></p>
            </div>
            <div class="modal-footer">
                <a id="btn-absen" href="#" class="btn btn-warning">Absen Sekarang</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listMonth'
            },
            events: "{{ url('/kalender-kegiatan/json') }}",
            eventClick: function(info) {
                const event = info.event;
                const props = event.extendedProps;

                document.getElementById('modal-title').textContent = event.title;
                document.getElementById('modal-ekskul').textContent = props.nama_ekskul || '-';
                document.getElementById('modal-jenis').textContent = props.jenis_kegiatan || '-';
                document.getElementById('modal-waktu').textContent = event.start.toLocaleString() + ' - ' + (event.end ? event.end.toLocaleString() : '-');
                document.getElementById('modal-lokasi').textContent = props.lokasi || '-';
                document.getElementById('modal-keterangan').textContent = props.keterangan || '-';

                document.getElementById('btn-absen').href = `/kehadiran/siswa/form/${props.id}`;

                const modal = new bootstrap.Modal(document.getElementById('modalKegiatan'));
                modal.show();
            }
        });

        calendar.render();
    });
</script>
@endsection
