@extends('layout.app')

@section('title', 'Siklus Event')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col bg-slate-50 font-inter">
        <div class="p-10 max-w-[1400px] mx-auto w-full">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Siklus Event</h2>
                    <p class="text-slate-500 mt-2 font-medium">Kontrol status publikasi, pendaftaran, dan penyelesaian Event.</p>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-8 p-4 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center gap-3 animate-fade-in">
                    <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                    <p class="text-sm font-bold text-emerald-700">{{ session('success') }}</p>
                </div>
            @endif

            @if($errors->has('api_error'))
                <div class="mb-8 p-4 rounded-xl bg-rose-50 border border-rose-100 flex items-center gap-3 animate-fade-in">
                    <span class="material-symbols-outlined text-rose-600">error</span>
                    <p class="text-sm font-bold text-rose-700">{{ $errors->first('api_error') }}</p>
                </div>
            @endif
            
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-[10px] uppercase tracking-[0.2em] text-slate-400 font-black border-b border-slate-100">
                                <th class="p-6 pl-10">Detail Event</th>
                                <th class="p-6 text-center">Kapasitas</th>
                                <th class="p-6">Status Saat Ini</th>
                                <th class="p-6 pr-10 text-right">Aksi Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-100">
                            @forelse($events as $event)
                                @php $status = $event['status'] ?? ''; @endphp
                                <tr class="hover:bg-slate-50/50 transition-colors {{ $status == 'closed' ? 'bg-cyan-50/10' : '' }}">
                                    <td class="p-6 pl-10">
                                        <div class="font-black {{ $status == 'draft' ? 'text-slate-900 opacity-60' : 'text-slate-900' }} text-lg">
                                            {{ $event['title'] ?? 'Judul Tidak Tersedia' }}
                                        </div>
                                        <div class="text-xs text-slate-400 font-medium {{ $status == 'draft' && empty($event['venue_name']) ? 'italic' : '' }} mt-1">
                                            @if(!empty($event['date_start']))
                                                {{ \Carbon\Carbon::parse($event['date_start'])->format('d F Y') }} • 
                                            @endif
                                            {{ $event['venue_name'] ?? 'Belum ditentukan lokasinya' }}
                                        </div>
                                    </td>
                                    
                                    <td class="p-6 text-center">
                                        <div class="inline-flex flex-col">
                                            @if($status == 'draft')
                                                <div class="text-slate-300 font-bold">- / {{ $event['total_capacity'] ?? 0 }}</div>
                                            @else
                                                <span class="font-bold text-slate-900">{{ $event['total_capacity'] ?? 0 }} Orang</span>
                                            @endif
                                        </div>
                                    </td>
                                    
                                    <td class="p-6">
                                        @if($status == 'open')
                                            <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-full border border-emerald-100 uppercase tracking-widest">Pendaftaran Dibuka</span>
                                        @elseif($status == 'draft')
                                            <span class="px-4 py-1.5 bg-slate-100 text-slate-400 text-[10px] font-black rounded-full border border-slate-200 uppercase tracking-widest">Draft</span>
                                        @elseif($status == 'closed')
                                            <span class="px-4 py-1.5 bg-amber-50 text-amber-600 text-[10px] font-black rounded-full border border-amber-100 uppercase tracking-widest">Ditutup</span>
                                        @else
                                            <span class="px-4 py-1.5 bg-cyan-500 text-white text-[10px] font-black rounded-full uppercase tracking-widest shadow-sm">Selesai</span>
                                        @endif
                                    </td>
                                    
                                    <td class="p-6 pr-10 text-right">
                                        <div class="flex justify-end gap-2">
                                            @if($status == 'open')
                                                <button class="px-4 py-2 bg-amber-50 text-amber-600 rounded-xl text-[10px] font-black uppercase hover:bg-amber-100 transition-colors cursor-pointer border border-transparent hover:border-amber-200">Tutup Pendaftaran</button>
                                                <button class="px-4 py-2 bg-slate-100 text-slate-400 rounded-xl text-[10px] font-black uppercase cursor-not-allowed" disabled>Selesaikan</button>
                                            @elseif($status == 'draft')
                                                <button class="px-6 py-2 primary-gradient text-white rounded-xl text-[10px] font-black uppercase shadow-md shadow-cyan-500/20 hover:scale-105 active:scale-95 transition-all cursor-pointer">Publikasikan Event</button>
                                            @elseif($status == 'finished' || $status == 'done')
                                                <a href="#" class="inline-flex items-center gap-2 text-cyan-600 font-black text-[10px] uppercase hover:underline">
                                                    <span class="material-symbols-outlined text-sm">card_membership</span> Kelola Sertifikat
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                                <span class="material-symbols-outlined text-3xl text-slate-300">event_busy</span>
                                            </div>
                                            <p class="text-slate-500 font-bold text-sm">Belum ada event yang dibuat atau API tidak terhubung.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-12 grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="p-6 bg-white rounded-3xl border border-slate-100 hover:border-slate-200 transition-colors shadow-sm">
                    <div class="w-10 h-10 rounded-xl bg-slate-50 mb-4 flex items-center justify-center text-slate-400">
                        <span class="material-symbols-outlined text-lg">edit_note</span>
                    </div>
                    <h4 class="font-bold text-slate-900 text-sm mb-1">Draft</h4>
                    <p class="text-xs text-slate-500 leading-relaxed font-medium">Event sedang dalam tahap persiapan dan belum dapat dilihat oleh peserta di aplikasi mobile.</p>
                </div>
                <div class="p-6 bg-white rounded-3xl border border-slate-100 hover:border-emerald-100 transition-colors shadow-sm">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 mb-4 flex items-center justify-center text-emerald-600">
                        <span class="material-symbols-outlined text-lg">public</span>
                    </div>
                    <h4 class="font-bold text-slate-900 text-sm mb-1">Pendaftaran Dibuka</h4>
                    <p class="text-xs text-slate-500 leading-relaxed font-medium">Event aktif dan peserta dapat melakukan pendaftaran serta memilih tempat duduk.</p>
                </div>
                <div class="p-6 bg-white rounded-3xl border border-slate-100 hover:border-amber-100 transition-colors shadow-sm">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 mb-4 flex items-center justify-center text-amber-600">
                        <span class="material-symbols-outlined text-lg">lock_person</span>
                    </div>
                    <h4 class="font-bold text-slate-900 text-sm mb-1">Pendaftaran Ditutup</h4>
                    <p class="text-xs text-slate-500 leading-relaxed font-medium">Pendaftaran telah berakhir. Admin fokus pada persiapan gate control dan check-in.</p>
                </div>
                <div class="p-6 bg-white rounded-3xl border border-slate-100 hover:border-cyan-100 transition-colors shadow-sm">
                    <div class="w-10 h-10 rounded-xl bg-cyan-50 mb-4 flex items-center justify-center text-cyan-600">
                        <span class="material-symbols-outlined text-lg">verified</span>
                    </div>
                    <h4 class="font-bold text-slate-900 text-sm mb-1">Event Selesai</h4>
                    <p class="text-xs text-slate-500 leading-relaxed font-medium">Tahap akhir di mana sistem akan mulai menghasilkan sertifikat digital bagi peserta yang hadir.</p>
                </div>
            </div>
        </div>
        
        <style>
            @keyframes fade-in {
                from { opacity: 0; transform: translateY(-10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in { animation: fade-in 0.3s ease-out forwards; }
        </style>
    </main>
@endsection