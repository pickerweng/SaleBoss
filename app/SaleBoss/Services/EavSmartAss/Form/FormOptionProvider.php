<?php

namespace SaleBoss\Services\EavSmartAss\Form;

use Illuminate\Database\Eloquent\Collection;

class FormOptionProvider {

	protected $attributes;

	/**
	 * Set attributes
	 *
	 * @param Collection $attributes
	 * @return $this
	 */
	public function setAttributes(Collection $attributes)
	{
		$this->attributes = $attributes;
		return $this;
	}

	/**
	 * Provide options
	 *
	 * @return array
	 */
	public function getOptions()
	{
		$options = array();
		foreach ($this->attributes as $attribute) {
			$options['types'][$attribute->machine_name] ['type'] = $attribute->form_type;
			$options['extras'][$attribute->machine_name]['class'] = 'form-control';
			$options['extras'][$attribute->machine_name]['content_before'] = '<div class="form-group">';
			$options['extras'][$attribute->machine_name]['content_after'] = '</div>';
			if (! is_null($attribute->display_name)){
				$options['extras'][$attribute->machine_name]['label'] = $attribute->display_name;
			}
			if (! is_null($attribute->options))
			{
				$options['types'][$attribute->machine_name]['options'] = $this->decodeOptions($attribute->options);
			}
		}
		$options['submit'] = [
			'show'  =>  true,
			'text'  =>  'ثبت',
			'class' =>  'btn btn-success btn-lg'
		];
		return $options;
	}

	/**
	 * Decoode json
	 *
	 * @param $options
	 * @return array
	 */
	protected function decodeOptions($options)
	{
		$op = [];
		if (empty($options))
		{
			return $op;
		}
		$options = json_decode($options,true);
		foreach($options as $key => $option)
		{
			$op[$option['key']] = $option['value'];
		}
		return $op;
	}

} 