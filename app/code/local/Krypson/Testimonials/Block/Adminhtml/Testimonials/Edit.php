<?php
	class Krypson_Testimonials_Block_Adminhtml_Testimonials_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

		public function __construct() {
			parent::__construct();

			$this->_objectId = 'id';

			$this->_blockGroup = 'testimonials';
			$this->_controller = 'adminhtml_testimonials';

			$this->_updateButton('save', 'label', Mage::helper('testimonials')->__('Save Testimonial'));
			$this->_updateButton('delete', 'label', Mage::helper('testimonials')->__('Delete Testimonial'));
		}

	}
