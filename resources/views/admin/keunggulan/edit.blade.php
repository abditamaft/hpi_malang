@extends('layouts.admin')

@section('title', 'Edit Keunggulan')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-lg font-bold text-gray-800 mb-6">Edit Keunggulan HPI</h2>

        <form action="{{ route('admin.keunggulan.update', $keunggulan->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Ikon Keunggulan</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-1">Pilih Ikon Cepat</label>
                        <select id="icon-picker" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                            <option value="">-- Pilih dari Daftar / Kustom --</option>
                            <option value="fa-solid fa-shield-halved">🛡️ Terverifikasi / Keamanan (Shield)</option>
                            <option value="fa-solid fa-clock-rotate-left">⏳ Berpengalaman / Waktu (Clock)</option>
                            <option value="fa-solid fa-language">🗣️ Multi Bahasa (Language)</option>
                            <option value="fa-solid fa-briefcase">💼 Profesional (Briefcase)</option>
                            <option value="fa-solid fa-compass">🧭 Penunjuk Arah / Pemandu (Compass)</option>
                            <option value="fa-solid fa-route">🗺️ Rute Wisata (Route)</option>
                            <option value="fa-solid fa-award">🏆 Sertifikat / Penghargaan (Award)</option>
                            <option value="fa-solid fa-user-check">👤 Anggota Terverifikasi (User Check)</option>
                            <option value="fa-solid fa-globe">🌐 Global / Internasional (Globe)</option>
                            <option value="fa-solid fa-heart">❤️ Melayani dengan Hati (Heart)</option>
                            <option value="fa-solid fa-star">⭐ Kualitas Bintang (Star)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-1">Kode Ikon / HTML</label>
                        <div class="flex gap-3 items-center">
                            <div id="icon-preview" class="w-12 h-12 bg-emerald-50 text-emerald-600 flex items-center justify-center rounded-xl text-2xl border border-emerald-100">
                                @if(str_starts_with(trim($keunggulan->ikon), '<'))
                                    {!! $keunggulan->ikon !!}
                                @else
                                    <i class="{{ trim($keunggulan->ikon) ?: 'fa-solid fa-question' }}"></i>
                                @endif
                            </div>
                            <input type="text" id="icon-input" name="ikon" value="{{ $keunggulan->ikon }}" class="flex-1 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" placeholder="Masukkan kode fa-ikon">
                        </div>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">Anda bisa memilih ikon dari daftar di sebelah kiri, atau mengetikkan langsung kode FontAwesome (misal: <code>fa-solid fa-shield-halved</code>) atau kode HTML ikon pada kolom input.</p>

                <!-- FontAwesome CSS link for previewing in admin page -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const picker = document.getElementById('icon-picker');
                        const input = document.getElementById('icon-input');
                        const preview = document.getElementById('icon-preview');

                        // Match current input with picker option
                        const currentValue = input.value.trim();
                        for (let option of picker.options) {
                            if (option.value === currentValue) {
                                picker.value = option.value;
                                break;
                            }
                        }

                        picker.addEventListener('change', function() {
                            if (this.value) {
                                input.value = this.value;
                                updatePreview(this.value);
                            }
                        });

                        input.addEventListener('input', function() {
                            updatePreview(this.value);
                            // Deselect picker if custom value typed
                            let matched = false;
                            for (let option of picker.options) {
                                if (option.value === this.value.trim()) {
                                    picker.value = option.value;
                                    matched = true;
                                    break;
                                }
                            }
                            if (!matched) {
                                picker.value = "";
                            }
                        });

                        function updatePreview(val) {
                            val = val.trim();
                            if (val.startsWith('<')) {
                                preview.innerHTML = val;
                            } else if (val) {
                                let iconClass = val;
                                if (!iconClass.startsWith('fa')) {
                                    iconClass = 'fa-solid fa-' + iconClass;
                                } else if (!iconClass.includes(' ')) {
                                    iconClass = 'fa-solid ' + iconClass;
                                }
                                preview.innerHTML = `<i class="${iconClass}"></i>`;
                            } else {
                                preview.innerHTML = '<i class="fa-solid fa-question"></i>';
                            }
                        }
                    });
                </script>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul (Bahasa Indonesia)</label>
                    <input type="text" name="judul_id" value="{{ $keunggulan->judul_id }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul (English)</label>
                    <input type="text" name="judul_en" value="{{ $keunggulan->judul_en }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi (Bahasa Indonesia)</label>
                    <textarea name="deskripsi_id" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>{{ $keunggulan->deskripsi_id }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi (English)</label>
                    <textarea name="deskripsi_en" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>{{ $keunggulan->deskripsi_en }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.keunggulan.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2.5 px-6 rounded-xl transition">Batal</a>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 px-6 rounded-xl transition">Update Data</button>
            </div>
        </form>
    </div>
</div>
@endsection