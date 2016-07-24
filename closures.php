<?php
//一个基本的购物车，包括一些已经添加的商品和每种商品的数量
//其中有一个方法用来计算购物车中所有的商品的总价格
//该方法使用了一个closure作为回调函数

class Cart
{
	//定义三个商品价格常量，实际应用由变量传入获取
	const PRICE_BUTTER = 1.00;
	const PRICE_MILK   = 3.00;
	const PRICE_EGGS   = 6.95;

	//定义一个商品数组，名称为key，数量为value
	protected $products = array();

	//添加商品方法
	public function add($product, $quantity)
	{
		$this->products[$product] = $quantity;
	}

	//获取对应商品的数量
	public function getQuantity($product)
	{
		//如果商品名称存在话，就返回商品的数量，否则返回false
		return isset($this->products[$product]) ? $this->products[$products] : false;
	}

	//计算传入购物车商品总价格
	public function getTotal($tax)
	{
		//定义总价格为0.00
		$total = 0.00;

		//closures回调函数
		$callback = function($quantity, $product) use ($tax, &$total)
		{
			//获取每件商品的单价
			$pricePerItem = constant(__CLASS__ . "::PRICE_" . strtoupper($product));
			//计算总价
			$total += ($pricePerItem * $quantity) * ($tax + 1.0);
		};

		//使用用户自定义函数对数组中的每个元素做回调处理
		array_walk($this->products, $callback);

		return round($total, 2);
	}
}

$my_cart = new Cart;

// 往购物车里添加条目
$my_cart->add('butter', 1);
$my_cart->add('milk', 3);
$my_cart->add('eggs', 6);

// 打出出总价格，其中有 5% 的销售税.
print $my_cart->getTotal(0.05) . "\n";