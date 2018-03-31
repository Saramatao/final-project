function loadingToast () {
  Materialize.toast(
    `<div class="preloader-wrapper small active">
      <div class="spinner-layer spinner-blue-only">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
    </div>
    <div style="margin-left:20px;">กำลังบันทึกการเปลี่ยนแปลง</div>`);
}

function printErrorMsg (msg) {
  $(".error-msg").html('');
  $(".error-msg").css('display', 'none');
  $.each( msg, function( key, value ) {
    $("." + key).css('display', 'block');
    $.each( value, function( index, val ) {
      $("." + key).append(val+"<br>"); 
    });
  });
}

function successToast () {
  Materialize.toast(
    '<div>สำเร็จ!</div>', 1000);
}

function failToast () {
  Materialize.toast(
    '<div>กรุณากรอกข้อมูลให้ตรงตามเงื่อนไข</div>', 2000, 'red');
}

function errorToast () {
  Materialize.toast(
    '<div>มีปัญหาขณะโหลดหน้าเว็บ กรุณาลองใหม่อีกครั้ง</div>', 2000, 'red');
}

function ajaxFormRequest(form, callback, opts) {
  $(".btn-submit").toggleClass('disabled');
  $(".error-msg").html('');
  $(".error-msg").css('display', 'none');
  loadingToast();

  if (opts) {
    var type = opts.method;
    var url = opts.action;
  }
  else {
    var type = form.attr('method');
    var url = form.attr('action');
  }

  var query = {
    type: type,
    url: url,
    data: form.serialize(), 
    success: function(response)
    {
      setTimeout(function () {
        if ($.isEmptyObject(response.error)) {
          successToast();
          console.log('a');
          if (callback) callback(response);
        }
        else {
          failToast();
          console.log('b');
          printErrorMsg(response.error);
          if (callback) callback(false);
        }  
      }, 500);
    },
    error: function(response) 
    {
      setTimeout(function () {
        errorToast();
        console.log('c');
        if (callback) callback(false);
      }, 500);
    },
    complete: function(response)
    {
      console.log(response);
      Materialize.Toast.removeAll();
      $(".btn-submit").toggleClass('disabled');
    }
  }

  $.ajax(query);

  // if(opts){ 
  //   $.ajax({
  //     type: opts.method,
  //     url: opts.action,
  //     data: form.serialize(), 
  //     complete: function(response)
  //     {
  //       console.log(response);
  //       Materialize.Toast.removeAll();
  //       $(".btn-submit").toggleClass('disabled');
  
  //       setTimeout(function () {
  //         if ($.isEmptyObject(response.error)) {
  //           successToast();
  //           callback(response);
  //         }
  //         else {
  //           failToast();
  //           printErrorMsg(response.error);
  //           callback(false);
  //         }  
  //       }, 500);
  //     },
  //     error: function(response) 
  //     {
  //       console.log(response);
  //       setTimeout(function () {
  //         errorToast();
  //         callback(false);
  //       }, 500);
  //     }
  //   });
  // } else {
  //   $.ajax({
  //     type: form.attr('method'),
  //     url: form.attr('action'),
  //     data: form.serialize(), 
  //     complete: function(response)
  //     {
  //       console.log(response);
  //       Materialize.Toast.removeAll();
  //       $(".btn-submit").toggleClass('disabled');

  //       setTimeout(function () {
  //         if ($.isEmptyObject(response.error)) {
  //           successToast();
  //           callback(response);
  //         }
  //         else {
  //           failToast();
  //           printErrorMsg(response.error);
  //           callback(false);
  //         }  
  //       }, 500);
  //     },
  //     error: function(response) 
  //     {
  //       console.log(response);
  //       setTimeout(function () {
  //         errorToast();
  //         callback(false);
  //       }, 500);
  //     }
  //   });
  // }
}
