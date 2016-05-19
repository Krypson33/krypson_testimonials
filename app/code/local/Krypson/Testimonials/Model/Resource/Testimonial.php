<?php
	class Krypson_Testimonials_Model_Resource_Testimonial extends Mage_Core_Model_Resource_Db_Abstract {

		protected function _construct() {
			$this->_init('testimonials/testimonial', 'entity_id');
		}

	}
