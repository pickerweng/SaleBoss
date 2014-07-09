<?php

namespace SaleBoss\Services\EavSmartAss\Form;

use Illuminate\Database\Eloquent\Collection;

class FormOptionProvider {

	protected $attributes;

	public function setAttributes(Collection $attributes)
	{
		$this->attributes = $attributes;
		return $this;
	}

	public function getOptions()
	{
		$options = array();
		foreach ($this->attributes as $attribute) {
			$options['types'][$attribute->machine_name] ['type'] = $attribute->form_type;
			if (! is_null($attribute->display_name)){
				$options['extras'][$attribute->machine_name]['label'] = $attribute->display_name;
			}
			if (! is_null($attribute->options))
			{
				$options['types'][$attribute->machine_name]['options'] = json_decode($attribute->options, true);
			}
		}
		return $options;
	}
} 