<?php


class Product extends Eloquent  {

    protected $fillable=array('name' ,'productdes','images');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'products';

	

}
