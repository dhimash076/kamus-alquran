<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-12">

        {{-- Hero Section --}}
        <section class="relative rounded-[2.5rem] p-8 md:p-14 mb-16 overflow-hidden"
            style="background: linear-gradient(135deg, #1a3a2a 0%, #0f2318 50%, #1c2e1c 100%);">
            {{-- Decorative ornament --}}
            <div class="absolute top-0 right-0 w-80 h-80 rounded-full opacity-10"
                style="background: radial-gradient(circle, #c9a84c, transparent); transform: translate(30%, -30%);"></div>
            <div class="absolute bottom-0 left-0 w-60 h-60 rounded-full opacity-10"
                style="background: radial-gradient(circle, #c9a84c, transparent); transform: translate(-30%, 30%);"></div>
            <div class="absolute inset-0 opacity-5" style="background-image: url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23c9a84c' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E\");"></div>

            <div class="max-w-2xl mx-auto text-center relative z-10">
                <div class="inline-block mb-5">
                    <span class="text-[9px] font-black uppercase tracking-[0.5em] px-4 py-1.5 rounded-full border"
                        style="color: #c9a84c; border-color: rgba(201,168,76,0.3); background: rgba(201,168,76,0.08);">
                        ﷽ Bismillah
                    </span>
                </div>
                <h1 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tighter mb-4">
                    Kamus <span style="color: #c9a84c;">Digital</span> Al-Quran
                </h1>
                <p class="text-[10px] font-black uppercase tracking-[0.4em] mb-10" style="color: rgba(201,168,76,0.6);">
                    Sistem Isyarat Inklusif & Aksesibel
                </p>

                <form action="{{ url('/') }}" method="GET" class="relative group">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari Kosa Kata Arab..."
                        class="w-full rounded-2xl p-5 pl-14 text-lg font-bold outline-none transition-all"
                        style="background: rgba(255,255,255,0.08); border: 2px solid rgba(201,168,76,0.2); color: #fff; backdrop-filter: blur(12px);"
                        onfocus="this.style.background='rgba(255,255,255,0.12)'; this.style.borderColor='rgba(201,168,76,0.5)';"
                        onblur="this.style.background='rgba(255,255,255,0.08)'; this.style.borderColor='rgba(201,168,76,0.2)';"
                        autocomplete="off">
                    <div class="absolute left-6 top-5.5 transition-colors" style="color: rgba(201,168,76,0.5);">
                        <i class="fas fa-search text-xl"></i>
                    </div>
                    <button type="submit"
                        class="absolute right-3 top-3 font-black uppercase text-[10px] px-6 py-3 rounded-xl transition-all"
                        style="background: linear-gradient(135deg, #c9a84c, #a07830); color: #0f2318; letter-spacing: 0.15em; box-shadow: 0 8px 20px rgba(201,168,76,0.3);">
                        CARI
                    </button>
                </form>
            </div>
        </section>

        {{-- Results --}}
        <main>
            @if(isset($results) && $results->total() > 0)
                <div class="flex items-center gap-4 mb-10 px-2">
                    <h2 class="text-[9px] font-black uppercase tracking-[0.5em] whitespace-nowrap" style="color: #a07830;">
                        Daftar Kosa Kata ({{ $results->total() }})
                    </h2>
                    <div class="h-[1px] w-full" style="background: linear-gradient(to right, rgba(160,120,48,0.3), transparent);"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($results as $item)
                        <div class="bg-white rounded-[2rem] p-6 shadow-sm hover:shadow-xl transition-all duration-500 group flex flex-col justify-between"
                            style="border: 1.5px solid #f0e6cc;">
                            
                            <div>
                                <div class="flex justify-between items-center mb-6">
                                    <span class="text-[8px] font-black uppercase tracking-widest px-3 py-1 rounded-full"
                                        style="color: #1a3a2a; background: rgba(26,58,42,0.08);">
                                        {{ $item->category->name ?? 'UMUM' }}
                                    </span>
                                    <i class="fas fa-mosque text-sm transition-colors" style="color: #e8d9b5;"></i>
                                </div>

                                <div class="space-y-4 text-center">
                                    <h3 class="text-5xl font-arabic leading-tight transition-colors" dir="rtl"
                                        style="color: #1a3a2a;">
                                        {{ $item->arabic }}
                                    </h3>
                                    <div class="space-y-1">
                                        <p class="text-[10px] font-black uppercase tracking-widest italic" style="color: #c9a84c;">
                                            {{ $item->transliteration }}
                                        </p>
                                        <p class="text-lg font-black uppercase tracking-tighter" style="color: #1c2e1c;">
                                            {{ $item->meaning }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8">
                                <a href="{{ url('/vocabulary/' . $item->id) }}"
                                    class="flex items-center justify-center gap-2 w-full p-4 rounded-xl font-black uppercase text-[9px] tracking-[0.2em] transition-all group/btn"
                                    style="background: #f7f2e8; color: #1a3a2a;"
                                    onmouseover="this.style.background='linear-gradient(135deg,#1a3a2a,#0f2318)'; this.style.color='#c9a84c';"
                                    onmouseout="this.style.background='#f7f2e8'; this.style.color='#1a3a2a';">
                                    LIHAT ISYARAT
                                    <i class="fas fa-play-circle text-sm"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $results->appends(request()->query())->links() }}
                </div>

            @elseif(request('search'))
                <div class="rounded-[3rem] p-16 text-center border-2 border-dashed max-w-xl mx-auto" style="background: #fdfaf4; border-color: #e8d9b5;">
                    <i class="fas fa-search text-3xl mb-4" style="color: #e8d9b5;"></i>
                    <p class="font-black uppercase text-[10px] tracking-widest italic" style="color: #a07830;">
                        "{{ request('search') }}" Tidak Ditemukan.
                    </p>
                </div>
            @else
                <div class="text-center py-20 rounded-[3rem] max-w-2xl mx-auto border-2" style="border-color: #f0e6cc;">
                    <i class="fas fa-book-open text-3xl mb-4" style="color: #e8d9b5;"></i>
                    <p class="font-black uppercase text-[9px] tracking-[0.6em]" style="color: #c9a84c; opacity: 0.5;">
                        Mulai Pencarian Kosa Kata
                    </p>
                </div>
            @endif
        </main>

        <footer class="mt-24 py-8 text-center border-t" style="border-color: #f0e6cc;">
            <p class="text-[8px] font-black uppercase tracking-[0.6em]" style="color: #c9a84c; opacity: 0.4;">
                &copy; 2026 Al-Quran Sign Language Project
            </p>
        </footer>
    </div>
</x-app-layout>