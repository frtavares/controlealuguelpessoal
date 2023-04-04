// $(document).ready(function() {
   
// });


// $('.select2').select2({
//     placeholder: ''
//   });


$(document).ready(function(){
    $('.teste').select2();
   placeholder: 'Selecione' 
});


var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})


var base = location.protocol+'//'+location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');
const csrfToken  = document.getElementsByName('csrf-token')[0].getAttribute('content');
const http = new XMLHttpRequest();

document.addEventListener('DOMContentLoaded', function(){

	var btn_search = document.getElementById('btn_search');
	var form_search = document.getElementById('form_search');
	var category = document.getElementById('category');

	if(btn_search){
		btn_search.addEventListener('click', function(e){
			e.preventDefault();
			if(form_search.style.display === 'block'){
				form_search.style.display = 'none';
			}else{
				form_search.style.display = 'block';
			}
		});
	}



	if(route == "product_add"){
		setSubCategoriesToProducts();
	}

	if(route == "product_edit"){
		setSubCategoriesToProducts();
		var btn_product_file_image = document.getElementById('btn_product_file_image');
		var product_file_image = document.getElementById('product_file_image');
		btn_product_file_image.addEventListener('click', function(){
			product_file_image.click();
		}, false);

		product_file_image.addEventListener('change', function(){
			document.getElementById('form_product_gallery').submit();
		});
	}
	route_active = document.getElementsByClassName('lk-'+route)[0].classList.add('active');

	btn_deleted = document.getElementsByClassName('btn-deleted');
	for(i=0; i < btn_deleted.length; i++){
		btn_deleted[i].addEventListener('click', delete_object);
	}

	if(category){

		category.addEventListener('change', setSubCategoriesToProducts);
	}
});

$(document).ready(function(){
	$('.slick-slider').slick({dots: true, infinite: true, autoplay: true, autoplaySpeed: 2000});
  });



window.onload = function(){
	loader.style.display = 'none'
}



$(document).ready(function(){
	editor_init('editor');
})

function editor_init(field){
	CKEDITOR.replace(field,{
		toolbar: [
		{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo' ] },
		{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'BulletedList', 'Strike', 'Image', 'Link', 'Unlink', 'Blockquote' ] },
		{ name: 'document', items: ['CodeSnippet', 'EmojiPanel','Preview', 'Source'] }
		]
	});
}

function delete_object(e){
	e.preventDefault();
	var object = this.getAttribute('data-object');
	var action =  this.getAttribute('data-action');
	var path = this.getAttribute('data-path');
	var url = base + '/' + path + '/' + object + '/'+ action;
	var title, text, icon;
	if(action == "delete"){
		title = "Tem certeza que quer excluir o registro?";
		text = "Esta ação removerá permanentemente o registro.";

		icon = "warning";
	}
	if(action == "restore"){
		title = "Tem certeza que quer restaurar o registro?";
		text = "Esta ação tornará o registro ativo novamente.";
		icon = "info";
	}
	Swal.fire({
		title: title,
		text: text,
        confirmButtonColor: '#DD6B55',
		icon: icon,
		showCancelButton: true,
	}).then((result) => {
		if (result.value) {
			window.location.href = url;
		}
	});
}

function setSubCategoriesToProducts(){
	var parent_id = category.value;
	var subcategory_actual = document.getElementById('subcategory_actual').value;
	select = document.getElementById('subcategory');
	select.innerHTML = "";
	var url = base + '/admin/md/api/load/subcategories/'+parent_id;
	http.open('GET', url, true);
	http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
	http.send();
	http.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			var data = this.responseText;
			data = JSON.parse(data);
			data.forEach(function(element, index){
				if(subcategory_actual == element.id){
					select.innerHTML += "<option value=\""+element.id+"\" selected>"+element.name+"</option>";
				}else{
					select.innerHTML += "<option value=\""+element.id+"\">"+element.name+"</option>";
				}

			});
		}
	}
}


var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function(){
    $('#sel_iso').select2({
        ajax:{
            url: "{{ route('capa_add')}}",
            type: 'post',
            dataType: 'json',
            delay: 250,
            data: function(){
                return{
                    _token: CSRF_TOKEN,
                    search: params.term
                }
            },
            processResults: function(response){
                return{
                    results: response
                }
            },
            cache: true
        }
    });
});


var base = location.protocol+'//'+location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');

document.addEventListener('DOMContentLoaded', function(){


	if(route == "booking_edit"){
		var btn_booking_file_image = document.getElementById('btn_booking_file_image');
		var booking_file_image = document.getElementById('booking_file_image');
		btn_booking_file_image.addEventListener('click', function(){
			booking_file_image.click();
		}, false);

		booking_file_image.addEventListener('change', function(){
			document.getElementById('form_booking_gallery').submit();
		});
	}
	route_active = document.getElementsByClassName('lk-'+route)[0].classList.add('active');

	btn_deleted = document.getElementsByClassName('btn-deleted');
	for(i=0; i < btn_deleted.length; i++){
		btn_deleted[i].addEventListener('click', delete_object);
	}





});


let checkbox = $('#termos_de_contrato');

if(checkbox.is(":checked")) {
    console.log("1");
} else {
    console.log("0");
}


$(function () {
	$('#product_id').autocomplete({
		source:function(request,response)
		 
			$.getJSON('?term='+request.term,function(data)
				 var array = $.map(data,function(row)
					 return 
						 value:row.id,
						 label:row.name,
						 name:row.name,
						 matricula:row.matricula,
						 
				 )

				 response($.ui.autocomplete.filter(array,request.term));
			)
		,
		minLength:1,
		delay:500,
		select:function(event,ui)
			$('#name').val(ui.item.name)
			$('#matricula').val(ui.item.matricula)
			
		
	})
 })
