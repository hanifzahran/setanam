@extends("layouts.admin.main",["active"=>"Pemesanan"])
@section("head")
    @if($menunggu > 0)
    <div class="px-[24px]">
        <div class="mt-[40px] ">
            <div
                class="border-2 border-l-[37px]  border-red-500 rounded-[10px] py-[24px] px-[32px] flex flex-col md:flex-row items-center gap-[24px] md:gap-[74px] max-w-[885px] ">
                <h5 class="h5 text-primary"> {{$menunggu}} Tanaman sedang menunggu untuk dikirim, yuk lakukan pengiriman</h5>
                <a href="/admin/pemesanan/daftar-pengiriman"
                   class=" text-end text-[#28B67E] font-medium flex items-center justify-end ">
                    <span class="whitespace-nowrap">Ke pengiriman</span>
                    <span class="mi ml-2 text-[#28B67E]">
                    arrow_forward
                </span>
                </a>
            </div>

        </div>
    </div>
    @endif
@endsection
@section("content")
    <div class="px-[24px]" id="app">
        <div class="flex justify-between flex-col md:flex-row ">
            <div>
                <h4 class="h4 text-primary font-semibold">Daftar pesanan</h4>
            </div>
            {{--            <div class="mt-8 md:mt-0">--}}
            {{--                <div class="flex flex-col md:flex-row md:gap-[18px] md:items-center">--}}
            {{--                    <h4 class="h5 text-primary font-semibold">Urutkan</h4>--}}
            {{--                    <select name="" id=""--}}
            {{--                            class="text-gray-3 font-xl-responsive block p-2  border border-gray-3 rounded-md focus:ring-0 focus:outline-0">--}}
            {{--                        <option value="">Nama tanaman</option>--}}
            {{--                        <option value="">Nama penyewa</option>--}}
            {{--                        <option value="">Jumlah tanaman</option>--}}
            {{--                        <option value="">Status</option>--}}
            {{--                    </select>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
        <div class="mt-[40px] overflow-x-auto ">
            <table class="w-full  min-w-[1000px]">
                <thead>
                <tr class="border-b border-gray-5 ">
                    <td class="text-center text-gray-4 font-md font-semibold p-4">No</td>
                    <td class="text-center text-gray-4 font-md font-semibold p-4">Tanggal Pemesanan</td>
                    <td class=" text-gray-4 font-md font-semibold p-4 text-center">Nama penyewa</td>
                    <td class="text-center text-gray-4 font-md font-semibold p-4">Jumlah pesanan</td>
                    <td class="text-start text-gray-4 font-md font-semibold p-4">Status</td>
                </tr>
                </thead>
                <tbody>
                <template v-for="(item, index) in data">
                    <tr class="border-b border-gray-5 cursor-pointer hover:bg-gray-5 " @click="detail_modal(item.id)">
                        <td class="p-4 font-bold text-center text-primary">
                            @{{index+1}}
                        </td>
                        <td class="p-4 font-bold text-center text-primary">
                            @{{ new Date(item.updated_at).toLocaleString() }}
                        </td>

                        <td class="p-4 font-bold text-center text-primary">
                            @{{ item.users.fullname }}
                        </td>
                        <td class="p-4 font-bold text-center text-gray-3">
                            @{{ item.order_details.length }}
                        </td>
                        <td>
                            <span class="px-4 py-1 font-semibold text-white bg-[#27AE60] rounded-[10px]"
                                  v-if="item.status_pembayaran == 3">Lunas</span>
                            <span class="px-4 py-1 font-semibold text-white bg-[#E2B93B] rounded-[10px]"
                                  v-if="item.status_pembayaran != 3">Belum</span>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>


        <div class="mt-[40px] invisible" id="modal">
            <div class="fixed inset-0 bg-gray-5 bg-opacity-75 transition-opacity"></div>
            <div class="fixed z-10 inset-0 overflow-y-auto ">
                <div class="flex justify-center min-h-full items-center  " id="outside-modal">
                    <div class="flex-shrink-0 max-w-[1129px] w-full  p-2 " id="inside-modal">
                        <div class="bg-white  rounded-[10px]">
                            <div class="flex justify-between p-4">
                                <h4
                                    class="h5 text-primary font-semibold open-modal cursor-pointer hover:opacity-80 my-3 text-center">
                                    Detail pesanan
                                </h4>
                                <span class="mi cursor-pointer hover:opacity-80" id="close-modal">
                                close
                            </span>
                            </div>
                            <div class="p-[24px] md:p-[40px] text-gray-3 ">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-[24px]">
                                    <div class="md:border-r border-gray-4">
                                        <h5 class="font-xl-responsive font-medium" id="nama_penyewa">@{{ user.fullname
                                            }}</h5>
                                        <h5 class="font-xl-responsive font-medium mt-[24px]" id="alamat_penyewa">
                                            @{{ user.address }}
                                        </h5>
                                    </div>
                                    <div>
                                        <template v-for="item in order_item">
                                            <div class="flex justify-between">
                                                <h5 class="font-xl-responsive font-medium" id="nama_tanaman">@{{
                                                    item.products.nama }}</h5>
                                                <h5 class="font-xl-responsive font-medium" id="jumlah_item">
                                                    @{{ item.jumlah }} Item
                                                </h5>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            <div class="p-[24px] md:p-[40px] text-gray-3 ">
                                <div class=" overflow-y-auto">
                                    <div class="min-w-[800px]">
                                        <table class="w-full" cellpadding="5">
                                            <tr class="">
                                                <td class="font-xl-responsive font-medium border-r-2 border-gray-4">
                                                    Durasi
                                                    sewa
                                                </td>
                                                <td class="font-xl-responsive font-medium pl-8">@{{ durasi_sewa > 0 ?
                                                    durasi_sewa + ' hari' : '-'}}
                                                </td>
                                                <td class="font-xl-responsive font-medium" rowspan="4">
                                                    <img src="/core-images/koran.png" alt="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="font-xl-responsive font-medium border-r-2 border-gray-4">
                                                    Layanan
                                                    perawatan
                                                </td>
                                                <td class="font-xl-responsive font-medium pl-8">
                                                    <template v-for="item in layanan">
                                                        @{{ item + ", " }}
                                                    </template>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="font-xl-responsive font-medium border-r-2 border-gray-4">
                                                    Jumlah
                                                    perawatan
                                                </td>
                                                <td class="font-xl-responsive font-medium pl-8">@{{ jumlah_perawatan > 0
                                                    ? jumlah_perawatan + ' kali seminggu' : '-'}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="font-xl-responsive font-medium border-r-2 border-gray-4">
                                                    Durasi
                                                    perawatan
                                                </td>
                                                <td class="font-xl-responsive font-medium pl-8">@{{ durasi_perawatan > 0
                                                    ? durasi_perawatan + ' minggu' : '-'}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="font-xl-responsive font-medium border-r-2 border-gray-4">
                                                    Total
                                                    pembayaran
                                                </td>
                                                <td class="font-xl-responsive font-medium pl-8">Rp @{{
                                                    Intl.NumberFormat('id-ID').format(detail.total) }}  <span
                                                        class="ml-8 px-4 py-2 text-white font-md rounded-[10px] bg-[#27AE60]" v-if="detail.status_pembayaran == 3">Lunas</span>
                                                    <span
                                                        class="ml-8 px-4 py-2 text-white font-md rounded-[10px] bg-[#EB5757]" v-else>Belum</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.10/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
    <script>
        $(function () {
            $("#outside-modal").on('click', function () {
                $("#modal").addClass("invisible");
            })

            $("#close-modal").on('click', function () {
                $("#modal").addClass("invisible");
            })

            $("#inside-modal").on('click', function (e) {
                e.stopPropagation();
            })
        })
    </script>
    <script>
        const data = new Vue({
            el: "#app",
            data: {
                data: [],
                detail: [],
                user: [],
                order_item: [],
                layanan: [],
                durasi_sewa: 0,
                durasi_perawatan: 0,
                jumlah_perawatan: 0,
                total: 0
            },
            mounted() {
                axios.get('/admin/pemesanan/data-pesanan').then((response) => {
                    this.data = response.data
                })
            },
            methods: {
                detail_modal(id) {
                    this.durasi_sewa = 0
                    this.durasi_perawatan = 0
                    this.jumlah_perawatan = 0
                    var durasi_sewa = 0
                    var durasi_perawatan = 0
                    var jumlah_perawatan = 0
                    var layanan = []

                    var ambil = this.data.filter((el) => el.id == id)
                    this.detail = ambil[0]
                    this.user = ambil[0].users

                    ambil[0].order_details.forEach(function (item) {
                        if (item) {
                            durasi_sewa += parseInt(item.durasi_sewa > 0 ? item.durasi_sewa : 0)
                            durasi_perawatan += parseInt(item.durasi_perawatan > 0 ? item.durasi_perawatan : 0)
                            jumlah_perawatan += parseInt(item.jumlah> 0 ? item.jumlah : 0)
                            console.log(durasi_sewa)
                        }
                    })
                    var product = ambil[0].order_details
                    product.forEach(function (item) {
                        if (item.products.kategori == "Layanan") {
                            layanan.push(item.products.nama)
                        }
                    })

                    this.durasi_sewa = durasi_sewa
                    this.durasi_perawatan = durasi_perawatan
                    this.jumlah_perawatan = jumlah_perawatan
                    this.layanan = layanan

                    this.order_item = ambil[0].order_details
                    $("#modal").removeClass("invisible");
                }
            }
        })
    </script>
@endsection
