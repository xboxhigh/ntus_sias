<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "medical_diagnosis_codes".
 *
 * @property int $mdc_id
 * @property string $code
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class MedicalDiagnosisCodes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medical_diagnosis_codes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'string', 'max' => 4],
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
            'mdc_id' => 'Mdc ID',
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
        return MedicalDiagnosisCodes::find()
            ->select(['mdc_id', 'code', 'name'])
            ->orderBy(['mdc_id' => SORT_ASC])
            ->all();
    }

    public static function findOneRecord($id)
    {
        return MedicalDiagnosisCodes::find()
            ->where(['mdc_id' => $id])
            ->one();
    }

    public function createData($params)
    {
        $attributes['created_at'] = (string) self::currentTimeMillis();
        $attributes['updated_at'] = (string) self::currentTimeMillis();

        foreach ($params as $key => $value) {
            $attributes[$key] = $value;
        }

        $medicalDiagnosisCodes = new MedicalDiagnosisCodes;
        $medicalDiagnosisCodes->attributes = $attributes;

        if ($medicalDiagnosisCodes->save()) {
            $medicalDiagnosisCodes->code = (string) $medicalDiagnosisCodes->mdc_id;
            $medicalDiagnosisCodes->save();
            return $medicalDiagnosisCodes;
        }
        return null;
    }

    public function updateData($id, $params)
    {
        $medicalDiagnosisCodes = MedicalDiagnosisCodes::findOne(['mdc_id' => $id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($medicalDiagnosisCodes)) {
            return 'NO_RECORD';
        } else {
            foreach ($params as $key => $value) {
                if (isset($medicalDiagnosisCodes->$key) && $value !== $medicalDiagnosisCodes->$key) {
                    $medicalDiagnosisCodes->updated_at = $updated_at;
                    $medicalDiagnosisCodes->$key = $value;
                }
            }
            if ($medicalDiagnosisCodes->save()) {
                return $medicalDiagnosisCodes;
            }
        }
    }

    public function deleteData($id)
    {
        $medicalDiagnosisCodes = MedicalDiagnosisCodes::find()->where(['mdc_id' => $id])->one();

        if (!is_null($medicalDiagnosisCodes)) {
            return $medicalDiagnosisCodes->delete();
        }
        return null;
    }

    public function currentTimeMillis()
    {
        list($usec, $sec) = explode(" ", microtime());
        return round(((float) $usec + (float) $sec) * 1000);
    }
}
