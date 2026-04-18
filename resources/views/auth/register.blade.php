<x-guest-layout>
    <div class="text-center mb-5">
        <h2 class="text-2xl font-bold text-[#D4AF37] tracking-wide drop-shadow-md mb-1">
            Create Account
        </h2>
        <p class="text-gray-400 text-sm">Join the GAD System today</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3.5 relative">
            <x-input-label for="name" :value="__('Name')" class="font-medium text-gray-300 mb-1.5 block text-sm"/>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <x-text-input id="name" class="block w-full pl-10 pr-3 py-2 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:bg-white/10 focus:border-[#D4AF37] focus:ring-[#D4AF37] focus:ring-1 shadow-sm transition-all duration-300 text-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Juan Dela Cruz" />
            </div>
        </div>

        <div class="mb-3.5 relative">
            <x-input-label for="email" :value="__('Email')" class="font-medium text-gray-300 mb-1.5 block text-sm"/>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
                <x-text-input id="email" class="block w-full pl-10 pr-3 py-2 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:bg-white/10 focus:border-[#D4AF37] focus:ring-[#D4AF37] focus:ring-1 shadow-sm transition-all duration-300 text-sm" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@example.com" />
            </div>
        </div>

        <div class="mb-3.5 relative">
            <x-input-label for="password" :value="__('Password')" class="font-medium text-gray-300 mb-1.5 block text-sm"/>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <x-text-input id="password" class="block w-full pl-10 pr-3 py-2 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:bg-white/10 focus:border-[#D4AF37] focus:ring-[#D4AF37] focus:ring-1 shadow-sm transition-all duration-300 text-sm" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            </div>
        </div>

        <div class="mb-6 relative">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="font-medium text-gray-300 mb-1.5 block text-sm"/>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <x-text-input id="password_confirmation" class="block w-full pl-10 pr-3 py-2 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:bg-white/10 focus:border-[#D4AF37] focus:ring-[#D4AF37] focus:ring-1 shadow-sm transition-all duration-300 text-sm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            </div>
        </div>

        <button type="submit" class="w-full py-2.5 rounded-xl bg-[#008080] hover:bg-[#009999] text-white font-bold tracking-wide shadow-[0_4px_20px_0_rgba(0,128,128,0.4)] hover:shadow-[0_6px_25px_0_rgba(0,128,128,0.6)] transition-all duration-300 hover:-translate-y-1 active:translate-y-0 flex justify-center items-center gap-2 group mb-5">
            <span>{{ __('Register') }}</span>
        </button>

        <div class="pt-4 border-t border-white/10 text-center">
            <p class="text-xs text-gray-400">
                Already registered? 
                <a href="{{ route('login') }}" class="text-[#D4AF37] font-semibold hover:text-white hover:underline transition-all duration-300 ml-1">
                    Log in here
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>