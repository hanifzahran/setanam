@extends("layouts.customer.main")

@section("content")
    <div class="wrapper">
        <div class="container">
            <form action="/product/bayar" id="submit_form" method="post">
                @csrf
                @foreach($request->id as $item)
                    <input type="hidden" name="id[]" value="{{$item}}">
                @endforeach
                @foreach($request->product_id as $item)
                    <input type="hidden" name="product_id[]" value="{{$item}}">
                @endforeach
                @foreach($request->durasi_perawatan as $item)
                    <input type="hidden" name="durasi_perawatan[]" value="{{$item}}">
                @endforeach
                @foreach($request->durasi_sewa as $item)
                    <input type="hidden" name="durasi_sewa[]" value="{{$item}}">
                @endforeach
                @foreach($request->jumlah as $item)
                    <input type="hidden" name="jumlah[]" value="{{$item}}">
                @endforeach
                @foreach($request->harga as $item)
                    <input type="hidden" name="total[]" value="{{$item}}">
                @endforeach
                <input type="hidden" name="total_semua" value="{{$request->total_semua}}">
                <input type="hidden" name="json_callback" id="json_callback" value="">
            </form>
            <h3 class="third-heading">Konfirmasi Pembayaran</h3>
            <div class="w-full  p-[40px] mt-[68px] rounded-[10px]" style="box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25);">
                <table style="width: 100%; text-align: center">
                    <tr style="border: black solid">
                        <td>Nama Produk</td>
                        <td>Jumlah</td>
                        <td>Harga</td>
                        <td>Total Harga</td>
                    </tr>
                    @foreach($data as $item)
                        <tr>
                            <td>{{$item['name']}}</td>
                            <td>{{$item['quantity']}}</td>
                            <td>{{$item['price']}}</td>
                            <td>{{$item['price'] * $item['quantity']}}</td>
                        </tr>
                    @endforeach
                    <tr style="font-weight: bold">
                        <td colspan="3">Total</td>
                        <td>{{$semua}}</td>
                    </tr>
                </table>
            </div>

            <div class="flex items-end flex-col gap-[32px] mt-[96px]">
                <button id="pay-button"
                        class="button font-lg-responsive bg-primary  text-white rounded-[10px] py-[19px] w-full md:w-[511px]">
                    Bayar
                </button>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{env("MIDTRANS_CLIENT_KEY")}}"></script>
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{$snapToken}}', {
                onSuccess: function (result) {
                    /* You may add your own implementation here */
                    alert("payment success!");
                    send_response(result);
                },
                onPending: function (result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    send_response(result);
                },
                onError: function (result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    send_response(result);
                },
                onClose: function () {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            });
            // customer will be redirected after completing payment pop-up
        });

        function send_response(response) {
            document.getElementById('json_callback').value = JSON.stringify(response)
            $('#submit_form').submit()
        }
    </script>
@endsection
