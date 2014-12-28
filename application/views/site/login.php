<div class="main-container">
    <div class="main-content">

        <div class="row" align="center">
            <img src="static/img/logo.png">
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="login-container">
                    <div class="space-6"></div>
                    <div class="space-6"></div>
                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header blue lighter bigger">
                                        <i class="ace-icon fa fa-home"></i>
                                        Выполните вход в систему
                                    </h4>
                                    <div class="space-6"></div>
                                    <?= validation_errors(); ?>
                                    <?= $this->session->flashdata('message'); ?>
                                    <?= form_open('site/login'); ?>
                                    <fieldset>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input class="form-control" id="login_name" name="login_name" maxlength="50" placeholder="Имя пользователя" value="<?= set_value('login_name') ?>">
                                                <i class="ace-icon fa fa-user"></i>
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input class="form-control" id="login_password" name="login_password" type="password" maxlength="50" placeholder="Пароль" value="<?= set_value('login_password') ?>">
                                                <i class="ace-icon fa fa-lock"></i>
                                            </span>
                                        </label>
                                        <div class="space"></div>
                                        <div class="clearfix">

                                            <button type="submit" id="log" class="width-35 pull-right btn btn-md btn-primary">
                                                <i class="ace-icon fa fa-key"></i>
                                                <span class="bigger-110">Вход</span>
                                            </button>

                                        </div>
                                        <div class="space-4"></div>
                                    </fieldset>
                                    </form>

                                    <div class="space-6"></div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
        <div class="space-6"></div>
        <dl id="dt-list-1" class="col-lg-8 pull-right dl-horizontal" style="color: whitesmoke">
            <dt class="col-lg-6" style="width:200px">Техническая поддержка:</dt>
            <dd>тел: 417-36-37</dd>
            <dd>e-mail: arm-iogv@iac.spb.ru</dd>
        </dl>
    </div>
</div>