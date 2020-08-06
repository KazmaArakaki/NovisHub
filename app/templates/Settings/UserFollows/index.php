<div class="my-3">
  <div class="row mb-2">
    <div class="col">
      <?php foreach ($userFollows as $userFollow): ?>
      <?= $this->element('user_card', [
        'user' => $userFollow['target_user'],
      ]) ?>
      <?php endforeach; ?>
    </div>
  </div>

  <ul class="pagination">
    <?= $this->Paginator->numbers([
      'modulus' => 2,
      'first' => 1,
      'last' => 1,
    ]) ?>
  </ul>
</div>

