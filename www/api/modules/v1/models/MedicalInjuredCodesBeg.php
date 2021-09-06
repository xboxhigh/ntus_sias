<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "medical_injured_codes_beg".
 *
 * @property int $micb_id
 * @property string $code
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class MedicalInjuredCodesBeg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medical_injured_codes_beg';
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
            'micb_id' => 'Micb ID',
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
        return MedicalInjuredCodesBeg::find()
            ->select(['micb_id', 'code', 'name'])
            ->orderBy(['micb_id' => SORT_ASC])
            ->all();
    }

    public static function findOneRecord($id)
    {
        return MedicalInjuredCodesBeg::find()
            ->where(['micb_id' => $id])
            ->one();
    }

    public function createData($params)
    {
        $attributes['created_at'] = (string) self::currentTimeMillis();
        $attributes['updated_at'] = (string) self::currentTimeMillis();

        foreach ($params as $key => $value) {
            $attributes[$key] = $value;
        }

        $medicalInjuredCodesBeg = new MedicalInjuredCodesBeg;
        $medicalInjuredCodesBeg->attributes = $attributes;

        if ($medicalInjuredCodesBeg->save()) {
            return $medicalInjuredCodesBeg;
        }
        return null;
    }

    public function updateData($id, $params)
    {
        $medicalInjuredCodesBeg = MedicalInjuredCodesBeg::findOne(['micb_id' => $id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($medicalInjuredCodesBeg)) {
            return 'NO_RECORD';
        } else {
            foreach ($params as $key => $value) {
                if (isset($medicalInjuredCodesBeg->$key) && $value !== $medicalInjuredCodesBeg->$key) {
                    $medicalInjuredCodesBeg->updated_at = $updated_at;
                    $medicalInjuredCodesBeg->$key = $value;
                }
            }
            if ($medicalInjuredCodesBeg->save()) {
                return $medicalInjuredCodesBeg;
            }
        }
    }

    public function deleteData($id)
    {
        $medicalInjuredCodesBeg = MedicalInjuredCodesBeg::find()->where(['micb_id' => $id])->one();

        if (!is_null($medicalInjuredCodesBeg)) {
            return $medicalInjuredCodesBeg->delete();
        }
        return null;
    }

    public function currentTimeMillis()
    {
        list($usec, $sec) = explode(" ", microtime());
        return round(((float) $usec + (float) $sec) * 1000);
    }
}
