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
                        <div class="absolute block w-3 h-3 bg-red-500 border-2 border-white rounded-full -top-0.5 start-2.5 dark:border-gray-900" id="notifyItemCart" style="opacity: 0;"></div>
                        <p class="text-xs text-gray-900 hover:text-gray-600 dark:text-white" id="countItemCart"></p>
                </button>
            </div>

            
        </div>
    </x-slot>
    <div x-data="$store.cart">
    <!-- Dropdown menu -->
    <div id="dropdownCart" class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700"  aria-labelledby="dropdownCartButton">
        <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
            Cart
        </div>
        <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
        <form class="max-w-sm mx-auto">
            <select id="member" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" @change="updateUiData($event.target.value)">
                <option selected hidden>Pilih Member Dahulu</option>
                @foreach ($members as $member)
                <option value="{{ $member->id }}" >{{$member->nama}}</option>
                @endforeach
            </select>
            </form>
            <div class="flex justify-between m-2">
                <span x-text="'DP: ' + dp * 100 + '%'">DP limit: -</span>
                <span :class="{'text-red-500': (rental_total + totalQty) >= rental_limit}" x-text="'Rental Total: ' + (rental_total + totalQty) + '/' + rental_limit">Rental Total: -</span>
                <span x-text="'Qty Cart: ' + totalQty">Rental Total: -</span>
            </div>
        </div>
        <div class="divide-y divide-gray-100 dark:divide-gray-700" style="max-height: 45vh; overflow-y: auto; z-index: 1;" >
            <!-- dropdownContent -->
            <template x-for="(item, index) in items" :key="index">
                <div class="flex items-center p-4 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="flex-shrink-0">
                        <img class="rounded-lg w-11 h-11" :src="'{{ asset('storage/')}}/' + item.gambarProduk" alt="Item image">
                    </div>
                    <div class="w-full ps-3">
                        <span class="text-sm text-gray-900 dark:text-gray-800 mx-1 mb-1" x-text="item.kodeProduk +' - '+ item.namaProduk +' - '+ item.ukuran"></span>
                        <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400 mx-1 flex items-center space-x-2">
                            <span class="text-gray-800 flex-grow-[2]" x-text="parseFloat(item.harga*item.qty).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })"></span>
                            <button type="button" class="flex justify-center items-center text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm text-center dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-300 dark:focus:ring-gray-800 p-1 flex-grow" @click="remove(item)">
                                <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"/>
                                </svg>
                            </button>
                            <span class="text-gray-800" x-text="item.qty"></span>
                            <button type="button" class="flex justify-center items-center text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm text-center dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-300 dark:focus:ring-gray-800 p-1 flex-grow" @click="addToCart(item)">
                                <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                                </svg>
                            </button>
                        </div>
                        <div class="text-xs text-gray-600 dark:text-gray-500 mx-1" x-text="parseFloat(item.harga).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })"></div>
                    </div>
                </div>
            </template>
        </div>
        <div class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
            <div class="flex justify-between m-2">
                <div class="flex items-center">
                    <label for="default-checkbox" class="text-sm font-medium text-gray-900 dark:text-gray-300">DP: </label>
                    <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-400 border-gray-500 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 mx-1">
                    <label for="default-checkbox" class="text-sm font-medium text-gray-900 dark:text-gray-300" x-text="parseFloat(hargaTotal*dp).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })"></label>
                </div>
                <span class="text-green-600" x-text="'Total: ' + parseFloat(hargaTotal).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })"></span>
            </div>
        </div>
        <div class="flex">
            <!-- Tombol kiri -->
            <button class="w-1/3 block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-red-300 hover:bg-red-400 dark:bg-red-800 dark:hover:bg-red-700 dark:text-white" @click="clearCart">
                <div class="inline-flex items-center justify-center w-full h-full">
                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                    </svg>
                    Hapus Semua
                </div>
            </button>
    
            <!-- Tombol kanan -->
            <button class="w-2/3 block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-green-300 hover:bg-green-400 dark:bg-green-800 dark:hover:bg-green-700 dark:text-white">
                <div class="inline-flex items-center justify-center w-full h-full">
                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M8 7V6a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1M3 18v-7a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                    </svg>
                    Transaksi
                </div>
            </button>
        </div>
    </div>

    <!-- content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                
                    @foreach ($produks as $produk)
                    
                    <x-card-produk>
                        <x-slot:gambar>{{ $produk -> gambar }}</x-slot:gambar>
                        <x-slot:kode>{{ $produk -> kode }}</x-slot:kode>
                        <x-slot:nama>{{ $produk -> nama }}</x-slot:nama>
                        <x-slot:deskripsi>{{ $produk -> deskripsi }}</x-slot:deskripsi>

                    @php
                        $harga = $hargaView->get($produk->id)['hargaMin'] ?? null;
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

                        <button data-modal-target="authentication-modal{{$produk->id}}" data-modal-toggle="authentication-modal{{$produk->id}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add to Cart</button>

                        <!-- Main modal -->
                        <div id="authentication-modal{{$produk->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            Pilih Ukuran
                                        </h3>
                                        <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal{{$produk->id}}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5">
                                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3">
                                                            Stok
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Ukuran
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Harga
                                                        <th scope="col" class="px-6 py-3">
                                                            <span class="sr-only">Add to Cart</span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($produk->stoks as $stok)
                                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{$stok->stok}}
                                                            </th>
                                                            <td class="px-6 py-4">
                                                                {{$stok->ukuran}}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                {{$stok->harga}}
                                                        </td>
                                                        <td class="px-6 py-4 text-right">
                                                            <a href="#" @click="addToCart({
                                                                id: '{{$stok->id}}',
                                                                produk_id: '{{$stok->produk_id}}',
                                                                kodeProduk: '{{$produk->kode}}',
                                                                namaProduk: '{{$produk->nama}}',
                                                                gambarProduk: '{{$produk->gambar}}',
                                                                ukuran: '{{$stok->ukuran}}',
                                                                harga: '{{$stok->harga}}',
                                                            })" data-modal-hide="authentication-modal{{$produk->id}}">
                                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"/>
                                                                </svg>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                        </div> 
                        
                    </x-card-produk>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('cart', () => ({
            items: [],
            totalQty : 0,
            hargaTotal : 0,
            dp : 0,
            rental_total : 0,
            rental_limit : 0,
            member : 0,

            updateUiData(memberId){
                if(memberId){
                    fetch(`/orderProduk/${memberId}`)
                    .then(response => response.json())
                    .then(data => {
                        this.dp = data.dp_limit;
                        this.rental_total = data.rental_total;
                        this.rental_limit = data.rental_limit;
                        this.member = memberId;
                    })
                }
                else{
                    this.dp = 0;
                    this.remtal_total = 0;
                    this.rental_limit = 0;
                }
            },

            addToCart(newItem){
                if(this.member === 0){
                    alert("Pilih Member Dahulu di Tombol Cart");
                }
                else if(this.rental_total + this.totalQty == this.rental_limit){
                    return;
                }
                else{
                    const findItem = this.items.find((item) => item.id == newItem.id)
    
                    if(!findItem){
                        this.items.push({...newItem, qty: 1});
                        this.totalQty++;
                        this.hargaTotal += parseFloat(newItem.harga);
                    }
                    else{
                        findItem.qty += 1;
                        this.totalQty++;
                        this.hargaTotal += parseFloat(newItem.harga);
                    }
    
                    if(this.totalQty == 0){
    
                        document.getElementById("notifyItemCart").style.opacity = "0";
                        document.getElementById("countItemCart").textContent = "";
                    }
                    else{
                        document.getElementById("notifyItemCart").style.opacity = "1";
                        document.getElementById("countItemCart").textContent = this.totalQty;
                    }
                }
            },
            remove(itemRemove){
                const findItem = this.items.find((item) => item.id == itemRemove.id)
                if(findItem.qty <= 1 ){
                    this.totalQty--;
                    this.hargaTotal -= parseFloat(itemRemove.harga);
                    this.items = this.items.filter((item) => item.id != itemRemove.id);
                }
                else{
                    itemRemove.qty --;
                    this.hargaTotal -= parseFloat(itemRemove.harga);
                    this.totalQty--;
                }
                
                if(this.totalQty == 0){

                    document.getElementById("notifyItemCart").style.opacity = "0";
                document.getElementById("countItemCart").textContent = "";
            }
            else{
                document.getElementById("notifyItemCart").style.opacity = "1";
                document.getElementById("countItemCart").textContent = this.totalQty;
            }
        },
            clearCart(){
                this.items = [];
                this.totalQty = 0;
                this.hargaTotal = 0;
            },
        }));
    });
</script>
