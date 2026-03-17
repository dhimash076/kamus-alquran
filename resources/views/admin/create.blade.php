<x-app-layout>
    <div class="py-12 min-h-screen" style="background: #faf7f0;">
        <div class="max-w-3xl mx-auto px-6">
            
            <div class="mb-6">
                <a href="{{ route('admin.index') }}" class="inline-flex items-center gap-2 bg-white px-4 py-2 rounded-xl font-black uppercase text-[8px] tracking-widest transition-all shadow-sm"
                    style="border: 1.5px solid #e8d9b5; color: #7a6040;"
                    onmouseover="this.style.background='#1a3a2a'; this.style.color='#c9a84c';"
                    onmouseout="this.style.background='#fff'; this.style.color='#7a6040';">
                    <i class="fas fa-chevron-left text-[8px]"></i> Kembali ke Dashboard
                </a>
            </div>

            <div class="bg-white rounded-[2rem] p-8 md:p-10 overflow-hidden relative" style="border: 1.5px solid #e8d9b5; box-shadow: 0 10px 40px rgba(26,58,42,0.08);">
                {{-- Decorative top bar --}}
                <div class="absolute top-0 left-0 right-0 h-1.5" style="background: linear-gradient(90deg, #1a3a2a, #c9a84c, #1a3a2a);"></div>

                <h1 class="text-3xl font-black uppercase tracking-tighter mb-2 mt-2" style="color: #1a3a2a;">
                    Input Kata <span style="color: #c9a84c;">Baru</span>
                </h1>
                <p class="text-[10px] font-black uppercase tracking-[0.4em] mb-8" style="color: #b0997a;">Tambah Kosa Kata Al-Quran</p>

                @if ($errors->any())
                    <div class="rounded-2xl p-6 mb-8" style="background: #fff5f5; border: 1px solid #f5c6c6;">
                        <p class="font-black uppercase text-xs mb-2 tracking-widest" style="color: #c03030;">
                            <i class="fas fa-exclamation-triangle mr-1"></i> Penyebab Gagal Simpan:
                        </p>
                        <ul class="list-disc pl-5 text-sm space-y-1" style="color: #a02020;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block font-black uppercase text-[9px] mb-2 tracking-[0.3em]" style="color: #a07830;">Teks Arab</label>
                        <input type="text" name="arabic" value="{{ old('arabic') }}" placeholder="...أهلاً" 
                            class="w-full rounded-2xl p-5 text-4xl font-arabic text-right outline-none transition-all"
                            style="border: 2px solid #f0e6cc; background: #fdf9f2; color: #1a3a2a;"
                            onfocus="this.style.borderColor='#c9a84c'; this.style.background='#fff';"
                            onblur="this.style.borderColor='#f0e6cc'; this.style.background='#fdf9f2';"
                            required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-black uppercase text-[9px] mb-2 tracking-[0.3em]" style="color: #a07830;">Transliterasi</label>
                            <input type="text" name="transliteration" value="{{ old('transliteration') }}" placeholder="Contoh: Ahlan" 
                                class="w-full rounded-2xl p-4 font-bold outline-none transition-all"
                                style="border: 2px solid #f0e6cc; background: #fdf9f2; color: #1c2e1c;"
                                onfocus="this.style.borderColor='#c9a84c'; this.style.background='#fff';"
                                onblur="this.style.borderColor='#f0e6cc'; this.style.background='#fdf9f2';"
                                required>
                        </div>
                        <div>
                            <label class="block font-black uppercase text-[9px] mb-2 tracking-[0.3em]" style="color: #a07830;">Arti Indonesia</label>
                            <input type="text" name="meaning" value="{{ old('meaning') }}" placeholder="Contoh: Selamat Datang" 
                                class="w-full rounded-2xl p-4 font-bold outline-none transition-all"
                                style="border: 2px solid #f0e6cc; background: #fdf9f2; color: #1c2e1c;"
                                onfocus="this.style.borderColor='#c9a84c'; this.style.background='#fff';"
                                onblur="this.style.borderColor='#f0e6cc'; this.style.background='#fdf9f2';"
                                required>
                        </div>
                    </div>

                    <div>
                        <label class="block font-black uppercase text-[9px] mb-2 tracking-[0.3em]" style="color: #a07830;">Pilih Kategori</label>
                        <select name="category_id" class="w-full rounded-2xl p-4 font-bold outline-none transition-all"
                            style="border: 2px solid #f0e6cc; background: #fdf9f2; color: #1c2e1c;"
                            onfocus="this.style.borderColor='#c9a84c'; this.style.background='#fff';"
                            onblur="this.style.borderColor='#f0e6cc'; this.style.background='#fdf9f2';"
                            required>
                            <option value="">-- Klik Untuk Memilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ strtoupper($cat->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-black uppercase text-[9px] mb-2 tracking-[0.3em]" style="color: #a07830;">Video Peragaan (.MP4)</label>
                        <input type="file" name="video" 
                            class="w-full rounded-2xl p-4 font-bold outline-none transition-all cursor-pointer"
                            style="border: 2px solid #f0e6cc; background: #fdf9f2; color: #7a6040;">
                        <p class="text-[10px] font-bold mt-2 uppercase italic tracking-widest" style="color: #b0997a;">* Max File: 50MB. Format: MP4 atau MOV.</p>
                    </div>

                    <button type="submit" class="w-full p-5 rounded-2xl font-black text-sm uppercase tracking-[0.2em] transition-all"
                        style="background: linear-gradient(135deg, #1a3a2a, #0f2318); color: #c9a84c; box-shadow: 0 10px 30px rgba(26,58,42,0.25);"
                        onmouseover="this.style.background='linear-gradient(135deg, #c9a84c, #a07830)'; this.style.color='#0f2318';"
                        onmouseout="this.style.background='linear-gradient(135deg, #1a3a2a, #0f2318)'; this.style.color='#c9a84c';">
                        <i class="fas fa-save mr-2"></i> SIMPAN DATA
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>