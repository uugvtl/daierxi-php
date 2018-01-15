<?php
namespace App\Datasets\Consts;
/**
 * Class TableConst
 * @package App\Datasets\Consts
 */
final class TableConst
{
    /**
     * 提现规则表
     */
    const WITHDRAW_DEPOSIT_SETTING = 'vz_withdraw_deposit_setting';

    /**
     * 微信分享的时候出现的图标，标题，描述,表
     */
    const WEIXIN_SHARE = 'vz_weixin_share';

    /**
     * 微信的相关appId与密钥表
     */
    const WEIXIN = 'vz_weixin';

    /**
     * 收藏店铺表
     */
    const STOW_SHOP = 'vz_stow_shop';

    /**
     * 收藏商品记录表
     */
    const STOW_GOODS = 'vz_stow_goods';

    /**
     * 系统回复短信模板表
     */
    const SMS = 'vz_sms';

    /**
     * 系统设置表
     */
    const SETTING = 'vz_setting';

    /**
     * 满送礼品表
     */
    const REWARD_PRESENT = 'vz_reward_present';

    /**
     * 满送活动商品
     */
    const REWARD_GOODS = 'vz_reward_goods';

    /**
     * 满送活动表
     */
    const REWARD = 'vz_reward';

    /**
     * 红包金与会员关联绑定表
     */
    const REDBAG_REGISTER = 'vz_redbag_register';

    /**
     * 红包金与商品绑定表
     */
    const REDBAG_GOODS = 'vz_redbag_goods';

    /**
     * 红包金相关设定表
     */
    const REDBAG = 'vz_redbag';

    /**
     * 进货商品表
     */
    const PURCHASE_PRODUCT = 'vz_purchase_product';

    /**
     * 采购单表
     */
    const PURCHASE = 'vz_purchase';

    /**
     * 平台客服表
     */
    const PLATFORM_KEFU = 'vz_platform_kefu';

    /**
     * 金币支付方式表
     */
    const PAYWAY = 'vz_payway';

    /**
     * 页面装修表（品牌首页）
     */
    const PAGE_DECORATION = 'vz_page_decoration';

    /**
     * 邀请码生成表
     */
    const INVITE_CODE_ITEM = 'vz_invite_code_item';

    /**
     * 邀请码设定规则表
     */
    const INVITE_CODE = 'vz_invite_code';

    /**
     * 商品收藏表
     */
    const COLLECTION = 'vz_collection';


    /**
     * 产品分类表
     */
    const WAREHOUSE_CATEGORY = 'vz_warehouse_category';

    /**
     * 产品合成料表
     */
    const WAREHOUSE_COMPLEX = 'vz_warehouse_complex';

    /**
     * 产品盘点表
     */
    const WAREHOUSE_COUNTING = 'vz_warehouse_counting';

    /**
     * 产品制造商表
     */
    const WAREHOUSE_MANUFACTURER = 'vz_warehouse_manufacturer';

    /**
     * 原料库存表
     */
    const WAREHOUSE_MATERIAL = 'vz_warehouse_material';

    /**
     * 合成料与原料的关联表
     */
    const WAREHOUSE_MATERIAL_COMPLEX = 'vz_warehouse_material_complex';

    /**
     * 包材库存表
     */
    const WAREHOUSE_PACKING = 'vz_warehouse_packing';

    /**
     * 库位表（仓库表）
     */
    const WAREHOUSE_POS = 'vz_warehouse_pos';

    /**
     * 成品库存表
     */
    const WAREHOUSE_SKU = 'vz_warehouse_sku';

    /**
     * 产品供应商表
     */
    const WAREHOUSE_SUPPLIER = 'vz_warehouse_supplier';

    /**
     * 原料供应商表
     */
    const WAREHOUSE_VENDOR = 'vz_warehouse_vendor';

    /**
     * 用户表
     */
    const USER = 'vz_user';

    /**
     * 表vz_user的树型结构表，保存的都是user_id的所有相关上级
     */
    const USER_CRUMB_HIGH = 'vz_user_crumb_high';

    /**
     * 表vz_user的树型结构表，保存的都是user_id的所有相关下级
     */
    const USER_CRUMB_LOW = 'vz_user_crumb_low';

    /**
     * 用户扩展表，保存一些不常用的字段
     */
    const USER_EXTRA = 'vz_user_extra';

    /**
     * 用户角色权限表
     */
    const USER_GRADE = 'vz_user_grade';

    /**
     * 下一级帐号申请数量
     */
    const USER_JUNIOR_APPLY = 'vz_user_junior_apply';

    /**
     * 用户登入状态表
     */
    const USER_LOGIN = 'vz_user_login';

    /**
     * 用户的手机通过验证记录表
     */
    const USER_MOBILE_VALIDATION = 'vz_user_mobile_validation';

    /**
     * 用户上下关系表，主要是为了方便查询
     */
    const USER_RELATION = 'vz_user_relation';

    /**
     * 用户角色表
     */
    const USER_ROLE = 'vz_user_role';

    /**
     * 邮递公司表
     */
    const EXPRESS = 'vz_express';

    /**
     * 物流邮费详情表
     */
    const TRANSPORT_DETAIL = 'vz_transport_detail';

    /**
     * 物流邮费表
     */
    const TRANSPORT_POSTAGE = 'vz_transport_postage';

    /**
     * 物流规则表
     */
    const TRANSPORT_RULE = 'vz_transport_rule';

    /**
     * 订单详情的各级用户真实分成记录
     */
    const SUMMARY_ORDER_DETAIL_PROFIT = 'vz_summary_order_detail_profit';

    /**
     * 用户分成总数表统计表
     */
    const SUMMARY_USER_TOTAL_PROFIT = 'vz_summary_user_total_profit';

    /**
     * 包材出库表明细表
     */
    const STOCK_MATERIAL_INPUT = 'vz_stock_material_input';

    /**
     * 包材出库表明细表
     */
    const STOCK_PACKING_DETAIL = 'vz_stock_packing_detail';

    /**
     * 包材出库表明细表
     */
    const STOCK_PACKING_INPUT = 'vz_stock_packing_input';

    /**
     * 包材出库表
     */
    const STOCK_PACKING_OUTPUT = 'vz_stock_packing_output';

    /**
     * 成品出库表的状态确认时间表
     */
    const STOCK_PACKING_STATUS = 'vz_stock_packing_status';

    /**
     * 原料出库出库时，所生产的合成料表
     */
    const STOCK_RECIPE_COMPLEX = 'vz_stock_recipe_complex';

    /**
     * 配方单品出库时的原料出库表
     */
    const STOCK_RECIPE_MATERIAL = 'vz_stock_recipe_material';

    /**
     * 原料出库出库时，所生产的成品表
     */
    const STOCK_RECIPE_SKU = 'vz_stock_recipe_sku';

    /**
     * 成品出库表的状态确认时间表
     */
    const STOCK_RECIPE_STATUS = 'vz_stock_recipe_status';

    /**
     * 成品出库表明细表
     */
    const STOCK_SKU_DETAIL = 'vz_stock_sku_detail';

    /**
     * 成品出库表明细表
     */
    const STOCK_SKU_INPUT = 'vz_stock_sku_input';

    /**
     * 成品出库表
     */
    const STOCK_SKU_OUTPUT = 'vz_stock_sku_output';

    /**
     * 成品出库表的状态确认时间表
     */
    const STOCK_SKU_STATUS = 'vz_stock_sku_status';

    /**
     * 亲朋的店：线上店铺表
     */
    const SHOP = 'vz_shop';

    /**
     * 模板区块
     */
    const SHOP_BLOCK = 'vz_shop_block';

    /**
     * 模板部件
     */
    const SHOP_PART = 'vz_shop_part';

    /**
     * 模板方案
     */
    const SHOP_PLAN = 'vz_shop_plan';

    /**
     * 店铺产品表
     */
    const SHOP_PRODUCT = 'vz_shop_product';

    /**
     * 店铺访问日志表
     */
    const SHOP_VISIT = 'vz_shop_visit';

    /**
     * 渠道表
     */
    const CHANNEL = 'vz_channel';

    /**
     * 渠道分成表:当没有使用金币的时候，使用这上面的分成设置
     */
    const CHANNEL_PROFIT = 'vz_channel_profit';

    /**
     * 当有使用金币的时候，使用金币不同，零售分成也不同
     */
    const CHANNEL_PROFIT_COIN = 'vz_channel_profit_coin';

    /**
     * 利润分成系数表
     */
    const CHANNEL_PROFIT_RATIO = 'vz_profit_ratio';

    /**
     * 美容院项目分成规则表
     */
    const PROJECT_PROFIT_RULE = 'vz_project_profit_rule';

    /**
     * 预存款提现记录表
     */
    const PREDEPOSIT_CASH = 'vz_predeposit_cash';

    /**
     * 预存款日志表
     */
    const PREDEPOSIT_LOG = 'vz_predeposit_log';

    /**
     * 预存款充值信息表
     */
    const PREDEPOSIT_RECHARGE = 'vz_predeposit_recharge';

    /**
     * 用预存款支付的订单表
     */
    const PREDEPOSIT_RECHARGE_ORDER = 'vz_predeposit_recharge_order';

    /**
     * 首单赠品类目表
     */
    const FIRST_ORDER_GIFT = 'vz_first_order_gift';

    /**
     * 首单赠品表
     */
    const FIRST_ORDER_GIFT_GET = 'vz_first_order_gift_get';

    /**
     * 线下订单表
     */
    const OFFLINE_ORDER = 'vz_offline_order';

    /**
     * 线下订单明细表
     */
    const OFFLINE_ORDER_DETAIL = 'vz_offline_order_detail';

    /**
     * 线下订单配货表
     */
    const OFFLINE_ORDER_PREPARE = 'vz_offline_order_prepare';

    /**
     * 订单表
     */
    const ORDER = 'vz_order';

    /**
     * 订单商品使用的亲朋金币表
     */
    const ORDER_COIN = 'vz_order_coin';

    /**
     * 订单明细表
     */
    const ORDER_DETAIL = 'vz_order_detail';

    /**
     * 此表记录订单商品给各级用户的预估收入的分成数
     */
    const ORDER_DETAIL_EXPECT_PROFIT = 'vz_order_detail_expect_profit';

    /**
     * 此表记录订单商品给各级用户的已到帐的分成数
     */
    const ORDER_DETAIL_OVER_PROFIT = 'vz_order_detail_over_profit';

    /**
     * 此表记录订单商品给各级用户的未到帐的分成数
     */
    const ORDER_DETAIL_WAIT_PROFIT = 'vz_order_detail_wait_profit';

    /**
     * 订单处理历史表
     */
    const ORDER_LOG = 'vz_order_log';

    /**
     * 同一个人下单时的合并订单号表
     */
    const ORDER_MERGE = 'vz_order_merge';

    /**
     * 新订单通知信息表
     */
    const ORDER_NOTICE = 'vz_order_notice';

    /**
     * 订单配货表
     */
    const ORDER_PREPARE = 'vz_order_prepare';

    /**
     * 退款，退货原因表
     */
    const ORDER_REASON = 'vz_order_reason';

    /**
     * 退款表
     */
    const ORDER_REFUND = 'vz_order_refund';

    /**
     * 退货表
     */
    const ORDER_RETURN = 'vz_order_return';

    /**
     * 记录第一次满多少钱的进货订单
     */
    const ORDER_SATISFY = 'vz_order_satisfy';

    /**
     * 订单服务指派
     */
    const ORDER_SERVICE_ALLOT = 'vz_order_service_allot';

    /**
     * 会员表
     */
    const MEMBER = 'vz_member';

    /**
     * 会员分成日志表
     */
    const MEMBER_BONUS_LOG = 'vz_member_bonus_log';

    /**
     * 手动修改会员分成余额
     */
    const MEMBER_BONUS_LOG_EXPAND = 'vz_member_bonus_log_expand';

    /**
     * 会员被删除记录表
     */
    const MEMBER_DELETE = 'vz_member_delete';

    /**
     * 会员email验证记录表
     */
    const MEMBER_EMAIL_VALIDATION = 'vz_member_email_validation';

    /**
     * 会员级别
     */
    const MEMBER_LEVEL = 'vz_member_level';

    /**
     * 会员手机号码验证记录
     */
    const MEMBER_MOBILE_VALIDATION = 'vz_member_mobile_validation';

    /**
     * 会员店铺访问记录--主要用来记录会员与用户的店铺绑定
     */
    const MEMBER_SHOP_ACCESS = 'vz_member_shop_access';

    /**
     * 会员与店铺绑定关联表
     */
    const MEMBER_SHOP_RELATED = 'vz_member_shop_related';

    /**
     * 会员与有店铺用户的关联表
     */
    const MEMBER_USER_RELATED = 'vz_member_user_related';

    /**
     * 管理员表，主要是公司人员来操作亲朋系统时使用
     */
    const MANAGER_PROFILE = 'vz_manager_profile';

    /**
     * 管理员组别表，用来区分权限用
     */
    const MANAGER_TEAM = 'vz_manager_team';
    /**
     * 管理员菜单表
     */
    const MANAGER_MENU = 'vz_manager_menu';

    /**
     * 菜单表与操作表的关联表，多对多；vz_manager_menu与vz_manager_operate两个表的关联表
     */
    const MANAGER_MENU__OPERATE = 'vz_manager_menu__operate';

    /**
     * 此表为操作类，主要是记录本系统有多少种操作，操作指的是新增，编辑，删除，导出等等这些内容。
     */
    const MANAGER_OPERATE = 'vz_manager_operate';

    /**
     * 系统平台的菜单与管理员关系表
     */
    const MANAGER_GRANT__MENU = 'vz_manager_grant__menu';

    /**
     * 操作项与组别的关联表
     */
    const MANAGER_GRANT__OPERATE = 'vz_manager_grant__operate';

    /**
     * 配方商品与组别关联表，此表为配方商品授权表
     */
    const MANAGER_GRANT__RECIPE = 'vz_manager_grant__recipe';

    /**
     * 商品表
     */
    const GOODS = 'vz_goods';

    /**
     * 商品图片
     */
    const GOODS_IMAGE = 'vz_goods_image';

    /**
     * 商品属性选项表，此表中保存的都是结点数据
     */
    const GOODS_OPTION = 'vz_goods_option';

    /**
     * 商品属性表
     */
    const GOODS_PROP = 'vz_goods_prop';

    /**
     * 店铺商品二维码
     */
    const GOODS_QRCODE = 'vz_goods_qrcode';

    /**
     * 自营商品配方比例
     */
    const GOODS_RECIPE = 'vz_goods_recipe';

    /**
     * 商品与合成料的关联表
     */
    const GOODS_RECIPE_COMPLEX = 'vz_goods_recipe_complex';

    /**
     * 商品配方详情表
     */
    const GOODS_RECIPE_MATERIAL = 'vz_goods_recipe_material';

    /**
     * 商品SKU表
     */
    const GOODS_SKU = 'vz_goods_sku';

    /**
     * 表vz_goods_option的树型结构表，此表中保存的都是非结点数据
     */
    const GOODS_SKU_CRUMB = 'vz_goods_sku_crumb';

    /**
     * 商品单品的冗余数据表
     */
    const GOODS_SKU_EXTRA = 'vz_goods_sku_extra';

    /**
     * 单品属性选项关联表
     */
    const GOODS_SKU_OPTION = 'vz_goods_sku_option';

    /**
     * 商品与属性名称关联表
     */
    const GOODS_SKU_PROP = 'vz_goods_sku_prop';

    /**
     * 商品套装与SKU关联表
     */
    const GOODS_SKU_SUITE = 'vz_goods_sku_suite';

    /**
     * 商品进货价格表
     */
    const GOODS_SKU_SUPPLY = 'vz_goods_sku_supply';

    /**
     * 商品套装表，主要是在生产管理模块当中使用
     */
    const GOODS_SUITE = 'vz_goods_suite';

    /**
     * 上级用户授权下级用户可以赠与自己金币的用户授权表
     */
    const COIN_GRANT_ASSO = 'vz_coin_grant_asso';

    /**
     * 因金币转帐产生的会员好友关系表
     */
    const COIN_MEMBER_FRIEND = 'vz_coin_member_friend';

    /**
     * 用户购买金币日志表
     */
    const COIN_PURCHASE_LOG = 'vz_coin_purchase_log';

    /**
     * 金币返赠表：会员用来消费购买商品时返赠的金币
     */
    const COIN_REBATE_LOG = 'vz_coin_rebate_log';

    /**
     * 总部回收金币表：会员用来消费购买商品花费金币：收回的金币原则要定期去吧vz_coin_wallet_detail表中的相同wallet_detail_id且coin为0的明细移走
     */
    const COIN_RECOVER_LOG = 'vz_coin_recover_log';

    /**
     * 总部回收金币暂存表：会员用来消费购买商品花费金币，在订单完成前，会员消费金币的记录保存这里，当订单完成后，过了7天的无理由退货再，保存到vz_coin_recover_log表当中
     */
    const COIN_RECOVER_TEMP = 'vz_coin_recover_temp';

    /**
     * 用户转帐金币到会员日志表，会员入帐日志
     */
    const COIN_TRANSFER_IN_LOG = 'vz_coin_transfer_in_log';

    /**
     * 用户转帐金币到会员日志表，用户出帐日志
     */
    const COIN_TRANSFER_OUT_LOG = 'vz_coin_transfer_out_log';

    /**
     * 金币钱包汇总表，主要记录哪些用户给了哪些会员多少金币,是vz_coin_wallet_detail表的总数--此表为冗余表，只作查询使用
     */
    const COIN_WALLET = 'vz_coin_wallet';

    /**
     * 会员对会员的转送金币关联表
     */
    const COIN_WALLET_DETAIL_ASSO = 'vz_coin_wallet_detail_asso';

    /**
     * 失效的金币钱包明细表，个结构同vz_coin_wallet_detail_valid
     */
    const COIN_WALLET_DETAIL_INVALID = 'vz_coin_wallet_detail_invalid';

    /**
     * 有效金币钱包明细表，主要记录哪些用户给了哪些会员多少金币的详情，每一条都记录清楚，正式上线时当金币的有效期过后会返还发放金币的用户。
     */
    const COIN_WALLET_DETAIL_VALID = 'vz_coin_wallet_detail_valid';

    /**
     * 中国行政区域表
     */
    const DISTRICT = 'vz_district';

    /**
     * 行政区域街道表
     */
    const STREET = 'vz_street';


    /**
     * 品牌
     */
    const BRAND = 'vz_brand';


    /**
     * 购物车
     */
    const CART = 'vz_cart';

    /**
     * 系统支持的银行列表
     */
    const CASH_BANK = 'vz_cash_bank';

    /**
     * 进货车
     */
    const SUPPLY_CART = 'vz_supply_cart';

    /**
     * 商品分类
     */
    const CATEGORY = 'vz_category';
}
