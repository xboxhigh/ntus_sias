<?php

namespace app\modules\v1\controllers;

use Yii;

class PsychoController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\modules\v1\models\Users';
    public $usersBodyClass = 'app\modules\v1\models\UsersBodyInfo';
    public $psychologicalSkillScaleClass = 'app\modules\v1\models\PsychologicalSkillScale';
    public $psychologicalSkillQuestionsClass = 'app\modules\v1\models\PsychologicalSkillQuestions';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => \sizeg\jwt\JwtHttpBearerAuth::class,
            'optional' => [ // the action list in here does not need JWT authentication
            ],
        ];

        return $behaviors;
    }

    public function actions()
    {
        $action = parent::actions(); // TODO: Change the autogenerated stub
        unset($action['index']);
        unset($action['create']);
        unset($action['update']);
        unset($action['delete']);
    }

    public function actionIndex()
    {
        $response = Yii::$app->response;

        $psychologicalSkillScale = $this->psychologicalSkillScaleClass::findAllRecords();

        if (is_null($psychologicalSkillScale)) {
            $response->statusCode = 404;
            $response->data = [
                'message' => '無紀錄',
            ];
        } else {
            $response->statusCode = 200;
            $response->data = $psychologicalSkillScale;
        }
        return $response;
    }

    public function actionFindOne($id)
    {
        $response = Yii::$app->response;

        $identity = $this->usersBodyClass::findIdentity($id);

        if (is_null($identity)) {
            $response->statusCode = 404;
            $response->data = [
                'message' => '無此單號',
            ];
        } else {
            $psychologicalSkillScale = $this->psychologicalSkillScaleClass::findOneRecord($id);

            if (is_null($psychologicalSkillScale)) {
                $response->statusCode = 204;
                $response->data = [
                    'message' => '無紀錄',
                ];
            } else {
                $response->statusCode = 200;
                $response->data = $psychologicalSkillScale;
            }
        }

        return $response;
    }

    public function actionCreate($id)
    {
        $request = Yii::$app->request;
        $response = Yii::$app->response;
        $schema = 'Bearer';
        $params = $request->post();

        $authHeader = $request->getHeaders()->get('Authorization');
        if ($authHeader !== null && preg_match('/^' . $schema . '\s+(.*?)$/', $authHeader, $matches)) {
            $token = $matches[1];
        } else {
            $token = null;
        }

        // Find user base on access token
        $user = $this->modelClass::findIdentityByAccessToken($token);

        if (is_null($user)) {
            $response->statusCode = 403;
            $response->data = [
                "message" => "禁止存取，請先至首頁建立基本資料．",
            ];
        } else {
            // 新增資料（table muscles_joint_measurement)
            $psychologicalSkillScale = $this->psychologicalSkillScaleClass::createData($id, $params);

            if (is_null($psychologicalSkillScale)) {

                $response->statusCode = 400;
                $response->data = [
                    'message' => '資料格式有誤，新增失敗(muscles_joint_measurement)．',
                ];
            } else {
                if ($psychologicalSkillScale == "NUMBER_NOT_MATCH") {
                    $response->statusCode = 409;
                    $response->data = [
                        'message' => '答案數量與題目數量不符．',
                    ];
                } else {
                    $response->statusCode = 201;
                    $response->data = [
                        'message' => '新增成功．',
                    ];
                }
            }
        }
        return $response;
    }

    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $response = Yii::$app->response;
        $schema = 'Bearer';
        $params = $request->post();

        $authHeader = $request->getHeaders()->get('Authorization');
        if ($authHeader !== null && preg_match('/^' . $schema . '\s+(.*?)$/', $authHeader, $matches)) {
            $token = $matches[1];
        } else {
            $token = null;
        }

        // Find user base on access token
        $user = $this->modelClass::findIdentityByAccessToken($token);

        if (is_null($user)) {
            $response->statusCode = 403;
            $response->data = [
                "message" => "禁止存取，請先至首頁建立基本資料．",
            ];
        } else {
            $modPsycho = $this->psychologicalSkillScaleClass::updateData($id, $params);
            if (is_null($modPsycho)) {
                $response->statusCode = 400;
                $response->data = [
                    'message' => '資料修改失敗，資料格式有誤．',
                ];
            } else {
                if ($modPsycho == "NUMBER_NOT_MATCH") {
                    $response->statusCode = 409;
                    $response->data = [
                        'message' => '答案數量與題目數量不符．',
                    ];
                } else {
                    $response->statusCode = 200;
                    $response->data = [
                        'message' => '修改成功．',
                    ];
                }
            }
        }
        return $response;
    }

    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $response = Yii::$app->response;
        $schema = 'Bearer';
        $params = $request->post();

        $authHeader = $request->getHeaders()->get('Authorization');
        if ($authHeader !== null && preg_match('/^' . $schema . '\s+(.*?)$/', $authHeader, $matches)) {
            $token = $matches[1];
        } else {
            $token = null;
        }

        // Find user base on access token
        $user = $this->modelClass::findIdentityByAccessToken($token);

        if (is_null($user)) {
            $response->statusCode = 403;
            $response->data = "";
        } else {
            $role = $user['role'];
            $identity = $this->usersBodyClass::findIdentity($id);

            if (is_null($identity)) {
                $response->statusCode = 404;
                $response->data = [
                    "message" => "無資料可刪",
                ];
            } else {
                if ($role === 1) {
                    // Staff role
                    $this->psychologicalSkillScaleClass::deleteData($id);
                    $response->statusCode = 200;
                    $response->data = [
                        'message' => '刪除成功',
                    ];
                } else {
                    // Common user role
                    if ($identity['u_id'] != $user['u_id']) {
                        $response->statusCode = 403;
                        $response->data = [
                            'message' => '無權限',
                        ];
                    } else {
                        $this->psychologicalSkillScaleClass::deleteData($id);
                        $response->statusCode = 200;
                        $response->data = [
                            'message' => '刪除成功',
                        ];
                    }
                }
            }
        }
        return $response;
    }
}
