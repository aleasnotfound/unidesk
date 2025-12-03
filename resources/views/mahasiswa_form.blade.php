<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniDesk - Layanan Mahasiswa</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            /* LIGHT MODE */
            --bg-body: #FAFAFA;
            --bg-card: #FFFFFF;
            --border-color: #E5E5E5;
            
            --text-main: #171717;
            --text-sub: #737373;
            --text-on-primary: #FFFFFF;
            
            --primary: #4F46E5;
            --primary-soft: #EEF2FF;
            
            --input-bg: #FFFFFF;
            --input-border: #D4D4D4;
            --input-focus: #4F46E5;


            --avatar-bg: #4F46E5;
            --avatar-text: #FFFFFF;
        }

        [data-theme="dark"] {
            /* DARK MODE */
            --bg-body: #0a0a0a;
            --bg-card: #171717;
            --border-color: #262626;
            
            --text-main: #FAFAFA;
            --text-sub: #A3A3A3;
            --text-on-primary: #0a0a0a;
            
            --primary: #818CF8;
            --primary-soft: #1e1b4b;
            
            --input-bg: #0a0a0a;
            --input-border: #404040;
            --input-focus: #818CF8;

            --avatar-bg: #A5B4FC; 
            --avatar-text: #000000;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            transition: background-color 0.3s;
            min-height: 100vh;
            padding-bottom: 60px;
        }

        .modern-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }


        .form-control {
            background-color: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 10px;
            padding: 12px 16px;
            color: var(--text-main);
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        .form-control:focus {
            background-color: var(--input-bg);
            border-color: var(--input-focus);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
            color: var(--text-main);
        }
        .form-control::placeholder { color: var(--text-sub); opacity: 0.6; }

        /* Buttons */
        .btn-primary-modern {
            background-color: var(--primary); color: #fff;
            border: none; border-radius: 10px; padding: 12px 24px; font-weight: 600; width: 100%; transition: all 0.2s;
        }
        .btn-primary-modern:hover { opacity: 0.9; transform: translateY(-1px); color: #fff; }
        [data-theme="dark"] .btn-primary-modern { color: #000; font-weight: 700; }

        /* Custom Upload btn */
        .custom-file-container {
            background-color: var(--bg-body);
            border: 1px dashed var(--border-color);
            border-radius: 10px; padding: 10px;
            display: flex; align-items: center; gap: 12px;
        }
        .btn-tonal {
            background-color: var(--bg-card); color: var(--text-main);
            border: 1px solid var(--border-color); border-radius: 8px; 
            padding: 8px 16px; font-weight: 600; font-size: 0.85rem; cursor: pointer; transition: 0.2s;
        }
        .btn-tonal:hover { border-color: var(--primary); color: var(--primary); }

        /* Beranda Laporan */
        .feed-item { padding: 20px 0; border-bottom: 1px solid var(--border-color); }
        .feed-item:last-child { border-bottom: none; }
        
        .header-badge {
            background: var(--bg-card); border: 1px solid var(--border-color); color: var(--text-main);
            padding: 6px 16px; border-radius: 50px; font-weight: 600; font-size: 0.75rem;
            letter-spacing: 0.5px; text-transform: uppercase;
        }

        /* Nav */
        .top-nav { position: fixed; top: 24px; right: 24px; z-index: 100; display: flex; gap: 12px; }
        .btn-nav {
            background: var(--bg-card); color: var(--text-main);
            border: 1px solid var(--border-color); border-radius: 50px;
            padding: 10px 20px; text-decoration: none; font-weight: 600; display: flex; align-items: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); transition: 0.2s;
        }
        .btn-nav:hover { border-color: var(--primary); color: var(--primary); }
        .btn-nav-icon { width: 44px; height: 44px; padding: 0; justify-content: center; }

        /* STATUS */
        .badge-m3 { padding: 6px 10px; border-radius: 6px; font-weight: 600; font-size: 0.7rem; border: 1px solid transparent; }
        
        /* Warna Light Mode */
        .st-baru { background: #E0E7FF; color: #3730A3; border-color: #C7D2FE; } /* Indigo */
        .st-diproses { background: #FEF3C7; color: #92400E; border-color: #FDE68A; } /* Amber */
        .st-menunggu { background: #FEE2E2; color: #991B1B; border-color: #FECACA; } /* Red */
        .st-selesai { background: #DCFCE7; color: #166534; border-color: #BBF7D0; } /* Green */
        
        /* Warna Dark Mode */
        [data-theme="dark"] .st-baru { background: #312E81; color: #E0E7FF; border-color: #3730A3; }
        [data-theme="dark"] .st-diproses { background: #78350F; color: #FEF3C7; border-color: #92400E; }
        [data-theme="dark"] .st-menunggu { background: #7F1D1D; color: #FEE2E2; border-color: #991B1B; }
        [data-theme="dark"] .st-selesai { background: #14532D; color: #DCFCE7; border-color: #166534; }

        .h-sticky { position: sticky; top: 24px; z-index: 10; }
        
        /* Notif Alert */
        .alert .btn-close { filter: none !important; opacity: 0.5; }
        .alert .btn-close:hover { opacity: 1; }
    </style>
</head>
<body>

    <div class="top-nav">
        <a href="{{ route('login') }}" class="btn-nav"><i class="bi bi-person-fill me-2"></i> Admin</a>
        <button class="btn-nav btn-nav-icon" onclick="toggleTheme()" title="Ganti Mode"><i class="bi bi-moon-stars-fill" id="themeIcon"></i></button>
    </div>

    <div class="container py-5">
        <div class="row mb-5 text-center">
            <div class="col-lg-8 mx-auto">
                <span class="header-badge mb-3 d-inline-block">Campus Service</span>
                
                <div class="d-flex align-items-center justify-content-center gap-3 mb-2">
                    <img src="{{ asset('img/logo.png') }}" 
                         alt="Logo" 
                         class="rounded-circle shadow-sm border" 
                         style="width: 55px; height: 55px; object-fit: cover; border-color: var(--border-color)!important;">
                    
                    <h1 class="display-5 fw-bold mb-0" style="color: var(--text-main);">UniDesk</h1>
                </div>
                <p class="lead" style="color: var(--text-sub);">Platform pelaporan fasilitas kampus.</p>
            </div>
        </div>

        @if(session('success'))
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto">
                <div class="alert alert-dismissible fade show border-0 rounded-3 shadow-sm d-flex align-items-center" 
                     style="background: #DCFCE7; color: #14532D;" role="alert">
                    <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                    <div class="flex-grow-1 fw-bold">{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        @endif

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="modern-card h-sticky">
                    <div class="d-flex align-items-center mb-4">
                        <div class="d-flex align-items-center justify-content-center rounded-3 me-3" 
                             style="width: 40px; height: 40px; background: var(--bg-body); color: var(--primary); border: 1px solid var(--border-color);">
                            <i class="bi bi-pencil-fill"></i>
                        </div>
                        <h5 class="fw-bold mb-0" style="color: var(--text-main);">Buat Laporan</h5>
                    </div>

                    <form action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-check form-switch mb-4 ps-5">
                            <input class="form-check-input" type="checkbox" id="anonimToggle" name="is_anonymous" value="1" style="transform: scale(1.3); margin-left: -2.8em;">
                            <label class="form-check-label fw-bold small pt-1 ms-1" style="color: var(--text-main);" for="anonimToggle">Mode Anonim</label>
                        </div>

                        <div id="identitasSection">
                            <div class="mb-3">
                                <label class="small fw-bold mb-1" style="color: var(--text-sub);">IDENTITAS</label>
                                <input type="text" name="nama_mahasiswa" class="form-control mb-2" placeholder="Nama Lengkap">
                                <input type="text" name="nim" class="form-control" placeholder="Nomor Induk (NIM)">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small fw-bold mb-1" style="color: var(--text-sub);">DETAIL</label>
                            <input type="text" name="jurusan" class="form-control mb-2" required placeholder="Jurusan / Prodi">
                            <input type="text" name="fasilitas" class="form-control" required placeholder="Fasilitas & Lokasi (Cth: Meja Lab 1)">
                        </div>

                        <div class="mb-4">
                            <textarea name="keluhan" class="form-control" rows="4" required placeholder="Deskripsikan masalah..."></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="small fw-bold mb-2 d-block" style="color: var(--text-sub);">BUKTI FOTO</label>
                            <div class="custom-file-container">
                                <label for="fotoInput" class="btn-tonal"><i class="bi bi-image"></i> Pilih</label>
                                <span id="fileNameDisplay" class="small text-truncate" style="color: var(--text-sub);">Tidak ada file</span>
                                <input type="file" name="foto" id="fotoInput" class="d-none" accept="image/*">
                            </div>
                        </div>

                        <button type="submit" class="btn-primary-modern">Kirim Laporan</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="modern-card h-100">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-3" style="border-bottom: 1px solid var(--border-color);">
                        <h5 class="fw-bold mb-0" style="color: var(--text-main);">Beranda Laporan</h5>
                        <span class="badge rounded-pill bg-danger bg-opacity-10 text-danger border border-danger px-2 py-1 small">
                             Live
                        </span>
                    </div>

                    @if($reports->isEmpty())
                        <div class="text-center py-5" style="color: var(--text-sub);">Belum ada laporan masuk.</div>
                    @else
                        @foreach($reports as $rpt)
                        <div class="feed-item">
                            <div class="d-flex gap-3">
                                <div class="rounded-3 d-flex align-items-center justify-content-center fw-bold flex-shrink-0" 
                                     style="width: 42px; height: 42px; background-color: {{ $rpt->is_anonymous ? '#525252' : 'var(--avatar-bg)' }}; color: {{ $rpt->is_anonymous ? '#fff' : 'var(--avatar-text)' }};">
                                    {{ $rpt->is_anonymous ? '?' : substr($rpt->nama_mahasiswa, 0, 1) }}
                                </div>
                                
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <div>
                                            <span class="fw-bold d-block" style="color: var(--text-main);">{{ $rpt->is_anonymous ? 'Anonim' : $rpt->nama_mahasiswa }}</span>
                                            <span class="small" style="color: var(--text-sub);">{{ $rpt->jurusan }}</span>
                                        </div>
                                        <span class="badge-m3 st-{{ strtolower($rpt->status) }}">{{ $rpt->status }}</span>
                                    </div>
                                    
                                    <div class="mt-2">
                                        <div class="fw-bold small mb-1" style="color: var(--primary);">{{ $rpt->fasilitas }}</div>
                                        <p class="mb-2 small" style="color: var(--text-main); line-height: 1.5;">{{ $rpt->keluhan }}</p>
                                    </div>

                                    @if($rpt->foto)
                                    <div class="mb-2">
                                        <a href="{{ asset('storage/'.$rpt->foto) }}" target="_blank">
                                            <img src="{{ asset('storage/'.$rpt->foto) }}" class="rounded-3 border" style="height: 60px; border-color: var(--border-color)!important;">
                                        </a>
                                    </div>
                                    @endif
                                    
                                    <div class="small" style="color: var(--text-sub); font-size: 0.75rem;">
                                        @if($rpt->updated_at > $rpt->created_at)
                                            Diupdate {{ $rpt->updated_at->format('H:i') }}
                                        @else
                                            {{ $rpt->created_at->format('H:i') }}
                                        @endif
                                        <span class="mx-1">•</span> {{ $rpt->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="text-center mt-5 small" style="color: var(--text-sub); opacity: 0.7;">&copy; {{ date('Y') }} UniDesk Campus</div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $('#fotoInput').change(function() { $('#fileNameDisplay').text(this.files[0] ? this.files[0].name : 'Tidak ada file'); });
        $('#anonimToggle').change(function() {
            if($(this).is(':checked')) { $('#identitasSection').slideUp(); $('input[name="nama_mahasiswa"], input[name="nim"]').val('').removeAttr('required'); } 
            else { $('#identitasSection').slideDown(); $('input[name="nama_mahasiswa"], input[name="nim"]').attr('required', true); }
        });
        const themeIcon = document.getElementById('themeIcon');
        function setTheme(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
            themeIcon.className = theme === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-stars-fill';
        }
        setTheme(localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'));
        function toggleTheme() { setTheme(document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark'); }
        
        // Close Notif Alert
        $(document).ready(function() {
            if ($(".alert").length) { setTimeout(function() { $(".alert").fadeOut('slow'); }, 10000); }
            $('.btn-close').click(function() { $(this).closest('.alert').fadeOut('fast'); });
        });
    </script>
</body>
</html>