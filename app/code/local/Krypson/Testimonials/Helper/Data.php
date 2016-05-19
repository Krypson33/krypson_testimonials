<?php
	class Krypson_Testimonials_Helper_Data extends Mage_Core_Helper_Abstract {

		public function getOptionArray() {
			$array = array(
				1 => $this->__('Approved'),
				0 => $this->__('Not Approved'),
				);

			$result = array();
			foreach ($array as $k => $v) {
				$result[] = array(
					'value' => $k,
					'label' => $v
					);
			}
			return $result;
		}

	}
