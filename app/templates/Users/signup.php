<div class="my-5 row justify-content-center">
  <div class="col-12 col-md-8 col-lg-6">
    <div class="card mb-2">
      <div class="card-body">
        <h5 class="card-title mb-3">
          <?= __('新規登録') ?>
        </h5>

        <?= $this->Form->create($user, ['novalidate' => true]) ?>
          <div class="mb-3">
            <label class="form-label">
              <?= __('ログインID') ?>
            </label>

            <?= $this->Form->text('auth_id', [
              'class' => implode(' ', [
                'form-control',
                $this->Form->isFieldError('auth_id') ? 'is-invalid' : '',
              ]),
            ]) ?>

            <div class="invalid-feedback">
              <?= $this->Form->error('auth_id') ?>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">
              <?= __('パスワード') ?>
            </label>

            <?= $this->Form->password('auth_password', [
              'class' => implode(' ', [
                'form-control',
                $this->Form->isFieldError('auth_password') ? 'is-invalid' : '',
              ]),
            ]) ?>

            <div class="invalid-feedback">
              <?= $this->Form->error('auth_password') ?>
            </div>
          </div>

          <div class="mb-3">
            <div class="form-check">
              <?= $this->Form->checkbox('is_agreed_to_terms_of_service', [
                'id' => 'is-agreed-to-terms-of-service-field',
                'class' => implode(' ', [
                  'form-check-input',
                  $this->Form->isFieldError('is_agreed_to_terms_of_service') ? 'is-invalid' : '',
                ]),
              ]) ?>

              <label for="is-agreed-to-terms-of-service-field" class="form-check-label">
                <?= __('{0}に同意する', vsprintf('<a href="%s" target="_blank">%s</a> ', [
                  $this->Url->build([
                    'controller' => 'Pages',
                    'action' => 'display',
                    'terms-of-service',
                  ]),
                  implode('', [
                    __('利用規約'),
                    '<svg width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" fill-rule="evenodd" xmlns="http://www.w3.org/2000/svg">',
                    '<path d="M1.5 13A1.5 1.5 0 0 0 3 14.5h8a1.5 1.5 0 0 0 1.5-1.5V9a.5.5 0 0 0-1 0v4a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 0 0-1H3A1.5 1.5 0 0 0 1.5 5v8zm7-11a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V2.5H9a.5.5 0 0 1-.5-.5z" />',
                    '<path d="M14.354 1.646a.5.5 0 0 1 0 .708l-8 8a.5.5 0 0 1-.708-.708l8-8a.5.5 0 0 1 .708 0z" />',
                    '</svg>',
                  ]),
                ])) ?>
              </label>

              <div class="invalid-feedback">
                <?= $this->Form->error('is_agreed_to_terms_of_service') ?>
              </div>
            </div>
          </div>

          <button class="btn btn-primary">
            <svg width="1em" height="1em" viewBox="3 3 12 12" class="" fill="currentColor">
              <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
            </svg>

            <?= __('新しいアカウントを登録する') ?>
          </button>
        <?= $this->Form->end() ?>
      </div>
    </div>

    <div class="text-right">
      <a href="<?= $this->Url->build([
        'action' => 'signin',
      ]) ?>">
        <?= __('アカウントにログインする') ?>
      </a>
    </div>
  </div>
</div>

