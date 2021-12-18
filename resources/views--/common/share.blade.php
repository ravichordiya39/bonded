@php
$title=$socailimgurl=$shareurl='';
if(isset($shared['title']))
    $title=$shared['title'];
if(isset($shared['image_url']))
    $socailimgurl =$shared['image_url'];
if(isset($shared['url']))
    $shareurl=$shared['url'];
$facebookshareurl = "http://www.facebook.com/share.php?u={$shareurl}&source=AbeerJaipur";
$twittershareurl = "http://twitter.com/share?url={$shareurl}&via=abberjaipur&image={$socailimgurl}&text={$title}";
$instagramurl = "http://www.instagram.com/?url={$shareurl}&source=abberjaipur";
$linkedinurl = "http://www.linkedin.com/shareArticle?mini=true&url={$shareurl}";
$pinterestshareurl = "http://pinterest.com/pin/create/button/?url={$shareurl}&description={$title}";
$googleplusurl = "https://plus.google.com/share?url={$shareurl}";
$tumblrshareurl = "http://www.tumblr.com/share/link?url={$shareurl}";
$device=systemInfo(); 
if($device['device']=='SYSTEM')
    $whatsappshareurl="http://web.whatsapp.com/send?text={$shareurl}";
else
    $whatsappshareurl="whatsapp://send?text={$shareurl}";                             
@endphp
<div class="product-share-icon">
    <a class="facebook" href="{{$facebookshareurl}}" target="_blank"><i
            class="fab fa-facebook-f"></i></a>
    <a class="twitter" href="{{$twittershareurl}}" target="_blank"><i
            class="fab fa-twitter"></i></a>
    <a class="whatsapp" href="{{$whatsappshareurl}}" target="_blank"><i
            class="fab fa-whatsapp"></i></a>
    <!-- <a class="envelope" href="{{}}" target="_blank"><i
            class="far fa-envelope"></i></a>-->
</div>