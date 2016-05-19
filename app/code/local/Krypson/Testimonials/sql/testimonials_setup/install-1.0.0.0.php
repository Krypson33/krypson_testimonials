<?php
	$installer = $this;

	$installer->startSetup();

	$table = $installer->getConnection()
		->newTable($installer->getTable('testimonials/testimonial'))
		->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
			'identity'  => true,
			'unsigned'  => true,
			'nullable'  => false,
			'primary'   => true,
			), 'Testimonial Id')
		->addColumn('date_added', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
			'nullable' => false
			), 'Testimonial Post Date')
		->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
			'unsigned'  => true,
			'nullable'  => false,
			'default'   => '0',
			), 'Customer Id')
		->addColumn('testimonial_text', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
			'nullable'  => false,
		), 'Testimonial Content')
		->addColumn('status', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
			'nullable'  => false,
			'unsigned' => true,
			'default'   => '0',
		), 'Testimonial Status')
		->addForeignKey($installer->getFkName('testimonials/testimonial', 'customer_id', 'customer/entity', 'entity_id'),
			'customer_id', $installer->getTable('customer/entity'), 'entity_id',
			Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
		->setComment('Krypson Testimonial Manager Table');

	$installer->getConnection()->createTable($table);

	$installer->endSetup();
