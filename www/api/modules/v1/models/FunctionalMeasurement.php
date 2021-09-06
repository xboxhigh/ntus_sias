<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "functional_measurement".
 *
 * @property int $fm_id 流水號
 * @property int $ubi_id 個案編號
 * @property string $created_at 建立日期
 * @property string $updated_at 更新日期
 * @property int $dominant 慣用手/腳[1=右；2=左]
 * @property int $squat_1 深蹲_第一次[0=疼痛；1，2，3]
 * @property int $squat_2 深蹲_第二次[0=疼痛；1，2，3]
 * @property int $squat_3 深蹲_第三次[0=疼痛；1，2，3]
 * @property int $squat 深蹲_最後分數[0=疼痛；1，2，3]
 * @property int $hurdle_l_1 跨欄_左_第一次[0=疼痛；1，2，3]
 * @property int $hurdle_l_2 跨欄_左_第二次[0=疼痛；1，2，3]
 * @property int $hurdle_l_3 跨欄_左_第三次[0=疼痛；1，2，3]
 * @property int $hurdle_r_1 跨欄_右_第一次[0=疼痛；1，2，3]
 * @property int $hurdle_r_2 跨欄_右_第二次[0=疼痛；1，2，3]
 * @property int $hurdle_r_3 跨欄_右_第三次[0=疼痛；1，2，3]
 * @property int $hurdle 跨欄_最後分數[0=疼痛；1，2，3]
 * @property int $lunge_l_1 直線弓箭步_左_第一次[0=疼痛；1，2，3]
 * @property int $lunge_l_2 直線弓箭步_左_第二次[0=疼痛；1，2，3]
 * @property int $lunge_l_3 直線弓箭步_左_第三次[0=疼痛；1，2，3]
 * @property int $lunge_r_1 直線弓箭步_右_第一次[0=疼痛；1，2，3]
 * @property int $lunge_r_2 直線弓箭步_右_第二次[0=疼痛；1，2，3]
 * @property int $lunge_r_3 直線弓箭步_右_第三次[0=疼痛；1，2，3]
 * @property int $lunge 直線弓箭步_最後分數[0=疼痛；1，2，3]
 * @property int $mobility_l_1 肩關節活動度_左_第一次[0=疼痛；1，2，3]
 * @property int $mobility_l_2 肩關節活動度_左_第二次[0=疼痛；1，2，3]
 * @property int $mobility_l_3 肩關節活動度_左_第三次[0=疼痛；1，2，3]
 * @property int $mobility_r_1 肩關節活動度_右_第一次[0=疼痛；1，2，3]
 * @property int $mobility_r_2 肩關節活動度_右_第二次[0=疼痛；1，2，3]
 * @property int $mobility_r_3 肩關節活動度_右_第三次[0=疼痛；1，2，3]
 * @property int $mobility 肩關節活動度_最後分數[0=疼痛；1，2，3]
 * @property int $slr_l_1 單腿打直高抬_左_第一次[0=疼痛；1，2，3]
 * @property int $slr_l_2 單腿打直高抬_左_第二次[0=疼痛；1，2，3]
 * @property int $slr_l_3 單腿打直高抬_左_第三次[0=疼痛；1，2，3]
 * @property int $slr_r_1 單腿打直高抬_右_第一次[0=疼痛；1，2，3]
 * @property int $slr_r_2 單腿打直高抬_右_第二次[0=疼痛；1，2，3]
 * @property int $slr_r_3 單腿打直高抬_右_第三次[0=疼痛；1，2，3]
 * @property int $slr 單腿打直高抬_最後分數[0=疼痛；1，2，3]
 * @property int $pushup_1 俯臥撐地-軀幹穩定度_第一次[0=疼痛；1，2，3]
 * @property int $pushup_2 俯臥撐地-軀幹穩定度_第二次[0=疼痛；1，2，3]
 * @property int $pushup_3 俯臥撐地-軀幹穩定度_第三次[0=疼痛；1，2，3]
 * @property int $pushup 俯臥撐地-軀幹穩定度_最後分數[0=疼痛；1，2，3]
 * @property int $stability_l_1 核心旋轉穩定度_左_第一次[0=疼痛；1，2，3]
 * @property int $stability_l_2 核心旋轉穩定度_左_第二次[0=疼痛；1，2，3]
 * @property int $stability_l_3 核心旋轉穩定度_左_第三次[0=疼痛；1，2，3]
 * @property int $stability_r_1 核心旋轉穩定度_右_第一次[0=疼痛；1，2，3]
 * @property int $stability_r_2 核心旋轉穩定度_右_第二次[0=疼痛；1，2，3]
 * @property int $stability_r_3 核心旋轉穩定度_右_第三次[0=疼痛；1，2，3]
 * @property int $stability 核心旋轉穩定度_最後分數[0=疼痛；1，2，3]
 * @property int $fms_total fms_總分[總分=21，<14高運動傷害風險]
 *
 * @property Users $u
 */
class FunctionalMeasurement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'functional_measurement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ubi_id'], 'required'],
            [['ubi_id', 'dominant', 'squat_1', 'squat_2', 'squat_3', 'squat', 'hurdle_l_1', 'hurdle_l_2', 'hurdle_l_3', 'hurdle_r_1', 'hurdle_r_2', 'hurdle_r_3', 'hurdle', 'lunge_l_1', 'lunge_l_2', 'lunge_l_3', 'lunge_r_1', 'lunge_r_2', 'lunge_r_3', 'lunge', 'mobility_l_1', 'mobility_l_2', 'mobility_l_3', 'mobility_r_1', 'mobility_r_2', 'mobility_r_3', 'mobility', 'slr_l_1', 'slr_l_2', 'slr_l_3', 'slr_r_1', 'slr_r_2', 'slr_r_3', 'slr', 'pushup_1', 'pushup_2', 'pushup_3', 'pushup', 'stability_l_1', 'stability_l_2', 'stability_l_3', 'stability_r_1', 'stability_r_2', 'stability_r_3', 'stability', 'fms_total'], 'integer'],
            [['created_at', 'updated_at'], 'string', 'max' => 20],
            [['ubi_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersBodyInfo::className(), 'targetAttribute' => ['ubi_id' => 'ubi_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fm_id' => 'Fm ID',
            'ubi_id' => 'U ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'dominant' => 'Dominant',
            'squat_1' => 'Squat 1',
            'squat_2' => 'Squat 2',
            'squat_3' => 'Squat 3',
            'squat' => 'Squat',
            'hurdle_l_1' => 'Hurdle L 1',
            'hurdle_l_2' => 'Hurdle L 2',
            'hurdle_l_3' => 'Hurdle L 3',
            'hurdle_r_1' => 'Hurdle R 1',
            'hurdle_r_2' => 'Hurdle R 2',
            'hurdle_r_3' => 'Hurdle R 3',
            'hurdle' => 'Hurdle',
            'lunge_l_1' => 'Lunge L 1',
            'lunge_l_2' => 'Lunge L 2',
            'lunge_l_3' => 'Lunge L 3',
            'lunge_r_1' => 'Lunge R 1',
            'lunge_r_2' => 'Lunge R 2',
            'lunge_r_3' => 'Lunge R 3',
            'lunge' => 'Lunge',
            'mobility_l_1' => 'Mobility L 1',
            'mobility_l_2' => 'Mobility L 2',
            'mobility_l_3' => 'Mobility L 3',
            'mobility_r_1' => 'Mobility R 1',
            'mobility_r_2' => 'Mobility R 2',
            'mobility_r_3' => 'Mobility R 3',
            'mobility' => 'Mobility',
            'slr_l_1' => 'Slr L 1',
            'slr_l_2' => 'Slr L 2',
            'slr_l_3' => 'Slr L 3',
            'slr_r_1' => 'Slr R 1',
            'slr_r_2' => 'Slr R 2',
            'slr_r_3' => 'Slr R 3',
            'slr' => 'Slr',
            'pushup_1' => 'Pushup 1',
            'pushup_2' => 'Pushup 2',
            'pushup_3' => 'Pushup 3',
            'pushup' => 'Pushup',
            'stability_l_1' => 'Stability L 1',
            'stability_l_2' => 'Stability L 2',
            'stability_l_3' => 'Stability L 3',
            'stability_r_1' => 'Stability R 1',
            'stability_r_2' => 'Stability R 2',
            'stability_r_3' => 'Stability R 3',
            'stability' => 'Stability',
            'fms_total' => 'Fms Total',
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

        return FunctionalMeasurement::find()
            ->where($attributes)
            ->all();
    }

    public static function findOneRecord($id)
    {
        return FunctionalMeasurement::find()
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

        $functionalMeasurement = new FunctionalMeasurement;
        $functionalMeasurement->attributes = $attributes;

        if ($functionalMeasurement->save()) {
            return $functionalMeasurement;
        }
        return null;
    }

    public function updateData($id, $params)
    {
        $functionalMeasurement = FunctionalMeasurement::findOne(['ubi_id' => $id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($functionalMeasurement)) {
            return $functionalMeasurement;
        } else {
            foreach ($params as $key => $value) {
                if (array_key_exists($key, self::attributeLabels()) && $value != $functionalMeasurement->$key) {
                    $functionalMeasurement->updated_at = $updated_at;
                    $functionalMeasurement->$key = $value;
                }
            }
            if ($functionalMeasurement->save()) {
                return $functionalMeasurement;
            }
            return null;
        }
    }

    public function deleteData($id)
    {
        $functionalMeasurement = FunctionalMeasurement::find()->where(['ubi_id' => $id])->one();

        if (!is_null($functionalMeasurement)) {
            return $functionalMeasurement->delete();
        }
        return null;
    }

    public function currentTimeMillis()
    {
        list($usec, $sec) = explode(" ", microtime());
        return round(((float) $usec + (float) $sec) * 1000);
    }
}
