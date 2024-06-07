<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
            <x-toast type="success" :messages="[session('success')]" />
        @elseif(session('errors'))
            <x-toast type="error" :messages="session('errors')->all()" />
        @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form class="max-w-xl mx-auto" action="{{ route('manageProduk.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-5">
                        <label for="kode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Produk</label>
                        <input type="text" id="kode" name="kode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="LF046EZ" required />
                    </div>
                    <div class="mb-5">
                        <label for="kode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                        <input type="text" id="kode" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukan Nama Produk" required />
                    </div>
                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">Upload Gambar</label>
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="user_avatar" type="file" name="gambar">
                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">gambar herus berbentuk .jpg atau .png dengan size max 2MB</div>
                    </div>
                    <div class="mb-5">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskrpisi Produk</label>
                        <textarea id="message" name="deskripsi" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukan Deskripsi Produk..."></textarea>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" x-data="handler()">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No.
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Ukuran
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Stok Total
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Harga
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(field, index) in fields">
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <span x-text="index +1"></span>
                                    </th>
                                    <td class="px-6 py-3">
                                        <input type="text" class="w-full block mb-2 text-sm font-medium text-gray-900 dark:text-white" name="ukuran[]">
                                    </td>
                                    <td class="px-6 py-3">
                                        <input type="number" class="w-full block mb-2 text-sm font-medium text-gray-900 dark:text-white" name="stok_total[]" min="0">
                                    </td>
                                    <td class="px-6 py-3">
                                        <input type="number" class="w-full block mb-2 text-sm font-medium text-gray-900 dark:text-white" name="harga[]" min="0">
                                    </td>
                                    <td class="px-6 py-3">
                                    <button @click="removeField(index)" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        &times;
                                    </button>
                                    </td>
                                </tr>
                            </template>

                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4 text-right" colspan="5">
                                <button @click="addNewField()" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah Kolom</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-between mt-6">
                    <a href="{{ route('manageProduk.index') }}" type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Kembali</a>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
function handler(){
    return {
        fields: [],
        addNewField() {
            this.fields.push({
                ukuran: '',
                stok: '',
                harga: ''
            });
        },
        removeField(index) {
            this.fields.splice(index, 1);
        }
    }
}
</script>