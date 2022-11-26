<?php

declare(strict_types=1);

/**
 * StringField class
 */

namespace Framework\Field;

use Framework\Field\Field;

/**
 * StringField
 */
class StringField extends Field
{
	/**
	 * @var string
	 * @access private
	 */
	private $type = 'text';

	/**
	 * {@inheritDoc}
	 */
	public function buildField(): string
	{
		$field = '';

		if (!empty($this->label)) {
			$field .= '<label class="control-label text-dark" for="'
			    .$this->name.'">'.$this->label.'</label>';
		}
		
		if (!empty($this->error)) {

			$field .= '<span class="invalid-feedback d-block font-weight-bold">' . $this->error . '</span>';
		}

		$field .= '<input class="form-control" type="' . $this->type . '" id="'
			.$this->name.'" name="'.$this->name.'"';

		if (!empty($this->value)) {

			$field .= ' value="'.htmlspecialchars($this->value).'"';
		}

		$field .= ' />';

		$field = '<div class="form-group">' . $field . '</div>';

		return $field;
	}

	/**
	 * Get type
	 * @access public
	 * 
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * Set type
	 * @access public
	 * @param string $type
	 * 
	 * @return void
	 */
	public function setType(string $type): void
	{
		$this->type = $type;
	}
}