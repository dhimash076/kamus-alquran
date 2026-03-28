<x-app-layout>
    <div class="py-12 min-h-screen" style="background: #faf7f0;">
        <div class="max-w-7xl mx-auto px-6">

            {{-- Header --}}
            <section class="relative rounded-[2.5rem] p-8 md:p-12 mb-12 overflow-hidden"
                style="background: linear-gradient(135deg, #1a3a2a 0%, #0f2318 60%, #1c2e1c 100%); box-shadow: 0 20px 60px rgba(15,35,24,0.25);">
                <div class="absolute top-0 right-0 w-80 h-80 rounded-full opacity-10"
                    style="background: radial-gradient(circle, #c9a84c, transparent); transform: translate(30%,-30%);"></div>
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 relative z-10">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-black text-white uppercase tracking-tighter">
                            Admin <span style="color: #c9a84c;">Dashboard</span>
                        </h1>
                        <p class="text-[10px] font-black uppercase tracking-[0.4em] mt-1" style="color: rgba(201,168,76,0.5);">
                            Kelola Data Kosa Kata
                        </p>
                    </div>
                    <a href="{{ route('admin.create') }}" 
                       class="font-black uppercase text-[10px] tracking-[0.2em] px-8 py-4 rounded-2xl transition-all"
                       style="background: linear-gradient(135deg, #c9a84c, #a07830); color: #0f2318; box-shadow: 0 8px 20px rgba(201,168,76,0.3);"
                       onmouseover="this.style.transform='translateY(-2px)';" onmouseout="this.style.transform='translateY(0)';">
                        <i class="fas fa-plus mr-2"></i> TAMBAH KATA
                    </a>
                </div>
            </section>

            {{-- Section divider --}}
            <div class="flex items-center gap-4 mb-6 px-2">
                <h2 class="text-[9px] font-black uppercase tracking-[0.5em] whitespace-nowrap" style="color: #a07830;">
                    Kosa Kata ({{ $vocabularies->count() }})
                </h2>
                <div class="h-[1px] w-full" style="background: linear-gradient(to right, rgba(160,120,48,0.3), transparent);"></div>
            </div>

            {{-- Table --}}
            <div class="bg-white rounded-[2rem] overflow-hidden mb-16" style="border: 1.5px solid #e8d9b5; box-shadow: 0 4px 20px rgba(26,58,42,0.06);">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #1a3a2a, #0f2318);">
                            <th class="p-5 font-black tracking-widest text-[10px] uppercase" style="color: rgba(201,168,76,0.8);">Arab</th>
                            <th class="p-5 font-black tracking-widest text-[10px] uppercase" style="color: rgba(201,168,76,0.8);">Arti</th>
                            <th class="p-5 font-black tracking-widest text-[10px] uppercase text-center" style="color: rgba(201,168,76,0.8);">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vocabularies as $v)
                        <tr class="transition-colors" style="border-bottom: 1px solid #f5edd8;"
                            onmouseover="this.style.background='#fdf9f2';" onmouseout="this.style.background='transparent';">
                            <td class="p-6 text-4xl font-arabic text-right antialiased" dir="rtl" style="color: #1a3a2a;">
                                {{ $v->arabic }}
                            </td>
                            <td class="p-6">
                                <p class="text-lg font-black uppercase tracking-tighter leading-none mb-2" style="color: #1c2e1c;">
                                    {{ $v->meaning }}
                                </p>
                                <span class="text-[10px] font-black uppercase tracking-widest italic mr-1" style="color: #c9a84c;">
                                    {{ $v->transliteration }}
                                </span>

                            </td>
                            <td class="p-6 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.edit', $v->id) }}" 
                                       class="px-4 py-2 rounded-xl font-black text-[9px] uppercase tracking-widest transition-all"
                                       style="background: rgba(26,58,42,0.06); color: #1a3a2a;"
                                       onmouseover="this.style.background='#1a3a2a'; this.style.color='#c9a84c';"
                                       onmouseout="this.style.background='rgba(26,58,42,0.06)'; this.style.color='#1a3a2a';">
                                        <i class="fas fa-pen mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.destroy', $v->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                        @csrf @method('DELETE')
                                        <button class="px-4 py-2 rounded-xl font-black text-[9px] uppercase tracking-widest transition-all"
                                            style="background: rgba(200,50,50,0.06); color: #c03030;"
                                            onmouseover="this.style.background='#c03030'; this.style.color='#fff';"
                                            onmouseout="this.style.background='rgba(200,50,50,0.06)'; this.style.color='#c03030';">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Feedback Section --}}
            <div class="flex items-center gap-4 mb-6 px-2">
                <h2 class="text-[9px] font-black uppercase tracking-[0.5em] whitespace-nowrap" style="color: #a07830;">
                    Feedback Masukan ({{ $feedbacks->count() }})
                </h2>
                <div class="h-[1px] w-full" style="background: linear-gradient(to right, rgba(160,120,48,0.3), transparent);"></div>
            </div>

            @if($feedbacks->count() > 0)
                <div class="space-y-4">
                    @foreach($feedbacks as $fb)
                    <div class="bg-white rounded-[2rem] p-6 transition-all duration-300"
                        style="border: 1.5px solid #e8d9b5;"
                        onmouseover="this.style.boxShadow='0 10px 30px rgba(26,58,42,0.08)';"
                        onmouseout="this.style.boxShadow='none';">
                        <div class="flex flex-col sm:flex-row justify-between items-start gap-3 mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center"
                                    style="background: linear-gradient(135deg, #1a3a2a, #0f2318);">
                                    <i class="fas fa-user text-[8px]" style="color: #c9a84c;"></i>
                                </div>
                                <div>
                                    <span class="font-black text-xs uppercase tracking-wider" style="color: #1c2e1c;">
                                        {{ $fb->user->name ?? 'User Dihapus' }}
                                    </span>
                                    <span class="text-[10px] ml-2" style="color: #b0997a;">
                                        {{ $fb->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest"
                                style="background: rgba(26,58,42,0.07); color: #1a3a2a;">
                                {{ $fb->vocabulary->arabic ?? '-' }} — {{ $fb->vocabulary->meaning ?? 'Kata Dihapus' }}
                            </span>
                        </div>
                        <p class="text-sm leading-relaxed pl-11" style="color: #5a4a35;">
                            {{ $fb->comment }}
                        </p>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 rounded-[3rem] max-w-xl mx-auto" style="border: 2px dashed #e8d9b5;">
                    <p class="font-black uppercase text-[9px] tracking-[0.6em]" style="color: #c9a84c; opacity: 0.4;">
                        Belum Ada Feedback
                    </p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>