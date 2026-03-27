<x-guest-layout>
    {{-- Header --}}
    <div class="text-center mb-8">
        <h2 class="text-xl font-black uppercase tracking-[0.2em]" style="color: #1a3a2a;">Masuk</h2>
        <p class="text-[9px] font-black uppercase tracking-[0.4em] mt-1" style="color: rgba(201,168,76,0.7);">
            Login ke Akun Anda
        </p>
        <div class="w-12 h-[2px] mx-auto mt-3" style="background: linear-gradient(to right, transparent, #c9a84c, transparent);"></div>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[9px] font-black uppercase tracking-[0.3em] mb-2" style="color: #1a3a2a;">
                <i class="fas fa-envelope mr-1" style="color: #c9a84c;"></i> Email
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="w-full rounded-xl px-5 py-3.5 text-sm font-bold outline-none transition-all"
                style="background: #f7f2e8; border: 2px solid #f0e6cc; color: #1a3a2a;"
                onfocus="this.style.borderColor='#c9a84c'; this.style.boxShadow='0 0 0 3px rgba(201,168,76,0.15)';"
                onblur="this.style.borderColor='#f0e6cc'; this.style.boxShadow='none';">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-5">
            <label for="password" class="block text-[9px] font-black uppercase tracking-[0.3em] mb-2" style="color: #1a3a2a;">
                <i class="fas fa-lock mr-1" style="color: #c9a84c;"></i> Password
            </label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full rounded-xl px-5 py-3.5 text-sm font-bold outline-none transition-all"
                style="background: #f7f2e8; border: 2px solid #f0e6cc; color: #1a3a2a;"
                onfocus="this.style.borderColor='#c9a84c'; this.style.boxShadow='0 0 0 3px rgba(201,168,76,0.15)';"
                onblur="this.style.borderColor='#f0e6cc'; this.style.boxShadow='none';">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-5">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-2 shadow-sm w-4 h-4"
                    style="border-color: #c9a84c; color: #1a3a2a; accent-color: #1a3a2a;">
                <span class="ms-2 text-[9px] font-black uppercase tracking-[0.2em]" style="color: #1a3a2a; opacity: 0.6;">{{ __('Ingat Saya') }}</span>
            </label>
        </div>

        <div class="mt-8">
            <!-- Login Button -->
            <button type="submit"
                class="w-full py-4 rounded-xl font-black uppercase text-[10px] tracking-[0.3em] transition-all duration-300"
                style="background: linear-gradient(135deg, #1a3a2a, #0f2318); color: #c9a84c; box-shadow: 0 8px 25px rgba(26,58,42,0.4);"
                onmouseover="this.style.boxShadow='0 12px 35px rgba(26,58,42,0.6)'; this.style.transform='translateY(-1px)';"
                onmouseout="this.style.boxShadow='0 8px 25px rgba(26,58,42,0.4)'; this.style.transform='translateY(0)';">
                <i class="fas fa-sign-in-alt mr-2"></i> Masuk
            </button>
        </div>

        <div class="flex items-center justify-center mt-6">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-[9px] font-black uppercase tracking-[0.2em] transition-colors"
                    style="color: rgba(201,168,76,0.6);"
                    onmouseover="this.style.color='#c9a84c';"
                    onmouseout="this.style.color='rgba(201,168,76,0.6)';">
                    {{ __('Lupa Password?') }}
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
