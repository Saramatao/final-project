
@if ($data->content_type == 'VDO')
	<video oncontextmenu="return false;" 
    style="max-height:99%; width:100%; position: relative; top: 50%; transform: translateY(-50%);" 
    src="{{ url('/') }}/{{ $data->content_path }}" controlsList="nodownload" controls="controls" 
    tabindex="0" preload="metadata"></video>
@endif

@if ($data->content_type == 'TXT')
  <div style="width:100%; height:80vh;">
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
 