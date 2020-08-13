<?php
use Cake\Core\Configure;
use Cake\I18n\Time;

$pageTitle = !empty($this->fetch('pageTitle')) ? sprintf('%s | ', $this->fetch('pageTitle')) : '';
$pageTitle .= __('Novis Hub');

$pageDescription = __('{0}は駆け出しエンジニアが仲間を見つけるための場所。', __('Novis Hub'));
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <meta name="robots" content="<?= Configure::read('debug') || !empty($this->request->getParam('prefix')) ? 'noindex,nofollow' : 'index,follow' ?>">

    <meta name="description" content="<?= $pageDescription ?>">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= __('Novis Hub') ?>">
    <meta name="twitter:card" content="summary"></meta>
    <meta name="twitter:site" content="<?= Configure::read('Twitter.meta.site') ?>"></meta>

    <?= $this->fetch('meta') ?>

    <?php if (!$this->exists('meta')): ?>
    <meta property="og:title" content="<?= $pageTitle ?>">
    <meta property="og:image" content="<?= $this->Url->image('app_logo.png', [
      'fullBase' => true,
    ]) ?>">
    <meta property="og:description" content="<?= $pageDescription ?>">
    <?php endif; ?>

    <?= $this->Html->css('https://fonts.googleapis.com/css2?family=Teko:wght@700&display=swap') ?>

    <?= $this->Html->css('https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css', [
      'integrity' => 'sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I',
      'crossorigin' => 'anonymous',
    ]) ?>

    <?= $this->fetch('css') ?>

    <title>
      <?= $pageTitle ?>
    </title>
  </head>

  <body>
    <header class="navbar navbar-expand navbar-light bg-light">
      <nav class="container-xxl flex-wrap flex-md-nowrap">
        <a href="<?= $this->Url->build([
          'prefix' => false,
          'controller' => 'Home',
          'action' => 'index',
        ]) ?>" class="navbar-brand p-0 mr-2" style="<?= $this->Html->style([
          'font-family' => 'Teko, sans-serif',
          'color' => '#0f4c81',
        ]) ?>">
          <?= $this->Html->image('app_logo.png', [
            'style' => $this->Html->style([
              'width' => '2em',
              'height' => '2em',
            ]),
          ]) ?>

          <?= __('Novis Hub') ?>
        </a>

        <div class="navbar-nav-scroll d-flex">
          <ul class="navbar-nav">
          </ul>
        </div>

        <div class="btn-toolbar">
          <div class="btn-group">
            <?php if (empty($authUser)): ?>
            <a href="<?= $this->Url->build([
              'prefix' => false,
              'controller' => 'Users',
              'action' => 'signup',
            ]) ?>" class="btn btn-outline-primary">
              <?= vsprintf('%s / <small>%s</small>', [
                __('アカウント登録'),
                __('ログイン'),
              ]) ?>
            </a>

            <?php else: ?>

            <div class="dropdown">
              <button class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown">
                <?= __('{0}さん', $authUser['name']) ?>

                <?php if ($hasUncheckedUserPokes): ?>
                <span class="badge rounded-pill bg-danger">!</span>
                <?php endif; ?>
              </button>

              <ul class="dropdown-menu">
                <li>
                  <a href="<?= $this->Url->build([
                    'prefix' => false,
                    'controller' => 'Users',
                    'action' => 'view',
                    $authUser['id'],
                  ]) ?>" class="dropdown-item">
                    <?= __('公開プロフィール') ?>
                  </a>
                </li>

                <li>
                  <a href="<?= $this->Url->build([
                    'prefix' => 'Settings',
                    'controller' => 'Home',
                    'action' => 'index',
                  ]) ?>" class="dropdown-item">
                    <?= __('設定') ?>
                  </a>
                </li>
              </ul>
            </div>

            <?php endif; ?>
          </div>
        </div>
      </nav>
    </header>

    <main class="main">
      <div class="container">
        <?= $this->Flash->render() ?>

        <?= $this->fetch('content') ?>
      </div>
    </main>

    <footer class="p-3 p-md-5 mt-5 bg-light">
      <div class="container">
        <p class="row justify-content-center">
          <a href="<?= $this->Url->build([
            'prefix' => false,
            'controller' => 'Pages',
            'action' => 'display',
            'terms-of-service',
          ]) ?>" class="col-auto link-dark">
            <?= __('利用規約') ?>
          </a>

          <a href="<?= $this->Url->build([
            'prefix' => false,
            'controller' => 'Pages',
            'action' => 'display',
            'privacy-policy',
          ]) ?>" class="col-auto link-dark">
            <?= __('プライバシーポリシー') ?>
          </a>

          <?php if (Configure::check('App.contact.googleFormUrl')): ?>
          <a href="<?= Configure::read('App.contact.googleFormUrl') ?>" target="_blank" class="col-auto link-dark">
            <?= __('お問い合わせ') ?>

            <svg width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" fill-rule="evenodd" xmlns="http://www.w3.org/2000/svg">
              <path d="M1.5 13A1.5 1.5 0 0 0 3 14.5h8a1.5 1.5 0 0 0 1.5-1.5V9a.5.5 0 0 0-1 0v4a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 0 0-1H3A1.5 1.5 0 0 0 1.5 5v8zm7-11a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V2.5H9a.5.5 0 0 1-.5-.5z" />

              <path d="M14.354 1.646a.5.5 0 0 1 0 .708l-8 8a.5.5 0 0 1-.708-.708l8-8a.5.5 0 0 1 .708 0z" />
            </svg>
          </a>
          <?php endif; ?>
        </p>

        <p class="text-center">
          <a href="https://github.com/KazmaArakaki/NovisHub" class="link-dark">
            <?= h('You are welcome to contribute to this project! Take a quick look at the project repository at GitHub!') ?>
          </a>
        </p>

        <p class="text-center text-muted">
          <?= sprintf('© Copyright %s %s', Time::now('Asia/Tokyo')->i18nFormat('yyyy'), h('Novis Hub')) ?>
        </p>
      </div>
    </footer>

    <?= $this->fetch('modal') ?>

    <?= $this->fetch('postLink') ?>

    <?= $this->Html->script('https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', [
      'integrity' => 'sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo',
      'crossorigin' => 'anonymous',
    ]) ?>

    <?= $this->Html->script('https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js', [
      'integrity' => 'sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/',
      'crossorigin' => 'anonymous',
    ]) ?>
 
    <?= $this->fetch('script') ?>

    <?= $this->element('twitter_universal_website_tag') ?>
  </body>
</html>

