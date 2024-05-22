<x-app-layout>
    <x-slot name="header">
        <div class="flex item-center justify-between">
            <div class="flex items-center justify-start">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Order Produk') }}
                </h2>
            </div>

            <div class="flex items-center">
                <button id="dropdownCartButton" data-dropdown-toggle="dropdownCart" class="relative inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none dark:hover:text-white dark:text-gray-400 mx-10 ml-auto" type="button">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                    </svg>
                    <div class="absolute block w-3 h-3 bg-red-500 border-2 border-white rounded-full -top-0.5 start-2.5 dark:border-gray-900"></div>
                </button>
            </div>

            <!-- Dropdown menu -->
            <div id="dropdownCart" class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700"  aria-labelledby="dropdownCartButton">
                <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
                    Cart
                </div>
                <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
                <form class="max-w-sm mx-auto">
                    <select id="member" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected hidden>Pilih Member Dahulu</option>
                        @foreach ($members as $member)
                        <option value="{{ $member->id }}">{{$member->nama}}</option>
                        @endforeach
                    </select>
                    </form>
                    <div class="flex justify-between m-2">
                        <span id="dp_limit">DP limit: -</span>
                        <span id="rental_total">Rental Total: -</span>
                        <span id="rental_limit">Max: -</span>
                    </div>
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-700" style="max-height: 45vh; overflow-y: auto; z-index: 1;">
                    <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <div class="flex-shrink-0">
                            <img class="rounded-full w-11 h-11" src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                        </div>
                        <div class="w-full ps-3">
                            <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">New message from <span class="font-semibold text-gray-900 dark:text-white">Jese Leos</span>: "Hey, what's up? All set for the presentation?"</div>
                            <div class="text-xs text-blue-600 dark:text-blue-500">a few moments ago</div>
                        </div>
                    </a>
                </div>
                <div class="flex">
                    <!-- Tombol kiri -->
                    <a href="#" class="w-1/3 block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-red-300 hover:bg-red-400 dark:bg-red-800 dark:hover:bg-red-700 dark:text-white">
                        <div class="inline-flex items-center justify-center w-full h-full">
                            <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                            </svg>
                            Hapus Semua
                        </div>
                    </a>

                    <!-- Tombol kanan -->
                    <a href="#" class="w-2/3 block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-green-300 hover:bg-green-400 dark:bg-green-800 dark:hover:bg-green-700 dark:text-white">
                        <div class="inline-flex items-center justify-center w-full h-full">
                            <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M8 7V6a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1M3 18v-7a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                            </svg>
                            Transaksi
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6" x-data="dataProduks">
                
                    @foreach ($produks as $produk)
                    
                    <x-card-produk>
                        <x-slot:gambar>{{ $produk -> gambar }}</x-slot:gambar>
                        <x-slot:kode>{{ $produk -> kode }}</x-slot:kode>
                        <x-slot:nama>{{ $produk -> nama }}</x-slot:nama>
                        <x-slot:deskripsi>{{ $produk -> deskripsi }}</x-slot:deskripsi>

                    @php
                        $harga = $hargaView->values()->get($produk->id)['hargaMin'] ?? null;
                        if(empty($harga)){
                            $hargaMin = number_format(0, 2, ',', '.');
                        }
                        else{
                            $hargaMin = number_format($harga, 2, ',', '.');
                        }
                    @endphp
                        <x-slot name="ukuran">
                            @foreach($produk->stoks as $stok)
                                {{ $stok -> ukuran }}, 
                            @endforeach
                        </x-slot>
                        <x-slot:hargaMin> {{$hargaMin}} </x-slot:hargaMin>
                        <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add to cart</a>
                    </x-card-produk>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var member = document.getElementById("member");
        member.addEventListener('change', function(){
            var memberId = this.value;
            if(memberId){
                fetch(`/orderProduk/${memberId}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    document.getElementById("dp_limit").textContent = 'DP Limit: ' + data.dp_limit*100 + '%';
                    document.getElementById("rental_total").textContent = 'Rental Total: ' + data.rental_total;
                    document.getElementById("rental_limit").textContent = 'Max: ' + data.rental_limit;
                })
                .catch(error => console.error('Error:', error));
            } 
            else {
                document.getElementById("dp_limit").textContent = 'DP Limit: -';
                document.getElementById("rental_total").textContent = 'Rental Total: -';
                document.getElementById("rental_limit").textContent = 'Max: -';
            }
        })
    });
</script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('dataProduks', () => ({

            }));
        });
</script>
<script>
        console.log("Data dari controller:", data);
</script>