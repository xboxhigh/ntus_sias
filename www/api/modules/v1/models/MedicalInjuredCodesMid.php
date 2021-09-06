<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "medical_injured_codes_mid".
 *
 * @property int $micm_id
 * @property string $code
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class MedicalInjuredCodesMid extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medical_injured_codes_mid';
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
            'micm_id' => 'Micm ID',
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
        return MedicalInjuredCodesMid::find()
            ->select(['micm_id', 'code', 'name'])
            ->orderBy(['micm_id' => SORT_ASC])
            ->all();
    }

    public static function findOneRecord($id)
    {
        return MedicalInjuredCodesMid::find()
            ->where(['micm_id' => $id])
            ->one();
    }

    public function createData($params)
    {
        $attributes['created_at'] = (string) self::currentTimeMillis();
        $attributes['updated_at'] = (string) self::currentTimeMillis();

        foreach ($params as $key => $value) {
            $attributes[$key] = $value;
        }

        $medicalInjuredCodesMid = new MedicalInjuredCodesMid;
        $medicalInjuredCodesMid->attributes = $attributes;

        if ($medicalInjuredCodesMid->save()) {
            return $medicalInjuredCodesMid;
        }
        return null;
    }

    public function updateData($id, $params)
    {
        $medicalInjuredCodesMid = MedicalInjuredCodesMid::findOne(['micm_id' => $id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($medicalInjuredCodesMid)) {
            return 'NO_RECORD';
        } else {
            foreach ($params as $key => $value) {
                if (isset($medicalInjuredCodesMid->$key) && $value !== $medicalInjuredCodesMid->$key) {
                    $medicalInjuredCodesMid->updated_at = $updated_at;
                    $medicalInjuredCodesMid->$key = $value;
                }
            }
            if ($medicalInjuredCodesMid->save()) {
                return $medicalInjuredCodesMid;
            }
        }
    }

    public function deleteData($id)
    {
        $medicalInjuredCodesMid = MedicalInjuredCodesMid::find()->where(['micm_id' => $id])->one();

        if (!is_null($medicalInjuredCodesMid)) {
            return $medicalInjuredCodesMid->delete();
        }
        return null;
    }

    public function currentTimeMillis()
    {
        list($usec, $sec) = explode(" ", microtime());
        return round(((float) $usec + (float) $sec) * 1000);
    }
}
