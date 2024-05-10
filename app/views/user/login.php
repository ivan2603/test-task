<?php include_once "header.php" ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card" style="margin-top: 40%">
                <div class="card-body">
                    <h5 class="card-title">Login</h5>
                    <form action="/user/login" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label for="inputLogin">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="The name must be at least 3 characters long" required>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Enter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





