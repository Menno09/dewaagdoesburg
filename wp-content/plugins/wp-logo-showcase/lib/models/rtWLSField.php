<?php
/**
 * Field Generator Class
 * @package WP_LOGO_SHOWCASE
 * @since   1.0
 * @author  RadiusTheme
 */

if ( ! class_exists( 'rtWLSField' ) ):
	class rtWLSField {
		private $type;
		private $name;
		private $value;
		private $default;
		private $label;
		private $id;
		private $class;
		private $holderClass;
		private $holderID;
		private $description;
		private $options;
		private $option;
		private $attr;
		private $multiple;
		private $alignment;
		private $placeholder;
		private $blank;

		function __construct() {
		}

		/**
		 * Initiate the predefined property for the field object
		 *
		 * @param $attr
		 */
		private function setArgument( $attr ) {
			$this->type     = isset( $attr['type'] ) ? ( $attr['type'] ? $attr['type'] : 'text' ) : 'text';
			$this->multiple = isset( $attr['multiple'] ) ? ( $attr['multiple'] ? $attr['multiple'] : false ) : false;
			$this->name     = isset( $attr['name'] ) ? ( $attr['name'] ? $attr['name'] : null ) : null;
			$this->name     = isset( $attr['name'] ) ? ( $attr['name'] ? $attr['name'] : null ) : null;
			$this->default  = isset( $attr['default'] ) ? ( $attr['default'] ? $attr['default'] : null ) : null;
			$this->value    = isset( $attr['value'] ) ? ( $attr['value'] ? $attr['value'] : null ) : null;

			if ( ! $this->value ) {
				if ( $this->multiple ) {
					$v = get_post_meta( get_the_ID(), $this->name );
				} else {
					$v = get_post_meta( get_the_ID(), $this->name, true );
				}
				$this->value = ( $v ? $v : $this->default );
			}

			$this->label       = isset( $attr['label'] ) ? ( $attr['label'] ? $attr['label'] : null ) : null;
			$this->id          = isset( $attr['id'] ) ? ( $attr['id'] ? $attr['id'] : null ) : null;
			$this->class       = isset( $attr['class'] ) ? ( $attr['class'] ? $attr['class'] : null ) : null;
			$this->holderClass = isset( $attr['holderClass'] ) ? ( $attr['holderClass'] ? $attr['holderClass'] : null ) : null;
			$this->holderID    = isset( $attr['holderID'] ) ? ( $attr['holderID'] ? $attr['holderID'] : null ) : null;
			$this->placeholder = isset( $attr['placeholder'] ) ? ( $attr['placeholder'] ? $attr['placeholder'] : null ) : null;
			$this->description = isset( $attr['description'] ) ? ( $attr['description'] ? $attr['description'] : null ) : null;
			$this->options     = isset( $attr['options'] ) ? ( $attr['options'] ? $attr['options'] : array() ) : array();
			$this->option      = isset( $attr['option'] ) ? ( $attr['option'] ? $attr['option'] : null ) : null;
			$this->attr        = isset( $attr['attr'] ) ? ( $attr['attr'] ? $attr['attr'] : null ) : null;
			$this->alignment   = isset( $attr['alignment'] ) ? ( $attr['alignment'] ? $attr['alignment'] : null ) : null;
			$this->blank       = ! empty( $attr['blank'] ) ? $attr['blank'] : null;
			$this->class       = $this->class ? $this->class . " rt-form-control" : "rt-form-control";

		}

		/**
		 * Create field
		 *
		 * @param $attr
		 *
		 * @return null|string
		 */
		public function Field( $attr ) {
			$this->setArgument( $attr );
			$field = null;

			switch ( $this->type ) {
				case 'text':
					$field = $this->text();
					break;

				case 'url':
					$field = $this->url();
					break;

				case 'number':
					$field = $this->number();
					break;

				case 'select':
					$field = $this->select();
					break;

				case 'textarea':
					$field = $this->textArea();
					break;

				case 'checkbox':
					$field = $this->checkbox();
					break;

				case 'radio':
					$field = $this->radioField();
					break;

				case 'colorpicker':
					$field = $this->colorPicker();
					break;

				case 'custom_css':
					$field = $this->customCss();
					break;
			}

			return sprintf( '<div class="rt-field-wrapper %s" id="%s">%s<div class="rt-field">%s</div></div>',
				esc_attr( $this->holderClass ),
				esc_attr( $this->holderID ),
				sprintf( '<div class="rt-label">%s</div>', $this->label ? sprintf( '<label for="">%s</label>', $this->label ) : '' ),
				$field
			);
		}

		/**
		 * Generate text field
		 * @return null|string
		 */
		private function text() {

			return sprintf( '<input type="text" class="%s" id="%s" value="%s" name="%s" placeholder="%s" %s />',
				esc_attr( $this->class ),
				esc_attr( $this->id ),
				esc_attr( $this->value ),
				esc_attr( $this->name ),
				esc_attr( $this->placeholder ),
				$this->attr
			);
		}

		/**
		 * Generate color picker
		 * @return null|string
		 */
		private function colorPicker() {

			return sprintf( '<input type="text" class="%s" id="%s" value="%s" name="%s" placeholder="%s" %s />',
				esc_attr( $this->class . " rt-color" ),
				esc_attr( $this->id ),
				esc_attr( $this->value ),
				esc_attr( $this->name ),
				esc_attr( $this->placeholder ),
				$this->attr
			);
		}

		/**
		 * Custom css field
		 * @return null|string
		 */
		private function customCss() {
			$help = '<p class="description" style="color: red">Please use default customizer to add your css. This option is deprecated.</p>';

			return sprintf( '%1$s<div class="rt-custom-css"><div class="custom_css_container"><div name="%2$s" id="%3$s" class="custom-css"></div></div><textarea class="custom_css_textarea hidden" id="%4$s" name="%2$s">%5$s</textarea></div>',
				$help,
				esc_attr( $this->name ),
				'ret-' . mt_rand(),
				esc_attr( $this->id ),
				$this->value
			);
		}

		/**
		 * Generate URL field
		 * @return null|string
		 */
		private function url() {

			return sprintf( '<input type="url" class="%s" id="%s" value="%s" name="%s" placeholder="%s" %s />',
				esc_attr( $this->class ),
				esc_attr( $this->id ),
				esc_attr( $this->value ),
				esc_attr( $this->name ),
				esc_attr( $this->placeholder ),
				$this->attr
			);

		}

		/**
		 * Generate number field
		 * @return null|string
		 */
		private function number() {
			return sprintf( '<input type="number" class="%s" id="%s" value="%s" name="%s" placeholder="%s" %s />',
				esc_attr( $this->class ),
				esc_attr( $this->id ),
				esc_attr( $this->value ),
				esc_attr( $this->name ),
				esc_attr( $this->placeholder ),
				$this->attr
			);

		}

		/**
		 * Generate Drop-down field
		 * @return null|string
		 */
		private function select() {
			$h = null;
			if ( $this->multiple ) {
				$this->class .= ' rt-select2-multiple';
				$this->name  = $this->name . "[]";
				$this->attr  = $this->attr . " multiple='multiple'";
				$this->value = ( is_array( $this->value ) && ! empty( $this->value ) ? $this->value : array() );
			} else {
				$this->value = array( $this->value );
			}
			$options = null;
			if ( $this->blank ) {
				$options .= sprintf( '<option value="">%s</option>', esc_html( $this->blank ) );
			}
			if ( is_array( $this->options ) && ! empty( $this->options ) ) {
				foreach ( $this->options as $key => $value ) {
					$options .= sprintf( '<option value="%s"%s>%s</option>',
						esc_attr( $key ),
						in_array( $key, $this->value ) ? " selected" : null,
						esc_html( $value )
					);
				}
			}

			return sprintf( '<select name="%s" id="%s" class="%s" %s>%s</select>',
				esc_attr( $this->name ),
				esc_attr( $this->id ),
				esc_attr( $this->class ),
				$this->attr,
				$options
			);

		}

		/**
		 * Generate textArea field
		 * @return null|string
		 */
		private function textArea() {

			return sprintf( '<textarea class="rt-textarea %s" id="%s" name="%s" placeholder="%s" %s>%s</textarea>',
				esc_attr( $this->class ),
				esc_attr( $this->id ),
				esc_attr( $this->name ),
				esc_attr( $this->placeholder ),
				$this->attr,
				$this->value
			);
		}

		/**
		 * Generate check box
		 * @return null|string
		 */
		private function checkbox() {
			$h = null;
			if ( $this->multiple ) {
				$this->name  = $this->name . "[]";
				$this->value = ( is_array( $this->value ) && ! empty( $this->value ) ? $this->value : array() );
			}
			if ( $this->multiple ) {
				$labels = null;
				if ( is_array( $this->options ) && ! empty( $this->options ) ) {
					foreach ( $this->options as $key => $value ) {
						$labels .= sprintf( '<label for="%1$s"><input type="checkbox" id="%1$s" name="%2$s" value="%3$s"%5$s>%4$s</label>',
							esc_attr( $this->id . "-" . $key ),
							esc_attr( $this->name ),
							$key,
							esc_html( $value ),
							in_array( $key, $this->value ) ? " checked" : null
						);
					}
				}

				$h = sprintf( '<div class="checkbox-group %s" id="%s">%s</div>',
					esc_attr( $this->alignment ),
					esc_attr( $this->id ),
					$labels
				);
			} else {
				$h = sprintf( '<label><input type="checkbox" id="%s" name="%s" value="%s"%s>%s</label>',
					esc_attr( $this->id ),
					esc_attr( $this->name ),
					1,
					$this->value ? " checked" : null,
					esc_html( $this->option )
				);
			}

			return $h;
		}

		/**
		 * Generate Radio field
		 * @return null|string
		 */
		private function radioField() {
			$labels = null;
			if ( is_array( $this->options ) && ! empty( $this->options ) ) {
				foreach ( $this->options as $key => $value ) {
					$labels .= sprintf( '<label for="%1$s"><input type="radio" id="%1$s" name="%2$s" value="%3$s"%5$s>%4$s</label>',
						esc_attr( $this->id . "-" . $key ),
						esc_attr( $this->name ),
						esc_attr( $key ),
						esc_html( $value ),
						$key == $this->value ? " checked" : null
					);
				}
			}

			return sprintf( '<div class="radio-group %s" id="%s">%s</div>',
				esc_attr( $this->alignment ),
				esc_attr( $this->id ),
				$labels
			);
		}

	}
endif;