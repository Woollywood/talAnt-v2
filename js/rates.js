serverAPILoad();

async function serverAPILoad() {
	let response = await fetch('https://talant.it/test_api.php');
	console.log(response);
	if (response.ok) {
		let data = await response.json();
		console.log('data');
	}
}