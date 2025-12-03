<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            /* Light */
            --bg-app: #FDFBFF; --bg-surface: #FFFFFF; --bg-input: #F0F2F5;
            --text-main: #1A1C1E; --text-sub: #43474E;
            --color-primary: #4355B9; --color-outline: #74777F;
            
            --table-head: #F0F4FA;
            --table-border: #E0E2E5;
        }
        [data-theme="dark"] {
            /* Dark */
            --bg-app: #0a0a0a; --bg-surface: #171717; --bg-input: #0a0a0a;
            --text-main: #FAFAFA; --text-sub: #A3A3A3;
            --color-primary: #818CF8; --color-outline: #262626;
            
            --table-head: #171717;
            --table-border: #262626;
        }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--bg-app); 
            color: var(--text-main); 
            transition: 0.3s; 
            min-height: 100vh;
            padding-bottom: 80px;
        }

        /* Navbar */
        .m3-navbar {
            background-color: var(--bg-surface); border-radius: 100px; margin: 20px auto; padding: 12px 30px;
            max-width: 1200px; border: 1px solid var(--color-outline);
        }
        [data-theme="dark"] .m3-navbar { border-color: #333; }

        .m3-card {
            background-color: var(--bg-surface); border-radius: 24px;
            border: 1px solid var(--color-outline); overflow: hidden;
        }
        [data-theme="dark"] .m3-card { border-color: #333; }

        /* Warna Tabel */
        .table { --bs-table-bg: transparent; --bs-table-color: var(--text-main); border-color: var(--table-border); margin-bottom: 0; }
        .table thead th { 
            background-color: var(--table-head); color: var(--text-sub); 
            text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px; padding: 16px; border-bottom: none;
        }
        .table tbody td { padding: 16px; vertical-align: middle; border-bottom: 1px solid var(--table-border); color: var(--text-main); }

        /* Buttons */
        .btn-pill { border-radius: 50px; padding: 6px 16px; font-weight: 600; font-size: 0.85rem; }
        
        /* Warna Teks */
        .text-main { color: var(--text-main) !important; }
        .text-sub { color: var(--text-sub) !important; }
        .text-primary-theme { color: var(--color-primary) !important; }

        /* Modals/Popup Konfirmasi */
        .modal-content { background-color: var(--bg-surface); color: var(--text-main); border-radius: 24px; }
        .form-select { background-color: var(--bg-input); color: var(--text-main); border: 1px solid var(--color-outline); border-radius: 12px; }

        /* Warna Status */
        .badge-chip { padding: 6px 12px; border-radius: 50px; font-weight: 600; font-size: 0.75rem; border: 1px solid transparent; }
        
        .st-baru { background: #E0E7FF; color: #3730A3; border-color: #C7D2FE; } /* Indigo */
        .st-diproses { background: #FEF3C7; color: #92400E; border-color: #FDE68A; } /* Amber */
        .st-menunggu { background: #FEE2E2; color: #991B1B; border-color: #FECACA; } /* Red */
        .st-selesai { background: #DCFCE7; color: #166534; border-color: #BBF7D0; } /* Green */
        
        [data-theme="dark"] .st-baru { background: #312E81; color: #E0E7FF; border-color: #3730A3; }
        [data-theme="dark"] .st-diproses { background: #78350F; color: #FEF3C7; border-color: #92400E; }
        [data-theme="dark"] .st-menunggu { background: #7F1D1D; color: #FEE2E2; border-color: #991B1B; }
        [data-theme="dark"] .st-selesai { background: #14532D; color: #DCFCE7; border-color: #166534; }

        /* Alert */
        .alert .btn-close { filter: none !important; opacity: 0.5; } .alert .btn-close:hover { opacity: 1; }

        /* Card Stats */
        .stat-card {
            background: var(--bg-input); 
            border: 1px solid var(--color-outline);
            min-width: 280px;
        }

        /* RESPONSIVITAS */
        @media (max-width: 768px) {
            .m3-navbar {
                margin: 10px;
                padding: 16px;
                flex-direction: column;
                border-radius: 24px;
                gap: 12px;
            }
            .m3-navbar .ms-auto {
                width: 100%;
                justify-content: space-between;
            }
            
            /* card total laporan di HP */
            .stat-card {
                width: 100%;
                min-width: auto;
                text-align: center !important;
            }
            
            /* header teks rata kiri di HP */
            .col-md-8 {
                margin-bottom: 1rem;
            }

        }
    </style>
</head>
<body>

    <div class="container px-4">
        <nav class="navbar navbar-expand m3-navbar">
            
            <a class="navbar-brand fw-bold text-main d-flex align-items-center gap-2" href="#">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="rounded-circle shadow-sm border" 
                     style="width: 40px; height: 40px; object-fit: cover; border-color: var(--color-outline)!important;">
                UniDesk Admin
            </a>

            <div class="ms-auto d-flex align-items-center gap-2">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-secondary btn-pill border-0 text-sub">Lihat Web</a>
                <button class="btn border-0 text-sub" onclick="toggleTheme()"><i class="bi bi-moon-stars-fill" id="themeIcon"></i></button>
                <div class="vr mx-2"></div>
                <form action="{{ route('logout') }}" method="POST">@csrf <button class="btn btn-danger btn-pill">Logout</button></form>
            </div>
        </nav>

        <div class="row align-items-end mb-4 px-2">
            <div class="col-md-8">
                <h2 class="fw-bold mb-1 text-main">Dashboard</h2>
                <p class="text-sub mb-0">Manajemen laporan mahasiswa.</p>
            </div>
            
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <div class="d-inline-block px-5 py-4 rounded-4 text-start shadow-sm stat-card">
                    <small class="fw-bold text-primary-theme d-block mb-1" style="letter-spacing: 1px; font-size: 0.8rem;">TOTAL LAPORAN</small>
                    <div class="display-5 fw-bold text-main" style="line-height: 1;">{{ $reports->count() }}</div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-dismissible fade show border-0 rounded-4 mb-4 d-flex align-items-center" 
                 style="background: #DCFCE7; color: #14532D;" role="alert">
                <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                <div class="flex-grow-1 fw-bold">{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="m3-card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead><tr><th class="ps-4">No</th><th>Mahasiswa</th><th>Laporan</th><th>Foto</th><th>Status</th><th class="text-end pe-4">Aksi</th></tr></thead>
                    <tbody>
                        @forelse($reports as $idx => $rpt)
                        <tr>
                            <td class="ps-4 text-sub">{{ $idx+1 }}</td>
                            <td>
                                <div class="fw-bold text-main">{{ $rpt->is_anonymous ? 'Anonim' : $rpt->nama_mahasiswa }}</div>
                                @if(!$rpt->is_anonymous)<div class="small text-sub">{{ $rpt->nim }}</div>@endif
                            </td>
                            <td style="max-width:300px">
                                <div class="fw-bold text-primary-theme small">{{ $rpt->fasilitas }}</div>
                                <div class="text-truncate small text-sub">{{ $rpt->keluhan }}</div>
                            </td>
                            <td>
                                @if($rpt->foto) <a href="{{ asset('storage/'.$rpt->foto) }}" target="_blank"><img src="{{ asset('storage/'.$rpt->foto) }}" class="rounded-3 border" style="width:40px; height:40px; object-fit:cover;"></a>
                                @else <span class="badge bg-secondary opacity-25 text-dark">No</span> @endif
                            </td>
                            <td>
                                <span class="badge-chip st-{{ strtolower($rpt->status) }}">{{ $rpt->status }}</span>
                                <div class="mt-1 small text-sub" style="font-size: 0.7rem">
                                    {{ $rpt->updated_at > $rpt->created_at ? 'Update: '.$rpt->updated_at->format('H:i') : 'Buat: '.$rpt->created_at->format('H:i') }}
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <button class="btn btn-sm btn-outline-primary border-0 rounded-circle" style="width:32px;height:32px" onclick="$('#formStatus').attr('action', '/admin/laporan/{{$rpt->id}}'); $('#statusSelect').val('{{$rpt->status}}'); new bootstrap.Modal('#modalStatus').show()"><i class="bi bi-pencil-fill"></i></button>
                                <button class="btn btn-sm btn-outline-danger border-0 rounded-circle" style="width:32px;height:32px" onclick="$('#formDelete').attr('action', '/admin/laporan/{{$rpt->id}}'); new bootstrap.Modal('#modalDelete').show()"><i class="bi bi-trash-fill"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center py-5 text-sub">Data kosong.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="text-center mt-5 text-sub small opacity-75">
            &copy; {{ date('Y') }} UniDesk Admin Console
        </div>
    </div>

    <!-- Modals/Popup Konfirmasi -->
    <div class="modal fade" id="modalStatus" tabindex="-1"><div class="modal-dialog modal-sm modal-dialog-centered"><div class="modal-content p-3"><form id="formStatus" method="POST">@csrf @method('PUT')<h6 class="fw-bold mb-3">Update Status</h6><select name="status" id="statusSelect" class="form-select mb-3"><option value="Baru">Baru</option><option value="Diproses">Diproses</option><option value="Menunggu">Menunggu</option><option value="Selesai">Selesai</option></select><div class="text-end"><button type="button" class="btn btn-sm btn-link text-decoration-none text-secondary me-2" data-bs-dismiss="modal">Batal</button><button class="btn btn-sm btn-primary rounded-pill px-4 fw-bold">Simpan</button></div></form></div></div></div>
    
    <div class="modal fade" id="modalDelete" tabindex="-1"><div class="modal-dialog modal-sm modal-dialog-centered"><div class="modal-content p-4 text-center"><i class="bi bi-exclamation-circle text-danger display-4 mb-2"></i><h5 class="fw-bold">Hapus?</h5><p class="small mb-4 text-sub">Apa Anda yakin ingin menghapus laporan? (Permanen).</p><div class="d-flex justify-content-center gap-2"><button type="button" class="btn btn-secondary btn-pill w-50" data-bs-dismiss="modal">Batal</button><form id="formDelete" method="POST" class="w-50">@csrf @method('DELETE')<button class="btn btn-danger rounded-pill w-100">Hapus</button></form></div></div></div></div></div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const themeIcon = document.getElementById('themeIcon');
        function setTheme(theme) { document.documentElement.setAttribute('data-theme', theme); localStorage.setItem('theme', theme); themeIcon.className = theme === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-stars-fill'; }
        setTheme(localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'));
        function toggleTheme() { setTheme(document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark'); }
        
        $(document).ready(function() { if ($(".alert").length) { setTimeout(function() { $(".alert").alert('close'); }, 10000); } });
    </script>
</body>
</html>