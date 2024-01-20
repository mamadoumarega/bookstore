<?php include "../includes/header.php"; ?>
    <div class="row justify-content-center">
        <div class="col-md-6" style="margin-bottom: 140px; margin-top: 20px;">
            <form class="form-control mt-5" method="post" action="register.php">
                <h4 class="text-center mt-3"> Register </h4>
                <div class="">
                    <label for="" class="col-sm-2 col-form-label">Username</label>
                    <div class="">
                        <input type="text" name="username" class="form-control" id="username"  value="">
                    </div>
                </div>
                <div class="">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="">
                        <input type="email" name="email" class="form-control" id="email" value="">
                    </div>
                </div>
                <div class="">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="">
                        <input type="password" name="password" class="form-control" id="inputPassword">
                    </div>
                </div>
                <button name="submit" class="w-100 btn btn-lg btn-primary mt-4 mb-4" type="submit">register</button>

            </form>
        </div>
    </div>
<?php include "../includes/footer.php"; ?>