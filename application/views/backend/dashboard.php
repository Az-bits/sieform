<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css" media="screen">
div.animation {
  animation-delay: 1s;
  animation-duration: 5s;
}
div.anima {
  animation-duration: 2s;
}
div#carrera {
  background: #e12b6b;

color: #fff;

border-radius: 60px;
text-shadow: 0.1em 0.1em 0.2em black;
}

table#widget-to {
    display:none;
}
.padre {
  /*background-color: #fafafa;*/
  /*border: 1px solid #ccc;*/
  padding: 0 1rem;
  /*margin: 1rem;*/
}

.hijo {
  /*background-color: yellow;*/
  
  /* IMPORTANTE */
  border: 1px solid rgb(240, 219, 219);
  width: 200px;
  margin-left: auto;
  margin-right: auto;
  border-radius: 12px;
  -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
box-shadow: 10px 10px 5px 0px rgba(74, 74, 74, 0.75);
}
.card {
  /*background-color: yellow;*/
  
  /* IMPORTANTE */
 
  -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
box-shadow: 10px 10px 5px 0px rgba(74, 74, 74, 0.75);
}
.main-panel > .content {
    margin-top: 0px;
}
</style>


<div class="row">

  <div class="col-md-2">
  </div>
  <div class="col-md-8">
    <div id="carrera" class="card card-profile animated  zoomInDown anima">
      <div id="carrera" class="">
      </div>
    </div>
  </div>
  <div class="col-md-2">

  </div>

  <div class="col-md-4">


  </div>
  <div class="col-md-4">
    <div class="card card-profile animated  bounceInDown anima">
      <div class="card-header card-header animated infinite bounce animation" >
        <div class="card-avatar">
          <a href="#julian">
            <img class="img" style="height: 95%; width: 101%;"  src="<?php echo base_url();?>assets/backend/material-dashboard/assets/img/faces/user.gif">
          </a>
        </div>
      </div>
      <div class="card-body">
        <p></p>
        <h4 class="card-title">Bienvenido al sistema</h4>
        <div class="card-header " data-header-animation="true">
          <h6 class="card-category text-gray">{user_fullname}</h6>
        </div>
        <p class="card-description">   
        </p>
      </div>
    </div>
  </div>

  

