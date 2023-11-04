<h1>Nous contacter</h1>

<?php $form = \app\core\form\Form::begin("/contact") ?>
  <?php echo $form->field($model, "email") ?>
  <?php echo $form->field($model, "subject") ?>
  <?php echo $form->select($model, "service", ["informatique", "commercial"]) ?>
  <?php echo $form->textarea($model, "message") ?>
  <?php // autre manière ! echo new app\core\form\TextareaField($model, "message"); ?>
  <div class="mb-3 text-end">
    <input type="submit" class="btn btn-outline-primary btn-lg">
  </div>
<?php \app\core\form\Form::end() ?>