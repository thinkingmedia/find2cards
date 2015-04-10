<div class="row">
	<div class="col-md-6">
		<div class="starter-template">
			<h1><?= __('Bootstrap starter template') ?></h1>
			<p class="lead">Use this document as a way to quickly start any new project. All you get is this text and a mostly barebones HTML document.</p>
		</div>
	</div>
	<div class="col-md-6">
		<div class="gmSignIn">
			<form action="/" method="POST">
				<div class="form-group">
					<input id="FieldUserName" type="text" name="name" value="" placeholder="Your name..."/>
				</div>
				<button type="submit" class="btn btn-primary btn-block"><?= __('Start') ?></button>
			</form>
			<a class="btn btn-default btn-block" href="/users/stats" role="button"><?= __('Stats') ?></a>
		</div>
	</div>
</div>

