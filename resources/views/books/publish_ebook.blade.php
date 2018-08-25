@extends('layouts.app') @section('template_fastload_css') @endsection @section('content')
<div class="upload-book">
	<div class="heading-upload">Publish eBook</div>
	<div class="upload-book">
		<div class="content">
			<img src="/images/plus2.png" alt="plus-icon" /> <span>Upload Book</span>
		</div>
	</div>
	<div class="upload-form">
		<div class="form-left">
			<div class="unit-3">
				<div class="form-unit">
					<div class="heading">Publisher</div>
					<div class="content">
						<input type="text" placeholder="Publisher">
					</div>
				</div>
			</div>
			<div class="units">
				<div class="unit-1">
					<div class="form-unit">
						<div class="heading">Sub Title</div>
						<div class="content">
							<input type="text" placeholder="Free eBook">
						</div>
					</div>
				</div>
				<div class="unit-2">
					<div class="form-unit">
						<div class="heading">Publisher</div>
						<div class="content">
							<input type="text" placeholder="Publisher">
						</div>
					</div>
				</div>
			</div>
			<div class="units">
				<div class="unit-1">
					<div class="form-unit">
						<div class="heading">Sub Title</div>
						<div class="content">
							<select>
								<option value="volvo">Volvo</option>
								<option value="saab">Saab</option>
								<option value="mercedes">Mercedes</option>
								<option value="audi">Audi</option>
							</select>
						</div>
					</div>
				</div>
				<div class="unit-2">
					<div class="form-unit">
						<div class="heading">Publisher</div>
						<div class="content">
							<input type="text" placeholder="Publisher">
						</div>
					</div>
				</div>
			</div>
			<div class="units">
				<div class="unit-1">
					<div class="form-unit">
						<div class="heading">Sub Title</div>
						<div class="content">
							<select>
								<option value="volvo">Volvo</option>
								<option value="saab">Saab</option>
								<option value="mercedes">Mercedes</option>
								<option value="audi">Audi</option>
							</select>
						</div>
					</div>
				</div>
				<div class="unit-2">
					<div class="form-unit">
						<div class="heading">Publisher</div>
						<div class="content">
							<input type="text" placeholder="Publisher">
						</div>
					</div>
				</div>
			</div>
			<div class="unit-3">
				<div class="form-unit">
					<div class="heading">Publisher</div>
					<div class="content">
						<input type="text" placeholder="Publisher">
					</div>
				</div>
			</div>
			<div class="unit-3">
				<div class="form-unit">
					<div class="heading">Publisher</div>
					<div class="content">
						<textarea></textarea>
					</div>
				</div>
			</div>
			<div class="unit-3 submit-button">
				<input type="submit" value="Publish eBook">
			</div>
		</div>
		<div class="form-right">
			<div class="image-container">
				<img src="/images/cs.png" />
			</div>
			<div class="upload-button">
				<input type="submit" value="Change cover">
			</div>
		</div>
	</div>
</div>
@endsection @section('footer_scripts')<link rel="stylesheet" href="/css/uploadbook.css"> @endsection