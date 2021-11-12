<?php
// session_start();
// echo '<pre>';
// print_r($_SESSION);

$new_password="123456";
$str='$2y$10$tgD0H20BIjyseNHF206SwOMDbGE8vdcQyK8lEra/SpObpT/OeMLCm';

if(password_verify($new_password,$str)){
    echo "Yes";
}else{
    echo "No";
}

?>