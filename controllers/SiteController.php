<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     * 
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
            $epoch = time();
            $hour = date('H', time());
            $min = date('i', time());
            $sec = date('s', time());
            $year = date('Y', time());
            $current_day_sec = ($sec + ($min*60) + ($hour*3600)) - 3600;
                    
                    // function to check if current year is a leap year
                function leapYear(){
                    $year = date('Y', time());
                    if (($year%4) == 0 && ($year%100) != 0 ){
                        return true;
                    }
                }

                $yearinsec = 60*60*24;

                $jan = 31;

                if (leapYear()){
                    $feb = 29;
                }else{
                    $feb = 28;
                }

                $mar = 31;
                $apr = 30;
                $may = 31;
                $jun = 30;
                $jul = 31;
                $aug = 31;
                $sep = 30;
                $oct = 31;
                $nov = 30;
                $dec = 31;

                $month_array = array($jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec);

                $month = date('m', time());
                $month = intval($month);
                $day = date('d', time());
                $day = intval($day);
                $day_since = 0;

                $month_since = 0;

                //if not january
                if($month > 1){

                 for ($i = 2; $i <= $month; $i++){
                        $k = $i-2;
                        $month_since += $month_array[$k];
                        if($month == $i){
                           $day_since = $month_since + ($day);
                           $sec_since = (($day_since-1)*86400) + $current_day_sec;
                           $firstdate_of_year = date('Y-M-D H:i:s', ($epoch - $sec_since));
                           $first_day_of_year = date('D', ($epoch - $sec_since));
                           $first_daynum_of_year = date('j', ($epoch - $sec_since));
                        }
                    }
        
                }elseif($month == 1){
                    $day_since = $day;
                    $sec_since = (($day_since-1)*86400) + $current_day_sec;
                    $firstdate_of_year = date('Y-M-D H:i:s', ($epoch - $sec_since));
                    $first_day_of_year = date('D', ($epoch - $sec_since));
                    $first_daynum_of_year = date('d', ($epoch - $sec_since));
                    $first_daynum_of_year = intval($first_day_of_year);
                }
            





    return $this->render('index', [
        'sec_since' => $sec_since,
        'first_day_of_year' => $first_day_of_year,
        'first_daynum' => $first_daynum_of_year,
        'day_since' => $day_since,
        'firstdate_of_year' => $firstdate_of_year,
        'months_days' => $month_array,
        'current_day' => $day,
        'current_month' => $month,
        'epoch' => $epoch
    ]); 
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
