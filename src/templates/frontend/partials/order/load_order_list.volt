{% if records is not empty %}
{% for k ,v in records %}
<div class=" div-indent ">
    <div class=" div-indent-con ">
        <h3>{{ v['order_sn'] }}<b></b><span>{{v['order_status_txt']}}</span></h3>
        {% for kk ,vv in v['order_detail'] %}
        <a href="{{url('goods/goods_detail',['goods_id':vv['goods_id']])}}" class=" line ShowHint-con ">
            <div class=" x3 "><img src="{{url.getStatic()~vv['goods_thumb']}}"></div>
            <div class=" x7 indent-title " >
                <p>{{vv['goods_name']}}</p>
                <span>{{vv['product_sn']}}</span>
            </div>
            <div class=" x2 indent-quantity " >
                <p>{{vv['product_price']}}</p>
                <span>×{{vv['product_num']}}</span>
                {% if vv['free_num'] > 0 %}
                    <p style="color: #ef8200">赠品×{{vv['free_num']}}</p>
                {% endif %}
            </div>
        </a>
        {% endfor %}
    </div>
    <div class=" indent-total " >
        <div class=" indent-in-total " >共 <span> {{v['goods_num']}}</span> 件商品 合计：¥<span>{{v['order_amount']}}</span>(含运费¥{{v['delivery_fee']}})</div>
        <div class=" indent-button ">

            {% set handle = handleArr[v['order_status']]%}
            {% if handle is not empty and handle is iterable %}
            {% for item in handle %}

            {% if item['type'] == 'link' %}
            <a href="{{item['handleUlr']}}?order_sn={{v['order_sn']}}" class="button border">{{item['name']}}</a>
            {% elseif item['type'] == 'operate' %}
            <a href="javascript:void(0);" onclick="AppJs.linkSubmit('{{item['handleUlr']}}',{'order_sn':'{{v['order_sn']}}'},'是否确认进行操作？');" class="button border">{{item['name']}}</a>
            {% endif %}

            {%endfor%}
            {%endif %}

        </div>
    </div>
</div>
{% endfor %}
{% endif %}