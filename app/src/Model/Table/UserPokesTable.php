<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\ORM\Table;

class UserPokesTable extends Table {
  public function initialize(array $config): void {
    parent::initialize($config);

    $this->belongsTo('Users');

    $this->belongsTo('TargetUsers')
        ->setClassName('Users')
        ->setBindingKey('id')
        ->setForeignKey('target_user_id')
        ->setProperty('target_user');
  }
}

