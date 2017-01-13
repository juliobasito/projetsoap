<div class="container">
  <div class="row" style="margin-top:20px;">
    <div class="col s6">
      <a class="waves-effect waves-light btn orange col-s4 offset-s4" style="width:100%">Panique</a>
    </div>
    <div class="col s6">
      <a class="waves-effect waves-light btn red col-s4 offset-s4" style="width:100%">Accident</a>
    </div>
  </div>

  <div class="row">
    <div class="col s12 m6">
      <div class="card">
        <div class="card-content white-text">
          <span class="card-title black-text">Temps de travail</span>
          <div class="progress blue lighten-4">
            <div class="determinate blue lighten-1" style="width: <?php echo $date["pourcentage"]?>%"></div>
          </div>
          <h5 class="black-text center-align"><?php  echo $date["hour"].' heures et '.$date["minute"].' minutes'; ?></h5>
        </div>
      </div>
    </div>
    <div class="col s12 m6">
      <div class="card">
        <div class="card-content white-text">
          <span class="card-title black-text">Temps de travail avant pause</span>
          <div class="progress blue lighten-4">
            <div class="determinate blue lighten-1" style="width: <?php echo $date["pausepourcentage"]?>%"></div>
          </div>
          <h5 class="black-text center-align"><?php echo $date["tempspause"]; ?>min</h5>
        </div>
      </div>
    </div>
  </div>

  <div class="row margeBottom">
    <div class="col s12 m6">
      <div class="card">
        <div class="card-content white-text">
          <span class="card-title black-text">Véhicule</span>
          <div class="row">
            <h5 class="black-text center-align"><?php echo $vehicule->Brand.' '.$vehicule->Model;?></h5>
          </div>
        </div>
      </div>
    </div>
    <div class="col s12 m6">
      <div class="card">
        <div class="card-content white-text">
          <span class="card-title black-text">Contrôle Véhicule</span>
          <div class="row">
            <h5 class="black-text center-align">Contrôle technique <i class="material-icons">
                <?php if($ct==true){
                  echo 'verified_user';
                } if($ct==false){
                  echo 'new_releases';}?>
              </i></h5>
          </div>
          <div class="row">
            <h5 class="black-text center-align">Permis de conduire <i class="material-icons"><?php if($permis==true){
                  echo 'verified_user';
                } if($permis==false){
                  echo 'new_releases';}?></i></h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
