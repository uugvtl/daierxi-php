<div style="text-align: center;font-size: xx-large;font-weight: 800;">
    广州缔妆殿堂化妆品有限公司产品生产记录
</div>
<div style="text-align: center;">
    产品名称：{{ info['sku_name'] }} <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    生产日期：{{ date('Y-m-d') }} <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    生产批号：<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    生产重量：{{ info['sku_weight']*constant('NARROW1000')  }}KG
</div>

<table border="1" style="vertical-align: middle;text-align: center;">
    <tr>
        <th colspan="3">项目和原料比例</th>
        <th colspan="2">生产记录</th>
        <th colspan="2">缔妆成本(元/KG)</th>
        <th colspan="2">缔妆原料来源</th>
    </tr>
    <tr>
        <td>相目</td>
        <td>原料代号</td>
        <td>百分比(%)</td>

        <td>原料投入记录</td>
        <td>投料监督人</td>

        <td>缔妆原料价格(元/KG)</td>
        <td>缔妆半成品价格(元/KG)</td>

        <td>缔妆原料生产商</td>
        <td>缔妆原料供应商</td>
    </tr>
    {% for k,v in complexs %}
        <tr>
            <td>{{ v['complex_item'] }}</td>
            <td>{{ v['complex_sn'] }}</td>
            <td>{{ v['percent']*1 }}</td>

            <td>{{ v['output_num']*constant('NARROW1000') }}</td>
            <td></td>

            <td></td>
            <td></td>

            <td></td>
            <td></td>
        </tr>
    {% endfor %}
    <tr>
        <td colspan="2">合计</td>
        <td>102</td>
        <td>{{ info['sku_weight']*constant('NARROW1000') }}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>

</table>
工艺：
<div>{{ info['recipe_craft']|nl2br }}</div>