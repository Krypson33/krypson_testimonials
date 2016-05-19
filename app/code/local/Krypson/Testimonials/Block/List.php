<?php
	class Krypson_Testimonials_Block_List extends Mage_Core_Block_Template {

		public function __construct() {
			parent::__construct();
			$collection = $this->getTestimonialsCollection();
			$this->setCollection($collection);
		}

		public function getTestimonialsCollection() {
			$collection = Mage::getModel('testimonials/testimonial')->getApprovedTestimonials();
			return $collection;
		}

		protected function _prepareLayout() {
			parent::_prepareLayout();
			$pager = $this->getLayout()->createBlock('page/html_pager', 'custom.pager');
			$pager->setAvailableLimit(array(5 => 5, 10 => 10, 20 => 20, 'All' => 'All'));
			$pager->setCollection($this->getCollection());
			$this->setChild('pager', $pager);
			$this->getCollection()->load();
			return $this;
		}

		public function getPagerHtml() {
			return $this->getChildHtml('pager');
		}

	}
