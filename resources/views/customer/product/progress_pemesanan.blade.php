@extends("layouts.customer.main")

@section("content")

    <div class="wrapper">
        <div class="container">
            <h3 class="third-heading">Progres Transaksi</h3>
            <p class="font-lg-responsive text-gray-3 mt-[8px]">Cek perjalananmu dalam merawat tanaman</p>
            <div class="flex justify-between py-[40px] px-[24px] rounded-[10px] mt-[54px] flex-wrap "
                 style="box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25);">
                <div class="flex gap-[24px] items-center flex-wrap">
                    @foreach($order->order_details as $detail)
                    <img src="/storage/images/product/{{$detail->products->gambar}}" alt="" class="w-[75px] aspect-square">
                    @endforeach
                        <div>
                        @foreach($order->order_details as $detail)
                            {{$detail->products->nama}}
                        @endforeach
                    </div>
                </div>
                <div class="mt-[40px] md:mt-0">
                    <p class="font-lg-responsive">
                        Total Belanja :
                    </p>
                    <p class="font-lg-responsive">
                        Rp {{number_format($order->total,0,",",".")}}
                    </p>
                </div>
            </div>
            <div class="mt-[40px] flex items-start">
                <!-- Pengiriman -->
                @if(!is_null($order->status_pengiriman))
                    <div class=" flex flex-col ">
                        {{-- <h4>Status Pengiriman</h4> --}}
                        <div class="flex gap-[50px] items-center">
                            <div class="{{$order->status_pembayaran == 3 ? 'pesanan-done' : 'pesanan-pending'}}">1</div>
                            <div>
                                <p>Pembayaran</p>
                                @if($order->status_pembayaran == 3)
                                    <p class="font-sm text-gray-3">{{date('d M, Y H:i A', strtotime($order->updated_at))}}
                                    </p>
                                @else
                                    @if($order->kode_pembayaran)
                                        <p class="font-sm text-gray-3">Kode VA - {{$order->kode_pembayaran}}</p>
                                    @else
                                        <button id="pay-button">Bayar</button>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="h-[80px] w-[4px] bg-primary ml-[35px]"></div>
                        <div class="flex gap-[50px] items-center">
                            <div class="{{$order->status_pengiriman == 2 ? 'pesanan-done' : 'pesanan-progress'}}">2
                            </div>
                            <div>
                                <p class="text-primary ">Dikirim</p>
                                @if($order->status_pengiriman == 1)
                                    <p class="font-sm text-gray-3">{{date('d M, Y H:i A', strtotime($order->updated_at))}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="h-[80px] w-[4px] bg-gray-4 ml-[35px]"></div>
                        <div class="flex gap-[50px] items-center">
                            <div class="@if($order->status_pengiriman == 2) pesanan-done @elseif($order->status_pengiriman == 1) pesanan-progress @else pesanan-pending @endif">3</div>
                            <div>
                                <p class=" text-gray-3">Sampai tujuan</p>
                                @if($order->status_pengiriman == 1)
                                    <a href="/product/barang-diterima/{{$order->id}}"
                                       onclick="return confirm('Barang sudah diterima ?')">Terima ?</a>
                                @elseif($order->status_pengiriman == 2)
                                    <p class="font-sm text-gray-3">{{date('d M, Y H:i A', strtotime($order->updated_at))}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Perawatan -->
                @if(!is_null($order->status_perawatan))
                    <div class=" flex flex-col ">
                        <div class="flex gap-[50px] items-center">
                            <div class="{{$order->status_pembayaran == 3 ? 'pesanan-done' : 'pesanan-pending'}}">1</div>
                            <div>
                                <p>Pembayaran</p>
                                @if($order->status_pembayaran == 3)
                                    <p class="font-sm text-gray-3">{{date('d M, Y H:i A', strtotime($order->updated_at))}}
                                    </p>
                                @else
                                    @if($order->kode_pembayaran)
                                        <p class="font-sm text-gray-3">Kode VA - {{$order->kode_pembayaran}}</p>
                                    @else
                                        <button id="pay-button">Bayar</button>
                                    @endif
                                @endif
                            </div>
                        </div>
                        @foreach($order->histories as $key=>$history)
                            <div class="h-[80px] w-[4px] bg-primary ml-[35px]"></div>
                            <div class="flex gap-[50px] items-center">
                                <div
                                    class="@if($history->status == 1) pesanan-done @elseif($history->status == 1) pesanan-progress @else pesanan-pending @endif">
                                    {{$key+2}}
                                </div>
                                <div>
                                    {{-- @if($checkKonfirmasi->status == 1) --}}
                                    <p>Proses perawatan tanaman</p>

                                    <p>Minggu ke {{$history->proses}}</p>
                                    @if($history->status == 0)
                                        <a href="/product/konfirmasi-perawatan/{{$history->id}}/{{$hitung}}/{{$order->id}}" class="text-primary ">Konfirmasi
                                            Perawatan</a>
                                    @elseif($history->status == 1)
                                        <p class="font-sm text-gray-3">{{$history->updated_at}}</p>
                                    @endif
                                </div>
                            </div>

                        @endforeach
                    </div>
                @endif

                @if(!is_null($order->status_peminjaman))
                    <!-- Peminjaman -->                    
                    <div class=" flex flex-col ">
                        {{-- <h4>Status Peminjaman</h4> --}}
                        <div class="flex gap-[50px] items-center">
                            <div class="{{$order->status_pembayaran == 3 ? 'pesanan-done' : 'pesanan-pending'}}">1</div>
                            <div>
                                <p>Pembayaran</p>
                                @if($order->status_pembayaran == 3)
                                    <p class="font-sm text-gray-3">{{date('d M, Y H:i A', strtotime($order->updated_at))}}
                                    </p>
                                @else
                                    @if($order->kode_pembayaran)
                                        <p class="font-sm text-gray-3">Kode VA - {{$order->kode_pembayaran}}</p>
                                    @else
                                        <button id="pay-button">Bayar</button>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="h-[80px] w-[4px] bg-primary ml-[35px]"></div>
                        <div class="flex gap-[50px] items-center">
                            <div class="@if($order->status_peminjaman == 2) pesanan-done @elseif($order->status_peminjaman == 1 || $order->status_pembayaran == 3) pesanan-progress @else pesanan-pending @endif">2</div>
                            <div>
                                <p class="text-primary ">Proses Peminjaman</p>
                                @if($order->status_peminjaman == 2)
                                <p class="font-sm text-gray-3">{{date('d M, Y H:i A', strtotime($order->updated_at))}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="h-[80px] w-[4px] bg-gray-4 ml-[35px]"></div>
                        <div class="flex gap-[50px] items-center">
                            <div class="@if($order->status_peminjaman == 2) pesanan-done @elseif($order->status_peminjaman == 1) pesanan-progress @else pesanan-pending @endif">3</div>
                            <div>
                                <p class=" text-gray-3">Pengembalian</p>
                                @if($order->status_peminjaman == 2)
                                    <p class="font-sm text-gray-3">Tim kami akan menjemput barang pinjaman</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
