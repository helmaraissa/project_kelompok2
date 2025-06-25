@extends('layouts.v_template')

@section('title', 'Home')

@section('content')
        <!-- Navigation-->

        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Welcome!</div>
                <div class="masthead-heading text-uppercase">Ekstrakurikuler SMAN 1 Jalancagak</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="#portfolio">Tell Me More</a>
            </div>
        </header>
        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Ekstrakurikuler</h2>
                    <h3 class="section-subheading text-muted">SMAN 1 Jalancagak memiliki 23 kegiatan ekstrakurikuler yang dirancang untuk mengembangkan minat, bakat, dan keterampilan siswa. Berbagai pilihan ekskul tersedia, mulai dari olahraga, seni, sains, hingga organisasi kepemimpinan, yang bertujuan untuk meningkatkan kreativitas, disiplin, dan pengalaman belajar di luar kelas.</h3>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 1-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/pelacak.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">PELACAK</div>
                                <div class="portfolio-caption-subheading text-muted">Pecinta Alam SMAN 1 Jalancagak</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 2-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal2">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/kingjava.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Marching Band</div>
                                <div class="portfolio-caption-subheading text-muted">Marching Band King Java SMANJA</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 3-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal3">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/volly.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">VBC</div>
                                <div class="portfolio-caption-subheading text-muted">VolleyBall Club SMANJA</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                        <!-- Portfolio item 4-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal4">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/4.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">FPSH & HAM</div>
                                <div class="portfolio-caption-subheading text-muted">Forum Pelajar Sadar Hukum & Hak Asasi Manusia</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-sm-0">
                        <!-- Portfolio item 5-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal5">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/5.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">MKS</div>
                                <div class="portfolio-caption-subheading text-muted">Media Komunikasi Siswa - Mading</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                        <!-- Portfolio item 6-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal6">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/paskarjaga.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">PASKARJAGA</div>
                                <div class="portfolio-caption-subheading text-muted">Paguyuban Seni Karawitan SMAN 1 Jalancagak</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-sm-0">
                        <!-- Portfolio item 7-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal7">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/3.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Braja Sakti</div>
                                <div class="portfolio-caption-subheading text-muted">Paskibra SMANJA</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                        <!-- Portfolio item 8-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal8">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/6.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Pencak Silat</div>
                                <div class="portfolio-caption-subheading text-muted">Pencak Silat SMANJA</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-sm-0">
                        <!-- Portfolio item 9-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal9">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/irma.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">IRMA</div>
                                <div class="portfolio-caption-subheading text-muted">Ikatan Remaja Masjid (Kerohanian)</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                        <!-- Portfolio item 10-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal10">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/basket.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Basket</div>
                                <div class="portfolio-caption-subheading text-muted">Basket SMANJA</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-sm-0">
                        <!-- Portfolio item 11-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal11">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/futsal.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Futsal</div>
                                <div class="portfolio-caption-subheading text-muted">Futsal SMANJA</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                        <!-- Portfolio item 12-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal12">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/seni.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">EKSENTRIK</div>
                                <div class="portfolio-caption-subheading text-muted">(Seni Tari Tradisional)</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-sm-0">
                        <!-- Portfolio item 13-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal11">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/1.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">PMR</div>
                                <div class="portfolio-caption-subheading text-muted">Palang Merah Remaja</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                        <!-- Portfolio item 14-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal14">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/teater.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Teater</div>
                                <div class="portfolio-caption-subheading text-muted">Teater Bengkel</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-sm-0">
                        <!-- Portfolio item 15-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal15">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/pramuka.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Pramuka</div>
                                <div class="portfolio-caption-subheading text-muted">Pramuka SMANJA</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                        <!-- Portfolio item 16-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal16">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/padus.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Paduan Suara</div>
                                <div class="portfolio-caption-subheading text-muted">Paduan Suara SMANJA</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-sm-0">
                        <!-- Portfolio item 17-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal17">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/6.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">English Forum</div>
                                <div class="portfolio-caption-subheading text-muted">English Forum SMANJA</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                        <!-- Portfolio item 18-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal18">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/pramuka.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">GEULIS</div>
                                <div class="portfolio-caption-subheading text-muted">Gerakan Literasi</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-sm-0">
                        <!-- Portfolio item 19-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal19">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/pramuka.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Mojang Jajaka</div>
                                <div class="portfolio-caption-subheading text-muted">Paguyuban Mojang Jajaka</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                </div>
            </div>
        </section>
        <!-- Services-->
        <section class="page-section bg-light" id="galeri-prestasi">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Galeri Prestasi Siswa</h2>
                    <h3 class="section-subheading text-muted">Dokumentasi kegiatan lomba yang diikuti siswa.</h3>
                </div>
                <div class="row">
                    @forelse ($lomba as $item)
                        <div class="col-lg-4 col-sm-6 mb-4">
                            <div class="portfolio-item">
                                <a class="portfolio-link" data-bs-toggle="modal" href="#modalLomba{{ $item->id_lomba }}">
                                    <div class="portfolio-hover">
                                        <div class="portfolio-hover-content"><i class="fas fa-plus fa-2x"></i></div>
                                    </div>
                                    <img class="img-fluid" src="{{ asset('storage/foto_kegiatan/' . $item->foto_kegiatan) }}" alt="{{ $item->nama_kegiatan }}">
                                </a>
                                <div class="portfolio-caption">
                                    <div class="portfolio-caption-heading">{{ $item->nama_kegiatan }}</div>
                                    <div class="portfolio-caption-subheading text-muted">{{ $item->kejuaraan }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal detail -->
                        <div class="portfolio-modal modal fade" id="modalLomba{{ $item->id_lomba }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="close-modal" data-bs-dismiss="modal"><i class="fas fa-times"></i></div>
                                    <div class="modal-body">
                                        <h2 class="text-uppercase">{{ $item->nama_kegiatan }}</h2>
                                        <p class="item-intro text-muted">Kejuaraan: {{ $item->kejuaraan }}</p>
                                        <img class="img-fluid d-block mx-auto" src="{{ asset('storage/foto_kegiatan/' . $item->foto_kegiatan) }}" alt="{{ $item->nama_kegiatan }}">
                                        <p>Lokasi: {{ $item->lokasi }}</p>
                                        <p>Ekstrakurikuler: {{ $item->nama_ekskul }}</p>
                                        <p>Peserta: {{ $item->nama_siswa }}</p>
                                        <p>Tanggal: {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</p>
                                        <button class="btn btn-primary" data-bs-dismiss="modal" type="button">
                                            <i class="fas fa-times"></i>
                                            Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">Belum ada data lomba dengan foto kegiatan.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Kalender Kegiatan -->
        <section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Kalender Kegiatan</h2>
                    <h3 class="section-subheading text-muted">Kegiatan Ekstrakurikuler SMANJA</h3>
                </div>
                <div class="row justify-content-center mb-3">
                    <div class="col-md-2">
                        <select id="yearSelect" class="form-control">
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025" selected>2025</option>
                            <option value="2026">2026</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select id="monthSelect" class="form-control">
                            <option value="0">Januari</option>
                            <option value="1">Februari</option>
                            <option value="2">Maret</option>
                            <option value="3">April</option>
                            <option value="4">Mei</option>
                            <option value="5">Juni</option>
                            <option value="6">Juli</option>
                            <option value="7">Agustus</option>
                            <option value="8">September</option>
                            <option value="9">Oktober</option>
                            <option value="10">November</option>
                            <option value="11">Desember</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select id="daySelect" class="form-control">
                            <!-- akan diisi otomatis -->
                        </select>
                    </div>
                </div>
                <div id="calendar"></div>
            </div>
        </section>

        <!-- FullCalendar CDN -->
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js"></script>

        <!-- FullCalendar Init Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    height: 600,
                    events: '/api/kegiatan' // sesuaikan dengan URL data kegiatanmu
                });

                calendar.render();

                // Inisialisasi dropdown tanggal
                function updateDayOptions(year, month) {
                    const daySelect = document.getElementById('daySelect');
                    daySelect.innerHTML = '';
                    const daysInMonth = new Date(year, parseInt(month) + 1, 0).getDate();
                    for (let i = 1; i <= daysInMonth; i++) {
                        const option = document.createElement('option');
                        option.value = i;
                        option.textContent = i;
                        daySelect.appendChild(option);
                    }
                }

                // Set default tanggal hari ini
                const today = new Date();
                updateDayOptions(today.getFullYear(), today.getMonth());
                document.getElementById('daySelect').value = today.getDate();

                // Saat salah satu dropdown berubah
                document.getElementById('yearSelect').addEventListener('change', navigateCalendar);
                document.getElementById('monthSelect').addEventListener('change', function () {
                    const year = document.getElementById('yearSelect').value;
                    const month = document.getElementById('monthSelect').value;
                    updateDayOptions(year, month);
                    navigateCalendar();
                });
                document.getElementById('daySelect').addEventListener('change', navigateCalendar);

                function navigateCalendar() {
                    const year = parseInt(document.getElementById('yearSelect').value);
                    const month = parseInt(document.getElementById('monthSelect').value);
                    const day = parseInt(document.getElementById('daySelect').value);
                    const selectedDate = new Date(year, month, day);
                    calendar.gotoDate(selectedDate);
                }
            });
        </script>


        <!-- Team-->
        <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Team</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet</h3>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/1.jpg" alt="..." />
                            <h4>Parveen Anand</h4>
                            <p class="text-muted">Lead Designer</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/2.jpg" alt="..." />
                            <h4>Diana Petersen</h4>
                            <p class="text-muted">Lead Marketer</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Diana Petersen Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Diana Petersen Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Diana Petersen LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/3.jpg" alt="..." />
                            <h4>Larry Parker</h4>
                            <p class="text-muted">Lead Developer</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center"><p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p></div>
                </div>
            </div>
        </section>
        <!-- Clients-->
        <div class="py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/microsoft.svg" alt="..." aria-label="Microsoft Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/google.svg" alt="..." aria-label="Google Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/facebook.svg" alt="..." aria-label="Facebook Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/ibm.svg" alt="..." aria-label="IBM Logo" /></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Contact Us</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <!-- * * * * * * * * * * * * * * *-->
                <!-- * * SB Forms Contact Form * *-->
                <!-- * * * * * * * * * * * * * * *-->
                <!-- This form is pre-integrated with SB Forms.-->
                <!-- To make this form functional, sign up at-->
                <!-- https://startbootstrap.com/solution/contact-forms-->
                <!-- to get an API token!-->
                <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <!-- Name input-->
                                <input class="form-control" id="name" type="text" placeholder="Your Name *" data-sb-validations="required" />
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                            <div class="form-group">
                                <!-- Email address input-->
                                <input class="form-control" id="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" />
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <div class="form-group mb-md-0">
                                <!-- Phone number input-->
                                <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" data-sb-validations="required" />
                                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <!-- Message input-->
                                <textarea class="form-control" id="message" placeholder="Your Message *" data-sb-validations="required"></textarea>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                            </div>
                        </div>
                    </div>
                    <!-- Submit success message-->
                    <!---->
                    <!-- This is what your users will see when the form-->
                    <!-- has successfully submitted-->
                    <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center text-white mb-3">
                            <div class="fw-bolder">Form submission successful!</div>
                            To activate this form, sign up at
                            <br />
                            <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                        </div>
                    </div>
                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                    <!-- Submit Button-->
                    <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase disabled" id="submitButton" type="submit">Send Message</button></div>
                </form>
            </div>
        </section>
        <!-- Footer-->

        <!-- Portfolio Modals-->
        <!-- Portfolio item 1 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">PELACAK</h2>
                                    <p class="item-intro text-muted">Pecinta Alam SMAN 1 Jalancagak</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/pelacak.jpg" alt="..." />
                                    <p>PELACAK (Pecinta Alam SMAN 1 Jalancagak) adalah ekstrakurikuler yang fokus pada kegiatan luar ruangan, pelestarian alam, dan pendidikan lingkungan. Program ini mencakup jelajah alam, pengamatan flora/fauna, pengelolaan sampah, serta kegiatan sosial untuk menjaga keseimbangan alam dan meningkatkan kesadaran lingkungan siswa. Selain itu, PELACAK juga menjalankan program PPL (Pelacak Peduli Lingkungan), yang berfokus pada kebersihan lingkungan dan pengelolaan sampah secara ramah lingkungan. Melalui program ini, siswa terlibat dalam kegiatan pembersihan, pemilahan sampah, dan kampanye peduli lingkungan untuk menciptakan lingkungan yang lebih bersih dan sehat. PELACAK juga mengembangkan jiwa kepemimpinan, disiplin, dan tanggung jawab sosial siswa terhadap lingkungan.</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong></strong>
                                            
                                        </li>
                                        <li>
                                            <strong></strong>
                                            
                                        </li>
                                    </ul>
                                    <a href="{{ route('v_pendaftaran', ['ekskul' => 'PELACAK']) }}" class="btn btn-primary">
                                        Daftar
                                    </a>
                                                                                                         
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">PELACAK</h2>
                                    <p class="item-intro text-muted">Pecinta Alam SMAN 1 Jalancagak</p>
                                    <form action="{{ route('pendaftaran.store') }}" method="POST">
                                        @csrf
                                        <input type="text" name="nama" placeholder="Nama Lengkap" required>
                                        <input type="text" name="nis" placeholder="NIS" required>
                                        <input type="text" name="kelas" placeholder="Kelas" required>
                                        <input type="date" name="tgl_lahir" required>
                                        
                                        <select name="jenis_kelamin" required>
                                          <option value="Laki-laki">Laki-laki</option>
                                          <option value="Perempuan">Perempuan</option>
                                        </select>
                                      
                                        <textarea name="alamat" placeholder="Alamat Lengkap" required></textarea>
                                        
                                        <input type="hidden" name="ekskul" id="inputEkskul">
                                      
                                        <button type="submit">Kirim</button>
                                      </form>
                                      
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Portfolio item 2 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Marching Band</h2>
                                    <p class="item-intro text-muted">Marching Band King Java SMANJA</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/kingjava.jpg" alt="..." />
                                    <p>Marching Band KING JAVA adalah ekstrakurikuler musik yang mengembangkan kemampuan siswa dalam memainkan alat musik tiup dan perkusi secara kolaboratif. Kegiatan mencakup latihan rutin, display, lomba marching band, dan tampil dalam upacara atau acara resmi sekolah. KING JAVA menanamkan kedisiplinan, kekompakan, serta jiwa seni dan sportifitas dalam diri anggotanya.</p>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        Daftar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 3 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">VBC</h2>
                                    <p class="item-intro text-muted">VolleyBall Club SMANJA</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/volly.jpg" alt="..." />
                                    <p>Volly SMANJA adalah ekstrakurikuler yang fokus pada olahraga bola voli untuk meningkatkan kebugaran, kerja sama tim, dan sportivitas siswa. Kegiatan mencakup latihan rutin, sparing antarsekolah, dan turnamen yang mendukung pengembangan potensi atletik siswa.</p>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        Daftar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 4 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">FPSH & HAM</h2>
                                    <p class="item-intro text-muted">Forum Pelajar Sadar Hukum & Hak Asasi Manusia</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/4.jpg" alt="..." />
                                    <p>FPSH & HAM adalah ekstrakurikuler yang bertujuan meningkatkan kesadaran hukum dan HAM di kalangan pelajar. Kegiatan mencakup diskusi, seminar, simulasi sidang, dan kampanye hukum di lingkungan sekolah. FPSH & HAM membentuk pelajar yang kritis, peduli, dan mampu memahami serta menegakkan nilai-nilai keadilan dan kemanusiaan.</p>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        Daftar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 5 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">MKS</h2>
                                    <p class="item-intro text-muted">Media Komunikasi Siswa - Mading</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/5.jpg" alt="..." />
                                    <p>MKS adalah ekstrakurikuler yang fokus pada dunia jurnalistik dan kepenulisan. Siswa dilatih menulis berita, artikel, cerpen, hingga desain grafis untuk media mading sekolah. Kegiatan ini melatih kreativitas, keterampilan komunikasi, serta menumbuhkan semangat literasi di lingkungan sekolah.</p>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        Daftar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 6 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">PASKARJAGA</h2>
                                    <p class="item-intro text-muted">Paguyuban Seni Karawitan SMAN 1 Jalancagak</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/paskarjaga.jpg" alt="..." />
                                    <p>PASKARJAGA adalah ekstrakurikuler yang melestarikan seni karawitan Sunda melalui pelatihan gamelan dan nyanyian tradisional. Kegiatan ini mengasah sensitivitas seni, pemahaman budaya lokal, serta keterampilan tampil di berbagai acara budaya, sekaligus menanamkan rasa cinta terhadap warisan budaya bangsa.</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Client:</strong>
                                            Window
                                        </li>
                                        <li>
                                            <strong>Category:</strong>
                                            Photography
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pendaftaran Pop Up-->
            
        </div>
@endsection
