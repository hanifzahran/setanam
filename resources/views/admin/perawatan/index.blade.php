@extends("layouts.admin.main",["active"=>"Perawatan"])

@section("content")
<div class="px-[24px]">
    <div class="flex justify-between flex-col md:flex-row ">
        <div>
            <h4 class="h4 text-primary font-semibold">Daftar Perawatan tanaman</h4>
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
                            @if($detail->products->kategori == "Layanan")
                            {{$detail->jumlah ." - ".$detail->products->nama}},
                            @endif
                        @endforeach
                    </td>

                    <td class="p-4 font-bold text-start text-primary">
                        {{$item->users->fullname}}
                    </td>
                    <td>
                        @if($item->status_perawatan == 1)
                        <p class="px-4 py-1 font-semibold text-white bg-[#E2B93B] rounded-[10px] w-[101px]  ">
                            Berjalan
                        </p>
                        @elseif($item->status_perawatan == 0)
                            <p class="px-4 py-1 font-semibold text-white bg-[#EB5757] rounded-[10px] w-[101px] text-center">
                                Belum
                            </p>
                        @else
                            <p class="px-4 py-1 font-semibold text-white bg-[#27AE60] rounded-[10px] w-[101px] text-center">
                                Sudah
                            </p>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="/admin/perawatan/detail/{{$item->id}}">
                            <span class="material-symbols-outlined text-primary">
                                play_arrow
                            </span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="text-end">
            <p class="text-gray-4 mt-[19px]">*Tekan aksi untuk lihat detail perawatan</p>
        </div>
    </div>

</div>
@endsection
