@extends("layouts.customer.main")

@section("content")
<div class="wrapper">
    <div class="container">
        <h3 class="third-heading">Data Pengembalian</h3>
        <p class="font-lg-responsive text-gray-2 mt-[8px]">Isi data detail dari pengembalian</p>
        <form action="">
            <div class="mt-[60px] md:mt-[100px]">
                
                <div>
                    <label for="" class="text-gray-2">Tanggal pengembalian</label>
                    <input type="date" name="" id="" cols="30" rows="10" 
                        class="rounded-[10px] border border-gray-4 w-full text-lg p-2 mt-2 focus:outline-none hover:border-warning" />
                </div>
                <div class="mt-[24px]">
                    <div>
                        <label for="" class="text-gray-2">Jam Pengembalian</label>
                        <input name="" id="" cols="30" rows="10"
                            class="rounded-[10px] border border-gray-4 w-full text-lg p-2 mt-2 focus:outline-none hover:border-warning" />
                    </div>
                </div>
                <div class="mt-[24px]">
                    <div>
                        <label for="" class="text-gray-2">Jam Pengembalian</label>
                        <select name="" id=""
                            class="rounded-[10px] border border-gray-4 w-full text-lg p-2 mt-2 focus:outline-none hover:border-warning">
                            <option value="">Mengantar secara mandiri</option>
                            <option value="">Dijemput oleh tim kami</option>
                        </select>
                    </div>
                </div>
                <div class="mt-[80px] flex justify-end">
                    <button
                        class="button font-lg-responsive bg-primary  text-white rounded-[10px] py-[10px] w-full md:w-[511px]">
                        Konfirmasi Pengembalian
                    </button>
                </div>
        </form>
    </div>
</div>
@endsection