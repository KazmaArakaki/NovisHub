<?php
declare(strict_types=1);

namespace App\Controller\Settings;

use App\Exception\Exception as AppException;

class UserFolloweesController extends SettingsController {
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

        $hasAlreadyFollowed = $this->UserFollowees->find()
            ->where([
              ['UserFollowees.user_id' => $this->authUser['id']],
              ['UserFollowees.target_user_id' => $targetUser['id']],
            ])
            ->first() !== null;

        if ($hasAlreadyFollowed) {
          throw new AppException(__('既にフォローしている{0}です。', __('ユーザー')));
        }

        $userFollowee = $this->UserFollowees->newEntity([
          'user_id' => $this->authUser['id'],
          'target_user_id' => $targetUser['id'],
        ]);

        $userFolloweeSaved = $this->UserFollowees->save($userFollowee);

        if (!$userFolloweeSaved) {
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
    $userFolloweesQuery = $this->UserFollowees->find()
        ->contain(['TargetUsers.UserTags.Tags'])
        ->where([
          ['UserFollowees.user_id' => $this->authUser['id']],
        ])
        ->order(['UserFollowees.created' => 'desc']);

    $userFollowees = $this->paginate($userFolloweesQuery, [
      'limit' => 20,
    ]);

    $this->set(compact([
      'userFollowees',
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

        $userFollowee = $this->UserFollowees->find()
            ->where([
              ['UserFollowees.user_id' => $this->authUser['id']],
              ['UserFollowees.target_user_id' => $targetUser['id']],
            ])
            ->first();

        if (empty($userFollowee)) {
          throw new AppException(__('フォローしていない{0}です。', __('ユーザー')));
        }

        $userFolloweeDeleted = $this->UserFollowees->delete($userFollowee);

        if (!$userFolloweeDeleted) {
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

