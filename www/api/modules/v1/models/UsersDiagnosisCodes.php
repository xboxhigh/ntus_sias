<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "users_diagnosis_codes".
 *
 * @property int $udc_id
 * @property string $code
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class UsersDiagnosisCodes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_diagnosis_codes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'string', 'max' => 4],
            [['name'], 'string', 'max' => 50],
            [['created_at', 'updated_at'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'udc_id' => 'Udc ID',
            'code' => 'Code',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findAllRecords()
    {
        return UsersDiagnosisCodes::find()->all();
    }

    public static function findOneRecord($id)
    {
        return UsersDiagnosisCodes::find()
            ->where(['udc_id' => $id])
            ->one();
    }

    public function createData($params)
    {
        $attributes['created_at'] = (string) self::currentTimeMillis();
        $attributes['updated_at'] = (string) self::currentTimeMillis();

        foreach ($params as $key => $value) {
            $attributes[$key] = $value;
        }

        $usersDiagnosisCodes = new UsersDiagnosisCodes;
        $usersDiagnosisCodes->attributes = $attributes;

        if ($usersDiagnosisCodes->save()) {
            $usersDiagnosisCodes->code = (string) $usersDiagnosisCodes->udc_id;
            $usersDiagnosisCodes->save();
            return $usersDiagnosisCodes;
        }
        return null;
    }

    public function updateData($id, $params)
    {
        $usersDiagnosisCodes = UsersDiagnosisCodes::findOne(['udc_id' => $id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($usersDiagnosisCodes)) {
            return 'NO_RECORD';
        } else {
            foreach ($params as $key => $value) {
                if (isset($usersDiagnosisCodes->$key) && $value !== $usersDiagnosisCodes->$key) {
                    $usersDiagnosisCodes->updated_at = $updated_at;
                    $usersDiagnosisCodes->$key = $value;
                }
            }
            if ($usersDiagnosisCodes->save()) {
                return $usersDiagnosisCodes;
            }
        }
    }

    public function deleteData($id)
    {
        $usersDiagnosisCodes = UsersDiagnosisCodes::find()->where(['udc_id' => $id])->one();

        if (!is_null($usersDiagnosisCodes)) {
            return $usersDiagnosisCodes->delete();
        }
        return null;
    }

    public function currentTimeMillis()
    {
        list($usec, $sec) = explode(" ", microtime());
        return round(((float) $usec + (float) $sec) * 1000);
    }
}
