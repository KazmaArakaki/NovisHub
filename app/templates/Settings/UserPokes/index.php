<div class="my-3">
  <div class="row mb-2">
    <div class="col">
      <?php if (count($userPokes) === 0): ?>
      <?= __('つっついてきた{0}はまだいません。', __('ユーザー')) ?>
      <?php endif; ?>

      <?php foreach ($userPokes as $userPoke): ?>
      <div class="<?= implode(' ', [
        'card',
        'mb-2',
        !$userPoke['is_checked'] ? 'border-primary' : '',
      ]) ?>">
        <div class="card-body">
          <div class="row g-3">
            <div class="col-auto">
              <img src="<?= $userPoke['user']->getAvatarUrl() ?>" class="d-block rounded" style="<?= $this->Html->style([
                'width' => '48px',
                'height' => '48px',
              ]) ?>">
            </div>

            <div class="col">
              <p class="mb-0 text-muted">
                <?= $userPoke['created']->i18nFormat('yyyy/MM/dd HH:mm') ?>
              </p>

              <h5 class="mb-0">
                <a href="<?= $this->Url->build([
                  'prefix' => false,
                  'controller' => 'Users',
                  'action' => 'view',
                  $userPoke['user']['id'],
                ]) ?>" class="link-dark">
                  <?= h($userPoke['user']['name']) ?>
                </a>
              </h5>
            </div>
          </div>
        </div>
      </div>
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

