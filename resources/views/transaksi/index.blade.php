<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 justify-center">
                    
                    <form class="max-w-lg mx-auto" action="{{route("transaksi.index")}}" method="get">
                        <div class="flex">
                            <select id="status-select" name="status" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" required>
                                <option value="{{ request('status') }}" hidden default>
                                    @if ( request('status') == 'all')
                                        Semua status
                                    @elseif ( request('status') == 'progress')
                                        Dirental
                                    @elseif ( request('status') == 'late')
                                        Terlambat
                                    @elseif ( request('status') == 'canceled')
                                        Dibatalkan
                                    @elseif ( request('status') == 'complated')
                                        Selesai
                                    @else
                                        Pilih Status
                                    @endif
                                </option>
                                <option value="all">Semua status</option>
                                <option value="progress">Dirental</option>
                                <option value="late">Terlambat</option>
                                <option value="canceled">Dibatalkan</option>
                                <option value="completed">Selesai</option>
                            </select>
                            <div class="relative w-full">
                                <input type="search" name="nama" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Cari Nama Pemesan..." value="{{ request('nama') }}"/>
                                <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                    <span class="sr-only">Search</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>       
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 justify-center">
                    @foreach ($transaksis as $transaksi)
                    <a href="{{route("transaksi.detail", $transaksi->kode_transaksi)}}" class="flex flex-col mb-4 items-center m-auto bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-3xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="{{asset('storage/'.$transaksi->produk->first() -> gambar)}}" alt="">
                        <div class="flex flex-col justify-between p-4 leading-normal w-full">
                            <header>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-bold tracking-tight text-gray-900 dark:text-white">{{$transaksi -> kode_transaksi}}</span>
                                    @if ($transaksi -> status_rental == 'completed')
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Selesai</span>
                                    @elseif ($transaksi -> status_rental == 'canceled')
                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Dibatalkan</span>
                                    @elseif ($transaksi -> status_rental == 'progress')
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Dirental</span>
                                    @else

                                    @endif
                                </div>
                                <hr class="h-px bg-gray-400 border-0 dark:bg-gray-700 mb-2">
                            </header>
                            <p class="text-gray-900 dark:text-gray-900 font-bold">Nama pemesan: {{$transaksi->member->nama}}</p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">+{{$transaksi -> detail_transaksis_count}} Produk lainnya</p>
                            <span class="flex justify-end text-sm font-bold tracking-tight text-gray-900 dark:text-white">{{$transaksi -> tgl_sewa}} ~ {{$transaksi -> tgl_pengembalian}}</span>
                            <footer class="mt-1">
                            <hr class="h-px bg-gray-400 border-0 dark:bg-gray-700">
                                <div class="flex justify-between">
                                    <div>
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Total Pembayaran </span>
                                        <span class="text-sm text-gray-600 dark:text-gray-400 font-bold">Rp.{{number_format($transaksi->harga_total - $transaksi->dp_dibayarkan + $transaksi->denda, 2, ',', '.') }}</span>
                                    </div>
                                    <div>
                                        <input disabled <?= ($transaksi->dp_dibayarkan > 0) ? 'checked' : '';  ?> id="disabled-checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="use DP" class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">DP</label>
                                    </div>
                                </div>
                            </footer>
                        </div>
                    </a>
                    @endforeach
                    <div class="pagination m-4">
                        {{ $transaksis->links() }}
                    </div> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

