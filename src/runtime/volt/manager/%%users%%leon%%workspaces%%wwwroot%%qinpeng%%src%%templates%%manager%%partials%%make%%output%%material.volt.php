<div style="text-align: center;font-size: xx-large;font-weight: 800;">
    广州缔妆殿堂化妆品有限公司原料合成记录
</div>

<div style="text-align: center;">
    合成料编号：<?= $complex['complex_sn'] ?> <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    生产日期：<?= date('Y-m-d') ?> <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    生产批号：<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    生产重量：<?= $complex['complex_weight'] * constant('NARROW1000') ?>KG
</div>

<table border="1" style="vertical-align: middle;text-align: center;">
    <tr>
        <th colspan="2">项目和原料比例</th>
        <th colspan="2">生产记录</th>
        <th colspan="2">缔妆成本(元/KG)</th>
        <th colspan="2">缔妆原料来源</th>
    </tr>
    <tr>
        <td>源料编号</td>
        <td>百分比</td>
        <td>原料投入记录</td>
        <td>投料监督人</td>
        <td>缔妆原料价格(元/KG)</td>
        <td>缔妆半成品价格(元/KG)</td>
        <td>缔妆原料生产商</td>
        <td>缔妆原料供应商</td>
    </tr>

    <?php foreach ($materials as $k => $v) { ?>
        <tr>
            <td><?= $v['material_sn'] ?></td>
            <td><?= $v['material_percent'] * 1 ?></td>

            <td><?= $v['material_weight'] * constant('NARROW1000') ?></td>
            <td></td>

            <td></td>
            <td></td>

            <td></td>
            <td></td>
        </tr>
    <?php } ?>

    <tr>
        <td>合计</td>
        <td><?= $complex['complex_percent'] * 1 ?></td>
        <td><?= $complex['complex_weight'] * constant('NARROW1000') ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>
工艺：
<div><?= nl2br($complex['complex_craft']) ?></div>