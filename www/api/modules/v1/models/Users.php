<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $u_id 個案編號
 * @property string $created_at 測試日期
 * @property string $updated_at 更新日期
 * @property string $name 個案姓名
 * @property string $line_id 個案連絡ID
 * @property string $contact_no 個案連絡號碼
 * @property string $access_token 存取token
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'string', 'max' => 20],
            [['name', 'contact_no'], 'string', 'max' => 50],
            [['line_id'], 'string', 'max' => 100],
            [['access_token'], 'string'],
            [['last_modify'], 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'u_id' => 'Ub ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'name' => 'Name',
            'line_id' => 'Line ID',
            'contact_no' => 'Contact No',
            'access_token' => 'Access Token',
            'last_modify' => 'Last Modify',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return Users::find()
            ->select(['u_id', 'created_at', 'updated_at', 'name', 'line_id', 'contact_no'])
            ->where(['u_id' => $id])
            ->one();
        //return static::findOne(['u_id' => $id, 'status' => self::STATUS_ACTIVE]);
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return Users::find()
            ->where(['name' => $username])
            ->one();
    }

    /**
     * Finds user by username
     *
     * @param string $line_id
     * @return static|null
     */
    public static function findByLineID($line_id)
    {
        $user = Users::find()
            ->where(['line_id' => $line_id])
            ->one();

        if ($user) {
            $user->access_token = static::generateAccessToken([
                'u_id' => $user->u_id,
                'name' => $user->name,
                'line_id' => $user->line_id,

            ]);
            $user->save();
        }

        return $user;
    }
    /**
     * {@inheritdoc}
     */
    public static function findAllRecords()
    {
        return Users::find()
            ->select(['u_id', 'created_at', 'updated_at', 'name', 'line_id', 'contact_no'])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findByValidateToken($token, $type = null)
    {
        return Users::find()
            ->where(['access_token' => $token])
            ->one();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->u_id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function createData($params)
    {
        $values = [
            'name' => $params['name'],
            'line_id' => $params['line_id'],
            'contact_no' => $params['contact_no'],
            'created_at' => (string) self::currentTimeMillis(),
            'updated_at' => (string) self::currentTimeMillis(),
        ];

        $user = Users::findOne(['line_id' => $values['line_id']]);

        // The line_id does not exist
        if (is_null($user)) {
            $newUser = new Users;
            $newUser->attributes = $values;
            // create new user

            if ($newUser->save()) {
                $identity = Users::find()
                    ->where(['line_id' => $values['line_id']])
                    ->one();

                $identity->access_token = static::generateAccessToken([
                    'u_id' => $newUser->u_id,
                    'name' => $newUser->name,
                    'line_id' => $newUser->line_id,
                ]);
                $identity->save();

                return $identity;
            }
        } else {
            // The line_id has existed
            if (strcmp($user->name, $values['name']) != 0) {
                $user->name = $values['name'];
                $user->updated_at = (string) self::currentTimeMillis();
            }
            if (strcmp($user->contact_no, $values['contact_no']) != 0) {
                $user->contact_no = $values['contact_no'];
                $user->updated_at = (string) self::currentTimeMillis();
            }

            if (!is_null($user->last_modify)) {
                $ubi_id = $user->last_modify;
                $t1 = UsersBodyInfo::findOne(['ubi_id' => $ubi_id]);
                $t2 = ShoesBasicInfo::findOne(['ubi_id' => $ubi_id]);
                $t3 = ShoesAdvanceInfo::findOne(['ubi_id' => $ubi_id]);
                $t4 = MedicalHistory::findOne(['ubi_id' => $ubi_id]);
                $t5 = MusclesJointsMeasurement::findOne(['ubi_id' => $ubi_id]);
                $t6 = FunctionalMeasurement::findOne(['ubi_id' => $ubi_id]);
                $t7 = PsychologicalSkillScale::findOne(['ubi_id' => $ubi_id]);
                $t8 = UsersInvestigation::findOne(['ubi_id' => $ubi_id]);

                if (
                    !is_null($t1) && !is_null($t2) && !is_null($t3) && !is_null($t4)
                    && !is_null($t5) && !is_null($t6) && !is_null($t7) && !is_null($t8)
                ) {
                    $user->last_modify = null;
                }
            }

            $user->access_token = static::generateAccessToken([
                'u_id' => $user->u_id,
                'name' => $user->name,
                'line_id' => $user->line_id,
            ]);
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }

    public function updateData($id, $params)
    {
        $user = Users::findOne(['u_id' => $id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($user)) {
            return 'NO_SUCH_USER';
        } else {
            foreach ($params as $key => $value) {
                if (array_key_exists($key, self::attributeLabels()) && $value != $user->$key) {
                    $user->updated_at = $updated_at;
                    $user->$key = $value;
                }
            }

            if ($user->save()) {
                return $user;
            }
            return null;
        }
    }

    public function deleteData($id)
    {
        $user = Users::find()->where(['u_id' => $id])->one();
        if (!is_null($user)) {
            return $user->delete();
        }
        return null;
    }

    public function findListIDs()
    {
        $identity = UsersBodyInfo::find()
            ->orderBy(['u_id' => SORT_ASC])
            ->all();
        $combArr = [];

        if (is_null($identity)) {
            return null;
        } else {

            foreach ($identity as $user) {
                $u_id = $user['u_id'];
                $ubi_id = $user['ubi_id'];

                $t1 =  Users::find()
                    ->where(['u_id' => $u_id])
                    ->one();

                if (!is_null($t1)) {
                    $combArr[] = [
                        "line_id" => $t1->line_id . "[" . $ubi_id . "]",
                        "ubi_id" => $ubi_id,
                        "u_id" => $u_id
                    ];
                }
            }

            return $combArr;
        }
        return null;
    }

    public function findListIDsByToken($token)
    {
        $identity = Users::find()
            ->where(['access_token' => $token])
            ->one();
        $idLists = [];

        if (is_null($identity)) {
            return null;
        } else {

            $u_id = $identity->u_id;

            $usersBodyInfo =  UsersBodyInfo::find()
                ->where(['u_id' => $u_id])
                ->all();

            if (!is_null($usersBodyInfo)) {

                foreach ($usersBodyInfo as $user) {
                    $idLists[] = [
                        "line_id_with_ubi_id" => $identity->line_id . " - [" . $user['ubi_id'] . "]",
                        "ubi_id" => $user['ubi_id'],
                    ];
                }

                foreach ($idLists as $key => $value) {
                    $ubi_id = $value['ubi_id'];

                    $t1 = UsersBodyInfo::findOne(['ubi_id' => $ubi_id]);
                    $t2 = ShoesBasicInfo::findOne(['ubi_id' => $ubi_id]);
                    $t3 = ShoesAdvanceInfo::findOne(['ubi_id' => $ubi_id]);
                    $t4 = MedicalHistory::find()->where(['ubi_id' => $ubi_id])->all();
                    $t5 = MusclesJointsMeasurement::findOne(['ubi_id' => $ubi_id]);
                    $t6 = FunctionalMeasurement::findOne(['ubi_id' => $ubi_id]);
                    $t7 = PsychologicalSkillScale::findOne(['ubi_id' => $ubi_id]);
                    $t8 = UsersInvestigation::findOne(['ubi_id' => $ubi_id]);

                    if (
                        !is_null($t1) && !is_null($t2) && !is_null($t3) && !is_null($t4)
                        && !is_null($t5) && !is_null($t6) && !is_null($t7) && !is_null($t8)
                    ) {
                        foreach ($t4 as $value) {
                            $mh_id = $value['mh_id'];
                            $idLists[$key]['mh_id'][] = $mh_id;
                        }
                    } else {
                        unset($idLists[$key]);
                    }
                }
                return array_values($idLists);
            }
        }
        return null;
    }

    public function findAllRecordsById($id)
    {

        $identity = UsersBodyInfo::findOne(['ubi_id' => $id]);

        if (is_null($identity)) {
            return null;
        } else {
            $u_id = $identity->u_id;
            $t1 = Users::findOne(['u_id' => $u_id]);

            if (is_null($t1)) {
                return null;
            } else {
                $ubi_id = $identity->ubi_id;
                $t2 = ShoesBasicInfo::findOne(['ubi_id' => $ubi_id]);
                $t3 = ShoesAdvanceInfo::findOne(['ubi_id' => $ubi_id]);
                $t4 = MedicalHistory::find()->where(['ubi_id' => $ubi_id])->all();
                $t5 = MusclesJointsMeasurement::findOne(['ubi_id' => $ubi_id]);
                $t6 = FunctionalMeasurement::findOne(['ubi_id' => $ubi_id]);
                $t7 = PsychologicalSkillScale::findOne(['ubi_id' => $ubi_id]);
                $t8 = UsersInvestigation::findOne(['ubi_id' => $ubi_id]);

                return [
                    "user" => [
                        "name" => $t1->name,
                        "contact_no" => $t1->contact_no,
                    ],
                    "user_body" => $identity,
                    "basic_shoes" => is_null($t2) ? "" : $t2,
                    "adv_shoes" => is_null($t3) ? "" : $t3,
                    "medical" => is_null($t4) ? "" : $t4,
                    "muscles" => is_null($t5) ? "" : $t5,
                    "functional" => is_null($t6) ? "" : $t6,
                    "psycho" => is_null($t7) ? "" : $t7,
                    "extra" => is_null($t8) ? "" : $t8,
                ];
            }
        }
        return null;
    }

    public function generateAccessToken($params)
    {
        $u_id = $params['u_id'];
        $name = $params['name'];
        $line_id = $params['line_id'];

        $signer = new \Lcobucci\JWT\Signer\Hmac\Sha256();
        /** @var Jwt $jwt */
        $jwt = Yii::$app->jwt;
        $token = $jwt->getBuilder()
            ->setIssuer('http://www.mypidea.com') // Configures the issuer (iss claim)
            ->setAudience('http://www.mypidea.org') // Configures the audience (aud claim)
            ->setId('3m5y7p9i5d6e3a9', true) // Configures the id (jti claim), replicating as a header item
            ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
            ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
            ->set('u_id', $u_id) // Configures a new claim, called "uid"
            ->set('name', $name) // Configures a new claim, called "name"
            ->set('line_id', $line_id) // Configures a new claim, called "line_id"
            ->sign($signer, $jwt->key) // creates a signature using [[Jwt::$key]]
            ->getToken(); // Retrieves the generated token

        return (string) $token;
    }

    public function currentTimeMillis()
    {
        list($usec, $sec) = explode(" ", microtime());
        return round(((float) $usec + (float) $sec) * 1000);
    }
}
