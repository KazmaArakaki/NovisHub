<?php
$this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/4.0.0/github-markdown.min.css', [
  'block' => true,
]);

$this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.1.2/styles/github.min.css', [
  'block' => true,
]);

$this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.1.2/highlight.min.js', [
  'block' => true,
]);

$this->assign('pageTitle', h($user['name']));
?>

<?php $this->append('meta'); ?>
<meta property="og:title" content="<?= h($user['name']) ?>">
<meta property="og:image" content="<?= $user->getAvatarUrl() ?>">
<meta property="og:description" content="<?= h($user['profile_summary']) ?>">
<?php $this->end(); ?>

<div class="my-3">
  <div class="row">
    <div class="col-md-4 d-flex flex-column align-items-center">
      <img src="<?= $user->getAvatarUrl() ?>" class="d-block mb-3" style="<?= $this->Html->style([
        'width' => '120px',
        'height' => '120px',
        'border-radius' => '50%',
      ]) ?>">

      <h2 class="h5">
        <?= h($user['name']) ?>
      </h2>

      <div class="mb-2">
        <?php if ($hasFollowed): ?>
        <?= $this->Form->postLink(implode(' ', [
          implode(' ', [
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="1em" height="0.8em" fill="currentColor" style="margin-top: -4px;">',
            '<path d="M624 208H432c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h192c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm-400 48c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z" />',
            '</svg>',
          ]),
          __('フォロー解除'),
        ]), [
          'prefix' => 'Settings',
          'controller' => 'UserFollows',
          'action' => 'delete',
        ], [
          'method' => 'delete',
          'block' => true,
          'escape' => false,
          'class' => 'btn btn-outline-danger btn-sm',
          'data' => [
            'target_user_id' => $user['id'],
          ],
        ]) ?>
        <?php endif; ?>

        <?php if (empty($authUser) || (!$hasFollowed && $user['id'] !== $authUser['id'])): ?>
        <?= $this->Form->postLink(implode(' ', [
          implode(' ', [
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="1em" height="0.8em" fill="currentColor" style="margin-top: -4px;">',
            '<path d="M624 208h-64v-64c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v64h-64c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h64v64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-64h64c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm-400 48c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z" />',
            '</svg>',
          ]),
          __('フォローする'),
        ]), [
          'prefix' => 'Settings',
          'controller' => 'UserFollows',
          'action' => 'create',
        ], [
          'block' => true,
          'escape' => false,
          'class' => 'btn btn-outline-info btn-sm',
          'data' => [
            'target_user_id' => $user['id'],
          ],
        ]) ?>
        <?php endif; ?>
      </div>

      <div class="mb-2">
        <?php if (empty($authUser) || $user['id'] !== $authUser['id']): ?>
        <?= $this->Form->postLink(implode(' ', [
          implode('', [
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" style="margin-top: -4px;">',
            '<path d="M428.8 137.6h-86.177a115.52 115.52 0 0 0 2.176-22.4c0-47.914-35.072-83.2-92-83.2-45.314 0-57.002 48.537-75.707 78.784-7.735 12.413-16.994 23.317-25.851 33.253l-.131.146-.129.148C135.662 161.807 127.764 168 120.8 168h-2.679c-5.747-4.952-13.536-8-22.12-8H32c-17.673 0-32 12.894-32 28.8v230.4C0 435.106 14.327 448 32 448h64c8.584 0 16.373-3.048 22.12-8h2.679c28.688 0 67.137 40 127.2 40h21.299c62.542 0 98.8-38.658 99.94-91.145 12.482-17.813 18.491-40.785 15.985-62.791A93.148 93.148 0 0 0 393.152 304H428.8c45.435 0 83.2-37.584 83.2-83.2 0-45.099-38.101-83.2-83.2-83.2zm0 118.4h-91.026c12.837 14.669 14.415 42.825-4.95 61.05 11.227 19.646 1.687 45.624-12.925 53.625 6.524 39.128-10.076 61.325-50.6 61.325H248c-45.491 0-77.21-35.913-120-39.676V215.571c25.239-2.964 42.966-21.222 59.075-39.596 11.275-12.65 21.725-25.3 30.799-39.875C232.355 112.712 244.006 80 252.8 80c23.375 0 44 8.8 44 35.2 0 35.2-26.4 53.075-26.4 70.4h158.4c18.425 0 35.2 16.5 35.2 35.2 0 18.975-16.225 35.2-35.2 35.2zM88 384c0 13.255-10.745 24-24 24s-24-10.745-24-24 10.745-24 24-24 24 10.745 24 24z" />',
            '</svg>'
          ]),
          __('つっつく'),
        ]), [
          'prefix' => 'Settings',
          'controller' => 'UserPokes',
          'action' => 'create',
        ], [
          'block' => true,
          'escape' => false,
          'class' => 'btn btn-outline-primary btn-sm',
          'data' => [
            'target_user_id' => $user['id'],
          ],
        ]) ?>
        <?php endif; ?>
      </div>
    </div>

    <div class="col-md-8">
      <?php if (!empty($user['profile'])): ?>
      <div id="markdown-text" class="markdown-body">
        <?= $this->Markdown->parse($user['profile']) ?>
      </div>
      <?php else: ?>
      <div>
        <?= __('まだ{0}が登録されていません。', __('プロフィール')) ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php $this->append('script'); ?>
<script>
window.addEventListener("DOMContentLoaded", (event) => {
  const markdownText = document.querySelector("#markdown-text");

  markdownText.querySelectorAll("pre code").forEach((block) => {
    hljs.highlightBlock(block);
  });
});
</script>
<?php $this->end(); ?>

