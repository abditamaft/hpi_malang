@php $item = $item ?? null; @endphp

@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        <ul class="list-disc list-inside text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-data="{ tipe: '{{ old('tipe', $item?->tipe ?? 'berita') }}' }">

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Tipe Konten</label>
        <select name="tipe" required x-model="tipe" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
            <option value="berita" {{ old('tipe', $item?->tipe ?? 'berita') === 'berita' ? 'selected' : '' }}>Berita</option>
            <option value="kegiatan" {{ old('tipe', $item?->tipe) === 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal</label>
        <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan', $item?->tanggal_kegiatan?->format('Y-m-d')) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Judul (Indonesia)</label>
        <input type="text" name="judul_id" required value="{{ old('judul_id', $item?->judul_id) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Judul (English)</label>
        <input type="text" name="judul_en" required value="{{ old('judul_en', $item?->judul_en) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori (Indonesia)</label>
        <input type="text" name="kategori_id" placeholder="Internal / Kemitraan / Layanan" value="{{ old('kategori_id', $item?->kategori_id) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori (English)</label>
        <input type="text" name="kategori_en" value="{{ old('kategori_en', $item?->kategori_en) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-gray-700 mb-1">Lokasi Kegiatan</label>
        <input type="text" name="lokasi_kegiatan"
                :disabled="tipe !== 'kegiatan'"
                x-bind:class="tipe !== 'kegiatan' ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white'"
                placeholder="Hanya diisi jika tipe = Kegiatan"
                value="{{ old('lokasi_kegiatan', $item?->lokasi_kegiatan) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
        <p class="text-xs text-gray-400 mt-1" x-show="tipe !== 'kegiatan'" x-cloak>
            Field ini otomatis nonaktif karena tipe konten adalah Berita.
        </p>
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Singkat (Indonesia)</label>
        <textarea name="deskripsi_singkat_id" rows="2" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">{{ old('deskripsi_singkat_id', $item?->deskripsi_singkat_id) }}</textarea>
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Singkat (English)</label>
        <textarea name="deskripsi_singkat_en" rows="2" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">{{ old('deskripsi_singkat_en', $item?->deskripsi_singkat_en) }}</textarea>
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-gray-700 mb-1">Isi Lengkap (Indonesia)</label>
        <textarea id="isi_id" name="isi_id" rows="8" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">{{ old('isi_id', $item?->isi_id) }}</textarea>
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-gray-700 mb-1">Isi Lengkap (English)</label>
        <textarea id="isi_en" name="isi_en" rows="8" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">{{ old('isi_en', $item?->isi_en) }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Gambar</label>
        <input type="file" name="url_gambar" accept="image/*" class="w-full text-sm">
        @if($item?->url_gambar)
            <img src="{{ asset('storage/' . $item->url_gambar) }}" class="h-20 mt-2 rounded shadow">
        @endif
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">URL Sumber (opsional)</label>
        <input type="url" name="url_sumber" value="{{ old('url_sumber', $item?->url_sumber) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
    </div>

    <div class="md:col-span-2 flex items-center gap-2">
        <input type="checkbox" name="status" id="status" value="1" {{ old('status', $item?->status ?? true) ? 'checked' : '' }}
                class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
        <label for="status" class="text-sm font-semibold text-gray-700">Terbitkan (tampil di halaman publik)</label>
    </div>

</div>

<div class="mt-8 flex gap-3">
    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-6 rounded">
        Simpan
    </button>
    <a href="{{ route('admin.berita.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2 px-6 rounded">
        Batal
    </a>
</div>

@once
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

    <style>
        .ck-editor__editable_inline {
            min-height: 320px;
        }
        .ck-content ul {
            list-style-type: disc;
            padding-left: 1.5rem;
            margin: 0.75rem 0;
        }
        .ck-content ol {
            list-style-type: decimal;
            padding-left: 1.5rem;
            margin: 0.75rem 0;
        }
        .ck-content ul ul {
            list-style-type: circle;
        }
        .ck-content ol ol {
            list-style-type: lower-alpha;
        }
        .ck-content li {
            margin-bottom: 0.35rem;
        }
        .ck-content blockquote {
            border-left: 4px solid #10b981; 
            background-color: #f0fdf4;      
            padding: 0.75rem 1rem;
            margin: 1rem 0;
            font-style: italic;
            color: #475569;                
            border-radius: 0 0.375rem 0.375rem 0;
        }
    </style>
@endonce

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editorFields = ['isi_id', 'isi_en'];
        const editorInstances = {};

        editorFields.forEach(function (fieldId) {
            const el = document.getElementById(fieldId);
            if (!el) return;

            ClassicEditor
                .create(el, {
                    toolbar: [
                        'heading', '|',
                        'bold', 'italic', 'link', '|',
                        'bulletedList', 'numberedList', 'blockQuote', '|',
                        'undo', 'redo'
                    ]
                })
                .then(function (editor) {
                    editorInstances[fieldId] = editor;
                })
                .catch(function (error) {
                    console.error('Gagal memuat editor:', fieldId, error);
                });
        });
        const form = document.getElementById('isi_id')?.closest('form');
        if (form) {
            form.addEventListener('submit', function () {
                Object.values(editorInstances).forEach(function (editor) {
                    editor.updateSourceElement();
                });
            });
        }
    });
</script>
