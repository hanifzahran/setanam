@extends("layouts.admin.main",["active" => "Beranda"])

@section("content")
<div class="px-[24px]">
    <div class=" ">
        <div>
            <h4 class="h4 text-primary font-semibold">Form edit</h4>
        </div>

    </div>
    <form action="{{url('/admin/ubah-layanan/'.$product->id.'/update')}}" method="post" enctype="multipart/form-data" class="mt-[32px] max-w-[1175px]">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-[32px]">
            <div>
                <label class="text-lg text-gray-3">Kategori</label>
                <input type="text" value="Layanan" readonly name="kategori"
                    class="rounded-[10px] border border-gray-4 bg-gray-5  text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full" />
            </div>
            <div>
                <label class="text-lg text-gray-3">Nama Item</label>
                <input type="text" name="nama" value="{{$product->nama}}"
                    class="rounded-[10px] border border-gray-4  text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full" />
            </div>
        </div>
        <div class="grid grid-cols-1 mt-[32px]">
            <div>
                <label class="text-lg text-gray-3">Deskripsi item</label>
                <input type="text" name="deskripsi" value="{{$product->deskripsi}}"
                    class="rounded-[10px] border border-gray-4  text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full" />
            </div>
        </div>





        <div class="mt-[32px] grid grid-cols-1 md:grid-cols-3 gap-[32px]">
            <div>
                <label class="text-lg text-gray-3">Upload gambar</label>
                <div
                    class="rounded-[10px] border border-gray-4  text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full flex justify-between items-center input-file-group">
                    <span class="file-name truncate"> No file selected</span>

                    <button type="button"
                        class="bg-primary py-1 px-2 text-white rounded-[10px] cursor-pointer hover:opacity-80 input-file-button">Browse</button>
                    <input type="file" name="gambar"
                        class="rounded-[10px] border border-gray-4  text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full hidden input-file" />
                </div>
            </div>
            <div>
                <label class="text-lg text-gray-3">Input lokasi</label>
                <select name="lokasi" id=""
                    class="rounded-[10px] border border-gray-4  h-[50px] text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full">
                    <option value="Jakarta" {{$product->lokasi == "Jakarta" ? 'selected' : ''}}>Jakarta</option>
                    <option value="Bandung" {{$product->lokasi == "Bandung" ? 'selected' : ''}}>Bandung</option>
                    <option value="Surabaya" {{$product->lokasi == "Surabaya" ? 'selected' : ''}}>Surabaya</option>
                </select>
            </div>
            <div>
                <div class="w-full ">
                    <label class="text-lg text-gray-3">Input harga</label>
                    <div class=" flex gap-2 items-center w-full input-with-button">
                        <div class="mt-2  items-center py-2 px-1 rounded-[8px]  flex justify-between w-full "
                            style="box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25);">
                            <button type="button"
                                class="mi text-gray-3 cursor-pointer hover:opacity-80 tblPlusJumlah  ">add</button>
                            <div class="flex items-center">
                                <span class="text-gray-3 ml-2">Rp</span>
                                <input type="number"
                                    class="focus:outline-none  text-center font-lg hide-arrow jumlah-input w-full "
                                       name="harga" value="{{$product->harga}}" />
                            </div>
                            <button type="button"
                                class="mi text-gray-3 cursor-pointer hover:opacity-80 tblMinJumlah ">remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-[32px] flex flex-col md:flex-row justify-end gap-[32px]">
            <button class="btn-center bg-primary md:w-[348px] text-white" type="submit">Ubah</button>
            <a href="/admin/ubah" class="flex items-center">
                <button class="font-xl-responsive  md:w-[348px]" type="button">Batal</button>
            </a>
        </div>
    </form>
</div>

@section("script")
<script>
    $(".tblPlusJumlah").on('click',function (e) {
        let parent =  $(this).parents(".input-with-button");
        let input =parent.find("input");

        input.val(parseInt(input.val()) + 1);
    });
    $(".tblMinJumlah").on('click',function (e) {
        let parent =  $(this).parents(".input-with-button");
        let input =parent.find("input");
        if(parseInt(input.val()) > 0 ){

            input.val(parseInt(input.val()) - 1);
        }
    });

    $(".input-file-button").on('click',function(){
        let parent =  $(this).parents(".input-file-group");
        parent.find("input").click();
    })

    $(".input-file").on("input",function(e){
        let parent =  $(this).parents(".input-file-group");
        parent.find(".file-name").text(e.target.files[0].name);
    })


</script>
@endsection

@endsection
