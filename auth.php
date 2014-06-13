<?php
$resp = array(
  'status' => 'fail',
  'output' => 'Failed.'
);

if(!array_key_exists('passwd', $_POST)):
  header('HTTP/1.1 400 Bad Request');
  header('Content-Type: application/json');
  echo json_encode($resp);
  return false;
endif;

// password here
$passwd = md5('M8ke it s0!');

if (md5($_POST['passwd']) !== $passwd):
  header('HTTP/1.1 200 OK');
  header('Content-Type: application/json');
  $resp['status'] = "not-authorized";
  $resp['output'] = "You are not Authorized.<br>
  <a href='javascript:location.reload()'>Try again</a>?";
  echo json_encode($resp);
  die();
endif;

// deploy!
header('HTTP/1.1 200 OK');
header('Content-Type: application/json');
// $output = shell_exec('rollout 2>&1');
// $output = "(no actual rollout command configured)";
$output = shell_exec('ls -l 2>&1');
$resp['status'] = 'success';
$resp['output'] = '<h1 style="color:rgba(30,255,30)">Deployed!</h1>';
$resp['output'] .= '<div class="console">'.sprintf("<pre>%s</pre>", $output)."</div>";
echo json_encode($resp);
