@extends('layouts.admin.main', ['active' => 'Perawatan'])

@section('head')
    <div class="px-[24px]">
        <a href="/admin/perawatan" class="flex items-center">
            <span class="material-symbols-outlined">
                keyboard_backspace
            </span>
            <span class="ml-2">Kembali</span>
        </a>
    </div>
@endsection

@section('content')
    <div class="px-[24px]">
        <div class="flex justify-between flex-col md:flex-row ">
            <div>
                <h4 class="h4 text-primary font-semibold">Detail Perawatan tanaman</h4>
            </div>
        </div>
        <div class="mt-8 ">
            <table class="">
                <tr class=" ">
                    <td class="text-start text-gray-3 font-md font-semibold p-4">Nama Peneywa</td>
                    <td class=" text-gray-3 font-md font-semibold p-4 text-start">:</td>
                    <td class=" text-gray-3 font-md font-semibold p-4 text-start">{{ $order->users->fullname }}</td>
                </tr>
                <tr class=" ">
                    <td class="text-start text-gray-3 font-md font-semibold p-4">Alamat penyewa</td>
                    <td class=" text-gray-3 font-md font-semibold p-4 text-start ">:</td>
                    <td class=" text-gray-3 font-md font-semibold p-4 text-start truncate">{{ $order->users->address }}</td>
                </tr>
                <tr class=" ">
                    <td class="text-start text-gray-3 font-md font-semibold p-4">Layanan perawatan</td>
                    <td class=" text-gray-3 font-md font-semibold p-4 text-start">:</td>
                    <td class=" text-gray-3 font-md font-semibold p-4 text-start">
                        @foreach ($order->order_details as $item)
                            {{ $item->products->nama }},
                        @endforeach
                    </td>
                </tr>
                <?php
                $jumlah = 0;
                $durasi = 0;
                foreach ($order->order_details as $detail) {
                    if ($jumlah <= $detail->jumlah) {
                        $jumlah = $detail->jumlah;
                    }
                
                    if ($durasi <= $detail->durasi_perawatan) {
                        $durasi = $detail->durasi_perawatan;
                    }
                }
                ?>
                <tr class=" ">
                    <td class="text-start text-gray-3 font-md font-semibold p-4">Jumlah perawatan</td>
                    <td class=" text-gray-3 font-md font-semibold p-4 text-start">:</td>
                    <td class=" text-gray-3 font-md font-semibold p-4 text-start">{{ $jumlah . ' kali seminggu' }}</td>
                </tr>
                <tr class=" ">
                    <td class="text-start text-gray-3 font-md font-semibold p-4">Durasi perawatan</td>
                    <td class=" text-gray-3 font-md font-semibold p-4 text-start">:</td>
                    <td class=" text-gray-3 font-md font-semibold p-4 text-start">{{ $durasi . ' minggu' }}</td>
                </tr>
            </table>
        </div>

        <div class="mt-[40px] overflow-x-auto ">
            <table class="w-full  min-w-[1000px]">
                <thead>
                    <tr class="border-b border-gray-5 ">
                        <td class="text-start text-gray-4 font-md font-semibold p-4">Tanggal</td>
                        <td class=" text-gray-4 font-md font-semibold p-4 text-start">Keterangan</td>
                        <td class="text-center text-gray-4 font-md font-semibold p-4">Catatan</td>
                        <td class="text-start text-gray-4 font-md font-semibold p-4">Status</td>
                        <td class="text-center text-gray-4 font-md font-semibold p-4">Aksi</td>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->histories as $proses)
                        <tr class="border-b border-gray-5 ">
                            <td class="p-4 font-bold text-gray-3">
                                {{ date('d M, Y H:i A', strtotime($proses->updated_at)) }}
                            </td>

                            <td class="p-4 font-bold text-start text-gray-3">
                                Minggu {{ $proses->proses }}
                            </td>
                            <td class="p-4  text-center ">
                                <span class="cursor-pointer underline hover:opacity-80 open-modal-catatan"
                                    data-catatan="{{ $proses->catatan }}">Lihat</span>
                            </td>
                            <td>
                                @if ($proses->status == 1)
                                    <p
                                        class="px-4 py-1 font-semibold text-white bg-[#27AE60] rounded-[10px] w-[101px] text-center">
                                        Terawat
                                    </p>
                                @else
                                    <p
                                        class="px-4 py-1 font-semibold text-white bg-[#EB5757] rounded-[10px] w-[101px] text-center">
                                        Belum
                                    </p>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="#">
                                    <div class="open-modal-aksi" value="{{ $proses->id }}">
                                        <span class="material-symbols-outlined text-primary">
                                            play_arrow
                                        </span>
                                    </div>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        {{-- modal catatan --}}
        <div class="mt-[40px] hidden" id="modal-catatan">
            <div class="fixed inset-0 bg-gray-5 bg-opacity-75 transition-opacity"></div>
            <div class="fixed z-10 inset-0 overflow-y-auto ">
                <div class="flex justify-center min-h-full items-center  " id="outside-modal-catatan">
                    <div class="flex-shrink-0 max-w-[517px] w-full  p-2 " id="inside-modal-catatan">
                        <div class="bg-white p-[24px] rounded-[10px]">
                            <div class="flex justify-between">
                                <div></div>
                                <p class="font-xl-responsive text-center font-semibold text-primary">
                                    Catatan
                                </p>
                                <p class="font-xl-responsive text-center font-semibold text-primary">
                                    <span class="mi close-modal-catatan cursor-pointer hover:opacity-80"
                                        id="close-modal-catatan">close</span>
                                </p>
                            </div>
                            <div class="px-[24px] mt-[24px]">
                                <p class="font-lg-responsive font-semibold  text-gray-3 text-center text-[24px]"
                                    id="text-catatan"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-end">
            <p class="text-gray-4 mt-[19px]">*Tekan aksi untuk konfirmasi perawatan</p>
        </div>
    </div>
    {{-- modal aksi normal --}}
    <div class="mt-[40px] hidden" id="modal-aksi">
        <form action="">
            <div class="fixed inset-0 bg-gray-5 bg-opacity-75 transition-opacity"></div>
            <div class="fixed z-10 inset-0 overflow-y-auto ">
                <div class="flex justify-center min-h-full items-center  " id="outside-modal-aksi">
                    <div class="flex-shrink-0 max-w-[517px] w-full  p-2 " id="inside-modal-aksi">
                        <div class="bg-white p-[24px] md:p-[40px] lg:p-[60px] rounded-[10px]">
                            <p class="font-xl text-center font-semibold text-primary">
                                Apakah ingin konfirmasi
                                perawatan?
                            </p>

                            <div class="grid grid-cols-2 mt-[80px]">
                                <button class="text-center text-[#28B67E] font-bold hover:opacity-80"
                                    id="confirm-button">Ya</button>
                                <button class="text-center text-[#EB5757] font-bold hover:opacity-80" type="button"
                                    id="close-modal-aksi">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- modal sukses konfirmasi --}}
    <div class="mt-[40px] hidden" id="modal-sukses">
        <div class="fixed inset-0 bg-gray-5 bg-opacity-75 transition-opacity"></div>
        <div class="fixed z-10 inset-0 overflow-y-auto ">
            <div class="flex justify-center min-h-full items-center  " id="outside-modal-sukses">
                <div class="flex-shrink-0 max-w-[517px] w-full  p-2 " id="inside-modal-sukses">
                    <div class="bg-white p-[24px] rounded-[10px]">
                        <div class="flex justify-between">
                            <div></div>
                            <p class="font-xl-responsive text-center font-semibold text-primary">
                                Information
                            </p>
                            <p class="font-xl-responsive text-center font-semibold text-primary">
                                <span class="mi close-modal-catatan cursor-pointer hover:opacity-80"
                                    id="close-modal-sukses">close</span>
                            </p>
                        </div>
                        <div class="px-[24px] mt-[24px]">
                            <p class="font-lg-responsive font-semibold  text-gray-3 text-center text-[24px]"
                                id="text-sukses"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-end">
        <p class="text-gray-4 mt-[19px]">*Tekan aksi untuk konfirmasi perawatan</p>
    </div>
    </div>
    {{-- modal pengembalian --}}
    <div class="mt-[40px] hidden" id="modal-catatan-pengembalian">
        <div class="fixed inset-0 bg-gray-5 bg-opacity-75 transition-opacity"></div>
        <div class="fixed z-10 inset-0 overflow-y-auto ">
            <div class="flex justify-center min-h-full items-center  " id="outside-modal-catatan-pengembalian">
                <div class="flex-shrink-0 max-w-[517px] w-full  p-2 " id="inside-modal-catatan-pengembalian">
                    <div class="bg-white p-[24px] rounded-[10px]">
                        <div class="flex justify-between">
                            <div></div>
                            <p class="font-xl-responsive text-center font-semibold text-primary">
                                Detail Pengembalian
                            </p>
                            <p class="font-xl-responsive text-center font-semibold text-primary">
                                <span class="mi close-modal-catatan-pengembalian cursor-pointer hover:opacity-80"
                                    id="close-modal-catatan-pengembalian">close</span>
                            </p>
                        </div>
                        <div class="px-[24px] mt-[24px]">
                            <p class="font-lg-responsive font-semibold  text-gray-3 text-center text-[24px]">
                                Tanggal pengembalian
                            </p>
                            <p class="font-xl-responsive mt-[11px] text-center font-semibold text-primary"
                                id="text-catatan-pengembalian-tanggal">
                                tgl
                            </p>
                            <p class="font-xl-responsive font-semibold mt-[24px] text-center  text-primary"
                                id="text-catatan-pengembalian-status">
                                status
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@section('script')
    <script>
        var getId;
        $(function() {
            //    {{-- modal aksi normal --}}
            $("#outside-modal-aksi").on('click', function() {
                $("#modal-aksi").addClass("hidden");
            })

            $(".open-modal-aksi").on('click', function() {
                $("#modal-aksi").removeClass("hidden");
                getId = $(this).attr('value')
                $("#modal-aksi").attr("action", $(this).data("url-submit"));
            })

            $("#confirm-button").on('click', function() {
                $.ajax({
                    type: 'PUT',
                    headers: {
                        "Content-Type": "application/json"
                    },
                    url: '/api/v1/perawatan/confirm/' + getId,
                    success: (data) => {
                        console.log(data.message)
                        $("#modal-aksi").addClass("hidden");
                        $("#modal-sukses").removeClass("hidden");
                        $("#text-sukses").text(data.message)
                        $("#close-modal-sukses").on('click', function() {
                            $("#modal-sukses").addClass("hidden");
                            location.reload();
                        })
                    }
                })
            })

            $("#close-modal-aksi").on('click', function() {
                $("#modal-aksi").addClass("hidden");
            })

            $("#inside-modal-aksi").on('click', function(e) {
                e.stopPropagation();
            })
            //  {{-- modal aksi pengembalian --}}

            $("#outside-modal-aksi-pengembalian").on('click', function() {
                $("#modal-aksi-pengembalian").addClass("hidden");
            })

            $(".open-modal-aksi-pengembalian").on('click', function() {

                $("#modal-aksi-pengembalian").removeClass("hidden");
                $("#modal-aksi-pengembalian").attr("action", $(this).data("url-submit"));

            })

            $("#close-modal-aksi-pengembalian").on('click', function() {
                $("#modal-aksi-pengembalian").addClass("hidden");
            })

            $("#inside-modal-aksi-pengembalian").on('click', function(e) {
                e.stopPropagation();
            })

            //   {{-- modal catatan --}}

            $("#outside-modal-catatan").on('click', function() {
                $("#modal-catatan").addClass("hidden");
            })

            $("#outside-modal-catatan").on('click', function() {
                $("#modal-catatan").addClass("hidden");
            })

            $(".open-modal-catatan").on('click', function() {

                $("#modal-catatan").removeClass("hidden");
                $("#modal-catatan").attr("action", $(this).data("url-submit"));
                $("#text-catatan").text($(this).data("catatan"))

            })

            $("#close-modal-catatan").on('click', function() {
                $("#modal-catatan").addClass("hidden");
            })

            $("#inside-modal-catatan").on('click', function(e) {
                e.stopPropagation();
            })

            //   {{-- modal p-engembalian --}}

            $(".open-modal-catatan-pengembalian").on('click', function() {

                $("#modal-catatan-pengembalian").removeClass("hidden");
                $("#modal-catatan-pengembalian").attr("action", $(this).data("url-submit"));
                $("#text-catatan-pengembalian-tanggal").text($(this).data("tanggal"))
                $("#text-catatan-pengembalian-status").text($(this).data("status"))

            })

            $("#close-modal-catatan-pengembalian").on('click', function() {
                $("#modal-catatan-pengembalian").addClass("hidden");
            })

            $("#inside-modal-catatan-pengembalian").on('click', function(e) {
                e.stopPropagation();
            })
            $("#outside-modal-catatan-pengembalian").on('click', function() {
                $("#modal-catatan-pengembalian").addClass("hidden");
            })
        })
    </script>
@endsection
@endsection
