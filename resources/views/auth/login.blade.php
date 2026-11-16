@extends('layouts.public')

@section('title', 'Masuk Pengelola Sistem - Paroki Santo Paulus Wonosobo')

@section('content')
<div class="section-py" style="display: flex; align-items: center; justify-content: center; min-height: 70vh;">
    <div style="width: 100%; max-width: 440px; padding: 0 1rem;">
        <div class="card-paroki" style="padding: 2.25rem;">
            <!-- Brand Icon -->
            <div style="text-align: center; margin-bottom: 1.75rem;">
                <div style="width: 58px; height: 58px; border-radius: 50%; background-color: var(--color-primary); color: var(--color-accent); display: inline-flex; align-items: center; justify-content: center; font-size: 1.75rem; border: 2px solid var(--color-accent); margin-bottom: 0.75rem;">
                    <i class="fa-solid fa-church"></i>
                </div>
                <h2 style="font-size: 1.5rem; margin-bottom: 0.25rem;">Portal Pengelola</h2>
                <p style="font-size: 0.875rem; color: var(--color-text-secondary);">Masuk ke Dashboard Paroki Santo Paulus Wonosobo</p>
            </div>

            <!-- Flash Error -->
            @if(session('error'))
                <div class="alert-paroki alert-danger">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">Alamat Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="nama@parokiwonosobo.org">
                    @error('email')
                        <span style="font-size: 0.8rem; color: var(--color-danger); display: block; margin-top: 0.25rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Kata Sandi</label>
                    <input type="password" name="password" id="password" class="form-control" required placeholder="••••••••">
                    @error('password')
                        <span style="font-size: 0.8rem; color: var(--color-danger); display: block; margin-top: 0.25rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; font-size: 0.875rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Ingat Saya</span>
                    </label>
                </div>

                <button type="submit" class="btn-paroki btn-primary" style="width: 100%; padding: 0.75rem; font-size: 1rem;">
                    <i class="fa-solid fa-right-to-bracket"></i> Masuk ke Dashboard
                </button>
            </form>

            <div style="margin-top: 1.75rem; padding-top: 1.25rem; border-top: 1px solid var(--color-border); text-align: center; font-size: 0.8rem; color: var(--color-text-secondary);">
                Khusus petugas terotorisasi: Admin Sekretariat, Romo Paroki, dan Tim Komsos.
            </div>
        </div>
    </div>
</div>
@endsection

