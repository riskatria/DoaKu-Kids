@extends('layouts.app')

@section('title', 'Hafalan Saya')

@section('content')
<div class="section-header">
    <h1 class="section-title">
        <span class="icon">📖</span> Hafalan Saya
    </h1>
    <p class="section-subtitle">Pantau progres hafalan doa-doa kamu</p>
</div>

@if($belumMulai->isEmpty() && $sedangDihafal->isEmpty() && $sudahHafal->isEmpty())
    {{-- Empty State --}}
    <div class="empty-state">
        <div class="empty-icon">📖</div>
        <h2 class="empty-title">Belum ada doa di daftar hafalan.</h2>
        <p class="empty-desc">Yuk tambahkan doa yang ingin dihafal dari halaman utama.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">
            🏠 Ke Halaman Utama
        </a>
    </div>
@else
    @php
        $statusLabels = [
            'belum_mulai' => ['label' => 'Belum Mulai', 'badge' => 'badge-red', 'icon' => '⏳'],
            'sedang_dihafal' => ['label' => 'Sedang Menghafal', 'badge' => 'badge-amber', 'icon' => '🧠'],
            'sudah_hafal' => ['label' => 'Sudah Hafal', 'badge' => 'badge-green', 'icon' => '🌟'],
        ];
        
        $categories = [
            'Belum Mulai' => $belumMulai,
            'Sedang Menghafal' => $sedangDihafal,
            'Sudah Hafal' => $sudahHafal
        ];
    @endphp

    @foreach($categories as $categoryName => $memorizations)
        @if(!$memorizations->isEmpty())
            <h2 style="margin-top: 2rem; margin-bottom: 1rem; font-size: 1.25rem; font-weight: 700; color: var(--text-primary); border-bottom: 1px solid var(--border); padding-bottom: 0.5rem;">
                {{ $categoryName }} ({{ $memorizations->count() }})
            </h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
                @foreach($memorizations as $memo)
                <div class="card" id="memo-card-{{ $memo->prayer_id }}"
                     style="border-radius: var(--radius-xl); overflow: hidden; transition: var(--transition);">

                    {{-- Top color bar --}}
                    <div style="height: 4px; background: linear-gradient(90deg, var(--secondary), var(--secondary-light), var(--accent));"></div>

                    <div class="card-body" style="display: flex; flex-direction: column; gap: 1rem;">
                        {{-- Prayer ID & Status badge --}}
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <span class="badge badge-blue">Doa #{{ $memo->prayer_id }}</span>
                            <span class="badge {{ $statusLabels[$memo->status]['badge'] }}">
                                {{ $statusLabels[$memo->status]['icon'] }} {{ $statusLabels[$memo->status]['label'] }}
                            </span>
                        </div>

                        {{-- Title --}}
                        <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-primary); line-height: 1.4;">
                            {{ $memo->prayer_title }}
                        </h3>

                        {{-- Change Status Form --}}
                        <form method="POST" action="{{ route('memorization.update') }}" class="form-group" style="margin-bottom: 0;">
                            @csrf
                            <input type="hidden" name="prayer_id" value="{{ $memo->prayer_id }}">
                            <div style="display: flex; gap: 0.5rem; align-items: center;">
                                <select name="status" class="form-control" style="padding: 0.5rem; font-size: 0.875rem;" required>
                                    <option value="belum_mulai" {{ $memo->status == 'belum_mulai' ? 'selected' : '' }}>⏳ Belum Mulai</option>
                                    <option value="sedang_dihafal" {{ $memo->status == 'sedang_dihafal' ? 'selected' : '' }}>🧠 Sedang Menghafal</option>
                                    <option value="sudah_hafal" {{ $memo->status == 'sudah_hafal' ? 'selected' : '' }}>🌟 Sudah Hafal</option>
                                </select>
                                <button type="submit" class="btn btn-secondary btn-sm" title="Ubah Status">
                                    Ubah
                                </button>
                            </div>
                        </form>

                        {{-- Actions --}}
                        <div style="display: flex; gap: 0.75rem; margin-top: auto; padding-top: 1rem; border-top: 1px solid var(--border);">
                            <a href="{{ route('doa.detail', $memo->prayer_id) }}"
                               class="btn btn-primary btn-sm"
                               style="flex: 1; text-align: center; justify-content: center;">
                                📖 Buka Doa
                            </a>

                            <form method="POST" action="{{ route('memorization.remove') }}"
                                  onsubmit="return confirm('Yakin ingin menghapus doa ini dari hafalan?');">
                                @csrf
                                <input type="hidden" name="prayer_id" value="{{ $memo->prayer_id }}">
                                <button type="submit" class="btn btn-danger btn-sm"
                                        title="Hapus dari hafalan">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    @endforeach
@endif
@endsection
