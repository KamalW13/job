const table = document.querySelector('.tableData');
const input = document.querySelector(".search input[name='search']");
const buttonSearch = document.querySelector(".search button[name='searchButton' ");
const categorie = document.querySelector(".search select[name='categorie']");

buttonSearch.addEventListener('click', ()=>{

	// Create Object Ajax
	const xhr = new XMLHttpRequest();

	xhr.onreadystatechange = ()=>{
		if (xhr.readyState == 4 && xhr.status == 200) {

			// Mengganti isi div.tableData (home.php: 49 - 72)
			table.innerHTML = xhr.responseText;
		}
	}

	// Mengirim data ke table.php
	xhr.open('GET', '../ajax/table.php?input=' + input.value + '&categorie=' + categorie.value, true);
	xhr.send();
});