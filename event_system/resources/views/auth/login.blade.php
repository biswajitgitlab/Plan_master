<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-on-surface mb-1">Sign In</h1>
        <p class="text-xs text-on-surface-variant">Enter your credentials to access your EventCentral account</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-semibold text-on-surface mb-1">Email Address</label>
            <div class="relative">
                <input id="email" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       autocomplete="username"
                       placeholder="name@company.com"
                       class="w-full bg-surface-container-lowest border border-outline-variant rounded-xl px-3.5 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-fixed transition-all" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-error" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-1">
                <label for="password" class="block text-xs font-semibold text-on-surface">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-primary font-semibold hover:underline" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="current-password"
                   placeholder="••••••••"
                   class="w-full bg-surface-container-lowest border border-outline-variant rounded-xl px-3.5 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-fixed transition-all" />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-error" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" 
                       type="checkbox" 
                       name="remember" 
                       class="rounded border-outline-variant text-primary focus:ring-primary-fixed w-4 h-4">
                <span class="ms-2 text-xs text-on-surface-variant font-medium">Keep me signed in</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" 
                    class="w-full py-3 bg-primary text-white font-semibold text-sm rounded-xl hover:bg-primary/90 active:scale-[0.99] transition-all shadow-sm flex items-center justify-center gap-2">
                <span>Sign In to EventCentral</span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </button>
        </div>
    </form>

    <!-- Register Link -->
    <div class="mt-6 pt-6 border-t border-outline-variant/60 text-center">
        <p class="text-xs text-on-surface-variant">
            Don't have an account yet? 
            <a href="{{ route('register') }}" class="text-primary font-bold hover:underline ms-1">
                Create an Account
            </a>
        </p>
    </div>
</x-guest-layout>

