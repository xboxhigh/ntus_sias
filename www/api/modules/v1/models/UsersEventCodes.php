<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "users_event_codes".
 *
 * @property int $uec_id
 * @property string $code
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class UsersEventCodes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_event_codes';
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
            'uec_id' => 'Uec ID',
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
        return UsersEventCodes::find()->all();
    }

    public static function findOneRecord($id)
    {
        return UsersEventCodes::find()
            ->where(['uec_id' => $id])
            ->one();
    }

    public function createData($params)
    {
        $attributes['created_at'] = (string) self::currentTimeMillis();
        $attributes['updated_at'] = (string) self::currentTimeMillis();

        foreach ($params as $key => $value) {
            $attributes[$key] = $value;
        }

        $usersEventCodes = new UsersDiagnosisCodes;
        $usersEventCodes->attributes = $attributes;

        if ($usersEventCodes->save()) {
            $usersEventCodes->code = (string) $usersEventCodes->uec_id;
            $usersEventCodes->save();
            return $usersEventCodes;
        }
        return null;
    }

    public function updateData($id, $params)
    {
        $usersEventCodes = UsersEventCodes::findOne(['uec_id' => $id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($usersEventCodes)) {
            return 'NO_RECORD';
        } else {
            foreach ($params as $key => $value) {
                if (isset($usersEventCodes->$key) && $value !== $usersEventCodes->$key) {
                    $usersEventCodes->updated_at = $updated_at;
                    $usersEventCodes->$key = $value;
                }
            }
            if ($usersEventCodes->save()) {
                return $usersEventCodes;
            }
        }
    }

    public function deleteData($id)
    {
        $usersEventCodes = UsersEventCodes::find()->where(['uec_id' => $id])->one();

        if (!is_null($usersEventCodes)) {
            return $usersEventCodes->delete();
        }
        return null;
    }

    public function currentTimeMillis()
    {
        list($usec, $sec) = explode(" ", microtime());
        return round(((float) $usec + (float) $sec) * 1000);
    }
}
