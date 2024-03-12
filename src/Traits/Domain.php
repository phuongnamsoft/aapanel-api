<?php

namespace PNS\AAPanel\Traits;

trait Domain
{
    public function addSubDomain($subdomain, $mainDomain, $iptarget)
    {
        $completeUrl    = $this->url . '/plugin?action=a&name=dns_manager&s=act_resolve';

        $data           = $this->encrypt();
        $data['host']   = $subdomain;
        $data['value']  = $iptarget;
        $data['domain'] = $mainDomain;
        $data['ttl']    = '600';
        $data['type']   = 'A';
        $data['act']    = 'add';

        $result         = $this->httpPostCookie($completeUrl, $data);

        return json_decode($result, true);
    }

    public function deleteSubDomain($subdomain, $mainDomain, $iptarget)
    {
        $completeUrl    = $this->url . '/plugin?action=a&name=dns_manager&s=act_resolve';

        $data           = $this->encrypt();
        $data['host']   = $subdomain;
        $data['value']  = $iptarget;
        $data['domain'] = $mainDomain;
        $data['ttl']    = '600';
        $data['type']   = 'A';
        $data['act']    = 'delete';

        $result         = $this->httpPostCookie($completeUrl, $data);

        return json_decode($result, true);
    }
    public function modifySubDomain($subdomain, $mainDomain, $iptarget, $id)
    {
        $completeUrl    = $this->url . '/plugin?action=a&name=dns_manager&s=act_resolve';

        $data           = $this->encrypt();
        $data['host']   = $subdomain;
        $data['value']  = $iptarget;
        $data['domain'] = $mainDomain;
        $data['ttl']    = '600';
        $data['type']   = 'A';
        $data['act']    = 'modify';
        $data['id']     = $id;

        $result         = $this->httpPostCookie($completeUrl, $data);

        return json_decode($result, true);
    }

    public function subDomainList($domain, $host = null)
    {
        $completeUrl    = $this->url . '/plugin?action=a&name=dns_manager&s=get_resolve';

        $data           = $this->encrypt();
        $data['domain'] = $domain;

        $result         = $this->httpPostCookie($completeUrl, $data);
        $resultarray    = json_decode($result, true);

        if ($host) {
            foreach ($resultarray as $i => $r) {
                if ($r['host'] == $host) {
                    $resultarray = $resultarray[$i];
                    $resultarray['id'] = $i;
                    break;
                }
            }
        }
        return $resultarray;
    }
}