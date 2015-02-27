<div class="row">
	<div id="breadcrumb" class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="index.html">Dashboard</a></li>
			<li><a href="#">Settings</a></li>
			<li><a href="#">Voting Layout</a></li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-search"></i>
					<span>Voting Template</span>
				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>

			<div class="box-content">
				<h4 class="page-header">Registration form</h4>
				<form class="form-horizontal" role="form" action="vote_calculate.php" method="post">
					<div class="form-group">
						<label class="col-sm-2 control-label">if <b>"author_count"</b> is </label>
						<div class="col-sm-2">
							<select name ="author_select" class="form-control">
							<option value="1">greater than or equal</option>								
							<option value="0">less than or equal</option>
							<option value="2">equal</option>
						</select>
						</div>
						<label class="col-sm-1 control-label"> to </label>
						<div class="col-sm-2">
							<input name="author_count" type="text" value="0" class="form-control" placeholder="this" data-toggle="tooltip" data-placement="bottom" title="Tooltip for last name">
						</div>
						<label class="col-sm-1 control-label"> give </label>
						<div class="col-sm-1">

						<input type="text"  name="author_votes" value="0" class="form-control" placeholder="these" data-toggle="tooltip" data-placement="bottom" title="Tooltip for last name">
						</div>

						<div class="col-sm-1">
							<label class="col-sm-1 control-label"> Votes </label>

						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">if <b>"tags count"</b> is </label>
						<div class="col-sm-2">
							<select name ="tag_select" class="form-control">
							<option value="1">greater than or equal</option>
							<option value="0">less than or equal</option>
							<option value="2">equal</option>
						</select>
						</div>
						<label class="col-sm-1 control-label"> to </label>
						<div class="col-sm-2">
							<input type="text" name="tag_count" value="0"  class="form-control" placeholder="this" data-toggle="tooltip" data-placement="bottom" title="Tooltip for last name">
						</div>
						<label class="col-sm-1 control-label"> give </label>
						<div class="col-sm-1">

						<input type="text" name="tag_votes" value="0"  class="form-control" placeholder="these" data-toggle="tooltip" data-placement="bottom" title="Tooltip for last name">
						</div>

						<div class="col-sm-1">
							<label class="col-sm-1 control-label"> Votes </label>

						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">if <b> article </b> </label>
						<div class="col-sm-2">
							<select name ="publish_select" class="form-control">
							<option value="1">is</option>
							<option value="0">is_not</option>
						</select>
						</div>
						<label class="col-sm-2 control-label"> published, then give </label>
						
						<div class="col-sm-1">

						<input type="text" name="publish_votes" value="0"  class="form-control" placeholder="these" data-toggle="tooltip" data-placement="bottom" title="Tooltip for last name">
						</div>

						<div class="col-sm-1">
							<label class="col-sm-1 control-label"> Votes </label>

						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-2 control-label">if article  </label>
						<div class="col-sm-2">
							<select name ="url_select" class="form-control">
							<option value="1">has</option>
							<option value="0">doesn't have</option>
						</select>
						</div>
						<label class="col-sm-2 control-label"> a link , then give </label>
						
						<div class="col-sm-1">

						<input type="text" name="url_votes" value="0"  class="form-control" placeholder="these" data-toggle="tooltip" data-placement="bottom" title="Tooltip for last name">
						</div>

						<div class="col-sm-1">
							<label class="col-sm-1 control-label"> Votes </label>

						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">if article  </label>
						<div class="col-sm-2">
							<select name ="doi_select" class="form-control">
							<option value="1">has</option>
							<option value="0">doesn't have</option>
						</select>
						</div>
						<label class="col-sm-2 control-label"> a valid "doi" , then give </label>
						
						<div class="col-sm-1">

						<input type="text" name="doi_votes" value="0"  class="form-control" placeholder="these" data-toggle="tooltip" data-placement="bottom" title="Tooltip for last name">
						</div>

						<div class="col-sm-1">
							<label class="col-sm-1 control-label"> Votes </label>

						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">if article  </label>
						<div class="col-sm-2">
							<select name ="abstract_select" class="form-control">
							<option value="1">has</option>
							<option value="0">doesn't have</option>
						</select>
						</div>
						<label class="col-sm-2 control-label"> a "abstract" , then give </label>
						
						<div class="col-sm-1">

						<input type="text" name="abstract_votes" value="0" class="form-control" placeholder="these" data-toggle="tooltip" data-placement="bottom" title="Tooltip for last name">
						</div>

						<div class="col-sm-1">
							<label class="col-sm-1 control-label"> Votes </label>

						</div>
					</div>
					
					<div class="clearfix"></div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-2">
							<button type="cancel" class="btn btn-default btn-label-left">
							<span><i class="fa fa-clock-o txt-danger"></i></span>
								Cancel
							</button>
						</div>
						<div class="col-sm-2">
							<button type="submit" class="btn btn-warning btn-label-left">
							<span><i class="fa fa-clock-o"></i></span>
								Send later
							</button>
						</div>
						<div class="col-sm-2">
							<button type="submit" class="btn btn-primary btn-label-left">
							<span><i class="fa fa-clock-o"></i></span>
								Submit
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
// Run Select2 plugin on elements
function DemoSelect2(){
	$('#s2_with_tag').select2({placeholder: "Select OS"});
	$('#s2_country').select2();
}
// Run timepicker
function DemoTimePicker(){
	$('#input_time').timepicker({setDate: new Date()});
}
$(document).ready(function() {
	// Create Wysiwig editor for textare
	TinyMCEStart('#wysiwig_simple', null);
	TinyMCEStart('#wysiwig_full', 'extreme');
	// Add slider for change test input length
	FormLayoutExampleInputLength($( ".slider-style" ));
	// Initialize datepicker
	$('#input_date').datepicker({setDate: new Date()});
	// Load Timepicker plugin
	LoadTimePickerScript(DemoTimePicker);
	// Add tooltip to form-controls
	$('.form-control').tooltip();
	LoadSelect2Script(DemoSelect2);
	// Load example of form validation
	LoadBootstrapValidatorScript(DemoFormValidator);
	// Add drag-n-drop feature to boxes
	WinMove();
});
</script>
