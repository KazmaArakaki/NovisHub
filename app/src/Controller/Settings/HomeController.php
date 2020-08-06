<?php
declare(strict_types=1);

namespace App\Controller\Settings;

class HomeController extends SettingsController {
  public function initialize(): void {
    parent::initialize();

    $this->loadModel('UserFollows');
  }

  public function index() {
    $userFollowsCount = $this->UserFollows->find()
        ->where([
          ['UserFollows.user_id' => $this->authUser['id']],
        ])
        ->count();

    $this->set(compact([
      'userFollowsCount',
    ]));
  }
}

