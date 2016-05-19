<?php
	class Krypson_Testimonials_Block_Adminhtml_Testimonials_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

		protected function _prepareForm() {
			$testimonials = Mage::registry('current_edited_testimonial');
        	$customer = Mage::getModel('customer/customer')->load($testimonials->getCustomerId());

        	$form = new Varien_Data_Form(array(
        		'id' => 'edit_form',
        		'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
        		'method' => 'post'
        		));

        	$fieldset = $form->addFieldset(
        		'testimonial_details',
        		array(
        			'legend' => Mage::helper('testimonials')->__('Testimonial Details'),
        			'class' => 'fieldset-wide'
        			)
        		);

        	$fieldset->addField('customer_name', 'note', array(
        		'label' => Mage::helper('testimonials')->__('Customer'),
        		'text' => '<a href="' . $this->getUrl('*/customer/edit', array('id' => $customer->getId())) . '" onclick="this.target=\'blank\'">' . $customer->getName() . '</a>'
        		));

        	$fieldset->addField('testimonial_text', 'textarea', array(
        		'label' => Mage::helper('testimonials')->__('Content'),
        		'name' => 'testimonial_text',
        		'required' => true
        		));

        	$fieldset->addField('status', 'select', array(
        		'label' => Mage::helper('testimonials')->__('Status'),
        		'required' => true,
        		'name' => 'status',
        		'values' => Mage::helper('testimonials')->getOptionArray(),
        		));

        	$form->setUseContainer(true);
        	$form->setValues($testimonials->getData());
        	$this->setForm($form);
        	return parent::_prepareForm();
        }

    }
