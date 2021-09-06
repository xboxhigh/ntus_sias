<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "shoes_basic_info".
 *
 * @property int $sbi_id 流水號
 * @property int $ubi_id 個案編號
 * @property string $created_at 建立日期
 * @property string $updated_at 更新日期
 * @property int $shoe_size 鞋子尺寸[__公分]
 * @property int $shoe_len 鞋長是否適合[1=是；2=否（小於1根手指的距離）；3=否 （大於2根手指的距離）]
 * @property int $brand 鞋子品牌[1=Nike；2=Mizuno; 3=Joola; 4=Nittaku; 5=STIGa; 6=Butterfly(BTY); 7=其他]
 * @property string $brand_other 其他鞋子品牌
 * @property int $flexibility 鞋子是否具柔軟度[1=是;2=否]
 * @property int $air_cushion 鞋跟有無氣墊[1=是;2=否]
 * @property int $lining 鞋跟是否有突起的襯舌[1=是;2=否]
 * @property int $arch_pad 鞋內是否有足弓墊[1=是;2=否]
 * @property int $bottom_design 鞋底設計[1=平面 ；2=凹凸條紋 ；3=有突起物]
 * @property int $training_duration 每日訓練時間約[__小時(若非每天訓練，以一週訓練時數做平均)]
 * @property int $aver_wear 平均一天穿戴此雙鞋子的時間約[__小時]
 * @property int $aver_replace 平均球鞋汰換時間[__月]
 * @property int $worn_1_r 鞋底磨損的部位 （右前1/3內側）[0=無;1=有]
 * @property int $worn_2_r 鞋底磨損的部位 （右中2/3內側）[0=無;1=有]
 * @property int $worn_3_r 鞋底磨損的部位 （右後1/3內側）[0=無;1=有]
 * @property int $worn_4_r 鞋底磨損的部位 （右前1/3外側）[0=無;1=有]
 * @property int $worn_5_r 鞋底磨損的部位 （右中2/3外側）[0=無;1=有]
 * @property int $worn_6_r 鞋底磨損的部位 （右後1/3外側）[0=無;1=有]
 * @property int $worn_1_l 鞋底磨損的部位 （左前1/3內側）[0=無;1=有]
 * @property int $worn_2_l 鞋底磨損的部位 （左中2/3內側）[0=無;1=有]
 * @property int $worn_3_l 鞋底磨損的部位 （左中2/3內側）[0=無;1=有]
 * @property int $worn_4_l 鞋底磨損的部位 （左前1/3外側）[0=無;1=有]
 * @property int $worn_5_l 鞋底磨損的部位 （左中2/3外側）[0=無;1=有]
 * @property int $worn_6_l 鞋底磨損的部位 （左後1/3外側）[0=無;1=有]
 * @property string $foot_length_r 右足長[__公分]
 * @property string $foot_length_l 左足長[__公分]
 * @property string $foot_width_r 右足寬[__公分]
 * @property string $foot_width_l 左足寬[__公分]
 * @property string $arch_height_r 右足弓高度[__公分]
 * @property string $arch_height_l 左足弓高度[__公分]
 *
 * @property ShoesBasicInfo $u
 */
class ShoesBasicInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shoes_basic_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ubi_id'], 'required'],
            [['ubi_id', 'shoe_len', 'brand', 'flexibility', 'air_cushion', 'lining', 'arch_pad', 'bottom_design', 'training_duration', 'aver_wear', 'aver_replace', 'worn_1_r', 'worn_2_r', 'worn_3_r', 'worn_4_r', 'worn_5_r', 'worn_6_r', 'worn_1_l', 'worn_2_l', 'worn_3_l', 'worn_4_l', 'worn_5_l', 'worn_6_l'], 'integer'],
            [['shoe_size', 'foot_length_r', 'foot_length_l', 'foot_width_r', 'foot_width_l', 'arch_height_r', 'arch_height_l'], 'number'],
            [['created_at', 'updated_at'], 'string', 'max' => 20],
            [['brand_other'], 'string', 'max' => 25],
            [['ubi_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersBodyInfo::className(), 'targetAttribute' => ['ubi_id' => 'ubi_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sbi_id' => 'Sbi ID',
            'ubi_id' => 'User Basic ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'shoe_size' => 'Shoe Size',
            'shoe_len' => 'Shoe Len',
            'brand' => 'Brand',
            'brand_other' => 'Brand Other',
            'flexibility' => 'Flexibility',
            'air_cushion' => 'Air Cushion',
            'lining' => 'Lining',
            'arch_pad' => 'Arch Pad',
            'bottom_design' => 'Bottom Design',
            'training_duration' => 'Training Duration',
            'aver_wear' => 'Aver Wear',
            'aver_replace' => 'Aver Replace',
            'worn_1_r' => 'Worn 1 R',
            'worn_2_r' => 'Worn 2 R',
            'worn_3_r' => 'Worn 3 R',
            'worn_4_r' => 'Worn 4 R',
            'worn_5_r' => 'Worn 5 R',
            'worn_6_r' => 'Worn 6 R',
            'worn_1_l' => 'Worn 1 L',
            'worn_2_l' => 'Worn 2 L',
            'worn_3_l' => 'Worn 3 L',
            'worn_4_l' => 'Worn 4 L',
            'worn_5_l' => 'Worn 5 L',
            'worn_6_l' => 'Worn 6 L',
            'foot_length_r' => 'Foot Length R',
            'foot_length_l' => 'Foot Length L',
            'foot_width_r' => 'Foot Width R',
            'foot_width_l' => 'Foot Width L',
            'arch_height_r' => 'Arch Height R',
            'arch_height_l' => 'Arch Height L',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return ShoesBasicInfo::find()
            ->where(['ubi_id' => $id])
            ->one();
    }

    /**
     * {@inheritdoc}
     */
    public static function findAllRecordsJoinWithParams($params)
    {
        $attributes = [];

        foreach ($params as $value) {
            $ubi_id = $value['ubi_id'];
            $attributes['ubi_id'][] = $ubi_id;
        }

        return ShoesBasicInfo::find()
            ->where($attributes)
            ->all();
    }

    public static function findOneRecord($id)
    {
        return ShoesBasicInfo::find()
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

        $shoesBasicInfo = new ShoesBasicInfo;
        $shoesBasicInfo->attributes = $attributes;

        if ($shoesBasicInfo->save()) {
            return $shoesBasicInfo;
        }
        return null;
    }

    public function updateData($ubi_id, $params)
    {
        $shoesBasicInfo = ShoesBasicInfo::findOne(['ubi_id' => $ubi_id]);
        $updated_at = (string) self::currentTimeMillis();

        if (is_null($shoesBasicInfo)) {
            return 'NO_RECORD';
        } else {
            foreach ($params as $key => $value) {
                if (array_key_exists($key, self::attributeLabels()) && $value != $shoesBasicInfo->$key) {
                    $shoesBasicInfo->updated_at = $updated_at;
                    $shoesBasicInfo->$key = $value;
                }
            }
            if ($shoesBasicInfo->save()) {
                return $shoesBasicInfo;
            }
        }
    }

    public function deleteData($id)
    {
        $shoesBasicInfo = ShoesBasicInfo::find()->where(['ubi_id' => $id])->one();

        if (!is_null($shoesBasicInfo)) {
            return $shoesBasicInfo->delete();
        }
        return null;
    }

    public function currentTimeMillis()
    {
        list($usec, $sec) = explode(" ", microtime());
        return round(((float) $usec + (float) $sec) * 1000);
    }
}
