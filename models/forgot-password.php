<?php
include_once("../env/main-config.php");
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if (isset($_POST['sendEmail'])) {
	$log_email = $_POST['userEmail'];

	//Load Composer's autoloader
	require '../assets/phpMailer/Exception.php';
	require '../assets/phpMailer/PHPMailer.php';
	require '../assets/phpMailer/SMTP.php';

	$forget_pass = "SELECT * FROM wt_users WHERE email = '" . $log_email . "' AND close='1' AND status = '1'";
	$forget_pass_ex = mysqli_query($con, $forget_pass);

	if (mysqli_num_rows($forget_pass_ex) == '1') {
		$current_time = date('d-m-Y h:i:s');
		echo $Exptime = date('Y-m-d H:i:s', time() + (60 * 5));
		$token = hash('ripemd160', sha1(md5($log_email . "" . $current_time)));
		$insert_token = "UPDATE `wt_users` SET `forgot_token`='" . $token . "', `token_exp_time`='" . $Exptime . "' WHERE email = '" . $log_email . "'";
		$insert_token_ex = mysqli_query($con, $insert_token);
		if ($insert_token_ex) {
			$data['gett'] = $token;
			$data['ctime'] = date('d-m-Y h:i:s');
			$urltoken = base64_encode(json_encode($data));
			$urllink = "https://crm.wslcms.com/update-password?update_pass=" . $urltoken . "";

			//Create an instance; passing `true` enables exceptions
			$mail = new PHPMailer(true);

			try {
				//Server settings
				$mail->isSMTP();                                            //Send using SMTP
				$mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
				$mail->Username   = 'unistudent769@gmail.com';            //SMTP username
				$mail->Password   = 'ghtvusedccveaqmf';                     //SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
				$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

				//Recipients
				$mail->setFrom('unistudent769@gmail.com', 'WSL Consultants (Pvt) Ltd');
				$mail->addAddress($log_email, 'WSL Consultants (Pvt) Ltd');     //Add a recipient

				//Content
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = "Forgot Password";
				$mail->Body = '

		        <table style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #f9f9f9;width:100%" cellpadding="0" cellspacing="0">
					<tbody>
						<tr style="vertical-align: top">
							<td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
								<div style="padding: 0px;background-color: #f9f9f9">
									<div style="margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #f9f9f9;">
										<div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
											<div style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
												<div style="height: 100%;width: 100% !important;">
													<div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
														<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
															<tbody>
																<tr>
																	<td style="overflow-wrap:break-word;word-break:break-word;padding:15px;" align="left">

																		<table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #f9f9f9;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
																			<tbody>
																				<tr style="vertical-align: top">
																					<td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
																						<span>&#160;</span>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div style="padding: 0px;background-color: transparent">
									<div style="margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
										<div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
											<div style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
												<div style="height: 100%;width: 100% !important;">
													<div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
														<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
															<tbody>
																<tr>
																	<td style="overflow-wrap:break-word;word-break:break-word;padding:25px 10px;" align="left">

																		<table width="100%" cellpadding="0" cellspacing="0" border="0">
																			<tr>
																				<td style="padding-right: 0px;padding-left: 0px;" align="center">

																					<img align="center" border="0" src="cid:logo" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 29%;max-width: 140.2px;" width="140.2"/>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div style="padding: 0px;background-color: transparent">
									<div style="margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #3461ff;">
										<div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
											<div style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
												<div style="height: 100%;width: 100% !important;">
													<div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
														<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
															<tbody>
																<tr>
																	<td style="overflow-wrap:break-word;word-break:break-word;padding:35px 10px 10px;" align="left">

																		<table width="100%" cellpadding="0" cellspacing="0" border="0">
																			<tr>
																				<td style="padding-right: 0px;padding-left: 0px;" align="center">

																					<img align="center" border="0" src="cid:image2" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 10%;max-width: 58px;" width="58"/>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</tbody>
														</table>
														<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
															<tbody>
																<tr>
																	<td style="overflow-wrap:break-word;word-break:break-word;padding:0px 10px 30px;" align="left">

																		<div style="font-size: 14px; line-height: 140%; text-align: left; word-wrap: break-word;">
																			<p style="font-size: 14px; line-height: 140%; text-align: center;"><span style="font-size: 28px; line-height: 39.2px; color: #ffffff; font-family: Lato, sans-serif;">Please reset your password </span></p>
																		</div>

																	</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div style="padding: 0px;background-color: transparent">
									<div style="margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
										<div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
											<div style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
												<div style="height: 100%;width: 100% !important;">
													<div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
														<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
															<tbody>
																<tr>
																	<td style="overflow-wrap:break-word;word-break:break-word;padding:40px 40px 30px;" align="left">

																		<div style="font-size: 14px; line-height: 140%; text-align: left; word-wrap: break-word;">
																			<p style="font-size: 14px; line-height: 140%;"><span style="font-size: 18px; line-height: 25.2px; color: #666666;">Hello,</span></p>
																			<p style="font-size: 14px; line-height: 140%;"><span style="font-size: 18px; line-height: 25.2px; color: #666666;">We have sent you this email in response to your request to reset your password on company name.</span></p>
																			<p style="font-size: 14px; line-height: 140%;"><span style="font-size: 18px; line-height: 25.2px; color: #666666;">To reset your password, please follow the link below: </span></p>
																		</div>

																	</td>
																</tr>
															</tbody>
														</table>
														<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
															<tbody>
																<tr>
																	<td style="overflow-wrap:break-word;word-break:break-word;padding:0px 40px;" align="left">

																		<div align="left">
																			<a href="' . $urllink . '" target="_blank" class="v-button" style="box-sizing: border-box;display: inline-block;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #FFFFFF; background-color: #3461ff; border-radius: 1px;-webkit-border-radius: 1px; -moz-border-radius: 1px; width:auto; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; mso-border-alt: none;font-size: 14px;">
																				<span style="display:block;padding:15px 40px;line-height:120%;"><span style="font-size: 18px; line-height: 21.6px;">Reset Password</span></span>
																			</a>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
														<table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
															<tbody>
																<tr>
																	<td style="overflow-wrap:break-word;word-break:break-word;padding:40px 40px 30px;" align="left">

																		<div style="font-size: 16px; line-height: 140%; text-align: left; word-wrap: break-word;">
																			<p style="font-size: 16px; line-height: 140%;"><span style="color: #fc0000; font-size: 16px; line-height: 19.6px;"><em><span style="font-size: 16px; line-height: 22.4px;"><b>Note!</b> This link will expire in 5 Minutes for security reasons.</span></em></span><br /></p>
																		</div>

																		<div style="font-size: 16px; line-height: 140%; text-align: left; word-wrap: break-word;">
																			<p style="font-size: 16px; line-height: 140%;"><span style="color: #888888; font-size: 16px; line-height: 19.6px;"><em><span style="font-size: 16px; line-height: 22.4px;">Please ignore this email if you did not request a password change.</span></em></span><br /><span style="color: #888888; font-size: 16px; line-height: 19.6px;"><em><span style="font-size: 16px; line-height: 22.4px;"> </span></em></span></p>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>


		        ';
				$mail->AddEmbeddedImage('../images/logo-sm.png', 'logo', 'logo-sm.png');
				$mail->AddEmbeddedImage('../images/image-2.png', 'image2', 'image-2.png');
				$mail->send();
				header('Location: ../forgot-password?check-your-email');
				exit();
			} catch (Exception $e) {
				echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
		}
	} else {
		header('Location: ../forgot-password?enter-your-right-email');
	}
}

// Update Password Query
if (isset($_POST['updatePassword'])) {
	$token = $_POST['changepass'];
	$password = $_POST['newPassword'];
	$last_pass = md5($password);
	$confirm_password = $_POST['confirmPassword'];
	$current_time = date('Y-m-d h:i:s');

	if ($password == $confirm_password) {
		$update_password = "UPDATE `wt_users` SET `password`='" . $last_pass . "',`token_exp_time`='" . $current_time . "' WHERE forgot_token = '" . $token . "'";
		$update_password_ex = mysqli_query($con, $update_password);
		if ($update_password_ex) {
			header('Location: ../login?change-your-password');
		} else {
			echo "<div class='alert alert-success'>
			<strong>There is an error in the query!
			</div>";
		}
	}
}
