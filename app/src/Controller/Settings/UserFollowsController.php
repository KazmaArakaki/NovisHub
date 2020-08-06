<?php
declare(strict_types=1);

namespace App\Controller\Settings;

use App\Exception\Exception as AppException;

class UserFollowsController extends SettingsController {
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

        $hasAlreadyFollowed = $this->UserFollows->find()
            ->where([
              ['UserFollows.user_id' => $this->authUser['id']],
              ['UserFollows.target_user_id' => $targetUser['id']],
            ])
            ->first() !== null;

        if ($hasAlreadyFollowed) {
          throw new AppException(__('既にフォローしている{0}です。', __('ユーザー')));
        }

        $userFollow = $this->UserFollows->newEntity([
          'user_id' => $this->authUser['id'],
          'target_user_id' => $targetUser['id'],
        ]);

        $userFollowSaved = $this->UserFollows->save($userFollow);

        if (!$userFollowSaved) {
          throw new AppException(__('時間を置いて再度お試しください。'));
        }
      } catch (AppException $exception) {
        $this->Flash->error(implode('', [
          __('{0}のフォローに失敗しました。', __('ユーザー')),
          $exception->getMessage(),
        ]));
      }
    }

    return $this->redirect($this->request->referer());
  }

  public function index() {
    $userFollowsQuery = $this->UserFollows->find()
        ->contain(['TargetUsers.UserTags.Tags'])
        ->where([
          ['UserFollows.user_id' => $this->authUser['id']],
        ])
        ->order(['UserFollows.created' => 'desc']);

    $userFollows = $this->paginate($userFollowsQuery, [
      'limit' => 20,
    ]);

    $this->set(compact([
      'userFollows',
    ]));
  }

  public function delete() {
    if ($this->request->is(['delete'])) {
      try {
        $targetUser = $this->Users->find()
            ->where([
              ['Users.id' => $this->request->getData('target_user_id', '')],
            ])
            ->first();

        if (empty($targetUser)) {
          throw new AppException(__('{0}が見つかりませんでした。', __('ユーザー')));
        }

        $userFollow = $this->UserFollows->find()
            ->where([
              ['UserFollows.user_id' => $this->authUser['id']],
              ['UserFollows.target_user_id' => $targetUser['id']],
            ])
            ->first();

        if (empty($userFollow)) {
          throw new AppException(__('フォローしていない{0}です。', __('ユーザー')));
        }

        $userFollowDeleted = $this->UserFollows->delete($userFollow);

        if (!$userFollowDeleted) {
          throw new AppException(__('時間を置いて再度お試しください。'));
        }
      } catch (AppException $exception) {
        $this->Flash->error(implode('', [
          __('{0}のフォローに失敗しました。', __('ユーザー')),
          $exception->getMessage(),
        ]));
      }
    }

    return $this->redirect($this->request->referer());
  }
}

