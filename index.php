<!DOCTYPE HTML>
<!--
	SendCH-Telegram
	Version 1.0
	Created By TiagoDanin
	Collaborator GualterPerinho

	Typify by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license
	LICENSE: https://github.com/TiagoDanin/SendCH-Telegram/blob/master/LICENSE
-->
<html>
	<head>
		<title>SendCH Telegram</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
	</head>
	<body>

		<!-- Home -->
		<section id="banner">
			<h2><strong>Send Post</strong> for your channel using Markdown or HTML</h2>
			<p>1. Add the bot (@MSGSendBot) for your channel</p>
			<p>2. Edit and send the message with the form below</p>
			<p>3. Remove the bot ;)</p>
			<p>Or use your bot</p>
			<p>1. Get token in bot @BotFather</p>
			<p>3. Paste in Very Advanced >> Send with my Bot</p>
			<ul class="actions">
				<li><a href="#send" class="button special">Start</a></li>
			</ul>
		</section>

		<!-- Send Message -->
		<section id="send" class="wrapper style2 special">
			<div class="inner narrow">
				<header>
					<h2>Send Message</h2>
				</header>
				<form class="grid-form" action="" method="post">

					<div class="form-control narrow">
						<label for="name">Channel</label>
						<input name="chat_id" value="@Channel" type="text">
					</div>
					<div class="form-control narrow">
						<label for="email">Formatting options</label>
						<a href="#one" class="button special">View Style</a>
					</div>

					<div class="form-control">
						<label for="message">Message</label>
						<textarea name="text" value="*Hi!*" id="message" rows="4"></textarea>
						<select name="parse_mode">
							<option value="false">Formatting options...</option>
							<option value="Markdown">Markdown</option>
							<option value="HTML">HTML</option>
							<option value="false">Without Formatting</option>
						</select>
					</div>

					<div class="form-control">
						<label for="name">Advanced</label>
						<input name="disable_web_page_preview" type="checkbox" value="true">Disable Web Page Preview<br>
						<input name="disable_notification" type="checkbox" value="true">Disable Notification<br>
					</div>

					<div class="form-control">
						<label for="name">Very Advanced</label>
						Inline Keybord <input name="reply_markup" value='[[{"text":"Open Telegram","url":"https://telegram.org/"}]]' id="name" type="text">
						My bot(token) <input name="my_token" value="1234567:ABCD-EDFGH" type="text">
					</div>

					<ul class="actions">
						<li><input value="Send Message" type="submit" name="sendButton"></li>
					</ul>
				</form>
				<?php
					if(isset($_POST['sendButton']))
					{
						$token = ''; //HERE TOKEN
						if($_POST['my_token'] != '1234567:ABCD-EDFGH')
						{
							$token = ''.$_POST['my_token'].'';
						}
						$url_telegram = 'https://api.telegram.org/bot'.$token.'';
						$text = urlencode(''.$_POST['text'].'');
						$url = ''.$url_telegram.'/sendMessage?chat_id='.$_POST['chat_id'].'&text='.$text.'';

						if(isset($_POST['disable_web_page_preview']))
						{
							$url = ''.$url.'&disable_web_page_preview='.$_POST['disable_web_page_preview'].'';
						}
						if(isset($_POST['disable_notification']))
						{
							$url = ''.$url.'&disable_notification='.$_POST['disable_notification'].'';
						}
						if($_POST['parse_mode'] != 'false')
						{
							$url = ''.$url.'&parse_mode='.$_POST['parse_mode'].'';
						}
						if($_POST['reply_markup'] != '[[{"text":"Open Telegram","url":"https://telegram.org/"}]]')
						{
							$reply_markup = urlencode(''.$_POST['reply_markup'].'');
							$url = ''.$url.'&reply_markup={"inline_keyboard":'.$reply_markup.'}';
						}
						$url_end = ''.$url.'';

						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, $url_end);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						$output = curl_exec($ch);
						curl_close($ch);
						$res = substr($output, 0, 11);
						if($res == '{"ok":false')
						{
							echo 'Error sending!';
						} else {
							echo 'Message sent with successfully!';
						};
					}
				?>
			</div>
		</section>

		<section id="one" class="wrapper special">
			<div class="inner">
				<header class="major">
					<h2><a href="https://core.telegram.org/bots/api/#formatting-options">Style</a></h2>
				</header>
				<div class="features">
					<div class="feature">
						<i class="fa fa-envelope-o"></i>
						<h3>Formatting Markdown</h3>
						<p>*bold text*</p>
						<p>_italic text_</p>
						<p>[text](URL)</p>
						<p>`inline fixed-width code`</p>
						<p>```pre-formatted fixed-width code block```</p>
					</div>
					<div class="feature">
						<i class="fa fa-diamond"></i>
						<h3>Markdown or HTML</h3>
						<p>Allows you to write text in bold, italic, hidden the url...</p>

						<i class="fa fa-paper-plane-o"></i>
						<h3>Telegram</h3>
						<p>Currently the Telegram do not support sending text using Markdown or HTML for user.</p>
					</div>
					<div class="feature">
						<i class="fa fa-envelope-o"></i>
						<h3>Formatting HTML</h3>
						<p>&#60;&#98;&#62;&#98;&#111;&#108;&#100;&#32;&#116;&#101;&#120;&#116;&#60;&#47;&#98;&#62;</p>
						<p>&#60;&#105;&#62;&#105;&#116;&#97;&#108;&#105;&#99;&#32;&#116;&#101;&#120;&#116;&#60;&#47;&#105;&#62;</p>
						<p>&#60;&#97;&#32;&#104;&#114;&#101;&#102;&#61;&#34;&#85;&#82;&#76;&#34;&#62;&#116;&#101;&#120;&#116;&#60;&#47;&#97;&#62;</p>
						<p>&#60;&#99;&#111;&#100;&#101;&#62;&#105;&#110;&#108;&#105;&#110;&#101;&#32;&#102;&#105;&#120;&#101;&#100;&#45;&#119;&#105;&#100;&#116;&#104;&#32;&#99;&#111;&#100;&#101;&#60;&#47;&#99;&#111;&#100;&#101;&#62;</p>
						<p>&#60;&#112;&#114;&#101;&#62;&#112;&#114;&#101;&#45;&#102;&#111;&#114;&#109;&#97;&#116;&#116;&#101;&#100;&#32;&#102;&#105;&#120;&#101;&#100;&#45;&#119;&#105;&#100;&#116;&#104;&#32;&#99;&#111;&#100;&#101;&#32;&#98;&#108;&#111;&#99;&#107;&#60;&#47;&#112;&#114;&#101;&#62;&#60;&#112;&#114;&#101;&#62;&#112;&#114;&#101;&#45;&#102;&#111;&#114;&#109;&#97;&#116;&#116;&#101;&#100;&#32;&#102;&#105;&#120;&#101;&#100;&#45;&#119;&#105;&#100;&#116;&#104;&#32;&#99;&#111;&#100;&#101;&#32;&#98;&#108;&#111;&#99;&#107;&#60;&#47;&#112;&#114;&#101;&#62;</p>
					</div>
				</div>
			</div>
		</section>

		<br>

		<!-- Footer -->
		<footer id="footer">
			<div class="copyright">
				By: <a href="https://github.com/TiagoDanin/">TiagoDanin</a> Design: <a href="http://templated.co/">TEMPLATED</a> Github: <a href="https://github.com/TiagoDanin/SendCH-Telegram/">SendCH-Telegram</a>
			</div>
		</footer>

		<!-- Scripts -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>
		<script src="assets/js/main.js"></script>
	</body>
</html>
