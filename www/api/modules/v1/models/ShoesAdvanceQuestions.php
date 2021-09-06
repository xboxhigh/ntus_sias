<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "shoes_advance_questions".
 *
 * @property int $saq_id 流水號
 * @property string $created_at 建立日期
 * @property string $updated_at 更新日期
 * @property string $name 題目名稱
 * @property int $field 題目領域代碼
 */
class ShoesAdvanceQuestions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shoes_advance_questions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['field'], 'integer'],
            [['created_at', 'updated_at'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'saq_id' => 'Saq ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'name' => 'Name',
            'field' => 'Field',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findAllRecords()
    {
        return ShoesAdvanceQuestions::find()->all();
    }

    public static function findOneRecord($id)
    {
        return ShoesAdvanceQuestions::find()
            ->where(['saq_id' => $id])
            ->one();
    }

    public function createData($params)
    {
        $attributes['created_at'] = (string) self::currentTimeMillis();
        $attributes['updated_at'] = (string) self::currentTimeMillis();

        foreach ($params as $key => $value) {
            $attributes[$key] = $value;
        }

        $shoesAdvanceQuestions = new ShoesAdvanceQuestions;
        $shoesAdvanceQuestions->attributes = $attributes;

        if ($shoesAdvanceQuestions->save()) {
            $shoesAdvanceQuestions->code = (string) $shoesAdvanceQuestions->saq_id;
            $shoesAdvanceQuestions->save();
            return $shoesAdvanceQuestions;
        }
        return null;
    }

    public function updateData($id, $params)
    {
        $shoesAdvanceQuestions = ShoesAdvanceQuestions::findOne(['saq_id' => $id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($shoesAdvanceQuestions)) {
            return 'NO_RECORD';
        } else {
            foreach ($params as $key => $value) {
                if (isset($shoesAdvanceQuestions->$key) && $value !== $shoesAdvanceQuestions->$key) {
                    $shoesAdvanceQuestions->updated_at = $updated_at;
                    $shoesAdvanceQuestions->$key = $value;
                }
            }
            if ($shoesAdvanceQuestions->save()) {
                return $shoesAdvanceQuestions;
            }
        }
    }

    public function deleteData($id)
    {
        $shoesAdvanceQuestions = ShoesAdvanceQuestions::find()->where(['saq_id' => $id])->one();

        if (!is_null($shoesAdvanceQuestions)) {
            return $shoesAdvanceQuestions->delete();
        }
        return null;
    }

    public function currentTimeMillis()
    {
        list($usec, $sec) = explode(" ", microtime());
        return round(((float) $usec + (float) $sec) * 1000);
    }
}
