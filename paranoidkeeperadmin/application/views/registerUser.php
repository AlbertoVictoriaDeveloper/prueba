
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3> Passwords Registered </h3>
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
                            </button> Enter a new registration user for the administrative panel, Example. example@example.com
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
                                    <input type="text" class="form-control col-md-7 col-xs-12" id="mail" name="mail" required>
                                </div>
                            </div>
                       <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Profile<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <Select name ="typeUser" id="typeUser" class="form-control col-md-7 col-xs-12" required>
                                        <option value="" selected>- Selected a User Type -</option>
                                        <option value="0">Super Administrator</option> 
                                        <option value="1">Manager</option> 
                                        <option value="2">Staff Manager</option>
               
                                    </select>
                                </div> 
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="button" class="btn btn-round btn-info" name="insertUser" onclick="registerUserAdmin()" id="insertUser">Insert User</button>
                                </div>
                            </div>
                        </form>

                        <div class="x_content">
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>Registered users </h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>

                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <table id="datatable" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Registered Users</th>
                                                        <th>Type Users</th>
                                                        <th>Option</th>
                                                    </tr>
                                                   
                                                        
                                                </thead>
                                                <tbody>
                    <?php
                    if(!empty($register)){
                    foreach ($register as $registerUser){
                    
                    ?>
                                         
                                                    <tr>
                                                        <td> <?php echo $registerUser['mail'] ?>  </td>
                                                  
                                              
                                                        <td> <?php echo $registerUser['type'] == 0 ? "Super Administrator" : ""  ;
                                                                   echo $registerUser['type'] == 1 ? "Mannager" : ""      ;
                                                                   echo $registerUser['type'] == 2 ? " Staff Managger" : ""  ; 
                                                        
                                                        ?>  </td>
                                                        
                                                        <td> <button type='button'  href="#deleteUser" class='btn btn-danger btn-xs inline deleteUser' value="<?= $registerUser['id'] ?>"> Delete User </button> </td>
                                                      </tr>
                     <?php
                    }
                    }
                     ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
<div style='display:none'>
    <div id='deleteUser' style='padding:10px; background:#fff;'>
        <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1>Attention<br><small>Are you sure to delete this User?</small></h1>
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