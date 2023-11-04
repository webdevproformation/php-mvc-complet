<h1>Login </h1>
<?php $form = \app\core\form\Form::begin("/login") ?>

  <?php echo $form->field($model, "email") ?>

  <?php echo $form->field($model, "password")->passwordField() ?>

  <div class="mb-3">
    <input type="submit" class="btn btn-outline-primary btn-lg">
  </div>
<?php \app\core\form\Form::end() ?>