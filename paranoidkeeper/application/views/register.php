</html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Paranoid</title>

        <!-- Bootstrap -->
        <link href="<?= base_url() ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?= base_url() ?>css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?= base_url() ?>css/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="<?= base_url() ?>css/custom.min.css" rel="stylesheet">
    </head>

    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                   
                    <span>     <strong>Register email!</strong> Your login information session was sent to your e-mail  </span>
                  </div>
            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">

                        <h1>Paranoid</h1>
                        <form id ="form"  action ="<?= base_url()?>login/dataregister" method = "POST" > 
                            <div class="row">
                                <input type="text" class="form-control"  id="mail" name="mail" placeholder="mail" required="" />
                            </div>
                            <div class="row" style = "display:none;">
                                <input type="password" class="form-control"  id= "pass" name= "pass" placeholder="Password" required="" />
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    
                                </div>
                                <div class="col-lg-4">
                                    <input type = "submit"  class="btn btn-default submit" id = "enviar" name = "enviar" value = "Send">
                                </div>
                                <div class="col-lg-5">
                                    
                                </div>                                
                            </div>
                        </form>
                        
                        
                        <div class="clearfix"></div>

                        <div class="separator">
                        
                            <div class="clearfix"></div>
                            <br />

                            <div>

                                <p>©2016 All Rights Reserved. oblak.science Privacy and Terms</p>
                            </div>
                        </div>

                    </section>
                </div>


            </div>
        </div>

</html>