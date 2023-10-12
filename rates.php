<?
	
include "functions/xajaxFunctionsCalc_sum.php";

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Тарифы</title>
		<meta charset="UTF-8" />
		<meta name="format-detection" content="telephone=no" />
		<!-- <style>body{opacity: 0;}</style> -->
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/my.css" />
		<link rel="shortcut icon" href="favicon.ico" />
		<!-- <meta name="robots" content="noindex, nofollow"> -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- Инициализация кастомного скролла, если у пользователя отключен JS -->
		<noscript>
			<style>
				[data-simplebar] {
					overflow: auto;
				}
			</style>
		</noscript>
	</head>
<? $xajax->printJavascript("xajax"); ?>
	<body>
		<div class="wrapper">
			<div class="popup-panel" style="display: none">
				<a class="popup-panel__popup-thanks" href="#" data-popup="#thanks-popup"></a>
			</div>

			<header class="header">
				<div class="header__body body-header">
					<div class="body-header__container">
						<div class="body-header__body">
							<div class="body-header__logo">
								<button
									type="button"
									class="menu__icon icon-menu"
									data-da=".body-header__logo, 768, first">
									<span></span>
								</button>
								<a class="body-header__logo-wrapper" href="index.html">
									<img src="img/logo.svg" alt="logo-img" />
								</a>
							</div>
							<div class="body-header__actions">
								<div class="body-header__phone phone-header">
									<a class="phone-header__icon-wrapper" href="tel:89376444446">
										<div class="phone-header__icon _icon-phone"></div>
									</a>
									<div class="phone-header__body">
										<a href="tel:88004442742" class="phone-header__phone">8-800-444-27-42</a>
										<a class="phone-header__link" href="#" data-popup="#phone-request-popup"
											>Заказать звонок</a
										>
									</div>
								</div>
								<a
									class="body-header__login login-header"
									href="#"
									data-popup="#login-control-panel-popup"
									data-da=".bottom-header__mobile, 767.98, first">
									<div class="login-header__icon-wrapper">
										<div class="login-header__icon _icon-log-in"></div>
									</div>
									<div class="login-header__text">Войти</div>
									<div class="login-header__text login-header__text_mobile">Войти в систему</div>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="header__bottom bottom-header">
					<div class="bottom-header__container">
						<div class="bottom-header__body">
							<a class="bottom-header__item" href="index.html">
								<div class="bottom-header__icon-wrapper">
									<div class="bottom-header__icon _icon-web"></div>
								</div>
								<div class="bottom-header__text">Управление бизнесом</div>
							</a>
							<a class="bottom-header__item" href="lp-marketplace.html">
								<div class="bottom-header__icon-wrapper">
									<div class="bottom-header__icon _icon-box"></div>
								</div>
								<div class="bottom-header__text">Продажи маркетплейс</div>
							</a>
							<a class="bottom-header__item" href="mk-marketplace.html">
								<div class="bottom-header__icon-wrapper">
									<div class="bottom-header__icon _icon-statistic"></div>
								</div>
								<div class="bottom-header__text">Контроль продаж</div>
							</a>
							<a class="bottom-header__item" href="rates.html">
								<div class="bottom-header__icon-wrapper">
									<div class="bottom-header__icon _icon-calculator"></div>
								</div>
								<div class="bottom-header__text">Рассчитать стоимость</div>
							</a>
						</div>
						<div class="bottom-header__mobile">
							<a class="bottom-header__item" href="contacts.html">Контакты</a>
						</div>
					</div>
				</div>
			</header>

			<main class="page">
				<section class="page__rates rates">
					<div class="rates__container">
						<div class="rates__body">
							<h2 class="rates__title title-font">Тарифы</h2>
							<div class="rates__row">
								<div class="rates__column" id="rates-system">
									<div class="rate-item">
										<div class="rate-item__top">
											<div class="rate-item__top-title">Подключение к системе</div>
											<div class="rate-item__top-text text-font">
												Интегрируйте систему учета, чтобы упростить работу сотрудников и сразу
												выйти на высокий уровень продажна новой площадке
											</div>
											<div class="rate-item__top-text text-font">
												Базовая цена:
												<span><span data-default-price="system">??</span> ₽/мес.</span>
											</div>
										</div>
										<form class="rate-item__body">
											<div class="rate-item__body-inner" data-fetch="first"></div>
										</form>
									</div>
								</div>
								<div class="rates__column rates__column--marketplace" id="rates-marketplace">
									<div class="rate-item">
										<div class="rate-item__top">
											<div class="rate-item__top-title">Подключение к Marketplace</div>
											<div class="rate-item__top-text text-font">
												Интегрируйте систему учета, чтобы упростить работу сотрудников и сразу
												выйти на высокий уровень продажна новой площадке
											</div>
											<div class="rate-item__top-text text-font">
												Базовая цена:
												<span><span data-default-price="marketplace">??</span> ₽/мес.</span>
											</div>
										</div>
										<div class="rate-item__body">
											<div class="rate-item__body-title">Выберите необходимые маркеты</div>
											<form class="rate-item__marketplace-list">
												<div class="rate-col__options">
													<div class="options options--second">
														<div class="options__item" data-calc="selected-marketplace">
															<input
																id="ozon"
																class="options__input"
																type="checkbox"
																name="option" />
															<label for="ozon" class="options__label"
																><span class="options__text">OZON</span></label
															>
														</div>
														<div class="options__item" data-calc="selected-marketplace">
															<input
																id="yamarket"
																class="options__input"
																type="checkbox"
																name="option" />
															<label for="yamarket" class="options__label"
																><span class="options__text">Яндекс маркет</span></label
															>
														</div>
														<div class="options__item" data-calc="selected-marketplace">
															<input
																id="wildberries"
																class="options__input"
																type="checkbox"
																name="option" />
															<label for="wildberries" class="options__label"
																><span class="options__text">Wildberries</span></label
															>
														</div>
													</div>
												</div>
											</form>
											<div class="rate-item__body-inner" data-fetch="second"></div>
											<div class="options__range-wrapper" data-calc="range">
												<div class="options__range-title">Количество карточек</div>
												<div class="options__range-input">
													<input class="options__range" type="number" value="0" />
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="rates__result">
								Итоговая стоимость:
								<span class="rates__result-value" data-rate-sum>???</span> ₽ /
								день.
							</div>
							<span id="result_span" style="display: none;"></span>
						</div>
					</div>
				</section>
				<section class="page__form-feedback form-feedback form-feedback_pb">
					<div class="form-feedback__container">
						<div class="form-feedback__body">
							<div class="form-feedback__inner">
								<h2 class="form-feedback__title form-feedback__title_white title-font">
									Получите 30 дней без ограничений бесплатно!
								</h2>
								<div class="form-feedback__text form-feedback__text_white text-font">
									Подключитесь к системе TalAnt и оптимизируйте бизнес-процессы
								</div>
								<form
									class="form-feedback__form"
									action="wdh_send_form.php"
									data-ajax="feedback"
									data-form-theme="форма подключения услуг">
									<div class="form-feedback__inputs">
										<div class="input-wrapper">
											<input
												type="text"
												class="form-feedback__input input"
												placeholder="Ваше имя"
												name="name"
												data-required />
											<div class="input-error">* Это поле обязательно к заполнению</div>
										</div>
										<div class="input-wrapper">
											<input
												type="tel"
												class="form-feedback__input input _input-phone-mask"
												name="tel"
												data-required />
											<div class="input-error">* Это поле обязательно к заполнению</div>
										</div>
										<div class="input-wrapper">
											<input
												type="email"
												class="form-feedback__input input"
												placeholder="Ваш E-mail"
												name="email"
												data-required />
											<div class="input-error">* Это поле обязательно к заполнению</div>
										</div>
									</div>
									<button class="form-feedback__button button" type="submit">Подключиться</button>
								</form>
								<div class="form-feedback__private form-feedback__private_grey">
									Нажимая «Ответить на вопросы», я даю согласие на
									<a href="private-policy.html">обработку персональных данных</a>
								</div>
							</div>
							<div class="form-feedback__background-ibg">
								<img
									class="_lazy"
									data-srcset="img/form-feedback/background-02@1x.jpg, img/form-feedback/background-02@2x.jpg 2x, img/form-feedback/background-02@3x.jpg 3x"
									alt="background-img" />
							</div>
						</div>
					</div>
				</section>

				<!-- Cookie -->
				<div class="cookie-agreement">
					<div class="cookie-agreement__container">
						<div class="cookie-agreement__body">
							<div class="cookie-agreement__text text-font">
								Этот сайт использует файлы cookie для хранения данных. Продолжая использовать сайт, вы
								даёте своё согласие на работу с этими файлами. Для получения дополнительной информации,
								пожалуйста, ознакомьтесь с нашей Политикой обработки персональных данных.
							</div>
							<a class="cookie-agreement__button button" href="#">Принять условия</a>
						</div>
					</div>
				</div>
			</main>
			<footer class="footer border-top">
				<div class="footer__main main-footer">
					<div class="main-footer__container">
						<div class="main-footer__body">
							<div class="main-footer__row">
								<a class="main-footer__logo-wrapper" href="index.html">
									<img src="img/logo-footer.svg" alt="logo-img" />
								</a>
								<nav class="main-footer__menu footer-menu">
									<ul class="footer-menu__list">
										<li class="footer-menu__item">
											<a class="footer-menu__link text-font" href="index.html"
												>Управление бизнесом</a
											>
										</li>
										<li class="footer-menu__item">
											<a class="footer-menu__link text-font" href="lp-marketplace.html"
												>Продажи маркетплейс</a
											>
										</li>
										<li class="footer-menu__item">
											<a class="footer-menu__link text-font" href="mk-marketplace.html"
												>Контроль продаж</a
											>
										</li>
										<li class="footer-menu__item">
											<a class="footer-menu__link text-font" href="contacts.html">Контакты</a>
										</li>
									</ul>
								</nav>
							</div>
							<div class="main-footer__feedback feedback-footer">
								<a class="feedback-footer__phone" href="tel:88004442742">8-800-444-27-42</a>
								<div class="feedback-footer__social social-footer">
									<!-- <a class="social-footer__icon-wrapper" href="#">
									<div class="social-footer__icon _icon-vk"></div>
								</a> -->
									<a class="social-footer__icon-wrapper" href="https://www.youtube.com/@talamagin">
										<div class="social-footer__icon _icon-youtube"></div>
									</a>
									<a class="social-footer__icon-wrapper" href="https://t.me/+3-2k2XGyfrU3OWQy">
										<div class="social-footer__icon _icon-telegram"></div>
									</a>
									<a class="social-footer__icon-wrapper" href="mailto:reg@talant.it">
										<div class="social-footer__icon _icon-gmail"></div>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="footer__bottom bottom-footer">
					<div class="bottom-footer__container">
						<div class="bottom-footer__body">
							<div class="bottom-footer__link bottom-footer__link_hover-reset">
								© 2023 Компания TalAnt
							</div>
							<a
								class="bottom-footer__link bottom-footer__link-private bottom-footer__link_underline"
								href="private-policy.html"
								>Политика конфиденциальности</a
							>
							<a class="bottom-footer__link bottom-footer__link_icon _icon-ruso" href="#">Сделано в</a>
						</div>
					</div>
				</div>
			</footer>
		</div>
		<div id="phone-request-popup" aria-hidden="true" class="phone-request-popup popup">
			<div class="phone-request-popup__wrapper popup__wrapper">
				<div class="popup__content">
					<div class="phone-request-popup__content">
						<button data-close type="button" class="phone-request-popup__close popup__close">
							<svg>
								<use xlink:href="img/icons/icons.svg#xmark-bold"></use>
							</svg>
						</button>
						<div class="phone-request-popup__body popup__body">
							<div class="phone-request-popup__title popup-title-font">Заказать звонок</div>
							<div class="phone-request-popup__text text-font">
								Укажите ваши актуальные данные, мы свяжемся с вами в течении 15 минут
							</div>
							<form
								class="phone-request-popup__form"
								action="wdh_send_form.php"
								method="POST"
								data-ajax="feedback"
								data-form-theme="Заказ звонка">
								<div class="input-wrapper">
									<input
										class="phone-request-popup__input input"
										type="text"
										name="name"
										placeholder="Ваше имя"
										data-required />
									<div class="input-error">* Это поле обязательно к заполнению</div>
								</div>

								<div class="input-wrapper">
									<input
										class="phone-request-popupinput input _input-phone-mask"
										name="tel"
										id="tel_form"
										type="tel"
										data-required />
									<div class="input-error">* Это поле обязательно к заполнению</div>
								</div>

								<div class="input-wrapper">
									<input
										class="phone-request-popup__input input"
										type="email"
										placeholder="Ваш E-mail"
										name="email"
										data-required />
									<div class="input-error">* Это поле обязательно к заполнению</div>
								</div>

								<div class="input-wrapper">
									<input
										class="phone-request-popup__input input"
										type="text"
										name="promocode"
										placeholder="Промокод" />
								</div>

								<textarea
									class="my-textarea"
									name="comments"
									id="comments_form"
									placeholder="Комментарий"
									rows="4"></textarea>
								<div class="input-wrapper terms-checkbox-container">
									<input id="terms-checkbox" type="checkbox" name="terms" data-required />
									<div class="input-error">* Это поле обязательно к заполнению</div>
									<label class="phone-request-popup__text text-font" for="terms-checkbox">
										Принимаю условия <a href="private-policy.html">обработки персональных данных</a>
									</label>
								</div>

								<button id="submit-button" class="phone-request-popup__button button" type="submit">
									Оставить заявку
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="thanks-popup" aria-hidden="true" class="thanks-popup popup">
			<div class="thanks-popup__wrapper popup__wrapper">
				<div class="popup__content">
					<div class="thanks-popup__content">
						<button data-close type="button" class="thanks-popup__close popup__close">
							<svg>
								<use xlink:href="img/icons/icons.svg#xmark-bold"></use>
							</svg>
						</button>
						<div class="thanks-popup__body popup__body">
							<div class="thanks-popup__image-wrapper">
								<img src="img/sended.svg" alt="img" />
							</div>
							<div class="thanks-popup__title popup-title-font">Спасибо, Ваша заявка отправлена!</div>
							<div class="thanks-popup__text thanks-popup__text_bold text-font">Долго ждать?</div>
							<div class="thanks-popup__text text-font">Наберите прямо сейчас:</div>
							<a class="thanks-popup__tel popup-title-font" href="tel:89376444446">8 (937) 6-44444-6</a>
							<div class="thanks-popup__text text-font">Или добавляйте в мессенджер:</div>
							<div class="thanks-popup__social">
								<a class="thanks-popup__social-item _icon-vk" href="#"></a>
								<a class="thanks-popup__social-item _icon-youtube" href="#"></a>
								<a class="thanks-popup__social-item _icon-viber" href="#"></a>
								<a class="thanks-popup__social-item _icon-whatsapp" href="#"></a>
								<a class="thanks-popup__social-item _icon-telegram" href="#"></a>
								<a class="thanks-popup__social-item _icon-gmail" href="#"></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="login-control-panel-popup" aria-hidden="true" class="login-control-panel-popup popup">
			<div class="login-control-panel-popup__wrapper popup__wrapper">
				<div class="popup__content">
					<div class="login-control-panel-popup__content">
						<button data-close type="button" class="login-control-panel-popup__close popup__close">
							<svg>
								<use xlink:href="img/icons/icons.svg#xmark-bold"></use>
							</svg>
						</button>
						<div class="login-control-panel-popup__body popup__body">
							<div class="login-control-panel-popup__title">Войти в панель управления</div>
							<form class="login-control-panel-popup__form login-control-panel-popup__form" action="#">
								<div class="input-wrapper">
									<input
										class="login-control-panel-popup__input input"
										type="text"
										placeholder="Введите логин"
										data-required />
									<div class="input-error">* Это поле обязательно к заполнению</div>
								</div>
								<div class="input-wrapper input-wrapper_password">
									<input
										class="login-control-panel-popup__input input"
										type="password"
										placeholder="Введите пароль"
										data-required />
									<div class="input-error">* Это поле обязательно к заполнению</div>
									<button
										class="input-viewpass input-viewpass__viewpass _icon-eye"
										type="button"></button>
								</div>
								<button class="login-control-panel-popup__button button" type="submit">Войти</button>
							</form>
							<div class="login-control-panel-popup__link text-font">
								Перейти на <a href="login.html">страницу входа</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="https://unpkg.com/imask"></script>
		<script src="js/rates.js"></script>
		<script src="js/app.js"></script>

	</body>
</html>