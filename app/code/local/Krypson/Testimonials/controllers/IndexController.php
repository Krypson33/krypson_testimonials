<?php
	class Krypson_Testimonials_IndexController extends Mage_Core_Controller_Front_Action {

		public function preDispatch() {
			parent::preDispatch();

			$action = strtolower($this->getRequest()->getActionName());
			$openActions = array(
				'index'
				);
			$pattern = '/^(' . implode('|', $openActions) . ')/i';

			if (!preg_match($pattern, $action)) {
				if (!Mage::getSingleton('customer/session')->authenticate($this)) {
					$this->_getSession()->addError($this->__('Please login to your account before posting a testimonial.'));
					$this->setFlag('', 'no-dispatch', true);
				}
			}

		}

		protected function _getSession() {
			return Mage::getSingleton('customer/session');
		}

		public function indexAction() {
			$this->loadLayout()->renderLayout();
		}

		public function newAction() {
			$this->loadLayout()->renderLayout();
		}

		public function postAction() {
			if (!$this->_validateFormKey()) {
				$this->_redirect('*/*/');
				return;
			}

			try {
				$data = $this->getRequest()->getParam('content');
				$error = false;

				if (!Zend_Validate::is(trim($data) , 'NotEmpty')) {
					$error = true;
				}

				if ($error) {
					throw new Exception();
				}

				$object = Mage::getModel('testimonials/testimonial');
				$object->recordNewTestimonial($data);

				Mage::getSingleton('customer/session')->addSuccess($this->__('Your testimonial was successfully posted. Thank you.'));
                $this->_redirect('*/*/');
                return;
			}
			catch(Exception $e) {
				Mage::getSingleton('customer/session')->addError($this->__('Unable to submit your request. Please, try again later'));
				$this->_redirect('*/*/');
				return;
			}
		}

	}
