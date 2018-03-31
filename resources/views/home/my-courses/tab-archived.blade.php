<div id="test5" class="col s12">

  <?php for ($x = 0; $x < 12; $x++): ?>
    <div class="card" style="width:215px; display:inline-block; margin:5px;">

      <div class="card-image">
          <img src="{{ asset('images/apple.jpg') }}" style="height:135px;"> 
      </div>

      <div class="card-content" style="padding-bottom:10px; padding-top:10px;">
        <p>Techonology Leaning Information Name</p>
        <p style="font-size:14px; color:grey; margin-top:10px;">By John Cena</p>
        <div class="progress">
          <div class="determinate" style="width: 70%"></div>
        </div>
        70% Progress
      </div>

      <div class="card-action" style="padding-bottom:10px; padding-top:10px;"> 
        <i class="material-icons" style="font-size:21px; margin-left:-2px;">star</i>
        <i class="material-icons" style="font-size:21px;">star</i>
        <i class="material-icons" style="font-size:21px;">star</i>
        <i class="material-icons" style="font-size:21px;">star_half</i>
        <i class="material-icons" style="font-size:21px;">star_border</i> 
      </div>  
    
    </div>
  <?php endfor; ?>

  <ul class="pagination center-align">
    <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
    <li class="active"><a href="#!">1</a></li>
    <li class="waves-effect"><a href="#!">2</a></li>
    <li class="waves-effect"><a href="#!">3</a></li>
    <li class="waves-effect"><a href="#!">4</a></li>
    <li class="waves-effect"><a href="#!">5</a></li>
    <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
  </ul>

</div>