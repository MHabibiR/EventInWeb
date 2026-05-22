@extends('layout.app')

@section('title', 'Manage Events')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col bg-slate-50">
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
                            <tr class="bg-slate-50 text-[10px] uppercase tracking-[0.2em] text-slate-400 font-black">
                                <th class="p-6 pl-10">Detail Event</th>
                                <th class="p-6 text-center">Kapasitas</th>
                                <th class="p-6">Status Saat Ini</th>
                                <th class="p-6 pr-10 text-right">Aksi Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-100">
                            @forelse($events as $event)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="p-6 pl-10">
                                        <div class="font-black text-slate-900 text-lg">{{ $event['title'] }}</div>
                                        <div class="text-xs text-slate-400 font-medium">
                                            {{ \Carbon\Carbon::parse($event['date_start'])->format('d F Y') }} • {{ $event['venue_name'] ?? 'Belum ditentukan' }}
                                        </div>
                                    </td>
                                    
                                    <td class="p-6 text-center">
                                        <div class="inline-flex flex-col">
                                            <span class="font-bold text-slate-900">{{ $event['total_capacity'] }} Orang</span>
                                        </div>
                                    </td>
                                    
                                    <td class="p-6">
                                        @if($event['status'] == 'open')
                                            <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-full border border-emerald-100 uppercase tracking-widest">Pendaftaran Dibuka</span>
                                        @elseif($event['status'] == 'draft')
                                            <span class="px-4 py-1.5 bg-slate-100 text-slate-400 text-[10px] font-black rounded-full border border-slate-200 uppercase tracking-widest">Draft</span>
                                        @elseif($event['status'] == 'closed')
                                            <span class="px-4 py-1.5 bg-amber-50 text-amber-600 text-[10px] font-black rounded-full border border-amber-100 uppercase tracking-widest">Ditutup</span>
                                        @else
                                            <span class="px-4 py-1.5 bg-cyan-500 text-white text-[10px] font-black rounded-full uppercase tracking-widest shadow-sm">Selesai</span>
                                        @endif
                                    </td>
                                    
                                    <td class="p-6 pr-10 text-right">
                                        <div class="flex justify-end gap-2">
                                            @if($event['status'] == 'open')
                                                <button class="px-4 py-2 bg-amber-50 text-amber-600 rounded-xl text-[10px] font-black uppercase hover:bg-amber-100 transition-colors">Tutup Pendaftaran</button>
                                            @elseif($event['status'] == 'draft')
                                                <button class="px-6 py-2 bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-xl text-[10px] font-black uppercase shadow-md shadow-cyan-500/20">Publikasikan</button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <span class="material-symbols-outlined text-5xl text-slate-300 mb-3">event_busy</span>
                                            <p class="text-slate-500 font-medium">Belum ada event yang dibuat atau API tidak terhubung.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-12 grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="p-6 bg-white rounded-3xl border border-slate-100">
                    <div class="w-8 h-8 rounded-lg bg-slate-100 mb-4 flex items-center justify-center text-slate-400">
                        <span class="material-symbols-outlined text-sm">edit_note</span>
                    </div>
                    <h4 class="font-bold text-slate-900 text-sm mb-1">Draft</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">Event sedang dalam tahap persiapan dan belum dapat dilihat oleh peserta di aplikasi mobile.</p>
                </div>
                <div class="p-6 bg-white rounded-3xl border border-slate-100">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 mb-4 flex items-center justify-center text-emerald-600">
                        <span class="material-symbols-outlined text-sm">public</span>
                    </div>
                    <h4 class="font-bold text-slate-900 text-sm mb-1">Pendaftaran Dibuka (Open)</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">Event aktif dan peserta dapat melakukan pendaftaran serta memilih tempat duduk.</p>
                </div>
                <div class="p-6 bg-white rounded-3xl border border-slate-100">
                    <div class="w-8 h-8 rounded-lg bg-amber-100 mb-4 flex items-center justify-center text-amber-600">
                        <span class="material-symbols-outlined text-sm">lock_person</span>
                    </div>
                    <h4 class="font-bold text-slate-900 text-sm mb-1">Pendaftaran Ditutup (Closed)</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">Pendaftaran telah berakhir. Admin fokus pada persiapan gate control dan check-in.</p>
                </div>
                <div class="p-6 bg-white rounded-3xl border border-slate-100">
                    <div class="w-8 h-8 rounded-lg bg-cyan-100 mb-4 flex items-center justify-center text-cyan-600">
                        <span class="material-symbols-outlined text-sm">verified</span>
                    </div>
                    <h4 class="font-bold text-slate-900 text-sm mb-1">Event Selesai (Finished)</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">Tahap akhir di mana sistem akan mulai menghasilkan sertifikat digital bagi peserta yang hadir.</p>
                </div>
            </div>
        </div>
    </main>
@endsection