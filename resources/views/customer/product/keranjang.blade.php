@extends("layouts.customer.main")

@section("content")
    <div class="wrapper">
        <div class="container">
            <form action="/product/pembayaran" method="post">
                @csrf
                <h3 class="third-heading">Keranjang belanja</h3>
                <div class="mt-[24px] md:mt-[40px] lg:mt-[80px] flex gap-[94px] flex-col xl:flex-row">
                    <div class="w-full">
                        <table class="w-full max-w-[933px] ">
                            <thead>
                            <tr class="border-b border-gray-4 ">
                                <td class="text-start text-gray-1 font-md  p-2">Layanan / item</td>
                                <td class="text-start text-gray-1 font-md  p-2">Harga</td>
                                <td class="text-start text-gray-1 font-md  p-2">Kuantitas</td>
                                <td class="text-start text-gray-1 font-md  p-2">Subtotal</td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $jml = 0 ?>
                            @foreach($carts as $cart)
                                :
                                    <?php $jml += $cart->product->harga * $cart->jumlah ?>
                                <input type="hidden" name="id[]" value="{{$cart->id}}">
                                <input type="hidden" name="product_id[]" value="{{$cart->product->id}}">

                                <tr class="border-b border-gray-4 item-keranjang">
                                    <td class="p-2 text-gray-2">
                                        <div class="flex items-center gap-2">
                                            <img src="/storage/images/product/{{$cart->product->gambar}}" alt=""
                                                 class="w-[75px] aspect-square object-cover">
                                            <p class="font-md">{{$cart->product->nama}}</p>
                                            <input type="hidden" value="{{$cart->product->nama}}" name="nama[]">
                                        </div>
                                    </td>
                                    <td class="p-2 text-gray-2 harga" data-harga="{{$cart->product->harga}}">
                                        Rp. {{$cart->product->harga}}</td>
                                    <td class=" text-gray-2 ">
                                        <div class=" flex gap-2 items-center">
                                            <div
                                                class="mt-2  items-center py-2 px-1 rounded-[8px] w-[134px] flex justify-between"
                                                style="box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25);">
                                                <button type="button"
                                                        class="mi text-gray-3 cursor-pointer hover:opacity-80 ">

                                                </button>
                                                <input type="number" readonly
                                                       class="focus:outline-none w-[60px] text-center font-xl-responsive hide-arrow jumlah-input"
                                                       value="{{$cart->jumlah}}" name="jumlah[]"/>
                                                <button type="button"
                                                        class="mi text-gray-3 cursor-pointer hover:opacity-80  ">

                                                </button>
                                            </div>
                                            <div>{{$cart->product->kategori == "Layanan" ? 'per minggu' : 'pcs'}}</div>
                                        </div>
                                        @if($cart->product->kategori == "Layanan" || $cart->product->kategori == "Tanaman")
                                            <div class="flex gap-2 items-center my-[24px]">
                                                <div
                                                    class="mt-2  items-center py-2 px-1 rounded-[8px] w-[134px] flex justify-between"
                                                    style="box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25);">
                                                    <button type="button"
                                                            class="mi text-gray-3 cursor-pointer hover:opacity-80 ">

                                                    </button>
                                                    @if($cart->product->kategori == "Tanaman")
                                                        <input type="number" readonly
                                                               class="focus:outline-none w-[60px] text-center font-xl-responsive hide-arrow hari-input"
                                                               x-bind:value="durasi" name="durasi_sewa[]"
                                                               value="{{$cart->durasi_sewa}}"/>
                                                    @else
                                                        <input type="hidden" value="" name="durasi_sewa[]">
                                                    @endif

                                                    @if($cart->product->kategori == "Layanan")
                                                        <input type="number" readonly
                                                               class="focus:outline-none w-[60px] text-center font-xl-responsive hide-arrow hari-input"
                                                               x-bind:value="durasi" name="durasi_perawatan[]"
                                                               value="{{$cart->durasi_perawatan}}"/>
                                                    @else
                                                        <input type="hidden" value="" name="durasi_perawatan[]">
                                                    @endif
                                                    <button type="button"
                                                            class="mi text-gray-3 cursor-pointer hover:opacity-80 ">

                                                    </button>
                                                </div>
                                                <div>{{$cart->product->kategori == "Layanan" ? 'Minggu' : 'Hari'}}</div>
                                            </div>
                                        @else
                                            <input type="hidden" value="" name="durasi_sewa[]">
                                            <input type="hidden" value="" name="durasi_perawatan[]">
                                        @endif
                                    </td>
                                    <td class="p-2 text-gray-2">Rp <span class="subtotal"
                                                                         data-subtotal="0">{{number_format($cart->product->harga * $cart->jumlah,0,",",".")}}</span>
                                        <input type="hidden" value="{{$cart->product->harga}}"
                                               name="harga[]">
                                    </td>
                                    <td class="p-2 text-gray-2">
                                    <span class="remove-bar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                             viewBox="0 0 32 32" class="cursor-pointer hover:opacity-80" fill="none">
                                            <path
                                                d="M16 0C12.8355 0 9.74207 0.938383 7.11088 2.69649C4.4797 4.45459 2.42894 6.95345 1.21793 9.87706C0.0069325 12.8007 -0.309921 16.0177 0.307443 19.1214C0.924806 22.2251 2.44866 25.0761 4.6863 27.3137C6.92394 29.5513 9.77487 31.0752 12.8786 31.6926C15.9823 32.3099 19.1993 31.9931 22.1229 30.7821C25.0466 29.5711 27.5454 27.5203 29.3035 24.8891C31.0616 22.2579 32 19.1645 32 16C32 11.7565 30.3143 7.68687 27.3137 4.68629C24.3131 1.68571 20.2435 0 16 0ZM24 22.1C24.2652 22.3652 24.4142 22.7249 24.4142 23.1C24.4142 23.4751 24.2652 23.8348 24 24.1C23.7348 24.3652 23.3751 24.5142 23 24.5142C22.6249 24.5142 22.2652 24.3652 22 24.1L16 18.1L10 24.12C9.86869 24.2513 9.71278 24.3555 9.5412 24.4266C9.36962 24.4976 9.18573 24.5342 9.00001 24.5342C8.81429 24.5342 8.63039 24.4976 8.45881 24.4266C8.28723 24.3555 8.13133 24.2513 8.00001 24.12C7.86869 23.9887 7.76451 23.8328 7.69344 23.6612C7.62237 23.4896 7.58579 23.3057 7.58579 23.12C7.58579 22.9343 7.62237 22.7504 7.69344 22.5788C7.76451 22.4072 7.86869 22.2513 8.00001 22.12L14 16.08L7.83001 9.86C7.56479 9.59478 7.41579 9.23507 7.41579 8.86C7.41579 8.48493 7.56479 8.12522 7.83001 7.86C8.09522 7.59478 8.45494 7.44579 8.83001 7.44579C9.20508 7.44579 9.56479 7.59478 9.83001 7.86L16 14.1L22.17 7.93C22.3013 7.79868 22.4572 7.69451 22.6288 7.62344C22.8004 7.55237 22.9843 7.51579 23.17 7.51579C23.3557 7.51579 23.5396 7.55237 23.7112 7.62344C23.8828 7.69451 24.0387 7.79868 24.17 7.93C24.3013 8.06132 24.4055 8.21722 24.4766 8.3888C24.5476 8.56038 24.5842 8.74428 24.5842 8.93C24.5842 9.11572 24.5476 9.29962 24.4766 9.4712C24.4055 9.64278 24.3013 9.79868 24.17 9.93L18 16.08L24 22.1Z"
                                                fill="#EB5757"/>
                                        </svg>
                                    </span>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="w-full xl:max-w-[327px]">
                        <div class="py-[32px] px-[24px]  rounded-[10px] "
                             style="box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25);">
                            <p class="font-lg-responsive">Ringkasan Belanja</p>
                            <div class="my-4">
                                <hr class="text-gray-4">
                            </div>
                            <div class="my-4 flex justify-between">
                                <p class="font-lg-responsive">Total Harga</p>
                                <p class="font-lg-responsive">Rp <span
                                        id="totalHarga">{{number_format($jml,0,",",".")}}</span></p>
                                <input type="hidden" value="{{$jml}}" name="total_semua">
                            </div>
                            <div class="mt-[40px]">
                                <button class="p-2 rounded-[8px] w-full text-white bg-primary font-lg-responsive"
                                        type="submit">Lanjut
                                </button>
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
                const moneyFormat = Intl.NumberFormat('en-US')
            })

        </script>
    @endsection
@endsection
