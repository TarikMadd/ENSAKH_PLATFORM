<?php $this->layout = 'AdminLTE.login'; ?>

<form action="<?php echo $this->Url->build(array('controller' => 'users', 'action' => 'login')); ?>" method="post">
  <div class="form-group has-feedback">
    <input type="text" class="form-control" placeholder="Username" name="username">
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
    <input type="password" class="form-control" placeholder="Password" name="password">
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
  </div>
  <div class="row">
    <div class="col-xs-8">
      <div class="checkbox icheck">
        <label>
          <input type="checkbox"> Remember Me
        </label>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-lg btn-primary btn-block">Sign In</button>
</form>
