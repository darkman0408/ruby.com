<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $city;
    public $postal_code;
    public $country;
    public $contact_number;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['first_name', 'string', 'max' => 255],
            ['last_name', 'string', 'max' => 255],
            ['city', 'string', 'max' => 255],
            ['postal_code', 'string', 'max' => 255],
            ['country', 'string', 'max' => 255],
            ['contact_number', 'string', 'max' => 255],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
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
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->city = $this->city;
        $user->postal_code = $this->postal_code;
        $user->country = $this->country;
        $user->contact_number = $this->contact_number;
        $user->generateAuthKey();

        // set user status to 0
        $user->status = 0;

        if($user->save())
        {
            // the following three lines were added
            // new user is set as user
            $auth = \Yii::$app->authManager;
            $userRole = $auth->getRole('user');
            $auth->assign($userRole, $user->getId());

            return $user; 
        }
        
        return null;
    }
}
