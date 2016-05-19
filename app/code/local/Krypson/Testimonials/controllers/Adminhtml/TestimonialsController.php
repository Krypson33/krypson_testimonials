<?php
	class Krypson_Testimonials_Adminhtml_TestimonialsController extends Mage_Adminhtml_Controller_Action {

		protected function _initAction() {
			$this->_title($this->__('Testimonials'))->_title($this->__('Manage Testimonials'));
			$this->loadLayout();

			$this->_setActiveMenu('testimonials');

			$this->_addBreadcrumb(Mage::helper('testimonials')->__('Testmonials'), Mage::helper('testimonials')->__('Testmonials'));
			$this->_addBreadcrumb(Mage::helper('testimonials')->__('Manage Testimonials'), Mage::helper('testimonials')->__('Manage Testimonials'));
			return $this;
		}

		public function indexAction() {
			$this->_initAction()->renderLayout();
		}

		public function gridAction() {
			$this->loadLayout(false)->renderLayout();
		}

		public function editAction() {
			$id = $this->getRequest()->getParam('id');
			$object = Mage::getModel('testimonials/testimonial');
			$object->load($id);
			if (!$object->getId()) {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('testimonials')->__('Testimonial not found.'));
				$this->_redirect('*/*/index');
				return;
			}

			Mage::register('current_edited_testimonial', $object);

			$this->_initAction();
			$this->_title($this->__('Testimonials'))->_title($this->__('Edit Testimonial'));
			$this->renderLayout();
		}

		public function saveAction() {
			if ($this->getRequest()->isPost()) {
				$data = $this->getRequest()->getParams();

				if ($id = $this->getRequest()->getParam('id')) {
					$object = Mage::getModel('testimonials/testimonial')->load($id);
					if ($object->getId()) {
						$object->addData($data);
						try {
							$object->save();
							Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('testimonials')->__('Successfully updated testimonial.'));
						}
						catch(Exception $e) {
							Mage::logException($e);
							Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						}
					}
					else {
						Mage::getSingleton('adminhtml/session')->addError(Mage::helper('testimonials')->__('Testimonial not found.'));
					}
				}
			}
			return $this->_redirect('*/*/index');
		}

		public function deleteAction() {
			$id = $this->getRequest()->getParam('id');
			$object = Mage::getModel('testimonials/testimonial');
			$object->load($id);
			if (!$object->getId()) {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('testimonials')->__('Testimonial not found.'));
			}
			else {
				try {
					$object->delete();
					Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('testimonials')->__('Successfully deleted testimonial.'));
				}
				catch(Exception $e) {
					Mage::logException($e);
					Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				}
			}
			$this->_redirect('*/*/index');
			return;
		}

		protected function _isAllowed() {
			return Mage::getSingleton('admin/session')->isAllowed('testimonials');
		}

	}
