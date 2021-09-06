<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "medical_history".
 *
 * @property int $mh_id 流水號
 * @property int $ubi_id 個案編號
 * @property string $created_at 建立日期
 * @property string $updated_at 更新日期
 * @property int $at_plan_1 運動按摩[0=無;1=有]
 * @property int $at_plan_2 拉筋[0=無;1=有]
 * @property int $at_plan_3 冷熱敷[0=無;1=有]
 * @property string $at_plan_4 衛教[0=無;1=有]
 * @property int $at_plan_5 貼紮防護[0=無;1=有]
 * @property int $at_plan_6 建議轉介醫院或診所[0=無;1=有]
 * @property int $at_plan_7 無[0=無;1=有]
 * @property int $at_plan_8 其它[0=無;1=有]
 * @property string $at_plan_other 運動防護人員其它處置狀況
 * @property int $treatment_1 醫院或診所接受復健或其它保守治療介入[0=無;1=有]
 * @property int $treatment_2 國術館或民俗療法[0=無;1=有]
 * @property int $treatment_3 無接受任何方式處理[0=無;1=有]
 * @property int $treatment_4 手術治療[0=無;1=有]
 * @property int $treatment_5 其它[0=無;1=有]
 * @property string $treatment_other 其它醫療處置
 * @property string $event_1 運動傷害事件發生[參考表 medical_injured_*]
 * @property string $diagnosis_1 診斷[參考表 medical_diagnosis_code]
 *
 * @property Users $u
 */
class MedicalHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medical_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ubi_id'], 'required'],
            [['ubi_id', 'at_plan_1', 'at_plan_2', 'at_plan_3', 'at_plan_4', 'at_plan_5', 'at_plan_6', 'at_plan_7', 'at_plan_8', 'treatment_1', 'treatment_2', 'treatment_3', 'treatment_4', 'treatment_5'], 'integer'],
            [['at_plan_other', 'treatment_other', 'event_1_other', 'diagnosis_1_other'], 'string'],
            [['created_at', 'updated_at'], 'string', 'max' => 20],
            [['event_1', 'diagnosis_1'], 'string', 'max' => 6],
            [['ubi_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersBodyInfo::className(), 'targetAttribute' => ['ubi_id' => 'ubi_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mh_id' => 'Mh ID',
            'ubi_id' => 'U ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'at_plan_1' => 'At Plan 1',
            'at_plan_2' => 'At Plan 2',
            'at_plan_3' => 'At Plan 3',
            'at_plan_4' => 'At Plan 4',
            'at_plan_5' => 'At Plan 5',
            'at_plan_6' => 'At Plan 6',
            'at_plan_7' => 'At Plan 7',
            'at_plan_8' => 'At Plan 8',
            'at_plan_other' => 'At Plan Other',
            'treatment_1' => 'Treatment 1',
            'treatment_2' => 'Treatment 2',
            'treatment_3' => 'Treatment 3',
            'treatment_4' => 'Treatment 4',
            'treatment_5' => 'Treatment 5',
            'treatment_other' => 'Treatment Other',
            'event_1' => 'Event 1',
            'event_1_other' => 'Event 1 Other',
            'diagnosis_1' => 'Diagnosis 1',
            'diagnosis_1_other' => 'Diagnosis 1 Other',
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

        return MedicalHistory::find()
            ->where($attributes)
            ->all();
    }

    public static function findOneRecord($id)
    {
        return MedicalHistory::find()
            ->where(['ubi_id' => $id])
            ->orderBy(['created_at' => SORT_ASC])
            ->one();
    }

    public static function findOneRecordByMhid($id)
    {
        return MedicalHistory::find()
            ->where(['mh_id' => $id])
            ->one();
    }

    public function createData($ubi_id, $params)
    {
        $at_plan_filter = ["運動按摩", "拉筋", "冷熱敷", "衛教", "貼紮防護", "建議轉介醫院或診所", "無", "其他"];
        $treatment_filter = ["醫院或診所接受復健或其它保守治療介入", "國術館或民俗療法", "無接受任何方式處理", "手術治療", "其他"];

        $at_plan = array_search($params['at_plan'], $at_plan_filter) + 1;
        $treatment = array_search($params['treatment'], $treatment_filter) + 1;

        $attributes = [
            "at_plan_1" => 0,
            "at_plan_2" => 0,
            "at_plan_3" => 0,
            "at_plan_4" => 0,
            "at_plan_5" => 0,
            "at_plan_6" => 0,
            "at_plan_7" => 0,
            "at_plan_8" => 0,
            "at_plan_other" => (isset($params["at_plan_other"]) && $at_plan == sizeof($at_plan_filter)) ? $params["at_plan_other"] : "",
            "treatment_1" => 0,
            "treatment_2" => 0,
            "treatment_3" => 0,
            "treatment_4" => 0,
            "treatment_5" => 0,
            "treatment_other" => (isset($params["treatment_other"]) && $treatment == sizeof($treatment_filter)) ? $params["treatment_other"] : "",
            "event_1" => $params["event_1"][0] . $params["event_1"][1] . $params["event_1"][2],
            "event_1_other" => isset($params["event_1_other"]) ? $params["event_1_other"] : "",
            "diagnosis_1" => $params["diagnosis_1"],
            "diagnosis_1_other" => isset($params["diagnosis_1_other"]) ? $params["diagnosis_1_other"] : "",
        ];

        $attributes["at_plan_$at_plan"] = 1;
        $attributes["treatment_$treatment"] = 1;
        $attributes['ubi_id'] = $ubi_id;
        $attributes['created_at'] = (string) self::currentTimeMillis();
        $attributes['updated_at'] = (string) self::currentTimeMillis();

        $medicalHistory = new MedicalHistory;
        $medicalHistory->attributes = $attributes;

        if ($medicalHistory->save()) {
            return $medicalHistory;
        }
        return null;
    }

    public function updateData($ubi_id, $params)
    {
        $medicalHistory = MedicalHistory::findOne(['ubi_id' => $ubi_id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($medicalHistory)) {
            return null;
        } else {
            $at_plan_filter = ["運動按摩", "拉筋", "冷熱敷", "衛教", "貼紮防護", "建議轉介醫院或診所", "無", "其他"];
            $treatment_filter = ["醫院或診所接受復健或其它保守治療介入", "國術館或民俗療法", "無接受任何方式處理", "手術治療", "其他"];

            $at_plan = array_search($params['at_plan'], $at_plan_filter) + 1;
            $treatment = array_search($params['treatment'], $treatment_filter) + 1;

            $attributes = [
                "at_plan_1" => 0,
                "at_plan_2" => 0,
                "at_plan_3" => 0,
                "at_plan_4" => 0,
                "at_plan_5" => 0,
                "at_plan_6" => 0,
                "at_plan_7" => 0,
                "at_plan_8" => 0,
                "at_plan_other" => (isset($params["at_plan_other"])) ? $params["at_plan_other"] : "",
                "treatment_1" => 0,
                "treatment_2" => 0,
                "treatment_3" => 0,
                "treatment_4" => 0,
                "treatment_5" => 0,
                "treatment_other" => (isset($params["treatment_other"])) ? $params["treatment_other"] : "",
                "event_1" => $params["event_1"][0] . $params["event_1"][1] . $params["event_1"][2],
                "event_1_other" => isset($params["event_1_other"]) ? $params["event_1_other"] : "",
                "diagnosis_1" => $params["diagnosis_1"],
                "diagnosis_1_other" => isset($params["diagnosis_1_other"]) ? $params["diagnosis_1_other"] : "",
            ];

            $attributes["at_plan_$at_plan"] = 1;
            $attributes["treatment_$treatment"] = 1;

            foreach ($attributes as $key => $value) {
                if (array_key_exists($key, self::attributeLabels()) && $value != $medicalHistory->$key) {
                    $medicalHistory->updated_at = $updated_at;
                    $medicalHistory->$key = $value;
                }
            }

            if ($medicalHistory->save()) {
                return $medicalHistory;
            }
            return null;
        }
    }
    public function updateDataByMhId($mh_id, $params)
    {
        $medicalHistory = MedicalHistory::findOne(['mh_id' => $mh_id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($medicalHistory)) {
            return null;
        } else {
            $at_plan_filter = ["運動按摩", "拉筋", "冷熱敷", "衛教", "貼紮防護", "建議轉介醫院或診所", "無", "其他"];
            $treatment_filter = ["醫院或診所接受復健或其它保守治療介入", "國術館或民俗療法", "無接受任何方式處理", "手術治療", "其他"];

            $at_plan = array_search($params['at_plan'], $at_plan_filter) + 1;
            $treatment = array_search($params['treatment'], $treatment_filter) + 1;

            $attributes = [
                "at_plan_1" => 0,
                "at_plan_2" => 0,
                "at_plan_3" => 0,
                "at_plan_4" => 0,
                "at_plan_5" => 0,
                "at_plan_6" => 0,
                "at_plan_7" => 0,
                "at_plan_8" => 0,
                "at_plan_other" => (isset($params["at_plan_other"])) ? $params["at_plan_other"] : "",
                "treatment_1" => 0,
                "treatment_2" => 0,
                "treatment_3" => 0,
                "treatment_4" => 0,
                "treatment_5" => 0,
                "treatment_other" => (isset($params["treatment_other"])) ? $params["treatment_other"] : "",
                "event_1" => $params["event_1"][0] . $params["event_1"][1] . $params["event_1"][2],
                "event_1_other" => isset($params["event_1_other"]) ? $params["event_1_other"] : "",
                "diagnosis_1" => $params["diagnosis_1"],
                "diagnosis_1_other" => isset($params["diagnosis_1_other"]) ? $params["diagnosis_1_other"] : "",
            ];

            $attributes["at_plan_$at_plan"] = 1;
            $attributes["treatment_$treatment"] = 1;

            foreach ($attributes as $key => $value) {
                if (array_key_exists($key, self::attributeLabels()) && $value != $medicalHistory->$key) {
                    $medicalHistory->updated_at = $updated_at;
                    $medicalHistory->$key = $value;
                }
            }

            if ($medicalHistory->save()) {
                return $medicalHistory;
            }
            return null;
        }
    }

    public function deleteData($id)
    {
        $medicalHistory = MedicalHistory::find()->where(['ubi_id' => $id])->one();

        if (!is_null($medicalHistory)) {
            return $medicalHistory->delete();
        }
        return null;
    }

    public function currentTimeMillis()
    {
        list($usec, $sec) = explode(" ", microtime());
        return round(((float) $usec + (float) $sec) * 1000);
    }
}
