<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <a href="{{ route("transaksi.index") }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ __('Transaksi') }}</a>&nbsp;/&nbsp; <a href="{{route("transaksi.detail", $kode_transaksi)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ $kode_transaksi }}</a>&nbsp;/&nbsp; {{ __('Insiden') }}
            </h2>
            <a href="{{route("transaksi.detail", $kode_transaksi)}}" class="relative inline-flex items-center justify-center p-0.5  overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
            Kembali
            </span>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <x-toast type="success" :messages="[session('success')]" />
            @elseif(session('errors'))
                <x-toast type="error" :messages="session('errors')->all()" />
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight m-4">
                        Semua Produk
                    </h2>
                    <?php
                        $totalHarga = 0;
                    ?>
                    <form action="{{route("transaksi.storeInsiden", $kode_transaksi)}}" method="post">
                    @csrf
                    @method('PATCH')
                    @foreach ($detailTransaksis as $detail)
                        <input type="hidden" name="stok_id[]" value="{{$detail->stok_id}}">
                        <input type="hidden" name="produk_id[]" value="{{$detail->produk_id}}">
                        <input type="hidden" name="transaksi_id[]" value="{{$detail->transaksi_id}}">
                        <input type="hidden" name="detail_id[]" value="{{$detail->id}}">
                        <input type="hidden" name="member_id[]" value="{{$detail->member_id}}">
                        <input type="hidden" name="qty_produk[]" value="{{$detail->qty}}">
                        <div class="flex flex-col mb-4 items-center m-auto bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-3xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="{{asset('storage/'.$detail-> produk -> gambar)}}" alt="">
                            <div x-data="{qty{{$detail->id}} : 0, maxQty{{$detail->id}}: {{$detail->qty}}, minQty: 0}" class="flex flex-col justify-between p-4 leading-normal w-full">
                                <div class="flex justify-between items-center">
                                    <p class="text-gray-900 dark:text-gray-900 font-bold">{{$detail->produk->kode . ' - ' . $detail->produk->nama . ' - ' . $detail->stok->ukuran}}</p>
                                    <select name="jenis_insiden[]" :class="(qty{{$detail->id}} == 0 ? 'text-gray-600' : 'text-red-600')" class="bg-gray-50 border border-gray-300 font-normal text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block max-w-32 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="rusak" selected>Rusak</option>
                                        <option value="hilang">Hilang</option>
                                    </select>
                                </div>
                                <div class="flex justify-between items-center mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    <p>{{$detail->qty}} &times;
                                        <?php
                                            $hargaDisc = $detail -> harga_at - ($detail -> harga_at * $detail -> diskon_at);

                                            $totalHarga += $detail->harga_at*$detail->qty;
                                        ?>
                                        @if ($detail->diskon_at > 0)
                                            <span class="line-through">
                                                Rp.{{number_format($detail -> harga_at, 2, ',', '.') }}
                                            </span>
                                            &nbsp;
                                            <span class="text-green-500">
                                                Rp.{{number_format($hargaDisc, 2, ',', '.') }}
                                            </span>
                                            @else
                                            <span>
                                                Rp.{{number_format($detail -> harga_at, 2, ',', '.') }}
                                            </span>
                                        @endif 
                                    </p>
                                        
                                    <div class="max-w-xs">
                                        <div class="relative flex max-w-40">
                                            <button @click="qty{{$detail->id}} = Math.max(qty{{$detail->id}} - 1, minQty)" type="button" data-input-counter-decrement="qty-input{{$detail -> id}}" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                                </svg>
                                            </button>
                                            <input name="jumlah[]" type="text" id="qty-input{{$detail -> id}}" data-input-counter data-input-counter-min="0" data-input-counter-max="{{$detail -> qty}}" aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 font-medium text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pb-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" value="0" required />
                                            <div class="absolute bottom-1 start-1/2 -translate-x-1/2 rtl:translate-x-1/2 flex items-center text-xs text-gray-400 space-x-1 rtl:space-x-reverse">
                                                <span>Qty</span>
                                            </div>
                                            <button @click="qty{{$detail->id}} = Math.min(qty{{$detail->id}} + 1, maxQty{{$detail->id}})" type="button" data-input-counter-increment="qty-input{{$detail -> id}}" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <footer class="mt-1">
                                    <hr class="h-px bg-gray-400 border-0 dark:bg-gray-700">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <span class="text-sm text-gray-600 dark:text-gray-400">Total harga </span>
                                            <span class="text-sm text-gray-600 dark:text-gray-400 font-bold">Rp.{{number_format($hargaDisc * $detail->qty, 2, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </footer>
                            </div>
                        </div>
                        <div class="md:max-w-3xl items-center mx-auto my-8">
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi {{$detail->produk->kode . ' - ' . $detail->produk->nama . ' - ' . $detail->stok->ukuran}}</label>
                            <textarea name="deskripsi[]" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ketik masalah pada Produk jika ada..."></textarea>
                        </div>
                    @endforeach
                        <div class="md:max-w-3xl items-center mx-auto my-8">
                            <label for="denda" class="block mb-2 text-sm font-medium text-red-700 dark:text-red-500 float-left">Denda</label>
                            <input name="denda" type="number" id="denda" class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500" placeholder="0" min="0">
                            <p class="my-2 text-xs text-red-600 dark:text-red-500 float-left">Total denda <span class="font-medium">yang harus dibayar pemesan untuk ganti rugi produk barang.</span></p>
                        </div>
                        <div class="flex justify-around mt-12">
                            <!-- kembali -->
                            <a href="{{route("transaksi.detail", $kode_transaksi)}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kembali</a>
                            <!-- confirm -->
                            <button data-modal-target="confirm-modal" data-modal-toggle="confirm-modal" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Konfirmasi Dikembalikan</button>

                            <div id="confirm-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="confirm-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <h5 class="my-5 text-base font-normal text-gray-500 dark:text-gray-400">
                                                Barang produk akan dikurangi dari stok produk, dan status transaksi <span class="font-bold text-green-500">Selesai.</span>
                                            </h5>
                                            <svg class="mx-auto mb-4 text-gray-400 w-24 h-24 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                            </svg>

                                            <h3 class="my-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin ingin konfirmasi Transaksi ini?</h3>
                                            <button data-modal-hide="confirm-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Ya, saya yakin.
                                            </button>
                                            <button data-modal-hide="confirm-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Tidak, batalkan.</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
