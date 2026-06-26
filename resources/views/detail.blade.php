@extends('layouts.app')

@section('title', $prayer['doa'] ?? 'Detail Doa')

@push('styles')
<style>
    .doa-detail-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius-xl);
        padding: 2.5rem;
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
        max-width: 800px;
        margin: 0 auto;
    }
    
    .doa-detail-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 6px;
        background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
    }

    .doa-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 3.5rem;
        height: 3.5rem;
        background: linear-gradient(135deg, rgba(14, 165, 233, 0.1), rgba(34, 197, 94, 0.1));
        border: 2px solid rgba(34, 197, 94, 0.3);
        border-radius: 50%;
        color: var(--primary-light);
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
    }

    .doa-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 2rem;
        line-height: 1.3;
    }

    .doa-arabic {
        font-family: 'Amiri', serif;
        font-size: 2.5rem;
        line-height: 1.8;
        color: var(--text-primary);
        text-align: right;
        margin-bottom: 1.5rem;
        padding: 1.5rem;
        background: rgba(34, 197, 94, 0.05);
        border-radius: var(--radius-lg);
        border-left: 4px solid var(--primary);
    }

    .doa-latin {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--secondary-light);
        font-style: italic;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .doa-translation {
        font-size: 1.125rem;
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    .doa-riwayat {
        font-size: 0.875rem;
        color: var(--text-dim);
        border-top: 1px dashed var(--border);
        padding-top: 1rem;
        margin-top: 2rem;
    }
    
    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }
    
    .btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }
</style>
@endpush

@section('content')
<div style="max-width: 800px; margin: 0 auto 1.5rem auto;">
    <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('home') }}" class="btn btn-secondary btn-sm">
        &larr; Kembali
    </a>
</div>

<div class="doa-detail-card fade-in-up">
    <div class="doa-number">{{ $prayer['id'] ?? '?' }}</div>
    
    <h1 class="doa-title">{{ $prayer['doa'] ?? 'Judul Doa' }}</h1>

    @if(!empty($prayer['ayat']))
        <div class="doa-arabic" dir="rtl">
            {{ $prayer['ayat'] }}
        </div>
    @endif

    @if(!empty($prayer['latin']))
        <div class="doa-latin">
            "{{ $prayer['latin'] }}"
        </div>
    @endif

    @if(!empty($prayer['artinya']))
        <div class="doa-translation">
            <strong style="color: var(--text-secondary);">Artinya:</strong><br>
            {{ $prayer['artinya'] }}
        </div>
    @endif

    @if(!empty($prayer['riwayat']))
        <div class="doa-riwayat">
            <span class="icon">📜</span> <strong>Riwayat:</strong> {{ $prayer['riwayat'] }}
        </div>
    @endif

    <div class="action-buttons">
        @auth
            {{-- Tombol Favorit --}}
            <form method="POST" action="{{ route('favorites.toggle') }}" class="inline" style="margin: 0;">
                @csrf
                <input type="hidden" name="prayer_id" value="{{ $prayer['id'] ?? '' }}">
                <input type="hidden" name="prayer_title" value="{{ $prayer['doa'] ?? '' }}">
                <button type="submit" class="btn {{ $isFavorited ? 'btn-danger' : 'btn-secondary' }}">
                    {{ $isFavorited ? '❤️ Hapus Favorit' : '🤍 Tambah Favorit' }}
                </button>
            </form>

            {{-- Tombol Hafalan --}}
            <form method="POST" action="{{ route('memorization.add') }}" class="inline" style="margin: 0;">
                @csrf
                <input type="hidden" name="prayer_id" value="{{ $prayer['id'] ?? '' }}">
                <input type="hidden" name="prayer_title" value="{{ $prayer['doa'] ?? '' }}">
                <button type="submit" class="btn {{ $isMemorized ? 'btn-primary' : 'btn-secondary' }}" {{ $isMemorized ? 'disabled' : '' }} title="{{ $isMemorized ? 'Sudah ada di daftar hafalan' : 'Tambah ke hafalan' }}">
                    {{ $isMemorized ? '🌟 Sudah di Hafalan' : '📖 Tambah Hafalan' }}
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-secondary">
                🤍 Tambah Favorit
            </a>
            <a href="{{ route('login') }}" class="btn btn-secondary">
                📖 Tambah Hafalan
            </a>
        @endauth
    </div>
</div>
@endsection
