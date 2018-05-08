@extends('layouts.autoschool')
@section('content')

			<div class="content error profile">
				<h1><a href="#">Главная</a> / Ученики / Карточка ученика</h1>
				<div class="cardstudent">
					<ul>
						<li><img src="/img/prof-photo-full.png"></li>
						<li><h5>Иванов Иван Васильевич</h5></li>
						<li>
							<span>Дата и время экзамена</span>
							<span><img src="/img/clock.png">02.09.2017 18:00</span>
						</li>
						<li>
							<a href="#">Статистика зачетов</a>
							<a href="#">Статистика экзамена</a>
						</li>
						<li><img src="/img/location.png"><p>Россия, г. Киров, ул. Урицкого, дом 6</p></li>
						<li><img src="/img/tel.png"><a href="#">+7 (495)<span> 999-99-99</span></a></li>
						<li><img src="/img/mail.png"><a href="#">ivan@mail.ru</a></li>
					</ul>
				</div>
				<div class="blocksavestudent">
					<ul>
						<li>
							<p>Филиал:</p>
							<select class="select">
								<option>Главный</option>
								<option>Второстепенный</option>
                        	</select>
						</li>
						<li>
							<p>Группа:</p>
							<select class="select">
								<option>ИД-21</option>
								<option>ИД-22</option>
                        	</select>						
						</li>
						<li>
							<p>Метод оплаты:</p>
							<p>Online</p>
						</li>
						<li>
							<p>Дата оплаты:</p>
							<p>01.12.2017</p>
						</li>
						<li>
							<p>Дата регистрации в системе:</p>
							<p>01.12.2017</p>
						</li>
					</ul>
				</div>
				<div class="commentstudent">
					<ul>
						<li><textarea placeholder="Комментарий"></textarea></li>
						<li><a href="#">Сохранить изменения</a></li>
					</ul>
				</div>
			</div>


@endsection