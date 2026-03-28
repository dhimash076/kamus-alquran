<x-app-layout>
    <div class="py-10 min-h-screen" style="background: #faf7f0;">
        <div class="max-w-7xl mx-auto px-6">
            
            {{-- Back Button --}}
            <div class="mb-6">
                <a href="{{ route('homepage') }}" class="inline-flex items-center gap-2 bg-white px-4 py-2 rounded-xl font-black uppercase text-[8px] tracking-widest transition-all shadow-sm"
                    style="border: 1.5px solid #e8d9b5; color: #7a6040;"
                    onmouseover="this.style.background='#1a3a2a'; this.style.color='#c9a84c';"
                    onmouseout="this.style.background='#fff'; this.style.color='#7a6040';">
                    <i class="fas fa-chevron-left text-[8px]"></i> Beranda
                </a>
            </div>

            {{-- Video + Sidebar --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch mb-6">
                
                {{-- Video Player --}}
                <div class="lg:col-span-9">
                    <div class="rounded-[2rem] p-1.5 h-full relative" style="background: #1a3a2a; border: 1px solid rgba(201,168,76,0.2); box-shadow: 0 20px 40px rgba(15,35,24,0.2);">
                        <div class="absolute top-4 left-4 z-10">
                            <span class="text-white px-3 py-1 rounded-lg font-black text-[7px] uppercase tracking-widest"
                                style="background: rgba(201,168,76,0.25); border: 1px solid rgba(201,168,76,0.3); backdrop-filter: blur(8px);">
                                Peragaan Isyarataaa
                            </span>
                        </div>
                        <div class="relative bg-black rounded-[1.6rem] overflow-hidden aspect-video flex items-center justify-center h-full">
                            @if($vocabulary->video_path)
                                <video class="w-full h-full object-cover" controls autoplay muted loop>
                                    <source src="{{ asset('storage/' . $vocabulary->video_path) }}" type="video/mp4">
                                </video>
                            @else
                                <div class="text-center p-6">
                                    <i class="fas fa-video-slash text-3xl mb-2" style="color: #2a4a3a;"></i>
                                    <p class="font-black uppercase text-[8px] tracking-widest" style="color: #2a4a3a;">Video Belum Tersedia</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-3 flex flex-col gap-4">
                    <div class="bg-white rounded-[2rem] p-6 flex-1" style="border: 1.5px solid #e8d9b5;">
                        <h3 class="font-black uppercase text-[9px] tracking-[0.2em] mb-4 flex items-center gap-2" style="color: #1a3a2a;">
                            <span class="w-1 h-3 rounded-full" style="background: #c9a84c;"></span> Feedback
                        </h3>
                        
                        @auth
                            <form action="{{ route('feedback.store', $vocabulary->id) }}" method="POST" class="space-y-3">
                                @csrf
                                <textarea name="comment" rows="3" 
                                    class="w-full rounded-xl p-3 font-bold text-[10px] outline-none transition-all placeholder-stone-300 resize-none"
                                    style="border: 2px solid #f0e6cc; background: #faf7f0; color: #3a2a10;"
                                    placeholder="Masukan Anda..."></textarea>
                                <button type="submit" class="w-full py-3 rounded-lg font-black uppercase text-[8px] tracking-widest transition-all"
                                    style="background: linear-gradient(135deg, #1a3a2a, #0f2318); color: #c9a84c; box-shadow: 0 6px 16px rgba(26,58,42,0.25);"
                                    onmouseover="this.style.background='linear-gradient(135deg, #c9a84c, #a07830)'; this.style.color='#0f2318';"
                                    onmouseout="this.style.background='linear-gradient(135deg, #1a3a2a, #0f2318)'; this.style.color='#c9a84c';">
                                    KIRIM
                                </button>
                            </form>
                        @else
                            <div class="rounded-xl p-4 text-center h-full flex flex-col justify-center" style="background: #faf7f0;">
                                <p class="text-[8px] font-bold uppercase mb-3 tracking-widest italic" style="color: #a07830;">Login untuk memberikan masukan</p>
                                <a href="{{ route('login') }}" class="inline-block px-4 py-2 rounded-lg font-black uppercase text-[8px] tracking-widest transition-all"
                                    style="background: #1a3a2a; color: #c9a84c;">Login</a>
                            </div>
                        @endauth
                    </div>

                    <div class="rounded-2xl p-4 flex items-center gap-3" style="background: linear-gradient(135deg, #1a3a2a, #0f2318); border: 1px solid rgba(201,168,76,0.15);">
                        <div class="w-6 h-6 rounded-md flex items-center justify-center text-[8px]" style="background: rgba(201,168,76,0.2); color: #c9a84c;">
                            <i class="fas fa-database"></i>
                        </div>
                        <p class="text-[8px] font-black uppercase tracking-widest" style="color: rgba(201,168,76,0.6);">MySQL Active</p>
                    </div>
                </div>
            </div>

            {{-- Info Card --}}
            <div class="w-full bg-white rounded-[2.5rem] p-8 md:p-10 flex flex-col md:flex-row justify-between items-center gap-8 overflow-hidden"
                style="border: 1.5px solid #e8d9b5; box-shadow: 0 8px 30px rgba(26,58,42,0.06);">
                
                <div class="text-center md:text-left space-y-3 flex-1">
                    <p class="text-[9px] font-black uppercase tracking-[0.3em] italic" style="color: #c9a84c;">
                        {{ $vocabulary->transliteration }}
                    </p>
                    <h2 class="text-2xl md:text-3xl font-black uppercase tracking-tight leading-tight" style="color: #1a3a2a;">
                        {{ $vocabulary->meaning }}
                    </h2>


                </div>

                <div class="flex items-center gap-8">
                    <div class="h-16 w-[1px] hidden md:block" style="background: #f0e6cc;"></div>
                    <h1 class="text-4xl md:text-5xl font-arabic leading-[1.6] text-right" dir="rtl" style="color: #1a3a2a;">
                        {{ $vocabulary->arabic }}
                    </h1>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>