<div>
    <div class="max-w-xl mx-auto space-y-6">
        @if (session()->has('success'))
            <div class="bg-green-100 text-green-800 border border-green-300 p-3 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="submit" class="bg-white p-6 rounded shadow border space-y-4">
            <h3 class="text-2xl font-semibold text-gray-800">Tinggalkan Komen Anda Disini</h3>

            <input type="text" wire:model="name" placeholder="Nama"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror

            <textarea wire:model="message" placeholder="Komentar"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" rows="4"></textarea>
            @error('message') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow">
                Kirim Komentar
            </button>
        </form>
    </div>

</div>
