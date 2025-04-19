<div>
    <div class="max-w-2xl mx-auto space-y-4">
        <div class="bg-white p-6 rounded shadow border">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">Komentar Pengunjung</h2>

            @forelse ($comments as $comment)
                <div class="bg-gray-100 p-4 rounded shadow-sm">
                    <h5 class="font-semibold text-gray-800">{{ $comment->name }}</h5>
                    <p class="text-gray-700 break-words mt-1">{!! nl2br(e($comment->message)) !!}</p>
                    <small class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
            @empty
                <p class="text-gray-500 italic">Belum ada komentar yang ditampilkan.</p>
            @endforelse
        </div>
    </div>

</div>
