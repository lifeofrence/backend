@extends('layouts.admin', ['title' => 'Dashboard Overview'])

@section('content')
    <div class="space-y-8">
        <!-- Welcome Section -->
        <div
            class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#DC833D] to-[#b06931] p-8 text-white shadow-xl shadow-[#DC833D]/20">
            <div class="relative z-10">
                <h3 class="text-3xl font-bold tracking-tight">Welcome back, {{ auth()->user()->name }}!</h3>
                <!-- <p class="mt-2 text-[#ffe3cc] max-w-md">Here's what's happening at Abuja International Hotels today. You can
                        manage all website content from this portal.</p> -->
            </div>
            <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/10 blur-3xl"></div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="card p-6 border-l-4 border-[#DC833D]">
                <p class="text-xs font-bold uppercase tracking-widest text-zinc-500 mb-1">Leadership</p>
                <div class="flex items-end justify-between">
                    <h4 class="text-3xl font-bold text-white">{{ $stats['leadership_count'] }}</h4>
                    <span class="text-[10px] text-zinc-500 font-medium">Active Members</span>
                </div>
            </div>

            <div class="card p-6 border-l-4 border-emerald-500">
                <p class="text-xs font-bold uppercase tracking-widest text-zinc-500 mb-1">Gallery</p>
                <div class="flex items-end justify-between">
                    <h4 class="text-3xl font-bold text-white">{{ $stats['gallery_count'] }}</h4>
                    <span class="text-[10px] text-zinc-500 font-medium">Total Images</span>
                </div>
            </div>

            <div class="card p-6 border-l-4 border-indigo-500">
                <p class="text-xs font-bold uppercase tracking-widest text-zinc-500 mb-1">Reports</p>
                <div class="flex items-end justify-between">
                    <h4 class="text-3xl font-bold text-white">{{ $stats['reports_count'] }}</h4>
                    <span class="text-[10px] text-zinc-500 font-medium">Published PDF's</span>
                </div>
            </div>

            <div class="card p-6 border-l-4 border-zinc-500">
                <p class="text-xs font-bold uppercase tracking-widest text-zinc-500 mb-1">Team</p>
                <div class="flex items-end justify-between">
                    <h4 class="text-3xl font-bold text-white">{{ $stats['users_count'] }}</h4>
                    <span class="text-[10px] text-zinc-500 font-medium">System Users</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Media -->
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center justify-between">
                    <h4 class="text-sm font-bold uppercase tracking-widest text-zinc-400">Recent Media</h4>
                    <a href="{{ route('admin.gallery.index') }}" class="text-xs text-[#DC833D] hover:underline">View All</a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($recent_gallery as $item)
                        <div class="aspect-square rounded-xl overflow-hidden glass border border-white/5 relative group">
                            <img src="{{ Storage::url($item->image_path) }}"
                                class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500"
                                alt="">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- System Users -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h4 class="text-sm font-bold uppercase tracking-widest text-zinc-400">Team Status</h4>
                    @role('Super Admin')
                    <a href="{{ route('admin.users.index') }}" class="text-xs text-[#DC833D] hover:underline">Manage</a>
                    @endrole
                </div>
                <div class="card p-4 divide-y divide-white/5">
                    @foreach($recent_users as $user)
                        <div class="flex items-center space-x-3 py-3 first:pt-0 last:pb-0">
                            <div
                                class="w-8 h-8 rounded-full bg-zinc-800 flex items-center justify-center text-[10px] font-bold text-zinc-400">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-white truncate">{{ $user->name }}</p>
                                <p class="text-[10px] text-zinc-500 truncate">{{ $user->email }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection