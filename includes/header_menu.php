<nav class="navbar fixed-top navbar-expand-sm navbar-dark" style="background: #0b0c10; border-bottom: 1px solid rgba(255,255,255,0.12);">
            <div class="container">
                    <a href="index.php" class="navbar-brand" style="font-family: 'Times New Roman'; color: var(--accent-color);">Messina Car Rentals</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mynavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="collapse navbar-collapse" id="mynavbar">
                    <ul class="nav navbar-nav">
                       <li class="nav-item">
                           <a href="cars.php" class="nav-link">Cars</a>
                       </li>
                       <li class="nav-item"><a href="instructions.php" class="nav-link">Instructions</a></li>
                       <?php
                       if (isset($_SESSION['email'])) {
                        ?>
                       <li class="nav-item"><a href="cart.php" class="nav-link">My Rentals</a></li>
                       <li class="nav-item"><a href="paymentmethod.php" class="nav-link">Payment method</a></li>
                       <?php
                          } 
                    ?>
                    </ul>
                    
                    <?php
                if (isset($_SESSION['email'])) {
                    ?>
                    <ul class="nav navbar-nav ml-auto">
                       <li class="nav-item"><a href="logout_script.php" class="nav-link"><i class="fa fa-sign-out"></i>Logout</a></li>
                       <li class="nav-item"><a  class="nav-link " data-placement="bottom" data-toggle="popover" data-trigger="hover" data-content="<?php echo $_SESSION['email'] ?>"><i class="fa fa-user-circle "></i></a></li>
                    </ul>
                    <?php
                } else {
                    ?>
                    <ul class="nav navbar-nav ml-auto">
                       <li class="nav-item "><a href="#signup" class="nav-link"data-toggle="modal" ><i class="fa fa-user"></i> Register</a></li>
                       <li class="nav-item "><a href="#login" class="nav-link" data-toggle="modal"><i class="fa fa-sign-in"></i> Login</a></li>
                    </ul>
                    <?php
                }
                    ?>
                    </div>
                </div>
            </div>
        </nav>

    <div class="modal fade" id="login" >
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content bg-dark text-light" style="background-color:#0b0c10; border: 1px solid rgba(255,255,255,0.12)">

            <div class="modal-header">
              <h5 class="modal-title">Login</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <form action="login_script.php" method="post">
                 <div class="form-group">
                     <label for="email">Email address:</label>
                      <input type="email" class="form-control bg-transparent text-light"  name="lemail" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control bg-transparent text-light" id="pwd"  name="lpassword" placeholder="Password" required>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkbox">
                    <label for="checkbox" class="form-check-label">Stay signed in</label>
                </div>
                <button type="submit" class="btn btn-accent btn-block" name="Submit">Login</button>
              </form>
              <a href="http://" class="text-light">forgot password ?</a>
            </div>
            <div class="modal-footer">
              <p class="mr-auto">New User? <a href="#signup" data-toggle="modal" data-dismiss="modal" >signup</a></p>
              <button type="button" class="btn btn-outline-light" data-dismiss="modal" >Close</button>
            </div>
          </div>
        </div>
      </div>

    <div class="modal fade" id="signup">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content bg-dark text-light" style="background-color:#0b0c10; border: 1px solid rgba(255,255,255,0.12)">

            <div class="modal-header">
              <h5 class="modal-title">Sign Up</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <form action="signup_script.php" method="post">
                <div class="form-group">
                     <label for="email">Email address:</label>
                     <input type="email" class="form-control bg-transparent text-light"  name="eMail" placeholder="Enter email" required>
                     <?php if(isset($_GET['error'])){ echo "<span class='text-danger'>".$_GET['error']."</span>" ;}  ?>
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control bg-transparent text-light" id="pwd" name="password" placeholder="Password" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="validation1">First Name</label>
                        <input type="text" class="form-control bg-transparent text-light" id="validation1" name="firstName" placeholder="First Name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="validation2">Last Name</label>
                        <input type="text" class="form-control bg-transparent text-light" id="validation2" name="lastName" placeholder="Last Name">
                    </div>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" required>
                    <label for="checkbox" class="form-check-label">Agree terms and Condition</label>
                </div>
                <button type="submit" class="btn btn-accent btn-block" name="Submit">Sign Up</button>
            </form>
            </div>
            <div class="modal-footer">
              <p class="mr-auto">Already Registered?<a href="#login"  data-toggle="modal" data-dismiss="modal">Login</a></p>
              <button type="button" class="btn btn-outline-light" data-dismiss="modal" >Close</button>
            </div>
          </div>
        </div>
      </div>