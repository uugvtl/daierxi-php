<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/6/9
 * Time: 17:05
 */
return [
    'numericality_output_sn'            => '包材出库单号：必须为数字，请重新输入',
    'numericality_payment_status'       => '结款备注：必须为数字，请重新输入',
    'numericality_receipt_mobile'       => '收货人手机号码：必须为数字，请重新输入',
    'numericality_sku_id'               => '成品编号：必须为数字，请重新输入',
    'numericality_output_num'           => '成品数量：必须为数字，请重新输入',

    'presence_delivery_sn'              => '物流单号：不能为空，请重新输入',
    'presence_delivery_name'            => '物流名称：不能为空，请重新输入',
    'presence_receipt_linkman'          => '收货联系人：不能为空，请重新输入',
    'presence_receipt_address'          => '收货详细地址：不能为空，请重新输入'
];

//'sku_id'        => $prefix.$this->t('sku.output', 'numericality_sku_id'),
//                    'output_num'    => $prefix.$this->t('sku.output', 'numericality_output_num'),