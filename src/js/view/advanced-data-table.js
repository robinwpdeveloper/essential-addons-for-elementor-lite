class advancedDataTable {
	constructor() {
		// register hooks
		elementorFrontend.hooks.addAction("frontend/element_ready/eael-advanced-data-table.default", this.initFrontend.bind(this));

		if (ea.isEditMode) {
			ea.hooks.doAction("advancedDataTable.initEdit");
		}
	}

	// init frontend features
	initFrontend($scope, $) {
		let table = $scope.context.querySelector(".ea-advanced-data-table");
		let search = $scope.context.querySelector(".ea-advanced-data-table-search");
		let pagination = $scope.context.querySelector(".ea-advanced-data-table-pagination");
		let classCollection = {};

		if (!ea.isEditMode) {
			// search
			this.initTableSearch(table, search, pagination);

			// sort
			this.initTableSort(table, pagination, classCollection);

			// paginated table
			this.initTablePagination(table, pagination, classCollection);

			// woocommerce
			this.initWooFeatures(table);
		}
	}

	// frontend - search
	initTableSearch(table, search, pagination) {
		if (search) {
			search.addEventListener("input", (e) => {
				let input = this.value.toLowerCase();
				let hasSort = table.classList.contains("ea-advanced-data-table-sortable");
				let offset = table.rows[0].parentNode.tagName.toLowerCase() == "thead" ? 1 : 0;

				if (table.rows.length > 1) {
					if (input.length > 0) {
						if (hasSort) {
							table.classList.add("ea-advanced-data-table-unsortable");
						}

						if (pagination && pagination.innerHTML.length > 0) {
							pagination.style.display = "none";
						}

						for (let i = offset; i < table.rows.length; i++) {
							let matchFound = false;

							if (table.rows[i].cells.length > 0) {
								for (let j = 0; j < table.rows[i].cells.length; j++) {
									if (table.rows[i].cells[j].textContent.toLowerCase().indexOf(input) > -1) {
										matchFound = true;
										break;
									}
								}
							}

							if (matchFound) {
								table.rows[i].style.display = "table-row";
							} else {
								table.rows[i].style.display = "none";
							}
						}
					} else {
						if (hasSort) {
							table.classList.remove("ea-advanced-data-table-unsortable");
						}

						if (pagination && pagination.innerHTML.length > 0) {
							pagination.style.display = "";

							let currentPage = pagination.querySelector(".ea-advanced-data-table-pagination-current").dataset.page;
							let startIndex = (currentPage - 1) * table.dataset.itemsPerPage + 1;
							let endIndex = currentPage * table.dataset.itemsPerPage;

							for (let i = 1; i <= table.rows.length - 1; i++) {
								if (i >= startIndex && i <= endIndex) {
									table.rows[i].style.display = "table-row";
								} else {
									table.rows[i].style.display = "none";
								}
							}
						} else {
							for (let i = 1; i <= table.rows.length - 1; i++) {
								table.rows[i].style.display = "table-row";
							}
						}
					}
				}
			});
		}
	}

	// frontend - sort
	initTableSort(table, pagination, classCollection) {
		if (table.classList.contains("ea-advanced-data-table-sortable")) {
			table.addEventListener("click", (e) => {
				if (e.target.tagName.toLowerCase() === "th") {
					let index = e.target.cellIndex;
					let currentPage = 1;
					let startIndex = 1;
					let endIndex = table.rows.length - 1;
					let sort = "";
					let classList = e.target.classList;
					let collection = [];
					let origTable = table.cloneNode(true);

					if (classList.contains("asc")) {
						e.target.classList.remove("asc");
						e.target.classList.add("desc");
						sort = "desc";
					} else if (classList.contains("desc")) {
						e.target.classList.remove("desc");
						e.target.classList.add("asc");
						sort = "asc";
					} else {
						e.target.classList.add("asc");
						sort = "asc";
					}

					if (pagination && pagination.innerHTML.length > 0) {
						currentPage = pagination.querySelector(".ea-advanced-data-table-pagination-current").dataset.page;
						startIndex = (currentPage - 1) * table.dataset.itemsPerPage + 1;
						endIndex =
							endIndex - (currentPage - 1) * table.dataset.itemsPerPage >= table.dataset.itemsPerPage ? currentPage * table.dataset.itemsPerPage : endIndex;
					}

					// collect header class
					classCollection[currentPage] = [];

					table.querySelectorAll("th").forEach((el) => {
						if (el.cellIndex != index) {
							el.classList.remove("asc", "desc");
						}

						classCollection[currentPage].push(el.classList.contains("asc") ? "asc" : el.classList.contains("desc") ? "desc" : "");
					});

					// collect table cells value
					for (let i = startIndex; i <= endIndex; i++) {
						let value;
						let cell = table.rows[i].cells[index];

						if (isNaN(parseInt(cell.innerText))) {
							value = cell.innerText.toLowerCase();
						} else {
							value = parseInt(cell.innerText);
						}

						collection.push({ index: i, value });
					}

					// sort collection array
					if (sort == "asc") {
						collection.sort((x, y) => {
							return x.value > y.value ? 1 : -1;
						});
					} else if (sort == "desc") {
						collection.sort((x, y) => {
							return x.value < y.value ? 1 : -1;
						});
					}

					// sort table
					collection.forEach((row, index) => {
						table.rows[startIndex + index].innerHTML = origTable.rows[row.index].innerHTML;
					});
				}
			});
		}
	}

	// frontend - pagination
	initTablePagination(table, pagination, classCollection) {
		if (table.classList.contains("ea-advanced-data-table-paginated")) {
			let paginationHTML = "";
			let paginationType = pagination.classList.contains("ea-advanced-data-table-pagination-button") ? "button" : "select";
			let currentPage = 1;
			let startIndex = table.rows[0].parentNode.tagName.toLowerCase() == "thead" ? 1 : 0;
			let endIndex = currentPage * table.dataset.itemsPerPage;
			let maxPages = Math.ceil((table.rows.length - 1) / table.dataset.itemsPerPage);

			// insert pagination
			if (maxPages > 1) {
				if (paginationType == "button") {
					for (let i = 1; i <= maxPages; i++) {
						paginationHTML += `<a href="#" data-page="${i}" class="${i == 1 ? "ea-advanced-data-table-pagination-current" : ""}">${i}</a>`;
					}

					pagination.insertAdjacentHTML("beforeend", `<a href="#" data-page="1">&laquo;</a>${paginationHTML}<a href="#" data-page="${maxPages}">&raquo;</a>`);
				} else {
					for (let i = 1; i <= maxPages; i++) {
						paginationHTML += `<option value="${i}">${i}</option>`;
					}

					pagination.insertAdjacentHTML("beforeend", `<select>${paginationHTML}</select>`);
				}
			}

			// make initial item visible
			for (let i = 0; i <= endIndex; i++) {
				if (i >= table.rows.length) {
					break;
				}

				table.rows[i].style.display = "table-row";
			}

			// paginate on click
			if (paginationType == "button") {
				pagination.addEventListener("click", (e) => {
					e.preventDefault();

					if (e.target.tagName.toLowerCase() == "a") {
						currentPage = e.target.dataset.page;
						offset = table.rows[0].parentNode.tagName.toLowerCase() == "thead" ? 1 : 0;
						startIndex = (currentPage - 1) * table.dataset.itemsPerPage + offset;
						endIndex = currentPage * table.dataset.itemsPerPage;

						pagination.querySelectorAll(".ea-advanced-data-table-pagination-current").forEach((el) => {
							el.classList.remove("ea-advanced-data-table-pagination-current");
						});

						pagination.querySelectorAll(`[data-page="${currentPage}"]`).forEach((el) => {
							el.classList.add("ea-advanced-data-table-pagination-current");
						});

						for (let i = offset; i <= table.rows.length - 1; i++) {
							if (i >= startIndex && i <= endIndex) {
								table.rows[i].style.display = "table-row";
							} else {
								table.rows[i].style.display = "none";
							}
						}

						table.querySelectorAll("th").forEach((el, index) => {
							el.classList.remove("asc", "desc");

							if (typeof classCollection[currentPage] != "undefined") {
								if (classCollection[currentPage][index]) {
									el.classList.add(classCollection[currentPage][index]);
								}
							}
						});
					}
				});
			} else {
				if (pagination.hasChildNodes()) {
					pagination.querySelector("select").addEventListener("input", (e) => {
						e.preventDefault();

						currentPage = e.target.value;
						offset = table.rows[0].parentNode.tagName.toLowerCase() == "thead" ? 1 : 0;
						startIndex = (currentPage - 1) * table.dataset.itemsPerPage + offset;
						endIndex = currentPage * table.dataset.itemsPerPage;

						for (let i = offset; i <= table.rows.length - 1; i++) {
							if (i >= startIndex && i <= endIndex) {
								table.rows[i].style.display = "table-row";
							} else {
								table.rows[i].style.display = "none";
							}
						}

						table.querySelectorAll("th").forEach((el, index) => {
							el.classList.remove("asc", "desc");

							if (typeof classCollection[currentPage] != "undefined") {
								if (classCollection[currentPage][index]) {
									el.classList.add(classCollection[currentPage][index]);
								}
							}
						});
					});
				}
			}
		}
	}

	// woocommerce features
	initWooFeatures(table) {
		table.querySelectorAll(".nt_button_woo").forEach((el) => {
			el.classList.add("add_to_cart_button", "ajax_add_to_cart");
		});

		table.querySelectorAll(".nt_woo_quantity").forEach((el) => {
			el.addEventListener("input", (e) => {
				let product_id = e.target.dataset.product_id;
				let quantity = e.target.value;

				$(`.nt_add_to_cart_${product_id}`, $(table)).data("quantity", quantity);
			});
		});
	}
}

ea.hooks.addAction("init", "ea", () => {
	new advancedDataTable();
});
