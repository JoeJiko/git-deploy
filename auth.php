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

$passwd = md5('D3ploy !');

if (!md5($_POST['passwd']) == $passwd):
  header('HTTP/1.1 200 OK');
  header('Content-Type: application/json');
  $resp['status'] = "not-authorized";
  $resp['output'] = "You are not Authorized.";
  echo json_encode($resp);

else:
  $output = shell_exec('rollout 2>&1');
endif;

header('HTTP/1.1 200 OK');
header('Content-Type: application/json');
$resp['status'] = 'success';
$resp['output'] = 'Deployed! with output:<br>'.$output;
echo json_encode($resp);
