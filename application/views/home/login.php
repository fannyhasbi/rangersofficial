<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
</head>
<body>

<div class="jumbotron text-center">
  <h1>Login Official</h1>
</div>

<div class="container-fluid">
  <div class="col-md-4 col-md-offset-4">
    <form action="" method="post">
      <div class="form-group">
        <label for="username" class="control-label">Username</label>
        <input type="text" class="form-control" name="username">
      </div>
      <div class="form-group">
        <label for="password" class="control-label">Password</label>
        <input type="password" class="form-control" name="password">
      </div>

      <div class="form-group">
        <input type="submit" class="btn btn-success" name="login">
      </div>
    </form>
  </div>
</div>

</body>
</html>