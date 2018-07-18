<div class="subscription">
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="subscriptionDrop"><i class="material-icons">mail</i><span class="subscr-text">Подписаться</span></button>
    <form action="" id="subscriptionForm">
        <h3 class="text-center">Подписаться на рассылку</h3>
        <div class="input-field">
            <div id="name-subscription" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label for="FNAME" class="mdl-textfield__label">Ваше имя</label>
                <input type="text" class="mdl-textfield__input" name="FNAME" data-required>
            </div>
        </div>
        <div class="input-field">
            <div id="email-subscription" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label for="EMAIL" class="mdl-textfield__label">Ваш email</label>
                <input type="email" class="mdl-textfield__input" name="EMAIL" data-required>
            </div>
        </div>
        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_4e331c48ac31944931664297c_3dd923028f" tabindex="-1" value=""></div>
        <div class="form-action">
            <input type="reset" class="closeSubscription mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--default" value="Я уже">
            <input type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" value="Отправить">
        </div>
    </form>

    <div id="thanksSubscription" class="popup">
        <p id="thanksSubscriptionMsg" class="text-center"></p>
        <p class="text-center"><i class="material-icons" style="font-size: 48px; color:#3a5edc">&#xE86C;</i></p>
        <div class="actions-block">
            <a href="#" class="closeSubscription mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Закрыть</a>
        </div>
    </div>
</div>
