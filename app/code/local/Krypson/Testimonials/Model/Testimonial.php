<?php
	class Krypson_Testimonials_Model_Testimonial extends Mage_Core_Model_Abstract {

		protected function _construct() {
			$this->_init('testimonials/testimonial');
		}

		public function recordNewTestimonial($data) {
			$customer = Mage::getSingleton('customer/session')->getCustomer();
			$this->setDateAdded(Varien_Date::now())
				->setCustomerId($customer->getId())
				->setTestimonialText($data);

			$this->save();
		}

		public function getAllTestimonials() {
			$collection = Mage::getModel('testimonials/testimonial')->getCollection();
			$customerFirstNameAttr = Mage::getModel('eav/entity_attribute')->loadByCode('1', 'firstname');

			$collection->getSelect()
				->join(
					array('ce1' => 'customer_entity_varchar'),
					'ce1.entity_id = main_table.customer_id',
					array('customer_name' => 'value')
					)
				->where('ce1.attribute_id = ' . $customerFirstNameAttr->getAttributeId());

			return $collection;
		}

		public function getApprovedTestimonials() {
			$collection = $this->getAllTestimonials();
			$collection->addFieldToFilter('status', array('eq' => 1));
			return $collection;
		}

	}
