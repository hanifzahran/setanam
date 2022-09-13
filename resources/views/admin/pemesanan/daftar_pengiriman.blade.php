@extends("layouts.admin.main",["active"=>"Pemesanan"])

@section("head")
    <div class="px-[24px]">
        <a href="/admin/pemesanan" class="flex items-center">
        <span class="material-symbols-outlined">
            keyboard_backspace
        </span>
            <span class="ml-2">Kembali</span>
        </a>
    </div>
@endsection

@section("content")
    <div class="px-[24px]">
        <div class="flex justify-between flex-col md:flex-row ">
            <div>
                <h4 class="h4 text-primary font-semibold">Daftar Pengiriman</h4>
            </div>
        </div>

        <div class="mt-[40px] overflow-x-auto ">
            <table class="w-full  min-w-[1000px]">
                <thead>
                <tr class="border-b border-gray-5 ">
                    <td class="text-start text-gray-4 font-md font-semibold p-4">Nama tanaman</td>
                    <td class=" text-gray-4 font-md font-semibold p-4 text-start">Nama penyewa</td>
                    <td class="text-start text-gray-4 font-md font-semibold p-4">Status</td>
                    <td class="text-center text-gray-4 font-md font-semibold p-4 ">Aksi</td>
                </tr>
                </thead>
                <tbody>
                @foreach($order as $item)
                    <tr class="border-b border-gray-5 ">
                        <td class="p-4 font-bold text-primary">
                            @foreach($item->order_details as $detail)

                                {{$detail->jumlah}} - {{$detail->products->nama}},
                            @endforeach
                        </td>

                        <td class="p-4 font-bold text-start text-primary">
                            {{$item->users->fullname}}
                        </td>
                        <td>
                            @if($item->status_pengiriman != 2)
                                <p class="px-4 py-1 font-semibold text-white bg-[#EB5757] rounded-[10px] w-[101px] text-center">
                                    Belum
                                </p>
                            @else
                                <p class="px-4 py-1 font-semibold text-white bg-[#27AE60] rounded-[10px] w-[101px] text-center">
                                    Sudah
                                </p>
                            @endif
                        </td>
                        <td class="text-center open-modal" data-url-submit="{{url("/admin/pemesanan/konfirmasi-pengiriman/".$item->id)}}">
                        <span class="material-symbols-outlined text-primary cursor-pointer hover:opacity-80">
                            play_arrow
                        </span>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div class="text-end">
                <p class="text-gray-4 mt-[19px]">*Tekan aksi untuk konfirmasi pengiriman</p>
            </div>
        </div>

        <div class="mt-[40px] hidden" id="modal">
            <form action="" id="iniFormnya" method="post">
                @csrf
                <div class="fixed inset-0 bg-gray-5 bg-opacity-75 transition-opacity"></div>
                <div class="fixed z-10 inset-0 overflow-y-auto ">
                    <div class="flex justify-center min-h-full items-center  " id="outside-modal">
                        <div class="flex-shrink-0 max-w-[517px] w-full  p-2 " id="inside-modal">
                            <div class="bg-white p-[24px] md:p-[40px] lg:p-[60px] rounded-[10px]">
                                <p class="font-xl text-center font-semibold text-primary">
                                    Apakah ingin konfirmasi
                                    tanaman sudah dikirim?
                                </p>

                                <div class="grid grid-cols-2 mt-[80px]">
                                    <button type="submit" class="text-center text-[#28B67E] font-bold hover:opacity-80">Ya</button>
                                    <button class="text-center text-[#EB5757] font-bold hover:opacity-80" type="button"
                                            id="close-modal">Batal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @section("script")
        <script>
            $(function () {

                $("#outside-modal").on('click', function () {
                    $("#modal").addClass("hidden");
                })

                $(".open-modal").on('click', function () {

                    $("#modal").removeClass("hidden");
                    $("#iniFormnya").attr("action", $(this).data("url-submit"));

                })

                $("#close-modal").on('click', function () {
                    $("#modal").addClass("hidden");
                })

                $("#inside-modal").on('click', function (e) {
                    e.stopPropagation();
                })
            })
        </script>
    @endsection
@endsection
