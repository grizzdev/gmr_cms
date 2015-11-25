<?php

namespace App\Models;

use GrizzDev\CMS\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Product extends Model implements SluggableInterface {

	use SluggableTrait;

	protected $table = 'products';

	protected $fillable = [
		'name',
		'sku',
		'description',
		'short_description',
		'cost',
		'price',
		'sale_price',
		'contribution_amount',
		'total_sales_count',
		'total_sales_amount',
		'active'
	];

	protected $dates = [
		'deleted_at'
	];

	protected $sluggable = [
		'build_from' => 'name',
		'save_to' => 'sku',
	];

	public $listConfig = [
		'id' => [
			'label' => '#',
			'sortable' => false,
			'format' => 'linkFormatter',
			'mobile' => true,
			'switchable' => false
		],
		'name' => [
			'label' => 'Name',
			'sortable' => true,
			'format' => null,
			'mobile' => true,
			'switchable' => false
		],
		'price' => [
			'label' => 'Price',
			'sortable' => true,
			'type' => 'decimal',
			'format' => 'currencyFormatter',
			'mobile' => true,
			'switchable' => false,
		],
		'cost' => [
			'label' => 'Cost',
			'sortable' => true,
			'type' => 'decimal',
			'format' => 'currencyFormatter',
			'mobile' => false,
			'switchable' => false,
		],
		'contribution_amount' => [
			'label' => 'Contribution',
			'sortable' => true,
			'type' => 'decimal',
			'format' => 'currencyFormatter',
			'mobile' => false,
			'switchable' => false,
		],
		'active' => [
			'label' => 'Active',
			'sortable' => true,
			'type' => 'boolean',
			'format' => 'booleanFormatter',
			'mobile' => true,
			'switchable' => false
		],
		'created_at' => [
			'label' => 'Created',
			'sortable' => true,
			'type' => 'datetime',
			'format' => 'datetimeFormatter',
			'mobile' => false,
			'switchable' => true
		],
		'updated_at' => [
			'label' => 'Updated',
			'sortable' => true,
			'type' => 'datetime',
			'format' => 'datetimeFormatter',
			'mobile' => false,
			'switchable' => true
		]
	];

	public function files() {
		return $this->belongsToMany('App\Models\File')->withTimestamps();
	}

	public function categories() {
		return $this->belongsToMany('App\Models\Category')->withTimestamps();
	}

	public function tags() {
		return $this->belongsToMany('App\Models\Tag')->withTimestamps();
	}

	public function attributes() {
		return $this->belongsToMany('App\Models\Attribute')->withTimestamps();
	}

	public function cost() {
		$cost = $this->price;

		foreach ($this->attributes() as $attribute) {
			$cost += $attribute->price;
		}

		return $cost;
	}

	public static function popular($num = -1) {
		return self::orderBy('total_sales_count')->limit($num)->get();
	}

	public static function totals() {
		$count = 0;
		$sales = 0;

		foreach (\App\Order::whereNotIn('status_id', [5,6])->get() as $order) {
			foreach ($order->cart as $item) {
				if ($item->product_id == self::$id) {
					$count++;
					$sales += ($item->price * $item->quantity);
					foreach ($item->attributes as $attribute) {
						foreach ($attribute->options as $option) {
							if (!empty($option->price)) {
								$sales += $option->price;
							}
						}
					}
				}
			}
		}

		return [
			'count' => $count,
			'sales' => $sales
		];
	}

}
