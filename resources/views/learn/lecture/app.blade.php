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

  @include('learn.lecture.navbar')

  @include('learn.lecture.lecture')

  @include('learn.lecture.sections')

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