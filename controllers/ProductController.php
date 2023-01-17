<?php
/**
 * ProductController for CRUD operations
 *
 *
 * @copyright  2023 Vandana P.
 * @license    https://www.yiiframework.com/license   
 * @author     Vandana Pareek <vandana.pareek42@gmail.com>
 * @version    PHP: 7.4.32 
 * @since      Class available since Release 1.2.0 (17 Jan,2023)
 */ 

namespace app\controllers;   
use Yii;
use yii\rest\Controller;
use app\models\Product;
class ProductController extends Controller{

    public function beforeAction($action) {
	    $this->enableCsrfValidation = false;
	    return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

	/**
	 * actionCreateProduct for adding new product
	 * 
	 * @throws Some_Exception_Class If something interesting cannot happen
	 * @author Vandana Pareek <vandana.pareek42@gmail.com>
	 * @return Status
	 */ 

    public function actionCreateProduct()  
    { 
	    \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
	    $product = new Product();
	    $product->scenario = Product:: SCENARIO_CREATE;
	    $product->attributes = \yii::$app->request->post();
	    if($product->validate())
	    {  
		    $product->save();
		    return array('status' => true, 'data'=> 'Product is successfully added');
	    }
	    else
	    {
		    return array('status'=>false,'data'=>$product->getErrors());
	    }
    }

	/**
	 * actionGetProduct for fetching all products with its quantity
	 * 
	 * @throws Some_Exception_Class If something interesting cannot happen
	 * @author Vandana Pareek <vandana.pareek42@gmail.com>
	 * @return Array
	 */ 

    public function actionGetProduct() { 
	    \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
	    $product = Product::find()->with('quantity')->asArray()->all();
	    
	    if(count($product) > 0 )
	    {
		    return array('status' => true, 'data'=> $product);
	    }
	    else
	    {
		    return array('status'=>false,'data'=> 'No Product Found');
	    }
    }

	/**
	 * actionProduct for fetching all products if request is GET, if POST then add product
	 * 
	 * @throws Some_Exception_Class If something interesting cannot happen
	 * @author Vandana Pareek <vandana.pareek42@gmail.com>
	 * @return Array(GET), Status(POST)
	 */ 

    public function actionProduct() {
	    
	    if (!\yii::$app->request->isPost) {
		    
		  return $this->actionGetProduct();
             }
	    else {
		    
		   return $this->actionCreateProduct();
            }
    }

}
