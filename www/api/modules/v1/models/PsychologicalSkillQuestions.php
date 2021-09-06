<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "psychological_skill_questions".
 *
 * @property int $psq_id 流水號
 * @property string $created_at 建立日期
 * @property string $updated_at 更新日期
 * @property string $name 題目名稱
 */
class PsychologicalSkillQuestions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'psychological_skill_questions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
            'psq_id' => 'Psq ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'name' => 'Name',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findAllRecords()
    {
        return PsychologicalSkillQuestions::find()->all();
    }

    public static function findOneRecord($id)
    {
        return PsychologicalSkillQuestions::find()
            ->where(['psq_id' => $id])
            ->one();
    }

    public function createData($params)
    {
        $attributes['created_at'] = (string) self::currentTimeMillis();
        $attributes['updated_at'] = (string) self::currentTimeMillis();

        foreach ($params as $key => $value) {
            $attributes[$key] = $value;
        }

        $psychologicalSkillQuestions = new PsychologicalSkillQuestions;
        $psychologicalSkillQuestions->attributes = $attributes;

        if ($psychologicalSkillQuestions->save()) {
            $psychologicalSkillQuestions->code = (string) $psychologicalSkillQuestions->psq_id;
            $psychologicalSkillQuestions->save();
            return $psychologicalSkillQuestions;
        }
        return null;
    }

    public function updateData($id, $params)
    {
        $psychologicalSkillQuestions = PsychologicalSkillQuestions::findOne(['psq_id' => $id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($psychologicalSkillQuestions)) {
            return 'NO_RECORD';
        } else {
            foreach ($params as $key => $value) {
                if (isset($psychologicalSkillQuestions->$key) && $value !== $psychologicalSkillQuestions->$key) {
                    $psychologicalSkillQuestions->updated_at = $updated_at;
                    $psychologicalSkillQuestions->$key = $value;
                }
            }
            if ($psychologicalSkillQuestions->save()) {
                return $psychologicalSkillQuestions;
            }
        }
    }

    public function deleteData($id)
    {
        $psychologicalSkillQuestions = PsychologicalSkillQuestions::find()->where(['psq_id' => $id])->one();

        if (!is_null($psychologicalSkillQuestions)) {
            return $psychologicalSkillQuestions->delete();
        }
        return null;
    }

    public function currentTimeMillis()
    {
        list($usec, $sec) = explode(" ", microtime());
        return round(((float) $usec + (float) $sec) * 1000);
    }
}
