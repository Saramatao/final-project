<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable=no">

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> 
    
    <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/pdf.js') }}"></script>

  </head>

  <body>

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

    <button onclick="myFunction()">Print this page</button>
    
    <script>
    function myFunction() {
        window.print();
    }
    </script>

    <script>
      $( document ).ready(function() {
        showPDF(true);
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

        PDFJS.getDocument({ url: `{{ asset('images/testpdf.pdf') }}` }).then(function(pdf_doc) {
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