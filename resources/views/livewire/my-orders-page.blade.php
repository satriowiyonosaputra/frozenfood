<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-4xl font-bold text-black">Pesanan Saya</h1>
    <div class="flex flex-col bg-blue-100 p-5 rounded mt-4 shadow-lg">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-blue-100 dark:divide-blue-100">
                        <thead>
                            <tr>

                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-black-500 uppercase">Tanggal
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-black-500 uppercase">Status
                                    Pesanan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-black-500 uppercase">Status
                                    Pembayaran</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-black-500 uppercase">Total</th>
                                <th scope="col"
                                    class="px-6 py-3 text-end text-xs font-medium text-black-500 uppercase">Tindakan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @php
                                    $status = '';
                                    $payment_status = '';
                                    if ($order->status == 'new') {
                                        $status =
                                            '<span class="bg-blue-500 py-1 px-3 rounded text-black shadow">Baru</span>';
                                    } elseif ($order->status == 'processing') {
                                        $status =
                                            '<span class="bg-yellow-500 py-1 px-3 rounded text-black shadow">Sedang Diproses</span>';
                                    } elseif ($order->status == 'shipped') {
                                        $status =
                                            '<span class="bg-green-500 py-1 px-3 rounded text-black shadow">Dikirim</span>';
                                    } elseif ($order->status == 'delivered') {
                                        $status =
                                            '<span class="bg-white-700 py-1 px-3 rounded text-black shadow">Diterima</span>';
                                    } elseif ($order->status == 'cancelled') {
                                        $status =
                                            '<span class="bg-red-500 py-1 px-3 rounded text-black shadow">Dibatalkan</span>';
                                    }

                                    if ($order->payment_status == 'pending') {
                                        $payment_status =
                                            '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Menunggu</span>';
                                    }
                                    if ($order->payment_status == 'paid') {
                                        $payment_status =
                                            '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Dibayar</span>';
                                    }
                                    if ($order->payment_status == 'failed') {
                                        $payment_status =
                                            '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Gagal</span>';
                                    }
                                @endphp
                                <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-blue-100 dark:even:bg-blue-100"
                                    wire:key="{{ $order->id }}">
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium textblack dark:text-black">
                                        {{ $order->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-white-200">
                                        {{ $order->created_at->format('d-m-Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-white-200">
                                        {!! $status !!}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-white-200">
                                        {!! $payment_status !!}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-black">
                                        Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <a href="/my-orders/{{ $order->id }}"
                                            class="bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-500">Lihat
                                            Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
