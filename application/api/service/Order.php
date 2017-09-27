<?php
/**
 * Created by PhpStorm.
 * User: mavis
 * Date: 2017/8/16
 * Time: 23:07
 */

namespace app\api\service;

use app\api\model\Product as ProductModel;
use app\api\model\Product;
use app\lib\exception\OrderException;

class Order
{
    //from app
    protected $oProducts;
    //from mysql
    protected $products;

    protected $uid;

    public function place($uid, $oProducts)
    {
        $this->uid = $uid;
        $this->oProducts = $oProducts;
        $this->products = $this->getProductsByOrder($oProducts);

        $status = $this -> getOrderStatus();
        if(!$status['pass']){
            $status['order_id'] = -1;
            return $status;
        }

//        创建订单
        
    }



//    根据订单信息查找真实的商品信息
    private function getProductsByOrder($oProducts)
    {
        $arrProductsID = [];
        foreach ($oProducts as $item) {
            array_push($arrProductsID, $item['product_id']);
        }

        $products = ProductModel::all($arrProductsID)
            ->visible(['id', 'price', 'stock', 'name', 'main_img_url'])
            ->toArray();

        return $products;
    }

    private function getOrderStatus()
    {
        $status = [
            'pass' => true,
            'orderPrice' => 0,
            'pStatusArray' => []
        ];

        foreach ($this->oProducts as $oProduct) {
            $pStatus = $this->getProductStatus(
                $oProduct['product_id'], $oProduct['count'], $this->products
            );
            if (!$pStatus['haveStock']) {
                $status['pass'] = false;
            }
            $status['orderPrice'] += $pStatus[totalPrice];
            array_push($status['pStatusArray'], $pStatus);
        }

        return $status;
    }

    private function getProductStatus($oProductID, $oProductCount, $products)
    {
        $pIndex = -1;
        $pStatus = [
            'id' => null,
            'haveStock' => false,
            'count' => 0,
            'name' => '',
            'totalPrice' => 0
        ];

        for ($i = 0; $i < count($products); $i++) {
            if ($oProductID == $products[$i]['id']) {
                $pIndex = $i;
            }
        }

        if ($pIndex == -1) {
            throw new OrderException([
                'msg' => '订单中含有id为' . $oProductID . '的无效或已下架商品，下单失败',
                'errorCode' => 80002
            ]);
        } else {
            $product = $products[$pIndex];
            $pStatus['id'] = $product['id'];
            $pStatus['name'] = $product['name'];
            $pStatus['count'] = $product['count'];
            $pStatus['totalPrice'] = $product['price'] * $oProductCount;
            if ($product['stock'] - $oProductCount >= 0) {
                $pStatus['haveStock'] = true;
            }

        }
        return $pStatus;
    }

}