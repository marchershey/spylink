<?php

namespace App\Http\Controllers;

use App\Custom\Browser;
use App\Http\Controllers\Controller;
use App\SpyLink;
use App\SpyLinkVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpyLinkController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('pages.dashboard.create.spylink');
    }

    // NEEDS INFO COMMENT
    public function index_view_link($lid)
    {
        $spylink = SpyLink::where('lid', $lid)->first();
        $visits = SpyLinkVisit::where('lid', $lid)->get();
        // return $visits->countBy('referrer');
        if ($spylink) {
            return view('pages.index.link_info')->with(['link' => $spylink, 'visits' => $visits]);
        } else {
            return view('pages.index.index');
        }
    }

    /**
     * Redirect to the destination
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect($lid)
    {
        $spylink = SpyLink::where('lid', $lid)->first();
        if ($spylink) {
            if (self::saveVisit($lid)) {
                if (self::updateVisitCount($lid)) {
                    return redirect($spylink->url);
                } else {
                    return 'error - could not update visit count';
                }
            } else {
                return 'error - could not save visit';
            }

        } else {
            return redirect('/');
        }

    }

    // NEEDS INFO COMMENT
    public function updateVisitCount($lid)
    {

        $spylink = SpyLink::where('lid', $lid)->first();
        $count = $spylink->visits;
        $spylink->visits = ++$count;
        if ($spylink->save()) {
            return true;
        } else {
            return false;
        }

    }

    public function saveVisit($lid)
    {

        $link = SpyLink::where('lid', $lid)->first();
        $visit = new SpyLinkVisit();
        $ip = self::getIpAddress();
        $ip_type = self::getIpType($ip);
        $geo = self::geoData($ip);
        $browser = new Browser();
        $referrer = self::removeHttp(self::getReferrer());

        $visit->lid = $lid;
        $visit->ip = $ip;
        $visit->ip_type = $ip_type;
        $visit->country_code = $geo['country_code'];
        $visit->country_name = $geo['country_name'];
        $visit->region_code = $geo['region_code'];
        $visit->region_name = $geo['region_name'];
        $visit->city = $geo['city'];
        $visit->zip_code = $geo['zip_code'];
        $visit->time_zone = $geo['time_zone'];
        $visit->browser = $browser->getBrowser();
        $visit->browser_version = $browser->getVersion();
        $visit->platform = $browser->getPlatform();
        $visit->referrer = $referrer;
        $visit->visited_at = time();
        if ($visit->save()) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            // User is authenicated
            // Create private link

        } else {
            // User is not authenicated
            // Create public link
            $validation_messages = [
                'url.required' => 'Ya know, to shorten a link, you might need a link to shorten...',
                'url.string' => 'That URL doesn\'t look right...',
                'url.regex' => 'That URL doesn\'t look right...',
            ];
            $validate = $request->validate([
                'url' => ['required', 'string', 'regex:/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,10}(:[0-9]{1,5})?(\/.*)?$/'],
            ], $validation_messages);

            $string = self::generateLinkId();

            $spylink = new SpyLink;
            $spylink->lid = $string;
            $spylink->url = self::addHttp($request->input('url'));
            $spylink->page_title = self::getPageTitle(self::addHttp($request->input('url')));
            $spylink->created_ip = self::getIpAddress();
            $spylink->save();

            return redirect('/~' . $string . '+');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Generate Link ID
     *
     * Checks the generate string to use as the link id.
     * If link id exists, regenerate. If it fails # times or
     * more increase string length
     *
     * @return \Illuminate\Http\Response
     */
    public function generateLinkId($length = 4, $maxTries = 5)
    {

        $i = 0;
        $string = self::generateRandomString($length);

        // need to update to DB for better performance
        while (SpyLink::where('lid', $string)->exists()) {
            $i++;
            if ($i < $maxTries) {
                $string = self::generateRandomString($length);
            } else {
                $length = strlen($string);
                $length = ++$length;
                $string = self::generateRandomString($length);
            }
            print_r($i . '-' . $length . '<br>');

        }
        return $string;

    }

    /**
     * Generates a random string with variable string length
     */
    public function generateRandomString($length)
    {

        return $string = substr(md5(rand()), 0, $length);

    }

    /**
     * Retreive the title of the page we're redirecting to
     *
     * Source: https://stackoverflow.com/questions/399332/fastest-way-to-retrieve-a-title-in-php
     */
    public function getPageTitle($url)
    {

        $title = false;

        if ($handle = fopen($url, "r")) {

            $string = stream_get_line($handle, 0, "</title>");

            fclose($handle);

            if (strpos($string, '<title') !== false) {
                $string = (explode("<title", $string))[1];
                if (!empty($string)) {
                    $title = trim((explode(">", $string))[1]);
                }
            } else {
                $title = self::removeHttp($url);
            }

        }

        return $title;

    }

    /**
     * Adds http to urls
     *
     * Source: https://stackoverflow.com/questions/2762061/how-to-add-http-if-it-doesnt-exists-in-the-url
     */
    public function addHttp($url)
    {

        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }

        return $url;

    }

    /**
     * Removes http from urls
     *
     * Source: https://stackoverflow.com/questions/9364242/how-to-remove-http-www-and-slash-from-url-in-php
     */
    public function removeHttp($url)
    {

        $url = preg_replace('#(^https?:\/\/(w{3}\.)?)|(\/$)#', '', $url);

        return $url;

    }

    /**
     * Returns the user's ip address
     *
     * Source: https://stackoverflow.com/questions/1634782/what-is-the-most-accurate-way-to-retrieve-a-users-correct-ip-address-in-php
     */
    public function getIpAddress()
    {
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        };
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER)) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);

                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    };
                };
            };
        };
        return $ip;
    }

    /**
     * Returns the user's ip address
     *
     * Source: https://stackoverflow.com/questions/1634782/what-is-the-most-accurate-way-to-retrieve-a-users-correct-ip-address-in-php
     */
    public function getIpType($ip)
    {
        // could add FILTER_FLAG_NO_PRIV_RANGE && FILTER_FLAG_NO_RES_RANGE
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return 'ipv4';
        } elseif (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return 'ipv6';
        } else {
            return 'unknown';
        }
    }

    /**
     * Returns the user's ip address
     *
     * Source: https://stackoverflow.com/questions/1634782/what-is-the-most-accurate-way-to-retrieve-a-users-correct-ip-address-in-php
     */
    public function getReferrer()
    {

        if (!empty($_SERVER['HTTP_REFERER'])) {
            return $_SERVER['HTTP_REFERER'];
        } else {
            return 'unknown';
        }

    }

    /**
     * Returns geolocation data from ip address
     *
     * Source: https://freegeoip.app/
     */
    public function geoData($ip)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://freegeoip.app/json/" . $ip,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return json_decode($response, true);
        }

    }

    // end

}
