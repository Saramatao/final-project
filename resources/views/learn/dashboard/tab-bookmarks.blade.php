<div id="bookmarks">

  @if ( count($data->bookmarks) > 0)
    @foreach ($data->bookmarks as $bookmarks)

      <ul class="collection">
        <li class="collection-item avatar">
          <div>Section : {{ $bookmarks->section_title }}</div>
          <div>Lecture : {{ $bookmarks->lecture_title }}</div>
          <div>{{ $bookmarks->note }}</div>
          <div class="secondary-content">
            <form>
              {{ csrf_field() }}

              <input name="lecture_id" type="hidden" value="{{ $bookmarks->lecture_id }}">
              <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
              <i class="material-icons delete-bookmarks-trigger" style="color:red;">delete</i>
            </form>
          </div>
        </li>
      </ul>

    @endforeach
  @else
    <div class="center-align">ยังไม่มีการบุ๊กมาร์กใดๆ</div>
  @endif

</div>

<script>
  $(document).ready( function() {
  
    $('.delete-bookmarks-trigger').on('click', function(e) {
      var form = $(this).parents('form');
      console.log(form.serialize());
      ajaxFormRequest(form, function(result) {
        if (result !== false)
          form.parents('ul').html('');
      },
      {
        method: "DELETE",
        action: "{{ url('/') }}/bookmarks"
      });
    });


  });
</script>