<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3> Registered passwords </h3>
            </div>

            <div class="title_right">

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="alert alert-danger" role="alert" id="alertedit" style="display:none;">
        </div>
        <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Enter all Fields<small>You need "the encryption key"</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form id="sendpass" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post" action="<?=base_url()?>insertpass">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password's Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" required="required" name="name" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="description" name="description" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Url*</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="url" class="form-control col-md-7 col-xs-12" type="text" name="url">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Password*</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="pass" class="form-control col-md-7 col-xs-12" type="password" name="pass">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">encryption key*</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="enckey" class="form-control col-md-7 col-xs-12" type="password" name="enckey">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="button"   href="#insertpass" class="btn btn-success inlineSucces " name="register" value="register" id="registerbutton">Register</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
    </div>

</div>


<div style='display:none'>
    <div id='insertpass' style='padding:10px; background:#fff;'>
                                      <h4>Information</h4>
			        <span><h5>Your password has been successfully saved</h5></span>			 
						
                    <center>
        
			 
                          <input id="okPassword" type="hidden" value="">
                          <button type="button" class="btn btn-success" id="deletebutton">OK</button>
                       
                    </center>
  
              </div>
        
    </div>
