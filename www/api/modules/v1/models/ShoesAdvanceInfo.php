<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "shoes_advance_info".
 *
 * @property int $sai_id 流水號
 * @property int $u_id 個案編號
 * @property string $created_at 建立日期
 * @property string $updated_at 更新日期
 * @property string $results_area1 以逗點區隔之1~5分量表數值[0,0,0,0,0,0...]
 * @property string $results_area2 以逗點區隔之1~5分量表數值[0,0,0,0,0,0...]
 * @property string $results_area3 以逗點區隔之1~5分量表數值[0,0,0,0,0,0...]
 * @property string $results_area4 以逗點區隔之1~5分量表數值[0,0,0,0,0,0...]
 *
 * @property Users $u
 */
class ShoesAdvanceInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shoes_advance_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ubi_id'], 'required'],
            [['ubi_id'], 'integer'],
            [['created_at', 'updated_at'], 'string', 'max' => 20],
            [['results_area1', 'results_area2', 'results_area3', 'results_area4'], 'string', 'max' => 150],
            [['ubi_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersBodyInfo::className(), 'targetAttribute' => ['ubi_id' => 'ubi_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sai_id' => 'Sai ID',
            'u_id' => 'U ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'results_area1' => 'Results Area1',
            'results_area2' => 'Results Area2',
            'results_area3' => 'Results Area3',
            'results_area4' => 'Results Area4',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findAllRecordsJoinWithParams($users)
    {
        $attributes = [];

        foreach ($users as $value) {
            $ubi_id = $value['ubi_id'];
            $attributes['ubi_id'][] = $ubi_id;
        }

        return ShoesAdvanceInfo::find()
            ->where($attributes)
            ->all();
    }

    public static function findOneRecord($id)
    {
        return ShoesAdvanceInfo::find()
            ->where(['ubi_id' => $id])
            ->one();
    }

    public function createData($ubi_id, $params)
    {
        $attributes['ubi_id'] = $ubi_id;
        $attributes['created_at'] = (string) self::currentTimeMillis();
        $attributes['updated_at'] = (string) self::currentTimeMillis();

        foreach ($params as $key => $value) {
            $attributes[$key] = $value;
        }

        $shoesAdvanceInfo = new ShoesAdvanceInfo;
        $shoesAdvanceInfo->attributes = $attributes;

        if ($shoesAdvanceInfo->save()) {
            return $shoesAdvanceInfo;
        }
        return null;
    }

    public function updateData($ubi_id, $params)
    {
        $shoesAdvanceInfo = ShoesAdvanceInfo::findOne(['ubi_id' => $ubi_id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($shoesAdvanceInfo)) {
            return null;
        } else {
            foreach ($params as $key => $value) {
                if (array_key_exists($key, self::attributeLabels()) && $value != $shoesAdvanceInfo->$key) {
                    $shoesAdvanceInfo->updated_at = $updated_at;
                    $shoesAdvanceInfo[$key] = $value;
                }
            }

            if ($shoesAdvanceInfo->save()) {
                return $shoesAdvanceInfo;
            }
            return null;
        }
    }

    public function deleteData($id)
    {
        $ShoesAdvanceInfo = ShoesAdvanceInfo::find()->where(['ubi_id' => $id])->one();

        if (!is_null($ShoesAdvanceInfo)) {
            return $ShoesAdvanceInfo->delete();
        }
        return null;
    }

    public function currentTimeMillis()
    {
        list($usec, $sec) = explode(" ", microtime());
        return round(((float) $usec + (float) $sec) * 1000);
    }
}
