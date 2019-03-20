    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php">BCMF</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <?php if ($Role == "Admin") {
                        ?> 
                                  
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                VIP <span class="caret"></span>  </a>
                            <ul class="dropdown-menu">

                                <li><a href="vip-ticket.php">Registration</a></li>
                                <li><a href="import-ticket.php">Import Ticket</a></li>
                                <li><a href="vip-find-ticket.php">Select Find Ticket</a></li>
                            </ul>
                        </li> 

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                All Category <span class="caret"></span>  </a>
                            <ul class="dropdown-menu">

                                <li><a href="form-field-options.php">Form Field Options</a></li>
                                <li><a href="ticket-category.php">Ticket Category</a></li>
                                <li><a href="vip-category.php">VIP Category</a></li>
                                <li><a href="bulk-category.php">Bulk Category</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                General <span class="caret"></span>  </a>
                            <ul class="dropdown-menu">

                                
                                <li><a href="reg-ticket-find.php">Find Ticket</a></li>
                                <li><a href="general-ticket.php">Import Ticket</a></li>
                            </ul>
                        </li> 
                        
                        <li><a href="settings.php">Settings</a></li>
                        <?php
                    }
                    ?> 
           

                    <?php if ($Role == "Admin") {
                        ?>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                Bulk General <span class="caret"></span>  </a>
                            <ul class="dropdown-menu">

                                <li><a href="bulk-reg.php">Registration</a></li>
                                <li><a href="bulk-find-ticket.php">Select Find Ticket</a></li>
                            </ul>
                        </li> 

                        

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                Event Management Pass <span class="caret"></span>  </a>
                            <ul class="dropdown-menu">

                                 <li><a href="event-management-pass.php">Registration</a></li>
                                <li><a href="e-management-import.php">Registration Import</a></li>
                                <li><a href="em-find-ticket.php">Select Find Ticket</a></li>
                            
                            </ul>
                        </li> 

                        <li><a href="daily-report-booth.php" title="">Daliy Report Booth</a></li>


                    <?php
                    }
                        if ($Role == "Booth") {
                    ?>
                              <li><a href="booth-abdul-razzaq.php">Abdul Razzaq</a></li>
                              <li><a href="bengal-centre.php">Bengal Centre</a></li>
                              <li><a href="lucknow.php">Lucknow</a></li>
                              <li><a href="booth-ticket-find.php">Find Ticket</a></li>
                              <li><a href="booth-mail-ticket.php">Booth Mail</a></li>
                    <?php
                    }
                      
                    ?>
                    


                </ul>
                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['user_name']; ?>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav> 