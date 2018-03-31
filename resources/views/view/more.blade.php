<div class="row pc-container" style="margin-bottom: 0px;">
  <div class="col s8 z-depth-1" style="padding-bottom: 10px; margin-bottom:25px;">
    <p style="font-size: 2em;" class="">คอร์สเรียนอื่นๆที่น่าสนใจ</p>

    <div class="col s12"> 

      <?php for ($x = 0; $x < 3; $x++): ?>
        <div class="card" style="width:31%; display:inline-block; margin:5px;">

          <div class="card-image">
              <img src="{{ asset('images/apple.jpg') }}" style="height:135px;"> 
          </div>

          <div class="card-content" style="padding-bottom:10px; padding-top:10px;">
            <p>Techonology Leaning Information Name</p>
            <p style="font-size:14px; color:grey; margin-top:10px;">By John Cena</p>
            <i class="material-icons" style="font-size:21px; margin-left:-2px;">star</i>
            <i class="material-icons" style="font-size:21px;">star</i>
            <i class="material-icons" style="font-size:21px;">star</i>
            <i class="material-icons" style="font-size:21px;">star_half</i>
            <i class="material-icons" style="font-size:21px;">star_border</i> 
          </div>

          <div class="card-action" style="padding-bottom:10px; padding-top:10px;"> 
            <p style="text-align:right;">฿1,500</p>
          </div>  
        
        </div>
      <?php endfor; ?>

    </div>
  </div>
</div> 