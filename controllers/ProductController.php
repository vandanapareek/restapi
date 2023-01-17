<?php
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

    public function actionProduct() {
	    
	    if (!\yii::$app->request->isPost) {
		    
		  return $this->actionGetProduct();
             }
	    else {
		    
		   return $this->actionCreateProduct();
            }
    }

}
