<?php

namespace app\models;

use Yii;
use app\models\Product;

/**
 * This is the model class for table "quantity".
 *
 * @property int $ID
 * @property int $Qty
 * @property int $ProductID
 *
 * @property Product $product
 */
class Quantity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quantity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Qty', 'ProductID'], 'required'],
            [['Qty', 'ProductID'], 'integer'],
            [['ProductID'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['ProductID' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Qty' => 'Qty',
            'ProductID' => 'Product ID',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['ID' => 'ProductID']);
    }
}
