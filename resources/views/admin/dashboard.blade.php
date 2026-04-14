<x-app-layout>
    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #020617; }
        ::-webkit-scrollbar-thumb { background: #0891b2; border-radius: 10px; }
        
        /* Glassmorphism Effect */
        .glass-card {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        
        /* Input Styling */
        .input-cyber {
            background: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            transition: all 0.3s ease;
        }
        .input-cyber:focus {
            border-color: #06b6d4 !important;
            box-shadow: 0 0 15px rgba(6, 182, 212, 0.2) !important;
            background: rgba(255, 255, 255, 0.07) !important;
        }

        /* Animation */
        @keyframes pulse-slow {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.6; }
        }
        .animate-pulse-slow { animation: pulse-slow 8s infinite; }
    </style>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-black tracking-tighter text-white">
                <span class="text-cyan-500">ADMIN</span> CENTRAL
            </h2>
            <div class="px-4 py-1.5 bg-cyan-500/10 border border-cyan-500/20 rounded-full text-cyan-400 text-xs font-bold uppercase tracking-widest backdrop-blur-md">
                {{ now()->format('l, d F Y') }}
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen text-white px-6 py-10 bg-[#020617] relative overflow-hidden">
        
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-cyan-600/10 blur-[120px] rounded-full animate-pulse-slow"></div>
        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-indigo-600/10 blur-[120px] rounded-full animate-pulse-slow"></div>

        <div class="relative z-10 max-w-7xl mx-auto space-y-8">

            @if (session('success'))
                <div class="glass-card border-l-4 border-cyan-500 px-6 py-4 rounded-2xl flex items-center animate-fade-in">
                    <span class="text-cyan-500 mr-3 text-xl">✓</span>
                    <span class="font-semibold text-cyan-100">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="glass-card p-6 rounded-[2rem] border-t border-white/10 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-slate-400 text-xs font-black uppercase tracking-widest">Total Reports</h3>
                            <p class="text-5xl font-black mt-2 text-white">{{ $aspirasis->count() }}</p>
                        </div>
                        <div class="p-3 bg-cyan-500/10 rounded-2xl group-hover:bg-cyan-500/20 transition-all text-2xl">📁</div>
                    </div>
                    <div class="mt-4 flex items-center text-xs text-cyan-400 font-bold">
                        <span>Sistem Aktif</span>
                        <div class="ml-2 w-2 h-2 bg-cyan-500 rounded-full animate-ping"></div>
                    </div>
                </div>

                <div class="glass-card p-6 rounded-[2rem] border-t border-white/10 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-slate-400 text-xs font-black uppercase tracking-widest">Awaiting</h3>
                            <p class="text-5xl font-black mt-2 text-amber-400">
                                {{ $aspirasis->where('status','pending')->count() }}
                            </p>
                        </div>
                        <div class="p-3 bg-amber-500/10 rounded-2xl group-hover:bg-amber-500/20 transition-all text-2xl">⏳</div>
                    </div>
                    <div class="mt-4 h-1.5 w-full bg-white/5 rounded-full overflow-hidden">
                        @php $p = $aspirasis->count() > 0 ? ($aspirasis->where('status','pending')->count() / $aspirasis->count()) * 100 : 0; @endphp
                        <div class="h-full bg-amber-500 shadow-[0_0_10px_#f59e0b]" style="width: {{ $p }}%"></div>
                    </div>
                </div>

                <div class="glass-card p-6 rounded-[2rem] border-t border-white/10 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-slate-400 text-xs font-black uppercase tracking-widest">Resolved</h3>
                            <p class="text-5xl font-black mt-2 text-cyan-400">
                                {{ $aspirasis->where('status','done')->count() }}
                            </p>
                        </div>
                        <div class="p-3 bg-cyan-500/10 rounded-2xl group-hover:bg-cyan-500/20 transition-all text-2xl">✅</div>
                    </div>
                    <div class="mt-4 h-1.5 w-full bg-white/5 rounded-full overflow-hidden">
                        @php $d = $aspirasis->count() > 0 ? ($aspirasis->where('status','done')->count() / $aspirasis->count()) * 100 : 0; @endphp
                        <div class="h-full bg-cyan-500 shadow-[0_0_10px_#06b6d4]" style="width: {{ $d }}%"></div>
                    </div>
                </div>

            </div>

            <div class="glass-card p-6 rounded-[2rem]">
                <form action="{{ route('dashboard') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari laporan..."
                        class="input-cyber rounded-xl px-5 py-3 focus:ring-0 text-sm">

                    <select name="category_id" class="input-cyber rounded-xl px-5 py-3 focus:ring-0 text-sm appearance-none cursor-pointer">
                        <option value="" class="bg-[#0f172a]">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" class="bg-[#0f172a]">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>

                    <select name="status" class="input-cyber rounded-xl px-5 py-3 focus:ring-0 text-sm appearance-none cursor-pointer">
                        <option value="" class="bg-[#0f172a]">Semua Status</option>
                        <option value="pending" class="bg-[#0f172a]">Pending</option>
                        <option value="processing" class="bg-[#0f172a]">Processing</option>
                        <option value="done" class="bg-[#0f172a]">Done</option>
                    </select>

                    <button class="bg-cyan-600 hover:bg-cyan-500 text-white font-bold rounded-xl py-3 shadow-lg shadow-cyan-900/20 transition-all active:scale-95">
                        APPLY FILTER
                    </button>
                </form>
            </div>

            <div class="glass-card rounded-[2rem] overflow-hidden border border-white/5">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-white/5 text-slate-400 text-[10px] font-black uppercase tracking-[0.2em]">
                                <th class="px-8 py-5">Reporter</th>
                                <th class="px-8 py-5">Classification</th>
                                <th class="px-8 py-5">Message</th>
                                <th class="px-8 py-5 text-center">Process</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach ($aspirasis as $row)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center font-black shadow-lg">
                                            {{ substr($row->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-white">{{ $row->user->name }}</div>
                                            <div class="text-cyan-500/60 text-[10px] font-bold">#{{ $row->user->username }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-8 py-6">
                                    <span class="px-2 py-0.5 rounded bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 text-[9px] font-black uppercase tracking-wider">
                                        {{ $row->category->category_name }}
                                    </span>
                                    <div class="text-slate-500 text-[10px] mt-2 flex items-center">
                                        <span class="mr-1 text-cyan-500">📍</span> {{ $row->location }}
                                    </div>
                                    <div class="mt-2">
                                        @if ($row->status == 'pending')
                                            <span class="text-amber-500 text-[10px] font-black uppercase italic">● Awaiting</span>
                                        @elseif ($row->status == 'processing')
                                            <span class="text-blue-400 text-[10px] font-black uppercase italic">● Processing</span>
                                        @else
                                            <span class="text-cyan-400 text-[10px] font-black uppercase italic">● Resolved</span>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-8 py-6">
                                    <p class="text-slate-300 text-sm leading-relaxed line-clamp-2 italic">
                                        "{{ $row->description }}"
                                    </p>
                                    <div class="text-[9px] text-slate-500 mt-2 font-bold uppercase tracking-widest">
                                        {{ $row->created_at->diffForHumans() }}
                                    </div>
                                </td>

                                <td class="px-8 py-6">
                                    <div class="bg-[#020617] p-4 rounded-2xl border border-white/5">
                                        <form action="{{ route('aspirasi.update', $row->id) }}" method="POST" class="space-y-3">
                                            @csrf
                                            <select name="status" class="w-full bg-slate-900 border-white/10 text-white rounded-lg text-[10px] font-bold focus:ring-cyan-500">
                                                <option value="pending" {{ $row->status == 'pending' ? 'selected' : '' }}>PENDING</option>
                                                <option value="processing" {{ $row->status == 'processing' ? 'selected' : '' }}>PROCESSING</option>
                                                <option value="done" {{ $row->status == 'done' ? 'selected' : '' }}>DONE</option>
                                            </select>

                                            <textarea name="feedback" rows="2"
                                                class="w-full bg-slate-900 border-white/10 text-white placeholder-slate-600 rounded-lg text-[10px] focus:ring-cyan-500"
                                                placeholder="Tulis tanggapan..." required>{{ $row->feedback->content ?? '' }}</textarea>

                                            <button class="w-full bg-cyan-600 hover:bg-cyan-500 text-white font-black py-2 rounded-lg text-[10px] transition uppercase tracking-widest">
                                                Update
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="pt-10 pb-6 text-center">
                <p class="text-slate-600 text-[10px] font-black uppercase tracking-[0.3em]">
                    Central Administration Terminal &copy; {{ date('Y') }}
                </p>
            </div>
        </div>
    </div>
</x-app-layout>