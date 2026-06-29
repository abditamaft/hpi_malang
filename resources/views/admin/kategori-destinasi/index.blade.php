@extends('layouts.admin')

@section('title', 'Kategori Destinasi')

@section('content')
<div class="bg-white shadow rounded-lg p-6">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Kategori Destinasi</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola kategori wisata yang tersedia untuk destinasi.</p>
        </div>
        <button onclick="openModal('add')"
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Kategori
        </button>
    </div>

    {{-- Alert --}}
    <div id="alert-box" class="hidden mb-4"></div>

    {{-- Tabel --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse" id="tabel-kategori">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-xs leading-normal">
                    <th class="py-3 px-4 border-b">#</th>
                    <th class="py-3 px-4 border-b">Nama Kategori (ID)</th>
                    <th class="py-3 px-4 border-b">Category Name (EN)</th>
                    <th class="py-3 px-4 border-b text-center">Jumlah Destinasi</th>
                    <th class="py-3 px-4 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm" id="tbody-kategori">
                @forelse($kategori as $i => $kat)
                <tr class="border-b border-gray-200 hover:bg-gray-50" id="row-{{ $loop->index }}">
                    <td class="py-3 px-4 text-gray-400 text-xs">{{ $loop->iteration }}</td>
                    <td class="py-3 px-4 font-semibold text-gray-800">{{ $kat->kategori_id }}</td>
                    <td class="py-3 px-4 text-gray-500">{{ $kat->kategori_en }}</td>
                    <td class="py-3 px-4 text-center">
                        @php
                            $jumlah = \DB::table('destinasi')
                                ->where('kategori_id', $kat->kategori_id)
                                ->where('nama_destinasi_id', '!=', '__kategori_placeholder__')
                                ->count();
                        @endphp
                        @if($jumlah > 0)
                            <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                                {{ $jumlah }} destinasi
                            </span>
                        @else
                            <span class="bg-gray-100 text-gray-400 text-xs px-3 py-1 rounded-full">
                                Belum ada
                            </span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-center">
                        <div class="flex items-center justify-center gap-3">
                            <button onclick="openModal('edit', '{{ addslashes($kat->kategori_id) }}', '{{ addslashes($kat->kategori_en) }}')"
                                class="text-blue-500 hover:text-blue-700 font-medium text-sm">
                                Edit
                            </button>
                            <button onclick="hapusKategori('{{ addslashes($kat->kategori_id) }}')"
                                class="text-red-500 hover:text-red-700 font-medium text-sm">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr id="row-empty">
                    <td colspan="5" class="py-10 text-center text-gray-400">
                        Belum ada kategori. Tambahkan kategori pertama Anda.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Info --}}
    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg text-sm text-blue-700">
        <strong>ℹ️ Informasi:</strong><br>
        • Kategori diambil langsung dari data destinasi yang sudah ada.<br>
        • Mengedit nama kategori akan <strong>mengubah semua destinasi</strong> yang memakai kategori tersebut.<br>
        • Menghapus kategori yang masih digunakan destinasi <strong>tidak akan menghapus destinasi tersebut</strong>.
    </div>
</div>

{{-- ============================================================ --}}
{{-- MODAL TAMBAH / EDIT                                          --}}
{{-- ============================================================ --}}
<div id="modal-backdrop"
    class="fixed inset-0 bg-black/50 z-40 hidden flex items-center justify-center"
    onclick="closeModalIfBackdrop(event)">

    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 z-50 relative">
        <div class="p-6 border-b flex items-center justify-between">
            <h3 class="text-lg font-bold text-gray-800" id="modal-title">Tambah Kategori</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="p-6 space-y-4">
            <div id="modal-error" class="hidden bg-red-100 border border-red-300 text-red-700 text-sm px-4 py-2 rounded"></div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Kategori <span class="text-gray-400">(Bahasa Indonesia)</span>
                </label>
                <input type="text" id="input-kategori-id" placeholder="contoh: Gunung, Pantai, Budaya..."
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Category Name <span class="text-gray-400">(English)</span>
                </label>
                <input type="text" id="input-kategori-en" placeholder="e.g. Mountain, Beach, Culture..."
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>
        </div>

        <div class="px-6 pb-6 flex justify-end gap-3">
            <button onclick="closeModal()"
                class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800 font-medium">
                Batal
            </button>
            <button id="btn-simpan" onclick="simpanKategori()"
                class="px-5 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition-colors">
                Simpan
            </button>
        </div>
    </div>
</div>

<script>
    let currentMode   = 'add';
    let currentLamaId = '';

    // ── Buka modal ──────────────────────────────────────────────
    function openModal(mode, lamaId = '', lamaEn = '') {
        currentMode   = mode;
        currentLamaId = lamaId;

        document.getElementById('input-kategori-id').value = lamaId;
        document.getElementById('input-kategori-en').value = lamaEn;
        document.getElementById('modal-title').textContent  = mode === 'add' ? 'Tambah Kategori' : 'Edit Kategori';
        document.getElementById('modal-error').classList.add('hidden');
        document.getElementById('modal-backdrop').classList.remove('hidden');
        document.getElementById('input-kategori-id').focus();
    }

    // ── Tutup modal ─────────────────────────────────────────────
    function closeModal() {
        document.getElementById('modal-backdrop').classList.add('hidden');
    }
    function closeModalIfBackdrop(e) {
        if (e.target === document.getElementById('modal-backdrop')) closeModal();
    }

    // ── Tampilkan alert ─────────────────────────────────────────
    function showAlert(msg, type = 'success') {
        const box = document.getElementById('alert-box');
        const colors = type === 'success'
            ? 'bg-green-100 border border-green-400 text-green-700'
            : 'bg-red-100 border border-red-400 text-red-700';
        box.className = `mb-4 px-4 py-3 rounded ${colors}`;
        box.textContent = msg;
        box.classList.remove('hidden');
        setTimeout(() => box.classList.add('hidden'), 4000);
    }

    // ── CSRF token ──────────────────────────────────────────────
    function getCsrf() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    // ── Simpan (tambah / edit) ──────────────────────────────────
    async function simpanKategori() {
        const namaId = document.getElementById('input-kategori-id').value.trim();
        const namaEn = document.getElementById('input-kategori-en').value.trim();
        const errBox = document.getElementById('modal-error');

        if (!namaId || !namaEn) {
            errBox.textContent = 'Nama kategori (ID) dan (EN) wajib diisi.';
            errBox.classList.remove('hidden');
            return;
        }
        errBox.classList.add('hidden');

        const btn = document.getElementById('btn-simpan');
        btn.disabled = true;
        btn.textContent = 'Menyimpan...';

        try {
            let url, method;
            if (currentMode === 'add') {
                url    = '{{ route("admin.kategori-destinasi.store") }}';
                method = 'POST';
            } else {
                url    = `/admin/kategori-destinasi/${encodeURIComponent(currentLamaId)}`;
                method = 'POST'; // via _method PUT
            }

            const formData = new FormData();
            formData.append('_token', getCsrf());
            if (currentMode === 'edit') formData.append('_method', 'PUT');
            formData.append('kategori_id', namaId);
            formData.append('kategori_en', namaEn);

            const res  = await fetch(url, { method: 'POST', body: formData });
            const data = await res.json();

            if (!res.ok) {
                errBox.textContent = data.error || 'Terjadi kesalahan.';
                errBox.classList.remove('hidden');
                return;
            }

            closeModal();
            showAlert(currentMode === 'add' ? 'Kategori berhasil ditambahkan!' : 'Kategori berhasil diperbarui!');
            setTimeout(() => location.reload(), 800);

        } catch (e) {
            errBox.textContent = 'Gagal menghubungi server.';
            errBox.classList.remove('hidden');
        } finally {
            btn.disabled = false;
            btn.textContent = 'Simpan';
        }
    }

    // ── Hapus kategori ──────────────────────────────────────────
    async function hapusKategori(namaId) {
        if (!confirm(`Yakin ingin menghapus kategori "${namaId}"?\n\nDestinasi yang sudah menggunakan kategori ini tidak akan terhapus.`)) return;

        try {
            const res  = await fetch(`/admin/kategori-destinasi/${encodeURIComponent(namaId)}`, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                body: (() => {
                    const f = new FormData();
                    f.append('_token', getCsrf());
                    f.append('_method', 'DELETE');
                    return f;
                })(),
            });
            const data = await res.json();

            if (data.success) {
                showAlert(data.warning || 'Kategori berhasil dihapus.');
                setTimeout(() => location.reload(), 800);
            }
        } catch (e) {
            showAlert('Gagal menghapus kategori.', 'error');
        }
    }

    // Enter = simpan
    document.addEventListener('keydown', e => {
        if (e.key === 'Enter' && !document.getElementById('modal-backdrop').classList.contains('hidden')) {
            simpanKategori();
        }
        if (e.key === 'Escape') closeModal();
    });
</script>
@endsection
