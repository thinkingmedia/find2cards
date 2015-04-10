<?php
echo $this->Flash->render('auth');
echo $this->Form->create();
echo $this->Form->input('provider', ['value' => 'facebook']);
echo $this->Form->input('openid_identifier', ['value' => 'http://memory.thinkingmedia.local/']);
echo $this->Form->submit('Login');
echo $this->Form->end();
