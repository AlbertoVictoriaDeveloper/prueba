
<div class="right_col" role="main">
    <div class="">
               
        <div class="page-title">

            <div class="title_left">
                <h3> Passwords Registered</h3>
            </div>

            <div class="title_right">

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                               <div class="alert alert-danger alert-dismissible " role="alert" name="alert" id="alert"  style =" display:none " >

                <span name="messageAlert" id="messageAlert"> </span>
            </div>
                    
                    
                    
                    <div class="x_content">
                        <p class="text-muted font-13 m-b-30">
                            If you want to see some password, You should put your encryption key.
                        </p>
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Url</th>
                                    <th>Password</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($passes)) {
                                    foreach ($passes as $pass) {
                                        ?>
                                        <tr>
                                            <td><?= $pass['name'] ?></td>
                                            <td><?= $pass['descripcion'] ?></td>
                                            <td><?= $pass['url'] ?></td>
                                            <td>********</td>
                                            <td><a class='inline editthis' href="#editpass" value="<?= $pass['id'] ?>" alt="Edit"><i class="fa fa-edit" ></i> </a>&nbsp;<a class='inline deletethis' href="#deletepass" value="<?= $pass['id'] ?>" alt="Delete"><i class="fa fa-remove" ></i></a>&nbsp;&nbsp;<a class='inline showp' href="#showpass" value="<?= $pass['id'] ?>" alt="show"><i class="fa fa-eye"></i></a></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                       <input type="hidden" id="token" value="<?=$token?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style='display:none'>
    <div id='editpass' style='padding:10px; background:#fff;'>
        <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <div class="alert alert-danger" role="alert" id="alertedit" style="display:none;">
                      </div>
                    <h2>Attention<br><small>If you want to change the pass, you should put the encryption key</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><span class="required">Old Password*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="oldpass" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">New Password*<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="newpass" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password*</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="confirmpass" class="form-control col-md-7 col-xs-12" type="password" name="middle-name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Encryption Key*</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="updateenckey" class="form-control col-md-7 col-xs-12" type="password" name="middle-name">
                          <input id="idedit" type="hidden" value="">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="button" class="btn btn-success" id="updatepbutton">Save</button>
                          <button type="Button" class="btn btn-danger" id="canceledit">Cancel</button>
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
    <div id='deletepass' style='padding:10px; background:#fff;'>
        <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1>Attention<br><small>Are you sure to delete the password?</small></h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <center>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <input id="iddelete" type="hidden" value="">
                          <button type="button" class="btn btn-success" id="delpbutton">Delete</button>
                          <button type="Button" class="btn btn-danger" id="canceldel">Cancel</button>
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
    <div id='showpass' style='padding:10px; background:#fff;'>
        <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>¡¡Attention!! <br><small>Dear user please insert the encryptation key to see your passwords</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Encryption Key*</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" type="password" id="showenc" name="middle-name">
                          <input id="idshow" type="hidden" name="middle-name" value="">
                        </div>
                      </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Your password is <strong id="psw"></strong></h2>
                            </div>
                        </div>  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="button" class="btn btn-success" id="showpbutton">Show</button>
                          <button type="Button" class="btn btn-danger" id="cancelshow">Cancel</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
    </div>
</div>
