<div class="teal w100" style="height:135px;">
  <div class="pc-container auto-margin h100">
    <div style="font-size:2em; line-height:135px;">
      ชำระเงิน
    </div>
  </div>
</div>

<div class="pc-container auto-margin" style="min-height:50vh">

  <div class="row">
    <div class="col w70">
      @foreach ($data as $course)
        <div class="row card-panel">
          <div class="col w20">
            <a href="{{ url('/') }}/view/{{ $course->slug }}">
              <img src="{{ url('/') }}/{{ $course->cover_image }}" 
                style="width:125px; height:75px;"> 
            </a>
          </div>

          <div class="col w60">
            <div>
              {{ $course->title }}
            </div>
            <div>
              โดย {{ $course->user->name }} {{ $course->user->last_name }}
            </div>
          </div>

          <div class="col w10">
            @if ($course->promotion === null)
              ฿{{ $course->price }}
            @else
              <span style="text-decoration: line-through;">
                ฿{{ $course->price }}
              </span>
              ฿{{ $course->discounted_price }}
            @endif
          </div>
        </div>
      @endforeach
    
    </div>

    <div class="col w30 card-panel center-align">
      ราคาสุทธิ
      <div>
        ฿{{ $totalPrice }}
      </div>
      <div class="center-align" style="margin-bottom: 25px;">
        <div id="paypal-button"></div>
        <!-- <a class="waves-effect waves-light btn" style="display: block;">ยืนยันการชำระเงิน</a> -->
        <!-- <a class="waves-effect waves-light btn" style="display: block;">Redeem Coupon</a> -->
      </div>
    </div>

  </div>

</div>

{{--  PAYPAL COMPLETED PAYMENT  --}}
<form id="paypal-form" method="POST" action="/checkout">
  {{ csrf_field() }}

  <input type="hidden" name="pay_id">
  <input type="hidden" name="created_time">

  <input type="hidden" name="payer_id">
  <input type="hidden" name="payer_email">
  <input type="hidden" name="payer_first_name">
  <input type="hidden" name="payer_last_name">
  <input type="hidden" name="payer_middle_name">

  <input type="hidden" name="total">
  <input type="hidden" name="custom">
  <input type="hidden" name="invoice_number">
  <input type="hidden" name="transaction_id">
  <input type="hidden" name="status">
</form>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
  paypal.Button.render({

    env: 'production', // Or 'sandbox',

    client: {
      sandbox:    'AcghnZmlBgyNeV51Gv3RpjUQHmfbCZGlY5l8TZ3sO-0m2j-E3F2obAalq7OQiqmZuZa28K1ioCwdt93I',
      production: 'AXQUcew_-cGDNjixhWlvcD7FDR1Mz7Eo_rf8aOJsNEgbRvYaDpneqM-0dix78IjTivxfMEKY4eodkw8u'
    },

    commit: true, // Show a 'Pay Now' button

    style: {
      layout: 'vertical',  // horizontal | vertical
      size:   'medium',    // medium | large | responsive
      shape:  'rect',      // pill | rect
      color:  'blue'       // gold | blue | silver | black
    },

    /* 
     * Payment Data
     */
    payment: function(data, actions) {
      return actions.payment.create({
        payment: {
          transactions: [
            {
              amount: { 
                total: '{{ $totalPrice }}', 
                {{--  total: '0.45',   --}}
                currency: 'THB' 
              },
              invoice_number: "{{ $rand_invoice }}",
              custom: "{{ $course_ids }}",
              item_list: {
                items: <?= json_encode($paypalItems) ?>
                
                {{--  items: [
                  {"name":"Learn Java","quantity":"1","price":0.3,"currency":"THB"},
                  {"name":"Javascipt Foundation","quantity":"1","price":"0.1","currency":"THB"},
                  {"name":"AJAX Crash Course","quantity":"1","price":"0.05","currency":"THB"}
                ]  --}}
              }
            }
          ]
        }
      });
    },


    




    /* 
     * Execute Paypal
     */
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function(payment) {
        alert(payment);
        console.log(payment);
        console.log(data);
        
        $('input[name="pay_id"]').val(payment.id);
        $('input[name="created_time"]').val(payment.create_time);

        $('input[name="payer_id"]').val(payment.payer.payer_info.payer_id);
        $('input[name="payer_email"]').val(payment.payer.payer_info.email);
        $('input[name="payer_first_name"]').val(payment.payer.payer_info.first_name);
        $('input[name="payer_last_name"]').val(payment.payer.payer_info.last_name);
        $('input[name="payer_middle_name"]').val(payment.payer.payer_info.middle_name);

        $('input[name="total"]').val(payment.transactions[0].amount.total);
        $('input[name="custom"]').val(payment.transactions[0].custom);
        $('input[name="invoice_number"]').val(payment.transactions[0].invoice_number);

        $('input[name="transaction_id"]').val(payment.transactions[0].related_resources[0].sale.id);
        $('input[name="status"]').val(payment.transactions[0].related_resources[0].sale.state);
        $("#paypal-form").submit();
      });
    },

   /* 
   * Buyer cancelled the payment 
   */
    onCancel: function(data, actions) {
      alert('ยกเลิกการชำระเงิน');
      console.log(data);
    },

    /* 
     * An error occurred during the transaction 
     */
    onError: function(err) {
      alert(err);
      console.log(err);
    }

  }, '#paypal-button');
</script>
