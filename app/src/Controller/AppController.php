<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;
use Cake\Log\Log;

class AppController extends Controller {
  public function initialize(): void {
    parent::initialize();

    $this->loadModel('UserPokes');
    $this->loadModel('Users');

    $this->loadComponent('Auth', [
      'authError' => __('ログイン情報がありません。'),
      'loginAction' => [
        'prefix' => false,
        'controller' => 'Users',
        'action' => 'signin',
      ],
    ]);

    $this->loadComponent('Flash');
    $this->loadComponent('RequestHandler');
  }

  public function beforeFilter(EventInterface $event) {
    parent::beforeFilter($event);

    $this->Auth->allow();

    $this->authUser = null;

    if (!empty($this->Auth->user('id'))) {
      $this->authUser = $this->Users->find()
          ->where([
            ['Users.id' => $this->Auth->user('id')],
          ])
          ->first();
    }

    $this->set('authUser', $this->authUser);

    $this->hasUncheckedUserPokes = false;

    if (!empty($this->authUser)) {
      $this->hasUncheckedUserPokes = $this->UserPokes->find()
          ->where([
            ['UserPokes.target_user_id' => $this->authUser['id']],
            ['UserPokes.is_checked' => false],
          ])
          ->first() !== null;
    }

    $this->set('hasUncheckedUserPokes', $this->hasUncheckedUserPokes);
  }
}

