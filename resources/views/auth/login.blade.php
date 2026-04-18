<x-guest-layout>
    
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-[#D4AF37] tracking-wide drop-shadow-md mb-2">
                Welcome Back
            </h2>
            <p class="text-gray-400 text-sm">Sign in to your GAD System account</p>
        </div>

        <x-auth-session-status class="mb-6" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-6 relative">
                <x-input-label for="email" :value="__('Email')" class="font-medium text-gray-300 mb-2 block"/>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <x-text-input id="email" 
                        class="block w-full pl-11 pr-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:bg-white/10 focus:border-[#D4AF37] focus:ring-[#D4AF37] focus:ring-1 shadow-sm transition-all duration-300 hover:bg-white/10" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autofocus 
                        autocomplete="username" 
                        placeholder="name@example.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400"/>
            </div>

            <div class="mb-6 relative">
                <x-input-label for="password" :value="__('Password')" class="font-medium text-gray-300 mb-2 block"/>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <x-text-input id="password" 
                        class="block w-full pl-11 pr-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:bg-white/10 focus:border-[#D4AF37] focus:ring-[#D4AF37] focus:ring-1 shadow-sm transition-all duration-300 hover:bg-white/10" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="current-password" 
                        placeholder="••••••••" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-400"/>
            </div>

            <div class="flex items-center justify-between mb-8">
                <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                    <input id="remember_me" type="checkbox" class="rounded bg-white/5 border-white/20 text-[#D4AF37] shadow-sm focus:ring-[#D4AF37] focus:ring-offset-0 focus:ring-offset-transparent transition-colors group-hover:border-[#D4AF37]" name="remember">
                    <span class="ml-2 text-sm text-gray-400 group-hover:text-white transition-colors">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-[#D4AF37] hover:text-white transition-colors duration-300" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl bg-[#008080] hover:bg-[#009999] text-white font-bold tracking-wide shadow-[0_4px_20px_0_rgba(0,128,128,0.4)] hover:shadow-[0_6px_25px_0_rgba(0,128,128,0.6)] transition-all duration-300 hover:-translate-y-1 active:translate-y-0 flex justify-center items-center gap-2 group">
                <span>{{ __('Log in') }}</span>
                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </button>

            <div class="mt-8 pt-6 border-t border-white/10 text-center">
                <p class="text-sm text-gray-400">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-[#D4AF37] font-semibold hover:text-white hover:underline transition-all duration-300 ml-1">
                        Register here
                    </a>
                </p>
            </div>
        </form>
</x-guest-layout>