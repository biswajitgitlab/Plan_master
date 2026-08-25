<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-on-surface mb-1">Forgot Password</h1>
        <p class="text-xs text-on-surface-variant leading-relaxed">
            Enter your email address and we'll send you a password reset link to access your EventCentral account.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-semibold text-on-surface mb-1">Email Address</label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus
                   placeholder="name@company.com"
                   class="w-full bg-surface-container-lowest border border-outline-variant rounded-xl px-3.5 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-fixed transition-all" />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-error" />
        </div>

        <div class="pt-2">
            <button type="submit" 
                    class="w-full py-3 bg-primary text-white font-semibold text-sm rounded-xl hover:bg-primary/90 active:scale-[0.99] transition-all shadow-sm flex items-center justify-center gap-2">
                <span>Email Password Reset Link</span>
                <span class="material-symbols-outlined text-[18px]">send</span>
            </button>
        </div>
    </form>

    <div class="mt-6 pt-6 border-t border-outline-variant/60 text-center">
        <a href="{{ route('login') }}" class="text-xs text-primary font-bold hover:underline inline-flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">arrow_back</span>
            Back to Sign In
        </a>
    </div>
</x-guest-layout>

