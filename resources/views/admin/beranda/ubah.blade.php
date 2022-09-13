@extends("layouts.admin.main",["active"=>"Beranda"])

@section("head")
<div class="px-[24px]">
    <a href="/admin" class="flex items-center">
        <span class="material-symbols-outlined">
            keyboard_backspace
        </span>
        <span class="ml-2">Kembali</span>
    </a>
</div>
@endsection

@section("content")
<div class="px-[24px]">
    <div class=" ">
        <div>
            <h4 class="h4 text-primary font-semibold">Pilih untuk untuk mengubah</h4>
        </div>
        <div class="mt-8 md:mt-0 ">
            <div class="flex flex-col md:flex-row md:gap-[18px] md:items-center justify-end">
                <h4 class="h5 text-primary font-semibold open-modal cursor-pointer hover:opacity-80">Tambah item + </h4>
            </div>
        </div>
    </div>
    <div class="mt-[40px] overflow-x-auto ">
        <div class="mt-[40px] overflow-x-auto ">
            <table class="w-full  min-w-[1000px]">
                <thead>
                    <tr class="border-b border-gray-5 ">
                        <td class="text-start text-gray-4 font-md font-semibold p-4">Nama item</td>
                        <td class="text-start text-gray-4 font-md font-semibold p-4">Status</td>
                        <td class=" text-gray-4 font-md font-semibold p-4 text-center">Disewakan</td>
                        <td class="text-center text-gray-4 font-md font-semibold p-4">Jumlah total</td>
                        <td class="text-start text-gray-4 font-md font-semibold p-4">Harga</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($produk as $item):
                @php
                $link = '';
                if($item->kategori == "Layanan"){
                    $link = 'ubah-layanan';
                }else if($item->kategori == "Tanaman"){
                    $link = 'ubah-tanaman';
                }else {
                    $link = 'ubah-item';
                }
                @endphp

                    <tr class="border-b border-gray-5  cursor-pointer hover:bg-gray-5 click-redirect"
                        data-href="{{url('/admin/'. $link . '/' . $item->id . '/edit')}}">
                        <td class="p-4 font-bold text-primary">
                            {{$item->nama . ' - ' . $item->kategori}}
                        </td>
                        <td>
                            <span class="px-4 py-1 font-semibold text-white bg-[#27AE60] rounded-[10px]">Active</span>
                        </td>
                        <td class="p-4 font-bold text-center text-primary">
                            @if($item->kategori == "Layanan")
                                0
                            @else
                                -
                            @endif
                        </td>
                        <td class="p-4 font-bold text-center text-gray-3">
                            @if($item->kategori != "Layanan")
                                {{$item->jumlah}}
                            @else
                                -
                            @endif
                        </td>
                        <td class="p-4 font-bold text-start whitespace-nowrap text-gray-3">
                            Rp {{$item->harga}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-[40px] invisible" id="modal">
        <div class="fixed inset-0 bg-gray-5 bg-opacity-75 transition-opacity"></div>
        <div class="fixed z-10 inset-0 overflow-y-auto ">
            <div class="flex justify-center min-h-full items-center  " id="outside-modal">
                <div class="flex-shrink-0 max-w-[500px] w-full  p-2 " id="inside-modal">
                    <div class="bg-white  rounded-[10px]">
                        <div class="flex justify-end p-4">
                            <span class="mi cursor-pointer hover:opacity-80" id="close-modal">
                                close
                            </span>
                        </div>
                        <div class="p-[24px] md:p-[40px] ">
                            <h4
                                class="h5 text-primary font-semibold open-modal cursor-pointer hover:opacity-80 my-3 text-center">
                                Tambah
                                item </h4>
                            <a href="/admin/tambah-tanaman">
                                <div
                                    class="p-[16px]  rounded-[10px] border border-gray-4 text-lg hover:opacity-80 flex justify-between items-center ">
                                    <h3 class="h6 text-primary">Tambah tanaman</h3>

                                    <span class="material-symbols-outlined">
                                        chevron_right
                                    </span>
                                </div>
                            </a>
                            <a href="/admin/tambah-layanan">
                                <div
                                    class="p-[16px] mt-[24px] rounded-[10px] border border-gray-4 text-lg hover:opacity-80 flex justify-between items-center ">
                                    <h3 class="h6 text-primary">Tambah layanan</h3>
                                    <span class="material-symbols-outlined">
                                        chevron_right
                                    </span>
                                </div>
                            </a>
                            <a href="/admin/tambah-item">
                                <div
                                    class="p-[16px] mt-[24px] rounded-[10px] border border-gray-4 text-lg hover:opacity-80 flex justify-between items-center ">
                                    <h3 class="h6 text-primary">Tambah item perawatan</h3>
                                    <span class="material-symbols-outlined">
                                        chevron_right
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section("script")
    <script>
        $(function()  {
            $(".click-redirect").click(function() {
                window.location = $(this).data("href");
            });

            $("#outside-modal").on('click',function(){
                $("#modal").addClass("invisible");
            })

            $(".open-modal").on('click',function(){

                $("#modal").removeClass("invisible");
                $("#modal").attr("action",$(this).data("url-submit"));

            })

            $("#close-modal").on('click',function(){
                $("#modal").addClass("invisible");
            })

            $("#inside-modal").on('click',function(e){
                e.stopPropagation();
            })
        })
    </script>
    @endsection
</div>
@endsection
