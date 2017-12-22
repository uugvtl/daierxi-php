<form action="<?= $this->url->get('index/index') ?>" method="post">
    <div class="B-register">
        <div class="Need">
            <h1 class="clearfix"><span class="fl">用户名称</span><i class="fr"><?= $error_msg ?></i></h1>
            <dl>
                <dt class="fl user-name"></dt>
                <dd class="fr">
                    <input title="用户名称" id="account" name="account" type="text" value="<?= $account ?>" placeholder="请输入用户名">
                </dd>
            </dl>
        </div>
        <div class="Need">
            <h1 class="clearfix"><span>用户密码</span><i class="fr"></i></h1>
            <dl>
                <dt class="fl user-password">
                    <input type="hidden" name="<?= $this->security->getTokenKey() ?>" value="<?= $this->security->getToken() ?>">
                </dt>
                <dd class="fr">
                    <input title="用户密码" id="password" name="password" type="password" value="<?= $password ?>" placeholder="请输入密码">
                </dd>
            </dl>
        </div>

        
            
                
                
            
        
        <input class="B-button" type="submit" name="btn_submit" value="登录">
    </div>
</form>

