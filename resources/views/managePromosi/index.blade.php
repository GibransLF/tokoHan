<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Promosi') }}
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
                <a href="{{route('managePromosi.create')}}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah Promosi</a>
                    <x-table>
                        <x-slot name='header'>
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Produk
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Diskon
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Harga
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal Mulai
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    tanggal Selesai
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    info
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </x-slot>

                        @foreach( $promosis as $promosi )
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-6 py-4">
                                <span>
                                    {{ $promosi -> produk -> kode}}
                                </span>
                                &nbsp; - &nbsp;
                                <span>
                                    {{ $promosi -> produk -> nama}}
                                </span>
                                &nbsp; - &nbsp;
                                <span>
                                    {{ $promosi -> stok -> ukuran}}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $promosi -> diskon * 100 }}%
                            </td>
                            <td class="px-6 py-4">
                                <span class="line-through">
                                    Rp.{{$promosi -> stok -> harga}}
                                </span>
                                &nbsp;
                                <span class="text-green-500">
                                    Rp.<?php
                                    $harga_diskon = $promosi -> stok -> harga - ($promosi -> stok -> harga * $promosi -> diskon);
                                    echo number_format($harga_diskon, 2, ',', '.') ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $promosi -> tgl_mulai }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $promosi -> tgl_selesai }}
                            </td>
                            <td class="px-6 py-4">
                                @if(now()->toDateString() >= $promosi->tgl_mulai && now()->toDateString() <= $promosi->tgl_selesai)
                                    <span class="bg-green-300 text-green-800 text-sm font-semibold ml-2 px-1.5 py-0.5 rounded dark:bg-green-700 dark:text-green-400 border border-green-100 dark:border-green-400">Aktif</span>
                                
                                @else
                                    <span class="bg-gray-300 text-gray-800 text-sm font-semibold ml-2 px-1.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-100 dark:border-gray-400">Expired</span>
                                @endif
                            </td>
                            <td class="flex px-6 py-4">
                                <a href="{{ route("managePromosi.edit", $promosi->id) }}" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Ubah</a>

                                <button data-modal-target="popup-modal{{$promosi->id}}" data-modal-toggle="popup-modal{{$promosi->id}}" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Hapus</button>

                                <div id="popup-modal{{$promosi->id}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal{{$promosi->id}}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4 md:p-5 text-center">
                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin ingin menghapus Promosi ini?</h3>
                                                <form method="post" action="{{ route("managePromosi.destroy", $promosi->id ) }}">
                                                @csrf
                                                @method("DELETE")
                                                    <button data-modal-hide="popup-modal{{$promosi->id}}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                        Ya, saya yakin.
                                                    </button>
                                                    <button data-modal-hide="popup-modal{{$promosi->id}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Tidak, Batalkan.</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        @endforeach

                    </x-table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
