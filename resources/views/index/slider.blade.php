
<div class="flex">
  <div style="width:5%;"></div>
    
    <div class="slider waves-effect z-depth-1" 
      style="margin-top: 25px; margin-bottom: 25px;">
      <ul class="slides">
        @foreach ($adverts as $advert)
        <li>
          <a href="{{ url('/') }}/view/{{ $advert->course->slug }}">
            <img src="{{ url('/') }}/{{ $advert->course->cover_image }}">
          </a>
          <div class="caption center-align" 
            style="background-color: rgba( 55, 55, 55, 0.4); border-radius:5px;">
            <h3>{{ $advert->title }}</h3>
            <h5 class="light grey-text text-lighten-3">
              {{ $advert->detail }}
            </h5>
          </div>
        </li>
        @endforeach
      </ul>
    </div>
  <div style="width:5%;"></div>
</div>
