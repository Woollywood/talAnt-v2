serverAPILoad();

class Rates {
	constructor() {
		this._systemPart = document.querySelector('#rates-system');

		this._marketPart = document.querySelector('#rates-marketplace');
		this._marketInput = document.querySelector('.options__range-wrapper input');

		this._marketInput.addEventListener('input', (e) => {
			if (
				!Array.from(document.querySelectorAll('[data-calc="selected-marketplace"] input')).filter(
					(input) => input.checked
				).length
			) {
				document.querySelector('.options.options--second .options__item input').checked = true;
				this.sumMarketSelected();
			}

			this.sumMarketRange();
			this.sumResult();
		});

		this._marketOptions = this._marketPart.querySelectorAll(`[data-calc="selected-marketplace"]`);

		this._resultJson = document.querySelector('#result_span');
		this._resultOutput = document.querySelector('[data-rate-sum]');
		this._resultJsonData = 0;

		this.resultObserver = new MutationObserver((observerEvent) => {
			this._resultJsonData = JSON.parse(observerEvent[0].addedNodes[0].data).sum_itog;
			this._resultOutput.innerHTML = this._resultJsonData;
		});

		this.resultObserver.observe(this._resultJson, {
			childList: true,
		});

		this._sklad = 0;
		this._user = 0;
		this._items = 0;
		this._itemsMarket = 0;
		this._marketsConntected = 0;
	}

	handleEvent(event) {
		if (event.pointerId !== -1) {
			return;
		}

		const target = event.target.closest('[data-calc]');
		const dataType = target?.dataset.calc;

		if (!dataType) {
			return;
		}

		switch (dataType) {
			case 'system':
				this.sumSystem(target);
				break;
			case 'marketplace':
				this.sumMarket(target);
				break;
			case 'range':
				console.log('eqewwq');
				this.sumMarketRange(target);
				break;
			case 'selected-marketplace':
				this.sumMarketSelected(target);
				break;
			default:
				break;
		}

		this.sumResult();

		console.log('calculated...');
	}

	sumSystem(target) {
		this._sklad = +target.dataset.to;
		this._user = +target.dataset.to;
		this._items = +target.dataset.index === 0 ? 0 : 101;
	}

	sumMarketRange() {
		this._itemsMarket = +this._marketInput.value;
	}

	sumMarket(target) {
		this.sumMarketRange();
		this._marketsConntected = Array.from(this._marketOptions).filter(
			(elem) => elem.querySelector('input').checked
		).length;
	}

	sumMarketSelected(target) {
		this._marketsConntected = Array.from(this._marketOptions).filter(
			(elem) => elem.querySelector('input').checked
		).length;
	}

	sumResult() {
		console.log(this);
		xajax_calc_sum(this._sklad, this._user, this._items, this._itemsMarket, this._marketsConntected);
	}
}

let rates = null;

async function serverAPILoad() {
	let response = await fetch('test_api.php');
	if (response.ok) {
		let data = await response.json();
		renderElems(data.config);

		labelsHeightObserve();
		window.addEventListener('resize', labelsHeightObserve);

		rates = new Rates();
		rates.sumSystem(document.querySelector('#rates-system').querySelector('[data-calc]'));
		rates.sumMarket(document.querySelector('#rates-marketplace').querySelector('[data-calc="marketplace"]'));
		rates.sumResult();
		document.addEventListener('click', rates);
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
					${index === 0 && config.count_items_uslovie ? setCondition(data, index) : ``}
					${data
						.map((option, innerIndex) => {
							return `<div class='options__item rate-col__option-item ${
								innerIndex === 0 ? `input-first` : null
							}' ${index == 1 ? `data-min="${option.bol}" data-max="${option.men}"` : null} 
							data-from="${option.bol}" data-to="${option.men}"
							data-calc="${index === 0 ? `system` : `marketplace`}" ${
								index === 0 ? `data-index="${innerIndex + 1}"` : `data-index="${innerIndex}"`
							}>
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

function setCondition(data, index) {
	return `<div class='options__item rate-col__option-item' data-calc="${
		index === 0 ? `system` : `marketplace`
	}" data-from="${data[0].bol}" data-to="${data[0].men}"
	 data-index="0">
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
const resultSpanJson = document.querySelector('#result_span');
const resultSpan = document.querySelector('.rates__result-value');

const rateBodyList = document.querySelectorAll('.rate-item__body');
rateBodyList.forEach((rateBody) => {
	const rateInput = document.querySelector('.options__range-wrapper');

	let imask = null;

	rateBody.addEventListener('click', async (e) => {
		const target = e.target;

		if (
			target.closest('[data-calc="marketplace"]') &&
			target.closest('.options__item').classList.contains('input-first')
		) {
			rateInput.classList.remove('visible');

			const input = rateInput.querySelector('input');
			input.setAttribute('min', 0);
			input.setAttribute('max', 0);
			input.value = 0;
		}

		if (
			target.closest('[data-fetch]') &&
			target.closest('.options__item') &&
			!target.closest('.options__item').classList.contains('input-first') &&
			target.closest('[data-calc="marketplace"]')
		) {
			Array.from(document.querySelectorAll('[data-calc="selected-marketplace"]')).filter(
				(elem) => elem.querySelector('input').checked
			).length !== 0
				? (isMarketSelected = true)
				: (isMarketSelected = false);

			if (!isMarketSelected) {
				document.querySelector('.options.options--second .options__item input').checked = true;
				isMarketSelected = true;
			}

			if (imask) {
				imask.destroy();
			}

			let bodyBox = rateBody.getBoundingClientRect();
			let targetBox = target.closest('.options__item').getBoundingClientRect();

			rateInput.classList.add('visible');
			rateInput.style.top = targetBox.top - bodyBox.top - targetBox.height / 2 + 'px';

			const input = rateInput.querySelector('input');
			const inputMin = target.closest('.options__item').dataset.min;
			const inputMax = target.closest('.options__item').dataset.max;
			input.setAttribute('min', inputMin);
			input.setAttribute('max', inputMax);

			// input.value = target.closest('.options__item').dataset.min;

			imask = IMask(input, {
				mask: Number,
				min: +inputMin,
				max: +inputMax,
				thousandsSeparator: '',
			});
			input.focus();
		}
	});
});

function labelsHeightObserve() {
	let labels = document.querySelectorAll('.options__label');
	for (const label of labels) {
		const labelBox = label.getBoundingClientRect();
		label.style.cssText = `--height: ${labelBox.height}px`;
	}
}
