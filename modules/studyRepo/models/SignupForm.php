<?php

namespace app\modules\studyRepo\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use app\modules\studyRepo\models\User;
use kartik\password\StrengthValidator;

/**
 * Signup form
 */
class SignupForm extends ActiveRecord
{
    public $username;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'app\modules\studyRepo\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => Yii::$app->params['user.usernameMinLength'], 'max' => 12],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'app\modules\studyRepo\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            // ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength'], StrengthValidator::className(), 'preset'=>'normal', 'userAttribute'=>'username'],
            ['password', StrengthValidator::class, 'preset' => 'normal', 'userAttribute' => 'username'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        // 
        return $user->save()&& $this->sendEmail($user);
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name . ' Accounts'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
    
}
