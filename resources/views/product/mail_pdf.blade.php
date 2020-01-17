        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <td>
                        <h1 style="font-family:Arial; font-size:20px; font-weight:700; margin:20px 0 24px 0; text-align:center">
                        Obrigado pela tua encomenda!</h1>
                        </td>
                        </tr>
                  <tr>
                    <td valign="middle" class="x_content" style="font-family:Arial; margin:0 auto; padding:0 10px; font-size:13px; line-height:20px; max-width:600px; text-align:center">
                        Olá {{Auth::user()->name}}! O seu pagamento foi bem sucedido e a sua encomenda está confirmada.
                        Agradecemos a sua compra. Segue em anexo o seu comprovativo de pagamento em formato PDF.
                        <br style="font-family:Arial; margin:0; padding:0">
                        <br style="font-family:Arial; margin:0; padding:0">
                        <p style="font-family:Arial; font-weight:700; font-size:12px; margin-bottom:24px; text-align:center">
                        Esperamos que gostes!</p>
                    </td>
                  </tr>
                </thead>
              </table>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Quantity</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                {{!$products = Cart::getContent()}}
                @if($products)
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->price }}&euro;</td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
                <strong>Total Quantity:{{ Cart::getTotalQuantity()}}<br>Total: {{ Cart::getSubTotal() }}&euro;</strong>
          </div>
        </div>
