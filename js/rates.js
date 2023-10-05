serverAPILoad();

async function serverAPILoad() {
	let response = await fetch('test_api.php');
	if (response.ok) {
		let data = await response.json();
		renderJson(data);
	}
}

/**
 * Рендер блоков с информацией о тарифах на странице с тарифами
 *
 * @param {object} json Объект с данными о тарифах
 */
function renderJson(json) {
	let jsonConfig = json.config;

	renderElem(
		jsonConfig.user_sklad_price,
		'Подключение к системе',
		'Интегрируйте систему учета, чтобы упростить работу сотрудников и сразу выйти на высокий уровень продажна новой площадке.'
	);
	renderElem(
		jsonConfig.market_price,
		'Подключение к Marketplace',
		'Интегрируйте систему учета, чтобы упростить работу сотрудников и сразу выйти на высокий уровень продажна новой площадке.'
	);
}

/**
 *
 * @param {Array} data Массив данных о тарифах
 * @param {String} title Заголовок выводимого блока с тарифами
 * @param {String} text Текст выводимого блока с тарифами
 */
function renderElem(data, title, text) {
	let elementBody = document.querySelector('[data-fetch]');

	if (!elementBody) {
		return null;
	}

	let buildedTemplateHTML = buildTemplateElem(data, title, text);
	elementBody.insertAdjacentHTML('beforeend', buildedTemplateHTML);
}

/**
 * Генерация шаблона блока с тарифами
 *
 * @param {Array} data Массив данных о тарифах
 * @param {String} title Заголовок выводимого блока с тарифами
 * @param {String} text Текст выводимого блока с тарифами
 * @returns {String} Сгенерированный шаблон блока с тарифами
 */
function buildTemplateElem(data, title, text) {
	let rowsHTML = [];
	data.forEach((item) => {
		let fixedPrice = fixPrice(item.sum * item.men);

		rowsHTML.push(`
		<div class="rate-item__spollers spollers">
			<div class="rate-item__details spollers__item">
				<div class="rate-item__spollers-summary spollers__title">
					<div class="rate-item__content-line rate-item__line">
						<div class="rate-item__content-text text-font">
							От ${item.bol} до ${item.men}
						</div>
						<div class="rate-item__content-text text-font">
							${item.sum} ₽
						</div>
						<div
							class="rate-item__content-text rate-item__content-text_bold text-font">
							${fixedPrice} ₽
						</div>
					</div>
				</div>
			</div>
		</div>
		`);
	});

	let dataHTML = `<div class="rates__column">
							<div class="rate-item">
								<div class="rate-item__top">
									<div class="rate-item__top-title">${title}</div>
									<div class="rate-item__top-text text-font">
										${text}
									</div>
								</div>
								<div class="rate-item__body">
									<div class="rate-item__body-header rate-item__line">
										<div class="rate-item__header-title">Пользователи:</div>
										<div class="rate-item__header-title">Цена за аккаунт:</div>
										<div class="rate-item__header-title">Полная цена:</div>
										<div class="rate-item__header-title"></div>
									</div>
									<div class="rate-item__content">
										${rowsHTML.join('')}
									</div>
								</div>
							</div>
						</div>
	`;

	return dataHTML;
}

/**
 * Корректирует формат вывода полной стоимости тарифа (расставляет проблемы каждые 3 знака)
 *
 * @param {string} price - цена тарифа
 * @returns
 */
function fixPrice(price) {
	let result = '';

	let priceStr = reverseString(String(price));
	for (let i = 0; i < priceStr.length; i++) {
		if (i % 3 === 0) {
			result += ` ${priceStr[i]}`;
		} else {
			result += `${priceStr[i]}`;
		}
	}

	result = reverseString(result);

	return result;
}

/**
 * Переворачивает строку
 *
 * @param {String} str Исходная строка
 * @returns {String} Перевернутая строка
 */
function reverseString(str) {
	return str.split('').reverse().join('');
}
