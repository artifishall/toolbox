<?php

if (!function_exists('get_country')) {
    function get_country() {
        return ['USA' => 'United States', 'CAN' => 'Canada', 'Other' => 'Other'];
    }
}

if (!function_exists('get_states')) {

    /**
     * State array
     *
     * Return an array of states with their abbreviation as the key
     *
     * @access public
     * @return string
     */
    function get_states() {
        $state_list = array(
            'United States' =>
            array(
                'AA' => 'Armed Forces - Americas',
                'AE' => 'Armed Forces - Europe/Africa/Canada',
                'AK' => 'Alaska',
                'AL' => 'Alabama',
                'AP' => 'Armed Forces - Pacific',
                'AR' => 'Arkansas',
                'AS' => 'American Samoa',
                'AZ' => 'Arizona',
                'CA' => 'California',
                'CO' => 'Colorado',
                'CT' => 'Connecticut',
                'DC' => 'District of Columbia',
                'DE' => 'Delaware',
                'FL' => 'Florida',
                'FM' => 'Federated States of Micronesia',
                'GA' => 'Georgia',
                'GU' => 'Guam',
                'HI' => 'Hawaii',
                'IA' => 'Iowa',
                'ID' => 'Idaho',
                'IL' => 'Illinois',
                'IN' => 'Indiana',
                'KS' => 'Kansas',
                'KY' => 'Kentucky',
                'LA' => 'Louisiana',
                'MA' => 'Massachusetts',
                'MD' => 'Maryland',
                'ME' => 'Maine',
                'MH' => 'Marshall Islands',
                'MI' => 'Michigan',
                'MN' => 'Minnesota',
                'MO' => 'Missouri',
                'MP' => 'Northern Mariana Islands',
                'MS' => 'Mississippi',
                'MT' => 'Montana',
                'NC' => 'North Carolina',
                'ND' => 'North Dakota',
                'NE' => 'Nebraska',
                'NH' => 'New Hampshire',
                'NJ' => 'New Jersey',
                'NM' => 'New Mexico',
                'NV' => 'Nevada',
                'NY' => 'New York',
                'OH' => 'Ohio',
                'OK' => 'Oklahoma',
                'OR' => 'Oregon',
                'PA' => 'Pennsylvania',
                'PR' => 'Puerto Rico',
                'PW' => 'Palau',
                'RI' => 'Rhode Island',
                'SC' => 'South Carolina',
                'SD' => 'South Dakota',
                'TN' => 'Tennessee',
                'TX' => 'Texas',
                'UT' => 'Utah',
                'VA' => 'Virginia',
                'VI' => 'Virgin Islands',
                'VT' => 'Vermont',
                'WA' => 'Washington',
                'WI' => 'Wisconsin',
                'WV' => 'West Virginia',
                'WY' => 'Wyoming',
            ),
            'Canada' =>
            array(
                'AB' => 'Alberta',
                'BC' => 'British Columbia',
                'MB' => 'Manitoba',
                'NB' => 'New Brunswick',
                'NL' => 'Newfoundland and Labrador',
                'NS' => 'Nova Scotia',
                'NT' => 'Northwest Territories',
                'NU' => 'Nunavut',
                'ON' => 'Ontario',
                'PE' => 'Prince Edward Island',
                'QC' => 'Quebec',
                'SK' => 'Saskatchewan',
                'YT' => 'Yukon Territory',
            ),
            'Other' =>
            array(
                'Other' => 'Other'
            )
        );

        return $state_list;
    }

}
