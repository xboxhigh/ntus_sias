<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "medical_injured_codes_end".
 *
 * @property int $mice_id
 * @property string $code
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class MedicalInjuredCodesEnd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medical_injured_codes_end';
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
            'mice_id' => 'Mice ID',
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
        return MedicalInjuredCodesEnd::find()
            ->select(['mice_id', 'code', 'name'])
            ->orderBy(['mice_id' => SORT_ASC])
            ->all();
    }

    public static function findOneRecord($id)
    {
        return MedicalInjuredCodesEnd::find()
            ->where(['mice_id' => $id])
            ->one();
    }

    public function createData($params)
    {
        $attributes['created_at'] = (string) self::currentTimeMillis();
        $attributes['updated_at'] = (string) self::currentTimeMillis();

        foreach ($params as $key => $value) {
            $attributes[$key] = $value;
        }

        $medicalInjuredCodesEnd = new MedicalInjuredCodesEnd;
        $medicalInjuredCodesEnd->attributes = $attributes;

        if ($medicalInjuredCodesEnd->save()) {
            return $medicalInjuredCodesEnd;
        }
        return null;
    }

    public function updateData($id, $params)
    {
        $medicalInjuredCodesEnd = MedicalInjuredCodesEnd::findOne(['mice_id' => $id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($medicalInjuredCodesEnd)) {
            return 'NO_RECORD';
        } else {
            foreach ($params as $key => $value) {
                if (isset($medicalInjuredCodesEnd->$key) && $value !== $medicalInjuredCodesEnd->$key) {
                    $medicalInjuredCodesEnd->updated_at = $updated_at;
                    $medicalInjuredCodesEnd->$key = $value;
                }
            }
            if ($medicalInjuredCodesEnd->save()) {
                return $medicalInjuredCodesEnd;
            }
        }
    }

    public function deleteData($id)
    {
        $medicalInjuredCodesEnd = MedicalInjuredCodesEnd::find()->where(['mice_id' => $id])->one();

        if (!is_null($medicalInjuredCodesEnd)) {
            return $medicalInjuredCodesEnd->delete();
        }
        return null;
    }

    public function currentTimeMillis()
    {
        list($usec, $sec) = explode(" ", microtime());
        return round(((float) $usec + (float) $sec) * 1000);
    }
}
