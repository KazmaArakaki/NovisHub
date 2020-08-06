<?php
declare(strict_types=1);

namespace App\Controller\Settings;

class HomeController extends SettingsController {
  public function initialize(): void {
    parent::initialize();

    $this->loadModel('UserFollowees');
  }

  public function index() {
    $userFolloweesCount = $this->UserFollowees->find()
        ->where([
          ['UserFollowees.user_id' => $this->authUser['id']],
        ])
        ->count();

    $this->set(compact([
      'userFolloweesCount',
    ]));
  }
}

