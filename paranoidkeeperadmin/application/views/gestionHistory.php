<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3> User managements </h3>
            </div>

            <div class="title_right">

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        
                     
                        <br>
                        <br>

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
 <table id="datatable-responsive" class="table table-striped table-bordered" cellspacing="0"  height="100%">
                                               <thead>
                                                   <tr>
                                                       <th>Email User </th>
                                                       <th>Movement</th> 
                                                       <th>Email Movement</th> 
                                                       <th>Date Movement</th>
                                                       
                                                   </tr>
                                                   
                                               </thead>
                                               <tbody>
                                                      <?php
                    if(!empty($history)){
                    foreach ($history as $historyUser){
                    
                    ?>
                                         
                                                    <tr>
                                                        <td> <?php echo $historyUser['mail'] ?>  </td>
                                                        <td><?php echo $historyUser['movement'] ?>    </td>
                                                        <td><?php echo $historyUser['user_movement'] ?>  </td>
                                                        <td><?php echo $historyUser['date_movement'] ?>    </td>
                                                     
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