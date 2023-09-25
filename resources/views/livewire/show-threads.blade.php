<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex gap-10 py-12">
    <div class="w-64">
        <a href="" class="block w-full py-4 mb-10 bg-gradient-to-r from-blue-600 to-blue-700 hover:to-blue-600 text-white/90 font-bold text-xs text-center  rounded-md">Preguntar</a>

        <ul>
            @foreach ($categories as $category)
            <li class="mb-2">
                <a href="#" wire:click.prevent="filterByCategory(' {{ $category->id }} ')" class="p-2 rounded-md flex bg-slate-800 items-center gap-2 text-white/60 hover:text-white font-semibold text-xs capitalize">
                    <span class="w-2 h-2 rounded-full" style="background-color: {{ $category->color }};"></span>
                    {{ $category->name }}
                </a>
            </li>
            @endforeach
            <li>
                <a href="#" wire:click.prevent="filterByCategory('')" class="p-2 rounded-md flex bg-slate-800 items-center gap-2 text-white/60 hover:text-white font-semibold text-xs">
                    <span class="w-2 h-2 rounded-full" style="background-color: #000;"></span>
                    Todos los resultados
                </a>
            </li>
        </ul>
    </div>
    <div class="w-full">
        <form class="mb-4">
            <input type="text" placeholder="// ..." class="bg-slate-800 border-0 rounded-md w-1/3 p-3 text-white/60 text-xs" wire:model.live="search">
        </form>

        @foreach ($threads as $thread)
        <div class="rounded-md bg-gradient-to-r from bg-slate-800 to-slate-900 hover:to-slate-800 mb-4">
            <div class="p-4 flex gap-4">
                <div>
                    <img src="{{ $thread->user->avatar() }}" alt="{{ $thread->user->name }}" class="rounded-md">
                </div>
                <div class="w-full">
                    <h2 class="mb-4 flex items-start justify-between">
                        <a href="{{ route('thread', $thread) }}" class="text-xl font-semibold text-white/90">
                            {{ $thread->title }}
                        </a>
                        <span class="rounded-full text-xs py-2 px-4 capitalize" style="color: {{ $thread->category->color }}; border: 1px solid {{ $thread->category->color }};">
                            {{ $thread->category->name }}
                        </span>
                    </h2>
                    <p class="flex items-center justify-between w-full text-xs">
                        <span class="text-blue-600 font-semibold">
                            {{ $thread->user->name }}
                            <span class="text-white/90">{{ $thread->created_at->diffForHumans() }}</span>
                        </span>
                        <span class="flex items-center gap-1 text-slate-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                            </svg>
                            {{ $thread->replies_count }} Respuesta{{ $thread->replies_count !==1 ? 's' : '' }}
                            |
                            <a href="" class="hover:text-white">Editar</a>
                        </span>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
