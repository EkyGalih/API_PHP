<?php
include "css.php";
ob_start();
session_start();
if (!isset($_SESSION['hostname'])) {
  header('location: index.php');
}else{
  ?>

  <!DOCTYPE html>
  <html>
  <head>
   <title>MikroTik - Application</title>
   <link rel="shortcut icon" href="assets/images/mikrotik-logo.png">
 </head>
 <body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="home.php">
          <img src="assets/images/mikrotik.png" class="img-rounded" height="30px">
        </a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li>
            <a href="show_user.php">
              <label class="glyphicon glyphicon-list"></label> <u>L</u>ist User
            </a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <label class="glyphicon glyphicon-align-center"></label> <u>F</u>irewall <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a href="FirewallFilter.php"><label class="glyphicon glyphicon-filter"></label> Firewall Filter</a>
              </li>
              <li>
                <a href="FirewallNat.php"><label class="glyphicon glyphicon-fire"></label> <u>F</u>irewall NAT</a>
              </li>
              <li>
                <a href="FirewallMangel.php"><label class="glyphicon glyphicon-fire"></label> <u>F</u>irewall Mangel</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="AddressList.php">
              <label class="glyphicon glyphicon-list-alt"></label> <u>A</u>ddress-list
            </a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <label class="glyphicon glyphicon-asterisk"></label> <u>S</u>ystem <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a href="Scheduler.php">
                  <label class="glyphicon glyphicon-time"></label> <u>S</u>cheduler
                </a>
              </li>
              <li>
                <a href="Script.php">
                  <label class="glyphicon glyphicon-file"></label> <u>S</u>cript
                </a>
              </li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <label class="glyphicon glyphicon-sound-5-1"></label> <u>I</u>p <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a href="hotspot.php">
                  <label class="glyphicon glyphicon-list-alt"></label> <u>H</u>otspot
                </a>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown">
              <label class="glyphicon glyphicon-user"></label> <?php echo $_SESSION['username'] ?><span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="Warning.php"><label class="glyphicon glyphicon-edit"></label> Edit Profil</a></li>
              <li><a href="Warning.php"><label class="glyphicon glyphicon-wrench"></label> Change Password</a></li>
              <li class="divider"></li>
              <li>
                <a href="Reboot.php"><label class="glyphicon glyphicon-refresh"></label> Reboot MikroTik</a>
                <a href="ShutDown.php"><label class="glyphicon glyphicon-off"></label> ShutDown MikroTik</a>
                <!-- <a href="#" data-toggle="modal" data-target="#reset"><label class="glyphicon glyphicon-repeat"></label> Reset MikroTik</a> -->
              </li>
              <li class="divider"></li>
              <li>
                <a href="logout.php"><label class="glyphicon glyphicon-log-out"></label> <u>L</u>ogout</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="jumbotron masthead">
    <div class="container">

      <div class="animated pulse modal fade" id="reset" role="dialog">
        <div class="modal-dialog">

          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><label class="glyphicon glyphicon-repeat"></label> Are You Sure</h4>
            </div>

            <div class="modal-body">
              <h4>Default?</h4><br/>
              <form name="reset" action="Reset.php" method="POST">
                <input type="radio" name="no-default" value="yes"> Yes
                <input type="radio" name="no-default" value="no"> No
                <br/>
                <button type="submit" name="submit" class="btn btn-danger btn-sm">
                  <label class="glyphicon glyphicon-repeat"></label> Reset
                </button>
                <button type="button" name="cancel" class="btn btn-sm">
                  <label class="glyphicon glyphicon-remove"></label> Cancel
                </button>
              </form>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn" data-dismiss="modal">
                <u>C</u>lose <label class="glyphicon glyphicon-remove"></label>
              </button>
            </div>
          </div>

        </div>
      </div>

      <h1 class="animated bounce">MikroTik</h1>
      <p class="animated zoomIn">Application Management Mikrotik Via Web.</p>
    </div>
  </div>
</body>
</html>
<?php
}
ob_end_flush();
?>