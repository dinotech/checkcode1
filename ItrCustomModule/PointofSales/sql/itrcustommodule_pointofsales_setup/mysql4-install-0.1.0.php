<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('multiplepayment')};
CREATE TABLE {$this->getTable('multiplepayment')} (
  `id` int(11) unsigned NOT NULL auto_increment,
  `order_id` int(11) unsigned NOT NULL,
  `bank_amount` float(11,2) unsigned NOT NULL,
  `check_amount` float(11,2) unsigned NOT NULL,
  `cash_amount` float(11,2) unsigned NOT NULL,
  `voucher` float(11,2) unsigned NOT NULL,
  `promo_code` float(11,2) unsigned NOT NULL,
  `credit_memo` float(11,2) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS {$this->getTable('pos_credit_memo')};
CREATE TABLE {$this->getTable('pos_credit_memo')} (
  `id` int(11) unsigned NOT NULL auto_increment,
  `credit_memo_id` varchar(255) NOT NULL default '',
  `order_id` varchar(255) NOT NULL default '',
  `pos_user` varchar(255) NOT NULL default '',
  `customer_id` int(11) unsigned NOT NULL,
  `credit_memo_amount` float unsigned NOT NULL,
  `exp_date` date NULL,
  `refund_type` varchar(255) NOT NULL default '',
  `bank_amount` float unsigned NOT NULL,
  `check_amount` float unsigned NOT NULL,
  `cash_amount` float unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS {$this->getTable('pos_sales_report')};
CREATE TABLE {$this->getTable('pos_sales_report')} (
  `id` int(11) unsigned NOT NULL auto_increment,
  `order_id` int(11) unsigned NOT NULL,
  `pos_user_id` int(11) unsigned NOT NULL,
  `pos_user_name` varchar(255) NOT NULL default '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS {$this->getTable('temporary_history')};
CREATE TABLE {$this->getTable('temporary_history')} (
  `id` int(11) unsigned NOT NULL auto_increment,
  `temporary_history_id` varchar(255) NOT NULL default '',
  `pos_username` varchar(255) NOT NULL default '',
  `amount` float(11,2) unsigned NOT NULL,
  `qty` int(11) unsigned NOT NULL,
  `time` time NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS {$this->getTable('temporary_product_history')};
CREATE TABLE {$this->getTable('temporary_product_history')} (
  `id` int(11) unsigned NOT NULL auto_increment,
  `temp_id` int(11) unsigned NOT NULL,
  `temp_product_data` longtext,
  `customer_mode` varchar(255) NOT NULL default '',
  `customer_email` varchar(255) NOT NULL default '',
  `customer_fname` varchar(255) NOT NULL default '',
  `customer_lname` varchar(255) NOT NULL default '',
  `customer_company` varchar(255) NOT NULL default '',
  `customer_address1` varchar(255) NOT NULL default '',
  `customer_address2` varchar(255) NOT NULL default '',
  `customer_city` varchar(255) NOT NULL default '',
  `customer_zip` varchar(255) NOT NULL default '',
  `customer_region` varchar(255) NOT NULL default '',
  `customer_mobile` varchar(255) NOT NULL default '',
  `customer_fax` varchar(255) NOT NULL default '',
  `customer_id` int(11) unsigned NOT NULL,
  `order_comments` text,
  `invoice_comments` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



    ");

$installer->endSetup(); 