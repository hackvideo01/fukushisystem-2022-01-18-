<?
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;
		use PHPMailer\PHPMailer\SMTP;
		require './PHPMailer/src/Exception.php';
	    require './PHPMailer/src/PHPMailer.php';
	    require './PHPMailer/src/SMTP.php';
	    
class newSignUp extends controller{
	public function welcome(){
		include_once './views/newSignUp.html';
		$db = $this->model("database");
		$database = new Database();
		$database->setTable("users");
		if (isset($_POST['newSignUp'])) {
			$_SESSION['email'] = $_POST['email'];

		    if ($_POST['email']!=""&&$_POST['username']!=""&&$_POST['password']!=""&&$_POST['lastname']!="") {
				// echo "<script>alert('newSignUp');</script>";
				// echo $_POST['email']."<br>";
				// echo $_POST['username']."<br>";
				// echo $_POST['password']."<br>";
				// echo $_POST['firstname']."<br>";
				// echo $_POST['lastname']."<br>";
				// echo $_POST['radiogroup1'];
				$queryCount =  'SELECT COUNT(*) AS `total` FROM `users` WHERE `username` = "'.$_REQUEST["username"].'"AND role=1';
				$countItem = $database->fetchRow($queryCount)['total'];
				if ($countItem == 0) {
						$data = array(
						'username' 				=> $_POST["username"],
						'password' 				=> $_POST["password"],
						'sex' 					=> $_POST["radiogroup1"],
						'role' 					=> 1
					);
					$database->insert($data);

		    	// $targetfolder = "./uploads/";

			    // $targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;

			    // $file_type=$_FILES['file']['type'];

			    // $ok = 1;

			    // if ($ok==1) {

			    //  if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))

			    //  {

			    //      echo "The file ". basename( $_FILES['file']['name']). " is uploaded";

			    //  }

			    //  else {

			    //      echo "Problem uploading file";
			    //      $targetfolder = "";

			    //  }

			    // }

			    // else {

			    //     echo "You may only upload PDFs, JPEGs or GIF files.<br>";

			    // }
			        
			    

			    $mailguest = new PHPMailer(true);                              // Passing `true` enables exceptions
			    try {
			        //Server settings
			        $mailguest->SMTPDebug = 3;                                 // Enable verbose debug output
			        $mailguest->isSMTP();                                      // Set mailer to use SMTP
			        $mailguest->Host = 'sv13156.xserver.jp';  // Specify main and backup SMTP servers
			        $mailguest->SMTPAuth = true;                               // Enable SMTP authentication
			        $mailguest->Username = 'no-reply@moff-mall.com';                 // SMTP username
			        $mailguest->Password = 'osakana3939';                           // SMTP password
			        $mailguest->SMTPSecure = 'TLS';                           // Enable TLS encryption, `ssl` also accepted
			        $mailguest->Port = 587;                                    // TCP port to connect to
			        $mailguest->CharSet = "UTF-8";

			        //Recipients
			        $mailguest->setFrom('no-reply@moff-mall.com','??????????????????');
			        $mailguest->addAddress($_POST['email']);     // Add a recipient



			        //Content
			        $mailguest->isHTML(true);                                  // Set email format to HTML
			        $mailguest->Subject = '?????????????????????????????????????????????????????????';
			        $mailguest->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
			        $mailguest->Body    = ''.$_POST['lastname'].'??????<br>
			                        <br><br>
			                        
			                        ??????????????????????????????????????????
			                        <br><br>

			                        ??????????????????: '.$_POST['username'].'
			                        <br><br>
			                        ???????????????: '.$_POST['password'].'
			                        <br><br>

			                            ';

			        $mailguest->send();
			        //echo 'Message has been sent';
			        header("Location: /fukushisystem/newSignUp/Success");
			        
			    } catch (Exception $e) {
			        echo 'Message could not be sent.';
			        echo 'Mailer Error: ' . $mailguest->ErrorInfo;
			    }
			    }else{
						echo '<h3 class="duplicate">??????????????????????????????????????????????????????????????????????????????????????????</h3>';
					}

			    // $mailmanager = new PHPMailer(true);                              // Passing `true` enables exceptions
			    // try {
			    //     //Server settings
			    //     $mailmanager->SMTPDebug = 2;                                 // Enable verbose debug output
			    //     $mailmanager->isSMTP();                                      // Set mailer to use SMTP
			    //     $mailmanager->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			    //     $mailmanager->SMTPAuth = true;                               // Enable SMTP authentication
			    //     $mailmanager->Username = 'hackvideo01@gmail.com';                 // SMTP username
			    //     $mailmanager->Password = 'motthoihoankim';                           // SMTP password
			    //     $mailmanager->SMTPSecure = 'TLS';                           // Enable TLS encryption, `ssl` also accepted
			    //     $mailmanager->Port = 587;                                    // TCP port to connect to
			    //     $mailmanager->CharSet = "UTF-8";

			    //     //Recipients
			    //     $mailmanager->setFrom('hackvideo01@gmail.com','??????????????????');
			    //     $mailmanager->addAddress('hackvideo01@gmail.com');     // Add a recipient



			    //     //Content
			    //     $mailmanager->isHTML(true);                                  // Set email format to HTML
			    //     $mailmanager->Subject = '?????????????????????????????????????????????????????????';
			    //     $mailmanager->Body    = '???????????????????????????????????????????????????????????????????????????
			    //                       <br><br>

			    //                       ???????????????????????????
			    //                       <br><br>

			    //                       ?????????: '.$_POST['namehira'].'
			    //                       <br><br>

			    //                       ???????????????: '.$_POST['namekana'].'
			    //                       <br><br>

			    //                       ?????????: '.$_POST['companyname'].'
			    //                       <br><br>

			    //                       ?????????????????????: '.$_POST['email'].'
			    //                       <br><br>

			    //                       ????????????: '.$_POST['tel'].'
			    //                       <br><br>

			    //                       ?????????: '.$_POST['address'].'
			    //                       <br><br>

			    //                       ????????????????????????: '.$_POST['comment'].'
			    //                       <br><br>

			    //                         ';

			    //     $mailmanager->send();
			    //     //echo 'Message has been sent';

			    //     header("Location: ?id=3");
			    //     exit();
			        
			    // } catch (Exception $e) {
			    //     echo 'Message could not be sent.';
			    //     echo 'Mailer Error: ' . $mailmanager->ErrorInfo;
			    // }

			}else{
			    echo "<div>?????????????????????????????????</div>";

			}
			    
			}

			// header("Location: /fukushisystem/success");
			return $email;
	}
	public function Success(){
		include_once './views/success.html';
		unset($_SESSION['email']);
	}
}
?>