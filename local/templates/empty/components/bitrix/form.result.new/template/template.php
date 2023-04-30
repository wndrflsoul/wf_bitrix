<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!== true) die();

if ($arResult["isFormErrors"] == "Y") : ?><?= $arResult["FORM_ERRORS_TEXT"]; ?>
<? endif; ?>
<?= $arResult["FORM_NOTE"] ?>
<?if ($arResult["isFormNote"] != "Y")
{
?>

<?= $arResult["FORM_HEADER"] ?>

<div class="contact-form">
   <div class="contact-form__head">
	<!-- Название и описание формы -->
      <div class="contact-form__head-title"><?= $arResult["FORM_TITLE"] ?>
	</div>
      <div class="contact-form__head-text"><?= $arResult["FORM_DESCRIPTION"] ?>
      </div>
   </div>

   <form class="contact-form__form" method="POST">
      <div class="contact-form__form-inputs">
         <?php
		 foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) { // Обработчик массива вопросов
					if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') {

						echo $arQuestion["HTML_CODE"];

					} else { 
						?>
						
         <? if ($arQuestion["STRUCTURE"]["0"]["FIELD_TYPE"] == "text") { ?>
         <div class="input contact-form__input"><label class="input__label" for="medicine_name">
               <div class="input__label-text"><?= $arQuestion["CAPTION"] ?>
                  <? if ($arQuestion["REQUIRED"] == "Y") : ?><?= str_replace("red", "black", $arResult["REQUIRED_SIGN"]); ?>
                  <? endif; ?>
               </div>
               <input type=<?= $arQuestion["STRUCTURE"]["0"]["FIELD_TYPE"] ?> class="input__input"
                  name=<?= "form_" . $arQuestion["STRUCTURE"]["0"]["FIELD_TYPE"] . "_" . $arQuestion["STRUCTURE"]["0"]["ID"] ?>
                  value="" size="0">
               <div class="input__notification">Поле должно содержать не менее 3-х символов</div>
            </label></div>


         <? }}} ?>
	      
      </div>

      <?php foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
				if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') {
					echo $arQuestion["HTML_CODE"];
				} else { ?>

      <?php if ($arQuestion["STRUCTURE"]["0"]["FIELD_TYPE"] == "textarea") { ?>

      <div class="contact-form__form-message">
         <div class="input"><label class="input__label" for="medicine_message">
               <div class="input__label-text"><?= $arQuestion["CAPTION"] ?></div>
               <textarea class="input__input" type="text"
                  name=<?= "form_" . $arQuestion["STRUCTURE"]["0"]["FIELD_TYPE"] . "_" . $arQuestion["STRUCTURE"]["0"]["ID"] ?>
                  value=""></textarea>
               <div class="input__notification"></div>
            </label></div>
      </div>

      <? }}} ?>

      <div class="contact-form__bottom">
         <div class="contact-form__bottom-policy">Нажимая &laquo;Отправить&raquo;, Вы&nbsp;подтверждаете, что
            ознакомлены, полностью согласны и&nbsp;принимаете условия &laquo;Согласия на&nbsp;обработку персональных
            данных&raquo;.
         </div>
         <input class="form-button contact-form__bottom-button"
            <?= (intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : ""); ?> type="submit" name="web_form_submit"
            value="<?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>" />
         <input type="hidden" name="web_form_apply" value="Y" />
      </div>
   </form>
   
</div>
<?
if($arResult["isUseCaptcha"] == "Y")
{
?>
		<tr>
			<th colspan="2"><b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b></th>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>
		</tr>
		<tr>
			<td><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></td>
			<td><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></td>
		</tr>
<?
} // isUseCaptcha
?>
<p>
<?=$arResult["REQUIRED_SIGN"];?> - <?=GetMessage("FORM_REQUIRED_FIELDS")?>
</p>
<?= $arResult["FORM_FOOTER"] ?>
<?
} //endif (isFormNote)