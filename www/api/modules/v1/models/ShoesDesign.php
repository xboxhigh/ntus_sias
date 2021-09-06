<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "shoes_design".
 *
 * @property int $sd_id
 * @property string $code
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class ShoesDesign extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shoes_design';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'string', 'max' => 2],
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
            'sd_id' => 'Sd ID',
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
        return ShoesDesign::find()
            ->select(['sd_id', 'code', 'name'])
            ->orderBy(['sd_id' => SORT_ASC])
            ->all();
    }

    public static function findOneRecord($id)
    {
        return ShoesDesign::find()
            ->where(['sd_id' => $id])
            ->one();
    }

    public function createData($params)
    {
        $attributes['created_at'] = (string) self::currentTimeMillis();
        $attributes['updated_at'] = (string) self::currentTimeMillis();

        foreach ($params as $key => $value) {
            $attributes[$key] = $value;
        }

        $shoesDesign = new ShoesDesign;
        $shoesDesign->attributes = $attributes;

        if ($shoesDesign->save()) {
            $shoesDesign->code = (string) $shoesDesign->sd_id;
            $shoesDesign->save();
            return $shoesDesign;
        }
        return null;
    }

    public function updateData($id, $params)
    {
        $shoesDesign = ShoesDesign::findOne(['sd_id' => $id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($shoesDesign)) {
            return 'NO_RECORD';
        } else {
            foreach ($params as $key => $value) {
                if (isset($shoesDesign->$key) && $value !== $shoesDesign->$key) {
                    $shoesDesign->updated_at = $updated_at;
                    $shoesDesign->$key = $value;
                }
            }
            if ($shoesDesign->save()) {
                return $shoesDesign;
            }
        }
    }

    public function deleteData($id)
    {
        $shoesDesign = ShoesDesign::find()->where(['sd_id' => $id])->one();

        if (!is_null($shoesDesign)) {
            return $shoesDesign->delete();
        }
        return null;
    }

    public function currentTimeMillis()
    {
        list($usec, $sec) = explode(" ", microtime());
        return round(((float) $usec + (float) $sec) * 1000);
    }
}
