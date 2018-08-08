  <?php
     include('Crypt/DES.php');
 
     $des = new Crypt_DES();
 
     $des->setKey('abcdefgh');
 
     //$size = 10 * 1024;
     $plaintext = 'Were on a mission this year. So far we have approved over 438,000 website submissions and created a separate page promoting each one. We would like to thank you for your contribution of the website "Wayanad Tour" by making you a special coupon code worth 25% off of our Featured service';
 
     //echo $des->decrypt($des->encrypt($plaintext));
	 echo $des->encrypt($plaintext);
  ?>