<?php

declare(strict_types=1);

/**
 * TextField class
 */

namespace Framework\Field;

use Framework\Field\Field;

/**
 * TextField
 */
class TextField extends Field
{
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

		$field .= '<textarea class="form-control" id="'
			. $this->name . '" name="' . $this->name . '"';

		$field .= '>';

		if (!empty($this->value)) {

			$field .= htmlspecialchars($this->value);
		}

		$field .= '</textarea>';

		$field = '<div class="form-group">' . $field . '</div>';

		return $field;
	}
}