<?php
	class Krypson_Testimonials_Block_Adminhtml_Testimonials_Grid extends Mage_Adminhtml_Block_Widget_Grid {

		public function __construct() {
			parent::__construct();
			$this->setId('testimonials_grid');
			$this->setUseAjax(true);
			$this->setDefaultSort('entity_id');
			$this->setDefaultDir('DESC');
			$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection() {
			$collection = Mage::getModel('testimonials/testimonial')->getAllTestimonials();
			$this->setCollection($collection);
			return parent::_prepareCollection();
		}

		protected function _prepareColumns() {

			$this->addColumn('entity_id', array(
				'header'=> Mage::helper('testimonials')->__('ID'),
				'width' => '80px',
				'type'  => 'number',
				'index' => 'entity_id',
				));

			$this->addColumn('date_added', array(
				'header' => Mage::helper('testimonials')->__('Date Added'),
				'index' => 'date_added',
				'type' => 'datetime',
				'width' => '100px',
				));

			$this->addColumn('customer_name', array(
				'header' => Mage::helper('testimonials')->__('Customer'),
				'index' => 'customer_name',
				'filter_index' => 'ce1.value',
				'type' => 'text'
				));

			$this->addColumn('testimonial_text', array(
				'header' => Mage::helper('sales')->__('Content'),
				'index' => 'testimonial_text',
				'type' => 'text'
				));

        	$this->addColumn('status', array(
        		'header' => Mage::helper('testimonials')->__('Status'),
        		'index' => 'status',
        		'type' => 'text'
        		));

        	return parent::_prepareColumns();
        }

        public function getRowUrl($row) {
        	return $this->getUrl('*/*/edit', array('id' => $row->getId()));
        }

        public function getGridUrl() {
        	return $this->getUrl('*/*/grid', array('_current'=>true));
        }

    }
