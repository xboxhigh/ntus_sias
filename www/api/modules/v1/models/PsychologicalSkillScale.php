<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "psychological_skill_scale".
 *
 * @property int $pss_id 流水號
 * @property int $ubi_id 個案編號
 * @property string $created_at 建立日期
 * @property string $updated_at 更新日期
 * @property string $scale_results 以逗點區隔之1~5分量表數值[0,0,0,0,0,0...]
 *
 * @property UsersBodyInfo $u
 */
class PsychologicalSkillScale extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'psychological_skill_scale';
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
            [['scale_results'], 'string', 'max' => 150],
            [['ubi_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersBodyInfo::className(), 'targetAttribute' => ['ubi_id' => 'ubi_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pss_id' => 'Pss ID',
            'ubi_id' => 'U ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'scale_results' => 'Scale Results',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(UsersBodyInfo::className(), ['ubi_id' => 'ubi_id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findAllRecords()
    {
        return PsychologicalSkillScale::find()->all();
    }

    public static function findOneRecord($id)
    {
        return PsychologicalSkillScale::find()
            ->where(['ubi_id' => $id])
            ->one();
    }

    public function createData($ubi_id, $params)
    {
        $psychologicalSkillQuestions = PsychologicalSkillQuestions::find()->count();

        $attributes['ubi_id'] = $ubi_id;
        $attributes['created_at'] = (string) self::currentTimeMillis();
        $attributes['updated_at'] = (string) self::currentTimeMillis();

        foreach ($params as $key => $value) {
            $attributes[$key] = $value;
            if (strcmp($key, "scale_results") == 0) {
                if (strstr($value, "0")) {
                    return null;
                } else {
                    $data_count = sizeof(explode(",", $value));
                }
            }
        }

        if (isset($data_count) && $data_count != $psychologicalSkillQuestions) {
            return "NUMBER_NOT_MATCH";
        } else {
            $psychologicalSkillScale = new PsychologicalSkillScale;
            $psychologicalSkillScale->attributes = $attributes;

            if ($psychologicalSkillScale->save()) {
                return $psychologicalSkillScale;
            }
            return null;
        }
    }

    public function updateData($ubi_id, $params)
    {
        $psychologicalSkillQuestions = PsychologicalSkillQuestions::find()->count();

        $psychologicalSkillScale = PsychologicalSkillScale::findOne(['ubi_id' => $ubi_id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($psychologicalSkillScale)) {
            return null;
        } else {
            foreach ($params as $key => $value) {
                if (array_key_exists($key, self::attributeLabels()) && $value !== $psychologicalSkillScale->$key) {
                    $psychologicalSkillScale->updated_at = $updated_at;
                    $psychologicalSkillScale->$key = $value;

                    if (strcmp($key, "scale_results") == 0) {
                        if (strstr($value, "0")) {
                            return null;
                        } else {
                            $data_count = sizeof(explode(",", $value));
                        }
                    }
                }
            }
            if (isset($data_count) && $data_count != $psychologicalSkillQuestions) {
                return "NUMBER_NOT_MATCH";
            } else {
                if ($psychologicalSkillScale->save()) {
                    return $psychologicalSkillScale;
                }
                return null;
            }
        }
    }

    public function deleteData($id)
    {
        $psychologicalSkillScale = PsychologicalSkillScale::find()->where(['ubi_id' => $id])->one();

        if (!is_null($psychologicalSkillScale)) {
            return $psychologicalSkillScale->delete();
        }
        return null;
    }
    public function currentTimeMillis()
    {
        list($usec, $sec) = explode(" ", microtime());
        return round(((float) $usec + (float) $sec) * 1000);
    }
}
