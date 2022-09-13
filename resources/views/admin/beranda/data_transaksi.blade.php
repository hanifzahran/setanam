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
    <div class="px-[24px]" id="app">
        <div class="grid grid-col-1  lg:grid-cols-2 xl:grid-cols-3 gap-[32px]">
            <div class=" p-[24px] rounded-[10px]" style="box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25);">
                <h6 class="h6 font-bold text-primary">Total pemasukan</h6>
                <p class="font-sm font-bold text-gray-4 mt-2">{{$bulan}}</p>

                <div class="flex items-start font-bold text-primary mt-[32px]">
                    <p class="text-[20px] ">Rp </p>
                    <h1 class="h1"> @{{ Intl.NumberFormat('id-ID').format(pemasukan) }}</h1>
                </div>
            </div>
            <div class=" p-[24px] rounded-[10px]" style="box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25);">
                <h6 class="h6 font-bold text-primary">Total Pending</h6>
                <p class="font-sm font-bold text-gray-4 mt-2">{{$bulan}}</p>

                <div class="flex items-start font-bold text-primary mt-[32px]">
                    <p class="text-[20px] ">Rp </p>
                    <h1 class="h1"> @{{ Intl.NumberFormat('id-ID').format(pending) }}</h1>
                </div>
            </div>
            <div class=" p-[24px] rounded-[10px]" style="box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25);">
                <h6 class="h6 font-bold text-primary">Data customer</h6>
                <p class="font-sm font-bold text-gray-4 mt-2">{{$bulan}}</p>

                <div class="flex justify-between ">
                    <div class=" font-bold text-primary mt-[32px]">
                        <h1 class="h1">{{$totalUser}}</h1>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="97" height="97" viewBox="0 0 97 97" fill="none">
                            <path
                                d="M80.5262 41.9648C80.8321 41.2261 80.9121 40.4132 80.756 39.6291C80.5999 38.8449 80.2147 38.1246 79.6491 37.5594L59.4408 17.3511L53.7259 23.066L67.0351 36.3752H16.1667V44.4585H76.7917C77.591 44.4587 78.3724 44.2219 79.0371 43.7781C79.7018 43.3342 80.22 42.7032 80.5262 41.9648ZM16.4738 55.0356C16.1679 55.7743 16.0879 56.5872 16.244 57.3713C16.4001 58.1555 16.7853 58.8758 17.3509 59.441L37.5592 79.6493L43.2741 73.9344L29.9649 60.6252H80.8333V52.5419H20.2083C19.4089 52.5411 18.6273 52.7777 17.9624 53.2217C17.2976 53.6656 16.7795 54.2969 16.4738 55.0356Z"
                                fill="#BDBDBD"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        {{--        <div class="my-8 flex justify-end">--}}
        {{--            <button type="button" class="underline font-semibold open-modal">Lihat Grafik</button>--}}
        {{--        </div>--}}

        <div class="flex justify-between mt-[40px]">
            <div>
                <h4 class="h4 text-primary font-semibold">List Item</h4>
            </div>
            <div>
                <div class="flex flex-col md:flex-row md:gap-[18px] md:items-center">
                    <h4 class="h5 text-primary font-semibold">Urutkan</h4>
                    <select name="" id="" @change="ambilPilihan($event)"
                            class="text-gray-3 font-xl-responsive block p-2  border border-gray-3 rounded-md focus:ring-0 focus:outline-0">
                        <option value="date">Date</option>
                        <option value="status">Status</option>
                        <option value="total">Total pembayaran</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mt-[40px] overflow-x-auto ">
            <table class="w-full  min-w-[1000px]">
                <thead>
                <tr class="border-b border-gray-5 ">
                    <td class="text-start text-gray-4 font-md font-semibold p-4">No</td>
                    <td class="text-start text-gray-4 font-md font-semibold p-4">Status</td>
                    <td class=" text-gray-4 font-md font-semibold p-4 text-center">Date</td>
                    <td class="text-start text-gray-4 font-md font-semibold p-4">Total Pembayaran</td>
                </tr>
                </thead>
                <tbody>
                <template v-for="(data, index) in list">
                    <tr class="border-b border-gray-5 ">
                        <td class="p-4 font-bold text-primary">
                            @{{index+1}}
                        </td>
                        <td>
                            <span class="px-4 py-1 font-semibold text-white bg-[#27AE60] rounded-[10px]" v-if="data.status == 3">Active</span>
                            <span class="px-4 py-1 font-semibold text-white bg-[#E2B93B] rounded-[10px]" v-if="data.status != 3">Pending</span>
                        </td>
                        <td class="p-4 font-bold text-center text-gray-3">
                            @{{ new Date(data.updated_at).toLocaleString() }}
                        </td>

                        <td class="p-4 font-bold text-start whitespace-nowrap text-gray-3">
                            Rp @{{ Intl.NumberFormat('id-ID').format(data.total) }}
                        </td>
                    </tr>
                </template>

                </tbody>
            </table>
        </div>

        <div class="mt-[40px] invisible" id="modal">
            <form action="">
                <div class="fixed inset-0 bg-gray-5 bg-opacity-75 transition-opacity"></div>
                <div class="fixed z-10 inset-0 overflow-y-auto ">
                    <div class="flex justify-center min-h-full items-center  " id="outside-modal">
                        <div class="flex-shrink-0 max-w-[800px] w-full  p-2 " id="inside-modal">
                            <div class="bg-white  rounded-[10px]">
                                <div class="flex justify-end p-4">
                                <span class="mi cursor-pointer hover:opacity-80" id="close-modal">
                                    close
                                </span>
                                </div>
                                <div class="p-[24px] md:p-[40px] lg:p-[60px]">
                                    <div class="flex justify-between">
                                        <div>
                                            <h4 class="font-medium h4">Laporan transaksi</h4>
                                            <h4 class="font-medium h4">12</h4>
                                            <p class="text-gray-4">Transaksi</p>
                                        </div>
                                        <div class="mr-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none">
                                                <circle cx="12" cy="12" r="12" fill="#BDBDBD"/>
                                                <rect x="10" y="9.33301" width="3.99999" height="10.6666" rx="2"
                                                      fill="white"/>
                                                <rect x="10" y="4" width="3.99999" height="3.99999" rx="2"
                                                      fill="white"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="my-5">
                                        <hr class="text-gray-5">
                                    </div>
                                    <div id="chart_div" class="" style="width: 100%; height: 300px;"></div>

                                    <div class="flex gap-12 mt-3">
                                        <p class="flex items-center">
                                        <span class="mi text-[#F94144]">
                                            fiber_manual_record
                                        </span>
                                            <span> Product 1</span>
                                        </p>
                                        <p class="flex items-center">
                                        <span class="mi text-[#F3722C]">
                                            fiber_manual_record
                                        </span>
                                            <span> Product 1</span>
                                        </p>
                                        <p class="flex items-center">
                                        <span class="mi text-[#F8961E]">
                                            fiber_manual_record
                                        </span>
                                            <span> Product 3</span>
                                        </p>


                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section("script")
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.10/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawBasic);

        function drawBasic() {

            var data = google.visualization.arrayToDataTable([
                ['', '', {role: 'style'}],
                ['Xs', 75, '#F94144'],            // RGB value
                ['S', 125, '#F3722C'],            // English color name
                ['M', 175, '#F8961E'],

            ]);

            var options = {
                title: '',
                legend: {position: 'none'},

                bar: {groupWidth: "10%"},
                chartArea: {
                    left: 50,
                    width: '100%',
                    height: '80%',
                }
            };

            var chart = new google.visualization.ColumnChart(
                document.getElementById('chart_div'));

            chart.draw(data, options);
        }

        $(function () {

            $("#outside-modal").on('click', function () {
                $("#modal").addClass("invisible");
            })

            $(".open-modal").on('click', function () {

                $("#modal").removeClass("invisible");
                $("#modal").attr("action", $(this).data("url-submit"));

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
                pemasukan: {{$pemasukan}},
                pending: {{$pending}},
                list: null
            },
            mounted() {
                axios.get('/admin/data-transaksi').then((response) => {
                    this.list = response.data
                })
            },
            methods: {
                ambilPilihan(e) {
                    var value = e.target.value
                    if(value == "status"){
                        this.list.sort((b,a)=> parseFloat(a.status)-parseFloat(b.status))
                    }
                    if(value == "date"){
                        this.list.sort((a,b)=> parseFloat(a.updated_at)-parseFloat(b.updated_at))
                    }
                    if(value == "total"){
                        this.list.sort((b,a)=> parseFloat(a.total)-parseFloat(b.total))
                    }
                }
            }
        });
    </script>
@endsection
