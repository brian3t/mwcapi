<?php

namespace app\helpers;

use ApnsPHP_Push;
use app\models\Notification;

class ApnsPHP_PushTrack extends ApnsPHP_Push
{
    protected $_user_id = null;

    public function set_user_id($user_id = null){
        $this->_user_id = $user_id;
    }
    public function send()
    {
        $notif = new Notification();
        $notif->setAttributes([
            'user_id' => $this->_user_id,
            //'message_sent' => json_encode($this->_aMessageQueue)
        ]);
        try {
            $notif->message_sent = $this->_aMessageQueue[1]['MESSAGE']->getText();
        } catch (\Exception $e){
            \Yii::error('no message');
        }

        try {
            parent::send();
        } catch (\Exception $exception){
            \Yii::error($exception);
        }

        $errors = $this->getErrors(false);
        if (is_array($errors))
        {
            $errors = array_shift($errors)['ERRORS'];
            if (is_array($errors))
            {
                $notif->setAttribute('server_reply', array_shift($errors)['statusMessage']);
            }
        }

		//\Yii::error(json_encode($notif->attributes));
        if (!$notif->save()){
			\Yii::error(json_encode($notif->errors));
		}
    }
}