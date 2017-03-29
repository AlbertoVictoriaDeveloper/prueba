<!DOCTYPE html>
<meta charset="UTF-8">
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ParanoidKeeper</title>
         <link rel="icon" type="image/ico" href="<?= base_url() ?>img/iconParanoid.ico">

        <!-- Bootstrap -->
        <link href="<?= base_url() ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        
        <!-- NProgress -->
        <link href="<?= base_url() ?>css/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="<?= base_url() ?>css/custom.min.css" rel="stylesheet">
          <link href="<?= base_url() ?>css/colorbox.css" rel="stylesheet">
    </head>

    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="alert alert-info alert-dismissible " role="alert" name="information" id="information"  style =" display:none " >

                <span name="informationBlue" id="informationBlue">  </span>
            </div>


            <div class="alert alert-danger alert-dismissible " role="alert" name="alert" id="alert"  style =" display:none " >

                <span name="messageAlert" id="messageAlert"> </span>
            </div>


            <div class="login_wrapper">
                <div class="animate form login_form">
				
				<br>
				<br>
				<br>
				<br>
                    <section class="login_content">

                    <span > <img SRC="<?= base_url() ?>img/ADMIN.png"  ALT="ParanoidKeeper" WIDTH=200 HEIGHT=85></span>
                        <form  id ="form"  name="form" action ="<?= base_url() ?>login/access" method = "POST" > 
                            <div class="row">
                                <input type="email" class="form-control"  id="mail" name="mail" placeholder="mail" required=""   pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"/>
                            </div>
                            <div class="row" style = "display:none;" id="password" name="password" >
                                <input type="password" class="form-control"  id= "pass" name= "pass" placeholder="Password" />
                            </div>

                            <div class="row">
                                <div class="col-lg-3">

                                </div>
                                <div class="col-lg-4" style = "display:none;" name="loginMail"  id="loginMail">
                                    <input type = "button"  class="btn btn-default submit" id = "login" name = "login" value = "Login" onclick="loginUser()">
                                </div>
                                <div class="col-lg-4"  name="sendUser" id="sendUser" style ="display:hidden;">
                                  <a type = "button"  href="#sendpass" class="btn btn-default submit inline" id = "send" name = "send"  value = "Send">Send</a>
                                </div>  
                                <div class="col-lg-4"  name="registryEmail" id="registryEmail" style ="display:none;"  >
                                    <a type = "button"    href="#sendpass"  class="btn btn-default submit inline" id = "register" name = "register" value = "Register">Register</a>
                                </div> 
                            </div>
                        </form>
                        <div class="clearfix"></div>

                        <div class="separator"> 
							<div id="back" name="back" style ="display:none;">   
                                <a id="resgister" name="register" >Back</a> 
                            </div> 
							
                            <div class="clearfix"></div>
                            <br />

                            <div>

                                 <p><p>Copyright © <?php echo date('Y'); ?> Oblak Solutions LLC.</p></p>
                            </div>
                        </div>

                    </section>
                </div>


            </div>
        </div>
        
  <div style='display:none'>
    <div id='sendpass' style='padding:10px; background:#fff;'>
      
              <div class="col-md-12 col-sm-12 col-xs-12">
                  
				  <div class="x_title">
                     <h3>Information</h3>
					 </div>
					<span><h5>You sent your login information session to your e-mail</h5></span>
                    <center>
                
                      <div class="form-group">
					  
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <input id="okPassword" type="hidden" value="">
                          <button type="button" class="btn btn-success" id="delpbutton">OK</button>
                        </div>
                      </div>
                    <!--</form>-->
                    </center>
                  </div>
  
              </div>
        
    </div>
</div>
        
        
        <script  src="<?= base_url() ?>js/jquery.min.js"></script>
        <script   src="<?= base_url() ?>js/bootstrap.min.js"></script>       
        <script   src="<?= base_url() ?>js/jsintern/dataEmail.js"></script>
        <script src="<?= base_url() ?>js/jquery.colorbox.js"></script>
<!--        <script>
            $(document).ready(function(){
                
                $(".inline").colorbox({inline:true, width:"50%"});
                $("#cboxClose").attr("style","display:none;");
            });
        </script>-->
</html>
