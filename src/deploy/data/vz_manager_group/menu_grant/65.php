<?php 
 return array (
  1 => 
  array (
    0 => 
    array (
      'id' => '26',
      'menu_id' => '26',
      'nav_id' => '1',
      'pid' => '0',
      'text' => '仓库管理',
      'merger_text' => '',
      'ctrl' => '',
      'xtype' => '',
      'depth' => '1',
      'pos' => '255',
      'leaf' => '0',
    ),
    1 => 
    array (
      'id' => '40',
      'menu_id' => '40',
      'nav_id' => '1',
      'pid' => '0',
      'text' => '包材管理',
      'merger_text' => '',
      'ctrl' => '',
      'xtype' => '',
      'depth' => '1',
      'pos' => '255',
      'leaf' => '0',
    ),
    2 => 
    array (
      'id' => '41',
      'menu_id' => '41',
      'nav_id' => '1',
      'pid' => '40',
      'text' => '入库报单',
      'merger_text' => '系统平台-&gt;包材管理-&gt;出库申请',
      'ctrl' => 'app.ctrl.packing.input.Apply',
      'xtype' => 'packing-input-apply-panel',
      'depth' => '2',
      'pos' => '255',
      'leaf' => '1',
    ),
    3 => 
    array (
      'id' => '42',
      'menu_id' => '42',
      'nav_id' => '1',
      'pid' => '40',
      'text' => '出库捡货',
      'merger_text' => '系统平台-&gt;包材管理-&gt;捡货出仓',
      'ctrl' => 'app.ctrl.packing.output.Pick',
      'xtype' => 'packing-output-pick-panel',
      'depth' => '2',
      'pos' => '255',
      'leaf' => '1',
    ),
    4 => 
    array (
      'id' => '43',
      'menu_id' => '43',
      'nav_id' => '1',
      'pid' => '40',
      'text' => '出库校对',
      'merger_text' => '系统平台-&gt;包材管理-&gt;出库校对',
      'ctrl' => 'app.ctrl.packing.output.Proof',
      'xtype' => 'packing-output-proof-panel',
      'depth' => '2',
      'pos' => '255',
      'leaf' => '1',
    ),
    5 => 
    array (
      'id' => '46',
      'menu_id' => '46',
      'nav_id' => '1',
      'pid' => '40',
      'text' => '出库历史',
      'merger_text' => '系统平台-&gt;包材管理-&gt;出库历史',
      'ctrl' => 'app.ctrl.packing.output.History',
      'xtype' => 'packing-output-history-panel',
      'depth' => '2',
      'pos' => '255',
      'leaf' => '1',
    ),
    6 => 
    array (
      'id' => '49',
      'menu_id' => '49',
      'nav_id' => '1',
      'pid' => '26',
      'text' => '包材设置',
      'merger_text' => '系统平台-&gt;仓库管理-&gt;包材设置',
      'ctrl' => 'app.ctrl.warehouse.Packing',
      'xtype' => 'warehouse-packing-panel',
      'depth' => '2',
      'pos' => '255',
      'leaf' => '1',
    ),
    7 => 
    array (
      'id' => '50',
      'menu_id' => '50',
      'nav_id' => '1',
      'pid' => '40',
      'text' => '出库列表',
      'merger_text' => '系统平台-&gt;包材管理-&gt;出库列表',
      'ctrl' => 'app.ctrl.packing.output.Records',
      'xtype' => 'packing-output-records-panel',
      'depth' => '2',
      'pos' => '255',
      'leaf' => '1',
    ),
  ),
);