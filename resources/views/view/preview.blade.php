<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> 
    
    <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/pdf.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/init.js') }}"></script>

    <style type="text/css">
      html,body {
          min-height:100%;
          height:100%;
          margin:0;
      }
    </style>
    
  </head>

  <body>

  
@if ($data->content_type == 'VDO')
<video oncontextmenu="return false;" 
  style="max-height:99%; width:100%; position: relative; top: 50%; transform: translateY(-50%);" 
  src="{{ url('/') }}/{{ $data->content_path }}" controlsList="nodownload" controls="controls" 
  tabindex="0" preload="metadata"></video>
@endif

@if ($data->content_type == 'TXT')
<div style="width:90%; min-height:80vh; margin-left:5%; margin-top:5%;" class="card-panel hoverable">
<h3>{{ $data->title }} </h3>
  {{ $data->content_text }}
</div>
@endif

@if ($data->content_type == 'PDF')
<div id="pdf-main-container">
  <div id="pdf-loader">Loading document ...</div>
  <div id="pdf-contents">
    <div id="pdf-meta">
      <div id="pdf-buttons">
        <button id="pdf-prev">Previous</button>
        <button id="pdf-next">Next</button>
      </div>
      <div id="page-count-container">Page <div id="pdf-current-page"></div> of <div id="pdf-total-pages"></div></div>
    </div>
    <canvas id="pdf-canvas" width="1000"></canvas>
    <div id="page-loader">Loading page ...</div>
  </div>
</div>

<script>
  $( document ).ready(function() {
    showPDF(true);
  });
</script>
@endif

  {{--  Materailize Init  --}}
  <script>
    $(document).ready( function() {
      $('.modal').modal();
    });
  </script>

  {{--  PDF Lecture Functions  --}}
  <script>
    $(document).ready(function(){
      $('.button-collapse').sideNav();
    });

    $("#close-nav").on('click', function() {
      $('.button-collapse').sideNav('hide');
    });

    $("#pdf-prev").on('click', function() {
      if(__CURRENT_PAGE != 1)
        showPage(--__CURRENT_PAGE);
    });

    $("#pdf-next").on('click', function() {
      if(__CURRENT_PAGE != __TOTAL_PAGES)
        showPage(++__CURRENT_PAGE);
    });

    var __PDF_DOC,
      __CURRENT_PAGE,
      __TOTAL_PAGES,
      __PAGE_RENDERING_IN_PROGRESS = 0,
      __CANVAS = $('#pdf-canvas').get(0),
      __CANVAS_CTX = __CANVAS.getContext('2d');

    function showPDF(pdf_url) {
      $("#pdf-loader").show();

      PDFJS.getDocument({ url: `{{ url('/') }}/{{ $data->content_path }}` }).then(function(pdf_doc) {
        __PDF_DOC = pdf_doc;
        __TOTAL_PAGES = __PDF_DOC.numPages;
        
        $("#pdf-loader").hide();
        $("#pdf-contents").show();
        $("#pdf-total-pages").text(__TOTAL_PAGES);

        showPage(1);
      }).catch(function(error) {

        $("#pdf-loader").hide();
        $("#upload-button").show();
        
        alert(error.message);
      });;
    }

    function showPage(page_no) {
      __PAGE_RENDERING_IN_PROGRESS = 1;
      __CURRENT_PAGE = page_no;

      $("#pdf-next, #pdf-prev").attr('disabled', 'disabled');
      $("#pdf-canvas").hide();
      $("#page-loader").show();
      $("#download-image").hide();

      $("#pdf-current-page").text(page_no);
      
      __PDF_DOC.getPage(page_no).then(function(page) {
      
        var scale_required = __CANVAS.width / page.getViewport(1).width;
        var viewport = page.getViewport(scale_required);
        __CANVAS.height = viewport.height;

        var renderContext = {
          canvasContext: __CANVAS_CTX,
          viewport: viewport
        };
        
        page.render(renderContext).then(function() {
          __PAGE_RENDERING_IN_PROGRESS = 0;

          $("#pdf-next, #pdf-prev").removeAttr('disabled');

          $("#pdf-canvas").show();
          $("#page-loader").hide();
          $("#download-image").show();
        });
      });
    }
  </script>   
  </body>
</html>