<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7">
        
    </div>
</div><!--/.heading-container-->


<div class="row">
	<div class="col-md-8">
		<?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';                
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}
		?>
		<?php echo form_open(current_url(), array( 'method' => 'post','class'=>'ci-form','name' => '','id' => 'ci-form-helper',)); ?>
		<?php echo form_hidden('form_action', 'add'); ?>		  
			<div class="form-group">
				<label for="user_email" class="">Email <span class="required">*</span></label>			
				<?php
				echo form_input(array(
					'name' => 'user_email',
					'value' => set_value('user_email'),
					'id' => 'user_email',
					'class' => 'form-control field-help',
					'placeholder' => '',
					'minlength' => '',
					'maxlength' => '',
					'aria-describedby'=>'emailHelpBlock',
					'data-help-text' => 'We will not share your email to any thirrd party websites.',
					'data-help-text-class' => 'p-3 mt-1 mb-2 bg-info text-white'
				));
				?>
				<?php echo form_error('user_email'); ?>
			</div>
			
			<div class="form-row">
				<div class="form-group col-md-6">
				  <label for="user_password" class="">Password <span class="required">*</span></label>
					<?php
					echo form_password(array(
						'name' => 'user_password',
						'value' => set_value('user_password'),
						'id' => 'user_password',
						'class' => 'form-control field-help',
						'placeholder' => '',
						'minlength' => '6',
						'maxlength' => '16',
						'data-help-text' => 'A strong password should contains the followings <ul><li>Atleast one upper case.</li><li>Atleast one lower case.</li><li>Atleast one digit.</li><li>Some special characters.</li></ul>',
						'aria-describedby'=>'passwordHelpBlock'
					));
					?> 
					<?php echo form_error('user_password'); ?>
				</div>
				<div class="form-group col-md-6">
				  <label for="user_password_confirm" class="">Confirm Password <span class="required">*</span></label>
					<?php
					echo form_password(array(
						'name' => 'user_password_confirm',
						'value' => set_value('user_password_confirm'),
						'id' => 'user_password_confirm',
						'class' => 'form-control',
						'placeholder' => '',
						'minlength' => '6',
						'maxlength' => '16',
					));
					?> 
					<?php echo form_error('user_password_confirm'); ?>
				</div>
		  </div>
		  
		  
		  <div class="form-group">
			<label for="address" class="">Address <span class="required">*</span></label>
            <?php
            echo form_textarea(array(
                'name' => 'address',
                'value' => set_value('address'),
                'id' => 'address',
                'class' => 'form-control',
                'rows' => '1',
                'cols' => '4',
                'placeholder' => 'Address',
                'minlength' => '10',
                'maxlength' => '200',
            ));
            ?>
            <?php echo form_error('address'); ?>
		  </div>
		  
		  <div class="form-row">
			<div class="form-group col-md-6">
			  <label for="job_role" class="">Job Role <span class="required">*</span></label>
				<?php
				echo form_dropdown('job_role', $job_role_arr, set_value('job_role'), array(
					'class' => 'form-control',
				));
				?> 
				<?php echo form_error('job_role'); ?>
			</div>
			<div class="form-group col-md-6">
			  <label for="functional_domain" class="">Job Domain <span class="required">*</span></label>
				<?php
				echo form_multiselect('functional_domain', $domain_arr, set_value('functional_domain'), array(
					'class' => 'form-control field-help',
					'aria-describedby'=>'jobDomainHelpBlock',
					'data-help-text' => 'Press control key to select multiple job domains',
					'data-help-text-class' => 'p-3 mt-1 mb-2 bg-warning text-white'
				));
				?> 
				<?php echo form_error('functional_domain'); ?>
			</div>
		  </div>
		  
		  <div class="form-group">
			  <label for="functional_domain" class="">Resume <span class="required">*</span></label>
				<?php
				echo form_upload(array(
					'name' => 'userfile',
					'id' => 'userfile',
					'class' => 'field-help',
					'aria-describedby'=>'uploaderHelpBlock',
					'data-help-text' => 'Please read the file upload instructions given below: <ul><li>doc, docx, pdf, jpg, png formats are supported.</li><li>File size should not exceed 2 MB</li></ul>',
					'data-help-text-class' => 'p-3 mt-1 mb-2 bg-warning text-white'
				));
				?>                                
				<?php echo form_error('userfile'); ?>
			</div>
		  
		  
		  <div class="form-group">
			<label for="gender">Gender <span class="required">*</span></label>
			<div class="form-radio">
				<?php
				$radio_is_checked = $this->input->post('gender') === 'M';
				echo form_radio(array(
					'name' => 'gender',
					'value' => 'M',
					'id' => 'm',
					'checked' => $radio_is_checked,
					'class' => '',
						), set_radio('gender', 'M')
				);
				?>
				<label class="form-radio-label" for="m">Male</span></label>
				
				<?php
				$radio_is_checked = $this->input->post('gender') === 'F';
				echo form_radio(array(
					'name' => 'gender',
					'value' => 'F',
					'id' => 'f',
					'checked' => $radio_is_checked,
					'class' => ''
						), set_radio('gender', 'F')
				);
				?>
				<label class="form-radio-label" for="f">Female</span></label>
				
				<?php
				$radio_is_checked = $this->input->post('gender') === 'T';
				echo form_radio(array(
					'name' => 'gender',
					'value' => 'T',
					'id' => 't',
					'checked' => $radio_is_checked,
					'class' => ''
						), set_radio('gender', 'T')
				);
				?>
				<label class="form-radio-label" for="t">Others</span></label>
			</div>
			<?php echo form_error('gender'); ?>
		  </div>
		  
		  
		  <div class="form-group">
			<div class="form-check">
				<?php
					$cb_is_checked = $this->input->post('terms') === 'accept';
					echo form_checkbox('terms', 'accept', $cb_is_checked, array('id' => 'trems','class' => 'form-check-input'));
				?>				
				<label class="form-check-label" for="trems">
				<span class="required">*</span>I've read & accepting the <a href="#" data-toggle="modal" data-target="#tncModal">Terms of Uses Agreement</a>
				</label>				
			</div>
			<?php echo form_error('terms'); ?>
		  </div>
		  
		  <?php echo form_submit(array('name' => 'submit', 'value' => 'Submit', 'id' => 'btn_submit', 'class' => 'btn btn-primary')); ?> 
		<?php echo form_close(); ?>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="tncModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Terms of Services</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body tnc-content">
				<div class="maia-article" role="article">
					<div class="maia-teleport" id="content"></div>			
					<p>Last modified: April 14, 2014 (<a href="#">view archived versions</a>)
					</p><h2>Welcome to Google!</h2>
					<p>Thanks for using our products and services (“Services”). The Services are provided by Google Inc. (“Google”), located at 1600 Amphitheatre Parkway, Mountain View, CA 94043, United States.
					</p><p>By using our Services, you are agreeing to these terms. Please read them carefully.
					</p><p>Our Services are very diverse, so sometimes additional terms or product requirements (including age requirements) may apply. Additional terms will be available with the relevant Services, and those additional terms become part of your agreement with us if you use those Services.
					</p><h2 id="toc-services">Using our Services</h2>
					<p>You must follow any policies made available to you within the Services.
					</p><p>Don’t misuse our Services. For example, don’t interfere with our Services or try to access them using a method other than the interface and the instructions that we provide. You may use our Services only as permitted by law, including applicable export and re-export control laws and regulations. We may suspend or stop providing our Services to you if you do not comply with our terms or policies or if we are investigating suspected misconduct.
					</p><p>Using our Services does not give you ownership of any intellectual property rights in our Services or the content you access. You may not use content from our Services unless you obtain permission from its owner or are otherwise permitted by law. These terms do not grant you the right to use any branding or logos used in our Services. Don’t remove, obscure, or alter any legal notices displayed in or along with our Services.
					</p><p>Our Services display some content that is not Google’s. This content is the sole responsibility of the entity that makes it available. We may review content to determine whether it is illegal or violates our policies, and we may remove or refuse to display content that we reasonably believe violates our policies or the law. But that does not necessarily mean that we review content, so please don’t assume that we do.
					</p><p>In connection with your use of the Services, we may send you service announcements, administrative messages, and other information. You may opt out of some of those communications.
					</p><p>Some of our Services are available on mobile devices. Do not use such Services in a way that distracts you and prevents you from obeying traffic or safety laws.
					</p><h2 id="toc-account">Your Google Account</h2>
					<p>You may need a Google Account in order to use some of our Services. You may create your own Google Account, or your Google Account may be assigned to you by an administrator, such as your employer or educational institution. If you are using a Google Account assigned to you by an administrator, different or additional terms may apply and your administrator may be able to access or disable your account.
					</p><p>To protect your Google Account, keep your password confidential. You are responsible for the activity that happens on or through your Google Account. Try not to reuse your Google Account password on third-party applications. If you learn of any unauthorized use of your password or Google Account, <a href="#">follow these instructions</a>.
					</p><h2 id="toc-protection">Privacy and Copyright Protection</h2>
					<p>Google’s <a href="#">privacy policies</a> explain how we treat your personal data and protect your privacy when you use our Services. By using our Services, you agree that Google can use such data in accordance with our privacy policies.
					</p><p>We respond to notices of alleged copyright infringement and terminate accounts of repeat infringers according to the process set out in the U.S. Digital Millennium Copyright Act.
					</p><p>We provide information to help copyright holders manage their intellectual property online. If you think somebody is violating your copyrights and want to notify us, you can find information about submitting notices and Google’s policy about responding to notices <a href="#">in our Help Center</a>.
					</p><h2 id="toc-content">Your Content in our Services</h2>
					<p>Some of our Services allow you to upload, submit, store, send or receive content. You retain ownership of any intellectual property rights that you hold in that content. In short, what belongs to you stays yours.
					</p><p>When you upload, submit, store, send or receive content to or through our Services, you give Google (and those we work with) a worldwide license to use, host, store, reproduce, modify, create derivative works (such as those resulting from translations, adaptations or other changes we make so that your content works better with our Services), communicate, publish, publicly perform, publicly display and distribute such content. The rights you grant in this license are for the limited purpose of operating, promoting, and improving our Services, and to develop new ones. This license continues even if you stop using our Services (for example, for a business listing you have added to Google Maps). Some Services may offer you ways to access and remove content that has been provided to that Service. Also, in some of our Services, there are terms or settings that narrow the scope of our use of the content submitted in those Services. Make sure you have the necessary rights to grant us this license for any content that you submit to our Services.
					</p><p>Our automated systems analyze your content (including emails) to provide you personally relevant product features, such as customized search results, tailored advertising, and spam and malware detection. This analysis occurs as the content is sent, received, and when it is stored.
					</p><p>If you have a Google Account, we may display your Profile name, Profile photo, and actions you take on Google or on third-party applications connected to your Google Account (such as +1’s, reviews you write and comments you post) in our Services, including displaying in ads and other commercial contexts. We will respect the choices you make to limit sharing or visibility settings in your Google Account. For example, you can choose your settings so your name and photo do not appear in an ad.
					</p><p>You can find more information about how Google uses and stores content in the privacy policy or additional terms for particular Services. If you submit feedback or suggestions about our Services, we may use your feedback or suggestions without obligation to you.
					</p><h2 id="toc-software">About Software in our Services</h2>
					<p>When a Service requires or includes downloadable software, this software may update automatically on your device once a new version or feature is available. Some Services may let you adjust your automatic update settings.
					</p><p>Google gives you a personal, worldwide, royalty-free, non-assignable and non-exclusive license to use the software provided to you by Google as part of the Services. This license is for the sole purpose of enabling you to use and enjoy the benefit of the Services as provided by Google, in the manner permitted by these terms. You may not copy, modify, distribute, sell, or lease any part of our Services or included software, nor may you reverse engineer or attempt to extract the source code of that software, unless laws prohibit those restrictions or you have our written permission.
					</p><p>Open source software is important to us. Some software used in our Services may be offered under an open source license that we will make available to you. There may be provisions in the open source license that expressly override some of these terms.
					</p><h2 id="toc-modification">Modifying and Terminating our Services</h2>
					<p>We are constantly changing and improving our Services. We may add or remove functionalities or features, and we may suspend or stop a Service altogether.
					</p><p>You can stop using our Services at any time, although we’ll be sorry to see you go. Google may also stop providing Services to you, or add or create new limits to our Services at any time.
					</p><p>We believe that you own your data and preserving your access to such data is important. If we discontinue a Service, where reasonably possible, we will give you reasonable advance notice and a chance to get information out of that Service.
					</p><h2 id="toc-warranties-disclaimers">Our Warranties and Disclaimers</h2>
					<p>We provide our Services using a commercially reasonable level of skill and care and we hope that you will enjoy using them. But there are certain things that we don’t promise about our Services.
					</p><p>OTHER THAN AS EXPRESSLY SET OUT IN THESE TERMS OR ADDITIONAL TERMS, NEITHER GOOGLE NOR ITS SUPPLIERS OR DISTRIBUTORS MAKE ANY SPECIFIC PROMISES ABOUT THE SERVICES. FOR EXAMPLE, WE DON’T MAKE ANY COMMITMENTS ABOUT THE CONTENT WITHIN THE SERVICES, THE SPECIFIC FUNCTIONS OF THE SERVICES, OR THEIR RELIABILITY, AVAILABILITY, OR ABILITY TO MEET YOUR NEEDS. WE PROVIDE THE SERVICES “AS IS”.
					</p><p>SOME JURISDICTIONS PROVIDE FOR CERTAIN WARRANTIES, LIKE THE IMPLIED WARRANTY OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT. TO THE EXTENT PERMITTED BY LAW, WE EXCLUDE ALL WARRANTIES.
					</p><h2 id="toc-liability">Liability for our Services</h2>
					<p>WHEN PERMITTED BY LAW, GOOGLE, AND GOOGLE’S SUPPLIERS AND DISTRIBUTORS, WILL NOT BE RESPONSIBLE FOR LOST PROFITS, REVENUES, OR DATA, FINANCIAL LOSSES OR INDIRECT, SPECIAL, CONSEQUENTIAL, EXEMPLARY, OR PUNITIVE DAMAGES.
					</p><p>TO THE EXTENT PERMITTED BY LAW, THE TOTAL LIABILITY OF GOOGLE, AND ITS SUPPLIERS AND DISTRIBUTORS, FOR ANY CLAIMS UNDER THESE TERMS, INCLUDING FOR ANY IMPLIED WARRANTIES, IS LIMITED TO THE AMOUNT YOU PAID US TO USE THE SERVICES (OR, IF WE CHOOSE, TO SUPPLYING YOU THE SERVICES AGAIN).
					</p><p>IN ALL CASES, GOOGLE, AND ITS SUPPLIERS AND DISTRIBUTORS, WILL NOT BE LIABLE FOR ANY LOSS OR DAMAGE THAT IS NOT REASONABLY FORESEEABLE.
					</p><h2 id="toc-business-uses">Business uses of our Services</h2>
					<p>If you are using our Services on behalf of a business, that business accepts these terms. It will hold harmless and indemnify Google and its affiliates, officers, agents, and employees from any claim, suit or action arising from or related to the use of the Services or violation of these terms, including any liability or expense arising from claims, losses, damages, suits, judgments, litigation costs and attorneys’ fees.
					</p><h2 id="toc-about">About these Terms</h2>
					<p>We may modify these terms or any additional terms that apply to a Service to, for example, reflect changes to the law or changes to our Services. You should look at the terms regularly. We’ll post notice of modifications to these terms on this page. We’ll post notice of modified additional terms in the applicable Service. Changes will not apply retroactively and will become effective no sooner than fourteen days after they are posted. However, changes addressing new functions for a Service or changes made for legal reasons will be effective immediately. If you do not agree to the modified terms for a Service, you should discontinue your use of that Service.
					</p><p>If there is a conflict between these terms and the additional terms, the additional terms will control for that conflict.
					</p><p>These terms control the relationship between Google and you. They do not create any third party beneficiary rights.
					</p><p>If you do not comply with these terms, and we don’t take action right away, this doesn’t mean that we are giving up any rights that we may have (such as taking action in the future).
					</p><p>If it turns out that a particular term is not enforceable, this will not affect any other terms.
					</p><p>The laws of California, U.S.A., excluding California’s conflict of laws rules, will apply to any disputes arising out of or relating to these terms or the Services. All claims arising out of or relating to these terms or the Services will be litigated exclusively in the federal or state courts of Santa Clara County, California, USA, and you and Google consent to personal jurisdiction in those courts.
					</p><p>For information about how to contact Google, please visit our <a href="#">contact page</a>.</p>
				</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>