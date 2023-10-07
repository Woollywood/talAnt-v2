serverAPILoad();

let description = [
	['Бесплатно если  <100 товаров ', '-0%', '-30%', '-50%', '-70%', '- 87%', '-90%'],
	['Бесплатно', '-0%', '-50%', '-60%', '-70%', '-80%', '-86%', '-96%'],
];

async function serverAPILoad() {
	let response = await fetch('test_api.php');
	if (response.ok) {
		let data = await response.json();
		console.log(data);
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

	elements.forEach((elem, index) => {
		let template;

		if (elem.dataset.fetch === 'first') {
			template = buildTemplateElem(data.user_sklad_price, index, description[0]);
		} else {
			template = buildTemplateElem(data.market_price, index, description[1]);
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
function buildTemplateElem(data, index, description) {
	let dataHTML = `
		<div class="rate-item__col rate-col">
			<div class="rate-col__title">
				Количество <br />
				пользователей / складов
			</div>
			<div class="rate-col__options">
				<div class="options">
					${data
						.map((option, innerIndex) => {
							return `<div class='options__item rate-col__option-item ${
								innerIndex === 0 ? `input-first` : null
							}' ${index == 1 ? `data-min="${option.bol}" data-max="${option.men}"` : null}>
							<input
								id='${String(index + 1) + String(innerIndex + 1)}'
								class='options__input'
								type='radio'
								${innerIndex === 0 ? `checked` : null}
								name='option'
							/>
							<label for='${String(index + 1) + String(innerIndex + 1)}' class='options__label'>
								<span class='options__text'>
									от ${option.bol} до ${option.men}
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
				${data
					.map((option, innerIndex) => {
						return `
						<div class="rate-col__description">
							${description[innerIndex]}
						</div>
					`;
					})
					.join('')}
			</div>
		</div>
	`;

	return dataHTML;
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
