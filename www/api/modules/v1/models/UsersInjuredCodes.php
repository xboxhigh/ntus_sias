<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "users_injured_codes".
 *
 * @property int $uic_id
 * @property string $code
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class UsersInjuredCodes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_injured_codes';
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
            'uic_id' => 'Uic ID',
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
        return UsersInjuredCodes::find()->all();
    }

    public static function findOneRecord($id)
    {
        return UsersInjuredCodes::find()
            ->where(['uic_id' => $id])
            ->one();
    }

    public function createData($params)
    {
        $attributes['created_at'] = (string) self::currentTimeMillis();
        $attributes['updated_at'] = (string) self::currentTimeMillis();

        foreach ($params as $key => $value) {
            $attributes[$key] = $value;
        }

        $usersInjuredCodes = new UsersInjuredCodes;
        $usersInjuredCodes->attributes = $attributes;

        if ($usersInjuredCodes->save()) {
            $usersInjuredCodes->code = (string) $usersInjuredCodes->uic_id;
            $usersInjuredCodes->save();
            return $usersInjuredCodes;
        }
        return null;
    }

    public function updateData($id, $params)
    {
        $usersInjuredCodes = UsersInjuredCodes::findOne(['uic_id' => $id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($usersInjuredCodes)) {
            return 'NO_RECORD';
        } else {
            foreach ($params as $key => $value) {
                if (isset($usersInjuredCodes->$key) && $value !== $usersInjuredCodes->$key) {
                    $usersInjuredCodes->updated_at = $updated_at;
                    $usersInjuredCodes->$key = $value;
                }
            }
            if ($usersInjuredCodes->save()) {
                return $usersInjuredCodes;
            }
        }
    }

    public function deleteData($id)
    {
        $usersInjuredCodes = UsersInjuredCodes::find()->where(['uic_id' => $id])->one();

        if (!is_null($usersInjuredCodes)) {
            return $usersInjuredCodes->delete();
        }
        return null;
    }

    public function currentTimeMillis()
    {
        list($usec, $sec) = explode(" ", microtime());
        return round(((float) $usec + (float) $sec) * 1000);
    }
}
