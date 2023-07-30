
<!DOCTYPE html>
<!--Login Page for both owners and hostelers-->
<html>
    <head>
        <title>Hostel Managment</title>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    </head>
    <body>
    <section class="form-02-main">
        <form action="auth.php" method = "POST"> <!-- Send the form data to auth.php when submitted -->
            <div class="container">
            <div class="row">
          <div class="col-md-12"><!-- make the code responsive -->
            <div class="_lk_de">
              <div class="form-03-main">
                <div class="logo">
                  <img src="assets/images/user.png">
                </div>
                    <div class="form-group"><!--Number text field-->
                        <input type="number" class="form-control" id="number" placeholder="Number" name="own_number" required>
                    </div>
                    <div class="form-group"><!--Password-->
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary" >Login</button>
                    </div>
                    
                <div class="form-group">
                    <?php
        if(isset($_GET['error'])==true){ //In case of an error
            echo '<h4 style="color:red; font:bold"> Invalid Authentication </h4>';
        }
        ?>
                </div>
                </div>
                <div class="form-group">
                  <div class="_btn_04">
                    <a href="ownerregister.php">Register as an owner</a><!--Redirects to ownerregister.php-->
                  </div>
                </div>
               
                <div class="form-group">
                  <div class="_btn_04">
                    <a href="hstlregister.php">Apply for hostel</a>
                  </div>
                </div>
            </div>
            </div>
        </form>
        </section>
    </body>
</html>