<?php
/**
 * This OXID module will ask for the Delivery Date during Checkout Process.
 * The Delivery Date will be stored in the Session and later stored in the DB:oxorder
 * The Delivery Date will be shown in the Order - Confirmation Email and on the Thank-You Page 
 *
 * The Delivery Date, which can be selected, is bound to some rules. 
 * 1.) Today if not later than "DEADLINE"
 * 2.) TOMORROW if today is not friday. 
 *
 * DEADLINE is a setting within the Modul. 
 *
 * TODO: 
 * 1.) There needs to be a ADMIN Page, which displayes the Delivery Date within the Order
 * 2.) The Order History needs to be modified. 
 * 3.) If no Delivery Date is possible, it is still possible to finish the order. there needs to be a ERROR Message. 
 * 
 * NOTICE OF LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 3 of the License
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see http://www.gnu.org/licenses/
 *
 * @copyright   Copyright (c) 2013 Peter Wiedeking
 * @author      Peter Wiedeking
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */

/**
 * Metadata version
 */
$sMetadataVersion = '1.1';

$aModule = array(
    'id'          => 'deliverydate',
    'title'       => 'Delivery Date',
    'description' => array(
        'de'      => 'Dieses Modul ermöglicht dem Kunden bei der Bestellung ein Auslieferungsdatum anzugeben. <br> Dieses Datum wird in der Datenbank oxorder gespeichert.
		<br> Das Modul benötigt ein Option und zwar die Deadline für den Tag. ',
        'en'      => 'Saves the delivery date in the order',
    ),
	'lang'        => 'de',
	'thumbnail'	  => 'delivery_date.jpg',
    'email'       => 'peter@wiedeking.net',
	'version'     => '1.0',
    'author'      => 'Peter Wiedeking',
    'extend'      => array(
        'Payment'        => 'deliverydate/controllers/deliverydate_payment',
		'Order'          => 'deliverydate/controllers/deliverydate_order',
		'oxorder'        => 'deliverydate/models/deliverydate_oxorder',
    ),
	'blocks'      => array(
        array('template' => 'page/checkout/payment.tpl',     'block' => 'change_shipping',                       'file' => 'out/blocks/page/checkout/payment'),
        array('template' => 'page/checkout/order.tpl',       'block' => 'shippingAndPayment',                    'file' => 'out/blocks/page/checkout/order'), 
        array('template' => 'page/checkout/thankyou.tpl',    'block' => 'checkout_thankyou_info',                'file' => 'out/blocks/page/checkout/thankyou'), 
        array('template' => 'email/html/order_cust.tpl',     'block' => 'email_html_order_cust_deliveryinfo',    'file' => 'out/blocks/email/html/order_cust'),
		array('template' => 'email/plain/order_cust.tpl',    'block' => 'email_plain_order_cust_deliveryinfo',   'file' => 'out/blocks/email/plain/order_cust'),
		array('template' => 'email/html/order_owner.tpl',    'block' => 'email_html_order_owner_deliveryinfo',   'file' => 'out/blocks/email/html/order_cust'),
        array('template' => 'email/plain/order_owner.tpl',   'block' => 'email_plain_order_owner_deliveryinfo',  'file' => 'out/blocks/email/plain/order_cust')
     ),
	'settings' => array(
        array('group' => 'main', 'name' => 'DeadLine', 'type' => 'str', 'value' => '12'),
    )
);