<!DOCTYPE html>
<html>
  <head>
    
    <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> 
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>

  </head>

  <body>

  <form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">

    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="business" value="up.afterschool20@gmail.com">
    <input type="hidden" name="currency_code" value="THB">
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="no_shipping" value="1">

    <input type="hidden" name="email" value="knight_baberon@hotmail.com">
    {{--  <input type="hidden" name="invoice" value="xxasda36">  --}}
  
    <input type="hidden" name="item_name_1" value="COURSE #11">
    <input type="hidden" name="amount_1" value="10">
    <input type="hidden" name="item_name_2" value="COURSE #12">
    <input type="hidden" name="amount_2" value="5">

    {{--  <input type="hidden" name="custom" value="{\"pro1\": \"blaaaa\",\"pro2\" : \"wowwww\"}">  --}}
    {{--  <input type="hidden" value="0.75" name="discount_amount_1"> --}}
    {{--  <input type="hidden" value="11255XXX" name="invoice">  --}}

    <input type="hidden" name="rm" value="2">
    <input type="hidden" name="return" value="http://localhost/paypal/confirm" />
    <input type="hidden" name="cancel_return" value="http://localhost/view/ajax-crash-course" />
    {{--  <input type="hidden" name="notify_url" value="http://localhost/view/learn-java">  --}}
    
    <input type="image" src="http://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"         border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
  </form>

  <div id="paypal-button"></div>

    <script>
        paypal.Button.render({

            env: 'production', // Or 'sandbox',

            client: {
              sandbox:    'AcghnZmlBgyNeV51Gv3RpjUQHmfbCZGlY5l8TZ3sO-0m2j-E3F2obAalq7OQiqmZuZa28K1ioCwdt93I',
              production: 'AXQUcew_-cGDNjixhWlvcD7FDR1Mz7Eo_rf8aOJsNEgbRvYaDpneqM-0dix78IjTivxfMEKY4eodkw8u'
            },

            commit: true, // Show a 'Pay Now' button

            style: {
                color: 'gold',
                size: 'small'
            },

            payment: function(data, actions) {
              return actions.payment.create({
                payment: {
                  transactions: [
                    {
                      amount: { 
                        total: '0.2', 
                        currency: 'THB' 
                      },
                      invoice_number: "77130989673",
                      custom: "EBAY_EMS_90048630024435",
                      item_list: {
                        items: [
                          {
                            name: 'COURSE01A',
                            quantity: '1',
                            price: '0.05',
                            currency: 'THB'
                          },
                          {
                            name: 'COURSE02B',
                            quantity: '1',
                            price: '0.15',
                            currency: 'THB'
                          }
                        ],
                      }
                    }
                  ]
                }
              });
            },

            onAuthorize: function(data, actions) {
              return actions.payment.execute().then(function(payment) {
                // The payment is complete!
                alert(payment);
                console.log(payment);
              });
            },

            onCancel: function(data, actions) {
                /* 
                 * Buyer cancelled the payment 
                 */
              alert('cancel payment');
            },

            onError: function(err) {
                /* 
                 * An error occurred during the transaction 
                 */
              alert('error occured');
            }

        }, '#paypal-button');
    </script>

  {{--  <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_s-xclick">
    <input type="hidden" name="hosted_button_id" value="6RNT8A4HBBJRE">
    <input type="image"
      src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_buynow_107x26.png" alt="Buy Now">
    <img alt="" src="https://paypalobjects.com/en_US/i/scr/pixel.gif"
      width="1" height="1">
  </form>  --}}

{{--    
  <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
    <input type="hidden" name="cmd" value="_s-xclick">
    <input type="hidden" name="hosted_button_id" value="67KKES6ASWCVN">
    <input type="image" src="https://www.sandbox.paypal.com/th_TH/TH/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - วิธีชำระเงินแบบออนไลน์ที่ปลอดภัยกว่าและง่ายกว่า!">
    <img alt="" border="0" src="https://www.sandbox.paypal.com/th_TH/i/scr/pixel.gif" width="1" height="1">
  </form>  --}}


    {{--  <h2>HTML5 File Upload Progress Bar Tutorial</h2>
    <form id="upload_form" enctype="multipart/form-data" method="post">
      {{ csrf_field() }}
      <input type="file" name="vdo" id="vdo"><br>
      <input type="button" value="Upload File" onclick="uploadFile()">
      <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
      <h3 id="status"></h3>
      <p id="loaded_n_total"></p>
    </form>

    <div id="list">
    
    </div>

    <div id="progress_bar"><div class="percent">0%</div></div>

  <script>
    var reader;
    var progress = document.querySelector('.percent');

    function abortRead() {
      reader.abort();
    }

    function errorHandler(evt) {
      switch(evt.target.error.code) {
        case evt.target.error.NOT_FOUND_ERR:
          alert('File Not Found!');
          break;
        case evt.target.error.NOT_READABLE_ERR:
          alert('File is not readable');
          break;
        case evt.target.error.ABORT_ERR:
          break; // noop
        default:
          alert('An error occurred reading this file.');
      };
    }

    function updateProgress(evt) {
      // evt is an ProgressEvent.
      if (evt.lengthComputable) {
        var percentLoaded = Math.round((evt.loaded / evt.total) * 100);
        // Increase the progress bar length.
        if (percentLoaded < 100) {
          progress.style.width = percentLoaded + '%';
          progress.textContent = percentLoaded + '%';
        }
      }
    }

    function handleFileSelect(evt) {
      var files = evt.target.files; // FileList object

      // files is a FileList of File objects. List some properties.
      var output = [];
      for (var i = 0, f; f = files[i]; i++) {
        output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
                    f.size, ' bytes, last modified: ',
                    f.lastModifiedDate ? f.lastModifiedDate.toLocaleDateString() : 'n/a',
                    '</li>');
      }
      document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';

      progress.style.width = '0%';
      progress.textContent = '0%';

      reader = new FileReader();
      reader.onerror = errorHandler;
      reader.onprogress = updateProgress;

      reader.onabort = function(e) {
        alert('File read cancelled');
      };

      reader.onloadstart = function(e) {
        document.getElementById('progress_bar').className = 'loading';
      };

      reader.onload = function(e) {
        progress.style.width = '100%';
        progress.textContent = '100%';
        setTimeout("document.getElementById('progress_bar').className='';", 2000);
      }

      reader.readAsBinaryString(evt.target.files[0]);
    }

    document.getElementById('vdo').addEventListener('change', handleFileSelect, false);

  </script>

  <script>
    function _(el){
      return document.getElementById(el);
    }

    function uploadFile(){
      var file = _("vdo").files[0];
      var _token = $("input[name='_token']").val();
      alert(file.name+" | "+file.size+" | "+file.type);
      var formdata = new FormData();
      formdata.append("vdo", file);
      formdata.append("_token", _token);
      var ajax = new XMLHttpRequest();
      ajax.upload.addEventListener("progress", progressHandler, false);
      ajax.addEventListener("load", completeHandler, false);
      ajax.addEventListener("error", errorHandler, false);
      ajax.addEventListener("abort", abortHandler, false);
      ajax.open("POST", "{{ url('/') }}/upvdo");
      ajax.send(formdata);
    }

    function progressHandler(event){
      $('#loaded_n_total').html('Uploadedddd '+event.loaded+' bytes of '+event.total);
      var percent = (event.loaded / event.total) * 100;
      $("#progressBar").val(Math.round(percent));
      $("#status").html(Math.round(percent)+"% uploaded... please wait");
    }

    function completeHandler(event){
      $("#status").html(event.target.responseText);
      $("#progressBar").val(0);
    }

    function errorHandler(event){
      $("#status").innerHTML = "Upload Failed";
    }

    function abortHandler(event){
      $("#status").innerHTML = "Upload Aborted";
    }
  </script>  --}}

  </body>
</html>