 
  <pre>
  <?php

     include('Net/SSH2.php');
 
     $ssh = new Net_SSH2('198.154.114.109');
     if (!$ssh->login('root', '14P5zNdyq2')) {
         exit('Login Failed');
     }
	/*
     //echo $ssh->exec('pwd');
     echo $ssh->exec('ls -la');
	 //echo $ssh->exec('sed -i \'$ a\me in from sed yaar\' greetings.txt');
	 //echo $ssh->exec('cat greetings.txt');
	
	//echo $ssh->exec('hdparm -i /dev/hda');
	//echo $ssh->exec('yum list all');

	 //echo $ssh->exec('echo "hello" >> greetings.txt');

	// $pass=crypt("123456",'JU');
	 //$user="anilm";
	 //$comd='useradd '.$user.'  -p '.$pass.' -g users -s /bin/false';
	  //echo $ssh->exec($comd);
	  $divice="test";
		echo $ssh->exec('echo "DEVICE='.$divice.'" > /tmp/ifcfg-$divice');
		echo $ssh->exec('echo "IPADDR=10.0.0.110" >> /tmp/ifcfg-$divice');
		echo $ssh->exec('cat /tmp/ifcfg-$divice');
	*/
		//echo $ssh->exec('virtualmin list-domains --name-only --toplevel');
		//echo $ssh->exec('virtualmin create-user --domain chimpclips.com --user vasu --pass 123456');
		//echo $ssh->exec('virtualmin list-users --domain chimpclips.com --name-only');
		$out=$ssh->exec('php -q  /etc/sbin/echo anil mathew');
	$ssh->disconnect();
	 //http://www.virtualmin.com/documentation/developer/cli/modify_dns/
	 print_r(json_decode($out));
  ?>
  </pre>
  