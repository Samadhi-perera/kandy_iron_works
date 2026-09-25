<x-guest-layout>
    <div class="space-y-6">
        <div>
            <h3 class="text-xl font-bold text-white tracking-tight">Staff Authentication</h3>
            <p class="text-xs text-slate-400 mt-1">Sign in with your master fabricator credentials</p>
        </div>

        <!-- Demo Credentials Pill -->
        <div class="bg-amber-500/10 border border-amber-500/30 p-3.5 rounded-xl text-xs space-y-1">
            <div class="font-bold text-amber-400 flex items-center gap-1.5">
                <i class="fa-solid fa-key"></i>
                <span>Pre-configured Demo Credentials</span>
            </div>
            <div class="text-slate-300">
                Email: <code class="text-amber-300 font-mono font-bold">admin@kandyironworks.com</code>
            </div>
            <div class="text-slate-300">
                Password: <code class="text-amber-300 font-mono font-bold">admin123</code>
            </div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email', 'admin@kandyironworks.com') }}" required autofocus autocomplete="username"
                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-400 text-xs" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Password</label>
                <input id="password" type="password" name="password" value="admin123" required autocomplete="current-password"
                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-rose-400 text-xs" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between text-xs">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" name="remember" checked class="rounded border-slate-700 bg-white/5 text-amber-500 focus:ring-amber-500">
                    <span class="ms-2 text-slate-400">Remember session</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-slate-400 hover:text-amber-400 transition-colors" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button type="submit" class="w-full py-3 rounded-xl font-extrabold text-xs uppercase tracking-wider bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-black shadow-glow transition-all">
                Enter Workshop Console
            </button>
        </form>
    </div>
</x-guest-layout>
