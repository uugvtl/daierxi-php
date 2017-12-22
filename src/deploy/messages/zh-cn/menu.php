<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/29
 * Time: 14:42
 */
return array(
    'presence_text'         =>'菜单名称：不能为空，请重新输入',

    'numericality_pid'      =>'菜单父级ID：必须为有效数字',
    'numericality_nav_id'   =>'导航ID：必须为有效数字',
    'numericality_depth'    =>'菜单深度：必须为有效数字',
    'numericality_pos'      =>'菜单同级位置：必须为有效数字',
    'numericality_leaf'     =>'菜单叶子菜单项：必须为有效数字',

    'between_pid'           =>'菜单父级ID：必须为自然数',
    'between_nav_id'        =>'导航ID：必须为自然数',
    'between_depth'         =>'菜单深度：必须为自然数',
    'between_pos'           =>'菜单同级位置：必须为自然数',
    'between_leaf'          =>'菜单叶子菜单项：只能为1或是0',

    'leaf_pid'              =>'父级ID：不能为节点，请输入正确的父级ID',
    'none_pid'              =>'父级ID：不能为空，请输入正确的父级ID',
    'not_same_nav_id'       =>'导航ID不同，不能加入新的节点，请重新输入导航ID',
);
