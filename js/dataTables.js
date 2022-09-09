$(function(){
	var trigger = $('.navigation ul li a');
	var add = $('.content #add');
	var noti = $('.dropdown-noti-item');
	var notif = $('.dropdown-noti-foot');
	var container = $('#content');

	trigger.on('click', function(){
		var $this = $(this);
		var target = $this.data('target');

		container.load(target + '.php',function() {
			$('#myTable').DataTable({
				"order": [[ 0, "desc" ]],
				"language": {
					"info": "Prikazuje se _PAGE_ od _PAGES_ stranica/e",
					"emptyTable": "Nema podataka u tabeli",
					"aria": {
					"sortAscending": " - klikni/povratak na uzlazno sortiranje",
					"sortDescending": " - klikni/povratak na silazno sortiranje"
					},
					"paginate": {
					"first": "Prva",
					"last": "Posljednja",
					"next": "Sledeća",
					"previous": "Prethodna"
					},
					"infoEmpty": "Nema podataka za prikaz",
					"infoFiltered": " - Filtriranje iz _MAX_ zapisa",
					"lengthMenu": 'Prikaži <select>'+
						'<option value="5">5</option>'+
						'<option value="10">10</option>'+
						'<option value="20">20</option>'+
						'<option value="30">30</option>'+
						'<option value="40">40</option>'+
						'<option value="50">50</option>'+
						'</select> zapisa',
					"sSearch": "Pretraga:",
					"sZeroRecords": "Nije pronađen nijedan odgovarajući zapis"
				}
			});
			let menuToggle = document.querySelector('.opener');
			let navigation = document.querySelector('.navigation');
			let content = document.querySelector('.content');
			menuToggle.onclick = function(){
				menuToggle.classList.toggle('active');
				navigation.classList.toggle('active');
				content.classList.toggle('active');
			}

			const realFileBtn = document.getElementById("custom-file-input");
			const customTxt = document.getElementById("custom-text");
			const customBtn = document.getElementById("custom-button");

			customBtn.addEventListener("click", function(){
				realFileBtn.click();
			});

			customTxt.addEventListener("click", function(){
				realFileBtn.click();
			});

			realFileBtn.addEventListener("change", function(){
				if(realFileBtn.value){
					customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
				}else{
					customTxt.innerHTML = "Niste odabrali sliku.";
				}
			});
		});
		$("head link#themecss").attr("href", 'css/' + target + '.css');
	});

	add.on('click', function(){
		var $this = $(this);
		var target = $this.data('target');

		container.load(target + '.php',function() {
			$('#myTable').DataTable({
				"order": [[ 0, "desc" ]],
				"language": {
					"info": "Prikazuje se _PAGE_ od _PAGES_ stranica/e",
					"emptyTable": "Nema podataka u tabeli",
					"aria": {
					"sortAscending": " - klikni/povratak na uzlazno sortiranje",
					"sortDescending": " - klikni/povratak na silazno sortiranje"
					},
					"paginate": {
					"first": "Prva",
					"last": "Posljednja",
					"next": "Sledeća",
					"previous": "Prethodna"
					},
					"infoEmpty": "Nema podataka za prikaz",
					"infoFiltered": " - Filtriranje iz _MAX_ zapisa",
					"lengthMenu": 'Prikaži <select>'+
						'<option value="5">5</option>'+
						'<option value="10">10</option>'+
						'<option value="20">20</option>'+
						'<option value="30">30</option>'+
						'<option value="40">40</option>'+
						'<option value="50">50</option>'+
						'</select> zapisa',
					"sSearch": "Pretraga:",
					"sZeroRecords": "Nije pronađen nijedan odgovarajući zapis"
				}
			});
			let menuToggle = document.querySelector('.opener');
			let navigation = document.querySelector('.navigation');
			let content = document.querySelector('.content');
			menuToggle.onclick = function(){
				menuToggle.classList.toggle('active');
				navigation.classList.toggle('active');
				content.classList.toggle('active');
			}
			$('.navigation').removeClass('active');
			$('.opener').removeClass('active');
			
			const inputs = document.querySelectorAll('.input');
			function focusFunc(){
				let parent = this.parentNode;
				parent.classList.add('focus');
			}

			function blurFunc(){
				let parent = this.parentNode;
				if(this.value == ""){
					parent.classList.remove('focus');
				}
			}

			inputs.forEach(input => {
				input.addEventListener('focus', focusFunc);
				input.addEventListener('blur', blurFunc);
			})

			const realFileBtn = document.getElementById("custom-file-input");
			const customTxt = document.getElementById("custom-text");
			const customBtn = document.getElementById("custom-button");

			customBtn.addEventListener("click", function(){
				realFileBtn.click();
			});

			customTxt.addEventListener("click", function(){
				realFileBtn.click();
			});

			realFileBtn.addEventListener("change", function(){
				if(realFileBtn.value){
					customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
				}else{
					customTxt.innerHTML = "Niste odabrali sliku.";
				}
			});
		});
		$("head link#themecss").attr("href", 'css/' + target + '.css');
	});

	noti.on('click', function(){
		var $this = $(this);
		var target = $this.data('target');

		let list = document.querySelectorAll('.list');
		for (let i=0; i<list.length; i++){
				$('.navigation').removeClass('active');
				$('.opener').removeClass('active');
				let j=0;
				while(j < list.length){
					list[j++].className = 'list';
				}
				list[2].className = 'list active';
		}

		container.load(target + '.php',function() {
			$('#myTable').DataTable({
				"order": [[ 0, "desc" ]],
				"language": {
					"info": "Prikazuje se _PAGE_ od _PAGES_ stranica/e",
					"emptyTable": "Nema podataka u tabeli",
					"aria": {
					"sortAscending": " - klikni/povratak na uzlazno sortiranje",
					"sortDescending": " - klikni/povratak na silazno sortiranje"
					},
					"paginate": {
					"first": "Prva",
					"last": "Posljednja",
					"next": "Sledeća",
					"previous": "Prethodna"
					},
					"infoEmpty": "Nema podataka za prikaz",
					"infoFiltered": " - Filtriranje iz _MAX_ zapisa",
					"lengthMenu": 'Prikaži <select>'+
						'<option value="5">5</option>'+
						'<option value="10">10</option>'+
						'<option value="20">20</option>'+
						'<option value="30">30</option>'+
						'<option value="40">40</option>'+
						'<option value="50">50</option>'+
						'</select> zapisa',
					"sSearch": "Pretraga:",
					"sZeroRecords": "Nije pronađen nijedan odgovarajući zapis"
				}
			});
			let menuToggle = document.querySelector('.opener');
			let navigation = document.querySelector('.navigation');
			let content = document.querySelector('.content');
			menuToggle.onclick = function(){
				menuToggle.classList.toggle('active');
				navigation.classList.toggle('active');
				content.classList.toggle('active');
			}
		});
		$("head link#themecss").attr("href", 'css/' + target + '.css');
	});

	notif.on('click', function(){
		var $this = $(this);
		var target = $this.data('target');

		let list = document.querySelectorAll('.list');
		for (let i=0; i<list.length; i++){
				$('.navigation').removeClass('active');
				$('.opener').removeClass('active');
				let j=0;
				while(j < list.length){
					list[j++].className = 'list';
				}
				list[2].className = 'list active';
		}

		container.load(target + '.php',function() {
			$('#myTable').DataTable({
				"order": [[ 0, "desc" ]],
				"language": {
					"info": "Prikazuje se _PAGE_ od _PAGES_ stranica/e",
					"emptyTable": "Nema podataka u tabeli",
					"aria": {
					"sortAscending": " - klikni/povratak na uzlazno sortiranje",
					"sortDescending": " - klikni/povratak na silazno sortiranje"
					},
					"paginate": {
					"first": "Prva",
					"last": "Posljednja",
					"next": "Sledeća",
					"previous": "Prethodna"
					},
					"infoEmpty": "Nema podataka za prikaz",
					"infoFiltered": " - Filtriranje iz _MAX_ zapisa",
					"lengthMenu": 'Prikaži <select>'+
						'<option value="5">5</option>'+
						'<option value="10">10</option>'+
						'<option value="20">20</option>'+
						'<option value="30">30</option>'+
						'<option value="40">40</option>'+
						'<option value="50">50</option>'+
						'</select> zapisa',
					"sSearch": "Pretraga:",
					"sZeroRecords": "Nije pronađen nijedan odgovarajući zapis"
				}
			});
			let menuToggle = document.querySelector('.opener');
			let navigation = document.querySelector('.navigation');
			let content = document.querySelector('.content');
			menuToggle.onclick = function(){
				menuToggle.classList.toggle('active');
				navigation.classList.toggle('active');
				content.classList.toggle('active');
			}
		});
		$("head link#themecss").attr("href", 'css/' + target + '.css');
	});
});