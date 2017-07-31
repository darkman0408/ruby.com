<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\base\ErrorException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\ProductCategories;
use common\models\ProductCharacteristics;
use common\models\Products;
use common\models\Thumb;
use common\models\ProductImages;
use common\models\Zoomed;
use common\models\User;
use Braintree\ClientToken;
use Braintree\Transaction;
use yii\web\Session;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**        'model' => $braintree
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) 
        {
            if ($user = $model->signup()) 
            {

                //code for mail registration confirmation
                $email = \Yii::$app->mailer->compose()
                ->setTo($user->email)
                ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . 'robot'])
                ->setSubject('Signup Confirmation')
                ->setTextBody("
                    Click this link " . Html::a('confirm', Yii::$app->urlManager->createAbsoluteUrl(['site/confirm', 'id' => $user->id, 'key' => $user->auth_key])
                    )
                )
                ->send();

                if($email)
                {
                    Yii::$app->getSession()->setFlash('success', 'Check Your Email!');
                }
                else
                {
                    Yii:$app->getSession()->setFlash('warning', 'Failed, contact Admin!');
                }

                return $this->goHome();

                //original code
                /*if (Yii::$app->getUser()->login($user)) 
                {
                    return $this->goHome();
                }*/
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
    * Mail confirmation
    */
    public function actionConfirm($id, $key)
    {
        $user = User::find()->where([
            'id' => $id,
            'auth_key' => $key,
            'status' => 0,
        ])->one();

        if(! empty($user))
        {
            $user->status = 10;
            $user->save();
            Yii:$app->getSession()->setFlash('success', 'Success!');
        }
        else
        {
            Yii::$app->getSession()->setFlash('warning', 'Failed!');
        }

        return $this->goHome();
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionCategory($product_subcategory = null)
    {

        $items = new ProductCategories();
        $jewelry_items = new ProductCategories();
        $metal_items = new ProductCategories();
        $investment_items = new ProductCategories();
        $charact_items = new ProductCharacteristics();

        $subcategory_url = Yii::$app->request->queryParams['product_subcategory'];

        $category_code = new Products();

        //get thumbs
        $thumb_images = new Thumb();

        return $this->render('category', [
            'items' => $items,
            'items' => $items->getCategoryBriliant(),
            'jewelry_items' => $jewelry_items->getCategoryJewelry(),
            'metal_items' => $metal_items->getCategoryMetal(),
            'investment_items' => $investment_items->getCategoryInvestment(),
            'subcategory_url' => $subcategory_url,
            'category_code' => $category_code->findProductCategoryCode($subcategory_url),
            'thumbs' => $thumb_images->getThumbs($product_subcategory),
        ]);
    }

    public function actionItem($id)
    {
        $model = new ProductImages();
        $zoom_model = new Zoomed();
        $data_model = new Products();
        $desc_model = new ProductCategories();

        return $this->render('item', [
            'images' => $model->getImage($id), 
            'data' => $data_model->getProductData($id),
            'desc' => $desc_model->getSubDesc($id),
            //'codes' => $model->findProductCode($id),
            'zooms' => $zoom_model->getImage($id),
        ]);
    }

    public function actionAddToCart($product_code, $id)
    {
        $cart = Yii::$app->cart;

        $model = Products::findOne($id);
        if($model)
        {
            $cart->put($model, 1);

            return $this->redirect(['site/cart',]);
        }
        throw new NotFoundHttpException();
    }

    public function actionCart()
    {
        $total = Yii::$app->cart->getCost();
        $itemsCount = Yii::$app->cart->getCount();

        return $this->render('cart', ['count' => $itemsCount, 'total' => $total,]);
    }

    public function actionCheckout($username)
    {
        $model = new User();

        $user_id = $model->getUserId($username);
        $user = User::findOne($user_id);

        //$total = Yii::$app->cart->getCost();

        $plan_id = 'pbd2'; // plan id from braintree
        $clientToken = ClientToken::generate(); 

        /*if(Yii::$app->request->post('payment_method_nonce'))
        {

        }*/

        return $this->render('checkout', ['user' => $user, 'clientToken' => $clientToken]); 
    }

    /**
    * Braintree action script
    */
    public function actionTransactionEndpoint()
    {
        $nonce_from_client = $_POST["payment_method_nonce"]; // in production, replace fake-valid-nonce with this
        $itemsCount = Yii::$app->cart->getCount();
        $amount = Yii::$app->cart->getCost();

        $result = Transaction::sale([
            'amount' => $amount,
            'paymentMethodNonce' => 'fake-valid-nonce',
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        return $this->render('transaction-endpoint', ['nonce_from_client' => $nonce_from_client, 'itemsCount' => $itemsCount, 'result' => $result]);
    }

    public function actionMyAccount()
    {
        return $this->render('my-account', []);
    }

    /**
    * receives ajax post request and sends query to database 
    */
    public function actionFilterImages()
    {
        $data = [];
        if(!empty($_POST["product_subcategory"]))
        {
            $data = $_POST["product_subcategory"];
        }
        //$data = join(' OR ', $data);

        $thumbs = Thumb::find()
                ->innerJoinWith('productCode')
                ->where(['Products.product_subcategory' => $data])
                ->all();

        return $this->renderPartial('filter-images', ['thumbs' => $thumbs]);
    }
}
