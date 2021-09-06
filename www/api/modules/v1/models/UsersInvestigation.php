<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "users_investigation".
 *
 * @property int $ui_id 流水號
 * @property int $ubi_id 個案編號
 * @property string $created_at 建立日期
 * @property string $updated_at 更新日期
 * @property string $schl 學校類別[junior high school=JHS]
 * @property int $grade 年級[二年級=8, 一年級=7]
 * @property string $class 班級名稱
 * @property string $name 姓名
 * @property string $spt 運動項目[Soccer=SOC, Baketbal=BAS, Handball=HB]
 * @property string $student_id 學號/座號
 * @property int $gender 性別[M=1, F=2]
 * @property string $id_card 身分證字號
 * @property string $date 生日
 * @property string $bpf 基礎體適能
 * @property string $bpf_height 身高
 * @property string $bpf_weight 體重
 * @property string $bpf_forward_flex 坐姿體前彎
 * @property string $bpf_jump 立定跳遠
 * @property string $bpf_sit_ups 仰臥起坐
 * @property string $bpf_800_1600m 心肺適能
 * @property string $spf 競技體適能
 * @property string $spf_3minstep_1.5 心肺耐力第一次測量
 * @property string $spf_3minstep_2.5 心肺耐力第二次測量
 * @property string $spf_3minstep_3.5 心肺耐力第三次測量
 * @property string $spf_3minstep_sum 心肺耐力三次加總
 * @property string $spf_3minstep_index 心肺耐力
 * @property string $spf_v_10m 速度第一次測量
 * @property string $spf_v_20m 速度第二次測量
 * @property string $spf_v_30m 速度第三次測量
 * @property string $spf_v_40m 速度第四次測量
 * @property string $spf_power 爆發力
 * @property string $spf_balance_l_a 軀幹高
 * @property string $spf_balance_l_pm 平衡
 * @property string $spf_balance_l_pl 平衡
 * @property string $spf_balance_r_a 平衡
 * @property string $spf_balance_r_pm 平衡
 * @property string $spf_balance_r_pl 平衡
 * @property string $spf_agility 敏捷
 * @property string $fms_squat 功能性動作檢測(FMS)
 * @property string $fms_hurdle_l 功能性動作檢測(FMS)
 * @property string $fms_hurdle_r 功能性動作檢測(FMS)
 * @property string $fms_lunge_l 功能性動作檢測(FMS)
 * @property string $fms_lunge_r 功能性動作檢測(FMS)
 * @property string $fms_mobility_l 功能性動作檢測(FMS)
 * @property string $fms_mobility_r 功能性動作檢測(FMS)
 * @property string $fms_slr_l 功能性動作檢測(FMS)
 * @property string $fms_slr_r 功能性動作檢測(FMS)
 * @property string $fms_pushup 功能性動作檢測(FMS)
 * @property string $fms_stability_l 功能性動作檢測(FMS)
 * @property string $fms_stability_r 功能性動作檢測(FMS)
 * @property int $is_injured_6month 六個月是否受傷[0=沒有;1=有]
 * @property int $injured_side 受傷側[1=左;2=右;3=其他]
 * @property string $injured_side_other
 * @property int $injured_part 受傷部位[參照表 users_injured_codes]
 * @property string $injured_part_other
 * @property int $diagnosis 診斷[參照表users_diagnosis_codes]
 * @property string $diagnosis_other
 * @property int $event 發生狀況[參照表users_event_codes]
 * @property string $event_other
 *
 * @property UsersBodyInfo $ubi
 */
class UsersInvestigation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_investigation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ubi_id'], 'required'],
            [['ubi_id', 'grade', 'gender', 'is_injured_6month', 'injured_side', 'injured_part', 'diagnosis', 'event'], 'integer'],
            [['bpf', 'bpf_height', 'bpf_weight', 'bpf_forward_flex', 'bpf_jump', 'bpf_sit_ups', 'bpf_800_1600m', 'spf', 'spf_3minstep_15', 'spf_3minstep_25', 'spf_3minstep_35', 'spf_3minstep_sum', 'spf_3minstep_index', 'spf_v_10m', 'spf_v_20m', 'spf_v_30m', 'spf_v_40m', 'spf_power', 'spf_balance_l_a', 'spf_balance_l_pm', 'spf_balance_l_pl', 'spf_balance_r_a', 'spf_balance_r_pm', 'spf_balance_r_pl', 'spf_agility', 'fms_squat', 'fms_hurdle_l', 'fms_hurdle_r', 'fms_lunge_l', 'fms_lunge_r', 'fms_mobility_l', 'fms_mobility_r', 'fms_slr_l', 'fms_slr_r', 'fms_pushup', 'fms_stability_l', 'fms_stability_r'], 'number'],
            [['injured_side_other', 'injured_part_other', 'diagnosis_other', 'event_other'], 'string'],
            [['created_at', 'updated_at', 'date'], 'string', 'max' => 20],
            [['schl', 'spt', 'student_id', 'id_card'], 'string', 'max' => 10],
            [['class', 'name'], 'string', 'max' => 50],
            [['ubi_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersBodyInfo::className(), 'targetAttribute' => ['ubi_id' => 'ubi_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ui_id' => 'Ui ID',
            'ubi_id' => 'Ubi ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'schl' => 'Schl',
            'grade' => 'Grade',
            'class' => 'Class',
            'name' => 'Name',
            'spt' => 'Spt',
            'student_id' => 'Student ID',
            'gender' => 'Gender',
            'id_card' => 'Id Card',
            'date' => 'Date',
            'bpf' => 'Bpf',
            'bpf_height' => 'Bpf Height',
            'bpf_weight' => 'Bpf Weight',
            'bpf_forward_flex' => 'Bpf Forward Flex',
            'bpf_jump' => 'Bpf Jump',
            'bpf_sit_ups' => 'Bpf Sit Ups',
            'bpf_800_1600m' => 'Bpf 800 1600m',
            'spf' => 'Spf',
            'spf_3minstep_15' => 'Spf 3minstep 1 5',
            'spf_3minstep_25' => 'Spf 3minstep 2 5',
            'spf_3minstep_35' => 'Spf 3minstep 3 5',
            'spf_3minstep_sum' => 'Spf 3minstep Sum',
            'spf_3minstep_index' => 'Spf 3minstep Index',
            'spf_v_10m' => 'Spf V 10m',
            'spf_v_20m' => 'Spf V 20m',
            'spf_v_30m' => 'Spf V 30m',
            'spf_v_40m' => 'Spf V 40m',
            'spf_power' => 'Spf Power',
            'spf_balance_l_a' => 'Spf Balance L A',
            'spf_balance_l_pm' => 'Spf Balance L Pm',
            'spf_balance_l_pl' => 'Spf Balance L Pl',
            'spf_balance_r_a' => 'Spf Balance R A',
            'spf_balance_r_pm' => 'Spf Balance R Pm',
            'spf_balance_r_pl' => 'Spf Balance R Pl',
            'spf_agility' => 'Spf Agility',
            'fms_squat' => 'Fms Squat',
            'fms_hurdle_l' => 'Fms Hurdle L',
            'fms_hurdle_r' => 'Fms Hurdle R',
            'fms_lunge_l' => 'Fms Lunge L',
            'fms_lunge_r' => 'Fms Lunge R',
            'fms_mobility_l' => 'Fms Mobility L',
            'fms_mobility_r' => 'Fms Mobility R',
            'fms_slr_l' => 'Fms Slr L',
            'fms_slr_r' => 'Fms Slr R',
            'fms_pushup' => 'Fms Pushup',
            'fms_stability_l' => 'Fms Stability L',
            'fms_stability_r' => 'Fms Stability R',
            'is_injured_6month' => 'Is Injured 6month',
            'injured_side' => 'Injured Side',
            'injured_side_other' => 'Injured Side Other',
            'injured_part' => 'Injured Part',
            'injured_part_other' => 'Injured Part Other',
            'diagnosis' => 'Diagnosis',
            'diagnosis_other' => 'Diagnosis Other',
            'event' => 'Event',
            'event_other' => 'Event Other',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUbi()
    {
        return $this->hasOne(UsersBodyInfo::className(), ['ubi_id' => 'ubi_id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findAllRecords()
    {
        return UsersInvestigation::find()->all();
    }

    public static function findOneRecord($id)
    {
        return UsersInvestigation::find()
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

        $UsersInvestigation = new UsersInvestigation;
        $UsersInvestigation->attributes = $attributes;

        if ($UsersInvestigation->save()) {
            return $UsersInvestigation;
        }
        return null;
    }

    public function updateData($ubi_id, $params)
    {
        $UsersInvestigation = UsersInvestigation::findOne(['ubi_id' => $ubi_id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($UsersInvestigation)) {
            return null;
        } else {
            foreach ($params as $key => $value) {
                if (array_key_exists($key, self::attributeLabels()) && $value !== $UsersInvestigation->$key) {
                    $UsersInvestigation->updated_at = $updated_at;
                    $UsersInvestigation->$key = $value;
                }
            }

            if ($UsersInvestigation->save()) {
                return $UsersInvestigation;
            }
            return null;
        }
    }

    public function deleteData($id)
    {
        $usersInvestigation = UsersInvestigation::find()->where(['ubi_id' => $id])->one();

        if (!is_null($usersInvestigation)) {
            return $usersInvestigation->delete();
        }
        return null;
    }

    public function currentTimeMillis()
    {
        list($usec, $sec) = explode(" ", microtime());
        return round(((float) $usec + (float) $sec) * 1000);
    }
}
