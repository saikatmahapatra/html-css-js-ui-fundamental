<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7">
        
    </div>
</div><!--/.heading-container-->

<div class="row">


    <div class="col-md-3">		
		<?php echo $cal; ?>				
		<?php echo form_error('selected_date'); ?>
		<div class="mt-3 small">
			<div class="d-inline-block"><span class="i-today pr-2 pl-2 m-1 text-white"></span>Today</div>
			<div class="d-inline-block"><span class="i-selected pr-2 pl-2 m-1"></span>Selected</div>
			<div class="d-inline-block"><span class="i-has-data pr-2 pl-2 m-1"></span>Task Logged</div>
			<div class="d-inline-block"><span class="i-leave pr-2 pl-2 m-1"></span>Leave</div>
			<div class="d-inline-block"><span class="i-holiday pr-2 pl-2 m-1"></span>Holiday</div>
		</div>
		<div class="mt-2"><a id="clear_selected_days" class="btn btn-outline-secondary btn-sm" href="#"><i class="fa fa-fw fa-times-circle"></i> Clear all selected days</a></div>
		<div class="mt-3">
			<h6>Monthly timesheet entry summary</h6>
			<div class="">Tasks logged for: <span id="total_days">0.0</span> days</div>
			<div class="">Total hours logged: <span id="total_hrs">0.0</span> hrs</div>
			<div class="">Avg. hours worked: <span class="" id="average_worked_hrs">0.0</span> hrs/day</div>
		</div>
		
		<a class="text-centre d-none" href="#"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download this month's timesheet</a>
	</div>
	
	
	
	<div class="col-md-9">		
		<nav>
			<div class="nav nav-tabs ci-nav-tab" id="nav-tab" role="tablist">
				<a class="nav-item nav-link active" id="nav-add-tab" data-toggle="tab" href="#nav-add" role="tab" aria-controls="nav-add" aria-selected="true">Log Tasks</a>
				
				<a class="nav-item nav-link" id="nav-list-tab" data-toggle="tab" href="#nav-list" role="tab" aria-controls="nav-list" aria-selected="false">View Logged Tasks</a>
			</div>
		</nav>
		
		<div class="tab-content" id="nav-tabContent">
		
			<div class="mt-3 tab-pane fade show active" id="nav-add" role="tabpanel" aria-labelledby="nav-add-tab">
			<?php
			// Show server side flash messages
			if (isset($alert_message)) {
				$html_alert_ui = '';                
				$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
				echo $html_alert_ui;
			}
			?>
			<?php echo form_open(current_url(), array( 'method' => 'post','class'=>'ci-form form-timesheet','name' => '','id' => 'ci-form-timesheet',)); ?>
			<?php echo form_hidden('form_action', 'add'); ?>		  
			<?php echo form_hidden('selected_date',set_value('selected_date')); ?>		  
			
			<div class="form-group d-none">
				<label for="selected_days" class="">Select Day(s) <span class="required">*</span>
				<span class="text-muted font-weight-normal"> You can select multiple dates from the calendar</span></label>				
				<div id="display_selected_date">You have not selected any day</div>
				<?php echo form_error('selected_date'); ?>
			</div>
				
			<div class="form-row">
				<div class="form-group col-md-4">
				  <label for="project_id" class="bmd-label-floating">Projects <span class="required">*</span></label>
					<?php
					echo form_dropdown('project_id', $project_arr, set_value('project_id'), array(
						'class' => 'form-control',
					));
					?> 
					<?php echo form_error('project_id'); ?>
				</div>
						
				<div class="form-group col-md-4">
				  <label for="activity_id" class="bmd-label-floating">Activity <span class="required">*</span></label>
					<?php
					echo form_dropdown('activity_id', $task_task_activity_type_array, set_value('activity_id'), array(
						'class' => 'form-control',
					));
					?> 
					<?php echo form_error('activity_id'); ?>
				</div>
					
				<div class="form-group col-md-4">
					<label for="timesheet_hours" class="bmd-label-floating">Hours <span class="required">*</span></label>		
					<?php					
					echo form_dropdown('timesheet_hours', $timesheet_hours, set_value('timesheet_hours'), array(
						'class' => 'form-control',
					));
					?>
					<?php echo form_error('timesheet_hours'); ?>
				</div>
			</div>		  
			 
			
			<div class="form-group">
			<label for="timesheet_description" class="bmd-label-floating">Description <span class="required">*</span></label>
			<?php
			echo form_textarea(array(
				'name' => 'timesheet_description',
				'value' => set_value('timesheet_description'),
				'id' => 'timesheet_description',
				'class' => 'form-control',
				'rows' => '2',
				'cols' => '4',
				'maxlength' => '200'
			));
			?>
			<?php echo form_error('timesheet_description'); ?>
			</div>
			
			<button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-check-circle"></i> Submit</button>
			<?php echo form_close(); ?>
			</div><!--/#nav-add-->
			
			<div class="mt-3 tab-pane fade" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
				
				<div class="table-responsive">
					<table id="timesheet-datatable" class="table table-sm w-100">
						<thead>
							<!--<tr>
								<th scope="col">Date</th>
								<th scope="col">Project</th>
								<th scope="col">Activity</th>
								<th scope="col">Hours</th>
								<th scope="col">Status</th>
								<th scope="col">Action</th>
							</tr>-->
							<tr>
								<th scope="col">Date & Tasks</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
				
			</div><!--/#nav-list-->
		
		</div><!--/.tab-content #nav-tabContent-->
	</div>
</div>