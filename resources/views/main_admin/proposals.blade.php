@extends('layout.app')

@section('title', 'Proposals')

@section('content')
    <main class="ml-72 min-h-screen flex flex-col font-inter">
        <div class="p-10 max-w-[1400px] mx-auto w-full">
            
            <div class="mb-10">
                <h2 class="text-3xl font-black font-headline text-slate-900 tracking-tight">Proposal Event</h2>
                <p class="text-slate-500 mt-2 font-medium">Tinjau dan kelola submission Event dari pengguna mobile.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:border-amber-100 transition-colors">
                    <div class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Menunggu Tinjauan</div>
                    <div class="text-3xl font-black text-amber-600">{{ $stats['pending'] ?? 0 }}</div>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:border-emerald-100 transition-colors">
                    <div class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Disetujui</div>
                    <div class="text-3xl font-black text-emerald-600">{{ $stats['approved'] ?? 0 }}</div>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:border-rose-100 transition-colors">
                    <div class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Ditolak</div>
                    <div class="text-3xl font-black text-rose-600">{{ $stats['rejected'] ?? 0 }}</div>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-8 p-4 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center gap-3 animate-fade-in">
                    <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                    <p class="text-sm font-bold text-emerald-700">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-[10px] uppercase tracking-[0.2em] text-slate-400 font-black border-b border-slate-100">
                                <th class="p-6 pl-10">Proposal Event</th>
                                <th class="p-6">Status Biaya</th> 
                                <th class="p-6">Penyusun</th>
                                <th class="p-6">Status</th>
                                <th class="p-6 pr-10 text-right">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-100">
                            @forelse($proposals as $prop)
                                @php $status = $prop['status'] ?? ''; @endphp
                                <tr class="hover:bg-slate-50/50 transition-colors {{ $status == 'pending' ? 'bg-amber-50/10' : '' }}">
                                    <td class="p-6 pl-10">
                                        <div class="font-black text-slate-900 text-lg">{{ $prop['title'] ?? 'Tanpa Judul' }}</div>
                                        <div class="text-[10px] text-cyan-600 font-black uppercase tracking-widest mt-1">
                                            Kategori: {{ $prop['category'] ?? 'Umum' }}
                                        </div>
                                    </td>
                                    <td class="p-6">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-slate-900">{{ ($prop['ticket_type'] ?? '') == 'Paid' ? 'Berbayar' : 'Gratis' }}</span>
                                            <span class="text-xs text-slate-500 font-medium">{{ ($prop['ticket_type'] ?? '') == 'Paid' ? 'Rp ' . number_format($prop['price'] ?? 0, 0, ',', '.') : '-' }}</span>
                                        </div>
                                    </td>
                                    <td class="p-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-sm font-black text-slate-600 ring-2 ring-white shadow-sm border border-slate-200">
                                                {{ strtoupper(substr($prop['organizer_name'] ?? 'U', 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-900">{{ $prop['organizer_name'] ?? 'Unknown' }}</div>
                                                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">
                                                    @if(!empty($prop['created_at']))
                                                        {{ \Carbon\Carbon::parse($prop['created_at'])->format('d M Y') }}
                                                    @else
                                                        -
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-6">
                                        @if($status == 'pending')
                                            <span class="px-4 py-1.5 bg-amber-50 text-amber-600 text-[10px] font-black rounded-full border border-amber-100 uppercase tracking-widest">Menunggu</span>
                                        @elseif($status == 'approved')
                                            <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-full border border-emerald-100 uppercase tracking-widest">Disetujui</span>
                                        @else
                                            <span class="px-4 py-1.5 bg-rose-50 text-rose-600 text-[10px] font-black rounded-full border border-rose-100 uppercase tracking-widest">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="p-6 pr-10 text-right">
                                        <div class="flex justify-end gap-2 items-center">
                                            @if($status == 'pending')
                                                <form action="{{ url('/admin/proposals/' . ($prop['id'] ?? 0) . '/status') }}" method="POST" class="m-0">
                                                    @csrf
                                                    <input type="hidden" name="action" value="approved">
                                                    <button type="submit" class="p-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-600 rounded-lg transition-colors cursor-pointer border border-transparent hover:border-emerald-200" title="Setujui">
                                                        <span class="material-symbols-outlined text-xl">check_circle</span>
                                                    </button>
                                                </form>

                                                <form action="{{ url('/admin/proposals/' . ($prop['id'] ?? 0) . '/status') }}" method="POST" class="m-0">
                                                    @csrf
                                                    <input type="hidden" name="action" value="rejected">
                                                    <button type="submit" class="p-2 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-lg transition-colors cursor-pointer border border-transparent hover:border-rose-200" title="Tolak">
                                                        <span class="material-symbols-outlined text-xl">cancel</span>
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <button onclick="openModal({{ json_encode($prop) }})" class="p-2 bg-slate-50 hover:bg-slate-200 text-slate-500 rounded-lg transition-colors cursor-pointer border border-transparent hover:border-slate-300 ml-1" title="Lihat Detail Proposal">
                                                <span class="material-symbols-outlined text-xl">visibility</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-12 text-center text-slate-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                                <span class="material-symbols-outlined text-3xl text-slate-300">inbox</span>
                                            </div>
                                            <p class="text-slate-500 font-bold text-sm">Belum ada proposal yang masuk.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="proposalModal" class="fixed inset-0 z-[60] hidden overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen px-4">
                    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
                    
                    <div class="relative bg-white rounded-[2.5rem] shadow-2xl w-full max-w-2xl overflow-hidden animate-fade-in my-8">
                        
                        <div class="primary-gradient p-8 text-white">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="text-[10px] font-black uppercase tracking-[0.2em] opacity-80">Detail Spesifikasi Event</span>
                                    <h3 id="modal-title" class="text-2xl font-black font-headline mt-1 tracking-tight">Judul Proposal</h3>
                                </div>
                                <button type="button" onclick="closeModal()" class="hover:rotate-90 transition-transform cursor-pointer opacity-80 hover:opacity-100">
                                    <span class="material-symbols-outlined text-3xl">close</span>
                                </button>
                            </div>
                        </div>

                        <div class="p-8 space-y-6">
                            <div class="grid grid-cols-2 gap-x-6 gap-y-8">
                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kategori</label>
                                    <p id="modal-category" class="font-bold text-slate-900 mt-1">Seminar</p>
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Status Biaya</label>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span id="modal-price-badge" class="px-2 py-0.5 bg-cyan-100 text-cyan-700 text-[10px] font-black rounded-md uppercase">Paid Event</span>
                                        <p id="modal-price" class="font-bold text-slate-900">Rp 0</p>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kapasitas Peserta</label>
                                    <p id="modal-capacity" class="font-bold text-slate-900 mt-1">0 Orang</p>
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pelaksanaan Event</label>
                                    <p id="modal-date" class="font-bold text-slate-900 mt-1">-</p>
                                </div>
                                <div class="col-span-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Lokasi</label>
                                    <p id="modal-location" class="font-bold text-slate-900 mt-1 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm text-cyan-600">location_on</span>
                                        <span>-</span>
                                    </p>
                                </div>
                            </div>

                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Deskripsi Event</label>
                                <p id="modal-description" class="text-sm text-slate-600 mt-2 leading-relaxed bg-slate-50 p-4 rounded-xl border border-slate-100">
                                    Deskripsi...
                                </p>
                            </div>

                            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-cyan-600">picture_as_pdf</span>
                                    <div>
                                        <p class="text-sm font-bold text-slate-900">Proposal_Event.pdf</p>
                                        <p class="text-[10px] font-medium text-slate-400">Lampiran Tambahan</p>
                                    </div>
                                </div>
                                <button class="text-cyan-600 font-bold text-xs hover:underline cursor-pointer">LIHAT FILE</button>
                            </div>
                        </div>

                        <div class="p-8 pt-0 flex gap-4" id="modal-actions-container">
                            <form id="modal-approve-form" action="" method="POST" class="flex-1 m-0">
                                @csrf
                                <input type="hidden" name="action" value="approved">
                                <button type="submit" class="w-full py-4 rounded-2xl font-bold bg-emerald-50 text-emerald-600 border border-emerald-100 hover:bg-emerald-100 hover:border-emerald-200 transition-colors text-xs uppercase tracking-widest cursor-pointer shadow-sm">
                                    APPROVE SEKARANG
                                </button>
                            </form>

                            <form id="modal-reject-form" action="" method="POST" class="flex-1 m-0">
                                @csrf
                                <input type="hidden" name="action" value="rejected">
                                <button type="submit" class="w-full py-4 rounded-2xl font-bold bg-rose-50 text-rose-600 border border-rose-100 hover:bg-rose-100 hover:border-rose-200 transition-colors text-xs uppercase tracking-widest cursor-pointer shadow-sm">
                                    TOLAK PERMOHONAN
                                </button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
        
        <style>
            @keyframes fade-in {
                from { opacity: 0; transform: translateY(-10px) scale(0.98); }
                to { opacity: 1; transform: translateY(0) scale(1); }
            }
            .animate-fade-in { animation: fade-in 0.2s ease-out forwards; }
            .primary-gradient { background: linear-gradient(135deg, #006876 0%, #00bcd4 100%); }
        </style>
    </main>

<script>
    function openModal(proposalData) { 
        // Render Teks Dinamis
        document.getElementById('modal-title').innerText = proposalData.title || 'Tanpa Judul';
        document.getElementById('modal-category').innerText = proposalData.category || 'Umum';
        document.getElementById('modal-capacity').innerText = (proposalData.total_capacity || 0) + ' Orang';
        document.getElementById('modal-date').innerText = proposalData.date_start ? proposalData.date_start : '-';
        document.querySelector('#modal-location span:last-child').innerText = proposalData.venue_name || 'Belum Ditentukan';
        document.getElementById('modal-description').innerText = proposalData.description || 'Tidak ada deskripsi rinci dari penyusun.';
        
        // Pengkondisian Jenis Tiket & Badge Harga
        const priceBadge = document.getElementById('modal-price-badge');
        const priceText = document.getElementById('modal-price');

        if (proposalData.ticket_type === 'Paid' || proposalData.base_price > 0) {
            priceBadge.innerText = 'Paid Event';
            priceBadge.className = "px-2 py-0.5 bg-cyan-100 text-cyan-700 text-[10px] font-black rounded-md uppercase";
            priceText.innerText = 'Rp ' + parseInt(proposalData.base_price || proposalData.price || 0).toLocaleString('id-ID');
        } else {
            priceBadge.innerText = 'Free Event';
            priceBadge.className = "px-2 py-0.5 bg-emerald-100 text-emerald-700 text-[10px] font-black rounded-md uppercase";
            priceText.innerText = 'Gratis';
        }

        // Atur URL Action dinamis ke Form, atau sembunyikan tombol jika event bukan status pending
        const actionContainer = document.getElementById('modal-actions-container');
        if(proposalData.status === 'pending') {
            actionContainer.style.display = 'flex';
            const baseUrl = "{{ url('/admin/proposals') }}";
            document.getElementById('modal-approve-form').action = `${baseUrl}/${proposalData.id}/status`;
            document.getElementById('modal-reject-form').action = `${baseUrl}/${proposalData.id}/status`;
        } else {
            actionContainer.style.display = 'none'; // Sembunyikan tombol approve/reject jika sudah diproses
        }

        // Tampilkan Modal
        document.getElementById('proposalModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() { 
        document.getElementById('proposalModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
</script>
@endsection