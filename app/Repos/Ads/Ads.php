<?php

namespace App\Repos\Ads;
/**
 * Created by PhpStorm.
 * User: Satish
 * Date: 26-Aug-15
 * Time: 4:15 PM
 */
class Ads {

    protected $ad_units = [];
    protected $formatted_ads = [];
    public function __construct()
    {
        $this->ad_units[] = '3049721056';//text-image-1
        $this->ad_units[] = '1762961050';//text-image-2
        $this->ad_units[] = '3239694259';//text-image-3
        $this->ad_units[] = '3687019456'; // text-ad-3
        $this->ad_units[] = '4105821852';// text-ad-1
        $this->ad_units[] = '1012754658'; // text-ad-2
    }

    protected function createUnits( $slot )
    {
        return <<<EOT
                <!-- cover-top-3-allpages -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-8164172226079689"
                     data-ad-slot="{$slot}"
                     data-ad-format="auto"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
EOT;
    }
    public function getAds()
    {
        foreach($this->ad_units as $ad)
        {
            $this->formatted_ads[] = $this->createUnits($ad);
        }
        return $this->formatted_ads;
    }
}