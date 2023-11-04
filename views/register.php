<h1>Register</h1>
<?php $form = \app\core\form\Form::begin("/register") ?>

  <div class="row"> 
    <div class="col">
      <?php echo $form->field($model, "firstname") ?>
    </div>
    <div class="col">
      <?php echo $form->field($model, "lastname") ?>
    </div>
  </div>
  <?php echo $form->field($model, "email") ?>

  <?php echo $form->field($model, "password")->passwordField() ?>

  <?php echo $form->field($model, "confirmPassword")->passwordField() ?>
  <div class="mb-3">
    <input type="submit" class="btn btn-outline-primary btn-lg">
  </div>
<?php \app\core\form\Form::end() ?>