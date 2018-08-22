<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 20/08/2018
 * Time: 19:11
 */
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<!-- start: BODY -->
<div class="main-ls animated flipInX">
    <div class="logo">
        <img alt="" src="<?= Url::to('@web/T_assets/images/avatar-1-xl.jpg');?>"/>
    </div>
    <div class="box-ls">

        <div class="user-info">
            <h1><i class="fa fa-lock"></i> <?= $models->PRENOM?> <?= $models->NOM?></h1>
            <span><em>Entrer votre mot de passe pour déverouiller.</em></span>
            <form action="<?= Url::to(['site/lock'])?>">
                <div class="input-group">
                    <input type="password" placeholder="Mot de passe" class="form-control">
                    <span class="input-group-btn">
								<button class="btn btn-green" type="submit">
									<i class="fa fa-chevron-right"></i>
								</button> </span>
                </div>
                <div class="relogin">
                    <a href="<?= Url::to(['site/login'])?>">
                        Ce n'est pas vous?</a>
                </div>
            </form>
        </div>
    </div>
    <div class="copyright">
        <?php echo date('Y') ?> &copy; Dzob.
    </div>
</div>
<!-- end: BODY -->
