@extends("layouts.customer.main")

@section("content")
    <div class="wrapper">
        <div class="container" id="app">
            <div class="flex justify-between items-center gap-[18px] bg-gray-400">
                <div>
                    <div class="xl:hidden">
                        <span class="invisible md:hidden">ignore</span>
                        <x-modal>
                            <x-slot name="trigger">
                                <button x-on:click="show=true"
                                        class="btn cursor-pointer hover:opaciry-90 flex items-center gap-[12px] border border-gray-4 text-gray-3 p-2 rounded-md font-xl-responsive">
                                    <span>Filter</span>
                                    <span class="mi">
                                    menu
                                </span>
                                </button>
                            </x-slot>
                            <x-slot name="content">

                                <div class=" bg-white  w-full ">
                                    <div class="flex justify-end p-4 cursor-pointer" x-on:click="show=false"><span
                                            class="mi">close</span>
                                    </div>
                                    <div class="p-12">

                                        <x-layout.sidebar></x-layout.sidebar>
                                    </div>
                                </div>
                            </x-slot>
                        </x-modal>
                    </div>
                </div>
                <div>
                    <div class="flex flex-col md:flex-row md:gap-[18px] md:items-center">
                        <p class="font-xl-responsive text-gray-3 items-center">
                            Urutkan
                        </p>
                        <select name="" v-on:change="ambilPilihan($event)" id=""
                                class="text-gray-3 font-xl-responsive block p-2  border border-gray-3 rounded-md focus:ring-0 focus:outline-0">
                            <option value="baru">Terbaru</option>
                            <option value="tinggi">Harga Tertinggi</option>
                            <option value="rendah">Harga Terendah</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex gap-[40px] 2xl:gap-[96px] mt-[48px]">
                <div class="w-[252px]  flex-shrink-0 hidden xl:block">
                    <x-layout.sidebar></x-layout.sidebar>
                </div>
                <div class=" w-full  ">
                    <div class=" grid grid-cols-2 md:grid-cols-3 gap-[12px] md:gap-[60px]">
                        <template v-for="item in data">
                            <div class="rounded-[10px] w-full shadow-lg ">
                                <div class="flex flex-col justify-between h-full">
                                    <div>
                                        <img :src="`{{url('storage/images/product/')}}` + `/` +item.gambar" alt="" class="w-full aspect-square object-cover rounded-[10px]">
                                        <div class="pt-[24px] px-[16px] ">
                                            <div>
                                                <p class=" text-black-1 font-lg-responsive" v-text="item.nama"></p>
                                                <p class="mt-[10px]  font-lg-responsive" v-text="'Rp. ' + item.harga"></p>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="w-full mt-[24px] pb-[24px] px-[16px] ">
                                        <a :href="'/product/detail-' +  kategori(item.kategori) + '/' + item.id ">
                                            <button
                                                class="bg-orange w-full py-[8px] text-white rounded-[10px]  font-lg-responsive">
                                                Sewa
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </template>
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
        function reloadPage(e) {
            let filter = e.getAttribute("data-filter");
            const params = new URLSearchParams(window.location.search);
            console.log(filter);

            let kategori = params.get('kategori');
            let harga = params.get('harga');
            let lokasi = params.get('lokasi');
            let cahaya = params.get('cahaya');
            if (filter.split("=")[0] === "kategori") {
                kategori = filter.split("=")[1]
            } else if (filter.split("=")[0] === "harga") {
                harga = filter.split("=")[1]
            } else if (filter.split("=")[0] === "lokasi") {
                lokasi = filter.split("=")[1]
            } else if (filter.split("=")[0] === "cahaya") {
                cahaya = filter.split("=")[1]
            }

            let newurl = window.location.origin;
            location.href = `?kategori=${kategori}&harga=${harga}&lokasi=${lokasi}&cahaya=${cahaya}`
        }
    </script>
    <script>
        const data = new Vue({
            el: '#app',
            data: {
                data: [],
            },
            mounted() {
                axios.get("{{url('/getData')}}").then((response) => {
                    const params = new URLSearchParams(window.location.search);
                    this.data = response.data

                    let kategori = params.get('kategori');
                    let harga = params.get('harga');
                    let lokasi = params.get('lokasi');
                    let cahaya = params.get('cahaya');

                    if(kategori != 'null' && kategori){
                        this.data = this.data.filter((el) => el.kategori == kategori)
                    }

                    if(lokasi != 'null' && lokasi){
                        this.data = this.data.filter((el) => el.lokasi == lokasi)
                    }
                    if(cahaya != 'null' && cahaya){
                        this.data = this.data.filter((el) => el.intensitas_cahaya == cahaya)
                    }
                    if(harga != 'null' && harga){
                        if(harga == 'Di atas 10K'){
                            this.data = this.data.filter((el) => el.harga > 10000)
                        }

                        if(harga == 'Di bawah 10K'){
                            this.data = this.data.filter((el) => el.harga < 10000)
                        }
                    }
                })
            },
            methods: {
                ambilPilihan(e) {
                    var value = e.target.value
                    if(value == "rendah"){
                        this.data.sort((a,b)=> parseFloat(a.harga)-parseFloat(b.harga))
                    }
                    if(value == "tinggi"){
                        this.data.sort((b,a)=> parseFloat(a.harga)-parseFloat(b.harga))
                    }
                    if(value == "baru"){
                        this.data.sort((b,a)=> parseFloat(a.id)-parseFloat(b.id))
                    }
                    console.log(e.target.value)
                },
                kategori(e){
                    if(e == "Tanaman"){
                        return "tanaman"
                    }else if(e == "Layanan"){
                        return "layanan"
                    }else {
                        return "item"
                    }
                }
            },
        })
    </script>
@endsection
