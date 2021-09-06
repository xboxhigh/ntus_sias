<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "users_body_info".
 *
 * @property int $ubi_id 流水號
 * @property int $u_id 個案編號
 * @property string $created_at 建立日期
 * @property string $updated_at 更新日期
 * @property int $gender 個案性別[1=男;2=女]
 * @property string $day_of_birth 個案出生日
 * @property string $height 個案身高
 * @property string $weight 個案體重
 * @property int $img_shldrlvl 是否已拍攝肩高[0=未完成;1=完成]
 * @property string $bmi 個案身體質量指數
 * @property string $bfp 體脂肪百分比
 * @property string $muscle 肌肉百分比
 * @property string $bone 骨頭質量
 * @property string $vfp 內臟脂肪百分比
 * @property string $bmr 基礎代謝率
 * @property string $body_water 體內水分百分比
 * @property string $rt_len 右大腿長
 * @property string $lt_len 左大腿長
 * @property string $rc_len 右小腿長
 * @property string $lc_len 左小腿長
 * @property string $rl_len 右腿長
 * @property string $ll_len 左腿長
 * @property string $rua_len 右上臂長
 * @property string $lua_len 左上臂長
 * @property string $rfa_len 右前臂長
 * @property string $lfa_len 左前臂長
 * @property string $rpmr_len 右手掌長
 * @property string $lpmr_len 左手掌長
 * @property string $rcvc_len 右鎖骨長
 * @property string $lcvc_len 左鎖骨長
 * @property string $trunk_len 軀幹高
 * @property string $rae_5cm 右肘關節上5公分
 * @property string $lae_5cm 左肘關節上5公分
 * @property string $rbe_5cm 右肘關節下5公分
 * @property string $lbe_5cm 左肘關節下5公分
 * @property string $rak_5cm 右膝關節上5公分
 * @property string $lak_5cm 右肘關節上5公分
 * @property string $rbk_5cm 右肘關節上5公分
 * @property string $lbk_5cm 右肘關節上5公分
 */
class UsersBodyInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_body_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['img_shldrlvl'], 'boolean'],
            [['u_id', 'gender'], 'integer'],
            [['height', 'weight', 'bmi', 'bfp', 'muscle', 'bone', 'vfp', 'bmr', 'body_water', 'rt_len', 'lt_len', 'rc_len', 'lc_len', 'rl_len', 'll_len', 'rua_len', 'lua_len', 'rfa_len', 'lfa_len', 'rpmr_len', 'lpmr_len', 'rcvc_len', 'lcvc_len', 'trunk_len', 'rae_5cm', 'lae_5cm', 'rbe_5cm', 'lbe_5cm', 'rak_5cm', 'lak_5cm', 'rbk_5cm', 'lbk_5cm'], 'number'],
            [['created_at', 'updated_at', 'day_of_birth'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ubi_id' => 'Ubi ID',
            'u_id' => 'Ub ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'gender' => 'Gender',
            'day_of_birth' => 'Day Of Birth',
            'height' => 'Height',
            'weight' => 'Weight',
            'img_shldrlvl' => 'Img Shldrlvl',
            'bmi' => 'Bmi',
            'bfp' => 'Bfp',
            'muscle' => 'Muscle',
            'bone' => 'Bone',
            'vfp' => 'Vfp',
            'bmr' => 'Bmr',
            'body_water' => 'Body Water',
            'rt_len' => 'Rt Len',
            'lt_len' => 'Lt Len',
            'rc_len' => 'Rc Len',
            'lc_len' => 'Lc Len',
            'rl_len' => 'Rl Len',
            'll_len' => 'Ll Len',
            'rua_len' => 'Rua Len',
            'lua_len' => 'Lia Len',
            'rfa_len' => 'Rfa Len',
            'lfa_len' => 'Lfa Len',
            'rpmr_len' => 'Bpmr Len',
            'lpmr_len' => 'Lpmr Len',
            'rcvc_len' => 'Rcvc Len',
            'lcvc_len' => 'Lcvc Len',
            'trunk_len' => 'Trunk Len',
            'rae_5cm' => 'Rae 5cm',
            'lae_5cm' => 'Lae 5cm',
            'rbe_5cm' => 'Rbe 5cm',
            'lbe_5cm' => 'Lbe 5cm',
            'rak_5cm' => 'Ral 5cm',
            'lak_5cm' => 'Lak 5cm',
            'rbk_5cm' => 'Rbk 5cm',
            'lbk_5cm' => 'Lbk 5cm',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findAllRecords()
    {
        return UsersBodyInfo::find()
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return UsersBodyInfo::find()
            ->where(['ubi_id' => $id])
            ->one();
    }

    /**
     * {@inheritdoc}
     */
    public static function findAllRecordsJoinWithParams($users)
    {
        $usersBody = UsersBodyInfo::find()->all();
        $usersExtraData = [];
        $result = [];

        if ($usersBody) {
            foreach ($usersBody as $_usersBody) {
                $usersExtraData[$_usersBody['u_id']] = $_usersBody;
            }

            foreach ($users as $_users) {
                $u_id = $_users['u_id'];

                if (key_exists($u_id, $usersExtraData)) {
                    $tmpArr = [];
                    foreach ($_users as $key => $value) {
                        $tmpArr[$key] = $value;
                    }

                    // append users extra data
                    foreach ($usersExtraData[$u_id] as $key => $value) {
                        $tmpArr[$key] = $value;
                    }

                    unset($tmpArr['access_token']);
                    $result[] = $tmpArr;
                }
            }

            return $result;
        } else {
            return null;
        }
    }
    /**
     * {@inheritdoc}
     */
    public static function findOneRecordsJoinWithParams($id, $params)
    {
        $u_id = $params['u_id'];

        $usersBody = UsersBodyInfo::find()
            ->where(['ubi_id' => $id])
            ->one();

        $result = [];

        if ($usersBody) {

            foreach ($usersBody as $key => $value) {
                $result[$key] = $value;
            }

            foreach ($params as $key => $value) {
                if ($key != "created_at" && $key != "updated_at") {
                    $result[$key] = $value;
                }
                unset($result['access_token']);
            }

            return $result;
        } else {
            return null;
        }
    }

    public function createData($u_id, $params)
    {
        $attributes['u_id'] = $u_id;
        $attributes['created_at'] = (string) self::currentTimeMillis();
        $attributes['updated_at'] = (string) self::currentTimeMillis();

        foreach ($params as $key => $value) {
            if ($key != "name" && $key != "line_id" && $key != "contact_no")
                $attributes[$key] = $value;
        }
        $usersBody = new UsersBodyInfo;
        $usersBody->attributes = $attributes;

        if ($usersBody->save()) {
            return $usersBody;
        }
        return null;
    }

    public function updateData($id, $params)
    {
        $usersBody = UsersBodyInfo::findOne(['ubi_id' => $id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($usersBody)) {
            return null;
        } else {
            foreach ($params as $key => $value) {
                if (array_key_exists($key, self::attributeLabels()) && $value != $usersBody->$key) {
                    $usersBody->updated_at = $updated_at;
                    $usersBody->$key = $params[$key];
                }
            }

            if ($usersBody->save()) {
                return $usersBody;
            }
        }
    }

    public function deleteData($id)
    {
        $user = UsersBodyInfo::find()->where(['ubi_id' => $id])->one();
        if (!is_null($user)) {
            return $user->delete();
        }
        return null;
    }

    public function currentTimeMillis()
    {
        list($usec, $sec) = explode(" ", microtime());
        return round(((float) $usec + (float) $sec) * 1000);
    }
}
