<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "shoes_brand".
 *
 * @property int $sb_id
 * @property string $code
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class ShoesBrand extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shoes_brand';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 100],
            [['created_at', 'updated_at'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sb_id' => 'Sb ID',
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
        return ShoesBrand::find()
            ->select(['sb_id', 'code', 'name'])
            ->orderBy(['sb_id' => SORT_ASC])
            ->all();
    }

    public static function findOneRecord($id)
    {
        return ShoesBrand::find()
            ->where(['sb_id' => $id])
            ->one();
    }

    public function createData($params)
    {
        $attributes['created_at'] = (string) self::currentTimeMillis();
        $attributes['updated_at'] = (string) self::currentTimeMillis();

        foreach ($params as $key => $value) {
            $attributes[$key] = $value;
        }

        $shoesBrand = new ShoesBrand;
        $shoesBrand->attributes = $attributes;

        if ($shoesBrand->save()) {
            $shoesBrand->code = (string) $shoesBrand->sb_id;
            $shoesBrand->save();
            return $shoesBrand;
        }
        return null;
    }

    public function updateData($id, $params)
    {
        $shoesBrand = ShoesBrand::findOne(['sb_id' => $id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($shoesBrand)) {
            return 'NO_RECORD';
        } else {
            foreach ($params as $key => $value) {
                if (isset($shoesBrand->$key) && $value !== $shoesBrand->$key) {
                    $shoesBrand->updated_at = $updated_at;
                    $shoesBrand->$key = $value;
                }
            }
            if ($shoesBrand->save()) {
                return $shoesBrand;
            }
        }
    }

    public function deleteData($id)
    {
        $shoesBrand = ShoesBrand::find()->where(['sb_id' => $id])->one();

        if (!is_null($shoesBrand)) {
            return $shoesBrand->delete();
        }
        return null;
    }

    public function currentTimeMillis()
    {
        list($usec, $sec) = explode(" ", microtime());
        return round(((float) $usec + (float) $sec) * 1000);
    }
}
