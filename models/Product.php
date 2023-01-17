<?php

namespace app\models;

use Yii;
use app\models\Quantity;
/**
 * This is the model class for table "product".
 *
 * @property int $ID
 * @property string $Name
 * @property string $Description
 * @property float $Price
 * @property int $Status
 * @property string $CreatedAt
 * @property string $UpdatedAt
 */
class Product extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Name', 'Description', 'Price', 'Status'], 'required'],
            [['Description'], 'string'],
            [['Price'], 'number'],
            [['Status'], 'integer'],
            [['CreatedAt', 'UpdatedAt'], 'safe'],
            [['Name'], 'string', 'max' => 40],
        ];
    }

    public function scenarios()  {     
	    $scenarios = parent::scenarios(); 
	    $scenarios['create'] = ['Name','Description','Price','Status'];
	    return $scenarios; 
    }
   
   
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Name' => 'Name',
            'Description' => 'Description',
            'Price' => 'Price',
            'Status' => 'Status',
            'CreatedAt' => 'Created At',
            'UpdatedAt' => 'Updated At',
        ];
    }

  
    
    public function getQuantity() {  
	    return $this->hasMany(Quantity::className(), ['ProductID' => 'ID']);
    }
}
