<?php
namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class ImageModel extends Model {
	protected $_table = 'hestia_images';
	protected $_fields = [
		'image_id',
		'parent_id',
		'parent_type',
		'path',
		'description',
		'notes',
		'created_at',
		'updated_at',
	];

	public function parent()
	{
		// Polymorphic relationship with parent
		return $this->ancestor($this->parent_type, 'parent_id', (new $this->parent_type())->idField());
	}
}
