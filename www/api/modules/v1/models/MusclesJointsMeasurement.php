<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "muscles_joints_measurement".
 *
 * @property int $mjm_id 流水號
 * @property int $ubi_id 個案編號
 * @property string $created_at 建立日期
 * @property string $updated_at 更新日期
 * @property string $lx_lf_rom_r rom量測：右 lumbar lateral flexion[end range：__°]
 * @property string $lx_lf_rom_l rom量測：左 lumbar lateral flexion[end range：__°]
 * @property string $tx_r_rom_r rom量測：右 thoracic rotation[end range：__°]
 * @property string $tx_r_rom_l rom量測：左 thoracic rotation[end range：__°]
 * @property string $gh_er_rom_r rom量測：右 shoulder er[end range：__°]
 * @property string $gh_er_rom_l rom量測：左 shoulder er[end range：__°]
 * @property string $gh_ir_rom_r rom量測：右 shoulder ir[end range：__°]
 * @property string $gh_ir_rom_l rom量測：左 shoulder ir[end range：__°]
 * @property string $gh_er_mmt_r mmt量測: 右 shoulder er[數值]
 * @property string $gh_er_mmt_l mmt量測: 左 shoulder er[數值]
 * @property string $gh_ir_mmt_r mmt量測: 右 shoulder ir[數值]
 * @property string $gh_ir_mmt_l mmt量測: 左 shoulder ir[數值]
 * @property string $e_f_mmt_r mmt量測: 右 elbow flexion[數值]
 * @property string $e_f_mmt_l mmt量測: 左 elbow flexion[數值]
 * @property string $e_e_mmt_r mmt量測: 右 elbow extension[數值]
 * @property string $e_e_mmt_l mmt量測: 左 elbow extension[數值]
 * @property string $ank_inver_mmt_r mmt量測: 右 ankle inversion[數值]
 * @property string $ank_inver_mmt_l mmt量測: 左 ankle inversion[數值]
 * @property string $ank_ever_mmt_r mmt量測: 右 ankle eversion[數值]
 * @property string $ank_ever_mmt_l mmt量測: 左 ankle eversion[數值]
 * @property string $gh_horiadd_mmt_r mmt量測: 右 shoulder horizontal adduction[數值]
 * @property string $gh_horiadd_mmt_l mmt量測: 左 shoulder horizontal adduction[數值]
 * @property string $gh_horiabd_mmt_r mmt量測: 右 shoulder horizontal abduction[數值]
 * @property string $gh_horiabd_mmt_l mmt量測: 左 shoulder horizontal abduction[數值]
 * @property string $myo_t_f_r 肌肉張力測_trapezius_肌肉張力_右（坐）[數值]
 * @property string $myo_t_f_l 肌肉張力測_trapezius_肌肉張力_左（坐）[數值]
 * @property string $myo_t_s_r 肌肉張力測_trapezius_肌肉硬度_右（坐）[數值]
 * @property string $myo_t_s_l 肌肉張力測_trapezius_肌肉硬度_左（坐）[數值]
 * @property string $myo_t_d_r 肌肉張力測_trapezius_肌肉彈性_右（坐）[數值]
 * @property string $myo_t_d_l 肌肉張力測_trapezius_肌肉彈性_左（坐）[數值]
 * @property string $myo_t_r_r 肌肉張力測_trapezius_放鬆時間_右（坐）[數值]
 * @property string $myo_t_r_l 肌肉張力測_trapezius_放鬆時間_左（坐）[數值]
 * @property string $myo_t_c_r 肌肉張力測_trapezius_德柏拉數_右（坐）[數值]
 * @property string $myo_t_c_l 肌肉張力測_trapezius_德柏拉數_左（坐）[數值]
 * @property string $myo_es_p_f_r 肌肉張力測_erector spinae_肌肉張力_右（趴）[數值]
 * @property string $myo_es_p_f_l 肌肉張力測_erector spinae_肌肉張力_左（趴）[數值]
 * @property string $myo_es_s_f_r 肌肉張力測_erector spinae_肌肉張力_右（坐）[數值]
 * @property string $myo_es_s_f_l 肌肉張力測_erector spinae_肌肉張力_左（坐）[數值]
 * @property string $myo_es_p_s_r 肌肉張力測_erector spinae_肌肉硬度_右（趴）[數值]
 * @property string $myo_es_p_s_l 肌肉張力測_erector spinae_肌肉硬度_左（趴）[數值]
 * @property string $myo_es_s_s_r 肌肉張力測_erector spinae_肌肉硬度_右（坐）[數值]
 * @property string $myo_es_s_s_l 肌肉張力測_erector spinae_肌肉硬度_左（坐）[數值]
 * @property string $myo_es_p_d_r 肌肉張力測_erector spinae_肌肉彈性_右（趴）[數值]
 * @property string $myo_es_p_d_l 肌肉張力測_erector spinae_肌肉彈性_左（趴）[數值]
 * @property string $myo_es_s_d_r 肌肉張力測_erector spinae_肌肉彈性_右（坐）[數值]
 * @property string $myo_es_s_d_l 肌肉張力測_erector spinae_肌肉彈性_左（坐）[數值]
 * @property string $myo_es_p_r_r 肌肉張力測_erector spinae_放鬆時間_右（趴）[數值]
 * @property string $myo_es_p_r_l 肌肉張力測_erector spinae_放鬆時間_左（趴）[數值]
 * @property string $myo_es_s_r_r 肌肉張力測_erector spinae_放鬆時間_右（坐）[數值]
 * @property string $myo_es_s_r_l 肌肉張力測_erector spinae_放鬆時間_左（坐）[數值]
 * @property string $myo_es_p_c_r 肌肉張力測_erector spinae_德柏拉數_右（趴）[數值]
 * @property string $myo_es_p_c_l 肌肉張力測_erector spinae_德柏拉數_左（趴）[數值]
 * @property string $myo_es_s_c_r 肌肉張力測_erector spinae_德柏拉數_右（坐）[數值]
 * @property string $myo_es_s_c_l 肌肉張力測_erector spinae_德柏拉數_左（坐）[數值]
 * @property string $flexibility_1 柔軟度_第一次[數值]
 * @property string $flexibility_2 柔軟度_第二次[數值]
 * @property string $note 備註[所有統一寫]
 *
 * @property Users $u
 */
class MusclesJointsMeasurement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'muscles_joints_measurement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ubi_id'], 'required'],
            [['ubi_id'], 'integer'],
            [['lx_lf_rom_r', 'lx_lf_rom_l', 'tx_r_rom_r', 'tx_r_rom_l', 'gh_er_rom_r', 'gh_er_rom_l', 'gh_ir_rom_r', 'gh_ir_rom_l', 'gh_er_mmt_r', 'gh_er_mmt_l', 'gh_ir_mmt_r', 'gh_ir_mmt_l', 'e_f_mmt_r', 'e_f_mmt_l', 'e_e_mmt_r', 'e_e_mmt_l', 'ank_inver_mmt_r', 'ank_inver_mmt_l', 'ank_ever_mmt_r', 'ank_ever_mmt_l', 'gh_horiadd_mmt_r', 'gh_horiadd_mmt_l', 'gh_horiabd_mmt_r', 'gh_horiabd_mmt_l', 'myo_t_f_r', 'myo_t_f_l', 'myo_t_s_r', 'myo_t_s_l', 'myo_t_d_r', 'myo_t_d_l', 'myo_t_r_r', 'myo_t_r_l', 'myo_t_c_r', 'myo_t_c_l', 'myo_es_p_f_r', 'myo_es_p_f_l', 'myo_es_s_f_r', 'myo_es_s_f_l', 'myo_es_p_s_r', 'myo_es_p_s_l', 'myo_es_s_s_r', 'myo_es_s_s_l', 'myo_es_p_d_r', 'myo_es_p_d_l', 'myo_es_s_d_r', 'myo_es_s_d_l', 'myo_es_p_r_r', 'myo_es_p_r_l', 'myo_es_s_r_r', 'myo_es_s_r_l', 'myo_es_p_c_r', 'myo_es_p_c_l', 'myo_es_s_c_r', 'myo_es_s_c_l', 'flexibility_1', 'flexibility_2'], 'number'],
            [['created_at', 'updated_at'], 'string', 'max' => 20],
            [['note'], 'string'],
            [['ubi_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersBodyInfo::className(), 'targetAttribute' => ['ubi_id' => 'ubi_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mjm_id' => 'Mjm ID',
            'ubi_id' => 'U ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'lx_lf_rom_r' => 'Lx Lf Rom R',
            'lx_lf_rom_l' => 'Lx Lf Rom L',
            'tx_r_rom_r' => 'Tx R Rom R',
            'tx_r_rom_l' => 'Tx R Rom L',
            'gh_er_rom_r' => 'Gh Er Rom R',
            'gh_er_rom_l' => 'Gh Er Rom L',
            'gh_ir_rom_r' => 'Gh Ir Rom R',
            'gh_ir_rom_l' => 'Gh Ir Rom L',
            'gh_er_mmt_r' => 'Gh Er Mmt R',
            'gh_er_mmt_l' => 'Gh Er Mmt L',
            'gh_ir_mmt_r' => 'Gh Ir Mmt R',
            'gh_ir_mmt_l' => 'Gh Ir Mmt L',
            'e_f_mmt_r' => 'E F Mmt R',
            'e_f_mmt_l' => 'E F Mmt L',
            'e_e_mmt_r' => 'E E Mmt R',
            'e_e_mmt_l' => 'E E Mmt L',
            'ank_inver_mmt_r' => 'Ank Inver Mmt R',
            'ank_inver_mmt_l' => 'Ank Inver Mmt L',
            'ank_ever_mmt_r' => 'Ank Ever Mmt R',
            'ank_ever_mmt_l' => 'Ank Ever Mmt L',
            'gh_horiadd_mmt_r' => 'Gh Horiadd Mmt R',
            'gh_horiadd_mmt_l' => 'Gh Horiadd Mmt L',
            'gh_horiabd_mmt_r' => 'Gh Horiabd Mmt R',
            'gh_horiabd_mmt_l' => 'Gh Horiabd Mmt L',
            'myo_t_f_r' => 'Myo T F R',
            'myo_t_f_l' => 'Myo T F L',
            'myo_t_s_r' => 'Myo T S R',
            'myo_t_s_l' => 'Myo T S L',
            'myo_t_d_r' => 'Myo T D R',
            'myo_t_d_l' => 'Myo T D L',
            'myo_t_r_r' => 'Myo T R R',
            'myo_t_r_l' => 'Myo T R L',
            'myo_t_c_r' => 'Myo T C R',
            'myo_t_c_l' => 'Myo T C L',
            'myo_es_p_f_r' => 'Myo Es P F R',
            'myo_es_p_f_l' => 'Myo Es P F L',
            'myo_es_s_f_r' => 'Myo Es S F R',
            'myo_es_s_f_l' => 'Myo Es S F L',
            'myo_es_p_s_r' => 'Myo Es P S R',
            'myo_es_p_s_l' => 'Myo Es P S L',
            'myo_es_s_s_r' => 'Myo Es S S R',
            'myo_es_s_s_l' => 'Myo Es S S L',
            'myo_es_p_d_r' => 'Myo Es P D R',
            'myo_es_p_d_l' => 'Myo Es P D L',
            'myo_es_s_d_r' => 'Myo Es S D R',
            'myo_es_s_d_l' => 'Myo Es S D L',
            'myo_es_p_r_r' => 'Myo Es P R R',
            'myo_es_p_r_l' => 'Myo Es P R L',
            'myo_es_s_r_r' => 'Myo Es S R R',
            'myo_es_s_r_l' => 'Myo Es S R L',
            'myo_es_p_c_r' => 'Myo Es P C R',
            'myo_es_p_c_l' => 'Myo Es P C L',
            'myo_es_s_c_r' => 'Myo Es S C R',
            'myo_es_s_c_l' => 'Myo Es S C L',
            'flexibility_1' => 'Flexibility 1',
            'flexibility_2' => 'Flexibility 2',
            'note' => 'Note',
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

        return MusclesJointsMeasurement::find()
            ->where($attributes)
            ->all();
    }

    public static function findOneRecord($id)
    {
        return MusclesJointsMeasurement::find()
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

        $musclesJointsMeasurement = new MusclesJointsMeasurement;
        $musclesJointsMeasurement->attributes = $attributes;

        if ($musclesJointsMeasurement->save()) {
            return $musclesJointsMeasurement;
        }
        return null;
    }

    public function updateData($ubi_id, $params)
    {
        $musclesJointsMeasurement = MusclesJointsMeasurement::findOne(['ubi_id' => $ubi_id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($musclesJointsMeasurement)) {
            return null;
        } else {
            foreach ($params as $key => $value) {
                if (array_key_exists($key, self::attributeLabels()) && $value !== $musclesJointsMeasurement->$key) {
                    $musclesJointsMeasurement->updated_at = $updated_at;
                    $musclesJointsMeasurement->$key = $value;
                }
            }
            if ($musclesJointsMeasurement->save()) {
                return $musclesJointsMeasurement;
            }
        }
    }

    public function deleteData($id)
    {
        $musclesJointsMeasurement = MusclesJointsMeasurement::find()->where(['ubi_id' => $id])->one();

        if (!is_null($musclesJointsMeasurement)) {
            return $musclesJointsMeasurement->delete();
        }
        return null;
    }

    public function currentTimeMillis()
    {
        list($usec, $sec) = explode(" ", microtime());
        return round(((float) $usec + (float) $sec) * 1000);
    }
}
