<?php
declare(strict_types=1);

namespace App\Controller\Settings;

use App\Exception\Exception as AppException;
use Cake\I18n\Time;

class UserPokesController extends SettingsController {
  public function initialize(): void {
    parent::initialize();

    $this->loadModel('Users');
  }

  public function create() {
    if ($this->request->is(['post'])) {
      try {
        $targetUser = $this->Users->find()
            ->where([
              ['Users.id' => $this->request->getData('target_user_id', '')],
            ])
            ->first();

        if (empty($targetUser)) {
          throw new AppException(__('{0}が見つかりませんでした。', __('ユーザー')));
        }

        $time = Time::now('Asia/Tokyo')->i18nFormat('yyyy/MM/dd');
        $time = new Time($time, 'Asia/Tokyo');
        $time = $time->setTimezone('UTC');

        $hasPokeCountReachedLimit = $this->UserPokes->find()
            ->where([
              ['UserPokes.user_id' => $this->authUser['id']],
              ['UserPokes.created >' => $time],
            ])
            ->count() >= 10;

        if ($hasPokeCountReachedLimit) {
          throw new AppException(__('１日のつっつきは１０回までです。'));
        }

        $userPoke = $this->UserPokes->newEntity([
          'user_id' => $this->authUser['id'],
          'target_user_id' => $targetUser['id'],
        ]);

        $userPokeSaved = $this->UserPokes->save($userPoke);

        if (!$userPokeSaved) {
          throw new AppException(__('時間を置いて再度お試しください。'));
        }

        $this->Flash->success(__('{0}さんをつっつきました。', h($targetUser['name'])));
      } catch (AppException $exception) {
        $this->Flash->error(implode('', [
          __('{0}のつっつきに失敗しました。', __('ユーザー')),
          $exception->getMessage(),
        ]));
      }
    }

    return $this->redirect($this->request->referer());
  }

  public function index() {
    $userPokesQuery = $this->UserPokes->find()
        ->contain(['Users'])
        ->where([
          ['UserPokes.target_user_id' => $this->authUser['id']],
        ])
        ->order(['UserPokes.created' => 'desc']);

    $userPokes = $this->paginate($userPokesQuery, [
      'limit' => 20,
    ]);

    $uncheckedUserPokeIds = [];

    foreach ($userPokes as $userPoke) {
      if (!$userPoke['is_checked']) {
        $uncheckedUserPokeIds[] = $userPoke['id'];
      }
    }

    if (!empty($uncheckedUserPokeIds)) {
      $this->UserPokes->updateAll([
        'is_checked' => true,
      ], [
        ['UserPokes.target_user_id' => $this->authUser['id']],
        ['UserPokes.id IN' => $uncheckedUserPokeIds],
      ]);
    }

    $this->set(compact([
      'userPokes',
    ]));
  }
}

