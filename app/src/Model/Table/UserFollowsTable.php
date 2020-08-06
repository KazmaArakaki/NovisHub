<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\ORM\Table;

class UserFollowsTable extends Table {
  public function initialize(array $config): void {
    parent::initialize($config);

    $this->belongsTo('TargetUsers')
        ->setClassName('Users')
        ->setBindingKey('id')
        ->setForeignKey('target_user_id')
        ->setProperty('target_user');
  }
}

