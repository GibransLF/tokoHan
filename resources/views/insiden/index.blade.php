<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Insiden Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-table>
                        <x-slot name='header'>
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Produk
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jenis Insiden
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    deskripsi
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jumlah
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Kode Transaksi
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal
                                </th>
                            </tr>
                        </x-slot>

                        @foreach( $insidens as $insiden )
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $insiden->produk->kode.' - '.$insiden->produk->nama.' - '.$insiden->stok->ukuran }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $insiden -> jenis_insiden }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $insiden -> deskripsi }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $insiden -> jumlah }}
                            </td>
                            <td class="px-6 py-4">
                                <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="{{route("transaksi.detail", $insiden->transaksi->kode_transaksi)}}">{{$insiden->transaksi->kode_transaksi}}</a>
                            </td>
                            <td class="px-6 py-4">
                                {{ $insiden->created_at }}
                            </td>
                        </tr>
                        @endforeach

                    </x-table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
