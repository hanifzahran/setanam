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
    <div class="flex justify-between flex-col md:flex-row ">
        <div>
            <h4 class="h4 text-primary font-semibold">List Item</h4>
        </div>
        <div class="mt-8 md:mt-0">
            <div class="flex flex-col md:flex-row md:gap-[18px] md:items-center">
                <h4 class="h5 text-primary font-semibold">Urutkan</h4>
                <select name="" id="" @change="ambilPilihan($event)"
                    class="text-gray-3 font-xl-responsive block p-2  border border-gray-3 rounded-md focus:ring-0 focus:outline-0">
                    <option value="nama">Nama</option>
                    <option value="username">Username</option>
                    <option value="email">Email</option>
                </select>
            </div>
        </div>
    </div>
    <div class="mt-[40px] overflow-x-auto ">
        <table class="w-full  min-w-[1000px]">
            <thead>
                <tr class="border-b border-gray-5 ">
                    <td class="text-start text-gray-4 font-md font-semibold p-4">No</td>
                    <td class="text-start text-gray-4 font-md font-semibold p-4">Nama Lengkap</td>
                    <td class=" text-gray-4 font-md font-semibold p-4 text-center">Username</td>
                    <td class="text-center text-gray-4 font-md font-semibold p-4">Email</td>
                    <td class="text-start text-gray-4 font-md font-semibold p-4">Alamat</td>
                </tr>
            </thead>
            <tbody>
            <template v-for="(list, index) in data">
                <tr class="border-b border-gray-5 ">
                    <td class="p-4 font-bold text-primary">
                        @{{  index+1 }}
                    </td>
                    <td class="p-4 font-bold text-primary">
                        @{{ list.fullname }}
                    </td>
                    <td class="p-4 font-bold text-center  text-gray-3">
                        @{{ list.username }}
                    </td>
                    <td class="p-4 font-bold text-center text-gray-3">
                        @{{ list.email }}
                    </td>
                    <td class="p-4 font-bold text-start whitespace-nowrap text-gray-3 truncate max-w-[200px]">
                        @{{ list.address }}
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>

</div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.10/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
    <script>
        const data = new Vue({
            el: '#app',
            data: {
                data: []
            },
            mounted() {
                axios.get('/admin/data-customer').then((response) => {
                    this.data = response.data
                })
            },
            methods: {
                ambilPilihan(e){
                    var value = e.target.value
                    if(value == "nama"){
                        this.data.sort((a,b)=> a.fullname.localeCompare(b.fullname))
                    }
                    if(value == "email"){
                        this.data.sort((a,b)=> a.email.localeCompare(b.email))
                    }
                    if(value == "username"){
                        this.data.sort((a,b)=> a.username.localeCompare(b.username))
                    }
                }
            }
        });
    </script>
@endsection
