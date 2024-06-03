<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Promosi') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="barang">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <x-toast type="success" :messages="[session('success')]" />
        @elseif(session('errors'))
            <x-toast type="error" :messages="session('errors')->all()" />
        @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{route("managePromosi.update",$promosi -> id)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="mb-6">
                            <label for="produk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Nama Produk</label>
                            <select id="produk" name="produk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" x-model="produkId" @change="ambilStok(produkId)">
                                <option selected hidden :value="{{$promosi -> produk_id}}">{{$promosi -> produk -> kode}} - {{$promosi -> produk -> nama}}</option>
                                @foreach ($produks as $produk)
                                <option value="{{$produk -> id}}">{{$produk -> kode}} - {{$produk -> nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="stokInput" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih ukuran Produk</label>
                            <select id="stokInput" name="stok" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" x-model="stok" @change="ambilIdStok(stok)">
                                <option selected hidden :value="{{$promosi -> stok_id}}">{{$promosi -> stok -> ukuran}}</option>
                                <template x-for="stok in stoks" :key="stok.id">
                                    <option :value="stok.id" x-text="stok.ukuran"></option>
                                </template>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="diskonInput" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Diskon</label>
                            <div class="flex">
                                <input type="number" name="diskon" id="diskonInput" class="rounded-none rounded-s-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" :placeholder="diskon" min="0" max="100" required x-model="diskon" @change="getDiskon(diskon)">
                                <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-s-0 border-gray-300 border-s-0 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                    <div class="w-4 h-4 text-gray-800 dark:text-white text-base mb-1" aria-hidden="true">
                                        %
                                    </div>
                                </span>
                                <div class="rounded-none rounded-s-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" x-text="parseFloat(harga).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })">
                                </div>
                                <div class="rounded-none rounded-s-lg bg-gray-50 border text-green-500 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" x-text="parseFloat(newHarga).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })">
                                </div>
                            </div>
                        </div>
                        <div class="grid gap-6 mb-6 md">
                            <div date-rangepicker datepicker-format="yyyy-mm-dd" class="flex items-center">
                                <div class="relative max-w-lg">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </div>
                                    <input name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start" value="{{$promosi -> tgl_mulai}}">
                                </div>
                                <span class="mx-4 text-gray-500">to</span>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </div>
                                    <input name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end" value="{{$promosi -> tgl_selesai}}">
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-around">
                            <a href="{{route("managePromosi.index")}}" type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Kembali</a>

                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('barang', () => ({
            stoks:[],
            produkId: <?php echo $promosi -> produk_id ?>,
            stok: null,
            diskon: <?php echo $promosi -> diskon * 100 ?>,
            newDiskon: 0,
            harga: <?php echo $promosi -> stok -> harga ?>,
            newHarga: 0,

            init() {
                // Ambil stok saat di buka
                if (this.produkId) {
                    this.ambilStok(this.produkId);
                    this.getDiskon(<?php echo $promosi -> diskon * 100 ?>);
                }
            },

            ambilStok(produkId) {
                fetch(`/managePromosi/getStok/${produkId}`)
                    .then(response => response.json())
                    .then(data => {
                        this.stoks = data;
                    });
            },

            ambilIdStok(stok){
                const cariStok = this.stoks.find(stoks => stoks.id == stok);
                this.harga = cariStok.harga;
                this.getDiskon(<?php echo $promosi -> diskon * 100 ?>);
            },

            getDiskon(persen){
                this.newDiskon = persen / 100;
                this.newHarga = this.harga-(this.harga*this.newDiskon);
            }
        }));
    });
</script>