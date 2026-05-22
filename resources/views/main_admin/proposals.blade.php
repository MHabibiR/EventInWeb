<@extends('layout.app')

@section('title', 'Proposals')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col">
        <div class="p-10 max-w-[1400px] mx-auto w-full">
            <div class="mb-10">
                <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Proposal Event</h2>
                <p class="text-slate-500 mt-2 font-medium">Tinjau dan kelola submission Event dari pengguna mobile.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">Menunggu Tinjauan</div>
                    <div class="text-3xl font-black text-amber-600">{{ $stats['pending'] ?? 0 }}</div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">Disetujui</div>
                    <div class="text-3xl font-black text-emerald-600">{{ $stats['approved'] ?? 0 }}</div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">Ditolak</div>
                    <div class="text-3xl font-black text-rose-600">{{ $stats['rejected'] ?? 0 }}</div>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center gap-3">
                    <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                    <p class="text-sm font-bold text-emerald-700">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-xs uppercase tracking-wider text-slate-400 font-bold">
                                <th class="p-4 pl-6">Proposal Event</th>
                                <th class="p-4">Status Biaya</th> <th class="p-4">Penyusun</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 pr-6 text-right">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-100">
                            @forelse($proposals as $prop)
                            <tr class="hover:bg-slate-50/50 transition-colors {{ $prop['status'] == 'pending' ? 'bg-amber-50/10' : '' }}">
                                <td class="p-4 pl-6">
                                    <div class="font-bold text-slate-900">{{ $prop['title'] }}</div>
                                    <div class="text-xs text-cyan-600 font-medium">Kategori: {{ $prop['category'] ?? 'Umum' }}</div>
                                </td>
                                <td class="p-4">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-900">{{ $prop['ticket_type'] == 'Paid' ? 'Berbayar' : 'Gratis' }}</span>
                                        <span class="text-xs text-slate-500">{{ $prop['ticket_type'] == 'Paid' ? 'Rp ' . number_format($prop['price'], 0, ',', '.') : '-' }}</span>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-600">
                                            {{ substr($prop['organizer_name'], 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-medium">{{ $prop['organizer_name'] }}</div>
                                            <div class="text-xs text-slate-400 text-[10px]">{{ \Carbon\Carbon::parse($prop['created_at'])->format('d M Y') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    @if($prop['status'] == 'pending')
                                        <span class="px-2.5 py-1 bg-amber-50 text-amber-600 text-[10px] font-black rounded-md uppercase">Menunggu</span>
                                    @elseif($prop['status'] == 'approved')
                                        <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-md uppercase">Disetujui</span>
                                    @else
                                        <span class="px-2.5 py-1 bg-rose-50 text-rose-600 text-[10px] font-black rounded-md uppercase">Ditolak</span>
                                    @endif
                                </td>
                                <td class="p-4 pr-6 text-right flex justify-end gap-2">
                                    
                                    <button onclick="openModal({{ json_encode($prop) }})" class="p-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg transition-colors" title="Lihat Detail Proposal">
                                        <span class="material-symbols-outlined text-xl">visibility</span>
                                    </button>

                                    @if($prop['status'] == 'pending')
                                        <form action="{{ url('/admin/proposals/' . $prop['id'] . '/status') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="action" value="approved">
                                            <button type="submit" class="p-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-600 rounded-lg transition-colors" title="Setujui">
                                                <span class="material-symbols-outlined text-xl">check_circle</span>
                                            </button>
                                        </form>

                                        <form action="{{ url('/admin/proposals/' . $prop['id'] . '/status') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="action" value="rejected">
                                            <button type="submit" class="p-2 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-lg transition-colors" title="Tolak">
                                                <span class="material-symbols-outlined text-xl">cancel</span>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-400">Belum ada proposal yang masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="proposalModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm hidden animate-fade-in">
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl w-full max-w-2xl overflow-hidden mx-4 max-h-[90vh] flex flex-col">
                    <div class="p-8 pb-4 flex justify-between items-start border-b border-slate-50">
                        <div>
                            <span id="modal-price-badge" class="px-3 py-1 bg-cyan-50 text-cyan-600 text-[10px] font-black rounded-full uppercase tracking-widest border border-cyan-100">Free Event</span>
                            <h3 id="modal-title" class="text-2xl font-black font-headline text-slate-900 tracking-tight mt-3">Judul Proposal Event</h3>
                            <p id="modal-category" class="text-xs text-cyan-600 font-bold mt-1 uppercase tracking-wider">Kategori</p>
                        </div>
                        <button onclick="closeModal()" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-xl transition-all">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>

                    <div class="p-8 space-y-6 overflow-y-auto flex-1">
                        <div class="grid grid-cols-2 gap-6 bg-slate-50 p-6 rounded-2xl border border-slate-100">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-slate-400">group</span>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Kapasitas</p>
                                    <p id="modal-capacity" class="text-sm font-bold text-slate-900">0 Orang</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-slate-400">payments</span>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Harga Tiket</p>
                                    <p id="modal-price" class="text-sm font-bold text-slate-900">-</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-slate-400">calendar_month</span>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Tanggal Pelaksanaan</p>
                                    <p id="modal-date" class="text-sm font-bold text-slate-900">-</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-slate-400">location_on</span>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Lokasi / Venue</p>
                                    <p id="modal-location" class="text-sm font-bold text-slate-900">-</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Deskripsi Acara</h4>
                            <p id="modal-description" class="text-sm text-slate-600 leading-relaxed bg-slate-50/50 p-4 rounded-xl border border-slate-100/50">
                                Detail rincian deskripsi acara akan dimuat di sini secara otomatis.
                            </p>
                        </div>
                    </div>

                    <div class="p-8 pt-4 bg-slate-50 border-t border-slate-100 flex gap-4">
                        <form id="modal-approve-form" action="" method="POST" class="flex-1 m-0">
                            @csrf
                            <input type="hidden" name="action" value="approved">
                            <button type="submit" class="w-full py-4 rounded-2xl font-bold bg-emerald-500 text-white hover:bg-emerald-600 shadow-md shadow-emerald-500/20 transition-all text-xs uppercase tracking-widest">
                                APPROVE SEKARANG
                            </button>
                        </form>

                        <form id="modal-reject-form" action="" method="POST" class="flex-1 m-0">
                            @csrf
                            <input type="hidden" name="action" value="rejected">
                            <button type="submit" class="w-full py-4 rounded-2xl font-bold bg-rose-50 text-rose-600 hover:bg-rose-100 transition-colors text-xs uppercase tracking-widest">
                                TOLAK PERMOHONAN
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

<script>
    function openModal(proposalData) { 
        document.getElementById('modal-title').innerText = proposalData.title;
        document.getElementById('modal-category').innerText = 'Kategori: ' + (proposalData.category || 'Umum');
        document.getElementById('modal-capacity').innerText = (proposalData.total_capacity || 0) + ' Orang';
        document.getElementById('modal-date').innerText = proposalData.date_start;
        document.getElementById('modal-location').innerText = proposalData.venue_name || 'Belum Ditentukan';
        document.getElementById('modal-description').innerText = proposalData.description || 'Tidak ada deskripsi rinci.';
        
        /* Pengkondisian Jenis Tiket & Badge Harga */
        const priceBadge = document.getElementById('modal-price-badge');
        const priceText = document.getElementById('modal-price');

        if (proposalData.ticket_type === 'Paid' || proposalData.base_price > 0) {
            priceBadge.innerText = 'Paid Event';
            priceBadge.className = "px-3 py-1 bg-amber-50 text-amber-600 text-[10px] font-black rounded-full uppercase tracking-widest border border-amber-100";
            priceText.innerText = 'Rp ' + parseInt(proposalData.base_price || proposalData.price).toLocaleString('id-ID');
        } else {
            priceBadge.innerText = 'Free Event';
            priceBadge.className = "px-3 py-1 bg-cyan-50 text-cyan-600 text-[10px] font-black rounded-full uppercase tracking-widest border border-cyan-100";
            priceText.innerText = 'Gratis';
        }

        /* Ubah Atribut Action Form Secara Dinamis Menuju Route Controller */
        const baseUrl = "{{ url('/admin/proposals') }}";
        document.getElementById('modal-approve-form').action = `${baseUrl}/${proposalData.id}/status`;
        document.getElementById('modal-reject-form').action = `${baseUrl}/${proposalData.id}/status`;

        document.getElementById('proposalModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() { 
        document.getElementById('proposalModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
</script>
@endsection