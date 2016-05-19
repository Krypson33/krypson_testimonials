<?php
	class Krypson_Testimonials_Block_Link extends Mage_Core_Block_Template {

		public function addTestimonialsLink() {
			$parentBlock = $this->getParentBlock();
			if ($parentBlock && Mage::helper('core')->isModuleOutputEnabled('Krypson_Testimonials')) {
				$text = $this->__('Testimonials');
				$parentBlock->addLink(
					$text, 'testimonials', $text,
					true, array('_secure' => true), 60, null,
					'class="top-link-testimonials"'
					);
			}
			return $this;
		}

	}
