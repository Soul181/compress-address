@extends('layout')

@section('content')
<div class="container">
<div class="col-md-8 offset-md-2">
	<h2 align="center" class="text-color">Короткий адрес - это удобно!</h2>
	<p class="text-color">
		Помогите клиентам быстро найти вашу страницу в интернете. Благодаря короткой ссылке клиентам не придётся использовать длинные url-адреса, 
		занимающие много места. Вы можете придумать своё сокращение из 6 символов и ввести его в нижнее поле. 
		Для этого Вы можете использовать цифры от 0 до 9 и буквы латинского алфавита нижнего регистра от a до z. 
		Сайт сгенерует для Вас новое сокращение, если нижнее поле не будет заполнено. 
		После этого нажмите на кнопку "Сократить" и скопируйте результат.
	</p>
	<div class="container" >	
		<form action="/store" method="POST" class="row">
			{{csrf_field()}}
			<div>	
				<div class="input-group input-group-sm mb-3">
					<input name="input_URL" type="text" class="form-control" value="{{old('input_URL')}}" placeholder="Введите адрес сайта">
				</div>
				<div class="input-group input-group-sm mb-3">
					<input name="input_Short" type="text" class="form-control" value="{{old('input_Short')}}" placeholder="Желаемое сокращение. *Не обязательно для заполнения.">
				</div>
				<div class="input-group input-group-sm mb-3">
					<input class="form-control btn btn-success mb-3" type="submit" value="Сократить">
				</div>
				<div class="input-group input-group-sm mb-3">
		@foreach($errors->all() as $error)
			<span class="text-color">{{$error}}</span> <br>
		@endforeach
				</div>
				<div class="input-group input-group-sm mb-3">
					@if($results != NULL) {
						<p class="text-color">
						Введенному адресу: {{ $results->url }} соответствует сокращение: http://my-url/{{ $results->path }}<br> 
						Дата добавления: {{ $results->created_at}}
						</p>
					}
					@endif
				</div>
			</div>	
		</form>
		
		
		
	</div>
</div>
</div>
@endsection
	
