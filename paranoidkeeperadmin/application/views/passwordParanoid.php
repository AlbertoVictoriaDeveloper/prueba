

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>  Registered Passwords </h3>
            </div>

            <div class="title_right">

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="alert alert-info alert-dismissible fade in" role="alert" id="information" name="information" style = "display:hidden">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button> Select a user to view the passwords
                        </div>
                                   <div class="alert alert-danger alert-dismissible " role="alert" name="alert" id="alert"  style =" display:none " >

                <span name="messageAlert" id="messageAlert"> </span>
            </div>
                        <br>
                        <form id="demo-form" class="form-horizontal form-label-left" method="post" action="">
                       <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">User<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">


    
   
    


                                    
  
                                    <Select name ="userParanoid" id="userParanoid" class="form-control col-md-7 col-xs-12" required>
                                    <option value="" selected>- Select User -</option>
                                    <?php 
                                    if(!empty($register)){
                                    foreach($register as $registerUser){
                                        
                                   echo  '<option value="'.$registerUser['id'].'">' .$registerUser['mail'].'</option>';
                                    
                                    }
                
                                    }else{
                                         echo  '<option value="">---No users registers---</option>'; 
                                    }
                                    ?> 
                                    </select>
                                   
                  
                                    
                                    
                                    
                                </div> 
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="button" class="btn btn-round btn-info" name="passwordKeeper" onclick="seePassword()" id="passwordKeeper">See Passwords</button>
                                </div>
                            </div>
                        </form>

                        <div class="x_content">
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel"  id = "panelPassword" style='display:none'>
                                        <div class="x_title">
                                            <h2>Registered users </h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li><a class="collapse-link"></a>
                                                </li>

                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content" id ="tablePassword" name ="tablePassword">
                                           <table id="datatable-responsive" class="table table-striped table-bordered" cellspacing="0"  height="100%">
                       
                           
                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
<div style='display:none'>
    <div id='activatesPassword' style='padding:10px; background:#fff;'>
        <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1>¡¡Attention!! <br><small>are you sure do you want activate this password ?</small></h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <center>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <input id="activatepassword" type="hidden" value="">
                          <button type="button" class="btn btn-success" id="passActivate" >Activate</button>
                          <button type="Button" class="btn btn-danger" id="cancelActivate">Cancel</button>
                        </div>
                      </div>
                    </form>
                    </center>
                  </div>
                </div>
              </div>
            </div>
    </div>
</div>   
                    
                    
                    
  <div style='display:none'>
    <div id='disablesPassword' style='padding:10px; background:#fff;'>
        <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h1>¡¡Attention!! <br><small>Are you sure do you want disable this password ?</small></h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <center>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <input id="disablepass" type="hidden" value="">
                          <button type="button" class="btn btn-success" id="passddisable" >Disable</button>
                          <button type="button" class="btn btn-danger" id="canceldisable">Cancel</button>
                        </div>
                      </div>
                    </form>
                    </center>
                  </div>
                </div>
              </div>
            </div>
    </div>
</div>                    
