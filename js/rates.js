serverAPILoad();

async function serverAPILoad() {
	let response = await fetch('test_api.php');
	if (response.ok) {
		let data = await response.json();
		renderElems(data.config);
	}
}

/**
 *
 * @param {Array} data Массив данных о тарифах
 * @param {String} title Заголовок выводимого блока с тарифами
 * @param {String} text Текст выводимого блока с тарифами
 */
function renderElems(data) {
	let elements = document.querySelectorAll('[data-fetch]');

	if (!elements) {
		return null;
	}

	setDefaultPrice(document.getElementById('rates-system'), 'system', data.default_user_sklad_price);
	setDefaultPrice(document.getElementById('rates-marketplace'), 'marketplace', data.default_market_price);

	elements.forEach((elem, index) => {
		let template;

		if (elem.dataset.fetch === 'first') {
			template = buildTemplateElem(data.user_sklad_price, index, data);
		} else {
			template = buildTemplateElem(data.market_price, index, data);
		}

		elem.insertAdjacentHTML('beforeend', template);
	});
}

/**
 * Генерация шаблона блока с тарифами
 *
 * @param {Array} data Массив данных о тарифах
 * @param {String} title Заголовок выводимого блока с тарифами
 * @param {String} text Текст выводимого блока с тарифами
 * @returns {String} Сгенерированный шаблон блока с тарифами
 */
function buildTemplateElem(data, index, config) {
	let dataHTML = `
		<div class="rate-item__col rate-col">
			<div class="rate-col__title">
				Количество <br />
				пользователей / складов
			</div>
			<div class="rate-col__options">
				<div class="options">
					${index === 0 && config.count_items_uslovie ? setCondition(data) : ``}
					${data
						.map((option, innerIndex) => {
							return `<div class='options__item rate-col__option-item ${
								innerIndex === 0 ? `input-first` : null
							}' ${index == 1 ? `data-min="${option.bol}" data-max="${option.men}"` : null}>
							<input
								id='${String(index + 1) + String(innerIndex + 1)}'
								class='options__input'
								type='radio'
								${index > 0 && innerIndex === 0 ? `checked` : null}
								name='option'
							/>
							<label for='${String(index + 1) + String(innerIndex + 1)}' class='options__label'>
								<span class='options__text'>
									${setLabelText(option)}
								</span>
							</label>
						</div>`;
						})
						.join('')}
				</div>
			</div>
		</div>
		<div class="rate-item__sep"></div>
		<div class="rate-item__col rate-col">
			<div class="rate-col__title">Скидка</div>
			<div class="rate-col__descriptions">
				${index === 0 && config.count_items_uslovie ? setConditionDescription(config) : ``}
				${data
					.map((option) => {
						return `
						<div class="rate-col__description">
							${setDiscount(option.discount)}
						</div>
					`;
					})
					.join('')}
			</div>
		</div>
	`;

	return dataHTML;
}

function setCondition(data) {
	return `<div class='options__item rate-col__option-item'>
		<input
			id='condition'
			class='options__input'
			type='radio'
			checked
			name='option'
		/>
		<label for='condition' class='options__label'>
			<span class='options__text'>
				от ${data[0].bol} до ${data[0].men}
			</span>
		</label>
	</div>`;
}

function setConditionDescription(data) {
	return `
		<div class="rate-col__description">
			Бесплатно если  <${data.count_items_uslovie} товаров 
		</div>`;
}

function setLabelText(data) {
	if (data.bol + data.men === 0) {
		return `Без маркетов`;
	} else {
		return `от ${data.bol} до ${data.men}`;
	}
}

function setDiscount(discount) {
	if (discount === 100) {
		return 'Бесплатно';
	} else {
		return `${-discount}%`;
	}
}

function setDefaultPrice(body, type, value) {
	body.querySelector(`[data-default-price="${type}"]`).innerHTML = value;
}

let isMarketSelected = false;

const rateBody = document.querySelector('.rates__column--marketplace').querySelector('.rate-item__body');
const rateInput = document.querySelector('.options__range-wrapper');
rateBody.addEventListener('click', (e) => {
	const target = e.target;

	if (
		target.closest('[data-fetch]') &&
		target.closest('.options__item') &&
		!target.closest('.options__item').classList.contains('input-first')
	) {
		if (!isMarketSelected) {
			document.querySelector('.options.options--second .options__item input').checked = true;
			isMarketSelected = true;
		}

		let bodyBox = rateBody.getBoundingClientRect();
		let targetBox = target.closest('.options__item').getBoundingClientRect();

		rateInput.classList.add('visible');
		rateInput.style.top = targetBox.top - bodyBox.top - targetBox.height / 2 + 'px';

		const input = rateInput.querySelector('input');
		input.setAttribute('min', target.closest('.options__item').dataset.min);
		input.setAttribute('max', target.closest('.options__item').dataset.max);
		input.value = target.closest('.options__item').dataset.min;
		input.focus();
	}
});
