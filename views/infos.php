<div class="container">
<?php if(!empty($vehicule)) {

  if($vehicule->State == 'Warning') {?>
  <div class="row">
    <div class="col s12 m12">
      <div class="card orange darken-1">
        <div class="card-content white-text">
          <span class="card-title"><i class="material-icons">warning</i> Attention votre vehicule semble endommagé</span>
        </div>
      </div>
    </div>
  </div>
    <?php }
  if($vehicule->State == 'Accident') {?>
    <div class="row">
      <div class="col s12 m12">
        <div class="card red darken-1">
          <div class="card-content white-text">
            <span class="card-title"><i class="material-icons">error</i> Arret immédiat de la mission, un accident a été détécté</span>
          </div>
        </div>
      </div>
    </div>
  <?php }} ?>
  <?php if(!empty($vehicule)) {
    ?>

  <div class="row" style="margin-top:20px;">
    <div class="col s6">
      <a href="panique/<?php echo $vehicule->Id ?>" class="waves-effect waves-light btn orange col-s4 offset-s4" style="width:100%">Panique</a>
    </div>
    <div class="col s6">
      <a href="accident/<?php echo $vehicule->Id ?>" class="waves-effect waves-light btn red col-s4 offset-s4" style="width:100%">Accident</a>
    </div>
  </div>
  <?php } ?>

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
            <h5 class="black-text center-align"><?php if (!empty($vehicule)){ echo $vehicule->Brand.' '.$vehicule->Model;} else { ?><p style="color:red"> AUCUN VEHICULE ATTRIBUE<?php } ?></p></h5>
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
