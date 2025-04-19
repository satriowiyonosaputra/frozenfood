<div class="max-w-2xl mx-auto space-y-10">
    {{-- Notifikasi Sukses --}}
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-xl mx-auto">
        <div class="text-center ">
            <div class="relative flex flex-col items-center">
                <h1 class="text-5xl font-bold dark:text-gray-500"> Jelajahi <span class="text-blue-500"> Kategori
                    </span> </h1>
                <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                    <div class="flex-1 h-2 bg-blue-200">
                    </div>
                    <div class="flex-1 h-2 bg-blue-400">
                    </div>
                    <div class="flex-1 h-2 bg-blue-600">
                    </div>
                </div>
            </div>
            <p class="mb-12 text-base text-center text-white-500">
                Jelajahi berbagai kategori frozen food untuk memenuhi kebutuhan harianmu! Mulai dari makanan siap
                saji, daging olahan, seafood, sayuran beku, hingga camilan lezat—semua tersedia dalam satu tempat.
                Pilih sesuai selera dan praktis untuk disajikan kapan saja!
            </p>
        </div>
    </div>

    {{-- Form Komentar --}}
    <form wire:submit.prevent="submit" class="space-y-4 bg-blue-100 p-6 rounded shadow-md border">
        <h3 class="text-xl font-bold text-gray-800">Tinggalkan Komentar</h3>

        <div>
            <input
                type="text"
                wire:model="name"
                placeholder="Nama"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
            @error('name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <textarea
                wire:model="message"
                placeholder="Komentar"
                rows="4"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            ></textarea>
            @error('message')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded shadow"
        >
            Kirim Komentar
        </button>
    </form>

    {{-- Daftar Komentar --}}
    <div class="bg-blue-100 shadow-lg rounded-lg p-6 border border-gray-200">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">Komentar Pengunjung</h2>

        <div class="space-y-5">
            @forelse ($comments as $comment)
                <div class="bg-gray-100 rounded-md p-4 shadow-sm relative">
                    <div class="flex justify-between items-start">
                        <div>
                            <h5 class="font-semibold text-gray-800">{{ $comment->name }}</h5>
                            <p class="text-gray-700 mt-1 break-words">{!! nl2br(e($comment->message)) !!}</p>
                            <small class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>
                        </div>

                        <button
                            onclick="confirm('Yakin ingin menghapus komentar ini?') || event.stopImmediatePropagation()"
                            wire:click="delete({{ $comment->id }})"
                            class="text-red-500 hover:text-red-700 text-sm absolute top-2 right-2"
                        >
                            Hapus
                        </button>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 italic">Belum ada komentar yang ditampilkan.</p>
            @endforelse
        </div>
    </div>
</div>
