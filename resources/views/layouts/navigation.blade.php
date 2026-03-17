<nav x-data="{ open: false }" style="background: linear-gradient(to right, #0f2318, #1a3a2a); border-bottom: 2px solid rgba(201,168,76,0.2);" class="sticky top-0 z-50 shadow-xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            
            <div class="flex items-center gap-8">
                <a href="{{ route('homepage') }}" class="group flex items-center gap-2">
                    <div class="px-3 py-1.5 font-black uppercase tracking-tighter rounded-lg text-sm transition-transform group-hover:scale-105"
                        style="background: linear-gradient(135deg, #c9a84c, #a07830); color: #0f2318; box-shadow: 0 4px 12px rgba(201,168,76,0.3);">
                        KAMUS
                    </div>
                    <span class="font-black uppercase tracking-widest text-lg" style="color: rgba(255,255,255,0.9);">ISYARAT</span>
                </a>

                <div class="hidden sm:flex gap-6">
                    <a href="{{ route('homepage') }}" 
                        class="text-xs font-black uppercase tracking-widest transition-all duration-300 pb-0.5"
                        style="{{ request()->routeIs('homepage') ? 'color: #c9a84c; border-bottom: 2px solid #c9a84c;' : 'color: rgba(255,255,255,0.45); border-bottom: 2px solid transparent;' }}"
                        onmouseover="this.style.color='#c9a84c';" onmouseout="this.style.color='{{ request()->routeIs('homepage') ? '#c9a84c' : 'rgba(255,255,255,0.45)' }}';">
                        Beranda
                    </a>
                    
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.index') }}"
                                class="font-black uppercase text-[10px] tracking-widest px-4 py-1.5 rounded-full transition-all"
                                style="color: #c9a84c; border: 1px solid rgba(201,168,76,0.3); background: rgba(201,168,76,0.08);"
                                onmouseover="this.style.background='rgba(201,168,76,0.2)';"
                                onmouseout="this.style.background='rgba(201,168,76,0.08)';">
                                <i class="fas fa-shield-alt mr-1"></i> Dashboard Admin
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center">
                @auth
                    <div class="relative" x-data="{ openDropdown: false }" @click.away="openDropdown = false">
                        <button @click="openDropdown = !openDropdown" 
                            class="inline-flex items-center px-5 py-2.5 text-xs font-black uppercase rounded-xl transition-all"
                            style="background: rgba(255,255,255,0.06); border: 1px solid rgba(201,168,76,0.2); color: #fff;">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full animate-pulse" style="background: #c9a84c;"></div>
                                {{ Auth::user()->name }}
                            </div>
                            <svg class="ms-3 h-4 w-4 transition-transform duration-300" :class="{'rotate-180': openDropdown}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="color: rgba(201,168,76,0.6);">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="openDropdown" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            class="absolute right-0 mt-3 w-52 rounded-2xl shadow-2xl z-50 overflow-hidden"
                            style="background: #0f2318; border: 1px solid rgba(201,168,76,0.2);">
                            
                            <div class="p-2">
                                <div class="px-4 py-2 text-[10px] font-black uppercase tracking-widest mb-1"
                                    style="color: rgba(201,168,76,0.4); border-bottom: 1px solid rgba(201,168,76,0.1);">
                                    Akses: {{ Auth::user()->role }}
                                </div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-3 font-black uppercase text-[10px] transition-colors flex items-center justify-between rounded-xl"
                                        style="color: #e07070;"
                                        onmouseover="this.style.background='rgba(224,112,112,0.08)';"
                                        onmouseout="this.style.background='transparent';">
                                        Log Out 
                                        <i class="fas fa-sign-out-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="font-black uppercase text-[10px] tracking-widest transition-all" style="color: rgba(255,255,255,0.5);"
                            onmouseover="this.style.color='#c9a84c';" onmouseout="this.style.color='rgba(255,255,255,0.5)';">Masuk</a>
                        <a href="{{ route('register') }}" class="font-black uppercase text-[10px] tracking-widest px-6 py-2 rounded-xl transition-all"
                            style="background: linear-gradient(135deg, #c9a84c, #a07830); color: #0f2318; box-shadow: 0 6px 16px rgba(201,168,76,0.3);"
                            onmouseover="this.style.transform='translateY(-1px)';" onmouseout="this.style.transform='translateY(0)';">Daftar</a>
                    </div>
                @endauth
            </div>

            <div class="sm:hidden flex items-center">
                <button @click="open = ! open" class="p-2 rounded-lg" style="color: #c9a84c; background: rgba(201,168,76,0.08);">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
            </div>
        </div>
    </div>
</nav>