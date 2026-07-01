@php
    $locale = session('locale', 'id');
@endphp

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

<style>
    .reveal-on-scroll {
        opacity: 0;
        transform: translateY(40px);
        transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
    }
    .reveal-on-scroll.is-visible {
        opacity: 1;
        transform: translateY(0);
    }
    .delay-100 { transition-delay: 100ms; }
    .delay-200 { transition-delay: 200ms; }
    .delay-300 { transition-delay: 300ms; }
    .delay-400 { transition-delay: 400ms; }
</style>

<footer class="bg-[#EAEAEA] pt-20 pb-8 border-t border-gray-300 mt-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 lg:gap-8">
        
        <div class="lg:col-span-2 pr-0 lg:pr-10 reveal-on-scroll">
            @if(isset($settings) && $settings->logo_footer)
                <img src="{{ asset('storage/'.$settings->logo_footer) }}" alt="Logo Footer" class="h-14 mb-6">
            @else
                <h3 class="text-3xl font-extrabold text-hpi-green mb-5 tracking-tight">HPI Kabupaten Malang</h3>
            @endif
            
            <p class="text-sm text-gray-600 leading-relaxed font-medium">
                {{ isset($settings) ? ($locale == 'id' ? $settings->teks_footer_id : $settings->teks_footer_en) : 'Organisasi resmi profesi pramuwisata di Kabupaten Malang. Berkomitmen memberikan pelayanan standar tinggi dan melestarikan kekayaan budaya serta alam Bumi Arema.' }}
            </p>
        </div>

        <div class="reveal-on-scroll delay-100">
            <h4 class="font-bold text-gray-900 mb-5 tracking-wide">{{ $locale == 'id' ? 'TAUTAN CEPAT' : 'QUICK LINKS' }}</h4>
            <ul class="space-y-3 text-sm text-gray-600 font-medium">
                <li><a href="/kebijakan-privasi" class="hover:text-hpi-green hover:translate-x-1 transition-transform inline-block">{{ $locale == 'id' ? 'Kebijakan Privasi' : 'Privacy Policy' }}</a></li>
                <li><a href="/syarat-ketentuan" class="hover:text-hpi-green hover:translate-x-1 transition-transform inline-block">{{ $locale == 'id' ? 'Syarat & Ketentuan' : 'Terms & Conditions' }}</a></li>
                <li><a href="/bantuan" class="hover:text-hpi-green hover:translate-x-1 transition-transform inline-block">{{ $locale == 'id' ? 'Bantuan' : 'Help Center' }}</a></li>
            </ul>
        </div>

        <div class="reveal-on-scroll delay-200">
            <h4 class="font-bold text-gray-900 mb-5 tracking-wide">{{ $locale == 'id' ? 'KONTAK' : 'CONTACT' }}</h4>
            <ul class="space-y-4 text-sm text-gray-600 font-medium">
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-hpi-green shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <span>{{ isset($kontak) ? $kontak->email : 'info@hpikabmalang.org' }}</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-hpi-green shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    <span>{{ isset($kontak) ? $kontak->telepon : '+62 812 3456 7890' }}</span>
                </li>
            </ul>
        </div>

        <div class="reveal-on-scroll delay-300">
            <h4 class="font-bold text-gray-900 mb-5 tracking-wide">{{ $locale == 'id' ? 'IKUTI KAMI' : 'FOLLOW US' }}</h4>
            <ul class="space-y-4 text-sm text-gray-600 font-medium">
                @if(isset($settings) && $settings->link_instagram)
                    <li>
                        <a href="{{ $settings->link_instagram }}" class="hover:text-hpi-green hover:translate-x-1 transition-transform flex items-center gap-3 w-fit" target="_blank">
                            <i class="fa-brands fa-instagram text-lg"></i> Instagram
                        </a>
                    </li>
                @endif
                
                @if(isset($settings) && $settings->link_youtube)
                    <li>
                        <a href="{{ $settings->link_youtube }}" class="hover:text-hpi-green hover:translate-x-1 transition-transform flex items-center gap-3 w-fit" target="_blank">
                            <i class="fa-brands fa-youtube text-lg"></i> YouTube
                        </a>
                    </li>
                @endif
                
                @if(isset($settings) && $settings->link_facebook)
                    <li>
                        <a href="{{ $settings->link_facebook }}" class="hover:text-hpi-green hover:translate-x-1 transition-transform flex items-center gap-3 w-fit" target="_blank">
                            <i class="fa-brands fa-facebook-f text-lg w-4 text-center"></i> Facebook
                        </a>
                    </li>
                @endif
                
                @if(isset($settings) && $settings->link_twitter)
                    <li>
                        <a href="{{ $settings->link_twitter }}" class="hover:text-hpi-green hover:translate-x-1 transition-transform flex items-center gap-3 w-fit" target="_blank">
                            <i class="fa-brands fa-x-twitter text-lg"></i> Twitter / X
                        </a>
                    </li>
                @endif
            </ul>
        </div>

    </div>

    <div class="max-w-7xl mx-auto px-6 mt-14 pt-8 border-t border-gray-300 flex justify-center text-sm text-gray-500 font-medium reveal-on-scroll delay-400">
        <p>&copy; {{ date('Y') }} HPI Kabupaten Malang. Himpunan Pramuwisata Indonesia.</p>
    </div>
</footer>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Tambahkan class is-visible saat elemen masuk layar
                    entry.target.classList.add('is-visible');
                    // Stop observing setelah muncul agar tidak berkedip
                    observer.unobserve(entry.target);
                }
            });
        }, { 
            threshold: 0.1, // Memicu animasi ketika 10% elemen sudah terlihat di layar
            rootMargin: "0px 0px -50px 0px"
        });

        document.querySelectorAll('.reveal-on-scroll').forEach((el) => {
            observer.observe(el);
        });
    });
</script>