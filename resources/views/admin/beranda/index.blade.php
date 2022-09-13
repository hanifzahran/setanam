@extends("layouts.admin.main",["active"=>"Beranda"])

@section("content")
<div class="px-[24px]">
    <div class="grid grid-col-1  lg:grid-cols-2 xl:grid-cols-3 gap-[32px]">
        <div class=" p-[24px] rounded-[10px]" style="box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25);">
            <h6 class="h6 font-bold text-primary">Total pemasukan</h6>
            <p class="font-sm font-bold text-gray-4 mt-2">{{$bulan}}</p>

            <div class="flex items-start font-bold text-primary mt-[32px]">
                <p class="text-[20px] ">Rp </p>
                <h1 class="h1" id="pemasukan"></h1>
            </div>
        </div>
        <div class=" p-[24px] rounded-[10px]" style="box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25);">
            <h6 class="h6 font-bold text-primary">Data transaksi</h6>
            <p class="font-sm font-bold text-gray-4 mt-2">{{$bulan}}</p>

            <a href="/admin/detail-transaksi" class="flex justify-between  flex-col 2xl:flex-row">
                <div class=" font-bold text-primary mt-[32px]">
                    <h1 class="h1"> {{$totalTransaksi}} <span class="text-[20px] ">Total transaksi</span></h1>
                </div>
                <div class="py-2 px-3 rounded-[10px] bg-primary h-fit text-white font-semibold text-center">Lihat detail
                </div>
            </a>
        </div>
        <div class=" p-[24px] rounded-[10px]" style="box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25);">
            <h6 class="h6 font-bold text-primary">Data customer</h6>
            <p class="font-sm font-bold text-gray-4 mt-2">{{$bulan}}</p>

            <a href="/admin/detail-customer" class="flex justify-between flex-col 2xl:flex-row">
                <div class=" font-bold text-primary mt-[32px]">
                    <h1 class="h1"> {{$totalUser}} <span class="text-[20px] ">User terdaftar</span></h1>
                </div>
                <div class="py-2 px-3 rounded-[10px] bg-primary h-fit text-white font-semibold text-center">Lihat detail
                </div>
            </a>
        </div>
    </div>


    <div class="flex justify-between mt-[40px]">
        <div>
            <h4 class="h4 text-primary font-semibold">List Item</h4>
        </div>
        <a href="admin/ubah">
            <h4 class="h4 text-primary font-semibold">Ubah <span class="mi">settings</span></h4>
        </a>
    </div>
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
            @foreach($product as $item):
                <tr class="border-b border-gray-5 ">
                    <td class="p-4 font-bold text-primary">
                        {{$item->nama}}
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
@endsection
@section('script')
    <script>
        let money = Intl.NumberFormat('id-ID');
        document.getElementById('pemasukan').innerText = money.format({{$pemasukan}})
    </script>
@endsection
